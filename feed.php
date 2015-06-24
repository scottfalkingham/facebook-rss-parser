<?php

$fd = $facebook_data['data'];

$arrLen = count($fd);
for ($i=0; $i<$arrLen; $i++) {
	print(PHP_EOL. '	<entry>'. PHP_EOL);
		print('		<id>tag:facebook.com,' . date("Y-m-d", strtotime($fd[$i]['created_time'])) . ':/' . $fd[$i]['from']['name'] . '/statuses/' . $fd[$i]['id'] . '</id>'. PHP_EOL);
		print('		<link href="'.$fd[$i]['link'] .'" rel="alternate" type="text/html"/>'. PHP_EOL);
		print('		<title>'.$fd[$i]['from']['name'].': '.htmlspecialchars($fd[$i]['message']).'</title>'. PHP_EOL);
		print('		<summary type="html"><![CDATA['.$fd[$i]['from']['name'].': '.$fd[$i]['message'].']]></summary>'. PHP_EOL);

		$feedContent = '		<content type="html"><![CDATA[<p>'.nl2br($fd[$i]['message']).'</p>]]></content>';
		$text = processString($feedContent);

		print($text . PHP_EOL);
		print('		<updated>'.date('c', strtotime($fd[$i]['updated_time'])).'</updated>'. PHP_EOL);
		print('		<author><name>'.$fd[$i]['from']['name'].'</name></author>'. PHP_EOL);
	print('	</entry>'. PHP_EOL);
}

print('</feed>'. PHP_EOL);
print('<!-- vim:ft=xml -->');
?>
