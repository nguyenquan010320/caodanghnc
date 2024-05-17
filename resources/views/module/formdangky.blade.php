<div class="c76 " >
  <p class="c77 " >@site("tieu-de-frontend-1712829877-4")</p>
  <form class="c78 i301" id="formdangky" data-element="mail-to-admin" novalidate="novalidate" action="" method="POST">
    <div class="c79 i302 form-group">
      <img class="c80 "  src="@site("anh-frontend-1712829877-5")"><input type="text" name="Name" class="c81 i304 form-control name" placeholder="@site("tieu-de-frontend-1712829877-6")">
    </div>
    <div class="c82 i305 form-group">
      <img class="c83 "  src="@site("anh-frontend-1712829877-7")"><input type="text" name="Phone" class="c84 i307 form-control phone" placeholder="@site("tieu-de-frontend-1712829877-8")">
    </div>
    <div class="c85 i308 form-group">
      <img class="c86 "  src="@site("anh-frontend-1712829877-9")"><input type="email" name="Email" class="c87 i310 form-control email" placeholder="@site("tieu-de-frontend-1712829877-10")">
    </div>
    <div class="c88 i309 form-group">
      <img class="c89 "  src="@site("anh-frontend-1712829877-11")">
      <input type="diachi" name="Tỉnh thành" class="c90 i310 form-control diachi" list="programmingLanguages" placeholder="@site("tieu-de-frontend-1712829877-12")"> 
      <datalist id="programmingLanguages">
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
        <option value="Cần Thơ">Cần Thơ</option>
        <option value="Cao Bằng">Cao Bằng</option>
        <option value="Đà Nẵng">Đà Nẵng</option>
        <option value="Đắk Lắk">Đắk Lắk</option>
        <option value="Đắk Nông">Đắk Nông</option>
        <option value="Điện Biên">Điện Biên</option>
        <option value="Đồng Nai">Đồng Nai</option>
        <option value="Đồng Tháp">Đồng Tháp</option>
        <option value="Gia Lai">Gia Lai</option>
        <option value="Hà Giang">Hà Giang</option>
        <option value="Hà Nam">Hà Nam</option>
        <option value="Hà Nội">Hà Nội</option>
        <option value="Hà Tĩnh">Hà Tĩnh</option>
        <option value="Hải Dương">Hải Dương</option>
        <option value="Hải Phòng">Hải Phòng</option>
        <option value="Hậu Giang">Hậu Giang</option>
        <option value="TP.Hồ Chí Minh">TP.Hồ Chí Minh</option>
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
        <option value="Phú Yên">Phú Yên</option>
        <option value="Quảng Bình">Quảng Bình</option>
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
      </div>
      <div class="c91 i311 form-group {{-- @if(isset($s)) hidden @endif --}}">
        <img class="c92 "  src="@site("anh-frontend-1712829877-13")">
        <select class="c93 i313 form-control sp-name" name="Ngành đào tạo"> 
          <option class="c94 " value="" @if(!isset($s)) selected="" @endif disabled="">@site("tieu-de-frontend-1712829877-14")</option>
          @php($i=0) @foreach($post as $p) @if(in_array(23, $p['categoryParent']) && $i++<100) 
          <option class="c95 " @if(isset($s) && $s['id'] == $p['id']) selected="" @endif >{!!$p['title'] or ''!!}</option>
          @endif @endforeach 
        </select> 
      </div>
      <div class="c102 i314 form-group text-center">
        <input type="hidden" class="c103 i317" name="IP Address" value="{!!$_SERVER['REMOTE_ADDR']!!}">
        <input type="hidden" class="c103 i317" name="Thời gian" value="{!!date('Y-m-d H:i:s')!!}">
        <input type="hidden" class="c103 i317 utm" name="utm" value="">
        <input type="hidden" class="c104 i318 device" name="device" value="Máy tính">
        <button class="c105 i319 btn btn-my btn-send-mail  pulse" type="button" data-wow-iteration="100000" data-wow-duration="1s" type="button">@site("tieu-de-frontend-1712829877-22")<img class="c106 "  src="@site("anh-frontend-1712829877-23")"></button>
      </div>
    </form>
  </div>
{{--   Deployment ID
  AKfycbxlSLuaEj7-hx8sgKr6WZ-TOoxtWRVI4SHt7Q9iyCuSVyfjuw3VL6SnzOfNB0unnJlE
  Web app
  URL
  https://script.google.com/macros/s/AKfycbxlSLuaEj7-hx8sgKr6WZ-TOoxtWRVI4SHt7Q9iyCuSVyfjuw3VL6SnzOfNB0unnJlE/exec
 --}}