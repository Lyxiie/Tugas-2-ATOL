<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Edit Data Fakultas</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Edit Data Fakultas</h1>
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
<form method="post" name="frm" action="fakultas-update.php">
<table border="1">
<tr><td>Fakultas</td>
    <td><input type="text" name="nm_fakultas" size="21" maxlength="20"
	     value="<?php echo $datafakultas["nm_fakultas"];?>" readonly></td></tr>
<tr><td>Jumlah Dosen</td>
    <td><input type="text" name="jml_dos" size="12" maxlength="11"
		 value="<?php echo $datafakultas["jml_dos"];?>"></td></tr>
<tr><td>Jumlah Mahasiswa</td>
    <td><input type="text" name="jml_mhs" size="12" maxlength="11"
		 value="<?php echo $datafakultas["jml_dos"];?>"></td></tr>
<tr><td>Jumlah Jurusan</td>
    <td><input type="text" name="jml_jur" size="12" maxlength="11"
		 value="<?php echo $datafakultas["jml_jur"];?>"></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblUpdate" value="Update">
	    <input type="reset"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "Fakultas dengan Nama : $nm_fakultas tidak ada. Pengeditan dibatalkan";
?>
<?php
}
else
	echo "Nama Fakultas tidak ada. Pengeditan dibatalkan.";
?>
</body>
</html>