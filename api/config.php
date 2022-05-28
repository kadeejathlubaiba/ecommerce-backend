<?php
$servername = "localhost";
$username = "kadeejath";
$password = "experion@123";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else
//   die("connection succes");
?>