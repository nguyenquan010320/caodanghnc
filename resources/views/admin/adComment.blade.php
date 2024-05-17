@extends('layouts.backend')
@section('content')
<section class="content-header">
  <h1>@lang('Danh sách bình luận')
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
                <input type="text" class="form-control" id="myInputTextField" placeholder="@lang('Gõ từ khóa để tìm')">
              </div>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              @php($i=0)
              @foreach($postList as $pK=>$pL)
              <li class="{!!($i++==0) ? 'active':''!!}"><a href="#tab_{!!$i!!}" data-toggle="tab">{!!$pK!!} ({!!count($pL)!!})</a></li>
              @endforeach
            </ul>
            <div class="tab-content">
              @php($i=0)
              @foreach($postList as $pK=>$pL)
              <div class="tab-pane {!!($i++==0) ? 'active':''!!}" id="tab_{!!$i!!}">
                <table class="table table-hover datatable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>@lang('Ngày')</th>
                      <th>@lang('Bài viết')</th>
                      <th>@lang('Đánh giá (sao)')</th>
                      <th>@lang('Tên')</th>
                      <th>@lang('Bình luận')</th>
                      <th>@lang('Tùy chọn')</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pL as $p)
                    <tr>
                      <td>{!!$p['id'] or '' !!}</td>
                      <td>{!!$p['created_at'] or '' !!}</td>
                      <td>{!!$post[$p['post']]['title'] or '' !!}</td>
                      <td>{!!$p['rating'] or '' !!}</td>
                      <td>{!!$p['name'] or '' !!}</td>
                      <td>{!!$p['comment'] or '' !!}</td>
                      <td>
                        <form data-element="comment">
                          <div class="btn-group">
                            @if(empty($p['deleted_at']))
                            @if($p['active']==0)
                            <button type="button" class="btn btn-default btn-sm active-btn-element" data-id="{!!$p['id'] or '' !!}">@lang('Duyệt')</button>
                            @else
                            <button type="button" class="btn btn-default btn-sm deactive-btn-element" data-id="{!!$p['id'] or '' !!}">@lang('Bỏ duyệt')</button>
                            @endif
                            <a href="{!!$post[$p['post']]['link'] or ''!!}" target="_blank" class="btn btn-default btn-sm">@lang('Xem sản phẩm')</a> 
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
    });
    
    $('.tab-pane').each(function(index, el) {
      iTable = $(this).find('.datatable').DataTable();
      iTable.buttons().container().prependTo($(this));
    });
  });
</script>
@endsection
