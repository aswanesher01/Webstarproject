<?php 

include ("inc/conn.php");

session_start();

$pengacak 			= "AJWKXLAJSCLWLW";
$passLama			= addslashes(md5($pengacak. md5($_REQUEST['passLama']) .$pengacak));
$passBaru			= addslashes(md5($pengacak. md5($_REQUEST['passBaru']) .$pengacak));
$passBarus			= addslashes(md5($pengacak. md5($_REQUEST['passBarus']) .$pengacak));

$sqlcek="SELECT password FROM admin WHERE username='".$_SESSION['username']."'";
$rscek=mysql_query($sqlcek);
$cek=mysql_fetch_array($rscek);

if ($passLama!=$cek['password']) {
   echo "<script>
   alert('Password Lama Salah');
	location.href='home.php?module=ubah_password.php';</script>";
} else if (($passBaru)<>($passBarus)) {
	echo "<script>
   alert('Password Baru Tidak Sama');
	location.href='home.php?module=ubah_password.php';</script>";
} else {
		$sql="UPDATE admin SET password='".$passBarus."' WHERE username='".$_SESSION['username']."'";
		$rs=mysql_query($sql);
		echo "<script>
   alert('Password Berhasil Diubah');
	location.href='home.php?module=ubah_password.php';</script>";
} 

?>