<?php
// 設定 MySQL 伺服器的連線資訊
$servername = "140.123.102.94";
$username = "408410007";
$password = "UODPERw2sODZ0b6q";
$dbname = "user";

// 建立 MySQL 連線
$conn = new mysqli($servername, $username, $password, $dbname, "3306");

// 檢查連線是否成功
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 如果前端有 POST 請求，就處理資料
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 取得前端傳來的資料
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  // 檢查密碼是否一致
  if ($password != $confirm_password) {
    die("Password confirmation does not match.");
  }

  // 將使用者資料插入 MySQL 資料庫
  $sql = "INSERT INTO user (username, email, password)
  VALUES ('$username', '$email', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "User registered successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// 關閉 MySQL 連線
$conn->close();
?>
