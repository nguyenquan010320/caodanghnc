<div class="m-t-30 pinBox">
  @for ($i = 1; $i < 9; $i++)
    @if(!empty($site['fBanner'.$i]))
      <a class="pinned m-t-20" href="@site('fBanner".$i."Link')"><img class="m-b-20" src="{!!$site['fBanner'.$i]!!}" style="width: 100%;height: auto"/></a>
    @endif
  @endfor
</div>
<script type="text/javascript">
  if ($(window).width() > 767) {
    var divWidth = $('.pinBox').width();
    $('.pinBox').css('height',$('.pinBox').height());
    var pinOffset = $('.pinBox').offset().top-200;
    console.log(divWidth,pinOffset); 
    $(window).scroll(function(event) {
      var screenTop = $(document).scrollTop();
      console.log(screenTop); 
      if(screenTop>=pinOffset){
        $('.pinned').css('position','fixed').css('top','50px').css('width',divWidth);
      }else{
        $('.pinned').css('position','relative').css('top','0');
      }
    });
  }
</script>