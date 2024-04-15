<?php 
include('inc/connections.php');
if(isset($_POST['verify_email'])) {
    $email = $_POST['email'];
    $verification_code = $_POST['verification_code'];
    
    $check_email = "SELECT * FROM users WHERE verification_code = '$verification_code'";
    $result = mysqli_query($conn, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
        header('location:index.php');
        exit(); 
    } else {
        echo "An error occurred while verifying the authenticated email " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
    <input type="hidden" name="email" >
    <input type="text" name="verification_code" placeholder="Enter verification code" required />
 
    <input type="submit" name="verify_email" value="Verify Email">
</form>
</body>
</html>