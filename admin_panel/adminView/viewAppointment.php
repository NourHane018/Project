<div>
  <h2>All Patient Appointments</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">Patient Name</th>
        <th class="text-left">Appointment Date and Time</th>
        <th class="text-left">Status</th>
        <th class="text-left">Actions</th> <!-- New column for the delete button -->
      </tr>
    </thead>
    <?php
        include_once "../inc/connections.php";

        $sql = "SELECT * FROM appointments";
        $result = $conn->query($sql);
        $count = 1;
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["patient_name"]?></td>
      <td><?=$row["appointment_date"]?></td>
      <td><?=$row["status"]?></td>
      <td>
        <!-- Button to delete appointment -->
        <a href="adminView/delete_appointment.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</a>
      </td>
    </tr>
    <?php
            $count++;
          }
        }
    ?>
  </table>

  <!-- Form to add a new appointment -->
  <a href="adminView/add_appointment.php" style=" display: inline-block;
    padding: 10px 20px;
    background-color: #50C878;
    color: white;
    text-decoration: none;
    border-radius: 5px;">Add New Appointment</a>
</div>
