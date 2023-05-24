<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>login.php</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  </head>
  <body>
    <?php
    session_start();  // 啟用交談期
    $name = "";  $password = "";
    // 取得表單欄位值
    if ( isset($_POST["name"]) && isset($_POST["password"])){
      $name = $_POST["name"];
      $password = $_POST["password"];

      // Check for SQL injection
        if (strpos($name, "'") !== false || strpos($email, "'") !== false || strpos($password, "'") !== false) {
          echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'login errors!',
                text: 'SQL injection problem.'
            }).then((result) => {
                window.location.href = 'login.php';
            });
            </script>";
            exit();
        }

      // 檢查是否輸入使用者名稱和密碼
      if ($name != "" && $password != "") {

        // 建立MySQL的資料庫連接
        $link = mysqli_connect("140.123.102.94","408410007","UODPERw2sODZ0b6q","408410007")or die("無法開啟MySQL資料庫連接!<br/>");
        // 建立SQL指令字串
        $encryption_pass = md5($password);
        $sql = "SELECT * FROM user where username='$name' ";

        // 執行SQL查詢
        $result = mysqli_query($link, $sql);
        // 是否有查詢到使用者記錄
        //if ( md5($password) == $result['password'] ) {
        if(mysqli_num_rows($result) > 0)
        {
          foreach($result as $row)
          {
            // 成功登入, 指定Session變數
            if(md5($password) == $row['password']){
              $_SESSION["login_session"] = true;
              $_SESSION["who_login"] = $name;
              header("Location: list.php");
              exit();
            }
          }
          $_SESSION["login_session"] = false;
          echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Failed login!',
            }).then((result) => {
                window.location.href = 'login2.php';
            });
            </script>";
            exit();
        }
        mysqli_close($link);  // 關閉資料庫連接
      }
    }
    ?>
    <div class="parent">
      <form action="login2.php" method="post" autocomplete="off" onsubmit="return validateForm()">
        <h1 align="middle">Blog</h1>
        <hr>
        <h2 class="parent">Sign in to start your blog</h2>
        <br>
        <input type="text" placeholder="Username" class="common_input" name="name" id="name" required autofocus/>
        <br>
        <input type="password" class="common_input" placeholder="Password" name="password" id="password" required/>
        <br>
        <input type="submit" value="登入" class="common__btn"/>
      </form>
      <script>
        function validateForm() {
            var username = document.forms[0]["name"].value;
            var password = document.forms[0]["password"].value;
            if (username == "" || password == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'There is an empty field!'
                })
                return false;
            }
        }
      </script>
    </div>
    <h3 align="middle"><a href="regis.php">Register a new membership</a></h3>
</body>
</html>
