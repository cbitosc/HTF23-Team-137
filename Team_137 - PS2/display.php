<?php
include 'connect.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
<button class="btn btn-primary my-5"><a href="user.php"class="text-light">Add user</a>

</button>
<table class="table">
  <thead>
    <tr>
      <th scope="col">PatientID</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">AppointmentDate</th>
      <th scope="col">AppointmentTime</th>
      <th scope="col">Symptoms</th>
      <th scope="col">DoctorName</th>
    </tr>
  </thead>
  <tbody>
    <?php

$sql = "select * from `patientappointments`";
$result = mysqli_query($con , $sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $PatientID = $row['PatientID'];
        $Name = $row['Name'];
        $Age = $row['Age'];
        $AppointmentDate = $row['AppointmentDate'];
        $AppointmentTime = substr($row['AppointmentTime'], 0, 5); 
        $Symptoms = $row['Symptoms'];
        $DoctorName =$row ['DoctorName'] ;
        echo '<tr>
        <th scope="row">'.$PatientID.'</th>
        <td>'.$Name.'</td>
        <td>'.$Age.'</td>
        <td>'.$AppointmentDate.'</td>
        <td>'.$AppointmentTime.'</td>
        <td>'.$Symptoms.'</td>
        <td>'.$DoctorName.'</td>
      </tr>';
    }

}
    ?>
  </tbody>
</table>
</div>

</body>
</html>