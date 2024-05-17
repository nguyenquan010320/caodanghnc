{{-- <table dir="ltr" style="height: 133px;" border="1" width="763" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 339.448px;">Trung t&acirc;m SM1:</td>
<td style="width: 290.99px;">Lọc Nước Smart - Dương Nội, Dương Nội, Ho&agrave;i Đức, H&agrave; Nội</td>
<td style="width: 127.229px;">1900252528</td>
</tr>
<tr>
<td style="width: 339.448px;">Trung t&acirc;m SM2:</td>
<td style="width: 290.99px;">Lọc Nước Smart - S&oacute;c Sơn, Đồng Mốc, Ti&ecirc;n Dược, S&oacute;c Sơn, H&agrave; Nội</td>
<td style="width: 127.229px;">1900252528</td>
</tr>
</tbody>
</table> --}}
{{-- <section id="tim" style="background-image:url('/public/upload/thumoi.png');background-size: cover;background-position: center;">
  <div class="container">
    <div class="row">
      <div class="col-md-5 text-light">
        <div class="chi-tiet-bai-viet">
          <h2 id="mcetoc_1f625258e0" style="font-weight: 500">@site("tieu-de-trang-dai-ly")</h2>
          @site("doan-thu-ngo-trang-dai-ly")
        <p class="text-left"><a href="javascript:void(0)" class="btn btn-my btn-mua btn-light">Đăng ký làm đại lý</a></p>
        </div>
      </div>
      <div class="col-md-7 p-t-50">
        <p class="text-center m-b-40"><img src="@site("anh-thu-ngo-trang-dai-ly")" style="width: 90%"></p>
      </div>
    </div>
  </div>
</section> --}}
<?php
$html = $s['desc_full'];
$html = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $html);
$html = str_replace('  ', '',$html);
$html = str_replace('  ', '',$html);
$html = str_replace(array("\r", "\n"), '', $html);
preg_match_all("/\<tr\>\<td\>(.+?)\<\/td\>\<td\>(.+?)\<\/td\>\<td\>(.+?)\<\/td\>\<\/tr\>/is", $html, $matches);
$daily = [];
if(!empty($matches) && !empty($matches[0] && is_array($matches[0]))){
  foreach ($matches[0] as $k => $v) {
    $motdaily = [];
    $motdaily['id'] = $k;
    $motdaily['ten'] = (isset($matches[1][$k])) ? strip_tags($matches[1][$k]):'';
    $motdaily['diachi'] = (isset($matches[2][$k])) ? strip_tags($matches[2][$k]):'';
    $motdaily['dienthoai'] = (isset($matches[3][$k])) ? strip_tags($matches[3][$k]):'';
    $motdaily['embed'] = '<iframe width="765" height="542" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q='.$motdaily['diachi'].'&output=embed"></iframe>';
    $daily[] = $motdaily;
  }
}
?>
<section class="p-t-40 product-page trang-dai-ly" id="daily" style="background:url(/upload/bitmap.png);background-position: top;background-size: contain;background-repeat: no-repeat;">
  <div class="container">
    {{-- <div class="heading heading-center wow fadeInUp">
      <h2 class="line">{!!$s['title'] or ''!!}</h2></a>
    </div> --}}
    <form class="form-inline timkiem row" style="text-align: center;">
      <div class="form-group col-md-5">
        <label class="text-left">@lang('Nhập địa chỉ')</label>
        <input type="text" class="form-control" id="tukhoa" placeholder="@lang('Nhập địa chỉ')">
      </div>
      <div class="form-group col-md-4">
        <label class="text-left">@lang('Chọn tỉnh thành')</label>
        <select class="form-control" id="tinhthanh">
          <option value="">- @lang('Tất cả tỉnh thành') -</option>
          <option value="Hà Nội">TP Hà Nội</option>
          <option value="Hồ Chí Minh">TP Hồ Chí Minh</option>
          <option value="An Giang">An Giang</option>
          <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
          <option value="Bắc Giang">Bắc Giang</option>
          <option value="Bắc Kạn">Bắc Kạn</option>
          <option value="Bạc Liêu">Bạc Liêu</option>
          <option value="Bắc Ninh">Bắc Ninh</option>
          <option value="Bến Tre">Bến Tre</option>
          <option value="Bình Định">Bình Định</option>
          <option value="Bình Dương">Bình Dương</option>
          <option value="Bình Phước">Bình Phước</option>
          <option value="Bình Thuận">Bình Thuận</option>
          <option value="Cà Mau">Cà Mau</option>
          <option value="Cao Bằng">Cao Bằng</option>
          <option value="Cần Thơ">Cần Thơ</option>
          <option value="Đà Nẵng">Đà Nẵng</option>
          <option value="Đắk Lắk">Đắk Lắk</option>
          <option value="Đắk Nông">Đắk Nông</option>
          <option value="Điện Biên">Điện Biên</option>
          <option value="Đồng Nai">Đồng Nai</option>
          <option value="Đồng Tháp">Đồng Tháp</option>
          <option value="Gia Lai">Gia Lai</option>
          <option value="Hà Giang  ">Hà Giang  </option>
          <option value="Hà Nam">Hà Nam</option>
          <option value="Hà Tĩnh">Hà Tĩnh</option>
          <option value="Hải Dương">Hải Dương</option>
          <option value="Hải Phòng">Hải Phòng</option>
          <option value="Hậu Giang">Hậu Giang</option>
          <option value="Hòa Bình">Hòa Bình</option>
          <option value="Hưng Yên">Hưng Yên</option>
          <option value="Khánh Hòa">Khánh Hòa</option>
          <option value="Kiên Giang">Kiên Giang</option>
          <option value="Kon Tum">Kon Tum</option>
          <option value="Lai Châu">Lai Châu</option>
          <option value="Lâm Đồng">Lâm Đồng</option>
          <option value="Lạng Sơn">Lạng Sơn</option>
          <option value="Lào Cai">Lào Cai</option>
          <option value="Long An">Long An</option>
          <option value="Nam Định">Nam Định</option>
          <option value="Nghệ An">Nghệ An</option>
          <option value="Ninh Bình">Ninh Bình</option>
          <option value="Ninh Thuận">Ninh Thuận</option>
          <option value="Phú Thọ">Phú Thọ</option>
          <option value="Phú Yên">Phú Yên </option>
          <option value="Quảng Bình">Quảng Bình  </option>
          <option value="Quảng Nam">Quảng Nam</option>
          <option value="Quảng Ngãi">Quảng Ngãi</option>
          <option value="Quảng Ninh">Quảng Ninh</option>
          <option value="Quảng Trị">Quảng Trị</option>
          <option value="Sóc Trăng">Sóc Trăng</option>
          <option value="Sơn La">Sơn La</option>
          <option value="Tây Ninh">Tây Ninh</option>
          <option value="Thái Bình">Thái Bình</option>
          <option value="Thái Nguyên">Thái Nguyên</option>
          <option value="Thanh Hóa">Thanh Hóa</option>
          <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
          <option value="Tiền Giang">Tiền Giang</option>
          <option value="Trà Vinh">Trà Vinh</option>
          <option value="Tuyên Quang">Tuyên Quang</option>
          <option value="Vĩnh Long">Vĩnh Long</option>
          <option value="Vĩnh Phúc">Vĩnh Phúc</option>
          <option value="Yên Bái">Yên Bái</option>
        </select>
        <i class="fa fa-chevron-down"></i>
      </div>
      <div class="form-group col-md-3 hidden-sm hidden-xs">
        <button class="btn btn-default" type="button"><i class="fa fa-search"></i> @lang('Tìm kiếm')</button>
      </div>
      {{-- <div class="form-group col-md-4 hidden-sm hidden-xs">
        <button class="btn btn-default btn-gan-ban" type="button"><i class="fa fa-home"></i> Cửa hàng gần bạn</button>
      </div> --}}
    </form>
    <div class="boxshadow">
      {{-- <div class="p-20 visible-sm visible-xs">
        <table class="datatable table table-bordered">
          <thead style="display: none;">
            <tr>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($daily as $motdaily)
            <tr>
              <td>
                <b>{!!$motdaily['ten']!!}</b><br>{!!$motdaily['diachi']!!}<br>{!!$motdaily['dienthoai']!!}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div> --}}
      <div class="row ban-do">
        <div class="col-md-4 matchHeight">
          <p><span id="socuahang">{!!sizeof($daily)!!}</span> @lang('chi nhánh')</p>
          <div class="tableover">
            <table class="datatable table" style="width: 100%">
              <thead style="display: none;">
                <tr><td></td></tr>
              </thead>
              <tbody>
                @foreach ($daily as $motdaily)
                <tr>
                  <td id="td-{!!$motdaily['id']!!}">
                    <p><i class="fa fa-map-marker"></i>{!!$motdaily['ten']!!}</p>
                    <p>{!!$motdaily['diachi']!!}</p>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-8 matchHeight minhe">
          <div id=myMap style="height: 100%;width: 100%;overflow: hidden;">
            <iframe class="n246  d208 o164 "  width="765" height="542" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=Việt Nam&output=embed"></iframe>
          </div>
          @foreach ($daily as $motdaily)
          <p class="pdl pdl-{!!$motdaily['id']!!}" style="display: none;"><img src="/public/frontend/image/pin.png"><b>{!!$motdaily['ten']!!}</b><br>{!!$motdaily['diachi']!!}<br>Điện thoại: {!!$motdaily['dienthoai']!!}</p>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<style type="text/css">
  .dataTables_filter{display: none;}
