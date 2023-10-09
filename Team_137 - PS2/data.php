<?php
require 'config.php';
$username = $_SESSION['username'];
$query = "SELECT * FROM tb_upload_ WHERE patient = '$username'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Apply styles to the body for background and font */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        /* Style the table */
        .data-table {
            position: relative;
            top: 200px;
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        /* Style table headers */
        .data-table th {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: left;
        }

        /* Style table rows */
        .data-table tr {
            border-bottom: 1px solid #ddd;
        }

        /* Style table cells */
        .data-table td {
            padding: 10px;
        }

        .data-table tr td:last-child{
          text-align: center;
        }

        /* Alternate row background color for better readability */
        .data-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
  </head>
  <body>
    <table border = 1 cellspacing = 0 cellpadding = 10 class="data-table">
      <tr>
        <td>S.No.</td>
        <td>File Name</td>
        <td>Download File</td>
      </tr>
      <?php
      $i = 1;
      // $rows = mysqli_query($conn, "SELECT * FROM tb_upload_ ORDER BY id DESC")
      ?>

      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        // Check if the patient matches the logged-in user
        if ($row["patient"] == $username) {
            echo '<tr>';
            echo '<td>' . $i++ . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            
            // Check if a file exists and provide a download link
            if (!empty($row['file'])) {
                echo '<td><a href="file/' . $row['file'] . '" target="_blank"><button>Download</button></a></td>';
            } else {
                echo '<td>No file available</td>';
            }
            
            echo '</tr>';
        }
    }
      ?>
  </body>
</html>