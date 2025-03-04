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
