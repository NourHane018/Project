<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="add.css">
</head>
<body>
<style>
    
  .bluebox {
    width: 340px;
    height: 600px;
    top: -13%;
  }
  .welcome {
    width: 690px;
    height: 450px;
    top: 20%;
   
  }
</style>
<?php
// Include database connection
include_once "../inc/connections.php";

// Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];

    // Generate a random password
    $password = generateRandomPassword();
    $md5_password = md5($password);


    // Set default status to 'approved'
    $sql = "INSERT INTO users (username, email, birthday, gender, password, md5_pass, isAdmin, status) VALUES ('$username', '$email', '$birthday', '$gender', '$password', '$md5_password', 0, 'approved')";
    
    if ($conn->query($sql) === TRUE) {
        // Echo the username and password along with a print button
        echo "New patient Username: $username | Password: $password added successfully. <a href='javascript:window.print()'><i class='fas fa-print'></i> Print</a>";
    } else {
        echo "Error adding patient: " . $conn->error;
    }
}
?>

<div class="container">
  <div class="welcome">
    <div class="bluebox">
      <div class="signin">
        <h1>Add New Patient</h1>

<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthday" required><br><br>
    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br><br>
    <button type="submit"  class="button submit">Add Patient</button>
   
</form>
     </div>
    </div>
    <div class="rightbox">
      <h2 class="title"><span>Therap</span>Ease</h2>
      
      <img class="imag" src="Autism-bro.svg"/>
      <p class="account">Return to Control Page</p>
      <button class="button" onclick="window.location.href='../admin.php';">Back</button>
    </div>
  </div>
 </div>

</div>