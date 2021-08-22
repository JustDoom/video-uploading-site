function click() {

  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function () {
    console.log(this.responseText);
    document.getElementById('likes').innerHTML = this.responseText;
  }
  xmlhttp.open("GET", "likes.php?v=" + document.getElementById("id").value);
  xmlhttp.send();
}

window.onload = function () {
  var btn = document.getElementById("like");
  btn.onclick = click;
}
