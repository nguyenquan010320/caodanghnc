<div class="i954 sidebar col-md-3 post-sidebar">
  {{-- <script class="i955 "  type="text/javascript" src="/public/frontend/js/qrcode.js"></script>
  <div class="i956 qr-code">
    <div class="i957 "  id="placeHolder"></div>
    <p class="i958 text-center">Quét mã QR để đọc bài<br class="i959 " >trên điện thoại</p>
  </div>
  <script class="i960 "  type="text/javascript">
    window.addEventListener('DOMContentLoaded', function() {
      var typeNumber = 10;
      var errorCorrectionLevel = 'L';
      var qr = qrcode(typeNumber, errorCorrectionLevel);
      qr.addData('https://{!!$_SERVER['HTTP_HOST'] or '' !!}{!!(!empty($s['link'])) ? $s['link'] : ''!!}');
      qr.make();
      document.getElementById('placeHolder').innerHTML = qr.createImgTag();
    });
  </script> --}}
  <div class="i961 widget widget-newsletter">
    <form id="widget-search-form-sidebar" action="/tim-kiem" method="get" class="i962 form-inline">
      <div class="i963 input-group">
        <input type="text" aria-required="true" name="searchKeyword" class="i964 form-control widget-search-form" placeholder="@lang('Gõ để tìm kiếm')">
        <span class="i965 input-group-btn">
          <button type="submit" id="widget-widget-search-form-button" class="i966 btn btn-default"><i class="i967 fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <h4 class="i968 tieu-de-h3">@lang('Danh mục bài viết')</h4>
    <div class="i969 list-group m-t-20">
      @foreach($category as $pc) @if($pc['type']=='post') @if(empty($pc['parent']))
      {{-- <a href="{!!$pc['link'] or '' !!}" class="i970 list-group-item {{(!empty($id) && $pc['id']==$id)?'active':''}}">{!!$pc['title'] or '' !!}</a> --}}
      @foreach($category as $pc2) @if($pc2['parent']==$pc['id'])
      <a href="{!!$pc2['link'] or '' !!}" class="i971 list-group-item {{(!empty($id) && $pc2['id']==$id)?'active':''}}">{!!$pc2['title'] or '' !!} {{-- <span class="i972 badge">{!!$pc2['postCount'] or '' !!}</span> --}} </a>
      @foreach($category as $pc3) @if($pc3['parent']==$pc2['id'])
      <a href="{!!$pc3['link'] or '' !!}" class="i973 list-group-item p-l-30 {{(!empty($id) && $pc3['id']==$id)?'active':''}}">{!!$pc3['title'] or '' !!} {{-- <span class="i974 badge">{!!$pc3['postCount'] or '' !!}</span> --}} </a>
      @foreach($category as $pc4) @if($pc4['parent']==$pc3['id'])
      <a href="{!!$pc4['link'] or '' !!}" class="i975 list-group-item p-l-40 {{(!empty($id) && $pc4['id']==$id)?'active':''}}">{!!$pc4['title'] or '' !!} {{-- <span class="i976 badge">{!!$pc4['postCount'] or '' !!}</span> --}} </a>
      @foreach($category as $pc5) @if($pc5['parent']==$pc4['id'])
      <a href="{!!$pc5['link'] or '' !!}" class="i977 list-group-item p-l-50 {{(!empty($id) && $pc5['id']==$id)?'active':''}}">{!!$pc5['title'] or '' !!} {{-- <span class="i978 badge">{!!$pc5['postCount'] or '' !!}</span> --}} </a>
      @endif @endforeach
      @endif @endforeach
      @endif @endforeach
      @endif @endforeach
      @endif @endif @endforeach
    </div>
    {{-- <h4 class="i979 tieu-de-h3">@lang('Tags')</h4>
    <div class="i980 post-thumbnail-list">
      @foreach($tags as $k=>$t) @if(!empty($t))
      <div class="i981 post-thumbnail-entry">
        <a class="i982 "  href="/tim-kiem?searchKeyword={!!mb_strtolower($k)!!}">{!!$k!!} ({!!$t!!})</a>
      </div>
      @endif @endforeach
    </div> --}}
    <h4 class="i983 tieu-de-h3">@lang('Bài viết mới')</h4>
    <div class="i984 post-thumbnail-list">
      @php($i=0) @foreach($post as $p) @if(in_array(3, $p['categoryParent']) && !in_array(8, $p['categoryParent']) && $i++<6)
      <div class="i985 post-thumbnail-entry">
        {{-- <a class="i986 "  href="{!!$p['link'] or '' !!}" title="{!!$p['title'] or '' !!}"><img class="i987 img-responsive img-rounded img-thumbnail" alt="{!!$p['title'] or '' !!}" src="{!!$p['img_thumb'] or '' !!}"></a> --}}
        {{-- <div class="i988 post-thumbnail-content"> --}}
          <a class="i989 "  href="{!!$p['link'] or '' !!}" title="{!!$p['title'] or '' !!}">{!!$p['title'] or '' !!}</a>
          {{-- <span class="i990 post-category"><i class="i991 fa fa-tag"></i> {!!$p['categoryInfo']['title'] or '' !!}</span> --}}
        {{-- </div> --}}
      </div>
      @endif @endforeach
    </div>
  </div>
</div>