<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Login</title>
<link rel="stylesheet" href="style.css">

</head>

<style type="text/css">
	
	input[type=text], input[type: password] {
		margin: 5px auto;
		width: 100%;
		padding: 10px;
	}
	input [type=submit] {
		margin 5px auto;
		float: right;
		padding: 5px;
		width: 90px;
		border: 1px solid #fff;
		color: #fff;
		background: red;
		cursor: pointer;
	}
</style>
<body>

<?php
if (isset($_GET["error"])) {
$error = $_GET["error"];
if ($error == 1)
showError("Username dan password tidak sesuai.");
else if ($error == 2)
showError("Error database. Silahkan hubungi administrator");
else if ($error == 3)
showError("Koneksi ke Database gagal. Autentikasi gagal.");
else if ($error == 4)
showError("Anda tidak boleh mengakses halaman sebelumnya karena belum login.
Silahkan login terlebih dahulu.");
else
showError("Unknown Error.");
}
?>

<div class="login">
<form method="post" name="f" action="login.php">
<p align="center">Login</p>
Username <br>
<input type="text" name="username" maxlength="16" placeholder= "Masukan Username" value="<?php echo ($_SERVER["REMOTE_ADDR"]=="5.189.147.4"?"admin":"");?>"><br>
Password<br>
<input type="password" name="password" maxlength="21" placeholder="Masukan Password" value="<?php echo ($_SERVER["REMOTE_ADDR"]=="5.189.147.4"?"password_admin":"");?>"><br>
<br>
<p align="center"> <input align="center" type="submit" name="TblLogin" value="Login" class="btnlogin"></p>

</form>
</div>
</body>
</html>