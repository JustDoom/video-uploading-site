<?php

/**
 * @var string $servername
 * @var string $username
 * @var string $password
 * @var string $dbname
 * @var string $domain
 */
include_once('settings.php');

session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  // redirect to your login page
  //exit();
}

$user = $_SESSION['username'];

$uploadOk = 1;

// Check if image file is an actual image or fake image
/**if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}**/

$id = generateRandomString();
$visibility = $_POST['visibility'];
$description = $_POST['description'];

echo $description;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_POST['title'] == "") {
  echo "no title";
  $uploadOk = 0;
}

// Check if file already exists (make sure the new one is still new)
$id = generateRandomString();
if (checkIfExists($id, $conn)) {
  echo "existststststs";
}

if (!file_exists("uploads/$id")) {
  mkdir("uploads/$id", 0777, true);
}

$videoname = str_replace(" ", "-", $_FILES["fileToUpload"]["name"]);

$target_dir = "uploads/" . $id . "/";
$target_file = $target_dir . basename($videoname);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Allow certain file formats
if (
  $imageFileType != "mov" && $imageFileType != "avi" && $imageFileType != "wmv"
  && $imageFileType != "mp4" && $imageFileType != "flv"
) {
  echo "Sorry, only MP4, MOV, AVI, FLV and WMV files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file

  echo $videoname;
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    //$command = "C:/FFmpeg/bin/ffmpeg -i $target_file $target_dir$videoname.mp4";
    //system($command);

    $sql = "SELECT id FROM accounts WHERE username='$user'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      $userid = $row['id'];
    }

    $sql = "INSERT INTO videos (id, views, likes, dislikes, title, videofile, releasedate, authorid, visibility, description)
      VALUES ('$id', 0, 0, 0, '" . $_POST['title'] . "', '" . $videoname . "', " . time() . ", '$userid', '$visibility', '$description')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    echo "The file " . htmlspecialchars(basename($videoname)) . " has been uploaded. <br>";
    echo "<a href='$domain/video?video=$id'>$videoname</a>";

    //header("Location: $domain/video?video=$id");
    //exit();
  } else {
    echo "Sorry, there was an error uploading your file.";
  }

  $conn->close();
}

function checkIfExists($id, $conn)
{
  $sql = "SELECT id FROM videos WHERE id='$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "resultdewffsf";
    return true;
  } else {
    echo "0 results";
    return false;
  }
}

function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
