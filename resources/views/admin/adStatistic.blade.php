@extends('layouts.backend')
@section('content')
<?php
error_reporting(0);
$json = file_get_contents('ds-data.txt');
$json = explode("||", $json);
?>
<section class="content-header">
  <h1>Thống kê truy cập
    <a class="btn btn-info" style="float: right;" href="/">Xem trang web <i class="fa fa-arrow-right"></i></a>
  </h1>
</section>
<section class="content" id="example_wrapper">
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
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        "order": [[ 0, "desc" ]],
        "pageLength":1000
      } );
      table.buttons().container()
      .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    });
  </script>
  <div class="table-responsive" style="min-height: calc(100vh - 80px)">
    <?php
    if(empty($json[0])){
      echo '<p>Chưa có ai đăng kí</p>';
    }else{

      $action = Request::get('action');

      $i=1;
      $keys = ['Name','Phone','Email'];
      
      $name = ['name','họ tên','họ và tên','tên của bạn'];
      $phone = ['phone','số điện thoại','điện thoại'];
      $email = ['email','email của bạn'];

      foreach ($json as $j) {
        $j = (array)json_decode($j);
        if(!empty($j['json_data']) && (empty($action) || $j['action'] == $action)){
          $jArray = json_decode($j['json_data']);
          foreach ($jArray as $jA) {
            $jAname = mb_strtolower($jA->name);
            if(!in_array($jAname, $name) && !in_array($jAname, $phone) && !in_array($jAname, $email)){
              $keys[$jA->name] = $jA->name;
            }
          }
        }
      }
      unset($keys['mail-to']);
      unset($keys['subject']);
      unset($keys['utm']);
      unset($keys['device']);
        // $keys = array_unique($keys);

      echo '<table id="example" class="table table-striped table-bordered">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>STT</th>';
      echo '<th>Địa chỉ IP</th>';
      echo '<th>Thời gian</th>';
      echo '<th>Thiết bị</th>';
      echo '<th>Nguồn UTM</th>';
      echo '<th>Trang đang xem</th>';
      echo '<th>Hành động</th>';
      foreach ($keys as $k) {
        echo '<th>'.$k.'</th>';
      }
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      foreach ($json as $j) {
        $values = [];
        $j = (array)json_decode($j);
        if(!empty($j['json_data']) && (empty($action) || $j['action'] == $action)){
          $jArray = json_decode($j['json_data']);
          foreach ($jArray as $jA) {
            $jAname = mb_strtolower($jA->name);
            if(in_array($jAname, $name)){
              $values['Name'] = $jA->value;
            }elseif(in_array($jAname, $phone)){
              $values['Phone'] = $jA->value;
            }elseif(in_array($jAname, $email)){
              $values['Email'] = $jA->value;
            }else{
              if(strrpos($jA->value, 'http') !== false){
                $jA->value = '<a href="'.$jA->value.'" target="_blank" style="font-size: 10px;word-break: break-all;max-width: 200px;overflow: hidden;display: block;">'.$jA->value.'</a>';
              }
              if(isset($values[$jA->name])){
                $values[$jA->name] .= ', '.$jA->value;
              }else{
                $values[$jA->name] = $jA->value;
              }
            }
          }
        }
        if(!empty($j) && !in_array($j['ip'], ['127.0.0.1','171.240.21.51','14.231.156.48','1.52.49.22','113.23.75.92']) && $j['action']!='Truy cập trang web' && (empty($action) || $j['action'] == $action)){
          echo '<tr>';
          echo '<td>'.$i++.'</td>';
          echo '<td>'.$j['ip'].'</td>';
          echo '<td>'.$j['time'].'</td>';
          echo '<td>'.$j['device'].'</td>';
          echo '<td>'.$j['utm'].'</td>';
          echo '<td><a href="'.$j['currenturl'].'" style="font-size: 10px;word-break: break-all;max-width: 200px;overflow: hidden;display: block;">'.$j['currenturl'].'</a></td>';
          echo '<td>'.$j['action'].'</td>';
          foreach ($keys as $k) {
            if(isset($values[$k])){
              echo '<td style="white-space: pre-wrap;">'.$values[$k].'</td>';
            }else{
              echo '<td></td>';
            }
          }
          echo '</tr>';
        }
      }

      echo '</tbody>';
      echo '</table>';
    }
    ?>
  </div>
</section>
@endsection
