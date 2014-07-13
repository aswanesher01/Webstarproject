<? 

include "../../inc/conn.php";

$nopol		= $_REQUEST['nopol'];
$status		= $_REQUEST['status'];

$sql=mysql_query("update produk set status='$status' where no_polisi='$nopol'");
$sms=mysql_query("insert into outbox(DestinationNumber, TextDecoded) values ('$nohp', 'Pembelian produk berhasil, silahkan lakukan pembayaran premi sebesar Rp. xxx ke no. rek 123123 a.n xxx')");
if($sql) {
	echo "2";	
} else {
	echo "1";	
}

?>