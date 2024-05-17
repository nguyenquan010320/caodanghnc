<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dirList = ['../resources/views/layouts','../resources/views/site','../resources/views/module','../resources/views/section'];
$runReal = true;
// $runReal = false;
$updateImgSize = false;
$posts = true;
$postsid = 36;
// $posts = false;

$values = [];
$num = 1;
foreach ($dirList as $dir) {
	$files = scandir($dir);
	$files = array_diff($files, array('.', '..'));
	foreach ($files as $f) {
		$filePath = $dir.'/'.$f;
		if((substr($f, -4,4) == '.php') && file_get_contents($filePath)){
			$str=file_get_contents($filePath);
			// ;;title;;value;;
			preg_match_all("/\;\;(.+?)\;\;(.+?)\;\;/is", $str, $matches);
			if(!empty($matches[1])){
				$fx = 0;
				foreach ($matches[1] as $k=>$v) {
					$code = cleanText(getPathFromString($v));
					$type = 'text';
					if(substr($code, 0,3)=='anh'){$type = 'img';}
					if(substr($code, 0,4)=='link'){$type = 'link';}
					if(substr($code, 0,4)=='doan'){$type = 'textarea';}
					if(substr($code, 0,8)=='noi-dung'){$type = 'cktextarea';}
					if(substr($code, 0,2)=='nd'){$type = 'cktextarea';}
					if(substr($code, 0,4)=='file'){$type = 'file';}
					if(substr($code, 0,5)=='video'){$type = 'video';}
					if(substr($code, 0,5)=='mo-ta'){$type = 'notextarea';}
					if(substr($code, 0,2)=='mt'){$type = 'notextarea';}
					if(substr($code, 0,7)=='bat-tat'){$type = 'onoff';}
					if(substr($code, 0,2)=='bt'){$type = 'onoff';}
					if($code=='lang'){
						$code = rand(111111,999999).'-'.cleanText(getPathFromString($matches[2][$k]));
						$values[$code] = ['code'=>$code,'title'=>$matches[2][$k],'value'=>$matches[2][$k],'type'=>$type];	
					}else{
						$code = $code.'-'.$f.'-'.time().'-'.$num++;
						$code = str_replace(['.blade.php','16759'], '', $code);
						$values[$code] = ['code'=>$code,'title'=>$v,'value'=>$matches[2][$k],'type'=>$type];
					}
					if($values[$code]['value'] == ' '){$values[$code]['value'] = '';}
					$values[$code]['title'] = str_replace(' s ', ' section ', $values[$code]['title']);
					$values[$code]['title'] = str_replace('td ', 'Tiêu đề ', $values[$code]['title']);
					$values[$code]['title'] = str_replace('mt ', 'Mô tả ', $values[$code]['title']);
					$values[$code]['title'] = str_replace('nd ', 'Nội dung ', $values[$code]['title']);
					$values[$code]['title'] = str_replace('bt ', 'Bật tắt ', $values[$code]['title']);
					$values[$code]['title'] = str_replace(' số', '', $values[$code]['title']);

					if($type == 'img' && !empty($values[$code]['value'])){
						$imgurl = str_replace(' ', '%20', $values[$code]['value']);
						if(strpos($imgurl,'://') !== false){
							$size = @getimagesize($imgurl);
						}else{
							$size = @getimagesize('http://'.$_SERVER['HTTP_HOST'].$imgurl);

						}
						if(!empty($size) && is_array($size) && !empty($size[0]) && !empty($size[1])){
							$values[$code]['title'] .= ' '.$size[0].'x'.$size[1].'px';
						}
					}

					# $values[$code]['title'] = preg_replace('/\W\w+[0-9]*$/', '', $values[$code]['title']);

					if($posts){
						$fx++;
						if(substr($code, 0,7)=='bat-tat' || substr($code, 0,2)=='bt'){
							$str = str_replace_first($matches[0][$k], '@if($s["f'.$fx.'"] == "1")',$str);
						}elseif(substr($code, 0,12)=='link-youtube'){
							$str = str_replace_first($matches[0][$k], '{!!Helper::youtube($s["f'.$f.'"])!!}',$str);
						}else{
							$str = str_replace_first($matches[0][$k], '{!! $s["f'.$fx.'"] or "" !!}',$str);
						}
					}else{
						if(substr($code, 0,7)=='bat-tat' || substr($code, 0,2)=='bt'){
							$str = str_replace_first($matches[0][$k], '@ifturnon("'.$code.'")',$str);
						}elseif(substr($code, 0,12)=='link-youtube'){
							$str = str_replace_first($matches[0][$k], '{!!Helper::youtube($site["'.$code.'"])!!}',$str);
						}else{
							$str = str_replace_first($matches[0][$k], '@site("'.$code.'")',$str);
						}
					}
				}
				if($runReal)
					file_put_contents($filePath, $str);
			}
		}
	}
}
var_dump($values); 
if($posts){
	$fx = 0;
	foreach ($values as $key => $v) {
		$fx++;
		echo "{!! Helper::inputLabelNormal(\$lang,\$languages,'".$v['type']."','".$v['title']."','f".$fx."',\$p['f".$fx."']) !!}\n";
	}
}


