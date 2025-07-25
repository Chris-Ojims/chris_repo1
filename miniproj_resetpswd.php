
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET PASSWORD</title>

    <style>
      .form-box { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; }

        body {
            text-align: center;
            box-sizing: border-box;
            background-color: darkgrey;        }

        p {
            /* margin-top: -70px; */
            margin-top: -80px;
        }

        form {
            max-width: 500px;
            /* height: 220px; */
            height: 320px;
            margin: 0 auto;
            padding: 20px;
            background-color: bisque;
            box-shadow: 0 0 10px rgb(0, 0, 0, 0.1);
        }

        .form-box > input {
            border-radius: 7px;
        }

        .form-box > input:hover {
            cursor: pointer;
            background-color: aquamarine;
        }

        .form-box button {
            border-radius: 7px;
            color: white;
            background-color: darkgrey;
        }

        .form-box button:hover {
            cursor: pointer;
            background-color: green;
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

    </style>
</head>
<body>
    <h2>Forgot Password?</h2>
    <form action="miniproj_resetpswd.php" method="post" class="form-box">
        <h2>Reset Password</h2>

        <?php if ($successMsg): ?>
            <p class="success"><?php echo $successMsg; ?></p>
        <?php endif; ?>

        <label for="email"><b>Email:</b></label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your registered email">
        <span class="error"><?php echo $emailErr; ?></span><br><br>

        <label for="pswd"><b>New Password:</b></label><br>
        <input type="password" name="pswd" placeholder="Enter new password">
        <span class="error"><?php echo $passwordErr; ?></span><br><br>

        <label for="confirm_pswd"><b>Confirm Password:</b></label><br>
        <input type="password" name="confirm_pswd" placeholder="Re-enter new password">
        <span class="error"><?php echo $confirmErr; ?></span><br><br>

        <button type="submit">Update Password</button>
    </form>
    <br><br>
    <p style="text-align: center;"><a href="miniproj_login.html">Back to Login</a></p>

</body>
</html>