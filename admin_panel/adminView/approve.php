<?php
include_once "../inc/connections.php";

// Check if the ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize and validate the ID parameter
    $id = intval($_GET['id']);
    
    // Update the status of the user with the given ID to 'approved'
    $sql = "UPDATE users SET status = 'approved' WHERE id = $id";
    if(mysqli_query($conn, $sql)) {
        
        echo '<script>window.location.href = "../admin.php";</script>';

    } else {
        // If there was an error with the query, display an error message
        echo '<script>alert("Error updating status: ' . mysqli_error($conn) . '");</script>';
    }
} else {
    // If the ID parameter is not set in the URL, display an error message
    echo '<script>alert("ID parameter is missing!");</script>';
}
?>
