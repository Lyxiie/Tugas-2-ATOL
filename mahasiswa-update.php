<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php 
include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Pembaruan Data Mahasiswa</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Pembaruan Data Mahasiswa</h1>
<?php
if(isset($_POST["TblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){

		$nim  			=$db->escape_string($_POST["nim"]);
		$nama_mhs	   	=$db->escape_string($_POST["nama_mhs"]);
		$nm_jurusan		=$db->escape_string($_POST["nm_jurusan"]);
		$nm_fakultas	=$db->escape_string($_POST["nm_fakultas"]);

		$sql="UPDATE mahasiswa SET nama_mhs='$nama_mhs',nm_jurusan='$nm_jurusan',
		nm_fakultas='$nm_fakultas' WHERE nim='$nim'";

		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){
				?>
				Data berhasil diupdate.<br>
				<a href="mahasiswa.php"><button>Data Mahasiswa</button></a>
				<?php
			}
			else{
				?>
				Data berhasil diupdate tetapi tanpa ada perubahan data.<br>
				<a href="javascript:history.back()"><button>Edit Kembali</button></a>
				<a href="mahasiswa.php"><button>Data Dosen</button></a>
				<?php
			}
		}
		else{
			?>
			Data gagal diupdate.
			<a href="javascript:history.back()"><button>Edit Kembali</button></a>
			<?php
		}
	}
	else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</body>
</html>