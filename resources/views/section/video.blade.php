<section class="p-b-20 background-grey">
  <div class="container">
    <div class="heading heading-center">
      <a href="{!!$post[5]['link'] or ''!!}"><h2>{!!$post[5]['title'] or ''!!}</h2></a>
    </div>
    {{-- <div class="grid-layout grid-4-columns" data-margin=5 data-item="grid-item" data-lightbox="gallery"> --}}
    <div class="carousel testimonial testimonial-box" data-dots=false data-items="4" data-margin=20 data-autoplay="true" data-loops="true" data-autoplay-timeout="3500">
      @if(!empty($post[5]['img_other'])) @foreach($post[5]['img_other'] as $img)
      <div class="grid-item">
        {{-- Link youtube --}}
        @if(substr($img[0], 0,4) == 'http')
        <a href="{!!$img[0]!!}" data-lightbox="iframe"><div class="gallery-video" style="background-image:url('{!!Helper::youtubeThumb($img[0])!!}');background-size: cover;background-position: center;"><img src="/public/frontend/image/play.png"></div></a>
        @else
        <a class="image-hover-zoom" href="{!!$img[0]!!}" data-lightbox="gallery-item"><img src="{!!str_replace('/upload/', '/thumbs/', $img[0])!!}"></a>
        @endif
      </div>
      @endforeach @endif
    </div>
  </div>
</section>