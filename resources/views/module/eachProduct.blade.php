  <a href="{!!$p['link'] or '' !!}" title="{!!$p['title'] or '' !!}" class="i928 product grid-item each-product">
    <div class="i929 product-image">
      <img class="i930 productImage" alt="{!!$p['title'] or '' !!}" src="{!!$p['img_thumb'] or '' !!}" onerror="this.src='/public/thumbs/noimage.jpg'">
      {{-- <img class="i931 smallLogo" src="@site('anh-logo')"> --}}
      {{-- <img class="i932 smallLogo2" src="@site('anh-logo')"> --}}
    </div>
    <div class="i933 product-description matchHeight3">
      <div class="i934 product-title">
        <h4 class="i935 matchHeight2">
          {!!$p['title'] or '' !!}
        </h4>
      </div>
      @if(isset($p['price']))
      <div class="i936 product-price">
        @if(empty($p['price_promo']))
        <ins class="i937 " >@money($p['price'])</ins>
        @elseif(empty($p['price']))
        <ins class="i938 " >@money($p['price_promo'])</ins>
        @else
        <ins class="i939 " >@money($p['price_promo'])</ins>
        <del class="i940 " >@money($p['price'])</del>
        @endif
      </div>
      @endif
  {{--     <div class="i941 product-rate">
        <i class="i942 fa fa-star"></i>
        <i class="i943 fa fa-star"></i>
        <i class="i944 fa fa-star"></i>
        <i class="i945 fa fa-star"></i>
        <i class="i946 fa fa-star-half-full"></i>
      </div>
      <button class="i947 btn btn-light btn-xs float-right btn btn-icon-holder" href="{!!$p['link'] or '' !!}" data-name="{!!$p['title'] or '' !!}">Chi tiết<i class="i948 fa fa-arrow-right"></i></button> --}}
      {{-- <form class="i949 "  data-element="cart">
        <input class="i950 "  type="hidden" name="id" value="{!!$p['id'] or '' !!}">
        <input class="i951 "  type="hidden" name="price" value="{!!$p['price_real'] or '' !!}" id="pricevalue246441">
        <input class="i952 "  type="hidden" name="quantity" value="1">
        <button type="button" class="i953 btn btn-mua-ngay btn-xs btn-my" data-action="Khách thêm {!!$p['title'] or ''!!}" style="width: 100%">Liên hệ mua hàng</button>
      </form> --}}
    </div>
  </a>