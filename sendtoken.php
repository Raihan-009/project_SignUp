<!-- This code works for send a reset link to reset current password -->
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
// Generating a function which will send a mail to user
    function sendingtoken($email,$token)
    {
        require ("PHPMailer/Exception.php");
        require ("PHPMailer/SMTP.php");
        require ("PHPMailer/PHPMailer.php");

        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'islamraihan498@gmail.com';                     //SMTP username
            $mail->Password   = 'admin_1809009';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('islamraihan498@gmail.com', 'Project SignUp');
            $mail->addAddress($email);     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password Reset';
            $mail->Body    = "To verify your email <a href='http://localhost/project_SignUp/verifypassword.php?email=$email&token=$token'>Click Here</a>"; //rederecting to verifypassword.php file
        
            $mail->send();
            return true; // returning true if mail sent successfully
        } catch (Exception $e) {
            return false; //returning false if mail ccould not sent successfully
        }

    }
?>