</style>
{{-- <script src=https://maps.googleapis.com/maps/api/js?key=AIzaSyCiqJmmcMNoOtGQ0JBgxR-ooeRCWEcTt5M&#038;ver=1.0.5></script> --}}
<script src=//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.datatable').DataTable({
      "paging": false,
      "lengthChange": false,
      "lengthMenu": [[10, 20, -1], [10, 20, "Tất cả"]],
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": true,
      "language": {
        "decimal":        "",
        "emptyTable":     "Chưa có dữ liệu",
        "info":           "Đang hiện _START_ đến _END_ trong tổng số _TOTAL_ kết quả",
        "infoEmpty":      "Showing 0 to 0 of 0 entries",
        "infoFiltered":   "(filtered from _MAX_ total entries)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Hiện _MENU_ kết quả mỗi trang",
        "loadingRecords": "Loading...",
        "processing":     "Processing...",
        "search":         "Tìm kiếm:",
        "zeroRecords":    "Không có kết quả nào",
        "paginate": {
          "first":      "Trang đầu",
          "last":       "Trang cuối",
          "next":       "Trang tiếp",
          "previous":   "Trang trước"
        },
        "aria": {
          "sortAscending":  ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        }
      }
    });

    oTable = $('.datatable').DataTable();
    $('form.timkiem').on('keyup', '#tukhoa', function(event) {
      console.log($(this).val()); 
      oTable.search($(this).val()).draw() ;
      $('#socuahang').text(oTable.$('tr', {"filter":"applied"}).length);
      $('#tinhthanh').val('');
    })
    $('form.timkiem').on('change', '#tinhthanh', function(event) {
      console.log($(this).val()); 
      oTable.search('"'+$(this).val()+'"').draw();
      $('#socuahang').text(oTable.$('tr', {"filter":"applied"}).length);
      $('#tukhoa').val('');
    });

    // var mapLat = 16.0471659, mapLong = 108.1716866,mapZoom = 5.24;
    // var mapStyle = [];
    // var mapOption = {
    //   center: new google.maps.LatLng(mapLat, mapLong),
    //   zoom: mapZoom,
    //   panControl: true,
    //   zoomControl: true,
    //   mapTypeControl: false,
    //   streetViewControl: false,
    //   mapTypeId: google.maps.MapTypeId.ROADMAP,
    //   scrollwheel: true,
    //   styles: mapStyle
    // };
    // var mapObject = new google.maps.Map(document.getElementById("myMap"), mapOption);
    // var geocoder = new google.maps.Geocoder();

    // var activeInfoWindow;    

    @foreach ($daily as $motdaily)
    {{-- // var mapMarker{!!$motdaily['id']!!} = new google.maps.Marker({position: new google.maps.LatLng({!!$motdaily['lat']!!}, {!!$motdaily['long']!!}),map: mapObject,visible: true,icon: "/public/frontend/image/pin.png"});
    // var infowindow{!!$motdaily['id']!!} = new google.maps.InfoWindow({maxWidth: 500,content: '<p><b>{!!$motdaily['ten']!!}</b><br>{!!$motdaily['diachi']!!}<br>Điện thoại: {!!$motdaily['dienthoai']!!}</p>'});
    // google.maps.event.addListener(mapMarker{!!$motdaily['id']!!}, "click", function() {
    //   if (activeInfoWindow) { activeInfoWindow.close();}
    //   infowindow{!!$motdaily['id']!!}.open(mapObject, mapMarker{!!$motdaily['id']!!});
    //   activeInfoWindow = infowindow{!!$motdaily['id']!!};
    // });
    --}}
    
    $('.datatable').on('click', '#td-{!!$motdaily['id']!!}', function(event) {
      event.preventDefault();
      $('.datatable td').removeClass('active');
      // $(this).addClass('{!!$motdaily['embed']!!}');
      $('#myMap').html('{!!$motdaily['embed']!!}');
      $('.pdl').hide();
      $('.pdl-{!!$motdaily['id']!!}').show();
      {{--// mapObject.setCenter(new google.maps.LatLng({!!$motdaily['lat']!!}, {!!$motdaily['long']!!}));
      // google.maps.event.trigger(mapMarker{!!$motdaily['id']!!}, 'click'); --}}
    });
    @endforeach

    // var mapMarker = new google.maps.Marker({position: new google.maps.LatLng(mapLat, mapLong),map: mapObject,visible: true,icon: "/public/frontend/image/pin.png"});
    // var infowindow = new google.maps.InfoWindow({maxWidth: 500,content: '<p style="margin:0"><b>CÔNG TY TNHH NHÔM ĐÔNG Á</b><br>Cụm CN Tân Dân, TP Chí Linh, Tỉnh Hải Dương<br>Điện thoại: 0084-220.359.2956</p>'});
    // google.maps.event.addListener(mapMarker, "click", function() {
    //   if (activeInfoWindow) { activeInfoWindow.close();}
    //   infowindow.open(mapObject, mapMarker);
    //   activeInfoWindow = infowindow;
    // });
    // google.maps.event.trigger(mapMarker, 'click');

    // $('.btn-gan-ban').on('click', function(event) {
    //   event.preventDefault();
    //   if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(function(position) {
    //       mapObject.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
    //     });
    //   } else { 
    //     alert('Trình duyệt của bạn không hỗ trợ xác định vị trí.');
    //   }
    // });
  });
