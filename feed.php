<?php

$fd = $facebook_data['data'];

$arrLen = count($fd);
for ($i=0; $i<$arrLen; $i++) {

    print(PHP_EOL. '	<entry>'. PHP_EOL);

        print('		<id>tag:facebook.com,' . date("Y-m-d", strtotime($fd[$i]['created_time'])) . ':/' . $fd[$i]['from']['name'] . '/statuses/' . $fd[$i]['id'] . '</id>'. PHP_EOL);

        if(isset($fd[$i]['link']) && $fd[$i]['type'] == 'photo'){
            print('		<link href="'.$fd[$i]['link'] .'" rel="alternate" type="text/html"/>'. PHP_EOL);
        }else{
            print('		<link href="http://facebook.com/'.$fd[$i]['id'] .'" rel="alternate" type="text/html"/>'. PHP_EOL);
        }

        print('		<title>'.getFeedTitle($fd[$i]).'</title>'. PHP_EOL);-

        print('		<summary type="html"><![CDATA['.$fd[$i]['message'].']]></summary>'. PHP_EOL);

        $text = '		<content type="html"><![CDATA[<p>'.processString(nl2br($fd[$i]['message'].'  '.$fd[$i]['link'])).'</p>'.(isset($fd[$i]['picture'])?'<img src="'.$fd[$i]['picture'].'"/>':'').']]></content>';

        print($text . PHP_EOL);
        print('		<pubdate>'.date('c', strtotime($fd[$i]['created_time'])).'</pubdate>'. PHP_EOL);
        print('		<updated>'.date('c', strtotime($fd[$i]['updated_time'])).'</updated>'. PHP_EOL);
        print('		<author><name>'.$fd[$i]['from']['name'].'</name></author>'. PHP_EOL);

    print('	</entry>'. PHP_EOL);

}

print('</feed>'. PHP_EOL);
print('<!-- vim:ft=xml -->');

function getFeedTitle($feed) {

    $title = "";
    if(isset($feed['message'])){
        appendStringToTitle($feed['message'], $title);
    }

    if(isset($feed['link']) && isset($feed['name'])){
        if ($title) $title .= " - ";
            appendStringToTitle($feed['name'], $title);
    }

    if (! $title) {
            appendStringToTitle(strlen($feed['story']), $title);
    }

    return htmlspecialchars($title);

}

function appendStringToTitle($string_append, &$title) {
    $title_size = 100;

    if (strlen($title) < 100) {
        $title .= strlen($string_append) > ($title_size - strlen($title)) ?
                    substr($string_append, 0, ($title_size - strlen($title))) . "..."
                    : $string_append;
    }
}

?>
