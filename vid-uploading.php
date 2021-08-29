<?php
/*$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
  echo "ERROR: Please browse for a file before clicking the upload button.";
  exit();
}
if(move_uploaded_file($fileTmpLoc, "test_uploads/$fileName")){
  echo "$fileName upload is complete";
} else {
  echo "move_uploaded_file function failed";
}*/
//echo 'pspsp';

if($_FILES['video']['name'] != ''){
  $test = explode('.', $_FILES['video']['name']);
  $extension = 'mov';//end($test);
  $name = rand(100,999).'.'.$extension;

  $location = 'uploads/_Isaac/'.$name;
  move_uploaded_file($_FILES['video']['tmp_name'], $location);

  echo '<img src="'.$location.'" height="100" width="100" />';
}

move_uploaded_file(

// this is where the file is temporarily stored on the server when uploaded
// do not change this
  $_FILES['video']['tmp_name'],

  // this is where you want to put the file and what you want to name it
  // in this case we are putting in a directory called "uploads"
  // and giving it the original filename
  'uploads/_Isaac/' . $_FILES['video']['name']
);




?>

