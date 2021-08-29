<?php
if($_FILES['file']['name'] != ''){
  $test = explode('.', $_FILES['file']['name']);
  $extension = end($test);
  $name = rand(100,999).'.'.$extension;

  $location = 'pictures/'.$name;
  move_uploaded_file($_FILES['file']['tmp_name'], $location);

  echo '
    <video width="960" height="620" controls>
        <source src="';

  if($visibility == "private"){
    if($user == $author){
      echo $videofile;
    }
  } else {
    echo $videofile;
  }

  echo '" type="video/mp4">
        Your browser does not support the video tag.
    </video>';
}

move_uploaded_file (

// this is where the file is temporarily stored on the server when uploaded
// do not change this
  $_FILES['file']['tmp_name'],

  // this is where you want to put the file and what you want to name it
  // in this case we are putting in a directory called "uploads"
  // and giving it the original filename
  'pictures/' . $_FILES['file']['name']
);
?>
