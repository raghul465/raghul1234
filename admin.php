<?php
// Check if the schedule form is submitted
if(isset($_POST["sch"])){
    insertAppointment();
}
function displayRequestedTests() {
    include "db.php";
    $sql = "SELECT patient, Name, phone FROM test WHERE Name NOT LIKE 'Dr%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["patient"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No requested tests found</td></tr>";
    }
    $conn->close();
}
function displayRequesteddoc() {
    include "db.php";
    $sql = "SELECT patient, Name, phone FROM test WHERE Name LIKE 'Dr%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["patient"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No requested tests found</td></tr>";
    }
    $conn->close();
}
function displaycomplaint() {
    include "db.php";
    $sql = "SELECT name, email, sub,complaint FROM comp";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["sub"] . "</td>";
            echo "<td>" . $row["complaint"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No complaint found</td></tr>";
    }
    $conn->close();
}
// Function to display scheduled appointments
function displayScheduledAppointmentstes() {
    include "db.php";
    $sql = "SELECT patient, Name, datetime FROM testbooked WHERE Name NOT LIKE 'Dr.%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["patient"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . date("d-m-Y h:i A", strtotime($row["datetime"])) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No scheduled appointments found</td></tr>";
    }
    $conn->close();
}
function displayScheduledAppointmentsdoc() {
    include "db.php";
    $sql = "SELECT patient, Name, datetime FROM testbooked where Name LIKE 'Dr.%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["patient"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . date("d-m-Y h:i A", strtotime($row["datetime"])) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No scheduled appointments found</td></tr>";
    }
    $conn->close();
}
// Function to insert appointment into the database
function insertAppointment() {
    include "db.php";
    $patientName = mysqli_real_escape_string($conn, $_POST["patientName"]);
    $appointmentType = mysqli_real_escape_string($conn, $_POST["appointmentType"]);
    $dateTime = $_POST["dateTime"];
    $sql = "INSERT INTO testbooked (patient, Name, datetime) VALUES ('$patientName', '$appointmentType', '$dateTime')"; 
    if(mysqli_query($conn, $sql)) {
        // Redirect back to the same page after insertion
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
     else {
        echo "<p>Error scheduling appointment: " . mysqli_error($conn) . "</p>";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            transition: background-color 0.5s ease;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin: 0;
            font-size: 2em;
        }
        section {
            padding: 20px;
            margin: 20px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        h2 {
            margin-top: 0;
            font-size: 1.5em;
            color: #333;
        }
        /* Form Styles */
        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        form input[type="text"],form input[type="datetime-local"],form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form input[type="submit"],.btn {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form input[type="submit"]:hover,.btn:hover {
            background-color: #0056b3;
        }
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        #appointments table tr td:first-child, #appointments table tr th:first-child {
            width: 35%; 
        }
        #appointments table tr td:nth-child(2),#appointments table tr th:nth-child(2) {
            width: 35%;
        }
        #appointments table tr td:nth-child(3),#appointments table tr th:nth-child(3) {
            width: 30%;
        }
        #complaint table tr td:first-child, #complaint table tr th:first-child {
            width: 25%; 
        }
        #complaint table tr td:nth-child(2),#complaint table tr th:nth-child(2) {
            width: 25%;
        }
        #complaint table tr td:nth-child(3),#complaint table tr th:nth-child(3) {
            width: 25%;
        }
        #complaint table tr td:nth-child(4),#complaint table tr th:nth-child(3) {
            width: 25%;
        }
        section:hover {
            cursor: pointer;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }       
        body:hover {
            background-color: #e6e6e6;
        }
        #tes{
            display: none;
        }
        #rep{
            resize: vertical;
            width: 100%;
            border: 1px solid rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <section id="dashboard">
        <h2>Today's Statistics</h2>
        <div class="statistics">
            <!-- Placeholder for statistics content -->
            <p id="req"></p>
            <p id="schedule"></p>
            <p id="pending"></p>
        </div>
    </section>
    <section id="appointments">
        <h2>Tests Requested</h2>
        <table id="reqappointmentsTabletes">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Test</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php displayRequestedTests();?>
            </tbody>
        </table>
    </section>
    <section id="appointments">
        <h2>Doctor Requested</h2>
        <table id="reqappointmentsTabledoc">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Doctor</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php displayRequesteddoc();?>
            </tbody>
        </table>
    </section>
    <section id="appointments">
        <h2>Schedule Appointment</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
            <label for="patientName">Patient Name:</label>
            <input type="text" id="patientName" name="patientName" required> 
            <div>
                <button type="button" id="doctorBtn" class="btn" onclick="showDoctorForm()">Doctor</button>
                <button type="button" id="testBtn" class="btn" onclick="showTestForm()">Test</button>
            </div><br>
            <input type="hidden" name="appointmentType" id="appointmentType" value="">
            <div id="doc">
                <label for="doctor">Doctor:</label>
                <select id="doctor" name="doctor" required>    
                    <option value="Dr. David (General)">Dr. Smith (General)</option>
                    <option value="Dr. Smith (Orthopaedic)">Dr. Smith (Orthopaedic)</option>
                    <option value="Dr. Johnson (Gastroenterology)">Dr. Johnson (Gastroenterology)</option>
                    <option value="Dr. Garcia (Ophthalmology)">Dr. Garcia (Ophthalmology)</option>
                    <option value="Dr. Patel (Psychiatry)">Dr. Patel (Psychiatry)</option>
                    <option value="Dr. Nguyen (ENT)">Dr. Nguyen (ENT)</option>
                    <option value="Dr. Lee (Plastic Surgery)">Dr. Lee (Plastic Surgery)</option>
                    <option value="Dr. Wilson (Pediatrics)">Dr. Wilson (Pediatrics)</option>
                    <option value="Dr. Clark (Pulmonology)">Dr. Clark (Pulmonology)</option>
                    <option value="Dr. Anderson (Vascular Surgery)">Dr. Anderson (Vascular Surgery)</option>
                    <option value="Dr. Martinez (Dentistry)">Dr. Martinez (Dentistry)</option>
                    <option value="Dr. Taylor (Dermatology)">Dr. Taylor (Dermatology)</option>
                    <option value="Dr. Baker (Gynecology)">Dr. Baker (Gynecology)</option>
                    <option value="Dr. Hill (Neurology)">Dr. Hill (Neurology)</option>
                    <option value="Dr. Green (Cardiology)">Dr. Green (Cardiology)</option>
                    <option value="Dr. Ramirez (Nephrology)">Dr. Ramirez (Nephrology)</option>
                </select>
            </div>
            <div id="tes">
                <label for="test">Test:</label>
                <select id="test" name="test" required>
                    <option value="Bone Density Test">Bone Density Test</option>
                    <option value="Colonoscopy">Colonoscopy</option>
                    <option value="CT Scan">CT Scan</option>
                    <option value="MRI Scan">MRI Scan</option>
                    <option value="Electrocardiogram (ECG)">Electrocardiogram (ECG)</option>
                    <option value="Ultrasound">Ultrasound</option>
                    <option value="X-ray">X-ray</option>
                    <option value="Blood Test">Blood Test</option>
                </select>
            </div>
            <label for="dateTime">Date & Time:</label>
            <input type="datetime-local" id="dateTime" name="dateTime" required>
            <input type="submit" name="sch" value="Schedule">
        </form>
    </section> 
    <section id="appointments">
        <h2>Appointments scheduled</h2>
        <table id="tabledoc">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php displayScheduledAppointmentsdoc();?>                    
            </tbody>
        </table>
        <table id="tabletes">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Test</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php displayScheduledAppointmentstes();?>                    
            </tbody>
        </table>
    </section>
    <section id="complaint">
        <h2>Complaints Filed</h2>
        <table id="complaintsTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>Complaint Description</th>
                </tr>
            </thead>
            <tbody>
                <?php displaycomplaint();?>
            </tbody>
        </table>    
    </section>
    <script>
        document.getElementById('doctor').addEventListener('change', function() {
            document.getElementById('appointmentType').value = this.value;
        });
        document.getElementById('test').addEventListener('change', function() {
            document.getElementById('appointmentType').value = this.value;
        });
        function showDoctorForm() {
            document.getElementById('doc').style.display = 'block';
            document.getElementById('tes').style.display = 'none';
            document.getElementById('appointmentType').value=document.getElementById('doctor').value;
        }   
        function showTestForm() {
            document.getElementById('tes').style.display = 'block';
            document.getElementById('doc').style.display = 'none';
            document.getElementById('appointmentType').value=document.getElementById('test').value;
        }
        window.onload = function() {
            // Calculate statistics based on the number of rows in tables
            var reqappointmentsTableDoc = document.getElementById('reqappointmentsTabledoc');
            var reqappointmentsTableTes = document.getElementById('reqappointmentsTabletes');
            var requestedAppointments = reqappointmentsTableDoc.rows.length + reqappointmentsTableTes.rows.length - 2;
            var scheduledAppointmentsTests = document.getElementById('tabletes').querySelectorAll('tbody tr').length;
            var scheduledAppointmentsDoctors = document.getElementById('tabledoc').querySelectorAll('tbody tr').length;
            var totalScheduledAppointments = scheduledAppointmentsTests + scheduledAppointmentsDoctors;
            // Update the statistics elements with the calculated values    
            document.getElementById('req').textContent = "Requested Appointments: " + (requestedAppointments > 0 ? requestedAppointments : 0);
            document.getElementById('schedule').textContent = "Scheduled Appointments: " + totalScheduledAppointments;
            document.getElementById('pending').textContent = "Pending Appointments: " + (requestedAppointments - totalScheduledAppointments > 0 ? requestedAppointments - totalScheduledAppointments : 0);
        };
        </script>
</body>
</html>