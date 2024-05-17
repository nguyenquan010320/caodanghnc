@extends('layouts.backend')
@section('content')
<section class="content-header">
  <h1>
    @lang('Tất cả') {!!$category[$catId]['title'] or '' !!}
    <a class="btn btn-primary btn-sm" href="/admin/p{!!$catId!!}-edit0" ><i class="fa fa-plus"></i> @lang('Tạo mới') {!!$category[$catId]['title'] or '' !!}</a>
    <a class="btn btn-info btn-sm" style="float: right;" href="/">@lang('Xem trang web') <i class="fa fa-arrow-right"></i></a>
  </h1>
</section>
<section class="content">
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <div class="box-tools">
          <div class="pull-right">
            <div class="form-group form-inline">
              <select class="form-control filter-select hidden-xs" id="category">
                <option value="">@lang('Tất cả danh mục')</option>
                {!!Helper::categoryMultiLayerByCatId($category,Request::get('category'),999,$catId)!!}
              </select>
              <input type="text" class="form-control hidden-xs" id="myInputTextField" placeholder="@lang('Gõ từ khóa để tìm')">
            </div>
          </div>
        </div>
      </div>
      <div class="box-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">@lang('Đã đăng') ({!!count($postList['active'])!!})</a></li>
            <li><a href="#tab_2" data-toggle="tab">@lang('Nháp') ({!!count($postList['inactive'])!!})</a></li>
            {{-- <li><a href="#tab_3" data-toggle="tab">Đã xóa ({!!count($postList['deleted'])!!})</a></li> --}}
          </ul>
          <div class="tab-content">
            @php($i=0)
            @foreach($postList as $pK=>$pL)
            <div class="tab-pane {!!($i++==0) ? 'active':''!!}" id="tab_{!!$i!!}">
              <table class="table table-hover datatable">
                <thead>
                  <tr>
                    <th class="hidden-xs">ID</th>
                    <th>@lang('Danh mục')</th>
                    <th>@lang('Ảnh')</th>
                    <th>@lang('Tiêu đề')</th>
                    <th class="hidden-xs">@lang('Ngày đăng')</th>
                    <th class="hidden-xs">@lang('Điểm SEO')</th>
                    <th class="hidden-xs">@lang('Số lần xem')</th>
                    @if($category[$catId]['type']=='product')
                    <th class="hidden-xs">@lang('Số lần vào giỏ hàng')</th>
                    <th class="hidden-xs">@lang('Số đơn hàng')</th>
                    <th class="hidden-xs">@lang('Tồn kho')</th>
                    <th class="hidden-xs">@lang('Giá bán')</th>
                    @endif
                    <th class="hidden-xs">@lang('Sắp xếp')</th>
                    <th>@lang('Tùy chọn')</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pL as $p)
                  <tr>
                    <td class="hidden-xs">{!!$p['id'] or '' !!}</td>
                    <td>
                      <?php $categoryText = [];
                      foreach ($p['category'] as $pc) { if(isset($category[$pc])){ $categoryText[] = $category[$pc]['title'];}} ?>
                      {!!implode(', ', $categoryText)!!}
                    </td>
                    <td><img src="{!!$p['img_thumb'] or '' !!}" style="height: 70px"></td>
                    <td>{!!$p['title'] or '' !!}</td>
                    <td class="hidden-xs text-center">@date($p['created_at'])</td>
                    <td class="hidden-xs text-center">
                      @if($p['seo_point'] > 6)
                      <span class="label label-info">@lang('Tuyệt vời')</span>
                      @elseif($p['seo_point'] > 4)
                      <span class="label label-warning">@lang('Tốt')</span>
                      @elseif($p['seo_point'] > 3)
                      <span class="label label-success">@lang('Trung bình')</span>
                      @elseif($p['seo_point'] > 0)
                      <span class="label label-danger">@lang('Kém')</span>
                      @else
                      <span>@lang('Chưa kiểm tra')</span>
                      @endif

                    </td>
                    <td class="hidden-xs text-center">{!!Counter::show('post', $p['id']) !!}</td>
                    @if($category[$catId]['type']=='product')
                    <td class="hidden-xs text-center">{!!Counter::show('cart', $p['id']) !!}</td>
                    <td class="hidden-xs text-center">{!!Counter::show('order', $p['id']) !!}</td>
                    <td class="hidden-xs text-center">{!!$p['stock'] or '' !!}</td>
                    <td class="hidden-xs text-center">@money($p['price_real'])</td>
                    @endif
                    <td class="hidden-xs text-center">
                      <div id="adminstatusbox{!!$p['id'] or '' !!}">{{$p['order']}}</div>
                      <i class="fa fa-pencil" id="pencil{!!$p['id'] or '' !!}" onclick="$(this).hide();$('#adminstatusbox{!!$p['id'] or '' !!}').hide();$('#status{!!$p['id'] or '' !!}').show();"></i>
                      <form data-element="post" style="display: none;margin: 10px 0 5px 0" id="status{!!$p['id'] or '' !!}">
                        <div class="form-group">
                          <input type="hidden" name="id" value="{!!$p['id'] or '' !!}">
                          <input name="order" id="adminstatus{!!$p['id'] or '' !!}" style="margin-bottom: 5px" value="{{$p['order']}}">
                          <button type="button" class="btn btn-primary btn-sm btn-flat edit-btn-element" data-id="{!!$p['id'] or '' !!}" onclick="$('#status{!!$p['id'] or '' !!}').hide();$('#adminstatusbox{!!$p['id'] or '' !!}').show();$('#pencil{!!$p['id'] or '' !!}').show();$('#adminstatusbox{!!$p['id'] or '' !!}').text($('#adminstatus{!!$p['id'] or '' !!}').val());">@lang('Lưu')</button>
                          <button type="button" class="btn btn-default btn-sm btn-flat" onclick="$('#status{!!$p['id'] or '' !!}').hide();$('#pencil{!!$p['id'] or '' !!}').show();$('#adminstatusbox{!!$p['id'] or '' !!}').show();">@lang('Hủy')</button>
                        </div>
                      </form>
                    </td>
                    <td>
                      <form data-element="post">
                        <div class="btn-group">
                          @if(empty($p['deleted_at']))
                            <a href="{!!$p['link'] or '' !!}?preview=1" target="_blank" class="btn btn-default btn-sm">@lang('Xem')</a>
                            <a href="/admin/p{!!$catId!!}-edit{!!$p['id'] or '' !!}" class="btn btn-default btn-sm">@lang('Sửa')</a>
                            {{-- <button type="button" class="btn btn-default btn-sm show-post" data-catid="{!!$catId!!}" data-id="{!!$p['id'] or '' !!}">Sửa</button> --}}
                            <button type="button" class="btn btn-default btn-sm delete-btn-element" data-id="{!!$p['id'] or '' !!}">@lang('Xóa')</button>
                          @else
                            <button type="button" class="btn btn-default btn-sm restore-btn-element" data-id="{!!$p['id'] or '' !!}">@lang('Khôi phục')</button>
                          @endif
                        </div>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<style>.dataTables_filter{display: none}</style>
