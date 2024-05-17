<section id="">
  <div class="container">
    <div class="heading">
      <h2 class="line-ben-duoi">{!!$category[10]['title'] or ''!!}</h2>
    </div>
    <div class="accordion">
      @php($i=0) @foreach($post as $p) @if(in_array(10, $p['categoryParent']) && $i++<7)
      <div class="ac-item @if($i==1) ac-active @endif">
        <h5 class="ac-title">{!!$p['title'] or ''!!}</h5>
        <div class="ac-content" @if($i==1) style="display: block;" @else style="display: none;" @endif>
          {!!$p['desc_full'] or ''!!}
        </div>
      </div>
      @endif @endforeach
    </div>
    <p class="text-center"><a href="{!!$category[10]['link']!!}" class="btn btn-my" type="button">Xem các câu hỏi khác</a></p>
  </div>
</section>