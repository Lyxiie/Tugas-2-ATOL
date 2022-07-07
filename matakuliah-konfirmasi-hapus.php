<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Hapus Data Matakuliah</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Hapus Data Matakuliah</h1>
<?php
if(isset($_GET["kode"])){
	$db=dbConnect();
	$kode=$db->escape_string($_GET["kode"]);
	
	$kode=openssl_decrypt($kode,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
	if(!$kode){
		echo "Session anda expire, silahkan login kembali.";
	}
	else
	if($datamatakuliah=getDataMatakuliah($kode)){
		?>
<a href="matakuliah.php"><button>Data Matakuliah</button></a>
<form method="post" name="frm" action="matakuliah-hapus.php">
<input type="hidden" name="kode" value="<?php echo $datamatakuliah["kode"];?>">
<table border="1">
<tr><td>Kode</td><td><?php echo $datamatakuliah["kode"];?></td></tr>
<tr><td>Matakuliah</td><td><?php echo $datamatakuliah["nama_mk"];?></td></tr>
<tr><td>Jumlah SKS</td><td><?php echo $datamatakuliah["sks"];?></td></tr>
<tr><td>Dosen</td><td><?php echo $datamatakuliah["nama_dos"];?></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="TblHapus" value="Hapus"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "Matakuliah dengan Kode : $kode tidak ada. Penghapusan dibatalkan";
?>
<?php
}
else
	echo "Kode tidak ada. Penghapusan dibatalkan.";
?>
</body>
</html>