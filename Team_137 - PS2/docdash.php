<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Dashboard</title>
    <style>
        /* Reset some default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Apply styles to the body for background and font */
        body {
            background-image: url("bg.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }

        /* Style the dashboard container */
        .dashboard {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        /* Style the profile container */
        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #ddd;
            margin-right: 20px;
        }

        .doctor-details {
            flex-grow: 1;
        }

        /* Style the doctor's name */
        .doctor-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            text-align: left;
        }

        /* Style the doctor's designation */
        .designation {
            font-size: 18px;
            color: #777;
            text-align: left;
        }

        /* Style the "List of Appointments" button */
        .appointments-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px; /* Adjust padding to make the button smaller */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px; /* Reduce font size */
            text-decoration: none;
            margin-top: 10px; /* Reduce top margin */
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .appointments-button:hover {
            background-color: #0056b3;
        }

        /* Style the file upload input */
        .file-upload {
            font-size: 16px;
            margin-top: 10px; /* Reduce top margin */
            display: block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        /* Style the submit button */
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px; /* Adjust padding to make the button smaller */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px; /* Reduce font size */
            margin-top: 10px; /* Reduce top margin */
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="profile">
            <div class="profile-image"></div>
            <div class="doctor-details">
                <div class="doctor-name"><?php echo $_SESSION['doctor'];?></div>
                <div class="designation">Genral Physician</div>
            </div>
        </div>
        <h3>UPCOMING APPOINTMENTS</h3>
        <a href="list_apt.php" class="appointments-button">List of Appointments</a>
        <a href="upload.php" class="appointments-button">Upload files</a>
       
    </div>
</body>
</html>
