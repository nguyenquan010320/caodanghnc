<?php
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
echo '<url>' . PHP_EOL;
echo '<loc>'.$domain.'</loc>' . PHP_EOL;
echo '<priority>1.00</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;
foreach($category as $c)
{
	echo '<url>' . PHP_EOL;
	echo '<loc>'.$domain.$c['link'].'</loc>' . PHP_EOL;
	echo '<changefreq>daily</changefreq>' . PHP_EOL;
	if(!empty($c["google_priority"])) {
		echo '<priority>'.$c["google_priority"].'</priority>' . PHP_EOL;
	}else{
		echo '<priority>0.8</priority>' . PHP_EOL;
	}
	echo '</url>' . PHP_EOL;
}
foreach($post as $p) if(in_array(1, $p['categoryParent']) || in_array(2, $p['categoryParent']) || in_array(3, $p['categoryParent']) || in_array(4, $p['categoryParent']))
{
	echo '<url>' . PHP_EOL;
	echo '<loc>'.$domain.$p['link'].'</loc>' . PHP_EOL;
	echo '<changefreq>daily</changefreq>' . PHP_EOL;
	if(!empty($p["google_priority"])) {
		echo '<priority>'.$p["google_priority"].'</priority>' . PHP_EOL;
	}else{
		echo '<priority>0.8</priority>' . PHP_EOL;
	}
	echo '</url>' . PHP_EOL;
}
echo '</urlset>' . PHP_EOL;
?> 