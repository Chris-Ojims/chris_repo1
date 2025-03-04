<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproj_db";

// Create connection to the database
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
}
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>
