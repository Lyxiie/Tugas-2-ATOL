<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Data Matakuliah</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Data Matakuliah</h1>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	$sql="SELECT m.kode, m.nama_mk, m.sks, d.nama_dos FROM matakuliah m JOIN dosen d ON m.nip=d.nip";
	$res=$db->query($sql);
	if($res){
		?>
		<a href="matakuliah-tambah.php"><button>Tambah</button></a>
		<a href="pencarian-matakuliah.php"><button>Pencarian Matakuliah</button></a>
		<table border="1">
		<tr><th>Kode</th><th>Matakuliah</th><th>Jumlah SKS</th>
		    <th>Dosen</th><th colspan="2">Aksi</th>
			</tr>
		<?php
		$data=$res->fetch_all(MYSQLI_ASSOC);
		foreach($data as $barisdata){
			?>
			<tr>
			<td><?php echo $barisdata["kode"];?></td>
			<td><?php echo $barisdata["nama_mk"];?></td>
			<td><?php echo $barisdata["sks"];?></td>
			<td><?php echo $barisdata["nama_dos"];?></td>
			<td><a href="matakuliah-form-edit.php?kode=<?php 
			echo urlencode(openssl_encrypt($barisdata["kode"],
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );
			?>"><button>Edit</button></a> | 
			<td><a href="matakuliah-konfirmasi-hapus.php?kode=<?php 
			echo urlencode(openssl_encrypt($barisdata["kode"],
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