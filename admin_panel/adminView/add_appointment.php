<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h2>Add New Appointment</h2>
    <label for="patient_name">Patient Name:</label>
    <input type="text" id="patient_name" name="patient_name" required><br><br>
    
    <label for="appointment_datetime">Appointment Date and Time:</label>
    <input type="datetime-local" id="appointment_datetime" name="appointment_datetime" required><br><br>
    
    <button onclick="addAppointment()">Add Appointment</button>

    <div id="result"></div>

    <script>

        
        function addAppointment() {
            var patientName = document.getElementById('patient_name').value;
            var appointmentDatetime = document.getElementById('appointment_datetime').value;

          
            var xhr = new XMLHttpRequest();

           
            xhr.open('POST', 'insert_appointment.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

          
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                     document.getElementById('result').textContent = xhr.responseText;
                } else {
                    document.getElementById('result').textContent = 'Error: ' + xhr.statusText;
                }
            };

           
            xhr.onerror = function() {
                document.getElementById('result').textContent = 'Request failed';
            };

          
            xhr.send('patient_name=' + encodeURIComponent(patientName) + '&appointment_datetime=' + encodeURIComponent(appointmentDatetime));
        }
    </script>
    <button onclick="goBack()">Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
