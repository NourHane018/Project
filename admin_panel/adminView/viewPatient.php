<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Event handler for deleting a patient
    $('.delete-patient').click(function(e){
        e.preventDefault();
        var patientId = $(this).data('id');
        
        // Display confirmation dialog
        var confirmation = confirm('Are you sure you want to delete this patient?');
        
        // If user confirms deletion
        if (confirmation) {
            $.ajax({
                type: 'GET',
                url: 'adminView/delete_patient.php?id=' + patientId,
                success: function(response){
                    $('#row_' + patientId).remove();
                    // alert('Patient deleted successfully.');
                },
                error: function(xhr, status, error){
                    alert('Error occurred while deleting patient.');
                    console.error(error);
                }
            });
        }
    });
    // Event handler for approving a pending registration
    $('.approve-registration').click(function(e){
        e.preventDefault();
        var registrationId = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'adminView/approve.php?id=' + registrationId,
            success: function(response){
                $('#row_' + registrationId).remove();
                alert('Patient approved successfully.');
            },
            error: function(xhr, status, error){
                alert('Error occurred while approving registration.');
                console.error(error);
            }
        });
    });
});
</script>

<!-- Table in your HTML -->
<div>
  <h2>Pending Registrations</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">Username</th>
        <th class="text-left">Email</th>
        <th class="text-left">Birthday Date</th>
        <th class="text-left">Gender</th>
        <th class="text-left">Actions</th> 
      </tr>
    </thead>
    <?php
        // Include database connection
        include_once "../inc/connections.php";
        // Fetch pending registrations from database
        $sql = "SELECT * FROM users WHERE status='pending'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr id='row_{$row['id']}'>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['birthday']}</td>";
                echo "<td>{$row['gender']}</td>";
                echo "<td><a href='#' class='approve-registration' data-id='{$row['id']}'>Approve</a> | <a href='#' class='delete-patient' data-id='{$row['id']}'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No pending registrations</td></tr>";
        }
      ?>

  </table>
</div>

<div>
  <h2>All Patients</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">Username</th>
        <th class="text-left">Email</th>
        <th class="text-left">Birthday Date</th>
        <th class="text-left">Gender</th>
        <th class="text-center">Actions</th> 
      </tr>
    </thead>
    <?php
      // Fetch data from database for approved patients
      $sql = "SELECT * FROM users WHERE status='approved'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr id='row_{$row['id']}'>";
          echo "<td>{$row['id']}</td>";
          echo "<td>{$row['username']}</td>";
          echo "<td>{$row['email']}</td>";
          echo "<td>{$row['birthday']}</td>";
          echo "<td>{$row['gender']}</td>";
          echo "<td>";
          echo "<a href='adminView/edit_patient.php?id={$row['id']}' style='display: inline-block; padding: 10px 20px; background-color: #89CFF0; color: white; text-decoration: none; border-radius: 5px;'>Edit</a> |";
          echo "<a href='#' class='delete-patient' data-id='{$row['id']}' style='display: inline-block; padding: 10px 20px; background-color: #FF3131; color: white; text-decoration: none; border-radius: 5px;'>Delete</a>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6'>No patients found</td></tr>";
      }
    ?>
  </table>
  <a href="adminView/add_patiente.php" style="display: inline-block; padding: 10px 20px; background-color: #50C878; color: white; text-decoration: none; border-radius: 5px;">Add New Patient</a>
</div>