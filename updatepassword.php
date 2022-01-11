<?php
  session_start();
  if (!isset($_SESSION['pass_verification']) || ($_SESSION['pass_verification'] != true))
  {
    header("location: resetpassword.php");
    exit;
  }
?>
<?php
    require "connection.php";
?>
<?php
$passverifiedAlert = false;
    if(isset($_POST['updatepass']))
    {
        // echo "New password has submitted";
        // echo '<br>';
        $new_pass = $_POST['npass'];
        // echo "New password: ".$new_pass;
        // echo '<br>';
        $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
        // echo $new_hash;
        // echo '<br>';
        // echo "$_GET[email]";
        // echo '<br>';
        $new_update_sql = "UPDATE `users_info` SET `Password`='$new_hash' , `ResetToken`= NULL , `ExpiredDate`=NULL WHERE `Email` = '$_SESSION[email_add]'";
        $result = mysqli_query($conn, $new_update_sql);
        // echo var_dump($result);
        if ($result)
        {
            $passverifiedAlert = "Password Reset Done. Click ok to redirect to login page";
        }else
        {
            $passverifiedAlert = "Something went wrong"; 
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

    <title>New Password</title>
  </head>
  <body>
    <!-- Navbar -->
    <?php
        require 'nav.php'
    ?>
 
    <!-- front end part starts here : sign up session -->
    <div class="container mt-3">
        <div class="half-part bg_img">
            <img src="reset.png" alt="">
        </div>
        <div class="half-part">
            <h3 class = "center_text">Reset Your Password (Step 02)</h3>
            <form method="POST">
                <br>
                <br>
                <div class="mb-3 mt-5">
                    <!-- <label for="email" class="form-label"></label> -->
                    <h6 class="center_text">Enter new password</h6>
                    <input type="password" class="form-control" id="npass" name = "npass" aria-describedby="emailHelp">
                </div>
                <button class ="submit-button" type="submit" name = "updatepass">Change</button>
            </form>
            <div class="stay_connect">
                <h4>Stay connected with us</h4>
                <i class="fab fa-facebook iconn"></i>
                <i class="fab fa-instagram-square iconn"></i>
                <i class="fab fa-linkedin iconn"></i>
            </div>
        </div>
    </div>
    <!-- Alert -->
    <?php
        if($passverifiedAlert)
        {
            echo "<script>
                    alert('$passverifiedAlert');
                    window.location.href = '/project_SignUp/login.php';
                </script>";
        }
    ?>

   <!-- js dependencies -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  </body>
</html>