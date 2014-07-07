<?php
include ("inc/conn.php");

$pengacak = "AJWKXLAJSCLWLW";
$username=addslashes($_POST['_username']);
$password=addslashes(md5($pengacak. md5($_POST['_password']) .$pengacak));
$lvl=$_POST['lvl'];


$sql="SELECT * FROM admin WHERE username='".$username."' AND password='".$password."'";
$query=mysql_query($sql, $conn);

$data=mysql_fetch_array($query);
$pass=$data['password'];
if($pass == ""){
   echo "<script>location.href='index.php';</script>";
}else{

$passcek=$data['password'];
switch ($passcek) {
	case ($passcek==$password) : session_start();
		$_SESSION['username']=$username;
		echo "<script>location.href='home.php';</script>";
	break;
  default:
    echo "<script>location.href='index.php';</script>";
	break;
	case ($passcek!=$password) : 
    echo "<script>location.href='index.php';</script>";
	break;
	}
}
?>
<?php mysql_close($conn); ?>
