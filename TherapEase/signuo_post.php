<?php
session_start();

include('incl/connection.php'); // Include your database connection file

if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit(); // Stop further execution
}

if (isset($_POST["submit"])) {
    $name = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $password = $_POST["password"];
    $date_of_birth = $_POST["date_of_birth"];

    $errors = array();

    if (empty($name) || empty($username) || empty($email) || empty($number) || empty($password) || empty($date_of_birth)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeat_password"];
        if ($password !== $repeatPassword) {
            echo '<div class="alert alert-danger" role="alert">Passwords do not match!</div>';
        } else {
            // Proceed with registration process
            // Your registration logic here
        }
    }

    // Check if email or username already exists in the database
    $check_email_query = "SELECT * FROM patients WHERE email = '$email'";
    $check_username_query = "SELECT * FROM patients WHERE username = '$username'";
    $check_email_result = mysqli_query($conn, $check_email_query);
    $check_username_result = mysqli_query($conn, $check_username_query);
    if (!$check_email_result || !$check_username_result) {
        die("Database query failed."); // Handle query error
    }
    $num_email_rows = mysqli_num_rows($check_email_result);
    $num_username_rows = mysqli_num_rows($check_username_result);
    if ($num_email_rows > 0) {
        array_push($errors, "Email already exists");
    }
    if ($num_username_rows > 0) {
        array_push($errors, "Username already exists");
    }

    if (empty($errors)) {
        // Hash the password
       

        // Insert user data into the database
        $insert_query = "INSERT INTO patients (name, username, email, number, password, date_of_birth) VALUES ('$name', '$username', '$email', '$number', '$password', '$date_of_birth')";
        $insert_result = mysqli_query($conn, $insert_query);
        if ($insert_result) {
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Registration failed. Please try again later.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            display: block;
            margin: 0 auto;
            width: 100px; /* Adjust width as needed */
            height: auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-btn {
            text-align: center;
        }
        .form-group p {
            text-align: center;
        }
        .form-group p a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
        <img class="logo" src="LogoC.png" alt="Your Logo">
    <div class="container">
        <form action="signuo_post.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="number" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <p>Already Registered? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
