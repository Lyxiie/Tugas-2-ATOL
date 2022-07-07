<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Hapus Data Registrasi</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Hapus Data Registrasi</h1>
<?php
if(isset($_GET["idregistrasi"])){
	$db=dbConnect();
	$idregistrasi=$db->escape_string($_GET["idregistrasi"]);
	
	$idregistrasi=openssl_decrypt($idregistrasi,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
	if(!$idregistrasi){
		echo "Session anda expire, silahkan login kembali.";
	}
	else
	if($datamahasiswa=getDataRegistrasi($idregistrasi)){
		?>
<a href="registrasi.php"><button>Data Registrasi</button></a>
<form method="post" name="frm" action="registrasi-hapus.php">
<input type="hidden" name="idregistrasi" value="<?php echo $datamahasiswa["idregistrasi"];?>">
<table border="1">
<tr><td>Kode</td><td><?php echo $datamahasiswa["kode"];?></td></tr>
<tr><td>Nim</td><td><?php echo $datamahasiswa["nim"];?></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="TblHapus" value="Hapus"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "ID Registrasi dengan ID : $idregistrasi tidak ada. Penghapusan dibatalkan";
?>
<?php
}
else
	echo "ID tidak ada. Penghapusan dibatalkan.";
?>
</body>
</html>