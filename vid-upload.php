<!doctype html>
<html>
<head>
  <script>
    function _(el){
      return document.getElementById(el);
    }
    function uploadFile(){
      console.log( 'Sending data' );
      var title = document.getElementById("title").value;
      var description = document.getElementById("description").value;
      var visibility = document.getElementById("visibility").value;
      var fileUploaded = _("fileToUpload").files[0];
    alert('Hi hi');

      //alert(fileUploaded.name+" | "+fileUploaded.size+" | "+fileUploaded.type);
      var formdata = new FormData();
      formdata.append("file", fileUploaded);
      //formdata.append("title", title);
      //formdata.append("description", description);
      //formdata.append("visibility", visibility);
      var ajax = new XMLHttpRequest();
      //ajax.upload.addEventListener("progress", progressHandler, false);
      //ajax.addEventListener("load", completeHandler, false);
      //ajax.addEventListener("error", errorHandler, false);
      //ajax.addEventListener("abort", abortHandler, false);
      alert('title: ' + title);
      alert('description: ' + description);
      alert('visibility: ' + visibility);
      ajax.open("POST", "vid-uploading.php");
      //ajax.open("POST", "http://192.168.0.5/video-uploading-site/vid-uploading.php");
      ajax.send(formdata);


      //alert(formdata.);
      alert('End of Function');
    }
  </script>
</head>
<body>
<span id="msg" style="color:red"></span><br/>
<form method="post" enctype="multipart/form-data" id="upload_form">
  <input type="text" name="title" id="title" placeholder="Title" required maxlength="160"><br>
  <select name="visibility" id="visibility">
    <option value="public">Public</option>
    <option value="unlisted">Unlisted</option>
    <option value="private">Private</option>
  </select><br>
  <textarea id="description" placeholder="Description" maxlength="1500" rows = "5" cols = "60" name = "description" style="resize: none"></textarea><br>
  Select video to upload:
  <input type="file" name="fileToUpload" id="fileToUpload" accept="video/*">
  <input type="submit" value="Upload Video" name="submit" onclick="uploadFile()">

  <br>
  <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
  <h3 id="status"></h3>
  <p id="loaded_n_total"></p>
</form>
</body>

</html>
