<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
	$db=new mysqli("localhost","root","","database10119251");// Sesuaikan dengan konfigurasi server anda.
	return $db;
}
// getListKategori digunakan untuk mengambil seluruh data dari tabel produk
function getListFakultas(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM fakultas
						 ORDER BY nm_fakultas");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getListKode(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM matakuliah
						 ORDER BY kode");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getListNim(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM mahasiswa
						 ORDER BY nim");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getListDosen(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * 
						 FROM dosen
						 ORDER BY nip");
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

// digunakan untuk mengambil data sebuah produk
function getDataDosen($nip){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM dosen WHERE nip='$nip'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataMahasiswa($nim){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM mahasiswa WHERE nim='$nim'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataFakultas($nm_fakultas){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM fakultas WHERE nm_fakultas='$nm_fakultas'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataMatakuliah($kode){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT m.kode, m.nama_mk, m.sks, d.nama_dos FROM matakuliah m JOIN dosen d ON m.nip=d.nip WHERE kode='$kode'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataRegistrasi($idregistrasi){
	$db=dbConnect();
	if($db->connect_errno==0){
		$res=$db->query("SELECT * FROM registrasi WHERE idregistrasi='$idregistrasi'");
		if($res){
			if($res->num_rows>0){
				$data=$res->fetch_assoc();
				$res->free();
				return $data;
			}
			else
				return FALSE;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function banner(){
	?>
<div id="banner"><h1>Data Kampus XX</h1>
</div>
	<?php
}
function navigator(){
	?>
<div id="navigator">
| <a href="dosen.php">Dosen</a> 
| <a href="fakultas.php">Fakultas</a> 
| <a href="mahasiswa.php">Mahasiswa</a> 
| <a href="matakuliah.php">Mata Kuliah</a> 
| <a href="registrasi.php">Registrasi</a> 
| <a href="logout.php">Logout</a> 
|
</div>
	<?php
}
function showError($message){
	?>
<div style="background-color:#FAEBD7;padding:10px;border:1px solid red;margin:15px 0px">
<?php echo $message;?>
</div>
	<?php
}
?>