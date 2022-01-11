<?php
    require 'sendv_code.php';
?>
<?php

$signupAlert = false;
$signupAlert2 = false;
$confirmpasswordAlert = false;
$entryAlert = false;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    include 'connection.php';
    $username = $_POST['username'];
    $emailaddress = $_POST['email'];
    $password = $_POST['pass'];
    $confirmpassword = $_POST['confirmpass'];
    $usernameexistsAlert = false;

    if (!empty ($username) && !empty($emailaddress) && !empty($password) && !empty($confirmpassword))
    {
        $_sql = "SELECT * FROM `users_info` WHERE username = '$username'";
        $result = mysqli_query($conn, $_sql);
        $numberofusername = mysqli_num_rows($result);
        if ($numberofusername > 0)
        {
            $usernameexistsAlert = "Username already exists.";
        }
        else
        {
            if (($password == $confirmpassword))
            {
                $secret = password_hash($password, PASSWORD_DEFAULT);
                $v_code = bin2hex(random_bytes(16));
                // echo $secret;
                $sql = "INSERT INTO `users_info` (`Username`,`Email`, `Password`,`VerificationCode`, `Status`, `Time`) VALUES ('$username','$emailaddress', '$secret','$v_code','0', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                $mailing = sendingV_code($_POST['email'],$v_code);
                // echo var_dump($mailing);
                if ($result && $mailing)
                {
                    $signupAlert = true;
                }else
                {
                    $signupAlert2 = true;
                }
            }else
            {
                $confirmpasswordAlert = "Plase submit same password carefully";
            }
        }
    }else
    {
        $entryAlert = "Please submit all of the given entry";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="signupStyle.css">
    <link rel="stylesheet" href="css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sign Up</title>
  </head>
  <body>
    <!-- Create database connection -->
    <?php
        require 'nav.php'
    ?>
    <!-- Showing Alert -->
    <?php
        if ($signupAlert)
        {
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Success!</strong> Your account has been created. We sent you an email. Please verify your account before login.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if ($signupAlert2)
        {
            echo '<div class="alert alert-warning alert-dismissible" role="alert">
                        <strong>Error!</strong> Something Went wrong with your email verification.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if ($confirmpasswordAlert)
        {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Wrong Password!</strong> '. $confirmpasswordAlert .'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if ($entryAlert)
        {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Invalid Input!</strong> '. $entryAlert .'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if ($usernameexistsAlert)
        {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Invalid Username!</strong> '. $usernameexistsAlert .'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if($verified)
        {
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Verified!</strong> Your email has verified. You can login now.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
        }
    ?>
    <!-- front end part starts here : sign up session -->
        <div class="container mt-3">
            <div class="half-part">
                <img src="demo.jpeg" alt="">
            </div>
            <div class="half-part">
                <h3 class = "center_text">Welcome to WEB Apps!</h3>
                <form action = "/project_SignUp/signup.php" method = "post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name = "username" maxlength="10" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name = "email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pass" name = "pass" minlength="1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpass" name = "confirmpass" minlength="1">
                    </div>
                    <button class ="submit-button" type="submit">Submit</button>
                </form>
                <div class="">
                    <p class="center_text mt-3">Already have an account? <span><a href="/project_SignUp/login.php">Log in</a></span></p>
                </div>
                <div class="stay_connect">
                    <h4>Stay connected with us</h4>
                    <i class="fab fa-facebook iconn"></i>
                    <i class="fab fa-instagram-square iconn"></i>
                    <i class="fab fa-linkedin iconn"></i>
                </div>
            </div>
        </div>

   <!-- js dependencies -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  </body>
</html>