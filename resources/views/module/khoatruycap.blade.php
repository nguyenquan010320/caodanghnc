<?php  
if(!empty($s['categoryInfo']['khoatruycap'])){
	$khoatruycap = $s['categoryInfo']['khoatruycap'];
	$khoatruycapid = 	$s['categoryInfo']['id'];
}elseif(!empty($s['khoatruycap'])){
	$khoatruycap = $s['khoatruycap'];
	$khoatruycapid = 	$s['id'];
}else{}

if(!empty($khoatruycap)){
$password = explode(',', $khoatruycap);
foreach ($password as &$v) {
  $v = "'".trim($v)."'";
}
$password = implode(',', $password);
?> 
<script type="text/javascript">
  if($.cookie("duoctruycap{!!$khoatruycapid or ''!!}")==undefined){
    var password;
    password=prompt('Vui lòng nhập mật khẩu để truy cập danh mục này',''); 
    if ([{!!$password or ''!!}].includes(password)){
      $.cookie('duoctruycap{!!$khoatruycapid or ''!!}', '1', { expires: 1, path: '/' });
      alert('Mật khẩu chính xác, bấm OK để xem dữ liệu.');
    } else {
      alert('Mật khẩu sai! Bạn sẽ được chuyển về trang chủ.');
      window.location="/"; 
    }
  }
</script>
<?php } ?> 