<?php
// Include database connection
include_once "../inc/connections.php";

// Check if advertisement ID is provided in the URL
if(isset($_GET['id'])) {
    $advertisement_id = $_GET['id'];

    // Retrieve advertisement details from the database
    $sql = "SELECT * FROM advertisements WHERE id = $advertisement_id";
    $result = mysqli_query($conn, $sql);

    // Check if the advertisement exists
    if(mysqli_num_rows($result) > 0) {
        $advertisement = mysqli_fetch_assoc($result);
    } else {
        echo "Advertisement not found.";
        exit;
    }
} else {
    echo "Advertisement ID not provided.";
    exit;
}

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve advertisement details from the form submission
    $title = $_POST['title'];
    $content = $_POST['content'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Update the advertisement in the database
    $sql = "UPDATE advertisements SET title = '$title', content = '$content', start_date = '$start_date', end_date = '$end_date' WHERE id = $advertisement_id";
    if(mysqli_query($conn, $sql)) {
        echo "Advertisement updated successfully.";
    } else {
        echo "Error updating advertisement: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Advertisement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

<h2>Edit Advertisement</h2>

<form method="post">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="<?php echo $advertisement['title']; ?>"><br>
    <label for="content">Content:</label><br>
    <textarea id="content" name="content"><?php echo $advertisement['content']; ?></textarea><br>
    <label for="start_date">Start Date:</label><br>
    <input type="date" id="start_date" name="start_date" value="<?php echo $advertisement['start_date']; ?>"><br>
    <label for="end_date">End Date:</label><br>
    <input type="date" id="end_date" name="end_date" value="<?php echo $advertisement['end_date']; ?>"><br><br>
    <button type="submit">Update Advertisement</button>
    <a href="../admin.php" >Back</a>
</form>



</body>

</html>
