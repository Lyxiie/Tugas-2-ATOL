<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php 
include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Pembaruan Data Registrasi</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Pembaruan Data Registrasi</h1>
<?php
if(isset($_POST["TblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		
		$idregistrasi  	=$db->escape_string($_POST["idregistrasi"]);
		$kode	   		=$db->escape_string($_POST["kode"]);
		$nim			=$db->escape_string($_POST["nim"]);
		
		$sql="UPDATE registrasi SET kode='$kode',nim='$nim' WHERE idregistrasi='$idregistrasi'";
		
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){
				?>
				Data berhasil diupdate.<br>
				<a href="registrasi.php"><button>Data Registrasi</button></a>
				<?php
			}
			else{ 
				?>
				Data berhasil diupdate tetapi tanpa ada perubahan data.<br>
				<a href="javascript:history.back()"><button>Edit Kembali</button></a>
				<a href="registrasi.php"><button>Data Registrasi</button></a>
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