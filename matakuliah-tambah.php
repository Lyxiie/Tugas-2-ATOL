<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>View Data matakuliah</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Tambah Data Matakuliah</h1>
<a href="matakuliah.php"><button>View Matakuliah</button></a>
<form method="post" name="frm" action="matakuliah-simpan.php">
<table border="1">
<tr><td>KODE</td>
    <td><input type="text" name="kode" size="4" maxlength="3"></td></tr>
<tr><td>Nama matakuliah</td>
    <td><input type="text" name="nama_mk" size="21" maxlength="20"></td></tr>
<tr><td>Jumlah SKS</td>
    <td><input type="text" name="sks" size="2" maxlength="1"></td></tr>
<tr><td>NIP</td>
    <td><select name="nip">
		<option>Pilih Dosen</option>
		<?php
			$datadosen=getListDosen();
			foreach($datadosen as $data){
				echo "<option value=\"".$data["nip"]."\">".$data["nama_dos"]."</option>";
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