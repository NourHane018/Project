<?php
// Include database connection code
include('incl/connection.php');

// Check if form is submitted with patient ID
if(isset($_POST['patient_id'])) {
    // Retrieve patient ID from the form
    $patient_id = $_POST['patient_id'];
    
    // Retrieve updated patient information from the form fields
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $dob = $_POST['dob'];

    // Construct SQL query to update patient information
    $sql = "UPDATE patients SET name = '$name', username = '$username', email = '$email', number = '$number', date_of_birth = '$dob' WHERE id = '$patient_id'";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the admin panel after successful update
        header("Location: admin.php");
        exit(); // Stop further execution
    } else {
        // Handle database update error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect back to the admin panel if patient ID is not provided
    header("Location: admin.php");
    exit(); // Stop further execution
}

// Close the database connection
mysqli_close($conn);
?>

