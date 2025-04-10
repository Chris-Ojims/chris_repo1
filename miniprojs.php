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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        * body {
            margin-top: -2px;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 40px;
            box-sizing: border-box;
            /* background-color: azure; */
        }

        .header {
            position: relative;
            height: 25px;
            margin-top: -50px;
            background-color: #9e9696d3;
            opacity: 0.6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 500px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        }

        .favicon > img {
            width: 20px;
            height: 20px;
            margin-left: 10px;
            margin-bottom: -33px;
            align-content: space-around;
        }

        .refresh img {
            margin-top: 10px;
            margin-left: 835px;
            margin-bottom: 26px;
            width: 15xp;
            height: 15px;
        }

        .favicon-search img {
            padding-top: 4px;
            margin-left: -266px;
        }

        .search-box input {
            /* margin-top: 20px; */
            width: 400px;
            margin-left: -50px;
            text-align: center;
        }

        .search-box input:hover {
           cursor: pointer;
        }

        .header-nav img {
            width: 16px;
            height: 16px;
            margin-top: 5px;
            margin-left: 325px;
        }

        .header-nav img:hover{
            cursor: pointer;
        }

        .image img {
            margin-top: -35px;
            width: 740px;
            /* height: 570px; */
            margin-bottom: 25px;
        }

        .Regform {
            /* margin-top: -550px; */
            margin-top: -520px;
            /* margin-left: 805px; */
            margin-left: 770px;
            background-color: azure;
        }

        .Regform h2 {
            font-family: 'Courier New', Courier, monospace;
            font-size: 30px;
        }

        .Regform button {
            width: 90px;
            border-radius: 10px;
            color: white;
            background-color: darksalmon;
        }

        .Regform button:hover {
            cursor: pointer;
            background-color: green;
        }

        .form-box > input {
            border-radius: 8px;
        }

        .form-box > input:hover {
            cursor: pointer;
            background-color: bisque;
        }

        .error {
            color: red;
        }

        /* Mobile View section */
        @media (max-width: 768px) {

            .image img {
                display: none;
            }

            .Regform {
                position: relative;
                margin-top: -55px;
                margin-left: 0px;
            }

            .header-nav img {
                position: inherit;
                margin-left: 100px;
            }

            .header {
            position: sticky;
            height: 25px;
            width: 0px;
            margin-top: -50px;
            background-color: #9e9696d3;
            opacity: 0.6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 300px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        }

        .search-box input {
            width: 220px;
            margin-left: -50px;
            text-align: center;
        }

        .favicon-search img {
            padding-top: 4px;
            margin-left: -173px;
        }

        .refresh img {
            margin-top: 10px;
            margin-left: 455px;
            margin-bottom: 26px;
            width: 15xp;
            height: 15px;
        }

        }
    </style>
</head>

<body>
    <section class="container">
        <div class="favicon">
            <img src="Images/favicon (5).ico" alt="">
            <img src="Images/favicon (4).ico" alt="">
            <img src="Images/favicon (6).ico" alt="">
        </div>
        <div class="refresh">
            <img src="Images/refresh-3104.png" alt="">
        </div>
        <header class="header">
            <div class="search-box">
                <input type="text" value="kriscross.com">
            </div>
            <div class="favicon-search">
                <img src="Images/favicon.ico" alt="">
            </div>
            <nav class="header-nav">
                <img src="Images/square-image.png" alt="">
                <!-- <a href="#symbol">+</a> -->
            </nav>

        </header><br><br>

        <div class="image">
            <img src="Images/gesture_admin5.jpg" alt="">
        </div>

        <div class="Regform">
            <h2>Sign Up</h2>
            <form method="POST" action="">
    <div class="form-box">
        <label for="name"><b>Full Name:</b></label><br>
        <input type="text" id="name" name="full_name" value="<?php echo $name; ?>" required><br>
        <span class="error"><?php echo $nameErr; ?></span><br><br>

        <label for="email"><b>Email:</b></label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>
        <span class="error"><?php echo $emailErr; ?></span><br><br>

        <label for="username"><b>Username:</b></label><br>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required><br>
        <span class="error"><?php echo $usernameErr; ?></span><br><br>

        <label for="password"><b>Password:</b></label><br>
        <input type="password" id="password" name="pswd" required><br>
        <span class="error"><?php echo $pswdErr; ?></span><br><br>

        <label for="confirm_pswd"><b>Confirm Password:</b></label><br>
        <input type="password" id="confirm_pswd" name="com_pswd" required><br>
        <span class="error"><?php echo $confirm_pswdErr; ?></span><br><br>

        <input type="checkbox" id="terms" name="terms" required> I agree to the Terms of Use<br><br>

        <button type="submit">Submit</button>
        <a href="miniproj_login.html">Login</a>
    </div>
</form>

    </section>

</body>

</html>