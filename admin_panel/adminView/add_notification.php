<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

<h2>Add New Notifications </h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" ><br><br>
    
    <label for="content">Content:</label>
    <textarea id="content" name="content" ></textarea><br><br>
    
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" ><br><br>
    
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" ><br><br>
    <button type="submit" name="submit">Add Notification</button>
    <a href="../admin.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 5px;">Back</a>


    
</form>

<hr>


<?php
// Include database connection
include_once "../inc/connections.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Insert advertisement into database
    $sql = "INSERT INTO notifications (title, content, start_date, end_date) 
            VALUES ('$title', '$content', '$start_date', '$end_date')";

    if (mysqli_query($conn, $sql)) {
        echo "Advertisement added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


</body>
</html>