</script>

<style type="text/css">
  .trang-dai-ly form{margin-bottom:30px}
  .trang-dai-ly form .form-group label{text-transform:none;margin-top:0}
  .trang-dai-ly form input{width:100%!important;/* border:1px #000 solid; */padding:7px 10px;font-size:12px;background:#fff;border-radius: 5px;}
  .trang-dai-ly form select{width:100%!important;/* border:1px #000 solid; */padding:7px 10px;font-size:12px;background:#fff;}
  .trang-dai-ly form select+i{position:absolute;right:24px;bottom:16px;z-index:-1}
  .trang-dai-ly form .col-md-3 button{background: var(--main-color);/* border-radius: 20em; */text-transform:none;letter-spacing:0!important;padding: 8px;width:100%;margin-top: 28px;}
  .trang-dai-ly form .col-md-2 button i{font-size:16px}
  .trang-dai-ly form .col-md-4 button{background: #F7DE40;color: var(--main-color);border-radius: 20em;text-transform:none;letter-spacing:0!important;padding: 8px;width: 100%;margin-top: 28px;}
  .trang-dai-ly form .col-md-4 button i{font-size:16px}
  .trang-dai-ly .boxshadow{padding:0}
  .trang-dai-ly .ban-do .col-md-4{padding-right:0}
  .trang-dai-ly .ban-do .col-md-8{padding-left:0}
  .trang-dai-ly .ban-do .col-md-4 > p{background: var(--main-color);padding:7px 30px;font-weight:700;margin-bottom:0;font-size:14px;color: #fff;}
  .trang-dai-ly .ban-do .col-md-4 > p span{font-size:1em}
  .trang-dai-ly .ban-do .tableover{height:500px;overflow-y:scroll}
  .trang-dai-ly .ban-do table td{padding: 9px 10px 7px 34px;position:relative;background: #f2f2f2;}
  .trang-dai-ly .ban-do table td:hover,.trang-dai-ly .ban-do table td.active{background:#eee;cursor:pointer}
  .trang-dai-ly .ban-do table td:hover:before,.trang-dai-ly .ban-do table td.active:before{position:absolute;content:" ";left:-1px;top:0;height:100%;border-left: 5px var(--main-color) solid;}
  .trang-dai-ly .ban-do table td p{font-weight:700;margin:0;color: var(--main-color);line-height: 1.4;margin-bottom: 4px;}
  .trang-dai-ly .ban-do table td p i{position:absolute;left:17px;top: 10px;font-size:20px;color: var(--main-color);}
  .trang-dai-ly .ban-do table td p+p{font-weight:400;color: #333;font-size: 13px;line-height: 1.4;}
  @media only screen and (max-width:991px) {
    .trang-dai-ly .ban-do .col-md-8{padding-left:15px}
    .trang-dai-ly .ban-do .col-md-4{padding-right:15px}
  } 
  .pdl{
    position: absolute;
    top: 30.6%;
    left: 49.2%;
    transform: translate(-50%,-50%);
    background: #fff;
    padding: 10px;
    text-align: center;
    border: 1px #eb2226 solid;
    width: 82%;
  }
  .pdl img{
    position: absolute;
    bottom: -56px;
    left: 50%;
    transform: translateX(-50%);
  }
</style>