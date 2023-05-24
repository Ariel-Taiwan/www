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
	<img src="./img/fuji.png" class="img" alt="一張圖片">
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

	<div class="container">
		<div class="sidebar">
			<h2>OUR USERS</h2>
			<ul>
				<?php
					// 連接資料庫
					$conn = mysqli_connect("140.123.102.94", "408410007", "UODPERw2sODZ0b6q", "408410007");

					// 檢查連接
					if (!$conn) {
						die("Connection failed: " . mysqli_connect_error());
					}

					// 查詢資料庫
					$sql = "SELECT username FROM user";
					$result = mysqli_query($conn, $sql);

					// 顯示結果
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							$encode_name = urlencode($row["username"]);
							echo "<li><a href=public.php?name=" . $encode_name . ">" . $row["username"]. "</a></li>";
						}
					} else {
						echo "No results";
					}
					mysqli_close($conn);
				?>
			</ul>
		</div>
		<h1 class="mid" align="middle">Homepage</h1>
		<div class="mid">
			<h1>Welcome to the Index Page</h1>
			<p>This is the main content of the page.</p>
			<img src="./img/fugi.jpeg" alt="第二張圖片" width="500px">
			<img src="./img/fuji.jpeg" alt="第三張圖片" width="600px">
		</div>
	</div>

	<script src="script.js"></script>
</body>
</html>
