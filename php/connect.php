<?php
date_default_timezone_set('Asia/Manila');
$servername = "sql12.freesqldatabase.com";
$username = "sql12716743";
$password = "62ErRnmz1x";
$dbname = "sql12716743";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>