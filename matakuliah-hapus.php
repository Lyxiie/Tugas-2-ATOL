<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Hapus Data Matakuliah</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Hapus Data Matakuliah</h1>
<?php
if(isset($_POST["TblHapus"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		$kode  =$db->escape_string($_POST["kode"]);

		$sql="DELETE FROM matakuliah WHERE kode='$kode'";

		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0)
				echo "Data berhasil dihapus.<br>";
			else
				echo "Penghapusan gagal karena data yang dihapus tidak ada.<br>";
		}
		else{
			echo "Data gagal dihapus. <br>";
		}
		?>
		<a href="matakuliah.php"><button>View Matakuliah</button></a>
		<?php
	}
	else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</body>
</html>