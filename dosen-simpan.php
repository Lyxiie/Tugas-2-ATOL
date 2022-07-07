<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Penyimpanan Data Dosen</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Penyimpanan Data Dosen</h1>
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		
		$nip  			=$db->escape_string($_POST["nip"]);
		$nama_dos	   	=$db->escape_string($_POST["nama_dos"]);
		$alamat_dos		=$db->escape_string($_POST["alamat_dos"]);
		$no_telp	  	=$db->escape_string($_POST["no_telp"]);
		
		$sql="INSERT INTO dosen(nip, nama_dos, alamat_dos ,no_telp)
			  VALUES('$nip','$nama_dos','$alamat_dos','$no_telp')";
		
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){
				?>
				Data berhasil disimpan.<br>
				<a href="dosen.php"><button>Data Dosen</button></a>
				<?php
			}
		}
		else{
			?>
			Data gagal disimpan karena NIP mungkin sudah ada.<br>
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