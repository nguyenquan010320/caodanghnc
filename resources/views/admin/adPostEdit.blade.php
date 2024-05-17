@extends('layouts.backend')
@section('content')
<section class="content-header">
  <h1><a class="btn btn-danger btn-sm" href="/admin/p{{$catId}}"><i class="fa fa-arrow-left"></i> @lang('Quay lại')</a>
    @if(!empty($p['id']))<a class="btn btn-primary btn-sm" href="/admin/p{{$catId}}-edit0" ><i class="fa fa-plus"></i> @lang('Tạo mới') {!!$category[$catId]['title'] or '' !!}</a>@endif
    @if(empty($p['id'])) @lang('Thêm') @else @lang('Sửa') @endif {!!$category[$catId]['title'] or '' !!}
    @if($p['active'])
    <a class="btn btn-primary btn-sm" style="float: right;" href="{{$p['link']}}" target="_blank">@lang('Xem bài viết này') <i class="fa fa-arrow-right"></i></a>@endif
    @if(!empty($p['id']))<a class="btn btn-default btn-sm" style="float: right; margin-right: 10px" href="/admin/p{{$catId}}-edit0?copy={!!$p['id'] or '' !!}" target="_blank">@lang('Nhân bản thành bài viết mới') <i class="fa fa-copy"></i></a>@endif
  </h1> 
