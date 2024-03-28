<div>
  <h2>All Patient Appointments</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Patient Name</th>
        <th class="text-center">Appointment Date and Time</th>
        <th class="text-center">Status</th>
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
    </tr>
    <?php
            $count++;
        }
      }
    ?>
  </table>

  <!-- Form to add a new appointment -->
  <form action="insert_appointment.php" method="post">
    
<script>
    
    document.getElementById("addAppointmentButton").addEventListener("click", function() {
       
        window.location.href = 'adminView/add_appointment.php';
    });
</script>
  <button onclick="window.location.href = 'adminView/add_appointment.php';" type="button">Add Appointment</button>
    

  </form>
</div>
