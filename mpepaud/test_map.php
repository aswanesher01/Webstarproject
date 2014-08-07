<? 
$address=$_REQUEST['address'];

	$address = urlencode($address);//India, Tamil nadu, chennai

	//If you want an extended data set, change the output to "xml"instead of csv
	$local = "ABQIAAAAkGMwVXYXPd1ca9opxkmJeRS0jHQK4ys7cQUygIGq5srO1DwAzRTz5D0mZT53BCeHRWnBJ8DBtnsJ6w";
	$url = "http://maps.google.com/maps/geo?q=".$address."&
output=csv&key=".$local;
	//Set up a CURL request, telling it not to spit back headers,and to throw out a user agent.
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER,0); 
//Change this to a 1 to return headers
	curl_setopt($ch, CURLOPT_USERAGENT,
$_SERVER["HTTP_USER_AGENT"]);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$data = curl_exec($ch);
	curl_close($ch);

	echo $data;

?>