@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
<section class="i560 " >
  <div class="i561 container">
    <div class="i562 heading heading-center">
      <h1 class="i563 uppercase">{!!$s['title'] or '' !!}</h1>
      <p class="i564 lead">{!!$s['desc'] or '' !!}</p>
    </div>
    <div class="i565 grid-layout grid-4-columns" data-margin=5 data-item="grid-item" data-lightbox="gallery">
      @if(!empty($s['img_other'])) @foreach($s['img_other'] as $img)
      <div class="i566 grid-item">
        @if(substr($img[0], 0,4) == 'http' || substr($img[0], 0,5) == 'https')
        <a class="i567 "  href="{!!str_replace(['youtu.be/','www.youtube.com/shorts/'], 'www.youtube.com/watch?v=', $img[0])!!}" data-lightbox="iframe"><div class="i568 gallery-video" style="background-image:url('{!!Helper::youtubeThumb($img[0])!!}');background-size: cover;background-position: center;"><img class="i569 "  src="/public/frontend/image/play.png"></div></a>
        @else
        <a class="i570 image-hover-zoom" href="{!!$img[0] or ''!!}" title="{!!$img[1] or ''!!}" data-lightbox="gallery-item"><img class="i571 "  src="{!!str_replace('/upload/', '/thumbs/', $img[0])!!}"></a>
        @endif
      </div>
      @endforeach @endif
    </div>
  </div>
</section>
@endsection