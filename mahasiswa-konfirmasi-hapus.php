<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Hapus Data Mahasiswa</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Hapus Data Mahasiswa</h1>
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
<form method="post" name="frm" action="mahasiswa-hapus.php">
<input type="hidden" name="nim" value="<?php echo $datamahasiswa["nim"];?>">
<table border="1">
<tr><td>NIM</td><td><?php echo $datamahasiswa["nim"];?></td></tr>
<tr><td>Nama</td><td><?php echo $datamahasiswa["nama_mhs"];?></td></tr>
<tr><td>Nama Jurusan</td><td><?php echo $datamahasiswa["nm_jurusan"];?></td></tr>
<tr><td>Nama Fakultas</td><td><?php echo $datamahasiswa["nm_fakultas"];?></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="TblHapus" value="Hapus"></td></tr>
</table>
</form>
		<?php
	}
	else
		echo "Mahasiswa dengan NIM : $nim tidak ada. Penghapusan dibatalkan";
?>
<?php
}
else
	echo "NIM tidak ada. Penghapusan dibatalkan.";
?>
</body>
</html>