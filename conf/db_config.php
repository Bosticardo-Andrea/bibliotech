<?php
$servername = "localhost";
$username = "nihnyian_admin";
$password = "Bibliotech5Arob";
$dbname = "nihnyian_libreria";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>