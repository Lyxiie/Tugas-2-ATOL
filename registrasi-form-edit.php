<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Edit Data Registrasi</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Edit Data Registrasi</h1>
<?php
if(isset($_GET["idregistrasi"])){
	$db=dbConnect();
	$idregistrasi=$db->escape_string($_GET["idregistrasi"]);
	
	$idregistrasi=openssl_decrypt($idregistrasi,
							  "aes-128-cbc",
							  $_SESSION["passphrase"],
							  0,
							  $_SESSION["iv"]);
	if(!$idregistrasi){
		echo "Session anda expire, silahkan login kembali.";
	}
	else
	if($dataregistrasi=getDataRegistrasi($idregistrasi)){
		?>
<a href="registrasi.php"><button>Data Registrasi</button></a>
<form method="post" name="frm" action="registrasi-update.php">
<table border="1">
<tr><td>ID Registrasi</td>
    <td><input type="text" name="idregistrasi" size="6" maxlength="5"
	     value="<?php echo $dataregistrasi["idregistrasi"];?>" readonly></td></tr>	 
<tr><td>Kode</td>
    <td><select name="kode">
		<option>Pilih Kategori</option>
		<?php
			$datakode=getListKode();
			foreach($datakode as $data){
				echo "<option value=\"".$data["kode"]."\"";
				if($data["kode"]==$dataregistrasi["kode"])
					echo " selected";
				echo ">".$data["kode"]."</option>";
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
				echo "<option value=\"".$data["nim"]."\"";
				if($data["nim"]==$dataregistrasi["nim"])
					echo " selected";
				echo ">".$data["nim"]."</option>";
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
		echo "ID Registrasi dengan ID : $idregistrasi tidak ada. Pengeditan dibatalkan";
?>
<?php
}
else
	echo "ID tidak ada. Pengeditan dibatalkan.";
?>
</body>
</html>