<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Penyimpanan Data Registrasi</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Penyimpanan Data Registrasi</h1>
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		
		$kode  			=$db->escape_string($_POST["kode"]);
		$nim	  		=$db->escape_string($_POST["nim"]);
		
		$sql="INSERT INTO registrasi(kode,nim)
			  VALUES('$kode','$nim')";
		
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ 
				?>
				Data berhasil disimpan.<br>
				<a href="registrasi.php"><button>Data Registrasi</button></a>
				<?php
			}
		}
		else{
			?>
			Data gagal disimpan karena ID Registrasi mungkin sudah ada.<br>
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