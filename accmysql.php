<?php
include_once("settings.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
/**$sql = "CREATE DATABASE accounts";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}**/

$sql = "CREATE TABLE IF NOT EXISTS accounts (
    id VARCHAR(100) NOT NULL PRIMARY KEY,
    email VARCHAR(320) NOT NULL,
    pass VARCHAR(70) NOT NULL,
    username VARCHAR(70) NOT NULL,
    joindate INT NOT NULL
    )";

/**$sql = "ALTER TABLE accounts
  ADD joindate INT NOT NULL";**/
    
if ($conn->query($sql) === TRUE) {
  echo "Table videos created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
