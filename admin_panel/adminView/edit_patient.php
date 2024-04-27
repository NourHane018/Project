<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Edit Patient</title>
</head>
<body>

<?php
// Include database connection
include_once "../inc/connections.php";



// Check if patient ID is provided in the URL
if(isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $username = $_POST['username'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];

        
        $sql = "UPDATE users SET username='$username', email='$email', birthday='$birthday', gender='$gender' WHERE id=$patient_id";
        if ($conn->query($sql) === TRUE) {
            echo "Patient details updated successfully.";
            
            
        } else {
            echo "Error updating patient details: " . $conn->error;
        }
    }

   
    $sql = "SELECT * FROM users WHERE id = $patient_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        $patient = $result->fetch_assoc();
?>

    <h2>Edit Patient</h2>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $patient['username']; ?>"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $patient['email']; ?>"><br><br>
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" value="<?php echo $patient['birthday']; ?>"><br><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="male" <?php if($patient['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if($patient['gender'] == 'female') echo 'selected'; ?>>Female</option>
        </select><br><br>
        <button type="submit">Update</button>
        <a href="../admin.php" >Back</a>
        
    </form>

<?php
    } else {
        echo "Patient not found.";
    }
} else {
    echo "Patient ID not provided.";
}
?>


</script>
</body>
</html>
