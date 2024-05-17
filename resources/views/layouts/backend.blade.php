<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8>
  <meta http-equiv=X-UA-Compatible content="IE=edge">
  <title>Phần mềm quản lý website</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name=viewport>
  <link rel=stylesheet href=//cdn.ihappy.vn/adminlte/bootstrap/css/bootstrap.min.css>
  <link rel=stylesheet href=//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css>
  {{-- <link rel=stylesheet href=//cdn.ihappy.vn/adminlte/plugins/ionicons/ionicons.min.css> --}}
  <link rel=stylesheet href=//cdn.ihappy.vn/adminlte/dist/css/AdminLTE.min.css>
  <link rel=stylesheet href=//cdn.ihappy.vn/adminlte/dist/css/skins/skin-green.min.css>
  <link rel=stylesheet href=/public/backend/style.css?{{time()}}>
  <!--[if lt IE 9]>
  <script src=https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js></script>
  <script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script>
<![endif]-->
<script src=//cdn.ihappy.vn/adminlte/plugins/jQuery/jquery-2.2.3.min.js></script>
<script src=//cdn.ihappy.vn/adminlte/bootstrap/js/bootstrap.min.js></script>
<script src=//cdn.ihappy.vn/adminlte/dist/js/app.min.js></script>

<script src=//cdn.ihappy.vn/adminlte/jquery.ui.widget.js></script>
<script src=//cdn.ihappy.vn/adminlte/jquery.iframe-transport.js></script>
{{-- <script src=//cdn.ihappy.vn/adminlte/jquery.fileupload.js></script> --}}

<script src=//cdn.ihappy.vn/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js></script>
<link rel=stylesheet href=//cdn.ihappy.vn/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css>

{{-- <script src=//cdn.ihappy.vn/adminlte/plugins/ckeditor/ckeditor.js></script> --}}
{{-- <script src=//cdn.ihappy.vn/adminlte/plugins/ckeditor/adapters/jquery.js></script> --}}
<script src=//cdn.ihappy.vn/adminlte/plugins/tinymce/tinymce.min.js></script>

{{-- <script src=//cdn.ihappy.vn/adminlte/plugins/datatables/jquery.dataTables.min.js></script> --}}
{{-- <script src=//cdn.ihappy.vn/adminlte/plugins/datatables/dataTables.bootstrap.min.js></script> --}}
{{-- <link rel=stylesheet href=//cdn.ihappy.vn/adminlte/plugins/datatables/dataTables.bootstrap.css> --}}
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

<script src=//cdn.ihappy.vn/adminlte/bootstrap-multiselect.js></script>
<link rel=stylesheet href=//cdn.ihappy.vn/adminlte/bootstrap-multiselect.css>

<link rel="stylesheet" href="//cdn.ihappy.vn/adminlte/plugins/select2/select2.min.css">
<script src="//cdn.ihappy.vn/adminlte/plugins/select2/select2.full.min.js"></script>

<script src=//cdn.ihappy.vn/adminlte/plugins/datepicker/bootstrap-datepicker.js></script>
<link rel=stylesheet href=//cdn.ihappy.vn/adminlte/plugins/datepicker/datepicker3.css>

<script src="//cdn.ihappy.vn/js/jquery.observe_field.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

@if($site['che-do-bao-mat-https']['value'] == '1')
@if(substr($_SERVER['HTTP_HOST'], -2,2) != '.l')
<script type="text/javascript">
  if (location.protocol != 'https:'){
    location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
  }
</script>
@endif
@endif
</head>
<body class="hold-transition skin-green sidebar-mini">
  <div class=wrapper>
    <header class=main-header>
      @php($langs = ['vi'=>'Tiếng Việt','en'=>'English','ja'=>'日本語','ko'=>'한국어','zh'=>'中文'])
      <a href=/ class=logo><span class=logo-lg>{!!$langs[$currentLanguage] or env('CUSTOM_AGENCY')!!}</span></a>
      <nav class="navbar navbar-static-top visible-xs">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> @langadmin('MENU CHỨC NĂNG')</a>
      </nav>
    </header>
    <aside class=main-sidebar>
      <section class=sidebar>
        <ul class=sidebar-menu>
          <li>
            <a href="/admin"><i class="fa fa-pie-chart"></i> <span>@langadmin('Trang tổng quan')</span></a>
          </li>
          <?php 
          $menu = [];
          $roles = explode(',', Auth::user()->role);
          if(in_array('admin', $roles)){ $menuAdd = unserialize(ADMIN_MENU); $menu = array_merge($menu, $menuAdd); }
          if(in_array('sale', $roles)){ $menuAdd = unserialize(SALE_MENU); $menu = array_merge($menu, $menuAdd); }
          if(in_array('content', $roles)){ $menuAdd = unserialize(CONTENT_MENU); $menu = array_merge($menu, $menuAdd); }
          ?>
          @if(!empty($menu))
          @foreach($menu as $mK => $m)
          <li class=header>{!!$mK!!}</li>
          @foreach($m as $mK2 => $m2)
          <li class={{((Request::is('admin/'.$mK2)) ? 'active' : '')}}>
            <a href="/admin/{{$mK2}}"><i class="fa fa-{{$m2[0]}}"></i> <span>{!!$m2[1]!!}</span></a>
          </li>
          @endforeach
          @endforeach
          @endif
          <li class=header>@langadmin('TÀI KHOẢN')</li>
          <li class={{((Request::is('changePassword')) ? 'active' : '')}}>
            <a href="/changePassword"><i class="fa fa-key"></i> <span>@langadmin('Đổi mật khẩu')</span></a>
          </li>
          <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>
            <span>@langadmin('Đăng xuất')</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </section>
  </aside>
  <div class=content-wrapper>
    @yield('content')
  </div>
  @if(empty(env('CUSTOM_AGENCY')))
  <footer class="main-footer">
    @langadmin('Website sử dụng phần mềm iHappyCMS - Điện thoại/Zalo hỗ trợ:') <a href="tel:84936388025" target="_top">0936 388 025</a> - Email: <a href="mailto:ihappy.asia@gmail.com" target="_top">ihappy.asia@gmail.com</a>
  </footer>
  @endif
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="upload-modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <iframe src="" style="width: 100%;height: 700px"></iframe>
    </div>
  </div>
</div>
{{-- <script src=//cdn.ihappy.vn/adminlte/dist/js/demo.js></script> --}}
<script type="text/javascript">
  $(document).ready(function(){
      $('.select2').select2();
    $('.textarea').wysihtml5({
      toolbar:{
        'font-styles': false,
        'blockquote':false,
        'image':false,
        'link':false,
        'fa': true,
      }
    });
    $('.multiselect').multiselect();
    $('.datepicker').datepicker({dateFormat: 'yy-mm-dd',autoclose: true});

    tinymce.init({
      selector: ".cktextarea",theme: "modern",height: 500, @if($lang=='vi' || empty($lang)) language:'vi_VN', @endif
      plugins: [
      "advlist autolink link image lists charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
      "table contextmenu directionality emoticons paste textcolor responsivefilemanager code toc  fontawesome noneditable"
      ],
      toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | formatselect fontselect fontsizeselect | removeformat",
      toolbar2: "| responsivefilemanager | link unlink | table | forecolor backcolor | media toc charmap fontawesome | code ",
      image_advtab: true ,
      table_default_styles: {width: '100%'},
      external_filemanager_path:"/public/filemanager/",
      filemanager_title:"@langadmin('Quản lý file')" ,
      external_plugins: { "filemanager" : "/public/filemanager/plugin.min.js"},
      content_style: 'img {max-width: 100%;margin: 10px 0;border: 1px #ccc solid;height: auto;}',
      // content_css: 'https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
      noneditable_noneditable_class: 'fa',
      extended_valid_elements: 'span[*]',
      content_css: "/public/backend/style.css?{{time()}},//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"
    });

    $('.file-btn').click(function(){
      var id = $(this).parents('.form-group').find("input").attr('id');
      $('#upload-modal').find('iframe').attr('src','/public/filemanager/dialog.php?type=2&field_id='+id);
      $('#upload-modal').modal('show');
      $(this).parents('.form-group').find("input").observe_field(1, function() {
       $(this).parents('.form-group').find("img").attr('src',this.value).show();
       $(this).parents('.form-group').find("video").html('<source src="'+this.value+'" type="video/mp4"></source>');
     });
    });

   $( ".sapxepduochet" ).sortable();

    $('.empty-btn').click(function(){
      $(this).parents('.form-group').find("input").val('');
     $(this).parents('.form-group').find("img").attr('src','');
    });


    $('.content-wrapper').on('click','.save-btn', function(){
      var button = $(this);
      button.text('@langadmin('Đang lưu')...');
      var data = $(this).parents('form').serializeArray();
      $.ajax({dataType: "html",type: "POST",evalScripts: true,
        url: "/admin/updateDataFrontEnd",
        data: ({"_token": "{{ csrf_token() }}",json_data:JSON.stringify(data)}),
        success: function(){
          button.html('<i class="fa fa-check"></i> @langadmin('Đã lưu thành công!')').addClass('btn-warning').removeClass('btn-primary');
            // alert('Lưu thành công!');
            // window.location.reload();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          }
        });
    });

    $('.content-wrapper').on('click','.save-btn-element', function(){
      var button = $(this);
      button.text('@langadmin('Đang lưu')...');
      var data = $(this).parents('form').serializeArray();
      if (tinyMCE.activeEditor != null){
        if(data[search("desc_full", data)]){data[search("desc_full", data)].value = tinyMCE.get('desc_full').getContent()};
      }
      var element = $(this).parents('form').data('element');
      $.ajax({dataType: "html",type: "POST",evalScripts: true,
        url: "/admin/updateDataElement",
        data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data)}),
        success: function(){
          button.html('<i class="fa fa-check"></i> @langadmin('Đã lưu thành công')!').addClass('btn-warning').removeClass('btn-primary');
            // alert('Lưu thành công!');
            // window.location.reload();
          },error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          }
        });
    });

    $('.content-wrapper').on('click','.edit-btn-element', function(){
      var element = $(this).parents('form').data('element');
      var id = $(this).data('id');
      var data = $(this).parents('form').serializeArray();
      $.ajax({dataType: "html",type: "POST",evalScripts: true,
        url: "/admin/updateDataElement",
        data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data)}),
        success: function(){
        },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          }
      });
    });

    $('.content-wrapper').on('click','.active-btn-element', function(){
      if(confirm('@langadmin('Bạn đồng ý duyệt')?')){
        var element = $(this).parents('form').data('element');
        var id = $(this).data('id');
        var data = [{'name':'id', 'value':id}];
        $.ajax({dataType: "html",type: "POST",evalScripts: true,
          url: "/admin/updateDataElement",
          data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data),active:1}),
          success: function(){
            alert('@langadmin('Duyệt thành công!')');
            window.location.reload();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          }
        });
      }
    });

    $('.content-wrapper').on('click','.deactive-btn-element', function(){
      if(confirm('@langadmin('Bạn đồng ý bỏ duyệt')?')){
        var element = $(this).parents('form').data('element');
        var id = $(this).data('id');
        var data = [{'name':'id', 'value':id}];
        $.ajax({dataType: "html",type: "POST",evalScripts: true,
          url: "/admin/updateDataElement",
          data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data),active:0}),
          success: function(){
            alert('@langadmin('Bỏ duyệt thành công!')');
            window.location.reload();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          }
        });
      }
    });

    $('.content-wrapper').on('click','.delete-btn-element', function(){
      if(confirm('@langadmin('Bạn muốn xóa')?')){
        var element = $(this).parents('form').data('element');
        var id = $(this).data('id');
        var urlBack = $(this).data('url-back');
        var data = [{'name':'id', 'value':id}];
        $.ajax({dataType: "html",type: "POST",evalScripts: true,
          url: "/admin/updateDataElement",
          data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data),delete:true}),
          success: function(){
            alert('@langadmin('Xóa thành công!')');
            if(urlBack===undefined){
              window.location = window.location.href.split("?")[0];
            }else{
              window.location.href = urlBack;
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          }
        });
      }
    });

    $('.content-wrapper').on('click','.restore-btn-element', function(){
      if(confirm('@langadmin('Bạn muốn khôi phục')?')){
        var element = $(this).parents('form').data('element');
        var id = $(this).data('id');
        var data = [{'name':'id', 'value':id}];
        $.ajax({dataType: "html",type: "POST",evalScripts: true,
          url: "/admin/updateDataElement",
          data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data),restore:true}),
          success: function(){
            alert('@langadmin('Khôi phục thành công!')');
            window.location.reload();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          }
        });
      }
    });

    $('.content-wrapper').on('click','.save-btn-post', function(){
      if($('input[name="title"]').val()==null||$('input[name="title"]').val()==""||$('input[name="title"]').val()==undefined){
        alert('@langadmin('Vui lòng điền tiêu đề')'); return;
      }else if($('select[name="category"]').length && $('select[name="category"]').val()==null){
        alert('@langadmin('Vui lòng chọn danh mục')'); return;
      }else{
        $(this).text('@langadmin('Đang lưu')...');
        var data = $(this).parents('form').serializeArray();
        if (tinyMCE.activeEditor != null){
          if(data[search("spec", data)]){data[search("spec", data)].value = tinyMCE.get('spec').getContent()};
          if(data[search("desc_full", data)]){data[search("desc_full", data)].value = tinyMCE.get('desc_full').getContent()};
        }
        var element = $(this).parents('form').attr('data-element');
        var urlBack = $(this).data('url-back');
        var active = $(this).data('active');
        $.ajax({dataType: "html",type: "POST",evalScripts: true,
          url: "/admin/updateDataElement",
          data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data),active:active}),
          success: function(){
            alert('@langadmin('Lưu thành công!')');
            if(urlBack===undefined){
              window.location.reload();
            }else{
              window.location.href = urlBack;
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
          }
        });
      }
    });

    $('.content-wrapper').on('click','.seo-checker-btn', function(){
      var mainKeyword = $('input[name="main_keyword"]').val().toLowerCase();
      console.log('mainKeyword',mainKeyword); 
      if(mainKeyword==null||mainKeyword==""||mainKeyword==undefined){
        $('.diem-seo .kiem-tra').show();
        alert('@langadmin('Vui lòng điền từ khóa chính!')'); return;
      }
      var data = $(this).parents('form').serializeArray();

      var title = data[search("title", data)].value;
      console.log('title',title); 
      var desc = data[search("desc", data)].value;
      console.log('desc',desc); 
      var descFull = '';
      if(data[search("desc_full", data)]){descFull += tinyMCE.get('desc_full').getContent();}
      // if(data[search("field1", data)]){descFull += tinyMCE.get('field1').getContent();}
      // if(data[search("field2", data)]){descFull += tinyMCE.get('field2').getContent();}
      // if(data[search("field3", data)]){descFull += tinyMCE.get('field3').getContent();}
      // if(data[search("field4", data)]){descFull += tinyMCE.get('field4').getContent();}
      // if(data[search("field5", data)]){descFull += tinyMCE.get('field5').getContent();}
      // if(data[search("field6", data)]){descFull += tinyMCE.get('field6').getContent();}
      // if(data[search("field7", data)]){descFull += tinyMCE.get('field7').getContent();}
      // if(data[search("field8", data)]){descFull += tinyMCE.get('field8').getContent();}
      // if(data[search("field9", data)]){descFull += tinyMCE.get('field9').getContent();}
      console.log('descFull',descFull); 
      var keyword = data[search("keyword", data)].value;
      console.log('keyword',keyword); 

      $('.seo-check').removeClass('active');
      var seoPoint = 0;
      $('.seo-check-1').addClass('active');
      seoPoint += 1;
      if (title.toLowerCase().indexOf(mainKeyword) >= 0){
        $('.seo-check-2').addClass('active');
        seoPoint += 1;
      }
      if (desc.toLowerCase().indexOf(mainKeyword) >= 0){
        $('.seo-check-3').addClass('active');
        seoPoint += 1;
      }
      descFull2 = $('<div/>').html(descFull).text();
      if (descFull2.toLowerCase().indexOf(mainKeyword) >= 0){
        $('.seo-check-4').addClass('active');
        seoPoint += 1;
      }
      if (descFull.toLowerCase().trim().split(/\s+/gi).length >= 100){
        $('.seo-check-5').addClass('active');
        seoPoint += 1;
      }
      if (descFull.toLowerCase().indexOf('<h2') >= 0){
        $('.seo-check-6').addClass('active');
        seoPoint += 1;
      }
      if (descFull.toLowerCase().indexOf('<img') >= 0){
        $('.seo-check-7').addClass('active');
        seoPoint += 1;
      }
      if (descFull.toLowerCase().indexOf('href=') >= 0){
        $('.seo-check-8').addClass('active');
        seoPoint += 1;
      }
      if (keyword!=null && keyword!="" && keyword!=undefined && keyword.toLowerCase().indexOf(mainKeyword) >= 0){
        $('.seo-check-9').addClass('active');
        seoPoint += 1;
      }
      $('.diem-seo .kiem-tra').text(seoPoint+'/9');
      $('#seo_point').val(seoPoint);
      $('.diem-seo .label').hide();
      if(seoPoint > 8){
        $('.diem-seo .label-info').show();
      }
      else if(seoPoint > 5){
        $('.diem-seo .label-warning').show();
      }
      else if(seoPoint > 3){
        $('.diem-seo .label-success').show();
      }
      else if(seoPoint > 0){
        $('.diem-seo .label-danger').show();
      }
    });

    $('.link-preview-btn').click(function(){
      $(this).parents('.input-group').find('input').each(function(){
        var win = window.open($(this).val(), '_blank');
        win.focus();
      });
    });

    $('.moneyinput').bind("change keyup input", function(event) {
      if(event.which >= 37 && event.which <= 40) return;
      $(this).val(function(index, value) {
        return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      });
    });

    // $('input[name="title"]').bind("change keyup input", function(event) {
    //   $('input[name="keyword"]').val($(this).val());
    // });

    function search(nameKey, myArray){
      for(var i=0; i < myArray.length; i++) { if(myArray[i].name === nameKey) {return i;}} 
    }

});
</script>
</body>
</html>