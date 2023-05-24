<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Index</title>
	<link rel="stylesheet" href="style2.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="script.js"></script>
</head>
<body>
	<?php
  session_start();  // 啟用交談期
  // 檢查Session變數是否存在, 表示是否已成功登入
  if ( $_SESSION["login_session"] != true ){
    $message = "please login";
    $url = "login.php";
    echo "<script type='text/javascript'>alert('$message');window.location.href='{$url}';</script>";
		echo $_SESSION["who_login"];
  }
  ?>
	<img src="./img/write.png" class="img" alt="一張圖片">
		<div class="containter">
        <div class="aside">
          <div class="overlay-content">
				  <a href="logout.php">Log out</a>

					<?php
					$who = $_SESSION["who_login"];
					$hi = 'Hi ';
					$whois = $hi.$who;
					echo "<a >" . $whois . "</a>";
					?>

					<a href="list.php">Home</a>
				  <a href="private.php">Blog</a>
					<a href="create.php">Post</a>
			    </div>
        </div>
        <div id="menu__button" onclick="myFunction(this)">
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			</div>
    </div>

		<div class="mid">
      <form action="create.php" method="post" >
        標題<input type="text" style="padding:15px;" class="input_title" name="title" id="title" required autofocus/>
        <br>
        <br>
        內容<input type="text" class="input_text" style="padding:100px;" name="text" id="text" required/>
        <br>
        <br>
        <input type="submit" name="submit" value="發布" class="btn_submit"/>
        <?php
					// 連接資料庫
					$conn = mysqli_connect("140.123.102.94", "408410007", "UODPERw2sODZ0b6q", "408410007");

					// 檢查連接
					if (!$conn) {
						die("Connection failed: " . mysqli_connect_error());
					}
          if (isset($_POST['submit'])) {
              $title = $_POST['title'];
              $text = $_POST['text'];

							$sql = "INSERT INTO post (username,title, content) VALUES ('$who','$title','$text') ";
							$result = mysqli_query($conn, $sql);

          		if (!$result) {
              	echo "<script>
                      Swal.fire({
                          icon: 'error',
                          title: '資料庫儲存失敗',
                          text: '請聯絡系統管理員',
                          confirmButtonText: 'OK'
                      })
                  </script>";
          		}
						//}
		      	header("Location:http://wwweb.csie.io:2067/hw3/create.php");
						mysqli_close($conn);
        }
				?>
        <input type="button" onclick="location.href='<?php echo "http://wwweb.csie.io:2067/hw3/create.php" ?>';" value="清除" class="btn_clear"/>
      </form>
		</div>

	<script src="script.js"></script>
</body>
</html>
