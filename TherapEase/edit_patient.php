<?php
// Include database connection code
include('incl/connection.php');

// Check if the ID parameter is provided in the URL
if(isset($_GET['id'])) {
    // Retrieve the patient ID from the URL
    $patient_id = $_GET['id'];

    // Fetch patient data from the database based on the provided ID
    $sql = "SELECT * FROM patients WHERE id = '$patient_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch patient details
        $patient = mysqli_fetch_assoc($result);
    } else {
        // Redirect back to the admin panel if patient with the provided ID is not found
        header("Location: admin.php");
        exit(); // Stop further execution
    }
} else {
    // Redirect back to the admin panel if the ID parameter is not provided
    header("Location: admin.php");
    exit(); // Stop further execution
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Patient</h2>
        <form action="update_patient.php" method="POST">
            <input type="hidden" name="patient_id" value="<?php echo $patient['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $patient['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $patient['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Number</label>
                <input type="text" class="form-control" id="number" name="number" value="<?php echo $patient['number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $patient['date_of_birth']; ?>" required>
            </div>
            <!-- Include other input fields for editing patient information -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>

