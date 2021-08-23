<?php

include_once('settings.php');
include_once('header.php');

if (isset($_GET['video'])) {

  $id = $_GET['video'];

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM videos WHERE id='$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $videofile = "$domain/uploads/" . $id . "/" . $row["videofile"];
      $title = $row['title'];
      $releasedate = $row['releasedate'];
      $views = $row['views'];
      $likes = $row['likes'];
      $visibility = $row['visibility'];
      $authorid = $row['authorid'];

      $sql = "SELECT username FROM accounts WHERE id='" . $row['authorid'] . "'";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        $author = $row['username'];
      }

      if ($author == "") {
        $author = "Guest";
      }

      $sql = "UPDATE videos
              SET views = $views + 1
              WHERE id = '$id'";

      $conn->query($sql);
    }
  } else {
    echo "0 results";
  }
  # /?video=e
  $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title><?php echo $title; ?></title>
  <script src="likes.js"></script>
</head>
<body>

<video width="960" height="620" controls>
  <source src="<?php
  if($visibility == "private"){
    if($user == $author){
      echo $videofile;
    }
  } else {
    echo $videofile;
  }
  ?>" type="video/mp4">
  Your browser does not support the video tag.
</video>

<p><?php echo $title ?></p>
<p><?php echo date("Y-m-d h:i A", $releasedate) ?></p>
<p><?php echo $views ?></p>
<input type="submit" value="Like" name="like" id="like">
<?php echo "<p id='likes'>Likes: $likes</p>"; ?>
<p><?php echo "<a href='$domain/channel.php?channel=$authorid'>$author</a>" ?></p>

<?php
if ($author == $user) {
  echo '<form action="videosettings.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="' . $id . '">
        <input type="submit" value="Update Video" name="update">
      </form>';
  echo '<form action="deletevideo.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="' . $id . '">
        <input type="submit" value="Delete Video" name="delete">
      </form>';
}
?>

</body>

</html>
