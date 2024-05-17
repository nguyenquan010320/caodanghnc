@extends('layouts.backend')
@section('content')
<section class="content-header">
  <h1>
    Danh sách đăng ký
    <a class="btn btn-info btn-sm" style="float: right;" href="/">@lang('Xem trang web') <i class="fa fa-arrow-right"></i></a>
  </h1>
</section>
<section class="content">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">

  <script src=//cdn.ihappy.vn/adminlte/dist/js/app.min.js></script>
  <script src=//cdn.ihappy.vn/adminlte/jquery.ui.widget.js></script>
  <script src=//cdn.ihappy.vn/adminlte/jquery.iframe-transport.js></script>
  <link rel="stylesheet" href="//cdn.ihappy.vn/adminlte/plugins/select2/select2.min.css">
  <script src="//cdn.ihappy.vn/adminlte/plugins/select2/select2.full.min.js"></script>
  <script src=//cdn.ihappy.vn/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js></script>
  <link rel=stylesheet href=//cdn.ihappy.vn/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css>
  <script src=//cdn.ihappy.vn/adminlte/bootstrap-multiselect.js></script>
  <link rel=stylesheet href=//cdn.ihappy.vn/adminlte/bootstrap-multiselect.css>
  <script src=//cdn.ihappy.vn/adminlte/plugins/datepicker/bootstrap-datepicker.js></script>
  <link rel=stylesheet href=//cdn.ihappy.vn/adminlte/plugins/datepicker/datepicker3.css>
  <script src="//cdn.ihappy.vn/js/jquery.observe_field.js" type="text/javascript"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'csv' ],
        "order": [[ 0, "desc" ]],
        "pageLength":1000
      } );
      table.buttons().container()
      .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    });
  </script>
  <div class="table-responsive" style="min-height: calc(100vh - 80px)">
    <table id="example" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th style="font-size: 12px;" class="hidden-xs">STT</th>
          <th style="font-size: 12px;">Tên</th>
          @if(Request::get('thumoi') == '1')
          <th style="font-size: 12px;">Chức danh</th>
          <th style="font-size: 12px;">Tên công ty</th>
          <th style="font-size: 12px;">Ảnh vé mời</th>
          @else
          <th style="font-size: 12px;">SĐT</th>
          <th style="font-size: 12px;">Email</th>
          <th style="font-size: 12px;">ĐC</th>
          <th style="font-size: 12px;">Ngày sinh</th>
          @endif
          <th style="font-size: 12px;">Giới tính</th>
          @if(Request::get('thamgia') == '1' || Request::get('thumoi') == '1')
          <th style="font-size: 12px;">Lựa chọn</th>
          <th style="font-size: 12px;">Mã Japan Festa</th>
          <th style="font-size: 12px;">Mã Music Show</th>
          <th style="font-size: 12px;">Mã Voucher</th>
          <th style="font-size: 12px;">Checkin</th>
          <th style="font-size: 12px;">Link mã QR</th>
          @endif
          @if(Request::get('gianhang') == '1')
          <th style="font-size: 12px;">Nhãn hàng</th>
          <th style="font-size: 12px;">Gian hàng</th>
          @endif
          <th style="font-size: 12px;">Đăng ký</th>
          <th style="font-size: 12px;">@lang('Tùy chọn')</th>
        </tr>
      </thead>
      <tbody>
        @php($i=0) @foreach ($customer as $p)  @php($json = json_decode($p['jsondata'],true)) @if((Request::get('thamgia') == '1' && !empty($p['luachon']) && empty($json['trangthumoi'])) || (Request::get('gianhang') == '1' && !empty($p['gianhang'])) || (Request::get('thumoi') == '1' && !empty($json['trangthumoi']))) @php($i++) @endif @endforeach
        @foreach ($customer as $p)  @php($json = json_decode($p['jsondata'],true)) @if((Request::get('thamgia') == '1' && !empty($p['luachon']) && empty($json['trangthumoi'])) || (Request::get('gianhang') == '1' && !empty($p['gianhang'])) || (Request::get('thumoi') == '1' && !empty($json['trangthumoi'])))
        <tr>
          <td class="hidden-xs" style="font-size: 12px;">{!!$i--!!}</td>
          <td style="font-size: 12px;">{!!$p['name'] or '' !!}</td>
          @if(Request::get('thumoi') == '1')
          <td style="font-size: 12px;">{!!$json['Chức danh'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$json['Công ty'] or '' !!}</td>
          <td style="font-size: 12px;">
            <a href="/public/fileupload/{!!$p['japanfesta'] or '' !!}_1.jpg" target="_blank" style="float: left;margin-right: 2px;"><img src="/public/fileupload/{!!$p['japanfesta'] or '' !!}_1.jpg" style="width: 100px" onerror="this.src='/public/thumbs/noimage.jpg'"></a>
            <a href="/public/fileupload/{!!$p['japanfesta'] or '' !!}_2.jpg" target="_blank"><img src="/public/fileupload/{!!$p['japanfesta'] or '' !!}_2.jpg" style="width: 100px" onerror="this.src='/public/thumbs/noimage.jpg'"></a>
          </td>
          @else
          <td style="font-size: 12px;">{!!$p['phone'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$p['email'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$p['address'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$p['ngaysinh'] or '' !!}</td>
          @endif
          <td style="font-size: 12px;">{!!$p['gioitinh'] or '' !!}</td>
          @if(Request::get('thamgia') == '1' || Request::get('thumoi') == '1')
          <td style="font-size: 12px;">{!!$p['luachon'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$p['japanfesta'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$p['musicshow'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$p['voucher'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$p['checkin'] or '' !!}</td>
          <td><a target="_blank" style="font-size: 10px;word-break: break-all;max-width: 200px;overflow: hidden;display: block;" href="{!!'https://'.$_SERVER['HTTP_HOST'].'/qr/'.$p['id']!!}">{!!'https://'.$_SERVER['HTTP_HOST'].'/qr/'.$p['id']!!}</a></td>
          @endif
          @if(Request::get('gianhang') == '1')
          <td style="font-size: 12px;">{!!$p['nhanhang'] or '' !!}</td>
          <td style="font-size: 12px;">{!!$p['gianhang'] or '' !!}</td>
          @endif
          <td class="hidden-xs text-center" style="font-size: 12px;">{!!$p['created_at'] or ''!!}</td>
          <td>
            <form data-element="customer">
              <div class="btn-group">
                @if(empty($p['deleted_at']))
                <button type="button" class="btn btn-default btn-sm delete-btn-element" data-url-back="{!!$_SERVER['REQUEST_URI']!!}" data-id="{!!$p['id'] or '' !!}">@lang('Xóa')</button>
                @else
                <button type="button" class="btn btn-default btn-sm restore-btn-element" data-url-back="{!!$_SERVER['REQUEST_URI']!!}" data-id="{!!$p['id'] or '' !!}">@lang('Khôi phục')</button>
                @endif
              </div>
            </form>
          </td>
        </tr>
        @endif @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection
