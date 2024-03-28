<div>
  <h2>All Customers</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Username</th>
        <th class="text-center">Email</th>
        <th class="text-center">Birthday Date</th>
        <th class="text-center">Gender</th>
        <th class="text-center">Actions</th> 
      </tr>
    </thead>
    <?php
      // Include database connection
      include_once "../inc/connections.php";
      // Fetch data from database
      $sql = "SELECT * FROM users WHERE isAdmin = 0";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["id"]?></td>
      <td><?=$row["username"]?></td>
      <td><?=$row["email"]?></td>
      <td><?=$row["birthday"]?></td>
      <td><?=$row["gender"]?></td>
      <td>
        <a href="adminView/edit_patient.php?id=<?=$row['id']?>">Edit</a> | 
        <a href="adminView/delete_patient.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</a>
      </td>
    </tr>
    <?php
        }
      } else {
        echo "<tr><td colspan='6'>No patients found</td></tr>";
      }
    ?>
  </table>
  <a href="adminView/add_patiente.php">Add New Patient</a> 
</div>