</section>
<section class="content">
  <div class="box box-product">
    <form role="form" data-element="post">
      @php($backLink = (!empty($p['id'])) ? '/admin/p'.$catId.'-edit'.$p['id'] : '/admin/p'.$catId)
      {!! Helper::boxFooterPost($lang,$languages,$p['id'],$backLink) !!}
      <div class="box-body row">
        <div class="col-md-9">
          <input type="hidden" class="form-control" name="id" value="{{$p['id']}}">
          {!!Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề (*)','title',$p['title'])!!}
          @if(isset($category[$catId]) && !$category[$catId]['hasChild'])
          <input type="hidden" class="form-control" name="category" value="{{$catId}}">
          @else
          <div class="form-group">
            <label style="width: 100%">@lang('Danh mục') (*)</label>
            <select class="form-control multiselect" name="category" multiple="multiple">
              {!!Helper::categoryMultiLayerByCatId($category,$p['category'],999,$catId)!!}
            </select>
          </div>
          @endif
          @if(!empty(Request::get('copy'))) @php($p['link'] = '') @endif

          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Mô tả ngắn','desc',$p['desc']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'cktextarea','Nội dung bài viết','desc_full',$p['desc_full']) !!}

          @if($catId == 23 || (!empty($p['categoryParent']) && in_array(23, $p['categoryParent'])))
          
          {{-- @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'text','Tùy biến link (bắt đầu bằng dấu gạch chéo /, chỉ dùng chữ cái, số và dấu gạch ngang - không dùng kí tự đặc biệt hay chữ có dấu)','link',$p['link']) !!} @endif --}}
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">Banner chính</h4>
          {!! Helper::inputLabelNormal($lang,$languages,'onoff','Bật tắt','f1',$p['f1']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 2880x1095px','f2',$p['f2']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh Mobile 1628x1094px','f3',$p['f3']) !!}
          
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">Mô tả ngành học</h4>
          {!! Helper::inputLabelNormal($lang,$languages,'onoff','Bật tắt','f4',$p['f4']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 2880x1146px','f5',$p['f5']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 836x396px','f6',$p['f6']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f7',$p['f7']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f8',$p['f8']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 866x731px','f9',$p['f9']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 862x1080px','f10',$p['f10']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f11',$p['f11']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f12',$p['f12']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 40x30px','f13',$p['f13']) !!} @endif
          
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">Thông tin ngành học</h4>
          {!! Helper::inputLabelNormal($lang,$languages,'onoff','Bật tắt','f14',$p['f14']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 2880x1719px','f15',$p['f15']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 836x396px','f16',$p['f16']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f17',$p['f17']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 992x1426px','f18',$p['f18']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f19',$p['f19']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 28x28px','f20',$p['f20']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f21',$p['f21']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 28x28px','f22',$p['f22']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f23',$p['f23']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f24',$p['f24']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f25',$p['f25']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 40x30px','f26',$p['f26']) !!} @endif
          
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">Tự hào khám phá cơ hội</h4>
          {!! Helper::inputLabelNormal($lang,$languages,'onoff','Bật tắt','f27',$p['f27']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 2880x1747px','f28',$p['f28']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 836x396px','f29',$p['f29']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f30',$p['f30']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f31',$p['f31']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f32',$p['f32']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 651x494px','f33',$p['f33']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f34',$p['f34']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f35',$p['f35']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 651x494px','f36',$p['f36']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f37',$p['f37']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f38',$p['f38']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 652x494px','f39',$p['f39']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f40',$p['f40']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f41',$p['f41']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 651x494px','f42',$p['f42']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f43',$p['f43']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f44',$p['f44']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 651x494px','f45',$p['f45']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f46',$p['f46']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f47',$p['f47']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 652x494px','f48',$p['f48']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f49',$p['f49']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f50',$p['f50']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f51',$p['f51']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 40x30px','f52',$p['f52']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f53',$p['f53']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 40x30px','f54',$p['f54']) !!} @endif
          
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">Hình thức tuyển sinh</h4>
          {!! Helper::inputLabelNormal($lang,$languages,'onoff','Bật tắt','f55',$p['f55']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 966x904px','f56',$p['f56']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 1009x1021px','f57',$p['f57']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 165x209px','f58',$p['f58']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 86x104px','f59',$p['f59']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f60',$p['f60']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f61',$p['f61']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f62',$p['f62']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 108x108px','f63',$p['f63']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f64',$p['f64']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Đoạn','f65',$p['f65']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 108x108px','f66',$p['f66']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 126x204px','f67',$p['f67']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 110x127px','f68',$p['f68']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f69',$p['f69']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 64x64px','f70',$p['f70']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f71',$p['f71']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f73',$p['f73']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f75',$p['f75']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f77',$p['f77']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f79',$p['f79']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f81',$p['f81']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f82',$p['f82']) !!} @endif
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 40x30px','f83',$p['f83']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 1099x1097px','f84',$p['f84']) !!}
          
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">Form đăng ký</h4>
          {!! Helper::inputLabelNormal($lang,$languages,'onoff','Bật tắt','f85',$p['f85']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 1228x1014px','f86',$p['f86']) !!}
          
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">Khám phá ngành học khác</h4>
          {!! Helper::inputLabelNormal($lang,$languages,'onoff','Bật tắt','f87',$p['f87']) !!}
          @if($p['id'] == 36) {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh 832x395px','f88',$p['f88']) !!} @endif
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề','f89',$p['f89']) !!}

          @else



          @endif


          {{-- <div class="sapxepduochet">
            @for($i=0;$i<100;$i++)
            <div class="form-group {{(empty($p['img_other'][$i][0]))?'hidden':''}}">
              <label>@lang('Ảnh chi tiết số') {{$i+1}} (1000x700px)</label>
              <div class="input-group">
                <input type="text" class="form-control file_name" id="{!!rand(111111,999999)!!}" name="img{{$i}}" value="{{(empty($p['img_other'][$i][0]))?'':$p['img_other'][$i][0]}}">
                <div class="input-group-btn">
                  <a href="javascript:void(0)" class="btn btn-info file-btn">@lang('Chọn ảnh')</a><a href="javascript:void(0)" class="btn btn-default empty-btn">@lang('Xóa')</a>
                </div>
              </div>
              <p class="help-block">@lang('Định dạng .jpg .png hoặc .gif')</p>
              <img src="{{(empty($p['img_other'][$i][0]))?'':$p['img_other'][$i][0]}}" style="width: 300px;"/>
            </div>
            @endfor
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-primary add-image-btn"><i class="fa fa-plus"></i> @lang('Up thêm ảnh chi tiết')</button>
          </div>
          <script type="text/javascript">
            $(document).ready(function($) {
              $('.box-product').on('click', '.add-image-btn', function(event) {
                $('.form-group.hidden:first').show().removeClass('hidden');
              });
            });
          </script> --}}
          
          @if(env('CUSTOM_GOOGLE'))
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Tùy chỉnh Google')</h4>
          <p>@lang('Mặc định Google sẽ lấy thông tin trong bài viết, còn nếu muốn tùy chỉnh bạn có thể điền vào các trường sau:')</p>
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề trên Google','google_title',$p['google_title']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Mô tả ngắn trên Google','google_desc',$p['google_desc']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Các từ khóa tìm kiếm liên quan (cách nhau bởi dấu phẩy)','keyword',$p['keyword']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Priority (nếu có, điền từ 0.00 đến 1.00)','google_priority',$p['google_priority']) !!}
          @endif
          @if(env('CUSTOM_FACEBOOK'))
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Tùy chỉnh Facebook/Zalo')</h4>
          <p>@lang('Mặc định khi chia sẻ Facebook sẽ lấy thông tin trong bài viết, còn nếu muốn tùy chỉnh bạn có thể điền vào các trường sau:')</p>
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh hiện khi chia sẻ (800x400px) lưu ý đặt tên file đơn giản như 1.jpg 2.jpg thì Zalo sẽ ít bị lỗi','facebook_img',$p['facebook_img']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề khi chia sẻ','facebook_title',$p['facebook_title']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Mô tả ngắn khi chia sẻ','facebook_desc',$p['facebook_desc']) !!}
          @endif
          {{-- <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Khóa truy cập')</h4>
          {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Danh sách mật mã truy cập, ngăn cách bằng dấu phẩy (ví dụ test@abc.com,0912345678,tuantungtang) nếu có điền thì sẽ yêu cầu mật khẩu còn không điền thì vào tự do','khoatruycap',$p['khoatruycap']) !!}
          @endif --}}
        </div>
        <div class="col-md-3">
          {{-- <div class="form-group">
            <label>@lang('Từ khóa chính của bài viết (từ/cụm từ dài 2-10 chữ)')</label>
            <div class="input-group">
              <input type="text" class="form-control" id="main_keyword" name="main_keyword" value="{!!$p['main_keyword'] or ''!!}">
              <div class="input-group-btn"><button type="button" class="btn btn-default seo-checker-btn">@lang('Kiểm tra SEO')</button></div>
            </div>
            <input type="hidden" id="seo_point" name="seo_point" value="{!!$p['seo_point'] or ''!!}">
          </div>
          <script type="text/javascript">
            $(document).ready(function() {
              setTimeout(function(){
                var mainKeyword = $('#main_keyword').val();
                if(mainKeyword!=null && mainKeyword!="" && mainKeyword!=undefined){
                  $('.seo-checker-btn').trigger('click');
                }
              },1000);
            });
          </script>
          <p class="diem-seo"><b>@lang('Điểm SEO:')</b> <span class="kiem-tra">@lang('Chưa kiểm tra')</span> <span class="label label-info">@lang('Tuyệt vời')</span><span class="label label-warning">@lang('Tốt')</span><span class="label label-success">@lang('Trung bình')</span><span class="label label-danger">@lang('Kém')</span></p>
          <ul class="seo-check-ul">
            <li class="seo-check seo-check-1"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Có từ khóa chính')</span></li>
            <li class="seo-check seo-check-2"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Từ khóa chính có trong tiêu đề')</span></li>
            <li class="seo-check seo-check-3"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Từ khóa chính có trong mô tả ngắn')</span></li>
            <li class="seo-check seo-check-4"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Từ khóa chính có trong bài viết')</span></li>
            <li class="seo-check seo-check-5"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Bài viết có tối thiểu 100 chữ')</span></li>
            <li class="seo-check seo-check-6"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Bài viết chia thành các mục tiêu đề 2')</span></li>
            <li class="seo-check seo-check-7"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Bài viết có ít nhất 01 hình ảnh')</span></li>
            <li class="seo-check seo-check-8"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Bài viết có link sang ít nhất 01 bài khác')</span></li>
            <li class="seo-check seo-check-9"><i class="fa fa-check-circle-o"></i><i class="fa fa-circle-o"></i><span>@lang('Đã điền mục các từ khóa tìm kiếm liên quan')</span></li>
          </ul>
          <p>
            <b>Tips:</b>Để bài viết được Google đánh giá cao (chuẩn SEO), bạn cần xác định một từ khóa chính cho bài viết, ví dụ "học quay video bằng điện thoại", từ này phải xuất hiện 1 lần trong tiêu đề, 1 lần trong mô tả ngắn, và xuất hiện 3-4 lần trong nội dung bài viết.
            @if(empty(env('CUSTOM_AGENCY')))
            <br>Cụ thể cách viết bài, vui lòng tham khảo link sau:') <a href="http://ihappy.vn/lam-the-nao-de-website-xuat-hien-tren-google-voi-thu-hang-cao--p135" target="_blank">http://ihappy.vn/lam-the-nao-de-website-xuat-hien-tren-google-voi-thu-hang-cao--p135
            </a>
            @endif
          </p> --}}
          {{-- {!!Helper::inputLabelNormal($lang,$languages,'link','Link video youtube nếu có','video',$p['video'])!!} --}}
          {{-- {!!Helper::inputLabelNormal($lang,$languages,'file','File PDF nếu có','file',$p['file'])!!} --}}
          @php($p['created_at'] = (!empty($p['created_at'])) ? $p['created_at'] : date('Y-m-d'))
          {!! Helper::inputLabelNormal($lang,$languages,'date','Ngày đăng','created_at',date('Y-m-d',strtotime($p['created_at']))) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Thứ tự sắp xếp','order',$p['order'],'','Điền số để sắp xếp bài viết lên đầu, ví dụ bài này bạn điền 0.5, bài khác bạn điền 1 thì bài này sẽ luôn xếp trên bài khác, nếu không điền số, mặc định sẽ là 9999 và bài nào mới hơn thì lên đầu') !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh đại diện (600x600px)','img',$p['img']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh cover','img_cover',$p['img_cover']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh cover Mobile','img_cover_xs',$p['img_cover_xs']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Theme','theme',$p['theme']) !!}
        </div>
      </div>
      {!! Helper::boxFooterPost($lang,$languages,$p['id'],$backLink) !!}
    </form>
  </div>
</section>
@endsection
