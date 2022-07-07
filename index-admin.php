<?php
	session_start();
	if(!isset($_SESSION["username"]))
		header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Pengelolaan Data</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navigator">
<?php banner();?>
<?php navigator();?>
</div>
<h1>Menu Administrator</h1>
Selamat Datang <?php echo $_SESSION["username"];?><br>
Silahkan pilih aktivitas yang ingin ada lakukan dengan mengklik menu yang ada.

</body>
</html>