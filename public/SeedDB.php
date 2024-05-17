<?php 
// Kết nối DB
$servername = "localhost";
$username = "happyclo";
$password = "Tu@1080801108";
$dbname = "happyclo_ibcgroup";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
mysqli_set_charset($conn,"utf8");

// for($i=6;$i<492;$i++){
// 	$result = $conn->query('SELECT price,category_other FROM posts WHERE id='.$i);
// 	$row = $result->fetch_array(MYSQL_BOTH);
// 	$c = json_decode($row['category_other'],true);
// 	if((int)$row['price'] < 1000000){ $c['gia'] = array(162); }
// 	elseif((int)$row['price'] < 1500000){ $c['gia'] = array(163); }
// 	elseif((int)$row['price'] < 2000000){ $c['gia'] = array(164); }
// 	elseif((int)$row['price'] < 3000000){ $c['gia'] = array(165); }
// 	elseif((int)$row['price'] <= 5000000){ $c['gia'] = array(166); }
// 	elseif((int)$row['price'] > 5000000){ $c['gia'] = array(167); }
// 	else{ $c['gia'] = 168; }
// 	var_dump(json_encode($c)); 
// 	var_dump($conn->query('UPDATE posts SET category_other=\''.json_encode($c).'\'  WHERE id='.$i));
// }

// for($i=6;$i<492;$i++){
// 	$result = $conn->query('SELECT category_other,img_other FROM posts WHERE id='.$i);
// 	$row = $result->fetch_array(MYSQL_BOTH);
// 	$c = json_decode($row['category_other'],true);
// 	$d = json_decode($row['img_other'],true);
// 	var_dump(serialize($c),serialize($d));
// 	var_dump($conn->query('UPDATE posts SET category_other=\''.serialize($c).'\', img_other=\''.serialize($d).'\'  WHERE id='.$i));
// }

// for($i=6;$i<527;$i++){
// 	$result = $conn->query('SELECT title FROM posts WHERE id='.$i);
// 	$row = $result->fetch_array(MYSQL_BOTH);
// 	$sku = mb_strtoupper(preg_replace('/[^A-Za-z0-9]/', '',$row['title']));
// 	var_dump($conn->query("UPDATE posts SET sku='{$sku}' WHERE id={$i}"));
// }

for($i=6;$i<=526;$i++){
	if($i<492||($i>506&&$i<531)||$i>517){
		var_dump($i); 
	$post = $conn->query('SELECT category,category_other FROM posts WHERE id='.$i)->fetch_array(MYSQL_BOTH);
	$keyword = [];
	$categoryArr = explode(',', $post['category']);
	foreach ($categoryArr as $c) {
		$category = $conn->query('SELECT title,parent,keyword FROM categories WHERE id='.$c)->fetch_array(MYSQL_BOTH);
		$keyword[] = $category['title'];
		if(!empty($category['parent'])){
			$category2 = $conn->query('SELECT title,parent,keyword FROM categories WHERE id='.$category['parent'])->fetch_array(MYSQL_BOTH);
			$keyword[] = $category2['title'];
			$keyword[] = $category['keyword'];
			$keyword[] = $category2['keyword'];
			if(!empty($category2['parent'])){
				$category3 = $conn->query('SELECT title,parent,keyword FROM categories WHERE id='.$category2['parent'])->fetch_array(MYSQL_BOTH);
				$keyword[] = $category3['title'];
				$keyword[] = $category3['keyword'];
				if(!empty($category3['parent'])){
					$category4 = $conn->query('SELECT title,parent,keyword FROM categories WHERE id='.$category3['parent'])->fetch_array(MYSQL_BOTH);
					$keyword[] = $category4['title'];
					$keyword[] = $category4['keyword'];
					if(!empty($category4['parent'])){
						$category5 = $conn->query('SELECT title,parent,keyword FROM categories WHERE id='.$category4['parent'])->fetch_array(MYSQL_BOTH);
						$keyword[] = $category5['title'];
						$keyword[] = $category5['keyword'];
					}
				}
			}
		}
	}
	// ['thuonghieu','chatlieu','mausac','gia','khuyenmai','soluong']
	$categoryOther = json_decode($post['category_other']);
	if(!empty($categoryOther)){
	foreach ($categoryOther as $k=>$c) {
		foreach ($c as $c2) {
			$category = $conn->query('SELECT title FROM categories WHERE id='.$c2)->fetch_array(MYSQL_BOTH);
			if($k=='soluong'){
				$keyword[] = $category['title'];
				if($keyword[1] != 'Sản phẩm' && $keyword[1] != 'Tủ rượu'){
				$keyword[] = $keyword[1].' '.$category['title'];
				$keyword[] = $keyword[0].' '.$category['title'];
			}
			}
			if($k=='thuonghieu' && $keyword[4]!='Rượu vang'){
				if($category['title']!='Thương hiệu khác'&&$keyword[1] != 'Sản phẩm'){
					$keyword[] = $keyword[1].' '.$category['title'];
				}
				if($category['title']=='IBC'){
					$keyword[] = $keyword[0].' '.$category['title'];
				}
			}
			if($k=='chatlieu'){
				if($category['title']=='PC (nhựa dẻo cao cấp)'){
					$keyword[] = $keyword[1].' nhựa dẻo PC';
				}elseif($category['title']=='ABS (nhựa cứng cao cấp)'){
					$keyword[] = $keyword[1].' nhựa cứng ABS';
				}elseif($keyword[1] != 'Sản phẩm'){
					$keyword[] = $keyword[1].' '.$category['title'];
				}
			}
			if($k=='khuyenmai'){
				$keyword[] = $keyword[1].' '.substr($category['title'], 6);
			}
			if($k=='mausac'){
				$keyword[] = $keyword[1].' màu '.$category['title'];
				$keyword[] = $keyword[1].' '.$category['title'];
			}
		}
	}}

	$keyword = array_diff($keyword,['Sản phẩm','Vali','Balo']);

	$keyword = array_filter(array_unique($keyword)); 
	$keyword = mb_strtolower(implode(',', $keyword));

	var_dump($i,$conn->query("UPDATE posts SET keyword='{$keyword}' WHERE id={$i}"));
}}
$conn->close();
?>