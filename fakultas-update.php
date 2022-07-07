<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php 
include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Pembaruan Data Fakultas</title></head>
<body>
<?php banner();?>
<?php navigator();?>

<h1>Pembaruan Data Fakultas</h1>
<?php
if(isset($_POST["TblUpdate"])){
	$db=dbConnect();
	if($db->connect_errno==0){
		
		$nm_fakultas  	=$db->escape_string($_POST["nm_fakultas"]);
		$jml_dos	   	=$db->escape_string($_POST["jml_dos"]);
		$jml_mhs		=$db->escape_string($_POST["jml_mhs"]);
		$jml_jur	  	=$db->escape_string($_POST["jml_jur"]);

		
		$sql="UPDATE fakultas SET jml_dos='$jml_dos',jml_mhs='$jml_mhs',
		jml_jur='$jml_jur' WHERE nm_fakultas='$nm_fakultas'";
		
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){ 
				?>
				Data berhasil diupdate.<br>
				<a href="fakultas.php"><button>Data Fakultas</button></a>
				<?php
			}
			else{
				?>
				Data berhasil diupdate tetapi tanpa ada perubahan data.<br>
				<a href="javascript:history.back()"><button>Edit Kembali</button></a>
				<a href="fakultas.php"><button>Data Fakultas</button></a>
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