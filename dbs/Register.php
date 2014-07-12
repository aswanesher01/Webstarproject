<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 /**
     * Check user is existed or not
     */

 

$response = array();
 

if (isset($_POST['nama']) && isset($_POST['nohp']) && isset($_POST['email'])&&($_POST['pass'])) {
 
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $email= $_POST['email'];
    $pass = md5($_POST['pass']);
 

    require_once __DIR__ . '/db_connect.php';
 

    $db = new DB_CONNECT();
if(!cek_email($email)){
        $response["success"] = 0;
        $response["message"] = "Invalid Email Id.";

echo json_encode($response);
}
elseif (cek_user($email)) {
        $response["success"] = 0;
        $response["message"] = "Email already existed.";

echo json_encode($response);
}
else{
    $result = mysql_query("INSERT INTO register_user(Id_dbs, nama, nomor_hp,password,email) VALUES('11', '$nama', '$nohp','$pass','$email')");
 

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



    function cek_user($email) {
        $result = mysql_query("SELECT email from register_user WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
           
            return true;
        } else {
            return false;
        }
    }
    
    function cek_email($email){
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\.\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\-\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\.\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if(!preg_match('/^(\\.|[A-Za-z0-9!#%&`_=\/$*+?^{}|~.-])+$/',str_replace("\\","",$local)))
      {
         // character not valid in local part unless
         // local part is quoted
         if (!preg_match('/^"(\\"|[^"])+"$/', str_replace("\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") ||(checkdnsrr($domain,"A"))))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;

}
?>
