<?php
include('inc/connections.php');
if(isset($_POST['submit'])){
    $username = stripcslashes(strtolower($_POST['username'])) ; 
    $email = stripcslashes($_POST['email']);
    $password = stripcslashes($_POST['password']);
  

    $username  =  htmlentities(mysqli_real_escape_string($conn,$_POST['username']));
    $email =      htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    $passsword  = htmlentities(mysqli_real_escape_string($conn,$_POST['password']));
    $md5_pass = md5($passsword);

$check_user = "SELECT * FROM `patients` WHERE username='$username'";
$check_result = mysqli_query($conn,$check_user);
$num_rows = mysqli_num_rows($check_result);
if($num_rows != 0){
    $user_error = '<p id="error" >sorry username already exist , chnage another one <p>';
    $err_s = 1 ;
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

if(empty($passsword)){
    $pass_error = '<p id="error" >Please insert Password <p>';
    $err_s = 1 ;
    include('signup.php');

}elseif(strlen($passsword) < 6){
    $pass_error = '<p id="error" >Your password needs to have a minimum of 6 letters<p> ';
    $err_s = 1 ;
    include('signup.php');
}

        $sql = "INSERT INTO patients(username,email,password,md5_pass) 
        VALUES ('$username','$email','$passsword','$md5_pass')";
        mysqli_query($conn,$sql);
        header('location:index.php');
    }else{
        include('signup.php');}
        ?>