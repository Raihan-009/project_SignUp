<?php
  session_start();
  if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != true))
  {
    header("location: login.php");
    exit;
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="homeStyle.css">

    <title>Welcome</title>

  </head>
  <body>
    <?php
        require 'nav.php';
        echo '<div>
                <h1 class="center_text">Welcome '. $_SESSION['username'] .'</h1>
            </div>';
    ?> 

    <div class="container">
      <img src="demoHome.jpeg" class = "img-fluid rounded mx-auto d-block" alt="">
      <h3 class = "center_text">This site is under development</h3>
    </div>

    <div class="center_text">
      <a href="logout.php" class = "mt-3 btn btn-outline-primary btn-lg">Log Out</a>
    </div>

    <!-- js dependencies -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  </body>
</html>