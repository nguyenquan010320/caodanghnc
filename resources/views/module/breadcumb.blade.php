<?php
$cover = $site['anh-cover-dau-trang'];
$coverxs = $site['anh-cover-dau-trang'];
$covertitle = $s['title'];

if(isset($s['categoryParent']) && !in_array(1, $s['categoryParent'])){
  foreach ($s['categoryParent'] as $cp){
    if(isset($category[$cp])){
      $covertitle = $category[$cp]['title'];
      if(!empty($category[$cp]['img_cover']) && $category[$cp]['img_cover']!='/public/upload/noimage.jpg'){
        $cover = $coverxs = $category[$cp]['img_cover'];
      }
      if(!empty($category[$cp]['img_cover_xs']) && $category[$cp]['img_cover_xs']!='/public/upload/noimage.jpg'){
        $coverxs = $category[$cp]['img_cover_xs'];
      }
    }
  }
}
if(!empty($s['img_cover']) && $s['img_cover']!='/public/upload/noimage.jpg'){
  $cover = $coverxs = $s['img_cover'];
}
if(!empty($s['img_cover_xs']) && $s['img_cover_xs']!='/public/upload/noimage.jpg'){
  $coverxs = $s['img_cover_xs'];
}
?> 
{{-- @if(substr($cover, -3,3) == 'mp4')
<section id=section1 class="i835 d73 fullscreen" data-vide-bg="{!!$cover or ''!!}" style="">
</section>
@else
<p class="i836 m-b-0">
  <img class="i837 hidden-xs" src="{!!$cover or ''!!}" style="width:100%">
  <img class="i838 visible-xs" src="{!!$coverxs or ''!!}" style="width:100%">
</p>
@endif --}}
{{-- <style class="i839 "  type="text/css">
  @media only screen and (max-width:991px) {
    .pageHeader{background-image:url('{!!$coverxs or '' !!}')!important;background-position: center;background-size: cover;}
  } 
</style>
<section class="i840 pageHeader">
  <div class="i841 box-position" style="background-image:url('{!!$cover or '' !!}');background-position: center;background-size: cover;"></div>
  <div class=container>
    <div class="i842 heading text-center">
      <h1 class="i843 " >{!!$covertitle or ''!!}</h1>
      <p class="i844 text-center">
        @if(!empty($breadcumb) && is_array($breadcumb))
        @foreach($breadcumb as $k=>$b)
        <a class="i845 "  href="{!!$k!!}">{!!$b!!}</a>{!!($loop->last)?'':' <i class="i846 fa fa-angle-right"></i> '!!}
        @endforeach
        @endif
      </p>
    </div>
  </div>
</section> --}}
{{-- <section class="i847 breadcumb background-grey">
  <div class="i848 container">
    <p class="i849 " >
      @if(!empty($breadcumb) && is_array($breadcumb))
      @foreach($breadcumb as $k=>$b)
      <a class="i850 "  href="{!!$k!!}">{!!$b!!}</a>{!!($loop->last)?'':' <i class="i851 fa fa-angle-right"></i> '!!}
      @endforeach
      @endif
    </p>
  </div>
</section>
<hr class="i852 m-0"> --}}
{{-- For Google Search --}}
<script class="i853 "  type="application/ld+json">{"@context": "http://schema.org","@type": "BreadcrumbList","itemListElement": [@foreach($breadcumb as $k=>$b){"@type": "ListItem","position": {!!$loop->index+1!!},"item": {"@id": "{!!$k!!}","name": "{!!Helper::cleanText($b)!!}"}}{!!($loop->last)?'':','!!}@endforeach]}</script>