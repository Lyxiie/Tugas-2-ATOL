<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Hapus Data Fakultas</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Hapus Data Fakultas</h1>
<?php
if(isset($_GET["nm_fakultas"])){
	$db=dbConnect();
	$nm_fakultas=$db->escape_string($_GET["nm_fakultas"]);
		
	$nm_fakultas=openssl_decrypt($nm_fakultas,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
	if(!$nm_fakultas){
		echo "Session anda expire, silahkan login kembali.";
	}
	else
	if($datafakultas=getDataFakultas($nm_fakultas)){
		?>
<a href="fakultas.php"><button>Data Fakultas</button></a>
<form method="post" name="frm" action="fakultas-hapus.php">
<input type="hidden" name="nm_fakultas" value="<?php echo $datafakultas["nm_fakultas"];?>">
<table border="1">
<tr><td>Fakultas</td><td><?php echo $datafakultas["nm_fakultas"];?></td></tr>
<tr><td>Jumlah Dosen</td><td><?php echo $datafakultas["jml_dos"];?></td></tr>
<tr><td>Jumlah Mahasiswa</td><td><?php echo $datafakultas["jml_mhs"];?></td></tr>
<tr><td>Jumlah jurusan</td><td><?php echo $datafakultas["jml_jur"];?></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="TblHapus" value="Hapus"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "Fakultas dengan Nama : $nm_fakultas tidak ada. Penghapusan dibatalkan";
?>
<?php
}
else
	echo "Nama Fakultas tidak ada. Penghapusan dibatalkan.";
?>
</body>
</html>