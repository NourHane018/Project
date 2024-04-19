<?php
include_once "../inc/connections.php";

// Check if appointment ID is provided in the URL
if(isset($_GET['id'])) {
    $appointment_id = $_GET['id'];

    // Delete appointment from the database
    $sql = "DELETE FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        // Redirect to admin page after successful deletion
        header("Location: ../admin.php");
        exit();
    } else {
        // Error occurred while deleting appointment
        echo "Error deleting appointment: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Appointment ID not provided.";
}
?>
