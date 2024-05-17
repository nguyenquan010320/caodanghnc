@extends('layouts.backend')
@section('content')
<section class="content-header">
  <h1>@lang('Danh sách đơn hàng')
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
              <li><a href="#tab_excel" data-toggle="tab">@lang('Xuất Excel')</a></li>
            </ul>
            <div class="tab-content">
              @php($i=0)
              @foreach($postList as $pK=>$pL)
              <div class="tab-pane {!!($i++==0) ? 'active':''!!}" id="tab_{!!$i!!}">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                    <tr>
                      <th>@lang('ID')</th>
                      <th>@lang('Ngày')</th>
                      <th>@lang('Mã đơn hàng')</th>
                      <th>@lang('Khách hàng')</th>
                      <th>@lang('Đơn hàng')</th>
                      <th>@lang('Trạng thái')</th>
                      <th>@lang('Ghi chú Admin')</th>
                      <th>@lang('Tùy chọn')</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pL as $p)
                    <tr>
                      <td>{!!$p['id'] or ''!!}</td>
                      <td>{!!$p['created_at'] or ''!!}</td>
                      <td>{!!$p['code'] or ''!!}</td>
                      <td>
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th>@lang('Tên')</th>
                              <td>{!!$customer[$p['customer']]['name'] or ''!!}</td>
                            </tr>
                            <tr>
                              <th>@lang('SĐT')</th>
                              <td><a href="tel:{!!$customer[$p['customer']]['phone'] or ''!!}">{!!$customer[$p['customer']]['phone'] or ''!!}</a></td>
                            </tr>
                            <tr>
                              <th>@lang('Email')</th>
                              <td>{!!$customer[$p['customer']]['email'] or ''!!}</td>
                            </tr>
                            <tr>
                              <th>@lang('ĐC')</th>
                              <td>{!!$customer[$p['customer']]['address'] or ''!!}</td>
                            </tr>
                            <tr>
                              <th>@lang('Ghi chú')</th>
                              <td>{!!$p['note'] or ''!!}</td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td>
                        <?php $products = json_decode($p['product'],true); ?> 
                        @if(!empty($products))
                        <table class="table table-bordered">
                          <tbody>
                            <tr>
                              <th>@lang('Tên SP')</th>
                              <th>@lang('SL')</th>
                              <th>@lang('Đơn giá')</th>
                            </tr>
                            @foreach($products as $pd)
                            <tr>
                              <td><a href="{!!$post[$pd['id']]['link'] or ''!!}" target="_blank">{!!$pd['name'] or ''!!}</a></td>
                              <td>{!!$pd['quantity'] or ''!!}</td>
                              <td>@money($pd['price'])</td>
                            </tr>
                            @endforeach
                            <tr>
                              <th>@lang('Tổng tiền')</th>
                              <td colspan="2">@money($p['amount'])</td>
                            </tr>
                            <tr>
                              <td colspan="3">{!!$p['payment'] or ''!!}</td>
                            </tr>
                          </tbody>
                        </table>
                        @endif
                      </td>
                      <td>
                        <div id="adminstatusbox{!!$p['id'] or '' !!}">{!!$p['status'] or '' !!}</div>
                        <i class="fa fa-pencil" id="pencil{!!$p['id'] or '' !!}" onclick="$(this).hide();$('#adminstatusbox{!!$p['id'] or '' !!}').hide();$('#status{!!$p['id'] or '' !!}').show();"></i>
                        <form data-element="order" style="display: none;margin: 10px 0 5px 0" id="status{!!$p['id'] or '' !!}">
                          <div class="form-group">
                            <input type="hidden" name="id" value="{!!$p['id'] or '' !!}">
                            <select name="status" id="adminstatus{!!$p['id'] or '' !!}" style="margin-bottom: 5px">
                              @foreach(explode(',', $site['danh-sach-trang-thai']['value']) as $stt)
                              <option @if($p['status']==trim($stt)) selected="" @endif>{!!trim($stt)!!}</option>
                              @endforeach
                            </select>
                            <button type="button" class="btn btn-primary btn-sm btn-flat edit-btn-element" data-id="{!!$p['id'] or '' !!}" onclick="$('#status{!!$p['id'] or '' !!}').hide();$('#adminstatusbox{!!$p['id'] or '' !!}').show();$('#pencil{!!$p['id'] or '' !!}').show();$('#adminstatusbox{!!$p['id'] or '' !!}').text($('#adminstatus{!!$p['id'] or '' !!}').val());$('#adminnotebox{!!$p['id'] or '' !!}').append('('+datetime+') <b>{!!Auth::user()->name!!}: </b> '+$('#adminstatus{!!$p['id'] or '' !!}').val()+'<br>');$('#commentold{!!$p['id'] or '' !!}').val($('#adminnotebox{!!$p['id'] or '' !!}').html());$('.edit-adminnote-{!!$p['id'] or '' !!}').trigger('click');">@lang('Lưu')</button>
                            <button type="button" class="btn btn-default btn-sm btn-flat" onclick="$('#status{!!$p['id'] or '' !!}').hide();$('#pencil{!!$p['id'] or '' !!}').show();$('#adminstatusbox{!!$p['id'] or '' !!}').show();">@lang('Hủy')</button>
                          </div>
                        </form>
                      </td>
                      <td>
                        <div id="adminnotebox{!!$p['id'] or '' !!}">{!!$p['admin_note'] or '' !!}</div>
                        <i class="fa fa-plus" id="plus{!!$p['id'] or '' !!}" onclick="$(this).hide();$('#comment{!!$p['id'] or '' !!}').show();"></i>
                        <script type="text/javascript">
                          var currentdate = new Date(); 
                          var datetime = currentdate.getDate() + "/"+ (currentdate.getMonth()+1) + " " + currentdate.getHours() + ":"  + currentdate.getMinutes() + ":" + currentdate.getSeconds();
                        </script>
                        <form data-element="order" style="display: none;margin: 10px 0 5px 0" id="comment{!!$p['id'] or '' !!}">
                          <div class="form-group">
                            <input type="hidden" name="id" value="{!!$p['id'] or '' !!}">
                            <input type="hidden" name="admin_note" id="commentold{!!$p['id'] or '' !!}" value="{!!$p['admin_note'] or '' !!}">
                            <textarea class="form-control" name="comment_new" id="adminnote{!!$p['id'] or '' !!}" style="margin-bottom: 5px"></textarea>
                            <button type="button" style="display: none;" class="edit-btn-element edit-adminnote-{!!$p['id'] or '' !!}" data-id="{!!$p['id'] or '' !!}" ></button>
                            <button type="button" class="btn btn-primary btn-sm btn-flat edit-btn-element" data-id="{!!$p['id'] or '' !!}" onclick="$('#comment{!!$p['id'] or '' !!}').hide();$('#plus{!!$p['id'] or '' !!}').show();$('#adminnotebox{!!$p['id'] or '' !!}').append('('+datetime+') <b>{!!Auth::user()->name!!}: </b>'+$('#adminnote{!!$p['id'] or '' !!}').val()+'<br>');$('#commentold{!!$p['id'] or '' !!}').val($('#adminnotebox{!!$p['id'] or '' !!}').html());$('#adminnote{!!$p['id'] or '' !!}').val('');">@lang('Lưu')</button>
                            <button type="button" class="btn btn-default btn-sm btn-flat" onclick="$('#comment{!!$p['id'] or '' !!}').hide();$('#plus{!!$p['id'] or '' !!}').show();">@lang('Hủy')</button>
                          </div>
                        </form>
                      </td>
                      <td>
                        <form data-element="order">
                          <div class="btn-group">
                            @if(empty($p['deleted_at']))
                            @if($p['active']==0)
                            <button type="button" class="btn btn-default btn-sm active-btn-element" data-id="{!!$p['id'] or ''!!}">@lang('Hoàn tất')</button>
                            @else
                            <button type="button" class="btn btn-default btn-sm deactive-btn-element" data-id="{!!$p['id'] or ''!!}">@lang('Chờ xử lý')</button>
                            @endif
                            <button type="button" class="btn btn-default btn-sm delete-btn-element" data-id="{!!$p['id'] or ''!!}">@lang('Xóa')</button>
                            @else
                            <button type="button" class="btn btn-default btn-sm restore-btn-element" data-id="{!!$p['id'] or ''!!}">@lang('Khôi phục')</button>
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
              <div class="tab-pane" id="tab_excel">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                    <tr>
                      <th>@lang('ID')</th>
                      <th>@lang('Ngày')</th>
                      <th>@lang('Tên KH')</th>
                      <th>@lang('SĐT')</th>
                      <th>@lang('Email')</th>
                      <th>@lang('Địa chỉ')</th>
                      <th>@lang('Ghi chú')</th>
                      <th>@lang('Đơn hàng')</th>
                      <th>@lang('Tổng tiền')</th>
                      <th>@lang('Thanh toán')</th>
                      <th>@lang('Trạng thái')</th>
                      <th>@lang('Ghi chú Admin')</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($postList as $pK=>$pL)
                    @foreach ($pL as $p)
                    <tr>
                      <td>{!!$p['id'] or ''!!}</td>
                      <td>{!!$p['created_at'] or ''!!}</td>
                      <td>{!!$customer[$p['customer']]['name'] or ''!!}</td>
                      <td><a href="tel:{!!$customer[$p['customer']]['phone'] or ''!!}">{!!$customer[$p['customer']]['phone'] or ''!!}</a></td>
                      <td>{!!$customer[$p['customer']]['email'] or ''!!}</td>
                      <td>{!!$customer[$p['customer']]['address'] or ''!!}</td>
                      <td>{!!$p['note'] or ''!!}</td>
                      <td>
                        <?php $products = json_decode($p['product'],true); ?> 
                        @if(!empty($products))
                        @foreach($products as $pd)
                        <p><a href="{!!$post[$pd['id']]['link'] or ''!!}" target="_blank">{!!$pd['name'] or ''!!}</a> x {!!$pd['quantity'] or ''!!} (@money($pd['price']))</p>
                        @endforeach
                        @endif
                      </td>
                      <td>@money($p['amount'])</td>
                      <td>{!!$p['payment'] or ''!!}</td>
                      <td>{!!$p['status'] or '' !!}</td>
                      <td>{!!$p['admin_note'] or '' !!}</td>
                    </tr>
                    @endforeach
                    @endforeach
                  </tbody>
                </table>
              </div>
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
