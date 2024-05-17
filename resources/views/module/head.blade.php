<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="{!! (empty($lang)) ? 'vi' : $lang !!}" />
<link rel="apple-touch-icon" href="@site('anh-favicon')">
<link rel="icon" type="image/png" href="@site('anh-favicon')">
@if(empty(env('CUSTOM_AGENCY')))
<meta name="copyright" content="Thiết kế web iHappy.vn" />
<meta name="author" content="Thiết kế web iHappy.vn" />
<meta name="generator" content="Thiết kế web iHappy.vn" />
@endif
<meta http-equiv="audience" content="General" />
<meta name="resource-type" content="Document" />
<meta name="distribution" content="Global" />
<meta name="revisit-after" content="1 days" />
<meta name="rating" content="GENERAL" />
<meta name="robots" content="index,follow" />
<meta name="Googlebot" content="index,follow,archive" />

<?php
$domain = 'http://'.$_SERVER['HTTP_HOST'];
if($site['che-do-bao-mat-https'] == '1'){
	$domain = 'https://'.$_SERVER['HTTP_HOST'];
}

$tieude = $title;
$mota = $desc;
$tukhoa = $keyword;
$anhchiase = '';
$linkpape = $domain;
if(!empty($s['link'])){
	$linkpape = $domain.$s['link'];
	$linkpape = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}
$loaipape = '';

if(Request::is('/')){
	if(!empty($site['tieu-de-chia-se-facebook'])){
		$tieude = $site['tieu-de-chia-se-facebook'];
	}
	if(!empty($site['mo-ta-chia-se-facebook'])){
		$mota = $site['mo-ta-chia-se-facebook'];
	}
	$anhchiase = $site['anh-chia-se-facebook'];
	$loaipape = 'website';
}else{
	if(!empty($s['facebook_title'])){
		$tieude = $s['facebook_title'];
	}
	if(!empty($s['facebook_desc'])){
		$mota = $s['facebook_desc'];
	}
	if(!empty($s['facebook_img'])){
		$anhchiase = $s['facebook_img'];
	}elseif(!empty($s['img']) && $s['img']!='/public/upload/noimage.jpg'){
		$anhchiase = $s['img'];
	}

	if(!empty($s['categoryParent']) && in_array(2, $s['categoryParent'])){
		$loaipape = 'product';
	}else{
		$loaipape = 'article';
	}
}

$tieude = str_replace(["'",'"','“','”'],'',trim(strip_tags($tieude)));
$mota = str_replace(["'",'"','“','”'],'',trim(strip_tags($mota)));
$tukhoa = str_replace(["'",'"','“','”'],'',trim(strip_tags($tukhoa)));
$anhchiase = $domain.str_replace('/upload/', '/thumbs/', $anhchiase);
?> 

<title>{!!$tieude or ''!!}</title>
<meta name="description" content="{!!$mota or ''!!}"> 
<meta name="keywords" content="{!!$tukhoa or ''!!}">
<meta property="og:title" content="{!!$tieude or ''!!}"/>
<meta property="og:description" content="{!!$mota or ''!!}"/>
<meta property="og:image" itemprop="thumbnailUrl" content="{!!$anhchiase or ''!!}"/>
<meta property="og:image:alt" content="{!!$tieude or ''!!}"/>
<meta property="og:image:width" content="500">
<meta property="og:image:height" content="350">
<meta property="og:rich_attachment" content="true">
<meta property="og:type" content="{!!$loaipape or ''!!}" />
<meta property="og:url" content="{!!$linkpape or '' !!}"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:site_name" content="{!!$tieude or '' !!}"/>
<meta property="article:publisher" content="@site('link-facebook')">
<meta property="article:tag" content="{!!$tukhoa or ''!!}">
<meta property="fb:app_id" content="1626757400901101"/>
<link rel="canonical" href="{!!$linkpape or '' !!}" />

<meta property="twitter:image" content="{!!$anhchiase or ''!!}" />
<meta property="article:published_time" content="{!!$s['created_at'] or ''!!}" />
<meta property="article:modified_time" content="{!!$s['updated_at'] or ''!!}" />
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{!!$linkpape or '' !!}" />
<meta property="twitter:title" content="{!!$tieude or '' !!}" />
<meta property="twitter:description" content="{!!$mota or '' !!}" />

@ifturnon('che-do-bao-mat-https')
@if(substr($_SERVER['HTTP_HOST'], -2,2) != '.l')
<script type="text/javascript">
	if (location.protocol != 'https:'){
		location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
	}
	if (window.location.hostname.indexOf("www") == 0) {
		window.location = window.location.href.replace("www.","");
	}
</script>
@endif
@endif

@if(isset($site['bat-che-do-bao-tri']) && $site['bat-che-do-bao-tri'] == "1" && !Auth::check())
<h1>@site('tieu-de-che-do-bao-tri')</h1>
@php(die)
@endif

{{-- @if(substr($_SERVER['HTTP_HOST'], -7) != 'name.vn')
<script type="text/javascript">
	if(confirm('Trang web chưa được chạy chính thức, hãy bấm ok để xem trang demo')){
		location.href = 'https://sirohonibifa.ihappy9.name.vn';
	}
</script>
@endif --}}

{{-- @if(!empty($s['link']))
@php($uri = explode('?', $_SERVER['REQUEST_URI']))
@if(is_array($uri) && isset($uri[0]) && isset($uri[1]) && $uri[0] != $s['link'])
<script type="text/javascript">
	window.location.href = '{!!$s['link'].'?'.$uri[1]!!}';
</script>
@endif
@endif --}}