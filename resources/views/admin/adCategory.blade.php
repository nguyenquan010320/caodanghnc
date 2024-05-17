@extends('layouts.backend')
@section('content')
@php($catSelect = Request::get('catSelect'))
<section class="content-header">
  <h1>
    @lang('Danh mục') {!!$category[$id]['title'] or '' !!}
    @if(!empty($catSelect) && isset($category[$catSelect]))
    <a class="btn btn-primary btn-sm" style="float: right;" href="{{$category[$catSelect]['link']}}" target="_blank">@lang('Xem danh mục này') <i class="fa fa-arrow-right"></i></a>
    <a class="btn btn-default btn-sm" style="float: right; margin-right: 5px" href="/admin/p{{$catSelect}}">@lang('Sửa các bài của danh mục này')</a>
    @else
    <a class="btn btn-info btn-sm" style="float: right;" href="/">@lang('Xem trang web') <i class="fa fa-arrow-right"></i></a>
    @endif
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-3 padding-right-0">
      <div class="nav-tabs-custom nav-tabs-left">
        <ul class="nav nav-tabs">
          @foreach ($category as $k => $c)
          @if($k == 'new')
          <li {!!(empty($catSelect))?'class="active"':''!!}><a href="/admin/c{!!$id!!}"><i class="fa fa-plus"></i> @lang('Thêm danh mục')</a></li>
          @else
          @if($k==$id)
          @foreach ($category as $c2) @if($c2['parent'] == $c['id'])
          <li {!!($catSelect==$c2['id'])?'class="active"':''!!}><a href="/admin/c{!!$id!!}?catSelect={{$c2['id']}}"><i class="fa fa-chevron-right"></i> {{$c2['title']}} <span class="label label-primary pull-right">{{$c2['postCount']}}</span></a></li>
          @foreach ($category as $c3) @if($c3['parent'] == $c2['id'])
          <li {!!($catSelect==$c3['id'])?'class="active"':''!!}><a href="/admin/c{!!$id!!}?catSelect={{$c3['id']}}" class="li-2-layer"><i class="fa fa-chevron-right"></i> {{$c3['title']}} <span class="label label-primary pull-right">{{$c3['postCount']}}</span></a></li>
          @foreach ($category as $c4) @if($c4['parent'] == $c3['id'])
          <li {!!($catSelect==$c4['id'])?'class="active"':''!!}><a href="/admin/c{!!$id!!}?catSelect={{$c4['id']}}" class="li-3-layer"><i class="fa fa-chevron-right"></i> {{$c4['title']}} <span class="label label-primary pull-right">{{$c4['postCount']}}</span></a></li>
          @foreach ($category as $c5) @if($c5['parent'] == $c4['id'])
          <li {!!($catSelect==$c5['id'])?'class="active"':''!!}><a href="/admin/c{!!$id!!}?catSelect={{$c5['id']}}" class="li-4-layer"><i class="fa fa-chevron-right"></i> {{$c5['title']}} <span class="label label-primary pull-right">{{$c5['postCount']}}</span></a></li>
          @endif @endforeach
          @endif @endforeach
          @endif @endforeach
          @endif @endforeach
          @endif
          @endif
          @endforeach
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <div class="tab-content">
          @php($p = (isset($category[Request::get('catSelect')]))?$category[Request::get('catSelect')]:$category['new'])
          <div class="tab-pane active">
            <form role="form" data-element="category">
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-flat btn-primary save-btn-element">@lang('Lưu')</a>
                {{-- @if($p['postCount']==0) --}}
                <a href="javascript:void(0)" class="btn btn-flat btn-default delete-btn-element" data-id="{{$p['id']}}">@lang('Xóa')</a>
                <small>@lang('Lưu ý: Xóa danh mục sẽ đồng thời xóa tất cả bài viết có trong danh mục')</small>
                {{-- @else
                <a href="javascript:void(0)" class="btn btn-flat btn-default" disabled>@lang('Xóa')</a>
                <small>@lang('Không thể xóa vì vẫn còn sản phẩm/bài viết trong danh mục này')</small>
                @endif --}}
              </div>
              <div class="box-body">
                <input type="hidden" class="form-control" name="id" value="{{$p['id']}}">
                <input type="hidden" class="form-control" name="type" value="{{$p['type']}}">
                {!! Helper::inputLabelNormal($lang,$languages,'text','Tên danh mục (*)','title',$p['title']) !!}
                <div class="form-group">
                  <label>@lang('Danh mục cha') (*)</label>
                  <select class="form-control" name="parent">
                    @foreach ($category as $k7 => $c7) @if($k7==$id && $k7 != 'new' && $c7['id'] != $p['id'])
                    <option value="{{$c7['id']}}" {{($p['parent'] == $c7['id']) ? 'selected' : ''}}>{{$c7['title']}}</option>
                    @foreach ($category as $k8 => $c8) @if($c8['parent']==$c7['id'] && $c8['id'] != $p['id'])
                    <option value="{{$c8['id']}}" {{($p['parent'] == $c8['id']) ? 'selected' : ''}}>-- {{$c8['title']}}</option>
                    @foreach ($category as $k9 => $c9)
                    @if($c9['parent']==$c8['id'] && $c9['id'] != $p['id'])
                    <option value="{{$c9['id']}}" {{($p['parent'] == $c9['id']) ? 'selected' : ''}}>---- {{$c9['title']}}</option>
                    @foreach ($category as $k10 => $c10)
                    @if($c10['parent']==$c9['id'] && $c10['id'] != $p['id'])
                    <option value="{{$c10['id']}}" {{($p['parent'] == $c10['id']) ? 'selected' : ''}}>------ {{$c10['title']}}</option>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    @endif @endforeach
                    @endif @endforeach
                  </select>
                </div>
                {{-- {!! Helper::inputLabelNormal($lang,$languages,'text','Tùy biến link (bắt đầu bằng dấu gạch chéo /, chỉ dùng chữ cái, số và dấu gạch ngang - không dùng kí tự đặc biệt hay chữ có dấu)','link',$p['link']) !!} --}}
                {!! Helper::inputLabelNormal($lang,$languages,'text','Thứ tự sắp xếp','order',$p['order']) !!}
                
                @if($id == 10)
                <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Lựa chọn 1: Link trong trang')</h4>
                <div class="form-group">
                  <label>Link đến danh mục hoặc bài viết</label>
                  <select class="form-control select2" name="menulinkin">
                    <option value="">Không</option>
                    @foreach ($category as $cl) @if(isset($cl['categoryParent']) && !in_array(10, $cl['categoryParent']))
                    <option value="c{{$cl['id']}}" {{($p['menulinkin'] == 'c'.$cl['id']) ? 'selected' : ''}}>Danh mục: {{$cl['title']}}</option>
                    @endif @endforeach
                    @foreach ($post as $cl)
                    <option value="p{{$cl['id']}}" {{($p['menulinkin'] == 'p'.$cl['id']) ? 'selected' : ''}}>Bài viết: {{$cl['title']}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Tự động xổ ra</label>
                  <select class="form-control" name="menuchild">
                    <option value="">Không</option>
                    <option {{($p['menuchild'] == '1') ? 'selected' : ''}} value="1">Danh mục con</option>
                    <option {{($p['menuchild'] == '2') ? 'selected' : ''}} value="2">Danh mục con và danh mục nhỏ hơn</option>
                    <option {{($p['menuchild'] == '3') ? 'selected' : ''}} value="3">Bài viết con</option>
                  </select>
                </div>
                <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Lựa chọn 2: Link sang website khác')</h4>
                {!! Helper::inputLabelNormal($lang,$languages,'link','Link ra ngoài','menulink',$p['menulink']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'onoff','Mở ra tab mới','menunewtab',$p['menunewtab']) !!}
                @else
                {!! Helper::inputLabelNormal($lang,$languages,'onoff','Hiện lên trang chủ','show_index',$p['show_index']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh đại diện','img',$p['img']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh cover','img_cover',$p['img_cover']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh cover Mobile','img_cover_xs',$p['img_cover_xs']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'textarea','Mô tả ngắn','desc',$p['desc']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'cktextarea','Mô tả chi tiết','desc_full',$p['desc_full']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'text','Theme','theme',$p['theme']) !!}
                @if(env('CUSTOM_GOOGLE'))
                <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Tùy chỉnh Google')</h4>
                {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề trên Google','google_title',$p['google_title']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Mô tả ngắn trên Google','google_desc',$p['google_desc']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'text','Từ khóa tìm kiếm','keyword',$p['keyword']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'text','Priority (nếu có, điền từ 0.00 đến 1.00)','google_priority',$p['google_priority']) !!}
                @endif
                @if(env('CUSTOM_FACEBOOK'))
                <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Tùy chỉnh Facebook')</h4>
                <p>@lang('Mặc định khi chia sẻ Facebook sẽ lấy thông tin trong bài viết, còn nếu muốn tùy chỉnh bạn có thể điền vào các trường sau:')</p>
                {!! Helper::inputLabelNormal($lang,$languages,'img','Ảnh hiện khi chia sẻ (800x400px)','facebook_img',$p['facebook_img']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'text','Tiêu đề khi chia sẻ','facebook_title',$p['facebook_title']) !!}
                {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Mô tả ngắn khi chia sẻ','facebook_desc',$p['facebook_desc']) !!}
                @endif
                <h4 style="background: #3c8dbc;color: #fff;padding: 10px 20px;">@lang('Khóa truy cập')</h4>
                {!! Helper::inputLabelNormal($lang,$languages,'notextarea','Danh sách mật mã truy cập, ngăn cách bằng dấu phẩy (ví dụ test@abc.com,0912345678,tuantungtang) nếu có điền thì sẽ yêu cầu mật khẩu còn không điền thì vào tự do','khoatruycap',$p['khoatruycap']) !!}
                @endif
              </div>
              <div class="box-footer">
                <a href="javascript:void(0)" class="btn btn-flat btn-primary save-btn-element">@lang('Lưu')</a>
                @if($p['postCount']==0)
                <a href="javascript:void(0)" class="btn btn-flat btn-default delete-btn-element" data-id="{{$p['id']}}">@lang('Xóa')</a>
                @else
                <a href="javascript:void(0)" class="btn btn-flat btn-default" disabled>@lang('Xóa')</a>
                <small>@lang('Không thể xóa vì vẫn còn sản phẩm/bài viết trong danh mục này')</small>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
