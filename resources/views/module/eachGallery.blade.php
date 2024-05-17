@if(!empty($p['video']))
<a href="{!!$p['video'] or '' !!}" title="{!!$p['title'] or '' !!}" class="post-item grid-item each-post each-gallery" data-lightbox="iframe">
  <div class="post-item-wrap">
    <div class="post-image">
      {{-- <img alt="{!!$p['title'] or '' !!}" src="{!!$p['img_thumb'] or '' !!}" onerror="this.src='/public/thumbs/noimage.jpg'"> --}}
      <div class="gallery-video" style="background-image:url('{!!Helper::youtubeThumb($p['video'])!!}');background-size: cover;background-position: center;"><img src="/public/frontend/image/play.png" style="width: auto;"></div>
    </div>
    <div class="post-item-description">
      {{-- <span class="post-meta-date"><b>{!!$p['categoryInfo']['title'] or '' !!}</b> | @date($p['created_at'])</span> --}}
      <h4 class="matchHeight2">{!!$p['title'] or '' !!}</h4>
      <p>{!!Helper::readMore($p['desc'])!!}</p>
      {{-- <span class="item-link">@lang('Xem chi tiết') <i class="fa fa-arrow-right"></i></span> --}}
    </div>
  </div>
</a>
@elseif(!empty($p['img_other']))
<div href="{!!$p['link'] or '' !!}" title="{!!$p['title'] or '' !!}" class="post-item grid-item each-post" data-lightbox=gallery>
  <div class="post-item-wrap">
    <div class="post-image">
      <a href="{!!$p['img'] or '' !!}" data-lightbox="gallery-item"><img alt="{!!$p['title'] or '' !!}" src="{!!$p['img_thumb'] or '' !!}" data-lightbox="gallery-item" onerror="this.src='/public/thumbs/noimage.jpg'"></a>
      @if(!empty($p['img_other'])) @foreach($p['img_other'] as $img)
      <a class="image-hover-zoom" href="{!!$img[0]!!}" title="{!!$img[1]!!}" data-lightbox="gallery-item" style="display: none;"><img src="{!!str_replace('/upload/', '/thumbs/', $img[0])!!}"></a>
      @endforeach @endif
    </div>
    <div class="post-item-description">
      {{-- <span class="post-meta-date"><b>{!!$p['categoryInfo']['title'] or '' !!}</b> | @date($p['created_at'])</span> --}}
      <h4 class="matchHeight2">{!!$p['title'] or '' !!}</h4>
      <p>{!!Helper::readMore($p['desc'])!!}</p>
      {{-- <span class="item-link">@lang('Xem chi tiết') <i class="fa fa-arrow-right"></i></span> --}}
    </div>
  </div>
</div>
@else
<a href="{!!$p['link'] or '' !!}" title="{!!$p['title'] or '' !!}" class="post-item grid-item each-post">
  <div class="post-item-wrap">
    <div class="post-image">
      <img alt="{!!$p['title'] or '' !!}" src="{!!$p['img_thumb'] or '' !!}" onerror="this.src='/public/thumbs/noimage.jpg'">
    </div>
    <div class="post-item-description">
      {{-- <span class="post-meta-date"><b>{!!$p['categoryInfo']['title'] or '' !!}</b> | @date($p['created_at'])</span> --}}
      <h4 class="matchHeight2">{!!$p['title'] or '' !!}</h4>
      <p>{!!Helper::readMore($p['desc'])!!}</p>
      <span class="item-link">@lang('Xem chi tiết') <i class="fa fa-arrow-right"></i></span>
    </div>
  </div>
</a>
@endif