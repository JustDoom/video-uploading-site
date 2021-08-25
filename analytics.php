<?php
include_once('header.php');
include_once('settings.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$lastWeekUploads = 0;
$lastDayUploads = 0;
$lastWeekAcc = 0;
$lastDayAcc = 0;

$sql = "SELECT * FROM videos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if($row['releasedate'] > time() - 604800){
      $lastWeekUploads += 1;
    }
    if($row['releasedate'] > time() - 86400){
      $lastDayUploads += 1;
    }
    $totalViews += $row['views'];
  }
  $totalVideos = $result->num_rows;
}

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if($row['joindate'] > time() - 604800){
      $lastWeekAcc += 1;
    }
    if($row['joindate'] > time() - 86400){
      $lastDayAcc += 1;
    }
  }
  $totalAcc = $result->num_rows;
}

echo "New videos last 24 hours: $lastDayUploads<br>";
echo "New videos last week: $lastWeekUploads<br>";
echo "Total videos: $totalVideos<br>";
echo "New accounts last 24 hours: $lastDayAcc<br>";
echo "New accounts last week: $lastWeekAcc<br>";
echo "Total accounts: $totalAcc<br>";

echo "Total Views: $totalViews";
