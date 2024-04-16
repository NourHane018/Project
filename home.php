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
    </style>
</head>
<body>

<h1>Welcome to our website</h1>
<a href="logout.php">Logout</a>

<div class="notification-icon" onclick="toggleNotifications()">
    <i class="fa-solid fa-bell"></i>
</div>

<div class="notification-dropdown" id="notificationDropdown">
    <!-- Notifications -->
    <?php

 include_once "inc/connections.php";

 $sql = "SELECT title, content, start_date, end_date, isAdmin FROM advertisements"; 
 $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           $advertisements = array();
        while($row = $result->fetch_assoc()) {
    $advertisements[] = $row;
  }
 } else {
  echo "No advertisements found in database"; 
 }
 foreach ($advertisements as $advertisement): ?>

   <div class="notification-item">
        <h3><?php echo $advertisement['title']; ?></h3>
        <p><?php echo $advertisement['content']; ?></p>
        <p>Start Date: <?php echo $advertisement['start_date']; ?></p>
        <p>End Date: <?php echo $advertisement['end_date']; ?></p>
        </div>
 <?php endforeach; ?>

</div>
<!-- JavaScript -->
<script>
    function toggleNotifications() {
        var dropdown = document.getElementById('notificationDropdown');
        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    }
</script>

</body>
</html>
