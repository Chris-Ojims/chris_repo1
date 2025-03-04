<?php
require 'miniproj_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = password_hash($_POST['pswd'], PASSWORD_BCRYPT);

    // Confirm if email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO:: FETCH_ASSOC);

    if ($user) {
    // Update password
    $stmt = $pdo->prepare("UPDATE users SET password = :pswd WHERE email = :email");
    if ($stmt->execute(['pswd' => $new_password, 'email' => $email])) {
        echo "<script>alert('Password updated successfully! Please log in.'); window.location='miniproj_login.html';</script>";       
    } else {
        echo "<script>alert('Failed to update password! Please try again.'); window.location='miniproj_resetpswd.html';</script>";
    } else {
        echo "<script>alert('Email not found!'); window.location='miniproj_resetpswd.html';</script>";
    }
    }
}


?>