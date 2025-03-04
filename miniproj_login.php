<?php
session_start();
require 'miniproj_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pswd'];

    // Fetch User details
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");

    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['pswd'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        header("Location: miniproj_dashboard.php");
        exit;
    } else {
        echo "<script>alert('Invalid email or password!'); window.location='miniproj_login.html';</script>";
    }
}

?>