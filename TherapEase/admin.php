<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <!-- Include your custom CSS file -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <!-- Patient List Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection code
                include('incl/connection.php');

                // Fetch patient records from the database
                $sql = "SELECT * FROM patients";
                $result = mysqli_query($conn, $sql);

                // Check if records were fetched successfully
                if ($result) {
                    // Loop through each patient and display their details
                    while ($patient = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$patient['id']}</td>";
                        echo "<td>{$patient['name']}</td>";
                        echo "<td>{$patient['username']}</td>";
                        echo "<td>{$patient['email']}</td>";
                        echo "<td>{$patient['number']}</td>";
                        echo "<td>{$patient['date_of_birth']}</td>";
                        echo "<td>";
                        
                        echo "<a href='edit_patient.php?id={$patient['id']}' class='btn btn-primary'>Edit</a>";
                        echo "<a href='delete_patient.php?id={$patient['id']}' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this patient?')\">Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Handle database query error
                    echo "<tr><td colspan='7'>Error: " . mysqli_error($conn) . "</td></tr>";
                }

                
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        
        <!-- Add Patient Form -->
        <h2>Add New Patient</h2>
        <form action="add_patient.php" method="POST">
            <!-- Include form fields for adding a new patient -->
            <!-- Ensure proper input validation and sanitation -->
            <a href="logout.php" class="btn btn-warning">Logout</a>

            <!-- Include other input fields -->
            <button type="submit" class="btn btn-primary">Add Patient</button>
        </form>
    </div>
</body>
</html>
