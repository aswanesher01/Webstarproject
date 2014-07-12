<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['email']) && isset($_POST['pass'])){
 
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("select * From register_user where email='$email' and password='$pass'");
 
    // check if row
    if (mysql_num_rows($result) > 0) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Login successfully.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
