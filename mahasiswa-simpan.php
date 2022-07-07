<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Penyimpanan Data Mahasiswa</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Penyimpanan Data Mahasiswa</h1>
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		$nim  			=$db->escape_string($_POST["nim"]);
		$nama_mhs	  	=$db->escape_string($_POST["nama_mhs"]);
		$nm_jurusan		=$db->escape_string($_POST["nm_jurusan"]);
		$nm_fakultas	=$db->escape_string($_POST["nm_fakultas"]);
		
		$sql="INSERT INTO mahasiswa(nim,nama_mhs,nm_jurusan,nm_fakultas)
			  VALUES('$nim','$nama_mhs','$nm_jurusan','$nm_fakultas')";

		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){
				?>
				Data berhasil disimpan.<br>
				<a href="mahasiswa.php"><button>View Mahasiswa</button></a>
				<?php
			}
		}
		else{
			?>
			Data gagal disimpan karena NIM mungkin sudah ada.<br>
			<a href="javascript:history.back()"><button>Kembali</button></a>
			<?php
		}
	}
	else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</body>
</html>