<script type="text/javascript">
  $(document).ready(function(){
    $('.datatable').DataTable({
      buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
      "paging": false,
      "lengthChange": false,
      "lengthMenu": [[10, 20, -1], [10, 20, "@lang('Tất cả')"]],
      "searching": true,
      "ordering": true,
      "order": [[ 0, "desc" ]],
      "info": false,
      "autoWidth": true,
      "language": {
        "decimal":        "",
        "emptyTable":     "@lang('Chưa có dữ liệu')",
        "info":           "@lang('Đang hiện') _START_ @lang('đến') _END_ @lang('trong tổng số') _TOTAL_ @lang('kết quả')",
        "infoEmpty":      "Showing 0 to 0 of 0 entries",
        "infoFiltered":   "(filtered from _MAX_ total entries)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "@lang('Hiện') _MENU_ @lang('kết quả mỗi trang')",
        "loadingRecords": "Loading...",
        "processing":     "Processing...",
        "search":         "@lang('Tìm kiếm:')",
        "zeroRecords":    "@lang('Không có kết quả nào')",
        "paginate": {
          "first":      "@lang('Trang đầu')",
          "last":       "@lang('Trang cuối')",
          "next":       "@lang('Trang tiếp')",
          "previous":   "@lang('Trang trước')"
        },
        "aria": {
          "sortAscending":  ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        }
      }
    });

    oTable = $('.datatable').DataTable();
    $('#myInputTextField').keyup(function(){
      oTable.search($(this).val()).draw() ;
    })

    $('.tab-pane').each(function(index, el) {
      iTable = $(this).find('.datatable').DataTable();
      iTable.buttons().container().prependTo($(this));
    });

    $('.content-wrapper').on('change','.filter-select', function(){
      var category = $('#category').val();
      window.location.href="/admin/p{!!$catId!!}?category="+category;
    });
  });
</script>
@endsection
