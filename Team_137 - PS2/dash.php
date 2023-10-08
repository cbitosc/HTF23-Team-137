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
    echo '<script>var appointmentData = ' . json_encode($data) . ';</script>';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
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

/* Header styles */
header {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Container styles */
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    position: relative;
}

/* Dashboard header styles */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

/* Profile styles */
.profile {
    text-align: left;
    display: flex;
    align-items: center;
}

.profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-color: #ddd;
    margin-right: 20px;
}

.profile-details {
    text-align: left;
}

.profile-name {
    font-size: 24px;
    margin-bottom: 5px;
}

.profile-age {
    font-size: 16px;
    color: #777;
}

/* Appointments styles */
.appointments {
    margin-top: 60px;
    text-decoration: underline solid transparent;
}

.appointment {
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #fff;
    border-radius: 5px;
}

/* Prescriptions styles */
.prescriptions {
    margin-top: 40px;
}
.appointments h2::after {
    content: "";
    display: block;
    width: 100%;
    height: 1px;
    background-color: gray;
    margin-top: 10px; 
}

.prescriptions h2::after {
    content: "";
    display: block;
    width: 100%;
    height: 1px;
    background-color: gray;
    margin-top: 10px; 
}

.prescription {
    border: 1px solid #ddd;
    background-color: greenyellow;
    padding: 40px;
    margin-top: 20px;
    margin-bottom: 10px;    
    border-radius: 5px;
    text-align: center;
    font-size: 25px;
    font-weight: bolder;
    color: black;
    cursor: pointer;
}

.prescription:hover{
    background-color: #1e7e34;
    color: white;
}
.Treatments h2::after {
    content: "";
    display: block;
    width: 100%;
    height: 1px;
    background-color: gray;
    margin-top: 10px; 
}

.Treatment {
    border: 1px solid #ddd;
    background-color: lightblue;
    padding: 40px;
    margin-top: 20px;
    margin-bottom: 10px;    
    border-radius: 5px;
    text-align: center;
    font-size: 25px;
    font-weight: bolder;
    color: black;
    cursor: pointer;
}

.Treatment:hover{
    background-color: blue;
    color: white;
}

.prescription button {
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
a{
    text-decoration: none;
    color: black;
}

.prescription button:hover {
    background-color: #1e7e34; /* Change the hover color to a darker green */
    transform: scale(1.05);
}

    </style>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
  
    <header>
        <h1>Patient Dashboard</h1>
        <!-- Create a navigation bar using an unordered list -->
        <nav class="navbar">
        
            <a class="book-appointment-button" href="apntmnt.php">Book Appointment</a>
            
        </nav>
    </header>
    <div class="container">
        <!-- Menu icon to open the menu -->
        
        <div class="dashboard-header">
            <div class="profile">
                <div class="profile-image"></div>
                <div class="profile-details">
                    <div class="profile-name"><?php echo $_SESSION['username']?></div>
                    <div class="profile-age">Age: 40</div>
                </div>
            </div>
        </div>
        <div class="appointments" id="appointments">
            <h2>Upcoming Appointments</h2>
        </div>
        <div class="prescriptions">
            <h2>Prescriptions</h2>
            <div class="prescription">
                <a href="data.php">
                    Presctption & Files(X-rays, Scans, effect)
                </a>
            </div>
        </div>  
        <div class="Treatments">
            <h2>Prescriptions</h2>
            <div class="Treatment">
                <a href="treatment.html">
                    Treatment Planner & Evaluator
                </a>
            </div>
        </div>  
    </div>
    
</body>

<script>
        // JavaScript code
        $(document).ready(function () {
            var cardContainer = $("#appointments");

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
</html>
