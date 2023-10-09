<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $Name = $_POST['name'];
    $Age = $_POST['age'];
    $AppointmentDate = $_POST['AppointmentDate'];
    $AppointmentTime = $_POST['AppointmentTime'];
    $Symptoms = $_POST['Symptoms'];
    $DoctorName = $_POST['DoctorName'];

    $sql = "INSERT INTO `patientappointments` (Name, Age, AppointmentDate, AppointmentTime, Symptoms,DoctorName)
    VALUES ('$Name', '$Age', '$AppointmentDate', '$AppointmentTime', '$Symptoms','$DoctorName')";

    $result = mysqli_query($con,$sql);
    if($result){
        header('location:display.php');
    }else{
        die(mysqli_error($con));
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Crud operation </title>
  </head>

  <body>
    <div class="container my-5">
    <form method="post">
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" placeholder="Enter your name " name ="name" autocomplete="off">
    
  <div class="form-group">
    <label>Age</label>
    <input type="text" class="form-control" placeholder="Enter your age " name ="age" autocomplete="off">
    
  <div class="form-group">
    <label>Appointment Date</label>
    <input type="text" class="form-control" placeholder="Enter the Appointment Date " name ="AppointmentDate" autocomplete="off">
    
  <div class="form-group">
    <label>Appointment Time</label>
    <input type="text" class="form-control" placeholder="Enter the Appointment Time " name ="AppointmentTime" autocomplete="off">
    
  <div class="form-group">
    <label>Symptoms</label>
    <input type="text" class="form-control" placeholder="Enter the Symptoms " name ="Symptoms" autocomplete="off">

    <div class="form-group">
    <label>DoctorName</label>
    <input type="text" class="form-control" placeholder="Enter Doctor's Name" name="DoctorName" autocomplete="off">

    </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
    
  </body>
</html>