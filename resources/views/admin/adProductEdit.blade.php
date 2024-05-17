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


          {{-- Choose by cat, Choose by post, Multi image with title --}}

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
          {{-- <div class="form-group">
            <label style="width: 100%">@lang('Nằm trong giải pháp') (*)</label>
            <select class="form-control multiselect" name="field2" multiple="multiple">
              @php($p['field2'] = explode(',', $p['field2']))
              @foreach($post as $p2) @if(in_array(18, $p2['categoryParent']))
              <option @if(is_array($p['field2']) && in_array($p2['id'],$p['field2'])) selected="" @endif value="{!!$p2['id'] or ''!!}">{!!$p2['title'] or ''!!}</option>
              @endif @endforeach
            </select>
          </div> --}}
          {{-- {!! Helper::inputLabelNormal($lang,$languages,'text','Tùy biến link (bắt đầu bằng dấu gạch chéo /, chỉ dùng chữ cái, số và dấu gạch ngang - không dùng kí tự đặc biệt hay chữ có dấu)','link',$p['link']) !!} --}}
          {{-- {!! Helper::inputLabelNormal($lang,$languages,'text','Tồn kho','stock',$p['stock'],'sản phẩm') !!} --}}
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Mô tả ngắn','desc',$p['desc']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'cktextarea','Nội dung bài viết','desc_full',$p['desc_full']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'cktextarea','Thông số kĩ thuật','spec',$p['spec']) !!}
          @if(env('VARIANT'))
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Các kích thước')</h4>
          <div class="row">
            <?php $variant = $p['variant'];?> 
            @for($i=1;$i<20;$i++)
            <div class="col-md-4 variant {{(empty($variant[$i]['title']))?'hidden':''}}">
              <?php  
              if(empty($variant[$i])){
                $variant[$i] = ['title'=>'','price'=>0,'imgmain'=>'','img1'=>'','img2'=>'','img3'=>''];
              }
              ?>
              {!!Helper::inputLabelNormal($lang,$languages,'text','Tên phiên bản '.$i,'variant_title_'.$i,$variant[$i]['title'])!!}
              {!! Helper::inputLabelNormal($lang,$languages,'text','Giá bán','variant_price_'.$i,number_format($variant[$i]['price']),'đ') !!}
              {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh chính','variant_imgmain_'.$i,$variant[$i]['imgmain']) !!}
              {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh phụ 1','variant_img1_'.$i,$variant[$i]['img1']) !!}
              {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh phụ 2','variant_img2_'.$i,$variant[$i]['img2']) !!}
              {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh phụ 3','variant_img3_'.$i,$variant[$i]['img3']) !!}
            </div>
            @endfor
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-primary add-variant-btn"><i class="fa fa-plus"></i> @lang('Thêm phiên bản')</button>
          </div>
          <script type="text/javascript">
            $(document).ready(function($) {
              $('.box-product').on('click', '.add-variant-btn', function(event) {
                $('.variant.hidden:first').show().removeClass('hidden');
              });
            });
          </script>
          @endif
          @if(env('CUSTOM_GOOGLE'))
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Tùy chỉnh Google')</h4>
          <p>@lang('Mặc định Google sẽ lấy thông tin trong bài viết, còn nếu muốn tùy chỉnh bạn có thể điền vào các trường sau:')</p>
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề trên Google','google_title',$p['google_title']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Mô tả ngắn trên Google','google_desc',$p['google_desc']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Các từ khóa tìm kiếm liên quan (cách nhau bởi dấu phẩy)','keyword',$p['keyword']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Priority','google_priority',$p['google_priority']) !!}
          @endif
          @if(env('CUSTOM_FACEBOOK'))
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Tùy chỉnh Facebook/Zalo')</h4>
          <p>@lang('Mặc định khi chia sẻ Facebook sẽ lấy thông tin trong bài viết, còn nếu muốn tùy chỉnh bạn có thể điền vào các trường sau:')</p>
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh hiện khi chia sẻ (800x400px) lưu ý đặt tên file đơn giản như 1.jpg 2.jpg thì Zalo sẽ ít bị lỗi','facebook_img',$p['facebook_img']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề khi chia sẻ','facebook_title',$p['facebook_title']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Mô tả ngắn khi chia sẻ','facebook_desc',$p['facebook_desc']) !!}
          @endif
        </div>
        <div class="col-md-3">
          <div class="form-group">
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
          </p>
          {!!Helper::inputLabelNormal($lang,$languages,'link','Link video youtube nếu có','video',$p['video'])!!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Giá','price',number_format($p['price']),'đ') !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Giá khuyến mãi','price_promo',number_format($p['price_promo']),'đ') !!}
          @if(!empty($site['truong-phan-loai-1']['value']))
          {!! Helper::inputLabelNormal($lang,$languages,'text',$site['truong-phan-loai-1']['value'],'type1',$p['type1']) !!}
          @endif
          @if(!empty($site['truong-phan-loai-2']['value']))
          {!! Helper::inputLabelNormal($lang,$languages,'text',$site['truong-phan-loai-2']['value'],'type2',$p['type2']) !!}
          @endif
          @if(!empty($site['truong-phan-loai-3']['value']))
          {!! Helper::inputLabelNormal($lang,$languages,'text',$site['truong-phan-loai-3']['value'],'type3',$p['type3']) !!}
          @endif
          {!! Helper::inputLabelNormal($lang,$languages,'date','Ngày đăng','created_at',date('Y-m-d',strtotime($p['created_at']))) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Thứ tự sắp xếp','order',$p['order'],'','Điền số để sắp xếp bài viết lên đầu, ví dụ bài này bạn điền 0.5, bài khác bạn điền 1 thì bài này sẽ luôn xếp trên bài khác, nếu không điền số, mặc định sẽ là 9999 và bài nào mới hơn thì lên đầu') !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Theme','theme',$p['theme']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh đại diện (1000x1000px)','img',$p['img']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh cover','img_cover',$p['img_cover']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh cover Mobile','img_cover_xs',$p['img_cover_xs']) !!}
          <div class="sapxepduochet">
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
          </script>
        </div>
      </div>
      {!! Helper::boxFooterPost($lang,$languages,$p['id'],$backLink) !!}
    </form>
  </div>
</section>
@endsection
