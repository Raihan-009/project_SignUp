<?php
    require 'connection.php';
    echo "connected";
    echo '<br>';
    $verifiedAlert = false;

    if (isset($_GET['email']) && isset($_GET['v_code']))
    {
        $sql = "SELECT * FROM `users_info` WHERE `Email` = '$_GET[email]' AND `VerificationCode` = '$_GET[v_code]'";
        $_result = mysqli_query($conn, $sql);
        // echo var_dump($_result);
        if($_result)
        {
            if(mysqli_num_rows($_result)==1)
            {
                $fetching_result = mysqli_fetch_assoc($_result);
                echo "Email: ". $fetching_result['Email'];
                echo '<br>';
                echo "Status: " .$fetching_result['Status'];
                if($fetching_result['Status'] == 0)
                {
                    $update_sql = "UPDATE `users_info` SET `Status`='1' WHERE `Email`='$fetching_result[Email]'";
                    $up_result = mysqli_query($conn,$update_sql);
                    echo '<br>';
                    echo $fetching_result['Status'];
                    echo '<br>';
                    if ($up_result)
                    {
                        echo "Email verified Successfully!";
                        $verifiedAlert = "Your email has verified. please click Ok to redirect login page.";
                        
                    }else
                    {
                        $verifiedAlert = "Something went wrong";
                    }
                }else
                {
                    $verifiedAlert = "Your email alredy verified.";
                }
            }else
            {
                $verifiedAlert = "Something went wrong";
            }
        }else
        {
            $verifiedAlert = "Something went wrong";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <?php
        if($verifiedAlert)
        {
            echo "<script>
                    alert('$verifiedAlert');
                    window.location.href = '/project_SignUp/login.php';
                </script>";
        }
    ?>
</body>

</html>