<?php
session_start();
if (!isset($_SESSION["username"]))
header("Location: index.php?error=4");
?>
<?php include_once("functions.php");?>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	if(isset($_POST["TblLogin"])){
		$username=$db->escape_string($_POST["username"]);
		$password=$db->escape_string($_POST["password"]);
		$sql="SELECT username FROM akun
			  WHERE username='$username' and password=MD5('$password')";
		$res=$db->query($sql);
		if($res){
			if($res->num_rows==1){
				$data=$res->fetch_assoc();
				session_start();
				$_SESSION["username"]=$data["username"];
				$_SESSION["passphrase"]=openssl_random_pseudo_bytes(16);
				$_SESSION["iv"]=openssl_random_pseudo_bytes(16);
				header("Location: index-admin.php");
				
			}
			else
				header("Location: index.php?error=1");
		}
	}
	else
		header("Location: index.php?error=2");
}
else
	header("Location: index.php?error=3");
?>