<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .notification-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            cursor: pointer;
        }

        .notification-dropdown {
            position: absolute;
            top: 50px;
            right: 20px;
            width: 300px;
            max-height: 400px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .notification-item {
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .mark-read {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .read {
            background-color: #f0f0f0; /* Lighter color for read notifications */
        }
        .header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}
    </style>
</head>
<body>
<div class="header">
<h1>Welcome to our website</h1>
<a href="logout.php">Logout</a>
<div class="notification-icon" onclick="toggleNotifications()">
    <i class="fa-solid fa-bell"></i>
    </div>
        <button onclick="toggleAppointments()">Show Appointments</button>
    </div>

<!---   notifications      --->

<div class="notification-icon" onclick="toggleNotifications()">
    <i class="fa-solid fa-bell"></i>
</div>
<div class="notification-dropdown" id="notificationDropdown">
<?php
session_start();

 // Include database connection
 include_once "inc/connections.php";
// Check if the user ID is set in the session
if (isset($_SESSION['id'])) {
    // Retrieve the user ID
   $user_id = $_SESSION['id'];
    
   // Query notifications and check if each one has been read by the user
    $sql = "SELECT notifications.id, notifications.title, notifications.content, notifications.start_date, notifications.end_date, notifications.isAdmin, user_notification_status.is_read
            FROM notifications
            LEFT JOIN user_notification_status ON notifications.id = user_notification_status.notifications_id AND user_notification_status.user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="notification-item <?php echo $row['isAdmin'] ? 'admin' : ''; ?> <?php echo $row['is_read'] ? 'read' : ''; ?>" data-id="<?php echo $row['id']; ?>">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['content']; ?></p>
                <p>Start Date: <?php echo $row['start_date']; ?></p>
                <p>End Date: <?php echo $row['end_date']; ?></p>
               
                <?php if (!$row['is_read']): ?>
                    <button class="mark-read" onclick="markAsRead(<?php echo $row['id']; ?>)">Mark as Read</button>
                <?php endif; ?>
            </div>

            <?php
        }
    } else {
        echo "No notifications found in database";
    }
} else {
    // If user ID is not set in the session, redirect them to the login page
    header("Location: login.php");
    exit(); // Make sure to exit after redirection
}
?>
</div>
<!---   Appointements      --->

<div class="appointments" id="appointmentsSection" style="display: none;">
<?php
// Include database connection
include_once "inc/connections.php";

// Check if the user ID is set in the session
if (isset($_SESSION['id'])) {
    // Retrieve the user ID
    $user_id = $_SESSION['id'];

    // Query appointments for the logged-in user
    $sql_appointments = "SELECT appointments.patient_name, appointments.appointment_date 
                        FROM appointments 
                        INNER JOIN users ON appointments.user_id = users.id 
                        WHERE users.id = $user_id";

    $result_appointments = $conn->query($sql_appointments);

    if ($result_appointments && $result_appointments->num_rows > 0) {
        // Appointments found, display them
        while ($row = $result_appointments->fetch_assoc()) {
            ?>
            <div class="appointment-item">
                <h3>Appointment Date and Time: <?php echo isset($row['appointment_date']) ? $row['appointment_date'] : 'N/A'; ?></h3>
            </div>
            <?php
        }
    } else {
        echo "No appointments found for you.";
    }
} else {
    // If user ID is not set in the session, redirect them to the login page
    header("Location: login.php");
    exit(); 
}
?>
</div>

<script>
    function toggleNotifications() {
        var dropdown = document.getElementById('notificationDropdown');
        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    }

    function toggleAppointments() {
        var appointmentsSection = document.getElementById('appointmentsSection');
        if (appointmentsSection.style.display === 'none') {
            appointmentsSection.style.display = 'block';
        } else {
            appointmentsSection.style.display = 'none';
        }
    }

    function markAsRead(id) {
        var notificationItem = document.querySelector('.notification-item[data-id="' + id + '"]');
        if (notificationItem) {
            notificationItem.classList.add('read');

            // Send an AJAX request to mark the notification as read in the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'mark_as_read.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log(xhr.responseText); 
                    if (xhr.status === 200) {
                        // Notification marked as read
                        // Hide the "Mark as Read" button and change its color
                        var markReadButton = notificationItem.querySelector('.mark-read');
                        if (markReadButton) {
                            markReadButton.style.display = 'none';
                        }
                    } else {
                        // Handle error
                    }
                }
            };
            xhr.send('id=' + id);
        }
    }
</script>


</body>
</html>