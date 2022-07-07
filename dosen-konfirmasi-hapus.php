<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Hapus Data Dosen</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Hapus Data Dosen</h1>
<?php
if(isset($_GET["nip"])){
	$db=dbConnect();
	$nip=$db->escape_string($_GET["nip"]);
	
	$nip=openssl_decrypt($nip,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
	if(!$nip){
		echo "Session anda expire, silahkan login kembali.";
	}
	else
	if($datadosen=getDataDosen($nip)){
		?>
<a href="dosen.php"><button>Data Dosen</button></a>
<form method="post" name="frm" action="dosen-hapus.php">
<input type="hidden" name="nip" value="<?php echo $datadosen["nip"];?>">
<table border="1">
<tr><td>NIP</td><td><?php echo $datadosen["nip"];?></td></tr>
<tr><td>Nama Dosen</td><td><?php echo $datadosen["nama_dos"];?></td></tr>
<tr><td>Alamat</td><td><?php echo $datadosen["alamat_dos"];?></td></tr>
<tr><td>No Telepon</td><td><?php echo $datadosen["no_telp"];?></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="TblHapus" value="Hapus"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "Dosen dengan NIP : $nip tidak ada. Penghapusan dibatalkan";
?>
<?php
}
else
	echo "NIP tidak ada. Penghapusan dibatalkan.";
?>
</body>
</html>