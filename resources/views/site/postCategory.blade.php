@extends('layouts.frontend')
@section('content')
@include('module.khoatruycap')
@include('module.breadcumb')
{{-- <section id="" class="i397 " style="padding: 10px 0 10px 0;font-size: 13px;background-color: #ececec;border-bottom: 1px solid #e1e1e1;">
  <div class="i398 container">
          <p class="i399 text-center m-0 menu-phu text-light">
            @php($list = [])
            @if($s['hasChild'])
            @foreach($category as $c) @if($c['parent']==$s['id'])
            @php($list[] = [$c['id'],$c['link'],$c['title']])
            @endif @endforeach
            @else
            @foreach($category as $c) @if($c['parent']==$s['parent'] && !empty($s['parent']))
            @php($list[] = [$c['id'],$c['link'],$c['title']])
            @endif @endforeach
            @endif

            @if(sizeof($list) > 1)
            @foreach($list as $l)
            <a class="i400 "  href="{!!$l[1] or ''!!}" @if($l[0]==$s['id']) style="font-weight: bold;color: #FAA619!important" @endif>{!!$l[2] or ''!!}</a>{!!($loop->last)?'':'&nbsp;&nbsp;/&nbsp;&nbsp;'!!}
            @endforeach
            @endif
          </p>
  </div>
</section> --}}
{{-- <section id="page-content" class="i401 sidebar-right">
  <div class="i402 container">
    <div class="i403 heading">
      <h1 class="i404 text-center">{!!$s['title'] or ''!!}</h1>
    </div>
    @if(empty($postList))
    <blockquote class="i405 blockquote-color text-light"><p class="i406 " >@lang('Hiện chưa có bài viết nào!')</p></blockquote>
    @endif
    <div class="i407 row">
      @foreach($postList as $p)
      <div class="i408 col-md-3">
        @include('module.eachPost')
      </div>
      @endforeach
    </div>
    @include('module.paging')
  </div>
</section> --}}
<section class="i409 productCategory p-b-10 p-t-10">
  <div class="i410 container">
    <div class="i411 heading m-b-0">
      <h1 class="i412 m-b-0 text-left">{!!$title!!}</h1>
      {{-- <p class="i413 text-left m-b-0">{!!$desc!!}</p> --}}
    </div>
  </div>
</section>
<hr class="i414 p-0 m-0">
<section id="page-content" class="i415 sidebar-right">
  <div class="i416 container">
    <div class="i417 row">
      <div class="i418 content col-md-9">
        <div id="blog" class="i419 post-thumbnails">
        	@if(empty($postList))
        	<blockquote class="i420 blockquote-color text-light"><p class="i421 " >@lang('Đang cập nhật...')</p></blockquote>
        	@endif
          @foreach($postList as $p)
          <div class="i422 post-item">
            <div class="i423 post-item-wrap">
              <div class="i424 post-image">
                <a class="i425 "  href="{!!$p['link'] or '' !!}">
                  <img class="i426 img-responsive img-rounded img-thumbnail" alt="{!!$p['title'] or '' !!}" src="{!!$p['img_thumb'] or '' !!}">
                </a>
                {{-- <span class="i427 post-meta-category"><a class="i428 "  href="{!!$p['categoryInfo']['link'] or '' !!}">{!!$p['categoryInfo']['title'] or '' !!}</a></span> --}}
              </div>
              <div class="i429 post-item-description">
                {{-- <span class="i430 post-meta-date"><i class="i431 fa fa-calendar-o"></i>@date($p['created_at'])</span> --}}
                <h2 class="i432 m-b-10"><a class="i433 "  href="{!!$p['link'] or '' !!}">{!!$p['title'] or '' !!}
                </a></h2>
                <p class="i434 m-b-5" style="text-align: justify;">{!!strip_tags($p['desc'])!!}</p>
                <a href="{!!$p['link'] or '' !!}" class="i435 item-link">@lang('Xem chi tiết') <i class="i436 fa fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @include('module.paging')
      </div>
      @include('module.postSidebar')
    </div>
  </div>
</section>
@endsection