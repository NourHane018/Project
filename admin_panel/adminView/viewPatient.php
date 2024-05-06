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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Table in your HTML -->
<style>
    .add-notification-button {
            margin-top: 20px;
            text-align: center;
        }
        .add-notification-button a {
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            background-color: #5dadc4;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .add-notification-button a:hover {
            background-color: #315467;
        }
        .delete-patient{
          text-decoration: none;
          color:#5dadc4;
        }
        

</style>
<div>
  <h2 style=" 
            color:#315467;
            text-align: center;
        ">Pending Registrations</h2>
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
                echo "<td><a href='#' class='approve-registration delete-patient' data-id='{$row['id']}'>Approve</a> | <a href='#' class='delete-patient' data-id='{$row['id']}'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No pending registrations</td></tr>";
        }
      ?>

  </table>
</div>

<div>

  <h2 style=" 
            color:#315467;
            text-align: center;
        ">All Patients</h2>
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
  <div class="add-notification-button">
  <a href="adminView/add_patiente.php" >Add New Patient</a>
  </div>
  
</div>
