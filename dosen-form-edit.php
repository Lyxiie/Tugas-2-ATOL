<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Edit Data Dosen</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Edit Data Dosen</h1>
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
<form method="post" name="frm" action="dosen-update.php">
<table border="1">
<tr><td>NIP</td>
    <td><input type="text" name="nip" size="19" maxlength="18"
	     value="<?php echo $datadosen["nip"];?>" readonly></td></tr>
<tr><td>Nama Dosen</td>
    <td><input type="text" name="nama_dos" size="31" maxlength="30"
		 value="<?php echo $datadosen["nama_dos"];?>"></td></tr>
<tr><td>Alamat</td>
	<td><<textarea name="alamat_dos" cols="50" rows="5"><?php echo $datadosen["alamat_dos"];?></textarea></td></tr>
<tr><td>No Telepon</td>
	<td><input type="text" name="no_telp" size="14" maxlength="13"
		 value="<?php echo $datadosen["no_telp"];?>"></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblUpdate" value="Update">
	    <input type="reset"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "Dosen dengan NIP : $nip tidak ada. Pengeditan dibatalkan";
?>
<?php
}
else
	echo "NIP tidak ada. Pengeditan dibatalkan.";
?>
</body>
</html>