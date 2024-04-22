<?php
ob_start();

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'therapeasess@gmail.com';                     //SMTP username
    $mail->Password   = 'zfugqrcnhjuhmqdb';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('therapeasess@gmail.com', 'Mailer');
    
    $mail->addAddress($_POST['email'], 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $reset_token = mt_rand(10000, 99999);


 
    $mail->Subject = 'Reset password';
    $mail->Body = 'Click the link to reset your password:</b>
     <a href="http://localhost/myphp/resetpassword.php?email=' . $_POST['email'] . '">Reset Password</a>';

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    $sql = "INSERT INTO users(username,email,password,birthday,gender,md5_pass,verification_code,email_verified_at,reset_token) 
    VALUES ('$username','$email','$passsword','$birthday','$gender','$md5_pass','$verification_code',NULL,'$reset_token')";
    mysqli_query($conn,$sql);
    header('location:code.php');
    ob_end_flush();
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}