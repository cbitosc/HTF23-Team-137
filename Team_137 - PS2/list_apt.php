<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Data</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Center align the card */
        body {
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
            height: 40%;
            width: 50%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            background-color: #fff;
        }

        /* Style the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card">
            <h2>Appointment Data</h2>

            <!-- Display appointment data in a table -->
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Symptoms</th>
                        <th>Appointment Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'config.php';

                    $doctorName = $_SESSION['doctor'];
                    $result = "SELECT * FROM tb_apntmnt_ WHERE doctorName = '$doctorName'";
                    $query = mysqli_query($conn, $result);

                    while($row = mysqli_fetch_assoc($query)){
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['age'] . '</td>';
                        
                        // Convert numeric gender value to label
                        $genderLabel = '';
                        switch ($row['gender']) {
                            case 1:
                                $genderLabel = 'Male';
                                break;
                            case 2:
                                $genderLabel = 'Female';
                                break;
                            case 3:
                                $genderLabel = 'Other';
                                break;
                            case 4:
                                $genderLabel = 'Prefer not to say';
                                break;
                            default:
                                $genderLabel = 'Unknown';
                        }
                        echo '<td>' . $genderLabel . '</td>';
                        
                        echo '<td>' . $row['symptoms'] . '</td>';
                        echo '<td>' . $row['appointmentTime'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
