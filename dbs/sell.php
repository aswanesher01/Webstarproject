<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 /**
     * Check user is existed or not
     */

 

$response = array();
 

if (isset($_POST['nopol']) && isset($_POST['noranka']) && isset($_POST['nomesin'])&& isset($_POST['thrkt'])) {
 
    $nopol = $_POST['nopol'];
    $norangka = $_POST['noranka'];
    $nomesin = $_POST['nomesin'];
    $thrkt = $_POST['thrkt'];
    $id_dbs= $_POST['id_dbs'];
    $name=$_POST['name'];

    require_once __DIR__ . '/db_connect.php';
 

    $db = new DB_CONNECT();
if(!cek_tahun($thrkt)){
        $response["success"] = 0;
        $response["message"] = "'-Tahun Pembuatan (5 years old)'";

echo json_encode($response);
}
elseif (cek_nopol($nopol)) {
        $response["success"] = 0;
        $response["message"] = "no polisi already existed.";

echo json_encode($response);
}
else{
    $date= date("Y-m-d");
    $result = mysql_query("INSERT INTO produk(no_polisi, no_rangka, no_mesin,tahun_rakit,status,tgl_daftar,tgl_aktif,nama_pemilik,Id_dbs) VALUES('$nopol', '$norangka', '$nomesin',
        '$thrkt','','$date','','$id_dbs','$name')");
 
    if ($result) {
      
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
 
       
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
      
        echo json_encode($response);
    }
}
    //disini
} else {
    
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    echo json_encode($response);
}



    function cek_nopol($nopol) {
        $result = mysql_query("SELECT no_polisi from produk WHERE no_polisi = '$nopol'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
           
            return true;
        } else {
            return false;
        }
    }
    
    function cek_tahun($tahun){
   $isValid = true;
   $date = date("Y");
   $hasil=$date-$tahun;
   if($hasil>5){
       return false;
   }
   return $isValid;

}
?>
