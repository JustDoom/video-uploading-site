<body>
<span id="msg" style="color:red"></span><br/>
<input type="file" id="video" accept="video/*" /><br/>
<!--script type="text/javascript" src="jquery-3.2.1.min.js"></script-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','#photo',function(){
      var property = document.getElementById('video').files[0];
      var video_name = property.name;
      var video_extension = video_name.split('.').pop().toLowerCase();

      if(jQuery.inArray(video_extension,['mov','mp4']) == -1){
        alert("Invalid Video file");
      }
      else
      {
        var form_data = new FormData();
        form_data.append("file", property);
        $.ajax({
          url: 'pick-uploading.php',
          method: 'POST',
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
            $('#msg').html('Loading......');
          },
          success: function (data) {
            console.log(data);
            $('#msg').html(data);
          }
        });
      }
    });
  });
</script>
</body>
