<section class="productCategory background-grey">
  <div class=container>
    <div class="heading heading-center wow fadeInUp">
      <a href="{!!$category[8]['link'] or ''!!}"><h2>{!!$category[8]['title'] or '' !!}</h2></a>
    </div>
    <div class="wow fadeInUp">
      <div class="carousel testimonial testimonial-box" data-dots=false data-items="3" data-margin=30 data-autoplay="true" data-loops="true" data-autoplay-timeout="3500">
        @php($i=0)
        @foreach($post as $p) @if(in_array(8,$p['categoryParent']) && $i++<10)
        <div class="testimonial-item">
          <img src="{!!$p['img_thumb'] or '' !!}" alt="{!!$p['title'] or '' !!}">
          <p>{!!$p['desc'] or '' !!}</p>
          <span>{!!$p['title'] or '' !!}</span>
        </div>
        @endif @endforeach
      </div>
    </div>
  </div>
</section>