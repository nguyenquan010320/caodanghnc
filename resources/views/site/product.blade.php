@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
<script class="i586 "  type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "Product",
    "productID":"{!!$s['id'] or ''!!}",
    "name": "{!!str_replace('"','',trim(strip_tags($s['title'])))!!}",
    "image": [
    "{!!$domain or '' !!}{!!$s['img'] or ''!!}"
    ],
    "brand": 
    {
      "@type": "Thing",
      "name": "{!!str_replace('"','',trim(strip_tags($s['title'])))!!}"
    },
    "description": "{!!str_replace('"','',trim(strip_tags($s['desc'])))!!}",
    "sku": "skudetail{!!$s['id'] or ''!!}",
    "url": "{!!$domain or '' !!}{!!$s['link'] or ''!!}",

    @if(!empty($comment) && is_array($comment))
    @php($avg = [])

    "review": [
    @foreach($comment as $c)
    @php($avg[] = $c['rating'])
    {
      "@type": "Review",
      "reviewRating": 
      {
        "@type": "Rating",
        "ratingValue": "{!!$c['rating'] or ''!!}"
      },
      "author": 
      {
        "@type": "Person",
        "name": "{!!$c['name'] or ''!!}"
      },
      "reviewBody": "{!!$c['comment'] or ''!!}"
    } @if(!$loop->last) , @endif
    @endforeach
    ],

    @php($avg = array_filter($avg))
    @php($avgp = array_sum($avg)/count($avg))

    "aggregateRating": 
    {
      "@type": "AggregateRating",
      "ratingValue": "{!!$avgp!!}",
      "ratingCount": "{!!array_sum($avg)!!}"
    },
    @endif

    "offers": 
    {
      "@type": "Offer",
      "url": "{!!$domain or '' !!}{!!$s['link'] or ''!!}",
      "price": "{!!$s['price_real'] or '0' !!}",
      "priceValidUntil": "2050-11-05",
      "itemCondition": "https://schema.org/NewCondition",
      "availability": "https://schema.org/InStock",
      "priceCurrency": "VND"
    },
    "additionalProperty": [{
    "@type": "PropertyValue",
    "propertyID": "{!!$s['categoryInfo']['id'] or ''!!}",
    "value": "{!!$s['categoryInfo']['title'] or ''!!}"
  }],
  "gtin8" : "8933002301{!!$s['id'] or ''!!}6"
}       
</script>
<section class="i587 sidebar-left sanp product-page">
  <div class="i588 container">
    <div class="i589 row">
      <div class="i590 content @if(empty($site['hien-cot-danh-muc-trang-san-pham'])) col-md-12 @else col-md-9 @endif m-t-0 product-page">
        <div class="i591 product">
          <div class="i592 row p-b-15">
            <div class="i593 col-md-5 m-b-20">
              <div class="i594 product-image imgmain imgmainmain" id="zoom_03" data-lightbox="gallery">
                <a class="i595 "  href="{!!$s['img'] or ''!!}" data-lightbox="gallery-item"><img class="i596 "  src="{!!$s['img'] or ''!!}" alt="{!!$s['title'] or ''!!}"></a>
                {{-- <img class="i597 smallLogo" src="/upload/logo.png"> --}}
                {{-- <img class="i598 smallLogo2" src="/upload/logo.png"> --}}
                @if(!empty($s['img_other'])) 
                <div id="product-gallery" class="i599 thumb">
                  @foreach($s['img_other'] as $img) @if(substr($img[0],0,28) != '/public/upload/product/icon_' && $img[0] != $s['img'])
                  <a class="i600 "  href="{!!$img[0]!!}" data-lightbox="gallery-item"><img class="i601 "  src="{!!str_replace('/upload/', '/thumbs/', $img[0])!!}" alt="{!!$img[1] or $s['title'] or ''!!}" width="500" height="500"></a>
                  @endif @endforeach
                </div>
                @endif
              </div>
              @if(!empty($s['variant']))
              @foreach ($s['variant'] as $k=>$v)
              <div class="i602 product-image imgmain" id="variant_{{$k}}" data-lightbox="gallery" style="display: none;">
                <a class="i603 "  href="{!!$v['imgmain'] or ''!!}" data-lightbox="gallery-item"><img class="i604 "  src="{!!$v['imgmain'] or ''!!}" alt="{!!$v['title'] or ''!!}"></a>
                <div id="product-gallery" class="i605 thumb">
                  <a class="i606 "  href="{!!$v['img1'] or ''!!}" data-lightbox="gallery-item"><img class="i607 "  src="{!!str_replace('/upload/', '/thumbs/', $v['img1'])!!}" alt="{!!$v['title'] or ''!!}"></a>
                  <a class="i608 "  href="{!!$v['img2'] or ''!!}" data-lightbox="gallery-item"><img class="i609 "  src="{!!str_replace('/upload/', '/thumbs/', $v['img2'])!!}" alt="{!!$v['title'] or ''!!}"></a>
                  <a class="i610 "  href="{!!$v['img3'] or ''!!}" data-lightbox="gallery-item"><img class="i611 "  src="{!!str_replace('/upload/', '/thumbs/', $v['img3'])!!}" alt="{!!$v['title'] or ''!!}"></a>
                </div>
              </div>
              @endforeach
              @endif
            </div>
            <div class="i612 col-md-7 col-sm-12">
              <div class="i613 product-description">
                <div class="i614 product-title">
                  <h1 class="i615 " >{!!$s['title'] or ''!!}</h1>
                </div>
                {{-- <div class="i616 product-rate">
                  <i class="i617 fa fa-star"></i>
                  <i class="i618 fa fa-star"></i>
                  <i class="i619 fa fa-star"></i>
                  <i class="i620 fa fa-star"></i>
                  <i class="i621 fa fa-star-half-o"></i>
                </div> --}}
                <div class=product-price>
                  @if(empty($s['price_promo']))
                  <ins class="i622 giaban">@money($s['price'])</ins>
                  @else
                  <del class="i623 " >@lang('Giá niêm yết:') @money($s['price'])</del>
                  <ins class="i624 giaban">@lang('Giá khuyến mãi:') @money($s['price_promo'])</ins>
                  @endif
                </div>
                <p class="i625 " >
                  <a href="tel:@site('so-hotline')" class="i626 btn btn-my btn-action m-b-10" data-action="@lang('Khách hàng bấm nút gọi hotline trên trang:') {!!$s['title'] or ''!!}"><i class="i627 fa fa-phone"></i> @site('so-hotline')</a>
                  <a href="javascript:" type="button" class="i628 btn btn-my btn-mua btn-action m-b-10" data-action="@lang('Khách hàng bấm nút đặt hàng trên trang:') {!!$s['title'] or ''!!}" data-name="{!!$s['title'] or ''!!}" data-id="{!!$s['id'] or ''!!}" data-price="@money($s['price_real'])"><i class="i629 fa fa-shopping-cart"></i> @lang('Yêu cầu báo giá')</a>
                </p>
                {{-- <div class="i630 chi-tiet-bai-viet" style="display: block;float: left;">
                  <p class="i631 "  style="background: #e5bc1b;text-align: center;padding: 10px;">Sản phẩm đang được <b class="i632 " >FLASH SALE</b> trên <a class="i633 "  href="{!!$site["link-facebook"]!!}" target="_blank" style="color: #000;border-bottom: 1px #000000 dashed;">Fanpage</a></p>
                  <p class="i634 " >Hiện có {!!rand(3,50)!!} khách hàng đang hỏi về sản phẩm này, <b class="i635 " ><a class="i636 "  href="{!!str_replace('facebook.com', 'm.me', $site["link-facebook"])!!}" target="_blank">INBOX NGAY</a></b> trước khi hết SALE để có Giá Tốt Nhất và được Freeship!</p>
                </div> --}}
                @if(empty($s['stock']))
                <p class="i637 "  style="color: red;font-size: 20px;font-style: italic;">Sản phẩm đã hết hàng!</p>
                @else
                @ifturnon('bat-tinh-nang-gio-hang')
                <div class="i638 seperator m-t-0 m-b-10"></div>
                <form class="i639 "  data-element="cart">
                  <input class="i640 "  type="hidden" name="id" value="{!!$s['id'] or ''!!}">
                  <input class="i641 "  type="hidden" name="price" id="price" value="{!!$s['price'] or ''!!}">
                  <div class="i642 row">
                    @if(!empty($s['variant']))
                    <div class="i643 col-md-6 m-b-10">
                      <h6 class="i644 " >Chọn loại hàng</h6>
                      <select class="i645 "  name="type1" id="variant">
                        <option class="i646 "  value="" selected="">--@lang('Chọn loại hàng')--</option>
                        @foreach ($s['variant'] as $k=>$v)
                        @if(empty($v['price'])) @php($v['price'] = $s['price_real']) @endif
                        <option class="i647 "  data-id="{{$k}}" data-price="@money($v['price'])" data-pricereal="{{$v['price']}}">{!!$v['title']!!}</option>
                        @endforeach 
                      </select>
                    </div>
                    @else
                    @if(!empty($site['truong-phan-loai-1']) && !empty($s['type1']))
                    <div class="i648 col-md-6 m-b-10">
                      <h6 class="i649 " >Chọn @site('truong-phan-loai-1')</h6>
                      <label class="i650 sr-only">@site('truong-phan-loai-1')</label>
                      @php($type1s = explode(',', $s['type1']))
                      <select class="i651 "  name="type1">
                        <option class="i652 "  value="" selected="">--@lang('Chọn') @site('truong-phan-loai-1')--</option>
                        @foreach ($type1s as $type1)
                        <option class="i653 " >{!!$type1!!}</option>
                        @endforeach 
                      </select>
                    </div>
                    @endif
                    @if(!empty($site['truong-phan-loai-3']) && !empty($s['type3']))
                    <div class="i654 col-md-6 m-b-10">
                      <h6 class="i655 " >@lang('Chọn') @site('truong-phan-loai-3')</h6>
                      <label class="i656 sr-only">@site('truong-phan-loai-3')</label>
                      @php($type3s = explode(',', $s['type3']))
                      <select class="i657 "  name="type3">
                        <option class="i658 "  value="" selected="">--@lang('Chọn') @site('truong-phan-loai-3')--</option>
                        @foreach ($type3s as $type3)
                        <option class="i659 " >{!!$type3!!}</option>
                        @endforeach 
                      </select>
                    </div>
                    @endif
                    @if(!empty($site['truong-phan-loai-2']) && !empty($s['type2']))
                    <div class="i660 col-md-6 m-b-10">
                      <h6 class="i661 " >@lang('Chọn') @site('truong-phan-loai-2')</h6>
                      <ul class="i662 product-size">
                        @php($type2s = explode(',', $s['type2']))
                        @foreach ($type2s as $type2)
                        <li class="i663 " ><label class="i664 " ><input class="i665 "  type="radio" value="{!!$type2!!}" checked="checked" name="type2"><span class="i666 " >{!!$type2!!}</span></label></li>
                        @endforeach 
                      </ul>
                    </div>
                    @endif
                    @endif
                    <div class="i667 col-md-4 m-b-10">
                      <h6 class="i668 " >@lang('Chọn số lượng')</h6>
                      <select class="i669 "  name="quantity" style="">
                        <option class="i670 "  value="1" selected="">@lang('Chọn số lượng')</option>
                        @for ($i = 1; $i <= 200; $i++)
                        <option class="i671 "  value="{!!$i!!}">{!!$i!!}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="i672 col-md-8">
                      <h6 class="i673 " >@lang('Giỏ hàng')</h6>
                      <a class="i674 btn btn-pinterest btn-gio-hang m-b-5" data-action="Khách thêm {!!$s['title'] or ''!!} vào giỏ hàng"><i class="i675 fa fa-plus"></i>@lang('Thêm vào giỏ')</a>
                      <a href="{!!$post[2]['link'] or ''!!}" class="i676 btn m-b-5">@lang('Xem giỏ hàng')</a>
                    </div>
                    {{-- <div class="i677 col-md-4">
                      <h6 class="i678 " >&nbsp;</h6>
                      <input class="i679 "  type="hidden" name="quantity" value="1">
                      <a class="i680 btn btn-pinterest btn-mua-ngay m-b-5" data-action="Khách thêm {!!$s['title'] or ''!!} vào giỏ hàng"><i class="i681 fa fa-shopping-cart"></i>@lang('Mua ngay')</a>
                    </div> --}}
                  </div>
                </form>
                @endif
                @endif
                {{-- <div class="i682 seperator m-t-0 m-b-10"></div> --}}
                <div class="i683 post-share">
                  <div class="i684 fb-like" data-href="{!!$domain or '' !!}{!!$s['link'] or ''!!}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                </div>
                {{-- <div class="i685 seperator m-b-10"></div> --}}
                <div class="i686 chi-tiet-bai-viet" data-lightbox=gallery>
                  {!!$s['desc'] or ''!!}
                  {{-- {!!$s['spec'] or ''!!} --}}
                </div>
                {{-- @include('module.tags') --}}
                {{-- <div class="i687 post-meta-share">
                  <a class="i688 btn btn-xs btn-facebook" target="_blank" href="//www.facebook.com/sharer.php?u={!!$domain or '' !!}{!!$s['link'] or ''!!}&amp;t=ColorMedia">
                    <i class="i689 fa fa-facebook"></i>
                    <span class="i690 " >Share</span>
                  </a>
                  <a class="i691 btn btn-xs btn-twitter" target="_blank" href="//twitter.com/share?text=Great!&amp;url={!!$domain or '' !!}{!!$s['link'] or ''!!}&amp;hashtags=ColorMedia" data-width="100">
                    <i class="i692 fa fa-twitter"></i>
                    <span class="i693 " >Tweet</span>
                  </a>
                  <a class="i694 btn btn-xs btn-instagram" target="_blank" href="//www.instagram.com/?url={!!$domain or '' !!}{!!$s['link'] or ''!!}&amp;t=ColorMedia">
                    <i class="i695 fa fa-instagram"></i>
                    <span class="i696 " >Instagram</span>
                  </a>
                  <a class="i697 btn btn-xs btn-pinterest" target="_blank" href="//pinterest.com/pin/create/button/?url={!!$domain or '' !!}{!!$s['link'] or ''!!}&amp;t=ColorMedia">
                    <i class="i698 fa fa-pinterest"></i>
                    <span class="i699 " >Pinterest</span>
                  </a>
                </div> --}}
              </div>
            </div>
          </div>
          {{-- <div class="i700 seperator m-t-10 m-b-10"></div> --}}
          <div class="i701 chi-tiet-bai-viet" data-lightbox=gallery>
            <div class="i702 tabs border">
              <ul class="i703 tabs-navigation">
                <li class="i704 active"><a class="i705 "  href="#1">Thông tin sản phẩm</a></li>
                {{-- <li class="i706 " ><a class="i707 "  href="#2">Vận chuyển - thanh toán - bảo hành</a></li> --}}
                {{-- <li class="i708 " ><a class="i709 "  href="#3">Bản đồ</a></li> --}}
              </ul>
              <div class="i710 tabs-content">
                <div class="i711 tab-pane active" id="1">
                  @if(!empty($s['video'])) <div class="i712 m-b-20">{!!Helper::youtube($s['video'])!!}</div> @endif
                  {{-- {!!$s['desc_full'] or ''!!} --}}
                  {!! preg_replace('/src="(.*?)"/', ' data-lightbox="gallery-item" href="\1" src="\1" ', $s['desc_full'])!!}
                  <div class="i713 m-t-20">
                    @site('doan-thong-tin-lien-he-duoi-moi-san-pham')
                  </div>
                </div>
                <div class="i714 tab-pane" id="2">
                  {{-- {!!$post[86]['desc_full']!!} --}}
                </div>
                <div class="i715 tab-pane" id="3">
                  <div class="i716 google-maps">@site('ma-nhung-ban-do-google-maps')</div>
                </div>
              </div>
            </div>
          </div>

          <div class="i717 chi-tiet-bai-viet" data-lightbox=gallery>
            @if(!empty($s['video'])) <div class="i718 m-b-20">{!!Helper::youtube($s['video'])!!}</div> @endif
            {{-- {!!$s['desc_full'] or ''!!} --}}
            {{-- {!! preg_replace('/src="(.*?)"/', ' data-lightbox="gallery-item" href="\1" src="\1" ', $s['desc_full'])!!} --}}
            {{-- @if(Helper::checkEmptyString($s['desc_full'])) --}}
            {{-- {!!$post[4]['desc_full'] or ''!!} --}}
            {{-- @endif --}}
            
          </div>
          {{-- @include('module.comment') --}}
        </div>
      </div>
      @include('module.productSidebar')
    </div>
  </div>
</section>
<section class="i719 san-pham background-grey p-t-60 p-b-20">
  <div class=container>
    <div class="i720 heading heading-center m-b-50">
      <h2 class="i721 m-b-10 uppercase">@lang('Sản phẩm khác')</h2>
    </div>
    <div class="i722 shop">
      <div class="i723 row">
        @php($i=0) @foreach($relatedPost as $p) @if(in_array(2, $p['categoryParent']) && $i++<4)
        <div class="i724 col-md-3">
          @include('module.eachProduct')
        </div>
        @endif @endforeach
      </div>
    </div>
  </div>
</section>
@endsection