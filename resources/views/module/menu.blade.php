@if(!isset($s))
@php($s = [])
@endif
@php($menu = Helper::genMenu(10,$category,$post,$s))
<ul class="i109 " >
  @foreach($menu as $m)
  <li class="{!!$m['dropdown'] or ''!!} {!!$m['active'] or ''!!}">
    <a href="{!!$m['link'] or ''!!}" {!!$m['newtab'] or ''!!} class="i110 {!!$m['scrollto'] or ''!!}">{!!$m['name'] or ''!!}@if(!empty($m['dropdown']))<i class="fa fa-angle-down hidden-xs hidden-sm"></i>@endif</a>
    @if(!empty($m['child']))
    <ul class=dropdown-menu>
      @foreach($m['child'] as $m2)
      <li class="{!!$m2['dropdown'] or ''!!} {!!$m2['active'] or ''!!}">
        <a href="{!!$m2['link'] or ''!!}" {!!$m2['newtab'] or ''!!} class="i111 {!!$m2['scrollto'] or ''!!}">{!!$m2['name'] or ''!!}</a>
        @if(!empty($m2['child']))
        <ul class=dropdown-menu>
          @foreach($m2['child'] as $m3)
          <li class="{!!$m3['dropdown'] or ''!!} {!!$m3['active'] or ''!!}">
            <a href="{!!$m3['link'] or ''!!}" {!!$m3['newtab'] or ''!!} class="i112 {!!$m3['scrollto'] or ''!!}">{!!$m3['name'] or ''!!}</a>
          </li>
          @endforeach
        </ul>
        @endif
      </li>
      @endforeach
    </ul>
    @endif
  </li>
  @endforeach
</ul>

{{-- <ul class="i113 " >
  <li class="i114 " ><a class="i115 "  href="/">@lang('Trang chủ')</a></li>
  <li class="i116 " ><a class="i117 "  href={!!$post[4]['link'] or ''!!}>{!!$post[4]['title'] or '' !!}</a></li>
  @if($category[2]['hasChild']) 
  <li class="i118 dropdown"> <a class="i119 "  href={!!$category[2]['link'] or ''!!}>{!!$category[2]['title'] or '' !!}</a>
    <ul class=dropdown-menu>
      @foreach($category as $c) @if($c['parent']==2)
      @if(!$c['hasChild'])
      <li class="i120 " ><a class="i121 "  href={!!$c['link'] or ''!!}>{!!$c['title'] or ''!!}</a></li>
      @else
      <li class="i122 dropdown-submenu"><a class="i123 "  href={!!$c['link'] or ''!!}>{!!$c['title'] or ''!!}</a>
        <ul class=dropdown-menu>
          @foreach($category as $c2) @if($c2['parent']==$c['id'])
          @if(!$c2['hasChild'])
          <li class="i124 " ><a class="i125 "  href={!!$c2['link'] or ''!!}>{!!$c2['title'] or ''!!}</a></li>
          @else
          <li class="i126 dropdown-submenu"><a class="i127 "  href={!!$c2['link'] or ''!!}>{!!$c2['title'] or ''!!}</a>
            <ul class=dropdown-menu>
              @foreach($category as $c3) @if($c3['parent']==$c2['id'])
              <li class="i128 " ><a class="i129 "  href={!!$c3['link'] or ''!!}>{!!$c3['title'] or ''!!}</a></li>
              @endif @endforeach 
            </ul>
          </li>
          @endif 
          @endif @endforeach 
        </ul>
      </li>
      @endif 
      @endif @endforeach 
    </ul>
  </li>
  @else
  <li class=dropdown> <a class="i130 "  href={!!$category[2]['link'] or ''!!}>{!!$category[2]['title'] or '' !!}</a>
    <ul class=dropdown-menu>
      @foreach($post as $p) @if(in_array(2, $p['categoryParent']))
      <li class="i131 " ><a class="i132 "  href={!!$p['link'] or ''!!}>{!!$p['title'] or ''!!}</a></li>
      @endif @endforeach 
    </ul>
  </li>
  @endif
  @foreach($category as $c) @if($c['show_index']=='1')
  <li @if($c['hasChild']) class=dropdown @endif> <a class="i133 "  href={!!$c['link'] or ''!!}>{!!$c['title'] or ''!!}</a>
    @if($c['hasChild']) 
    <ul class=dropdown-menu>
      @foreach($category as $c2) @if($c['id']==$c2['parent'])
      <li class="i134 " ><a class="i135 "  href={!!$c2['link'] or ''!!}>{!!$c2['title'] or ''!!}</a></li>
      @endif @endforeach 
    </ul>
    @endif
  </li>
  @endif @endforeach
  <li class="i136 " ><a class="i137 "  href={!!$category[6]['link'] or ''!!}>{!!$category[6]['title'] or '' !!}</a></li>
  <li class="i138 " ><a class="i139 "  href={!!$category[7]['link'] or ''!!}>{!!$category[7]['title'] or '' !!}</a></li>
  <li class="i140 " ><a class="i141 "  href={!!$post[6]['link'] or ''!!}>{!!$post[6]['title'] or '' !!}</a></li>
  <li class="i142 " ><a class="i143 "  href={!!$post[1]['link'] or ''!!}>{!!$post[1]['title'] or '' !!}</a></li>
</ul> --}}
{{-- <li class="dropdown mega-menu-item"> <a href="#">Portfolio</a>
  <ul class="dropdown-menu">
    <li class="mega-menu-content">
      <div class="row">
        <div class="col-md-2-5">
          <ul>
            <li class="mega-menu-title">Grids</li>
            <li> <a href="portfolio-2.html">Two Columns</a> </li>
            <li> <a href="portfolio-3.html">Three Columns</a> </li>
            <li> <a href="portfolio-4.html">Four Columns</a> </li>
            <li> <a href="portfolio-5.html">Five Columns</a> </li>
            <li> <a href="portfolio-6.html">Six Columns</a> </li>
            <li> <a href="portfolio-sidebar.html">Sidebar version</a> </li>
            <li> <a href="portfolio-wide-3.html">Wide version</a> </li>
          </ul>
        </div>
        <div class="col-md-2-5">
          <ul>
            <li class="mega-menu-title">Masonry</li>
            <li> <a href="portfolio-masonry-2.html">Two Columns</a> </li>
            <li> <a href="portfolio-masonry-3.html">Three Columns<span class="label label-danger">HOT</span></a> </li>
            <li> <a href="portfolio-masonry-4.html">Four Columns</a> </li>
            <li> <a href="portfolio-masonry-5.html">Five Columns</a> </li>
            <li> <a href="portfolio-masonry-6.html">Six Columns</a> </li>
            <li> <a href="portfolio-masonry-sidebar.html">Sidebar version</a> </li>
            <li> <a href="portfolio-masonry-wide-3.html">Wide version</a> </li>
          </ul>
        </div>
      </div>
    </li>
  </ul>
</li> --}}