<?php
// Include database connection
include_once "../inc/connections.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_name']);
    $appointment_datetime = mysqli_real_escape_string($conn, $_POST['appointment_datetime']);

    // Insert appointment details into appointments table
    $sql = "INSERT INTO appointments (patient_name, appointment_date, status, user_id) 
            VALUES (
                (SELECT username FROM users WHERE id = '$patient_id'),
                '$appointment_datetime',
                'Scheduled', 
                '$patient_id'
            )";

    if(mysqli_query($conn, $sql)){
        echo "Appointment added successfully.";
        
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
