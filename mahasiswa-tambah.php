<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>View Data Mahasiswa</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Tambah Data Mahasiswa</h1>
<a href="mahasiswa.php"><button>View Mahasiswa</button></a>
<form method="post" name="frm" action="mahasiswa-simpan.php">
<table border="1">
<tr><td>NIM</td>
    <td><input type="text" name="nim" size="9" maxlength="8"></td></tr>
<tr><td>Nama</td>
    <td><input type="text" name="nama_mhs" size="31" maxlength="30"></td></tr>
<tr><td>Nama Jurusan</td>
    <td><input type="text" name="nm_jurusan" size="21" maxlength="20"></td></tr>
<tr><td>Nama Fakultas</td>
    <td><select name="nm_fakultas">
		<option>Pilih Kategori</option>
		<?php
			$datafakultas=getListFakultas();
			foreach($datafakultas as $data){
				echo "<option value=\"".$data["nm_fakultas"]."\">".$data["nm_fakultas"]."</option>";
			}
		?>
		</select>
	</td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblSimpan" value="Simpan"></td></tr>
</table>
</form>
</body>
</html>