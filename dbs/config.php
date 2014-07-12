<? 

/* Anugrah Jaya Steel Data Management */
/*            By Agus Setiawan        */

$host   = "localhost"; // Host config
$user   = "root"; // MySql user config
$passwd = ""; // MySql password config

$dbname = "dbs_app"; // Db name config

$koneksi = mysql_connect($host, $user, $passwd);
$db = mysql_select_db($dbname, $koneksi);
if($koneksi>1) {
	echo "";	
} else {
	echo "Gagal";	
}

?>