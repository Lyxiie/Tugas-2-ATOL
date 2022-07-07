<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Data Registrasi</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Data Registrasi</h1>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	$sql="SELECT r.idregistrasi, r.kode, r.nim, d.nama_dos FROM registrasi r join matakuliah m ON r.kode=m.kode join dosen d ON m.nip=d.nip";
	$res=$db->query($sql);
	if($res){
		?>
		<a href="registrasi-tambah.php"><button>Tambah</button></a>
		<a href="pencarian-registrasi.php"><button>Pencarian Registrasi</button></a>
		<table border="1">
		<tr><th>ID Registrasi</th><th>Kode</th><th>NIM</th><th>Dosen</th><th colspan="2">Aksi</th>
		</tr>
		<?php
		$data=$res->fetch_all(MYSQLI_ASSOC);
		foreach($data as $barisdata){
			?>
			<tr>
			<td><?php echo $barisdata["idregistrasi"];?></td>
			<td><?php echo $barisdata["kode"];?></td>
			<td><?php echo $barisdata["nim"];?></td>
			<td><?php echo $barisdata["nama_dos"];?></td>
			<td><a href="registrasi-form-edit.php?idregistrasi=<?php 
			echo urlencode(openssl_encrypt($barisdata["idregistrasi"],
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );
			?>"><button>Edit</button></a> | 
			<td><a href="registrasi-konfirmasi-hapus.php?idregistrasi=<?php 
			echo urlencode(openssl_encrypt($barisdata["idregistrasi"],
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