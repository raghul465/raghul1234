<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .output {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .output h2 {
            color: #007bff;
            margin-bottom: 10px;
        }
        .output p {
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Assuming you have already established a database connection
    if(isset($_POST["sub"])){
        // Insert the data into the database
        include "db.php";
        $patientName=$_POST["name"];
        $reqName=$_POST["test"];
        $mobileNumber=$_POST["ph"];
        $sql = "INSERT INTO test (patient, Name, phone) VALUES ('$patientName', '$reqName', '$mobileNumber')"; 
        if ($conn->query($sql) === TRUE) {
            echo '<div class="output">';
            if($_POST["req"]=="Test"){
                echo '<h2>Test Request Details</h2>';
                echo '<p><strong>Patient Name:</strong> ' . $patientName . '</p>';
                echo '<p><strong>Test Name:</strong> ' . $reqName . '</p>';
            }
            if($_POST["req"]=="Doc"){
                echo '<h2>Appoinment Request Details</h2>';
                echo '<p><strong>Patient Name:</strong> ' . $patientName . '</p>';
                echo '<p><strong>Doctor Name:</strong> ' . $reqName . '</p>';
            }
            
            echo '<p><strong>Phone Number:</strong> ' . $mobileNumber . '</p>';
            echo '</div>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    else{
        echo "Invalid,the form is not submitted";
    }
    ?>
</div>
</body>
</html>
