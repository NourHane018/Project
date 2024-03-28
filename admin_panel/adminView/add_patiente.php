<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
</head>
<body>

<?php
// Include database connection
include_once "../inc/connections.php";



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO users (username, email, birthday, gender, isAdmin) VALUES ('$username', '$email', '$birthday', '$gender', 0)";
    if ($conn->query($sql) === TRUE) {
        echo "New patient added successfully.";
    } else {
        echo "Error adding patient: " . $conn->error;
    }
}
?>

<h2>Add New Patient</h2>
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
    <button type="submit">Add Patient</button>
</form>
<button onclick="goBack()">Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
