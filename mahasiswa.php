<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Data Mahasiswa</title></head>
<body>
<?php banner();?>
<?php navigator();?>
<h1>Data Mahasiswa</h1>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	$sql="SELECT * FROM mahasiswa ORDER BY nim";
	$res=$db->query($sql);
	if($res){
		?>
		<a href="mahasiswa-tambah.php"><button>Tambah</button></a>
		<a href="pencarian-mahasiswa.php"><button>Pencarian Mahasiswa</button></a>
		<table border="1">
		<tr><th>NIM</th><th>Nama</th><th>Nama Jurusan</th>
		    <th>Nama Fakultas</th><th colspan="2">Aksi</th>
			</tr>
		<?php
		$data=$res->fetch_all(MYSQLI_ASSOC);
		foreach($data as $barisdata){
			?>
			<tr>
			<td><?php echo $barisdata["nim"];?></td>
			<td><?php echo $barisdata["nama_mhs"];?></td>
			<td><?php echo $barisdata["nm_jurusan"];?></td>
			<td><?php echo $barisdata["nm_fakultas"];?></td>
			<td><a href="mahasiswa-form-edit.php?nim=<?php 
			echo urlencode(openssl_encrypt($barisdata["nim"],
							     'aes-128-cbc',
								 $_SESSION["passphrase"],
								 0,
								 $_SESSION["iv"])
						   );
			?>"><button>Edit</button></a> | 
			<td><a href="mahasiswa-konfirmasi-hapus.php?nim=<?php 
			echo urlencode(openssl_encrypt($barisdata["nim"],
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