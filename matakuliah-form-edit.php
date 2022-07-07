<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Edit Data Matakuliah</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Edit Data Matakuliah</h1>
<?php
if(isset($_GET["kode"])){
	$db=dbConnect();
	$kode=$db->escape_string($_GET["kode"]);
	
	$kode=openssl_decrypt($kode,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
	if(!$kode){
		echo "Session anda expire, silahkan login kembali.";
	}
	else
	if($datamatakuliah=getDataMatakuliah($kode)){
		?>
<a href="matakuliah.php"><button>Data Matakuliah</button></a>
<form method="post" name="frm" action="matakuliah-update.php">
<table border="1">
<tr><td>Kode</td>
    <td><input type="text" name="kode" size="4" maxlength="3"
	     value="<?php echo $datamatakuliah["kode"];?>" readonly></td></tr>
<tr><td>Matakuliah</td>
    <td><input type="text" name="nama_mk" size="21" maxlength="20"
		 value="<?php echo $datamatakuliah["nama_mk"];?>"></td></tr>
<tr><td>SKS</td>
    <td><input type="text" name="sks" size="2" maxlength="1"
		 value="<?php echo $datamatakuliah["sks"];?>"></td></tr>		 
<tr><td>Dosen</td>
    <td><select name="nip">
		<option>Pilih Kategori</option>
		<?php
			$datadosen=getListDosen();
			foreach($datadosen as $data){
				echo "<option value=\"".$data["nip"]."\"";
				if($data["nama_dos"]==$datamatakuliah["nama_dos"])
					echo " selected";
				echo ">".$data["nama_dos"]."</option>";
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
		echo "Matakuliah dengan Kode : $kode tidak ada. Pengeditan dibatalkan";
?>
<?php
}
else
	echo "KODE tidak ada. Pengeditan dibatalkan.";
?>
</body>
</html>