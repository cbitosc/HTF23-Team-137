<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Cards</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="card-container">Hello</div>

    <?php
    require 'config.php';


    $username = $_SESSION["username"];

    $query = "SELECT * FROM tb_apntmnt_ WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'doctor' => $row['doctorName'],
            'time' => $row['appointmentTime'],
            'age' => $row['age']
        );
    }

    // Return the data as JSON
    echo '<script>var appointmentData = ' . json_encode($data) . ';</script>';
    ?>

    <script>
        // JavaScript code
        $(document).ready(function () {
            var cardContainer = $("#card-container");

            // Iterate through the data and create cards
            appointmentData.forEach(function (row) {
                var card = $("<div>").addClass("appointment");

                // Format the date
                // var date = new Date(row.date);
                // var formattedDate = date.toLocaleDateString("en-US", { year: 'numeric', month: 'long', day: 'numeric' });

                // Populate the card content with data from the row
                card.html(`
                    <p><strong>Doctor:</strong> ${row.doctor}</p>
                    <p><strong>Date:</strong> ${row.age}</p>
                    <p><strong>Time:</strong> ${row.time}</p>
                `);

                cardContainer.append(card);
            });
        });
    </script>
</body>
</html>
