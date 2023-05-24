<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>註冊</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
  <?php
  $servername = "140.123.102.94";
  $username = "408410007";
  $password = "UODPERw2sODZ0b6q";
  $dbname = "408410007";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
      die("連線失敗：" . mysqli_connect_error());
  }

  if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    // 檢查是否輸入使用者名稱和密碼
    if ($name != "" && $password != "") {

      // 驗證密碼是否符合條件
      if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
        echo "<script> Swal.fire({ icon: 'error', title: 'Registration errors!',  text: 'The length of password should be at least 8 and include at least a capital letter, a lowercase letter, and a number.'  }).then((result) => {      window.location.href = 'regis.php';  });  </script>";
          exit();
      }

      // 搜尋是否有重複的 username
      $sql = "SELECT * FROM user WHERE username='$name' ";
      $result = mysqli_query($conn, $sql);

      // 檢查是否有查詢到資料
      if (mysqli_num_rows($result) > 0) {
        echo "<script> Swal.fire({icon: 'error',  title: 'Duplicate username!',  text: 'The username already exists.'  }).then((result) => {  window.location.href = 'regis.php';  });  </script>";
          exit();
        }

      // Check for SQL injection
        if (strpos($name, "'") !== false || strpos($email, "'") !== false || strpos($password, "'") !== false) {
          echo "<script> Swal.fire({  icon: 'error',  title: 'Registration errors!',  text: 'SQL injection problem.'}).then((result) => {  window.location.href = 'regis.php';  });   </script>";
            exit();
        }

      if ($password != $confirm_password) {
          echo "<script> Swal.fire({  icon: 'error',  title: 'Registration errors!',  text: 'Password and confirm password fields were not matched.',    confirmButtonText: 'OK'  })  </script>";
      } else {
          $db_server = "140.123.102.94";
          $db_username = "408410007";
          $db_password = "UODPERw2sODZ0b6q";
          $db_name = "408410007";
          $db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

          if (!$db_connection) {
              echo "<script> Swal.fire({icon: 'error',  title: '無法連入database',  text: '請聯絡系統管理員',  confirmButtonText: 'OK'})  </script>";
          } else {
              $encryption_pass = md5($password);
              $insert_query = "INSERT INTO user (username, email, password) VALUES ('$name', '$email', '$encryption_pass')";
              $result = mysqli_query($db_connection, $insert_query);

              if (!$result) {
                  echo "<script> Swal.fire({  icon: 'error',  title: '資料庫儲存失敗',  text: '請聯絡系統管理員',  confirmButtonText: 'OK'  }) </script>";
              } else {
                  echo "<script> Swal.fire({icon: 'success',  title: '註冊成功',  confirmButtonText: 'OK'}) </script>";
              }
              mysqli_close($db_connection);
          }
      }
    }else{
      echo "<script> Swal.fire({icon: 'error',title: 'Registration errors!',text: 'there are empty field.'}).then((result) => {window.location.href = 'regis.php';}); </script>";
        exit();
    }
  }
  ?>
    <div>
      <form action="regis.php" method="post" autocomplete="off">
        <h1 align="middle">Blog</h1>
        <hr>
        <h2 align="middle">Register a new membership</h2>
        <br>
        <input type="password" style="display:none" />
        <input type="text" name="username" placeholder="Username" class="common_input" align="middle" autocomplete="no-autofill"><br>
        <input type="text" name="email" align="middle" class="common_input" placeholder="Email" autocomplete="no-autofill" pattern="[a-zA-Z0-9._%+-]+@+gmail.com" required="required"  oninvalid="setCustomValidity('請在電子郵件地址中包含「@」、「gmail.com」');" oninput="setCustomValidity('');" ><br>
        <input type="password" style="display:none" autocomplete="no-autofill"/>
        <input type="password" name="password" align="middle" class="common_input" placeholder="Password" autocomplete="no-autofill"><br>
        <input type="password" name="confirm_password" align="middle" class="common_input" placeholder="Retype password" autocomplete="no-autofill"><br>
        <input type="submit" name="submit" value="註冊" align="middle" class="common__btn" autocomplete="no-autofill">
      </form>

    </div>
    <h3 align="middle"><a href="login.php">I already have a membership</a></h3>

</body>
</html>
