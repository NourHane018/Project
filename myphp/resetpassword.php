<?php 
include('inc/connections.php');
if(isset($_POST['newpassword'] )){
    $email= $_POST['email'];
    $password=$_POST['password'];
    $md5_pass = md5($password);
    $check_password = "UPDATE `users` SET password = '$password', md5_pass = '$md5_pass' WHERE email = '$email'";
    $result = mysqli_query($conn,$check_password);
    if ($result) {
        echo" The password has been updated successfully";
    } else {
        echo "AN error occurred while updating the password" . mysqli_error($conn);
    }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET PASSWORD</title>
</head>
<body>

    <h1>Reset password</h1>
    <form  method="POST">
        <input type="email" name="email" placeholder="email" ><br><br>
   <input type="password" name="password" placeholder="New password"    > <br><br><br>
   
   <input type="submit" name="newpassword" value="Reset" ><br><br>
   </form>
   <a href="index.php"> log in</a>
</body>
</html>