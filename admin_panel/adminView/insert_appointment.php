<?php
// Include the database connection file
include_once('../inc/connections.php');


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $patient_name = $_POST['patient_name'];
    $appointment_date = $_POST['appointment_datetime']; 
    $status = "Scheduled"; 

    // Insert appointment into the database
    $sql = "INSERT INTO appointments (patient_name, appointment_date, status) 
            VALUES ('$patient_name', '$appointment_date', '$status')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        
        echo "New appointment added successfully";
    } else {
        
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    
    header("Location: add_appointment.php");
    exit;
}


$conn->close();
?>
