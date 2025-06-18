<?php
require 'miniproj_dbconnect.php';

$email = $password = $confirm_pswd = "";
$emailErr = $passwordErr = $confirmErr = $successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['pswd'];
    $confirm_pswd = $_POST['confirm_pswd'];

    $valid = true;

    // Email validation
    if (empty($email)) {
        $emailErr = "Email is required.";
        $valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
        $valid = false;
    }

    // Password strength validation
    if (empty($password)) {
        $passwordErr = "Password is required.";
        $valid = false;
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{7,}$/", $password)) {
        $passwordErr = "Password must be at least 7 characters and include uppercase, lowercase, number, and special character.";
        $valid = false;
    }

    // Confirm password validation
    if (empty($confirm_pswd)) {
        $confirmErr = "Please confirm your password.";
        $valid = false;
    } elseif ($password !== $confirm_pswd) {
        $confirmErr = "Passwords do not match.";
        $valid = false;
    }

    // If everything is valid, update the password
    if ($valid) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $update = $pdo->prepare("UPDATE users SET pswd = :pswd WHERE email = :email");

            if ($update->execute(['pswd' => $hashed, 'email' => $email])) {
                $successMsg = "Password updated successfully! <a href='miniproj_login.html'>Login now</a>";
                // Clear form
                $email = $password = $confirm_pswd = "";
            } else {
                $emailErr = "Failed to update password. Try again.";
            }
        } else {
            $emailErr = "Email not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        .form-box {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        .success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
        }

        label {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form method="post" class="form-box" action="miniproj_resetpswd.php">
        <h2>Reset Password</h2>

        <?php if ($successMsg): ?>
            <p class="success"><?php echo $successMsg; ?></p>
        <?php endif; ?>

        <label for="email"><b>Email:</b></label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your registered email">
        <span class="error"><?php echo $emailErr; ?></span>

        <label for="pswd"><b>New Password:</b></label>
        <input type="password" name="pswd" placeholder="Enter new password">
        <span class="error"><?php echo $passwordErr; ?></span>

        <label for="confirm_pswd"><b>Confirm Password:</b></label>
        <input type="password" name="confirm_pswd" placeholder="Re-enter new password">
        <span class="error"><?php echo $confirmErr; ?></span>

        <br><br>
        <button type="submit">Update Password</button>
    </form>

    <p style="text-align: center;"><a href="miniproj_login.html">Back to Login</a></p>
</body>
</html>
