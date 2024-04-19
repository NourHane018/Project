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
    <form method="POST" action="insert_appointment.php">
        <label for="patient_name">Patient Name:</label>
        <select id="patient_name" name="patient_name" required>
            <?php
            // Include database connection
            include_once "../inc/connections.php";

            // Query to retrieve patient names from the user table
            $sql = "SELECT username FROM users";
            $result = $conn->query($sql);

            // Check if there are any patients
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["username"] . "'>" . $row["username"] . "</option>";
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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Handle form submission
                $patientName = $_POST["patient_name"];
                $appointmentDatetime = $_POST["appointment_datetime"];

                echo "Patient Name: " . $patientName . "<br>";
                echo "Appointment Date and Time: " . $appointmentDatetime;
            }
        ?>
    </div>
</body>
</html>
