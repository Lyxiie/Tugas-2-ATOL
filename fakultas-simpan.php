<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Penyimpanan Data Fakultas</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Penyimpanan Data Fakultas</h1>
<?php
if(isset($_POST["TblSimpan"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		
		$nm_fakultas  	=$db->escape_string($_POST["nm_fakultas"]);
		$jml_dos	   	=$db->escape_string($_POST["jml_dos"]);
		$jml_mhs		=$db->escape_string($_POST["jml_mhs"]);
		$jml_jur	  	=$db->escape_string($_POST["jml_jur"]);
		
		$sql="INSERT INTO fakultas(nm_fakultas, jml_dos, jml_mhs ,jml_jur)
			  VALUES('$nm_fakultas','$jml_dos','$jml_mhs','$jml_jur')";
		
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ 
				?>
				Data berhasil disimpan.<br>
				<a href="fakultas.php"><button>Data Fakultas</button></a>
				<?php
			}
		}
		else{
			?>
			Data gagal disimpan karena Nama Fakultas mungkin sudah ada.<br>
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