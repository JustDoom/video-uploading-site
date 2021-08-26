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
        <textarea id="description" placeholder="Description" maxlength="1500" rows = "5" cols = "60" name = "description" style="resize: none"></textarea><br>
        Select video to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" accept="video/*">>
        <input type="submit" value="Upload Video" name="submit">
    </form>
</body>

</html>
