<?php
session_start();
require 'miniproj_dbconnect.php';

// Initialize variables
$name = $email = $username = $pswd = $confirm_pswd = "";
$nameErr = $emailErr = $usernameErr = $pswdErr = $confirm_pswdErr = "";
$hasError = false;

// Function to sanitize input
function testInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name validation
    if (empty($_POST['full_name'])) {
        $nameErr = "Name is required.";
        $hasError = true;
    } else {
        $name = testInput($_POST['full_name']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and spaces allowed.";
            $hasError = true;
        }
    }

    // Email validation
    if (empty($_POST['email'])) {
        $emailErr = "Email is required.";
        $hasError = true;
    } else {
        $email = testInput($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
            $hasError = true;
        }
    }

    // Username validation
    if (empty($_POST['username'])) {
        $usernameErr = "Username is required.";
        $hasError = true;
    } else {
        $username = testInput($_POST['username']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $usernameErr = "Only letters and spaces allowed.";
            $hasError = true;
        }
    }

    // Password validation
    if (empty($_POST['pswd'])) {
        $pswdErr = "Password is required.";
        $hasError = true;
    } else {
        $pswd = $_POST['pswd'];
        if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{7,}$/", $pswd)) {
            $pswdErr = "Password must be at least 7 characters, include uppercase, lowercase, number, and special character.";
            $hasError = true;
        }
    }

    // Confirm password validation
    if (empty($_POST['com_pswd'])) {
        $confirm_pswdErr = "Please confirm your password.";
        $hasError = true;
    } else {
        $confirm_pswd = $_POST['com_pswd'];
        if ($pswd !== $confirm_pswd) {
            $confirm_pswdErr = "Passwords do not match.";
            $hasError = true;
        }
    }

    // If no validation errors, insert into database
    if (!$hasError) {
        $hashedPassword = password_hash($pswd, PASSWORD_BCRYPT);

        try {
            // Check if email already exists
            $checkEmail = $pdo->prepare("SELECT email FROM users WHERE email = :email");
            $checkEmail->execute(['email' => $email]);

            if ($checkEmail->rowCount() > 0) {
                $emailErr = "Email already exists!";
            } else {
                $sql = "INSERT INTO users (full_name, email, username, pswd) 
                        VALUES (:full_name, :email, :username, :pswd)";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([
                    'full_name' => $name,
                    'email' => $email,
                    'username' => $username,
                    'pswd' => $hashedPassword
                ])) {
                    header("Location: miniproj_login.html");
                    exit();
                } else {
                    echo "<script>alert('Registration failed! Try again.');</script>";
                }
            }
        } catch (PDOException $e) {
            echo "<script>alert('Database error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
}
?>
