<?php
// Include database connection
include_once "../inc/connections.php";

// Check if advertisement ID is provided in the URL
if(isset($_GET['id'])) {
    $advertisement_id = $_GET['id'];

    // Delete the advertisement from the database
    $sql = "DELETE FROM advertisements WHERE id = $advertisement_id";
    if(mysqli_query($conn, $sql)) {
        echo '<script>window.location.href = "../admin.php";</script>';
    } else {
        echo "Error deleting advertisement: " . mysqli_error($conn);
    }
} else {
    echo "Advertisement ID not provided.";
}
?>
