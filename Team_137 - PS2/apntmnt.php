<?php
require 'config.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $symptoms = $_POST["symptoms"];
    $doctor = $_POST["doctor"];
    $time = $_POST["time"];

    if ($conn->connect_error) {
        echo "Connection Error";
    } else {
        $username = $_SESSION['username'];
        $query = "INSERT INTO tb_apntmnt_ VALUES('', '$name', '$age', '$gender', '$symptoms', '$doctor', '$time', '$username')";
        mysqli_query($conn, $query);
        echo "<script>alert('Appointment Booked Successfully');</script>";
    }
}
function getPresentDoctors() {
    global $conn;
    $sql = "SELECT DISTINCT doctor FROM tb_admin WHERE present = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["doctor"] . '">' . $row["doctor"] . '</option>';
        }
    } else {
        echo '<option value="" disabled>No doctors available</option>';
    }
}

$existingTimes = array(); // Initialize an empty array to store existing times

if (isset($_POST["doctor"])) {
    $selectedDoctor = mysqli_real_escape_string($conn, $_POST['doctor']); // Get selected doctor
    $query = "SELECT appointmentTime FROM tb_apntmnt_ WHERE doctorName = '$selectedDoctor'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $existingTimes[] = $row["appointmentTime"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
</head>

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

    /* Style the form container */
    /* Center the form horizontally and vertically on the page */
    form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 60vh; /* Ensure the form takes the full height of the viewport */
    }

    /* Style the header container */
    header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px 0;
        margin-bottom: 20px;
        overflow: auto; /* Add overflow to clear floats */
    }

    /* Style the h1 element within the header */
    header h1 {
        font-size: 24px;
        margin: 0;
    }

    /* Style the navigation bar */
    nav {
        float: right; /* Float the navigation bar to the right */
        margin-top: 10px; /* Add some top margin for spacing */
    }

    /* Style navigation links */
    nav a {
        color: #fff;
        text-decoration: none;
        padding: 5px 10px;
    }

    /* Style form labels */
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Style form inputs and select */
    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Style submit button */
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Style time slot container */
    #timeSlotContainer {
        margin-top: 10px;
    }

    /* Style time slot options */
    #timeSlotContainer button {
        padding: 10px 20px;
        margin: 10px;
        border: 2px solid gray;
        border-radius: 10px;
        background-color: #fff;
        color: #333;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
    }

    #timeSlotContainer button:focus {
        background-color: greenyellow;
        border-color: #333;
    }

    #timeSlotContainer button:hover {
        background-color: #007bff;
        color: #fff;
        border-color: #0056b3;
    }

    /* Style time slot options */
    time-slot {
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease-in-out;
    }

    .time-slot:hover {
        background-color: #0056b3;
    }

    /* Add some spacing to form elements */
    br {
        margin-top: 10px;
    }

    /* Optional: Style form element labels for better alignment */
    /* You can customize these styles further */
    #name-label,
    #age-label,
    #gender-label,
    #symptoms-label,
    #doctorSelect-label {
        font-size: 18px;
        color: #333;
        font-weight: bold;
        margin-top: 15px;
    }
</style>

<body>
    <h2>Book an Appointment</h2>

    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"> <br>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age"> <br>
        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="1">Male</option>
            <option value="2">Female</option>
            <option value="3">Other</option>
            <option value="4">Prefer not to say</option>
        </select><br>
        <label for="symptoms">Symptoms:</label>
        <input type="text" name="symptoms" id="symptoms"> <br>
        <label for="doctor">Doctor Name:</label>
        <select name="doctor" id="doctorSelect" onchange="generateTimeSlots()">
            <?php getPresentDoctors(); ?>
        </select>
        <br>
        <div id="timeSlotContainer">
            <!-- Time slots will be inserted here -->
        </div>
        <br>
        <input type="hidden" name="time" id="selectedTimeInput"> <!-- Hidden input field to store the selected time -->
        <input type="submit" name="submit" value="Submit">
    </form>

    <script>
        let selectedTimeValue = ''; // Variable to store the selected time slot value
        const allowedTimes = ["9:00", "9:30", "10:00", "10:30", "11:00", "11:30"]; // Array of allowed times

        function generateTimeSlots() {
            const doctorSelect = document.getElementById("doctorSelect");
            const timeSlotContainer = document.getElementById("timeSlotContainer");

            // Clear existing time slots
            timeSlotContainer.innerHTML = "";

            // Retrieve existing times from PHP
            const existingTimes = <?php echo json_encode($existingTimes); ?>;

            // Generate and display available time slots
            allowedTimes.forEach(time => {
                if (!existingTimes.includes(time)) {
                    const timeSlotButton = document.createElement("button");
                    timeSlotButton.textContent = time;
                    timeSlotButton.setAttribute("class", "time_btn");
                    timeSlotButton.setAttribute("value", time);
                    timeSlotButton.setAttribute("type", "button"); // Prevents form submission
                    timeSlotButton.addEventListener("click", function () {
                        // Store the selected time slot value in the variable
                        selectedTimeValue = time;
                        updateSelectedTimeInput();
                    });
                    timeSlotContainer.appendChild(timeSlotButton);
                }
            });
        }

        function updateSelectedTimeInput() {
            const selectedTimeInput = document.getElementById("selectedTimeInput");
            selectedTimeInput.value = selectedTimeValue;
        }
    </script>
</body>
</html>
