<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h2>Add New Appointment</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="patient_name">Patient Name:</label>
        <select id="patient_name" name="patient_name" required>
            <?php
            // Include database connection
            include_once "../inc/connections.php";

            // Query to retrieve patient names and ids from the user table
            $sql = "SELECT id, username FROM users";
            $result = $conn->query($sql);

            // Check if there are any patients
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["username"] . "</option>";
                }
            }
            ?>
        </select><br><br>
        
        <label for="appointment_datetime">Appointment Date and Time:</label>
        <input type="datetime-local" id="appointment_datetime" name="appointment_datetime" required><br><br>
        
        <button type="submit">Add Appointment</button>
    </form>
    <a href="../admin.php" >Back</a>

    <div id="result">
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
            
            // Close the database connection
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>

