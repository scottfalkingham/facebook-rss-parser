<?php

$url = "https://$host$path";

$url .= "?".http_build_query($query);
$url=str_replace("&amp;","&",$url); //Patch by @Frewuill
$url = str_replace("%25", "%", $url);

$options = array( CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_SSL_VERIFYPEER => false);

// do our business
$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);


$facebook_data = json_decode($json, true);

function processString($s) {
    return preg_replace('/https?:\/\/[\w\-\.!~#?&=+\*\'"(),\/]+/','<a href="$0">$0</a>',$s);
}

function printArray($s){
	print("<pre>");
	print_r($s);
	print("</pre>". PHP_EOL);
}

if (isset( $_GET["test"] )){	
	print('id: ' . gettype($facebook_data['data'][0]['from']['id']). '<br>'. PHP_EOL);
	print('id_str: ' . gettype($facebook_data['data'][0]['from']['id']). PHP_EOL);
	
	if ($_GET["test"] == 'json')
		$test = $json;
	else
		$test = $facebook_data;
	
	printArray($test);
	
	printArray("url: + " . $url);
}

?>
