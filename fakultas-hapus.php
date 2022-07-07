<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Hapus Data Fakultas</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Hapus Data Fakultas</h1>
<?php
if(isset($_POST["TblHapus"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		$nm_fakultas  =$db->escape_string($_POST["nm_fakultas"]);
		
		$sql="DELETE FROM fakultas WHERE nm_fakultas='$nm_fakultas'";
		
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
		<a href="fakultas.php"><button>Data Fakultas</button></a>
		<?php
	}
	else
		echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</body>
</html>