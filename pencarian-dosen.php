<?php include_once("functions.php");?>
<!DOCTYPE html>
<html>
<head>
<title>Pencarian data Dosen</title>
</head>
<body>
<h1>Pencarian Dosen</h1>
<form method="post">
<table>
<tr><td>Dicari</td>
    <td><input type="text" width="20" name="dicari" value="<?php echo isset($_POST["dicari"])?$_POST["dicari"]:"";?>"></td>
    <td><input type="submit" name="TblCari" value="Cari">
	</tr>
</table>
</form>
<a href="dosen.php"><button>Data Dosen</button></a>
<br><br>
<?php
	if(isset($_POST["TblCari"])){
$db=dbConnect();
if($db->connect_errno==0){
	$dicari=$db->escape_string($_POST["dicari"]);
	$sql="select nip, nama_dos, alamat_dos, no_telp 
	from dosen where nip like '%$dicari%' or nama_dos like '%$dicari%'";
	$res=$db->query($sql);
	if($res){ // eksekusi sql sukses
		?>
		
		
		<?php
		$data=$res->fetch_all(); 
		foreach($data as $barisdata){ 
			?>
			<table border="1">
		<tr><th>NIP</th><th>Nama Dosen</th><th>Alamat</th>
		    <th>No Telepon</th>
			</tr>
			<tr>
			<td width=200px align="center"><?php echo $barisdata[0];?></td>
			<td width=200px align="center"><?php echo $barisdata[1];?></td>
			<td width=200px align="center"><?php echo $barisdata[2];?></td>
			<td width=200px align="center"><?php echo $barisdata[3];?></td>
			</tr>
		</table>
			<?php
		}
		$res->free();
	}
	
	else
		echo "Gagal Eksekusi SQL".(DEVELOPMENT?" : ".$db->error:"")."<br>";
}
else
	echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
	}
	else
		echo "Isilah keyword pencarian untuk melakukan pencarian.";
?>
</body>
</html>
