@if(Auth::check())
  <style type="text/css">
    .admin-toolbar{position:fixed;bottom:0;left:50%;padding:0 10px;background:#5769bf;z-index:9999;color:#fff;transform:translateX(-50%);box-shadow:0 0 10px 3px #ccc;border-top-left-radius:10px;border-top-right-radius:10px}
    .admin-toolbar span{font-weight:700;padding:5px 10px;float:left;color:#fff;}
    .admin-toolbar a{color:#fff;padding:5px 10px;border-left:1px #eeeeee94 solid;margin:0;float:left}
    .admin-toolbar a:first-child{border-left:none;}
    .admin-toolbar a:hover{background:#949eea}
  </style>
  <div class="admin-toolbar hidden-xs">
    {{-- <span>HappyCMS 2018</span> --}}
    <a href=/admin><i class="fa fa-arrow-circle-right"></i> @langadmin('Vào trang quản lý')</a>
    @if(Request::is('/')) <a href=/admin/adSetting?section=1><i class="fa fa-pencil"></i> @langadmin('Sửa trang chủ')</a> @endif
    @if(isset($s))
      @if(isset($s['parent'])) {{-- Trang category --}}
        <a href="/admin/c{!!$s['categoryParent'][1].'?catSelect='.$s['id']!!}"><i class="fa fa-pencil"></i> @langadmin('Sửa danh mục này')</a>
        <a href="/admin/p{!!$s['categoryParent'][1]!!}-edit0"><i class="fa fa-plus"></i> @langadmin('Tạo mới') {!!$category[$s['categoryParent'][1]]['title'] or '' !!}</a>
      @else {{-- Trang post --}}
        <a href="/admin/p{!!$s['categoryParent'][1].'-edit'.$s['id']!!}"><i class="fa fa-pencil"></i> @langadmin('Sửa') {!!$category[$s['categoryParent'][1]]['title'] or '' !!}</a>
        <a href="/admin/p{!!$s['categoryParent'][1]!!}-edit0"><i class="fa fa-plus"></i> @langadmin('Tạo mới') {!!$category[$s['categoryParent'][1]]['title'] or '' !!}</a>
      @endif
    @endif
  </div>
@endif