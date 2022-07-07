<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Edit Data Mahasiswa</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Edit Data Mahasiswa</h1>
<?php
if(isset($_GET["nim"])){
	$db=dbConnect();
	$nim=$db->escape_string($_GET["nim"]);
		
	$nim=openssl_decrypt($nim,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
	if(!$nim){
		echo "Session anda expire, silahkan login kembali.";
	}
	else
	if($datamahasiswa=getDataMahasiswa($nim)){
		?>
<a href="mahasiswa.php"><button>Data Mahasiswa</button></a>
<form method="post" name="frm" action="mahasiswa-update.php">
<table border="1">
<tr><td>NIM</td>
    <td><input type="text" name="nim" size="9" maxlength="8"
	     value="<?php echo $datamahasiswa["nim"];?>" readonly></td></tr>
<tr><td>Nama</td>
    <td><input type="text" name="nama_mhs" size="31" maxlength="30"
		 value="<?php echo $datamahasiswa["nama_mhs"];?>"></td></tr>
<tr><td>Nama Jurusan</td>
    <td><input type="text" name="nm_jurusan" size="21" maxlength="20"
		 value="<?php echo $datamahasiswa["nm_jurusan"];?>"></td></tr>		 
<tr><td>Nama Fakultas</td>
    <td><select name="nm_fakultas">
		<option>Pilih Kategori</option>
		<?php
			$datafakultas=getListFakultas();
			foreach($datafakultas as $data){
				echo "<option value=\"".$data["nm_fakultas"]."\"";
				if($data["nm_fakultas"]==$datamahasiswa["nm_fakultas"])
					echo " selected"; // default sesuai kategori sebelumnya
				echo ">".$data["nm_fakultas"]."</option>";
			}
		?>
		</select>
	</td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblUpdate" value="Update">
	    <input type="reset"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "Mahasiswa dengan NIM : $nim tidak ada. Pengeditan dibatalkan";
?>
<?php
}
else
	echo "NIM tidak ada. Pengeditan dibatalkan.";
?>
</body>
</html>