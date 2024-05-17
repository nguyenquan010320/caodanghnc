<?php
$orderOptions = [
	['code'=>'ISNULL(`order`) ASC,`order` ASC,ISNULL(`price`) ASC,(`price`=0) ASC,`price` ASC,`title` ASC','title'=>'Phổ biến'],
	['code'=>'ISNULL(`price`) ASC,(`price`=0) ASC,`price` ASC,`title` ASC','title'=>'Giá tăng dần'],
	['code'=>'ISNULL(`price`) ASC,(`price`=0) ASC,`price` DESC,`title` ASC','title'=>'Giá giảm dần'],
	['code'=>'ISNULL(`rating`) ASC,`rating` DESC','title'=>'Đánh giá cao nhất'],
	['code'=>'ISNULL(`created_at`) ASC,`created_at` DESC','title'=>'Mới nhất']
];
if (!defined('ORDER_OPTION')) define('ORDER_OPTION', serialize($orderOptions));

if (!defined('SEO_GREAT')) define('SEO_GREAT', 8);
if (!defined('SEO_GOOD')) define('SEO_GOOD', 5);
if (!defined('SEO_MEDIUM')) define('SEO_MEDIUM', 3);
if (!defined('SEO_WEAK')) define('SEO_WEAK', 0);

$adminMenu = [
	'ĐƠN HÀNG'=>[
		//'adOrder'=>['shopping-cart','Danh sách đơn hàng'],
		'adStatistic'=>['shopping-cart','Danh sách đăng ký'],
		// 'adFaq'=>['question-circle','Danh sách câu hỏi'],
		// 'adComment'=>['comments','Danh sách bình luận'],
	],
	//'SẢN PHẨM'=>[
	//	'p2'=>['list','Tất cả sản phẩm'],
	//	'p2-edit0'=>['plus','Thêm sản phẩm'],
	//	'c2'=>['indent','Danh mục sản phẩm'],
	//],
	//'BÀI VIẾT'=>[
	//	'p3'=>['list','Tất cả bài viết'],
	//	'p3-edit0'=>['plus','Thêm bài viết'],
	//	'c3'=>['indent','Danh mục bài viết'],
	//	'p1'=>['list','Tất cả trang riêng'],
	//	'p4'=>['image','Tất cả thư viện ảnh'],
	//	'c4'=>['image','Danh mục thư viện ảnh'],
	'NGÀNH HỌC'=>[
		'p23'=>['list','Tất cả ngành học'],
	],
	'GIAO DIỆN'=>[
		'adSetting?section=0'=>['cog','Giao diện chung'],
		'adSetting?section=1'=>['cog','Giao diện trang chủ'],
		'c10'=>['list','Tùy chỉnh Menu'],
		'p1'=>['list','Tất cả trang riêng'],
	],
	'CÀI ĐẶT'=>[
		'adUser'=>['users','Quản lý người dùng'],
		'adSetting?section=2'=>['bolt','Cài đặt nâng cao'],
		'adFileExplorer'=>['image','Quản lý file'],
	]
];

$saleMenu = [
	'ĐƠN HÀNG'=>[
		'adOrder'=>['shopping-cart','Danh sách đơn hàng'],
	],
	'SẢN PHẨM'=>[
		'p2'=>['list','Tất cả sản phẩm'],
		'p2-edit0'=>['plus','Thêm sản phẩm'],
		'c2'=>['indent','Danh mục sản phẩm'],
	],
];

$contentMenu = [
	'SẢN PHẨM'=>[
		'p2'=>['list','Tất cả sản phẩm'],
		'p2-edit0'=>['plus','Thêm sản phẩm'],
		'c2'=>['indent','Danh mục sản phẩm'],
		'adComment'=>['comments','Tất cả bình luận'],
	],
	'BÀI VIẾT'=>[
		'p3'=>['list','Tất cả bài viết'],
		'p3-edit0'=>['plus','Thêm bài viết'],
		'c3'=>['indent','Danh mục bài viết'],
		'p1'=>['list','Tất cả trang riêng'],
	],
	'THƯ VIỆN'=>[
		'adFileExplorer'=>['image','Quản lý ảnh'],
		'p4'=>['image','Tất cả thư viện'],
		// 'c4'=>'Danh mục bộ sưu tập ảnh/video',
	],
];
if (!defined('ADMIN_MENU')) define('ADMIN_MENU', serialize($adminMenu));
if (!defined('CONTENT_MENU')) define('CONTENT_MENU', serialize($contentMenu));
if (!defined('SALE_MENU')) define('SALE_MENU', serialize($saleMenu));

$roles = ['admin','sale','content'];
if (!defined('ROLES')) define('ROLES', serialize($roles));

$languages = [
	// 'demo.ihappy.info'=>'vi',
	// 'en.demo.ihappy.info'=>'en',
	// 'ja.demo.ihappy.info'=>'ja',
	// 'ko.demo.ihappy.info'=>'ko',
	// 'zh.demo.ihappy.info'=>'zh',
];
if (!defined('LANGUAGES')) define('LANGUAGES', serialize($languages));

$languageNames = [
'vi'=>['title'=>'Tiếng Việt','img'=>'/public/frontend/image/lang_vi.jpg'],
'en'=>['title'=>'English','img'=>'/public/frontend/image/lang_en.jpg'],
'ja'=>['title'=>'日本語','img'=>'/public/frontend/image/lang_ja.jpg'],
'ko'=>['title'=>'한국어','img'=>'/public/frontend/image/lang_ko.jpg'],
'zh'=>['title'=>'中文','img'=>'/public/frontend/image/lang_zh.jpg'],
'fr'=>['title'=>'Français','img'=>'/public/frontend/image/lang_fr.jpg'],
'es'=>['title'=>'Español','img'=>'/public/frontend/image/lang_es.jpg'],
'ru'=>['title'=>'Pусский','img'=>'/public/frontend/image/lang_ru.jpg'],
'pt'=>['title'=>'Português','img'=>'/public/frontend/image/lang_pt.jpg'],
'lo'=>['title'=>'ລາວ','img'=>'/public/frontend/image/lang_lo.jpg'],
];
if (!defined('LANGUAGE_NAMES')) define('LANGUAGE_NAMES', serialize($languageNames));