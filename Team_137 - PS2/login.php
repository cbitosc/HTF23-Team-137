<?php
require 'config.php';
if(isset($_POST["submit"])){
    $usernameoremail = $_POST["usernameoremail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user_ WHERE username = '$usernameoremail' OR mail = '$usernameoremail'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    if(mysqli_num_rows($result)>0){
        if($password == $row["password"]){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: dash.php");
        }
        else{
            echo
            "<script> alert('Wrong Password'); </script>";
        }
    }
    else{
        echo
        "<script> alert('User not registered'); </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
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

.login{
    height: 100vh;
    width: 100vw;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
/* Style the form container */
form {
    height: 30%;
    width: 30%;
    margin: 0 auto;
    background-color: #fff;
    padding: 30px;
    text-align: left;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

/* Style form labels */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 16px;
}

/* Style form inputs */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Style the submit button */
button[type="submit"] {
    background-color: #007bff;
    position: relative;
    width: 100%;
    color: #fff;
    margin-top: 20px ;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Style the registration link */
a {
    text-decoration: none;
    color: #007bff;
    font-size: 16px;
}

a:hover {
    text-decoration: underline;
}

.doctor{
    position: absolute;
    top:50px;
    right: 20px;
    background-color: #007bff; /* Primary blue color */
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
.admin{
    position: absolute;
    top:50px;
    right:160px;
    background-color: #007bff; /* Primary blue color */
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

a{
    text-decoration: none;
    color: white;
}
    </style>
</head>
<body>
    <h2>Login Page</h2>
    <div class="login">
        <button class="doctor" href="">Doctor</button>
        <button class="admin" "><a href="admin.php"> Adimn </a></button>
        <form action="" method="post">
            <label for="usernameoremail">Username Or Email:</label>
            <input type="text" name="usernameoremail" id="usernameoremail"> <br>
            <label for="password">Password:</label>
            <input type="text" name="password" id="password"><br>
            <button type="submit" name="submit">Login</button>
        </form>
        <br>
        <a href="registration.php">Not yet registered? Register Here</a>
    </div>
</body>
</html>