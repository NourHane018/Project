<?php
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include('inc/connections.php');
$err_s=0;
if(isset($_POST['submit'])){
    $username = stripcslashes(strtolower($_POST['username'])) ; 
    $email = stripcslashes($_POST['email']);
    $password = stripcslashes($_POST['password']);
    if(isset($_POST['birthday_month']) && isset($_POST['birthday_day']) && isset($_POST['birthday_year'])){
        $birthday_month = (int)$_POST['birthday_month'];
        $birthday_day  = (int) $_POST['birthday_day'];
        $birthday_year = (int) $_POST['birthday_year'];
        $birthday = htmlentities(mysqli_real_escape_string($conn,$birthday_day.'-'.$birthday_month.'-'.$birthday_year)); 
    }

    $username  =  htmlentities(mysqli_real_escape_string($conn,$_POST['username']));
    $email =      htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    $passsword  = htmlentities(mysqli_real_escape_string($conn,$_POST['password']));
    $md5_pass = md5($passsword);

if(isset($_POST['gender'])){
    $gender = ($_POST['gender']);
    $gender = htmlentities(mysqli_real_escape_string($conn,$_POST['gender']));
    if(!in_array($gender,['male','female'])){
        $gender_error = '<p id="error" >Please choose gender not a text ! <p>';
        $err_s = 1 ;

    }
}

$check_user = "SELECT * FROM `users` WHERE username='$username' OR email='$email'";
$check_result = mysqli_query($conn, $check_user);
$num_rows = mysqli_num_rows($check_result);

if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($check_result)) {
        if ($row['username'] === $username) {
            $user_error = '<p id="error">Sorry, username already exists. Please choose another one.</p>';
        }
        if ($row['email'] === $email) {
            $email_error = '<p id="error">Sorry, email already exists. Please choose another one.</p>';
        }
    }
    $err_s = 1;
}



if(empty($username)) {
    $user_error = '<p id="error" >Please enter username <p>';
    $err_s = 1 ;
}elseif(strlen($username) < 6 ){
    $user_error = '<p id="error" >Your username needs to have a minimum of 6 letters <p>';
     $err_s = 1 ;
}elseif(filter_var($username,FILTER_VALIDATE_INT)){ 
    $user_error = '<p id="error" >Please enter a valid username not a number <p>';
    $err_s = 1 ;
}

if(empty($email)) {
    $email_error = '<p id="error" >Please insert email<p> ';
    $err_s = 1 ;
}
elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
    $email_error = '<p id="error" >Please enter  a valid email <p>';
    $err_s = 1 ;

}

if(empty($gender)){
    $gender_error = '<p id="error" >Please choose gender<p> ';
    $err_s = 1 ;
}
if(empty($birthday)){
    $birthday_error = '<p id="error" >Please insert date of birthday<p> ';
    $err_s = 1 ;
}
if(empty($passsword)){
    $pass_error = '<p id="error" >Please insert Password <p>';
    $err_s = 1 ;
    include('register.php');

}elseif(strlen($passsword) < 6){
    $pass_error = '<p id="error" >Your password needs to have a minimum of 6 letters<p> ';
    $err_s = 1 ;
    include('register.php');
}
else{
    if(($err_s == 0) && ($num_rows == 0)){
        if($gender == 'male'){
        
        }
        ob_start();

        
        
        if(($err_s == 0) && ($num_rows == 0)){
         if (isset($_POST["submit"]))
            {
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
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
            $mail->setFrom('therapeasess@gmail.com', 'Therap Ease');
            
            $mail->addAddress($_POST['email'], 'Joe User');     //Add a recipient
            $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
        
            
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $verification_code = mt_rand(10000, 99999);
        
        
         
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
            $sql = "INSERT INTO users(username,email,password,birthday,gender,md5_pass,verification_code,email_verified_at) 
            VALUES ('$username','$email','$passsword','$birthday','$gender','$md5_pass','$verification_code',NULL)";
            mysqli_query($conn,$sql);
            header('location:code.php');
            ob_end_flush();
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }}}
    }else{
        include('register.php');
    }}}?>

