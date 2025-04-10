<?php
require 'miniproj_dbconnect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    // $phone = $_POST['phone'];
    // $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password

    try {
        // Check if email already exists
        $checkEmail = $pdo->prepare("SELECT email FROM users WHERE email = :email");
        $checkEmail->execute(['email' => $email]);

        if ($checkEmail->rowCount() > 0) {
            echo "<script>alert('Email already exists! Please use a different email.'); window.history.back();</script>";
            exit();
        }

        // Insert into database
        $sql = "INSERT INTO users (full_name, email, username, password) VALUES (:full_name, :email, :username, :password)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute(['full_name' => $name, 'email' => $email, 'username' => $username, 'password' => $password])) {
            echo "<script>alert('Registration successful! Redirecting to login...'); window.location='login.html';</script>";
        } else {
            echo "<script>alert('Registration failed! Try again.'); window.history.back();</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database error: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
    }
}
?>
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
