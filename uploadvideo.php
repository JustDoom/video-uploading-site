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
$title = $_POST['title'];
$visibility = $_POST['visibility'];
$description = $_POST['description'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($title == "") {
  $uploadOk = 0;
}

// Check if file already exists (make sure the new one is still new)
if (checkIfExists($id, $conn)) {
  //TODO handle if id exists
}

if (!file_exists("uploads/$id")) {
  mkdir("uploads/$id", 0777, true);
  mkdir("uploads/$id/old", 0777, true);
}

$videoname = str_replace(" ", "-", $_FILES["fileToUpload"]["name"]);

$target_dir = "uploads/" . $id . "/";
$target_file = $target_dir . "old/" . basename($videoname);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$filename = str_replace(".$imageFileType", "", $videoname);

// Allow certain file formats
if( $imageFileType != "mov" && $imageFileType != "avi" && $imageFileType != "wmv"
    && $imageFileType != "mp4" && $imageFileType != "flv" ) {

    $uploadOk = 0;
}

// if everything is ok, try to upload file
if ($uploadOk == 1) {

  //If getting a sorry cannot upload do "chown -R www-data folder" in terminal
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "$target_file")) {

    // Run ffmpeg to convert file to mp4
    $command = "ffmpeg -i $target_file $target_dir$filename.mp4";
    system($command);

    rmdir("uploads/$id/old");

    $sql = "SELECT id FROM accounts WHERE username='$user'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      $userid = $row['id'];
    }

    $sql = "INSERT INTO videos (id, views, likes, dislikes, title, videofile, releasedate, authorid, visibility, description)
      VALUES ('$id', 0, 0, 0, '" . $title . "', '$filename.mp4', " . time() . ", '$userid', '$visibility', '$description')";

    if ($conn->query($sql) === TRUE) {
      // echo "New record created successfully";
    } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if(!unlink($target_file)){
      // echo "Unable to delete old file, please contact the owner at https://discord.gg/WjDCKBShME and report it along with the video id";
      return;
    }

  } else {
    //echo "Sorry, there was an error uploading your file.";
  }

  $conn->close();
}

function checkIfExists($id, $conn)
{
  $sql = "SELECT id FROM videos WHERE id='$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    return true;
  } else {
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
