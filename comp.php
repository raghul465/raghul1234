<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
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
    include "db.php";
    $name = $_POST["fullName"];
    $email = $_POST["email"];
    $subject = $_POST["cat"];
    $complaint = $_POST["complaint"];
    $sql="INSERT INTO comp (name,email,sub,complaint) VALUES ('$name','$email','$subject','$complaint')";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="output">';
        echo '<h2>Complaint Details</h2>';
        echo '<p><strong>Patient Name:</strong> ' . $name . '</p>';
        echo '<p><strong>Email:</strong> ' . $email . '</p>';
        echo '<p><strong>Category:</strong> ' . $subject . '</p>';
        echo '<p><strong>Phone Number:</strong> ' . $complaint . '</p>';
        echo '</div>';
        echo '<script>document.getElementById("complaintForm").reset();</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    ?>
</div>
</body>
</html>
