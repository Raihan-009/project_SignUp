<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendingV_code($emailaddress,$v_code)
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
            $mail->addAddress($emailaddress);     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email Verification';
            $mail->Body    = "To verify your email <a href='http://localhost/project_SignUp/verification.php?email=$emailaddress&v_code=$v_code'>Click Here</a>";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }

    }
?>