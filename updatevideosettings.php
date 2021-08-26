<?php
/**
 * @var string $servername
 * @var string $username
 * @var string $password
 * @var string $dbname
 * @var string $domain
 */
include_once('settings.php');

/**
 * @var string $user
 */
include_once('header.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$id = $_POST['id'];
$visibility = $_POST['visibility'];


$sql = "UPDATE videos
        SET title = '$title', visibility = '$visibility'
        WHERE id='$id'";

$conn->query($sql);

$conn->close();