// Kết nối DB
$servername = "127.0.0.1";
// Get value from .env file ===================================
$myfile = fopen("../.env", "r") or die("Unable to open file!");
$text = fread($myfile,filesize("../.env"));

// DB_USERNAME=xxxx 
$matches = [];
preg_match_all("/DB\_USERNAME\=(.+?)\n/is", $text, $matches);
$username = $matches[1][0]; 

// DB_PASSWORD=xxxx
$matches = [];
preg_match_all("/DB\_PASSWORD\=(.+?)\n/is", $text, $matches);
$password = $matches[1][0]; 

// DB_DATABASE=xxxxx 
$matches = [];
preg_match_all("/DB\_DATABASE\=(.+?)\n/is", $text, $matches);
$dbname = $matches[1][0]; 

fclose($myfile);

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {	die("Connection failed: " . $conn->connect_error);} 
mysqli_set_charset($conn,"utf8");

$sql = "";
if($posts){
	$fx = 0;
	foreach ($values as $k => $v) {
		$fx++;
		$sql .= "update posts set `f".$fx."` = '".$v['value']."' where id=".$postsid.";\n";
	}
	echo $sql;
	if($runReal){
		var_dump($conn->query($sql));
	}
}else{
	foreach ($values as $k => $v) {
		$sql = "INSERT INTO sites (`code`, `title`, `value`,`value_type`) VALUES ('".$v['code']."','".$v['title']."','".$v['value']."','".$v['type']."');";
		echo $sql;
		if($runReal){
			var_dump($conn->query($sql));
		}
	}
}

if($updateImgSize){
	$query = "SELECT id,title,value FROM sites WHERE value_type='img' AND `value` != ''";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result))
	{
		$imgurl = str_replace(' ', '%20', $row["value"]);
		if(strpos($imgurl,'://') !== false){
			$size = @getimagesize($imgurl);
		}else{
			$size = @getimagesize('http://'.$_SERVER['HTTP_HOST'].$imgurl);

		}
		if(!empty($size) && is_array($size) && !empty($size[0]) && !empty($size[1])){
			$row['title'] .= ' '.$size[0].'x'.$size[1].'px';
			$sql = "UPDATE sites SET `title` = '".$row['title']."' WHERE id=".$row['id'].";";
			echo $sql.'<br>';
			var_dump($conn->query($sql));
		}
	}
}

$conn->close();


function cleanText($string) {
	return preg_replace('/[^A-Za-z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\- ]/', '', $string);
}

function getPathFromString($text){
	$marTViet=["à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
	"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
	,"ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
	,"ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
	,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
	,"Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ"];

	$marKoDau=["a","a","a","a","a","a","a","a","a","a","a"
	,"a","a","a","a","a","a",
	"e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i",
	"o","o","o","o","o","o","o","o","o","o","o","o"
	,"o","o","o","o","o",
	"u","u","u","u","u","u","u","u","u","u","u",
	"y","y","y","y","y",
	"d",
	"A","A","A","A","A","A","A","A","A","A","A","A"
	,"A","A","A","A","A",
	"E","E","E","E","E","E","E","E","E","E","E",
	"I","I","I","I","I",
	"O","O","O","O","O","O","O","O","O","O","O","O"
	,"O","O","O","O","O",
	"U","U","U","U","U","U","U","U","U","U","U",
	"Y","Y","Y","Y","Y",
	"D"];
	return str_replace(' ','-', preg_replace('!\s+!', ' ', preg_replace('/[^a-z0-9]/i', ' ', strtolower(str_replace($marTViet,$marKoDau,$text)))));
}

