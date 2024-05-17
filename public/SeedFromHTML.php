<?php
$target = 'dep';
$dir = $target;
$files = scandir($dir);
$files = array_diff($files, array('.', '..'));
// $i=0;
$paths = array();
foreach ($files as $key => $value) {
	// $i++;
// 	$dir2 = $target.'/accessory/'.$value;
// 	$files2 = scandir($dir2);
// 	$files2 = array_diff($files2, array('.', '..'));
// 	if(!empty($files2)){
		$paths[] = 'dep/'.$value;
// 	}
}
$products = array();
$i = 0;
foreach ($paths as $k => $filePath) {
	$p = array();
	$p['id'] = $k+157;
	$str = file_get_contents($filePath);
	$str = str_replace('  ', '',$str);
	$str = str_replace('	', '',$str);
	$str = str_replace(array("\r", "\n"), '', $str);
	var_dump('<br>'.$filePath.'-------------------------------------------<br>'); 

	// preg_match_all("/\<div class\=\"specs\_\_name\"\>(.+?)\:\<\/div\>/is", $str, $matches);
	// var_dump(sizeof($matches[1])); 

	// title <span id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_spTitleProductName">Le Chevalier d'Or Merlot </span>
	// title /\<span id\=\"ctl00\_ContentPlaceHolder1\_ProductBasicInformation1\_spTitleProductName\"\>(.+?)\<\/span\>
	preg_match_all("/\<title\>(.+?)\<\/title\>/is", $str, $matches);
	if(isset($matches[1][0])){
		$p['title'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	}
	$matches = null;

	preg_match_all("/\<meta name\=\"description\" content\=\"(.+?)\" \/\>/is", $str, $matches);
	if(isset($matches[1][0])){
		$p['desc'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	}
	$matches = null;

	preg_match_all("/\<meta name\=\"keywords\" content\=\"(.+?)\" \/\>/is", $str, $matches);
	if(isset($matches[1][0])){
		$p['keyword'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	}
	$matches = null;
	// price <span id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_spProdesPriceVal" style="font-weight: bold; color: #9C0C14;">Li&#234;n hệ</span>
	// preg_match_all("/\<span class\=\"original_price\"\>(.+?) vnđ\<\/span\>/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['price'] = str_replace(',','',ltrim(rtrim(html_entity_decode($matches[1][0])))); 
	// }
	// $matches = null;
	// preg_match_all("/\<span class\=\"price\"\>(.+?) vnđ\<\/span\>/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['price_promo'] = str_replace(',','',ltrim(rtrim(html_entity_decode($matches[1][0])))); 
	// }
	// $matches = null;
	// xuatxu <span id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_spOriginVal">Bordeaux - Ph&#225;p</span>
	preg_match_all("/\<div class\=\"news\_content\"\>(.+?)\<\/div\>\<div class\=\"share\-this\-wrap\"\>/is", $str, $matches);
	if(isset($matches[1][0])){
		$p['desc_full'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	}
	$matches = null;
	// xephang <span id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_spProdesRatingVal">Vin de France</span>
	// preg_match_all("/itemprop\=\'url\' title\=\'(.+?)\'\>\<span itemprop\=\'title\'\>(.+?)\<\/span\>\<\/a\>\<\/li\>\<\/ul\>\<\/div\>/is", $str, $matches);
	// if(isset($matches[1][1])){
	// 	$p['category'] = ltrim(rtrim(html_entity_decode($matches[1][1]))); 
	// }
	// $matches = null;

	// preg_match_all("/\<a href\=\"(.+?)\" id\=\"this\_map\"\>/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['img'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	// }
	// $matches = null;
	// $matches = null;
	// namsanxxuat <span id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_spProdesDatingVal">2014</span>
	// preg_match_all("/\<span id\=\"ctl00\_ContentPlaceHolder1\_ProductBasicInformation1\_spProdesDatingVal\"\>(.+?)\<\/span\>/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['namsanxuat'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	// }
	// $matches = null;
	// // nongdocon <span id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_spProdesAlcoholVal">12,5% Vol</span>
	// preg_match_all("/\<span id\=\"ctl00\_ContentPlaceHolder1\_ProductBasicInformation1\_spProdesAlcoholVal\"\>(.+?)\<\/span\>/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['nongdocon'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	// }
	// $matches = null;
	// // dungtich <span id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_spProdesCapacityVal">750ml</span>
	// preg_match_all("/\<span id\=\"ctl00\_ContentPlaceHolder1\_ProductBasicInformation1\_spProdesCapacityVal\"\>(.+?)\<\/span\>/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['dungtich'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	// }
	// $matches = null;
	// // nguyenlieu <span id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_spProdesMaterialVal">100% Merlot</span>
	// preg_match_all("/\<span id\=\"ctl00\_ContentPlaceHolder1\_ProductBasicInformation1\_spProdesMaterialVal\"\>(.+?)\<\/span\>/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['nguyenlieu'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	// }
	// $matches = null;
	// // desc <div id="ctl00_ContentPlaceHolder1_ProductBasicInformation1_divProdesDescription" class="boxListProductInfoProInfo_SubInfo" style="font-size:12px;"></div>
	// preg_match_all("/\<div id\=\"ctl00\_ContentPlaceHolder1\_ProductBasicInformation1\_divProdesDescription\" class\=\"boxListProductInfoProInfo\_SubInfo\" style\=\"font\-size\:12px\;\"\>(.+?)\<\/div\>/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['desc'] = $matches[1][0]; 
	// }
	// $matches = null;
	// // img showProductGallery('(.+?)')
	// preg_match_all("/showProductGallery\(\'(.+?)\'\)/is", $str, $matches);
	// if(isset($matches[1][0])){
	// 	$p['img'] = ltrim(rtrim(html_entity_decode($matches[1][0]))); 
	// }
	// $matches = null;
	$products[] = $p;
	var_dump($p); 
}

// Kết nối DB
$servername = "localhost";
$username = "cuahangv";
$password = "Tu1080801108";
$dbname = "happyclo_depchieu";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_set_charset($conn,"utf8");
foreach ($products as $p) {
	$sql = "INSERT INTO posts (";
	foreach ($p as $k => $v) {
		$sql .= "`".$k."`,";
	}
	$sql = substr($sql, 0,-1);
	$sql .= ") VALUES (";
	foreach ($p as $k => $v) {
		$v = str_replace("'", "", $v);
		$sql .= "'".$v."',";
	}
	$sql = substr($sql, 0,-1);
	$sql .= ");";
	var_dump($sql, $conn->query($sql));
}
$conn->close();
/*
INSERT INTO categories (title) SELECT DISTINCT category as title FROM `posts` WHERE category IS NOT NULL and id > 21;
update posts e inner join categories d on e.category = d.`title` set e.category = d.id;

INSERT INTO product_phukien_tinhtrangs (name) SELECT DISTINCT tinhtrang as name FROM `product_phukiens` WHERE tinhtrang IS NOT NULL;
update product_phukiens e inner join product_phukien_tinhtrangs d on e.tinhtrang = d.`name` set e.tinhtrang = d.id;

INSERT INTO product_phukien_options (name) SELECT DISTINCT options as name FROM `product_phukiens` WHERE options IS NOT NULL;
update product_phukiens e inner join product_phukien_options d on e.options = d.`name` set e.options = d.id;

INSERT INTO product_phukien_conditions (name) SELECT DISTINCT `condition` as name FROM `product_phukiens` WHERE `condition` IS NOT NULL;
update product_phukiens e inner join product_phukien_conditions d on e.`condition` = d.`name` set e.`condition` = d.id;

UPDATE `product_phukiens` SET `price` = ROUND(price*23000/1000000);

*/
?>