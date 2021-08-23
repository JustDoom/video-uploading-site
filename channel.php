<?php
include_once('header.php');
include_once('settings.php');

$id = $_GET['channel'];
$totalviews = 0;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM accounts WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "Channel: " . $row['username'] . "<br>";
    echo "Videos: <br>";

    $sql = "SELECT * FROM videos WHERE authorid='$id' ORDER BY releasedate DESC";
    $result2 = $conn->query($sql);

    if ($result2->num_rows > 0) {
      while ($row2 = $result2->fetch_assoc()) {
        $totalviews += $row2['views'];
        if($row2['visibility'] == "unlisted" || $row2['visibility'] == "private") continue;
        echo '<a href="' . $domain . '/video.php?video=' . $row2['id'] . '">' . $row2['title'] . '</a> <br>';
      }
    } else {
      echo "0 results";
    }
    echo " Total Views: " . $totalviews;
  }
}
