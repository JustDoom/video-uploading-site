<!doctype html>
<html>
<head>
  <script>
    /* Script written by Adam Khoury @ DevelopPHP.com */
    /* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
    function _(el){
      return document.getElementById(el);
    }
    function uploadFile(){
      var file = _("fileToUpload").files[0];
      var title = document.getElementById("title");
      var description = document.getElementById("description");
      var visibility = document.getElementById("visibility");
      console.log(title.value);
      // alert(file.name+" | "+file.size+" | "+file.type);
      var formdata = new FormData();
      formdata.append("fileToUpload", file);
      formdata.append("title", title);
      formdata.append("description", description);
      formdata.append("visibility", visibility);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler, false);
      ajax.addEventListener("load", completeHandler, false);
      ajax.addEventListener("error", errorHandler, false);
      ajax.addEventListener("abort", abortHandler, false);
      ajax.open("POST", "uploadvideo.php");
      ajax.send(formdata);
    }
    function progressHandler(event){
      _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
      var percent = (event.loaded / event.total) * 100;
      _("progressBar").value = Math.round(percent);
      _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
    }
    function completeHandler(event){
      _("status").innerHTML = event.target.responseText;
      _("progressBar").value = 0;
    }
    function errorHandler(event){
      _("status").innerHTML = "Upload Failed";
    }
    function abortHandler(event){
      _("status").innerHTML = "Upload Aborted";
    }
  </script>
</head>
<body>
    <form method="post" enctype="multipart/form-data" id="upload_form">
        <input type="text" name="title" id="title" placeholder="Title" required maxlength="160"><br>
        <select name="visibility" id="visibility">
          <option value="public">Public</option>
          <option value="unlisted">Unlisted</option>
          <option value="private">Private</option>
        </select><br>
        <textarea id="description" placeholder="Description" maxlength="1500" rows = "5" cols = "60" name = "description" style="resize: none"></textarea><br>
        Select video to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" accept="video/*">>
        <input type="submit" value="Upload Video" name="submit" onclick="uploadFile()">

        <br>
        <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
        <h3 id="status"></h3>
        <p id="loaded_n_total"></p>
    </form>
</body>

</html>
