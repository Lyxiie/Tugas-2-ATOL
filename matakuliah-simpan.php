<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Penyimpanan Data Matakuliah</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Penyimpanan Data Matakuliah</h1>
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
	
		$kode  			=$db->escape_string($_POST["kode"]);
		$nama_mk	  	=$db->escape_string($_POST["nama_mk"]);
		$sks			=$db->escape_string($_POST["sks"]);
		$nip			=$db->escape_string($_POST["nip"]);

		$sql="INSERT INTO matakuliah(kode,nama_mk,sks,nip)
			  VALUES('$kode','$nama_mk','$sks','$nip')";

		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){
				?>
				Data berhasil disimpan.<br>
				<a href="matakuliah.php"><button>View Matakuliah</button></a>
				<?php
			}
		}
		else{
			?>
			Data gagal disimpan karena Kode mungkin sudah ada.<br>
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