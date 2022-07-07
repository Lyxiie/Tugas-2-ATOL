<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?> 
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Data Dosen</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Data Dosen</h1>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	$sql="SELECT * FROM dosen ORDER BY nama_dos";
	$res=$db->query($sql);
	if($res){
		?>
		<a href="dosen-tambah.php"><button>Tambah</button></a>
		<a href="pencarian-dosen.php"><button>Pencarian Dosen</button></a>
		<table border="1">
		<tr><th>NIP</th><th>Nama Dosen</th><th>Alamat</th>
		    <th>No Telepon</th><th colspan ="2">Aksi</th>
			</tr>
		<?php
		$data=$res->fetch_all(MYSQLI_ASSOC); 
		foreach($data as $barisdata){ 
			?>
			<tr>
			<td><?php echo $barisdata["nip"];?></td>
			<td><?php echo $barisdata["nama_dos"];?></td>
			<td><?php echo $barisdata["alamat_dos"];?></td>
			<td><?php echo $barisdata["no_telp"];?></td>
			<td><a href="dosen-form-edit.php?nip=<?php 
			echo urlencode(openssl_encrypt($barisdata["nip"],
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );
			?>"><button>Edit</button></a> | 
			<td><a href="dosen-konfirmasi-hapus.php?nip=<?php 
			echo urlencode(openssl_encrypt($barisdata["nip"],
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