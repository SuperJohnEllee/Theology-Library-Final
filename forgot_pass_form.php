
<?php
    include ('connection.php');

    $error  = '';
    require ('PHPMailer/PHPMailerAutoload.php');

    if (isset($_POST['btn_send'])) {
        $email = htmlspecialchars($_POST['email']);
        $res = mysqli_query($conn, "SELECT * FROM users WHERE UserEmail = '$email'");
        $count = mysqli_num_rows($res);
        $row = mysqli_fetch_assoc($res);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "This $email is invalid";
        }

        if ($count > 0 ) {
            
            $mail = new PHPMailer();

            $mail->SMTPDebug = 2; //Debugging
            $mail->isSMTP();
            $mail->Debugoutput = "html";
            $mail->Host = "smtp.gmail.com:465"; //Host Name
            $mail->SMTPAuth = true; //if SMTP Host requires authenticationto send email
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->mailer = "smtp";
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->Subject = "Test Email";
            $mail->Body = "<i>".$row['Username']. " this is your Password</i>".$row['UserPassword'];
            $mail->AltBody = "This is the plain text version of the email content";
            if (!$mail->send()) {
                ob_end_clean();
                echo "Failure in sending a Password to email. " . 
                $mail->ErrorInfo;
            } else {
                    ob_end_clean();
                    return true;
            }
        
        } else {
            echo "$email is not existing in the database";
        }
    }
?>