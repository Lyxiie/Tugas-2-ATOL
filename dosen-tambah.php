<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Tambah Data Dosen</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Tambah Data Dosen</h1>
<a href="dosen.php"><button>Data Dosen</button></a>
<form method="post" name="frm" action="dosen-simpan.php">
<table border="1">
<tr><td>NIP</td>
    <td><input type="text" name="nip" size="19" maxlength="18"></td></tr>
<tr><td>Nama Dosen</td>
    <td><input type="text" name="nama_dos" size="31" maxlength="30"></td></tr>
<tr><td>Alamat</td>
	<td><textarea name="alamat_dos" cols="50" rows="5"></textarea></td></tr>
<tr><td>NO Telepon</td>
	<td><input type="text" name="no_telp" size="14" maxlength="13"></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblSimpan" value="Simpan"></td></tr>
</table>
</form>
</body>
</html>