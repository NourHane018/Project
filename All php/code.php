<?php 
include('inc/connections.php');

if(isset($_POST['verify_email'])) {
    $email = $_POST['email'];
    $verification_code = $_POST['verification_code'];
    
    $check_email = "SELECT * FROM users WHERE verification_code = '$verification_code'";
    $result = mysqli_query($conn, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
        // Generate random value for email_verified_at
        $email_verified_at = mt_rand(10000, 99999);
        
        // Update email_verified_at for the user
        $update_query = "UPDATE users SET email_verified_at = '$email_verified_at' WHERE verification_code = '$verification_code'";
        $update_result = mysqli_query($conn, $update_query);
        
        if ($update_result) {
            // Update successful, redirect to index.php
            header('location:index.php');
            exit(); 
        } else {
            // Update failed
            echo "An error occurred while updating email_verified_at: " . mysqli_error($conn);
        }
    } else {
        echo "<div style='color:#315467; width: 100%; font-size: 3rem; text-align: center; margin-top: 3rem;'> No user found with the provided verification code.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
   <style>
          .btn2{
 width: 15rem;
 margin-bottom: 3rem;
margin-left:1.5rem;
     }
     .login-box {
    width:400px;
    height:300px;
  }
  @media (max-width:376px) {
  .login-box {
   
    width: 300px;
    height:300px;
    box-shadow: 2px 4px 4px #dcdcdc, -2px 4px 4px #dcdcdc;
  }
 .login-box h1{
font-size:1.5rem;
 }
 .btn2{
 
margin-left:0rem;
     }
 }
   </style> 
<div class="login-container">

 <form method="POST">
  <div class="login-box">   
     <div class="header">
       <h3>Email verification</h3>
     </div>
    <input type="hidden" name="email" >
    <div class="content">
        <div class="input-box">
           <input type="text" name="verification_code" placeholder="" required />
           <span>Enter verification code</span>
           <span></span>
       </div>
       <input type="submit" name="verify_email" value="Verify Email" class="btn2"> 
 
    </div>
  </form>
</div>
</body>
</html>