function str_replace_first($search, $replace, $subject) {
	$pos = strpos($subject, $search);
	if ($pos !== false) {
		return substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}

// ALTER TABLE posts ADD f300 text after field10;
// ALTER TABLE posts ADD f299 text after field10;
// ALTER TABLE posts ADD f298 text after field10;
// ALTER TABLE posts ADD f297 text after field10;
// ALTER TABLE posts ADD f296 text after field10;
// ALTER TABLE posts ADD f295 text after field10;
// ALTER TABLE posts ADD f294 text after field10;
// ALTER TABLE posts ADD f293 text after field10;
// ALTER TABLE posts ADD f292 text after field10;
// ALTER TABLE posts ADD f291 text after field10;
// ALTER TABLE posts ADD f290 text after field10;
// ALTER TABLE posts ADD f289 text after field10;
// ALTER TABLE posts ADD f288 text after field10;
// ALTER TABLE posts ADD f287 text after field10;
// ALTER TABLE posts ADD f286 text after field10;
// ALTER TABLE posts ADD f285 text after field10;
// ALTER TABLE posts ADD f284 text after field10;
// ALTER TABLE posts ADD f283 text after field10;
// ALTER TABLE posts ADD f282 text after field10;
// ALTER TABLE posts ADD f281 text after field10;
// ALTER TABLE posts ADD f280 text after field10;
// ALTER TABLE posts ADD f279 text after field10;
// ALTER TABLE posts ADD f278 text after field10;
// ALTER TABLE posts ADD f277 text after field10;
// ALTER TABLE posts ADD f276 text after field10;
// ALTER TABLE posts ADD f275 text after field10;
// ALTER TABLE posts ADD f274 text after field10;
// ALTER TABLE posts ADD f273 text after field10;
// ALTER TABLE posts ADD f272 text after field10;
// ALTER TABLE posts ADD f271 text after field10;
// ALTER TABLE posts ADD f270 text after field10;
// ALTER TABLE posts ADD f269 text after field10;
// ALTER TABLE posts ADD f268 text after field10;
// ALTER TABLE posts ADD f267 text after field10;
// ALTER TABLE posts ADD f266 text after field10;
// ALTER TABLE posts ADD f265 text after field10;
// ALTER TABLE posts ADD f264 text after field10;
// ALTER TABLE posts ADD f263 text after field10;
// ALTER TABLE posts ADD f262 text after field10;
// ALTER TABLE posts ADD f261 text after field10;
// ALTER TABLE posts ADD f260 text after field10;
// ALTER TABLE posts ADD f259 text after field10;
// ALTER TABLE posts ADD f258 text after field10;
// ALTER TABLE posts ADD f257 text after field10;
// ALTER TABLE posts ADD f256 text after field10;
// ALTER TABLE posts ADD f255 text after field10;
// ALTER TABLE posts ADD f254 text after field10;
// ALTER TABLE posts ADD f253 text after field10;
// ALTER TABLE posts ADD f252 text after field10;
// ALTER TABLE posts ADD f251 text after field10;
// ALTER TABLE posts ADD f250 text after field10;
// ALTER TABLE posts ADD f249 text after field10;
// ALTER TABLE posts ADD f248 text after field10;
// ALTER TABLE posts ADD f247 text after field10;
// ALTER TABLE posts ADD f246 text after field10;
// ALTER TABLE posts ADD f245 text after field10;
// ALTER TABLE posts ADD f244 text after field10;
// ALTER TABLE posts ADD f243 text after field10;
// ALTER TABLE posts ADD f242 text after field10;
// ALTER TABLE posts ADD f241 text after field10;
// ALTER TABLE posts ADD f240 text after field10;
// ALTER TABLE posts ADD f239 text after field10;
// ALTER TABLE posts ADD f238 text after field10;
// ALTER TABLE posts ADD f237 text after field10;
// ALTER TABLE posts ADD f236 text after field10;
// ALTER TABLE posts ADD f235 text after field10;
// ALTER TABLE posts ADD f234 text after field10;
// ALTER TABLE posts ADD f233 text after field10;
// ALTER TABLE posts ADD f232 text after field10;
// ALTER TABLE posts ADD f231 text after field10;
// ALTER TABLE posts ADD f230 text after field10;
// ALTER TABLE posts ADD f229 text after field10;
// ALTER TABLE posts ADD f228 text after field10;
// ALTER TABLE posts ADD f227 text after field10;
// ALTER TABLE posts ADD f226 text after field10;
// ALTER TABLE posts ADD f225 text after field10;
// ALTER TABLE posts ADD f224 text after field10;
// ALTER TABLE posts ADD f223 text after field10;
// ALTER TABLE posts ADD f222 text after field10;
// ALTER TABLE posts ADD f221 text after field10;
// ALTER TABLE posts ADD f220 text after field10;
// ALTER TABLE posts ADD f219 text after field10;
// ALTER TABLE posts ADD f218 text after field10;
// ALTER TABLE posts ADD f217 text after field10;
// ALTER TABLE posts ADD f216 text after field10;
// ALTER TABLE posts ADD f215 text after field10;
// ALTER TABLE posts ADD f214 text after field10;
// ALTER TABLE posts ADD f213 text after field10;
// ALTER TABLE posts ADD f212 text after field10;
// ALTER TABLE posts ADD f211 text after field10;
// ALTER TABLE posts ADD f210 text after field10;
// ALTER TABLE posts ADD f209 text after field10;
// ALTER TABLE posts ADD f208 text after field10;
// ALTER TABLE posts ADD f207 text after field10;
// ALTER TABLE posts ADD f206 text after field10;
// ALTER TABLE posts ADD f205 text after field10;
// ALTER TABLE posts ADD f204 text after field10;
// ALTER TABLE posts ADD f203 text after field10;
// ALTER TABLE posts ADD f202 text after field10;
// ALTER TABLE posts ADD f201 text after field10;
// ALTER TABLE posts ADD f200 text after field10;
// ALTER TABLE posts ADD f199 text after field10;
// ALTER TABLE posts ADD f198 text after field10;
// ALTER TABLE posts ADD f197 text after field10;
// ALTER TABLE posts ADD f196 text after field10;
// ALTER TABLE posts ADD f195 text after field10;
// ALTER TABLE posts ADD f194 text after field10;
// ALTER TABLE posts ADD f193 text after field10;
// ALTER TABLE posts ADD f192 text after field10;
// ALTER TABLE posts ADD f191 text after field10;
// ALTER TABLE posts ADD f190 text after field10;
// ALTER TABLE posts ADD f189 text after field10;
// ALTER TABLE posts ADD f188 text after field10;
// ALTER TABLE posts ADD f187 text after field10;
// ALTER TABLE posts ADD f186 text after field10;
// ALTER TABLE posts ADD f185 text after field10;
// ALTER TABLE posts ADD f184 text after field10;
// ALTER TABLE posts ADD f183 text after field10;
// ALTER TABLE posts ADD f182 text after field10;
// ALTER TABLE posts ADD f181 text after field10;
// ALTER TABLE posts ADD f180 text after field10;
// ALTER TABLE posts ADD f179 text after field10;
// ALTER TABLE posts ADD f178 text after field10;
// ALTER TABLE posts ADD f177 text after field10;
// ALTER TABLE posts ADD f176 text after field10;
// ALTER TABLE posts ADD f175 text after field10;
// ALTER TABLE posts ADD f174 text after field10;
// ALTER TABLE posts ADD f173 text after field10;
// ALTER TABLE posts ADD f172 text after field10;
// ALTER TABLE posts ADD f171 text after field10;
// ALTER TABLE posts ADD f170 text after field10;
// ALTER TABLE posts ADD f169 text after field10;
// ALTER TABLE posts ADD f168 text after field10;
// ALTER TABLE posts ADD f167 text after field10;
// ALTER TABLE posts ADD f166 text after field10;
// ALTER TABLE posts ADD f165 text after field10;
// ALTER TABLE posts ADD f164 text after field10;
// ALTER TABLE posts ADD f163 text after field10;
// ALTER TABLE posts ADD f162 text after field10;
// ALTER TABLE posts ADD f161 text after field10;
// ALTER TABLE posts ADD f160 text after field10;
// ALTER TABLE posts ADD f159 text after field10;
// ALTER TABLE posts ADD f158 text after field10;
// ALTER TABLE posts ADD f157 text after field10;
// ALTER TABLE posts ADD f156 text after field10;
// ALTER TABLE posts ADD f155 text after field10;
// ALTER TABLE posts ADD f154 text after field10;
// ALTER TABLE posts ADD f153 text after field10;
// ALTER TABLE posts ADD f152 text after field10;
// ALTER TABLE posts ADD f151 text after field10;
// ALTER TABLE posts ADD f150 text after field10;
// ALTER TABLE posts ADD f149 text after field10;
// ALTER TABLE posts ADD f148 text after field10;
// ALTER TABLE posts ADD f147 text after field10;
// ALTER TABLE posts ADD f146 text after field10;
// ALTER TABLE posts ADD f145 text after field10;
// ALTER TABLE posts ADD f144 text after field10;
// ALTER TABLE posts ADD f143 text after field10;
// ALTER TABLE posts ADD f142 text after field10;
// ALTER TABLE posts ADD f141 text after field10;
// ALTER TABLE posts ADD f140 text after field10;
// ALTER TABLE posts ADD f139 text after field10;
// ALTER TABLE posts ADD f138 text after field10;
// ALTER TABLE posts ADD f137 text after field10;
// ALTER TABLE posts ADD f136 text after field10;
// ALTER TABLE posts ADD f135 text after field10;
// ALTER TABLE posts ADD f134 text after field10;
// ALTER TABLE posts ADD f133 text after field10;
// ALTER TABLE posts ADD f132 text after field10;
// ALTER TABLE posts ADD f131 text after field10;
// ALTER TABLE posts ADD f130 text after field10;
// ALTER TABLE posts ADD f129 text after field10;
// ALTER TABLE posts ADD f128 text after field10;
// ALTER TABLE posts ADD f127 text after field10;
// ALTER TABLE posts ADD f126 text after field10;
// ALTER TABLE posts ADD f125 text after field10;
// ALTER TABLE posts ADD f124 text after field10;
// ALTER TABLE posts ADD f123 text after field10;
// ALTER TABLE posts ADD f122 text after field10;
// ALTER TABLE posts ADD f121 text after field10;
// ALTER TABLE posts ADD f120 text after field10;
// ALTER TABLE posts ADD f119 text after field10;
// ALTER TABLE posts ADD f118 text after field10;
// ALTER TABLE posts ADD f117 text after field10;
// ALTER TABLE posts ADD f116 text after field10;
// ALTER TABLE posts ADD f115 text after field10;
// ALTER TABLE posts ADD f114 text after field10;
// ALTER TABLE posts ADD f113 text after field10;
// ALTER TABLE posts ADD f112 text after field10;
// ALTER TABLE posts ADD f111 text after field10;
// ALTER TABLE posts ADD f110 text after field10;
// ALTER TABLE posts ADD f109 text after field10;
// ALTER TABLE posts ADD f108 text after field10;
// ALTER TABLE posts ADD f107 text after field10;
// ALTER TABLE posts ADD f106 text after field10;
// ALTER TABLE posts ADD f105 text after field10;
// ALTER TABLE posts ADD f104 text after field10;
// ALTER TABLE posts ADD f103 text after field10;
// ALTER TABLE posts ADD f102 text after field10;
// ALTER TABLE posts ADD f101 text after field10;
// ALTER TABLE posts ADD f100 text after field10;
// ALTER TABLE posts ADD f99 text after field10;
// ALTER TABLE posts ADD f98 text after field10;
// ALTER TABLE posts ADD f97 text after field10;
// ALTER TABLE posts ADD f96 text after field10;
// ALTER TABLE posts ADD f95 text after field10;
// ALTER TABLE posts ADD f94 text after field10;
// ALTER TABLE posts ADD f93 text after field10;
// ALTER TABLE posts ADD f92 text after field10;
// ALTER TABLE posts ADD f91 text after field10;
// ALTER TABLE posts ADD f90 text after field10;
// ALTER TABLE posts ADD f89 text after field10;
// ALTER TABLE posts ADD f88 text after field10;
// ALTER TABLE posts ADD f87 text after field10;
// ALTER TABLE posts ADD f86 text after field10;
// ALTER TABLE posts ADD f85 text after field10;
// ALTER TABLE posts ADD f84 text after field10;
// ALTER TABLE posts ADD f83 text after field10;
// ALTER TABLE posts ADD f82 text after field10;
// ALTER TABLE posts ADD f81 text after field10;
// ALTER TABLE posts ADD f80 text after field10;
// ALTER TABLE posts ADD f79 text after field10;
// ALTER TABLE posts ADD f78 text after field10;
// ALTER TABLE posts ADD f77 text after field10;
// ALTER TABLE posts ADD f76 text after field10;
// ALTER TABLE posts ADD f75 text after field10;
// ALTER TABLE posts ADD f74 text after field10;
// ALTER TABLE posts ADD f73 text after field10;
// ALTER TABLE posts ADD f72 text after field10;
// ALTER TABLE posts ADD f71 text after field10;
// ALTER TABLE posts ADD f70 text after field10;
// ALTER TABLE posts ADD f69 text after field10;
// ALTER TABLE posts ADD f68 text after field10;
// ALTER TABLE posts ADD f67 text after field10;
// ALTER TABLE posts ADD f66 text after field10;
// ALTER TABLE posts ADD f65 text after field10;
// ALTER TABLE posts ADD f64 text after field10;
// ALTER TABLE posts ADD f63 text after field10;
// ALTER TABLE posts ADD f62 text after field10;
// ALTER TABLE posts ADD f61 text after field10;
// ALTER TABLE posts ADD f60 text after field10;
// ALTER TABLE posts ADD f59 text after field10;
// ALTER TABLE posts ADD f58 text after field10;
// ALTER TABLE posts ADD f57 text after field10;
// ALTER TABLE posts ADD f56 text after field10;
// ALTER TABLE posts ADD f55 text after field10;
// ALTER TABLE posts ADD f54 text after field10;
// ALTER TABLE posts ADD f53 text after field10;
// ALTER TABLE posts ADD f52 text after field10;
// ALTER TABLE posts ADD f51 text after field10;
// ALTER TABLE posts ADD f50 text after field10;
// ALTER TABLE posts ADD f49 text after field10;
// ALTER TABLE posts ADD f48 text after field10;
// ALTER TABLE posts ADD f47 text after field10;
// ALTER TABLE posts ADD f46 text after field10;
// ALTER TABLE posts ADD f45 text after field10;
// ALTER TABLE posts ADD f44 text after field10;
// ALTER TABLE posts ADD f43 text after field10;
// ALTER TABLE posts ADD f42 text after field10;
// ALTER TABLE posts ADD f41 text after field10;
// ALTER TABLE posts ADD f40 text after field10;
// ALTER TABLE posts ADD f39 text after field10;
// ALTER TABLE posts ADD f38 text after field10;
// ALTER TABLE posts ADD f37 text after field10;
// ALTER TABLE posts ADD f36 text after field10;
// ALTER TABLE posts ADD f35 text after field10;
// ALTER TABLE posts ADD f34 text after field10;
// ALTER TABLE posts ADD f33 text after field10;
// ALTER TABLE posts ADD f32 text after field10;
// ALTER TABLE posts ADD f31 text after field10;
// ALTER TABLE posts ADD f30 text after field10;
// ALTER TABLE posts ADD f29 text after field10;
// ALTER TABLE posts ADD f28 text after field10;
// ALTER TABLE posts ADD f27 text after field10;
// ALTER TABLE posts ADD f26 text after field10;
// ALTER TABLE posts ADD f25 text after field10;
// ALTER TABLE posts ADD f24 text after field10;
// ALTER TABLE posts ADD f23 text after field10;
// ALTER TABLE posts ADD f22 text after field10;
// ALTER TABLE posts ADD f21 text after field10;
// ALTER TABLE posts ADD f20 text after field10;
// ALTER TABLE posts ADD f19 text after field10;
// ALTER TABLE posts ADD f18 text after field10;
// ALTER TABLE posts ADD f17 text after field10;
// ALTER TABLE posts ADD f16 text after field10;
// ALTER TABLE posts ADD f15 text after field10;
// ALTER TABLE posts ADD f14 text after field10;
// ALTER TABLE posts ADD f13 text after field10;
// ALTER TABLE posts ADD f12 text after field10;
// ALTER TABLE posts ADD f11 text after field10;
// ALTER TABLE posts ADD f10 text after field10;
// ALTER TABLE posts ADD f9 text after field10;
// ALTER TABLE posts ADD f8 text after field10;
// ALTER TABLE posts ADD f7 text after field10;
// ALTER TABLE posts ADD f6 text after field10;
// ALTER TABLE posts ADD f5 text after field10;
// ALTER TABLE posts ADD f4 text after field10;
// ALTER TABLE posts ADD f3 text after field10;
// ALTER TABLE posts ADD f2 text after field10;
// ALTER TABLE posts ADD f1 text after field10;
?>	



