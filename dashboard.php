<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
    <p>You are logged in successfully.</p>
    <a href="logout.php">Logout</a>

</body>
</html>