<!-- connecting with database -->
<?php
    require 'connection.php';
    // echo "connected";
    // echo '<br>';
?>

<?php
    $passverifiedAlert = false;
    $passverifiedAlert2 = false;
    $email_address = $_GET['email'];
    if (isset($_GET['email']) && isset($_GET['token']))
    {
        date_default_timezone_set("Asia/Bangladesh");
        $date =  date("Y-m-d");
        $sql = "SELECT * FROM `users_info` WHERE `Email` = '$_GET[email]' AND `ResetToken` = '$_GET[token]' AND `ExpiredDate` = '$date'";
        $_result = mysqli_query($conn, $sql);

        // echo var_dump($_result);
        // echo $_result;
        // echo "Email Addresss: ".$_GET['email'];
        // echo "<br>";
        // echo "Reset Token :".$_GET['token'];
        // echo "<br>";
        // echo "Expire Date: ".$date;
        // echo "<br>";

        if($_result)
        {
            if(mysqli_num_rows($_result)==1)
            {
                $passverifiedAlert = "Click okay to reset your password.";
                session_start();
                $_SESSION['pass_verification'] = true;
                $_SESSION['email_add'] = $email_address;
                // include "updatepassword.php";
            }else
            {
                $passverifiedAlert2 = "Link session expired";
            }
        }else
        {
            $passverifiedAlert2 = "Something went wrong";
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Link Verification</title>
</head>
<body>
    <?php
        if($passverifiedAlert)
        {
            echo "<script>
                    alert('$passverifiedAlert');
                    window.location.href = '/project_SignUp/updatepassword.php';
                </script>";
        }
        if($passverifiedAlert2)
        {
            echo "<script>
                    alert('$passverifiedAlert2');
                    window.location.href = '/project_SignUp/login.php';
                </script>";
        }
    ?>
</body>

</html>