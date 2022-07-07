<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>View Data Registrasi</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Tambah Data Registrasi</h1>
<a href="registrasi.php"><button>View Registrasi</button></a>
<form method="post" name="frm" action="registrasi-simpan.php">
<table border="1">
<tr><td>Kode</td>
    <td><select name="kode">
		<option>Pilih Kategori</option>
		<?php
			$datakode=getListKode();
			foreach($datakode as $data){
				echo "<option value=\"".$data["kode"]."\">".$data["kode"]."</option>";
			}
		?>
		</select>
	</td></tr>
<tr><td>NIM</td>
    <td><select name="nim">
		<option>Pilih Kategori</option>
		<?php
			$datanim=getListNim();
			foreach($datanim as $data){
				echo "<option value=\"".$data["nim"]."\">".$data["nim"]."</option>";
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