<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Data Fakultas</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Data Fakultas</h1>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	$sql="SELECT * FROM fakultas ORDER BY nm_fakultas";
	$res=$db->query($sql);
	if($res){
		?>
		<a href="fakultas-tambah.php"><button>Tambah</button></a>
		<a href="pencarian-fakultas.php"><button>Pencarian Fakultas</button></a>
		<table border="1">
		<tr><th>Fakultas</th><th>Jumlah Dosen</th><th>Jumlah Mahasiswa</th>
		    <th>Jumlah jurusan</th><th colspan="2">Aksi</th>
			</tr>
		<?php
		$data=$res->fetch_all(MYSQLI_ASSOC); 
		foreach($data as $barisdata){ 
			?>
			<tr>
			<td><?php echo $barisdata["nm_fakultas"];?></td>
			<td><?php echo $barisdata["jml_dos"];?></td>
			<td><?php echo $barisdata["jml_mhs"];?></td>
			<td><?php echo $barisdata["jml_jur"];?></td>
			<td><a href="fakultas-form-edit.php?nm_fakultas=<?php 
			echo urlencode(openssl_encrypt($barisdata["nm_fakultas"],
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );
			?>"><button>Edit</button></a> | 
			<td><a href="fakultas-konfirmasi-hapus.php?nm_fakultas=<?php 
			echo urlencode(openssl_encrypt($barisdata["nm_fakultas"],
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );
			
			?>"><button>Hapus</button></a></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
		$res->free();
	}else
		echo "Gagal Eksekusi SQL".(DEVELOPMENT?" : ".$db->error:"")."<br>";
}
else
	echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
?>
</body>
</html>