<?php
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
echo '<rss version="2.0">' . PHP_EOL;
echo '<channel>' . PHP_EOL;
echo '<title>'.$site['tieu-de-trang'].'</link>' . PHP_EOL;
echo '<link>'.$domain.'</link>' . PHP_EOL;
echo '<description>'.$site['gioi-thieu-trang'].'</description>' . PHP_EOL;
foreach($category as $c)
{
	echo '<item>' . PHP_EOL;
	echo '<title>'.$c['title'].'/</title>' . PHP_EOL;
	echo '<link>'.$domain.$c['link'].'/</link>' . PHP_EOL;
	echo '<description>'.strip_tags($c['desc']).'/</description>' . PHP_EOL;
	echo '<pubDate>'.$c['created_at'].'</pubDate>' . PHP_EOL;
	echo '<guid>'.$domain.$c['link'].'/</guid>' . PHP_EOL;
	echo '</item>' . PHP_EOL;
}
foreach($post as $p) if(in_array(1, $p['categoryParent']) || in_array(2, $p['categoryParent']) || in_array(3, $p['categoryParent']) || in_array(4, $p['categoryParent']))
{
	echo '<item>' . PHP_EOL;
	echo '<title>'.$p['title'].'</title>' . PHP_EOL;
	echo '<link>'.$domain.$p['link'].'</link>' . PHP_EOL;
	echo '<description>'.strip_tags($p['desc']).'</description>' . PHP_EOL;
	echo '<pubDate>'.$p['created_at'].'</pubDate>' . PHP_EOL;
	echo '<guid>'.$domain.$p['link'].'</guid>' . PHP_EOL;
	echo '</item>' . PHP_EOL;
}
echo '</channel>' . PHP_EOL;
echo '</rss>' . PHP_EOL;
?>