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
          {!! Helper::inputLabelNormal($lang,$languages,'textarea','Mô tả ngắn','desc',$p['desc']) !!}
          <div class="sapxepduochet">
            @for($i=0;$i<200;$i++)
            <div class="row ">
              <div class="col-md-6">
                <div class="form-group">
                  <label>@lang('Ảnh hoặc Link youtube số') {{$i+1}} </label>
                  <div class="input-group">
                    <input type="text" class="form-control file_name" id="{!!rand(111111,999999)!!}" name="img_other{{$i}}" value="{{(empty($p['img_other'][$i][0]))?'':$p['img_other'][$i][0]}}">
                    <div class="input-group-btn">
                      <a href="javascript:void(0)" class="btn btn-info file-btn">@lang('Chọn ảnh')</a><a href="javascript:void(0)" class="btn btn-default empty-btn">@lang('Xóa')</a>
                    </div>
                  </div>
                  <p class="help-block">@lang('Định dạng .jpg .png hoặc .gif')</p>
                  <img src="{{(empty($p['img_other'][$i][0]))?'':$p['img_other'][$i][0]}}" style="width: 300px;"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>@lang('Tiêu đề (nếu có) cho Ảnh hoặc Link youtube số') {{$i+1}} </label>
                  <input type="text" class="form-control" id="title_{!!rand(111111,999999)!!}" name="title_img_other{{$i}}" value="{{(empty($p['img_other'][$i][1]))?'':$p['img_other'][$i][1]}}">
                </div>
              </div>
            </div>
            @endfor
          </div>
          {{-- <div class="form-group">
            <button type="button" class="btn btn-primary add-image-btn"><i class="fa fa-plus"></i> Up thêm ảnh vào bộ sưu tập</button>
          </div>
          <script type="text/javascript">
            $(document).ready(function($) {
              $('.box-product').on('click', '.add-image-btn', function(event) {
                $('.hidden:first').show().removeClass('hidden');
              });
            });
          </script> --}}
        </div>
        <div class="col-md-3">
          {!! Helper::inputLabelNormal($lang,$languages,'text','Thứ tự sắp xếp','order',$p['order'],'','Điền số để sắp xếp bài viết lên đầu, ví dụ bài này bạn điền 0.5, bài khác bạn điền 1 thì bài này sẽ luôn xếp trên bài khác, nếu không điền số, mặc định sẽ là 9999 và bài nào mới hơn thì lên đầu') !!}
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh đại diện (600x600px)','img',$p['img']) !!}
          @if(env('CUSTOM_GOOGLE'))
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Tùy chỉnh Google')</h4>
          <p>@lang('Mặc định Google sẽ lấy thông tin trong bài viết, còn nếu muốn tùy chỉnh bạn có thể điền vào các trường sau:')</p>
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề trên Google','google_title',$p['google_title']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Mô tả ngắn trên Google','google_desc',$p['google_desc']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Từ khóa tìm kiếm Google','keyword',$p['keyword']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Priority (nếu có, điền từ 0.00 đến 1.00)','google_priority',$p['google_priority']) !!}
          @endif
          @if(env('CUSTOM_FACEBOOK'))
          <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Tùy chỉnh Facebook')</h4>
          <p>@lang('Mặc định khi chia sẻ Facebook sẽ lấy thông tin trong bài viết, còn nếu muốn tùy chỉnh bạn có thể điền vào các trường sau:')</p>
          {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh hiện khi chia sẻ (800x400px)','facebook_img',$p['facebook_img']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề khi chia sẻ','facebook_title',$p['facebook_title']) !!}
          {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Mô tả ngắn khi chia sẻ','facebook_desc',$p['facebook_desc']) !!}
          @endif
        </div>
      </div>
      {!! Helper::boxFooterPost($lang,$languages,$p['id'],$backLink) !!}
    </form>
  </div>
</section>
@endsection
