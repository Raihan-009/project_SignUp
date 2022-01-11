<?php
    // connecting to database
    require 'connection.php';
?>
<?php
    $successresetAlert = false;
    $dangerresetAlert = false;
    require 'sendtoken.php'; //required sendtoken.php file to call the sendingtoken function to sent a mail

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = $_POST['email'];

        $sql = "SELECT * FROM `users_info` WHERE `Email` = '$email'";
        $result = mysqli_query($conn,$sql);
        if ($result)
        {
            // echo $email;
            if (mysqli_num_rows($result) == 1) //found a row
            {
                // echo "Ok";
                $token = bin2hex(random_bytes(8)); //generating hex code
                // echo $token;
                date_default_timezone_set('Asia/Bangladesh');
                $date = date("Y-m-d");
                // echo $date;
                $update_sql = "UPDATE `users_info` SET `ResetToken`='$token',`ExpiredDate`='$date' WHERE `Email` = '$_POST[email]'";
                $update_result = mysqli_query($conn, $update_sql);
                // echo $update_result;
                // echo '<br>';
                // echo $token;
                // echo '<br>';
                $sending_token = sendingtoken($_POST['email'], $token); //calling the function to sent a mail
                // echo $sending_token;
                // echo '<br>';
                if($update_result && $sending_token)
                {
                    $successresetAlert = "A reset link has sent to your mail.";
                }else
                {
                    $dangerresetAlert = "Something Went Wrong. There must be some wrong with server. Try again later.";
                }
            }else
            {
                $dangerresetAlert = "Invalid Input. Please submit your mail carefully.";
            }
        }else
        {
            $dangerresetAlert = "Something Went Wrong. There must be some wrong with server. Try again later.";
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

    <title>Reset Password</title>
  </head>
  <body>

    <!-- Navbar for frontend -->
    <?php
        require 'nav.php'
    ?>

    <!-- Showing Alert -->
    <?php
        if ($successresetAlert)
        {
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Success!</strong> '. $successresetAlert .'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if ($dangerresetAlert)
        {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Error!</strong> '. $dangerresetAlert .'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    ?>



    <!-- front end part starts here : sign up session -->
        <div class="container mt-3">
            <div class="half-part bg_img">
                <img src="reset.png" alt="">
            </div>
            <div class="half-part">
                <h3 class = "center_text">Reset Your Password (Step 01)</h3>
                <form action = "/project_SignUp/resetpassword.php" method = "POST">
                    <br>
                    <br>
                    <div class="mb-3 mt-5">
                        <!-- <label for="email" class="form-label"></label> -->
                        <h6 class="center_text">Enter your email address to sent a reset link.</h6>
                        <input type="email" class="form-control" id="email" name = "email" aria-describedby="emailHelp">
                    </div>
                    <button class ="submit-button" type="submit">Submit</button>
                </form>
                <div class="">
                    <p class="center_text mt-2">Already have an account? <span><a href="/project_SignUp/login.php">Log in</a></span></p>
                </div>
                <div class="">
                    <p class="center_text mt-2">Don't have an account? <span><a href="/project_SignUp/signup.php">Create new</a></span></p>
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