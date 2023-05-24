let btn = document.getElementById("menu__button");
btn.addEventListener("click", foo, false);

function myFunction(x) {
  x.classList.toggle("change");
  $("body").toggleClass("open");
}
function changeColor() {
  session_start();  // 啟用交談期
  var which = $_SESSION["which_edit"];
  var url = "edit.php?id=" + which;
  window.location.href= url;
    //location.href="edit.php?id=" . $_SESSION["which_edit"] ;
}
