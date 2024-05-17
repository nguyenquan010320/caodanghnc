@extends('layouts.backend')
@section('content')
<section class="content-header">
  <h1>@lang('Tổng quan website')
    <a class="btn btn-info" style="float: right;" href="/">@lang('Xem trang web') <i class="fa fa-arrow-right"></i></a>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-cubes"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">@lang('Số sản phẩm và bài viết')</span>
          <span class="info-box-number">{!!number_format(count($post))!!}</span>
          <div class="progress">
            <div class="progress-bar" style="width: 20%"></div>
          </div>
          <span class="progress-description">
            @lang('Hãy đăng bài tích cực hơn!')
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-comments"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">@lang('Số lượt xem trang')</span>
          <span class="info-box-number">{{ Counter::allHits() }}</span>
          <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
          </div>
          <span class="progress-description">
            +{{ Counter::allHits(30) }} @lang('lượt trong 30 ngày qua')
          </span>
        </div>
      </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-book"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">@lang('Số người vào web')</span>
          <span class="info-box-number">{{ Counter::allVisitors() }}</span>
          <div class="progress">
            <div class="progress-bar" style="width: 10%"></div>
          </div>
          <span class="progress-description">
            +{!!Counter::allVisitors(30)!!} @lang('lượt trong 30 ngày qua')
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">@lang('Số đơn hàng')</span>
          <span class="info-box-number">{!!number_format(count($order))!!}</span>
          <div class="progress">
            <div class="progress-bar" style="width: 50%"></div>
          </div>
          <span class="progress-description">
            @lang('Trung bình') @if(!empty(count($order))) {!!round(Counter::allVisitors()/(count($order)))!!} @endif @lang('khách vào trang có 1 đơn hàng')
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('Theo dõi lượng khách vào website')</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <p class="text-center">
            <strong>@lang('Thời gian:') {!!date('d/m/Y', strtotime("-30 days"));!!} - {!! date('d/m/Y', time()) !!}</strong>
          </p>
          <div class="chart">
            <canvas id="salesChart" style="height: 180px; width: 695px;" height="180" width="695"></canvas>
          </div>
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-6 col-xs-6">
              <div class="description-block border-right">
                <h5 class="description-header">{!!Counter::allHits(30)!!} @lang('lượt xem trang')</h5>
                <span class="description-text">@lang('TRONG 30 NGÀY QUA')</span>
              </div>
            </div>
{{--             <div class="col-sm-3 col-xs-6">
              <div class="description-block">
                <h5 class="description-header">{!!Counter::allVisitors(30)!!} @lang('lượt khách vào website')</h5>
                <span class="description-text">@lang('TRONG 30 NGÀY')</span>
              </div>
            </div> --}}
            <div class="col-sm-6 col-xs-6">
              <div class="description-block border-right">
                <h5 class="description-header">{!!Counter::allHits(90)!!} @lang('lượt xem trang')</h5>
                <span class="description-text">@lang('TRONG 3 THÁNG QUA')</span>
              </div>
            </div>
            {{-- <div class="col-sm-3 col-xs-6">
              <div class="description-block border-right">
                <h5 class="description-header">{!!Counter::allVisitors(90)!!} @lang('lượt khách vào website')</h5>
                <span class="description-text">@lang('TRONG 3 THÁNG QUA')</span>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('Top bài viết có nhiều lượt xem nhất')</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>@lang('ID')</th>
                  <th>@lang('Tiêu đề')</th>
                  <th>@lang('Số lượt xem')</th>
                  <th>@lang('Điểm SEO')</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $newPost = [];
                foreach ($post as $p) {
                  $newPost[] = [
                    'id' => $p['id'],
                    'link' => $p['link'],
                    'title' => $p['title'],
                    'seo_point' => $p['seo_point'],
                    'viewcount' => Counter::show('post',$p['id'])
                  ];
                }
                usort($newPost, function ($item1, $item2) {
                  return $item2['viewcount'] <=> $item1['viewcount'];
                });
                ?>
                @php($i=0)
                @foreach($newPost as $p) @if($p['viewcount'] > 0 && $i++< 10)
                <tr>
                  <td>{!!$p['id'] or ''!!}</td>
                  <td><a href="{!!$p['link'] or ''!!}" target="_blank">{!!$p['title'] or ''!!}</a></td>
                  <td>{!!$p['viewcount'] or ''!!}</td>
                  <td class="hidden-xs">
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
                </tr>
                @endif @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer clearfix">
          <a href="/admin/p3-edit0" class="btn btn-sm btn-info btn-flat pull-left"><i class="fa fa-plus"></i> @lang('Viết bài mới')</a>
          <a href="/admin/p3" class="btn btn-sm btn-default btn-flat pull-right">@lang('Xem tất cả bài viết')</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      {{-- @if(!empty($orderWaiting))
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> @lang('Có') {!!$orderWaiting!!} @lang('đơn hàng đang chờ bạn xử lý!')</h4>
        @lang('Đừng để khách hàng của bạn phải chờ đợi.')
        <a href="/admin/adOrder">@lang('Click vào đây để xem danh sách đơn hàng.')</a>
      </div>
      @endif
      @php($seoPoint = 0)
      @foreach($post as $p) @if($p['seo_point']>0 && $p['seo_point']<3)
      @php($seoPoint ++)
      @endif @endforeach
      @if($seoPoint > 0)
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> @lang('Có') {!!$seoPoint!!} @lang('bài viết/sản phẩm/trang có điểm SEO dưới trung bình!')</h4>
        @lang('Điểm SEO thấp sẽ làm Google đánh giá thấp website của bạn, vui lòng kiểm tra lại các bài viết, sản phẩm, trang có điểm Kém.')
      </div>
      @endif --}}
      @if(empty(env('CUSTOM_AGENCY')))
      <?php try{ ?>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('Chia sẻ kinh nghiệm website')</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <?php
          $location = 'https://ihappy.vn/feed';
          $html = file_get_contents($location);
          $ihappyPost = json_decode($html,true); 
          ?>
          <ul class="products-list product-list-in-box">
            @foreach($ihappyPost as $p)
            <li class="item">
              <div class="product-img">
                <img src="{!!$p['img_thumb'] or ''!!}" alt="{!!$p['title'] or ''!!}">
              </div>
              <div class="product-info">
                <a href="{!!$p['link'] or ''!!}" class="product-title">{!!$p['title'] or ''!!}
                  <span class="label label-warning pull-right">New</span>
                </a>
                <span class="product-description">
                  {!!$p['category'] or ''!!}
                </span>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="box-footer text-center">
          <a href="https://ihappy.vn/bai-viet-c3" target="_blank" class="uppercase">@lang('Xem tất cả bài viết của iHappy')</a>
        </div>
      </div>
    <?php }  catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }?>
    @endif
  </div>
</div>
</section>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/chart.js/Chart.js"></script>
<script type="text/javascript">
  $(function () {

    'use strict';

    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    var salesChart       = new Chart(salesChartCanvas);

    var salesChartData = {
      labels  : [
      <?php
      $period = new DatePeriod(
        new DateTime("-29 days"),
        new DateInterval('P1D'),
        new DateTime()
      );
      foreach ($period as $key => $value) {
        echo "'".$value->format('d/m')."',";
      }
      echo "'".date('d/m')."',";
      ?>
      ],
      datasets: [

      {
        label               : '@lang('Lượt xem trang')',
        fillColor           : 'rgba(60,141,188,0.4)',
        strokeColor         : 'rgba(60,141,188,0.6)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [
        <?php
        for ($i = 31; $i >1; $i--){
          echo (intval(str_replace(",","",Counter::allHits($i)))-intval(str_replace(",","",Counter::allHits($i-1)))).',';
          //echo rand(10,100).',';
        }
        ?>
        ]
      }
      // {
      //   label               : '@lang('Lượt khách vào web')',
      //   fillColor           : 'rgba(59,89,152,0.8)',
      //   strokeColor         : 'rgba(59,89,152,1)',
      //   pointColor          : 'rgba(59,89,152,1)',
      //   pointStrokeColor    : '#c1c7d1',
      //   pointHighlightFill  : '#fff',
      //   pointHighlightStroke: 'rgb(220,220,220)',
      //   data                : [
      //   <?php
      //   for ($i = 31; $i >1; $i--){
      //     echo (Counter::allVisitors($i)-Counter::allVisitors($i-1)).',';
      //     //echo rand(0,10).',';
      //   }
      //   ?>
      //   ]
      // },
      ]
    };

    var salesChartOptions = {
    // Boolean - If we should show the scale at all
    showScale               : true,
    // Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    // String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    // Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    // Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    // Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    // Boolean - Whether the line is curved between points
    bezierCurve             : true,
    // Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    // Boolean - Whether to show a dot for each point
    pointDot                : true,
    // Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    // Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 1,
    // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    // Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    // Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    // Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
    // String - A legend template
    legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  };
  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
});
</script>
@endsection
