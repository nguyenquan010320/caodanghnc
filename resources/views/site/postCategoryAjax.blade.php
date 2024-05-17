@foreach($postList as $p)
<div class="col-md-3">
  @include('module.eachPost6')   
</div>
@endforeach
@if($page!=$numPage)
<div class="col-md-12">
  <p class="text-center">
    <a href="javascript:void(0);" class="btn btn-my btn-my-2 btn-loadmore{{$page+1}}" data-href="{!!$currentFilter.'&page='.($page+1)!!}" data-filter="page" data-value="{{$page+1}}">@lang('See more')</a>
  </p>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.btn-loadmore{{$page+1}}').on('click', function(event) {
        event.preventDefault();
        var href = $(this).data('href');
        $.ajax({
          dataType: "html",
          type: "POST",
          evalScripts: true,
          url: href,
          data: ({"_token": "{{ csrf_token() }}"}),
          success: function(html){
            $('.div-loadmore').append(html);
          }
        });
        $(this).parents('.col-md-12').remove();
      });
    });
  </script>
</div>
@endif