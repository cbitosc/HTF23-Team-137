<?php
require 'config.php';

// Retrieve doctor names from tb_admin table
$doctorNames = array();
if (!$conn->connect_error) {
    $sql = "SELECT DISTINCT doctor FROM tb_admin";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $doctorNames[] = $row["doctor"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Buttons</title>
    <!-- Add your CSS styles here, if needed -->
    <style>
        /* Center align the card */
        body{
            background-image: url("bg.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }
        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Style the card */
        .card {
            width: 40%;
            height: 30%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            background-color: #fff;
        }

        /* Style the text inside the card */
        .card-text {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Style the button container */
        .button-container {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Style the buttons */
        .doctor-button {
            margin: 5px;
            padding: 10px 20px;
            border: 2px solid #007bff;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
        }
        
        a{
            text-decoration: none;
            color: white;
        }

        .doctor-button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<body>
    <div class="card-container">
        <div class="card">
            <div class="card-text">Who are you?</div>
            <div class="button-container">
                <?php
                // Generate buttons for each doctor's name
                foreach ($doctorNames as $doctorName) {
                    $_SESSION['doctor'] = $doctorName;
                    echo '<button class="doctor-button" onclick="selectDoctor(\' ' . $doctorName . '\')"><a href="docdash.php">' . $doctorName . '</a></button>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- JavaScript function to handle button click -->
    <script>
        function selectDoctor(doctorName) {
            // Redirect to a page or perform an action with the selected doctorName
            // You can use JavaScript to navigate or submit data as needed.
            // window.location.href = 'appointment.php?doctor=' + encodeURIComponent(doctorName);
            // Or, you can set a hidden input field value and submit a form with the selected doctorName.
            // document.getElementById('selectedDoctor').value = doctorName;
            // document.getElementById('form').submit();
        }
    </script>
</body>
</html>
