<?php
$host = 'graph.facebook.com';
$method = 'GET';
$path = '/v2.3/'.$page_id.'/feed'; // api call path

$query = array( // query parameters
    'limit' => $count,
    'access_token' => $app_id.'|'.$app_secret
);

include "functions.php";

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
    || $_SERVER['SERVER_PORT'] == 443) {

    $protocol = 'https://';
} else {
    $protocol = 'http://';
}


print('<?xml version="1.0" encoding="utf-8"?>'. PHP_EOL);
print('<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en" xml:base="'.$_SERVER['SERVER_NAME'].'">'. PHP_EOL);

print('<id>tag:facebook.com,2006:/'.$facebook_data['data'][0]['from']['name'].'</id>'. PHP_EOL);
print('<title>@'.$facebook_data['data'][0]['from']['name'].'</title>'. PHP_EOL);
@print('<updated>'.date('c', strtotime($facebook_data['data'][0]['updated_time'])).'</updated>'. PHP_EOL);

print('<link href="https://facebook.com/'.$facebook_data['data'][0]['from']['id'].'"/>'. PHP_EOL);
print('<link href="'.$protocol.$_SERVER['SERVER_NAME'].str_replace("&", "&amp;", $_SERVER['REQUEST_URI']).'" rel="self" type="application/atom+xml" />'. PHP_EOL);

include "feed.php";
?>
