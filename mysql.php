<?php
/**
 * @var string $servername
 * @var string $username
 * @var string $password
 * @var string $dbname
 * @var string $domain
 */
include_once("settings.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
/**$sql = "CREATE DATABASE videos";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}**/

/**$sql = "CREATE TABLE IF NOT EXISTS videos (
    id VARCHAR(100) NOT NULL PRIMARY KEY,
    views INT NOT NULL,
    likes INT NOT NULL,
    dislikes INT NOT NULL,
    title VARCHAR(160) NOT NULL,
    videofile VARCHAR(360) NOT NULL,
    releasedate INT NOT NULL
    )";**/

$sql = "CREATE TABLE IF NOT EXISTS likes (
  videoid VARCHAR(100) NOT NULL PRIMARY KEY,
  userid VARCHAR(100) NOT NULL
  )";

$sql = "ALTER TABLE videos
  ADD visibility VARCHAR(10) NOT NULL";

if ($conn->query($sql) === TRUE) {
  echo "Table videos created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
