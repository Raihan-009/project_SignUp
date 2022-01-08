<?php

$loginAlert = false;
$confirmuserinfoAlert = false;
$entryAlert = false;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    include 'backend/connection.php';
    $username = $_POST['username'];
    $password = $_POST['pass'];

    if (!empty ($username) && !empty($password))
    {
      $sql = "SELECT * from `users_info` WHERE username = '$username'  AND password = '$password'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
    
      if ($num == 1)
      {
        $loginAlert = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: home.php");
        
      }else
      {
        $confirmuserinfoAlert = "Your info didnt match.";
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

    <title>login</title>
  </head>
  <body>
    <!-- Create database connection -->
    <?php
        require 'backend/nav.php'
    ?>
    <!-- Showing Alert -->
    <?php
        if ($loginAlert)
        {
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Success!</strong> Your account has logged in.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if ($confirmuserinfoAlert)
        {
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Wrong submission!</strong> '. $confirmuserinfoAlert .'
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
    ?>
    <!-- front end part starts here : sign up session -->
        <div class="container mt-3">
            <div class="half-part">
                <img src="demo.jpeg" alt="">
            </div>
            <div class="half-part">
                <h3 class = "center_text">Log in to continue the WEB Apps!</h3>
                <form action = "/project_SignUp/login.php" method = "post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name = "username" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pass" name = "pass" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your password with anyone else.</div>
                    </div>
                    <button class ="submit-button" type="submit">Submit</button>
                </form>
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