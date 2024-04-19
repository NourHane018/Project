<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    
    <title>Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            padding: 0;
        }
        h2 {
            margin-bottom: 20px;
        }
        .advertisement-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .advertisement {
            width: calc(33.33% - 20px);
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .advertisement:hover {
            transform: translateY(-5px);
        }
        .advertisement h3 {
            margin-top: 0;
            color: #333;
        }
        .advertisement p {
            color: #666;
        }
        .advertisement-actions {
            margin-top: 15px;
            text-align: center;
        }
        .advertisement-actions a {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 5px;
            border: 1px solid #007bff;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .advertisement-actions a:hover {
            background-color: #0056b3;
        }
        .add-advertisement-button {
            margin-top: 20px;
            text-align: center;
        }
        .add-advertisement-button a {
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .add-advertisement-button a:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>Notifications</h2>

<div class="advertisement-container">
    <?php
    // Include database connection
    include_once "../inc/connections.php";

    // Retrieve advertisements from database
    $sql = "SELECT * FROM notifications";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="advertisement">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['content']; ?></p>
                <p>Start Date: <?php echo date('Y-m-d', strtotime($row['start_date'])); ?></p>
                <p>End Date: <?php echo date('Y-m-d', strtotime($row['end_date'])); ?></p>
                <div class="advertisement-actions">
                    <a href="adminView/edit_notification.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="adminView/delete_notification.php?id=<?php echo $row['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this notification?')">Delete</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No notifications found.";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
</div>

<div class="add-advertisement-button">
    <a href="adminView/add_notification.php">Add New Notification</a>
</div>

</body>
</html>
