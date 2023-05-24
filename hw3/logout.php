<?php
session_start(); // 啟動 session

// 檢查用戶是否已登入
if (!isset($_SESSION['login_session'])) {
    header('Location: login.php'); // 未登入，導向登入頁面
    exit;
}

// 登出
session_unset();
session_destroy();

// 顯示登出訊息並重新導向
echo 'you\'ll be signed out after five seconds.';
echo "<br><a href=index.php>" . "if you are not sccessfully logged out, please click here.". "</a>";
header("refresh:5;url=login.php"); // 五秒後重新導向至登入頁面
?>
