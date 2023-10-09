<?php
require 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function readData() {
    global $conn;
    $sql = "SELECT * FROM tb_admin";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Status</th></tr>';
        
        while ($row = $result->fetch_assoc()) {
            $status = ($row["present"] == 0) ? "Present" : "Absent";
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["doctor"] . "</td><td>" . $status . "</td></tr>";
        }
        
        echo '</table>';
    } else {
        echo "No records found";
    }
}

function addRow($name) {
    global $conn;
    $status = 1;
    $sql = "INSERT INTO tb_admin (doctor) VALUES ('$name')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function updateStatus($id, $status) {
    global $conn;
    $sql = "UPDATE tb_admin SET present = $status WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["read"])) {
        readData();
    } elseif (isset($_POST["add"]) && isset($_POST["name"])) {
        $name = $_POST["name"];
        addRow($name);
    } elseif (isset($_POST["update"]) && isset($_POST["id"]) && isset($_POST["status"])) {
        $id = $_POST["id"];
        $status = $_POST["status"];
        updateStatus($id, $status);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Doctor Data</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("bg.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }

        .card {
            background-color: #fff;
            width: 80vw;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin: 20px auto;
            width: 50%;
            text-align: left;
        }

        label, input, input[type="submit"] {
            display: block;
            margin: 10px 0;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row label {
            flex: 1;
            margin-right: 10px;
            text-align: right;
        }

        .form-row input {
            flex: 2;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Manage Doctor Data</h1>

        <!-- Read Data -->
        <?php readData(); ?>

        <!-- Add New Row -->
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <input type="submit" name="add" value="Add New Row">
        </form>

        <!-- Update (1/0) Column -->
        <form method="post">
            <div class="form-row">
                <label for="id">ID:</label>
                <input type="number" name="id" required>
            </div>
            <div class="form-row">
                <label for="status">Status (1 or 0):</label>
                <input type="number" name="status" min="0" max="1" required>
            </div>
            <input type="submit" name="update" value="Update Status">
        </form>
    </div>
</body>
</html>
