<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$basename = "projekt"; // Replace with your database name

// Create connection
$dbc = mysqli_connect($servername, $username, $password, $basename) or die('Error connecting to MySQL server.'.mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");

// Check connection
if (!$dbc) {
    die('Error connecting to MySQL server: ' . mysqli_connect_error());
}

// Remove the following line to stop printing the message
// echo "Connected successfully to MySQL server.";
?>
