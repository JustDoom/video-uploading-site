<?php
  include_once("header.php");

  $id = $_POST['id'];

  echo $id;
?>

<html>
<body>
<form action="updatevideosettings.php" method="post" enctype="multipart/form-data">
  Title: <input type="text" name="title" id="title" placeholder="Title" required maxlength="160"><br>
  <select name="visibility" id="visibility">
    <option value="public">Public</option>
    <option value="unlisted">Unlisted</option>
    <option value="private">Private</option>
  </select><br>
  <?php
  echo '<input type="hidden" id="id" name="id" value="' . $id . '">';
  ?>
  <input type="submit" value="Save" name="submit">
</form>
</body>
</html>
