<a href="{!!$p['link'] or '' !!}" title="{!!$p['title'] or '' !!}" class="i917 post-item grid-item each-post">
  <div class="i918 post-item-wrap">
    <div class="i919 post-image">
        <img class="i920 "  alt="{!!$p['title'] or '' !!}" src="{!!$p['img_thumb'] or '' !!}" onerror="this.src='/public/thumbs/noimage.jpg'">
    </div>
    <div class="i921 post-item-description">
      {{-- <span class="i922 post-meta-date"><b class="i923 " >{!!$p['categoryInfo']['title'] or '' !!}</b> | @date($p['created_at'])</span> --}}
      <h4 class="i924 matchHeight2">{!!$p['title'] or '' !!}</h4>
      <p class="i925 " >{!!Helper::readMore($p['desc'])!!}</p>
      <span class="i926 item-link">@lang('Xem chi tiết') <i class="i927 fa fa-arrow-right"></i></span>
    </div>
  </div>
</a>