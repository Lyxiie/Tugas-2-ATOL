<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php 
include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Pembaruan Data Matakuliah</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Pembaruan Data Matakuliah</h1>
<?php
if(isset($_POST["TblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){
	
		$kode  			=$db->escape_string($_POST["kode"]);
		$nama_mk	   	=$db->escape_string($_POST["nama_mk"]);
		$sks			=$db->escape_string($_POST["sks"]);
		$nip			=$db->escape_string($_POST["nip"]);

		
		$sql="UPDATE matakuliah SET nama_mk='$nama_mk',sks='$sks',
		nip='$nip' WHERE kode='$kode'";
	
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ 
				?>
				Data berhasil diupdate.<br>
				<a href="matakuliah.php"><button>Data Matakuliah</button></a>
				<?php
			}
			else{ 
				?>
				Data berhasil diupdate tetapi tanpa ada perubahan data.<br>
				<a href="javascript:history.back()"><button>Edit Kembali</button></a>
				<a href="matakuliah.php"><button>Data Matakuliah</button></a>
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