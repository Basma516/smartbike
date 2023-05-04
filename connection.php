<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "smartbike";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("" . $conn->connect_error);
}
?>

