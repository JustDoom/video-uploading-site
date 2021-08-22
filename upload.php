<!doctype html>
<html>

<body>
    <form action="uploadvideo.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" id="title" placeholder="Title" required maxlength="160"><br>
        <select name="visibility" id="visibility">
          <option value="public">Public</option>
          <option value="unlisted">Unlisted</option>
          <option value="private">Private</option>
        </select><br>
        Select video to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" accept="video/*">>
        <input type="submit" value="Upload Video" name="submit">
    </form>
</body>

</html>
