<?php
// Include database connection code
include('incl/connection.php');

// Check if the ID parameter is provided in the URL
if(isset($_GET['id'])) {
    // Retrieve the patient ID from the URL
    $patient_id = $_GET['id'];

    // Construct SQL query to delete the patient with the provided ID
    $sql = "DELETE FROM patients WHERE id = '$patient_id'";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the admin panel after successful deletion
        header("Location: admin.php");
        exit(); // Stop further execution
    } else {
        // Handle database deletion error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect back to the admin panel if the ID parameter is not provided
    header("Location: admin.php");
    exit(); // Stop further execution
}

// Close the database connection
mysqli_close($conn);
?>
