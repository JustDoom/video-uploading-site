<?php

include_once('settings.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM videos WHERE id='" . $_POST['id'] . "'";

$conn->query($sql);

echo "Video deleted";

$conn->close();