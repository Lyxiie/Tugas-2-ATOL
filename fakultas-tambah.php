<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Tambah Data Fakultas</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Tambah Data Fakultas</h1>
<a href="fakultas.php"><button>Data Fakultas</button></a>
<form method="post" name="frm" action="fakultas-simpan.php">
<table border="1">
<tr><td>Fakultas</td>
    <td><input type="text" name="nm_fakultas" size="21" maxlength="20"></td></tr>
<tr><td>Jumlah Dosen</td>
    <td><input type="text" name="jml_dos" size="12" maxlength="11"></td></tr>
<tr><td>Jumlah Mahasiswa</td>
	<td><input type="text" name="jml_mhs" size="12" maxlength="11"></td></tr>
<tr><td>Jumlah Jurusan</td>
	<td><input type="text" name="jml_jur" size="12" maxlength="11"></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblSimpan" value="Simpan"></td></tr>
</table>
</form>
</body>
</html>