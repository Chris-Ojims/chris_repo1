<?php
session_start();
require 'miniproj_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pswd = password_hash($_POST['pswd'], PASSWORD_BCRYPT);
    // $confirm_pswd = password_hash($_POST['com_pswd'], PASSWORD_BCRYPT);
    
    // Insert into the database
    $sql = "INSERT INTO users (full_name, email, username, pswd) VALUES (:full_name, :email, :username, :pswd)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['full_name' => $name, 'email' => $email, 'username' => $username, 'pswd' => $pswd])) {
        echo "<script>alert('Registration successful! Redirecting to login...'); window.location='miniproj_login.html';</script>";
    } else {
        echo "<script>alert('Registration failed! Try again.');</script>";
    }
}

// Form Validation Section:
// Initialize variables
// $name = $email = $password = "";
// $nameErr = $emailErr = $passwordErr = "";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Validate name
//     if (empty($_POST['name'])) {
//         $nameErr = "Name is required.";
//     } else {
//         $name = testInput($_POST['name']);
//         if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
//             $nameErr = "Only letters and spaces are allowed.";
//         }
//     }

//     // Validate email
//     if (empty($_POST['email'])) {
//         $emailErr = "Email is required.";
//     } else {
//         $email = testInput($_POST['email']);
//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $emailErr = "Invalid email format.";
//         }
//     }

//     // Validate password
//     if (empty($_POST['password'])) {
//         $passwordErr = "Password is required.";
//     } else {
//         $password = testInput($_POST['password']);
//         if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{7,}$/", $password)) {
//             $passwordErr = "Password must be at least 7 characters, include a capital letter, a number, and a special character.";
//         }

//     // My added condition
//    if (preg_match("/^[a-zA-Z\d\W_]{8,}$/", $pswd)) {
//     echo "Form submitted successfully!";
//    }

//     }
// }

// // Function to sanitize input
// function testInput($data) {
//     return htmlspecialchars(stripslashes(trim($data)));
// }

?>