@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
<section class="i572 " >
  <div class="i573 container">
    @foreach($postList as $p)
    <div class="i574 heading heading-center">
      <h2 class="i575 " >{!!$p['title'] or '' !!}</h2>
      <p class="i576 lead">{!!$p['desc'] or '' !!}</p>
    </div>
    <div class="i577 grid-layout grid-4-columns m-b-20" data-margin=2 data-item="grid-item" data-lightbox="gallery">
      @php($i=0) @if(!empty($p['img_other'])) @foreach($p['img_other'] as $img) @if($i++<8)
      <div class="i578 grid-item">
        @if(substr($img[0], 0,4) == 'http' || substr($img[0], 0,5) == 'https')
        <a class="i579 "  href="{!!str_replace('youtu.be/', 'www.youtube.com/watch?v=', $img[0])!!}" data-lightbox="iframe"><div class="i580 gallery-video" style="background-image:url('{!!Helper::youtubeThumb($img[0])!!}');background-size: cover;background-position: center;"><img class="i581 "  src="/public/frontend/image/play.png"></div></a>
        @else
        <a class="i582 image-hover-zoom" href="{!!$img[0]!!}" data-lightbox="gallery-item"><img class="i583 "  src="{!!str_replace('/upload/', '/thumbs/', $img[0])!!}"></a>
        @endif
      </div>
      @endif @endforeach @endif
    </div>
    <p class="i584 text-center m-b-30"><a href="{!!$p['link'] or ''!!}" target="_blank" class="i585 btn btn-my">Xem thêm</a></p>
    @endforeach
    @include('module.paging')
  </div>
</section>
@endsection