<?php
if(isset($_GET['id'])) {
    session_start();  // 啟用交談期
    //$which = strpos($_SERVER['QUERY_STRING'],"id");
    //$id = $_SESSION["which_edit"];
    $who = $_SESSION["who_login"];
    $id = $_GET['id'];
    // 連接資料庫
    $conn = mysqli_connect("140.123.102.94", "408410007", "UODPERw2sODZ0b6q", "408410007");

    // 檢查連接
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $query2 = "DELETE FROM post WHERE id='$id' ";//資料庫語法看一下
    //$query2 = "UPDATE post SET title = '$title', content= '$text' WHERE id= '$id' ";
    $query_run2 = mysqli_query($conn,$query2);//這個要加，否則上面動作都白做了

  mysqli_close($conn);
  $goto =  "http://wwweb.csie.io:2067/hw3/private.php";
  header("Location:" . $goto);
  die();
}
?>
