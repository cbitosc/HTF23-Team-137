<?php
require 'config.php';

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $c_password = $_POST["c_password"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user_ WHERE username = '$username' OR mail = '$email'");
    if($password == $c_password){
        $query = "INSERT INTO tb_user_ VALUES('','$name', '$username', '$email', '$password')";
        mysqli_query($conn, $query);
        $last_id = $conn->insert_id;
        $result = mysqli_query($conn, "SELECT username FROM tb_user_ WHERE id='$last_id'");
        $row = mysqli_fetch_assoc($result);
        $latestUsername = $row['username'];
        $_SESSION['username'] = $latestUsername;
        echo
        "<script> alert('Registration Completed');
        document.location.href = 'dash.php';
        </script>";

    }
    else{
        echo
        "<script> alert('Password Doesn't match'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        * {
            
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url("bg.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }

        form {
            height: 65%;
            width: 30%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: left;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            padding-top: 25px;
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .reg{
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        button[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            margin-top: 10px;
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

        a {
            text-decoration: none;
            padding: 20px;
            color: brown    ;
            font-weight: bolder;
            font-size: 35px;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }



    </style>
</head>
<body>
    <h2>Registration</h2>
    <div class="reg">
        <form action="" method="post" autocomplete="off">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required value=""><br>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required value=""><br>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required value=""><br>
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" required value=""><br>
            <label for="c_password">Confirm Password:</label>
            <input type="text" name="c_password" id="c_password" required value=""><br>
            <button type="submit" name="submit">  Register </button>
        </form>
        <a href="login.php">Already Registered? Login Here</a>
    
    </div>
</body>
</html>