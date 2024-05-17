@ifturnon('hien-cot-danh-muc-trang-san-pham')
<div class="i992 sidebar col-md-3 m-t-0 product-sidebar">
  <div class="i993 widget widget-newsletter">
    <h4 class="i994 tieu-de-danh-muc widget-title m-t-0 m-b-10">@lang('Danh mục sản phẩm')</h4>
    <div class="i995 list-group m-t-0">
      @if($category[2]['hasChild'])
      @foreach($category as $c) @if($c['parent']==2)
      @if($c['postCount']>0)<a href="{!!$c['link'] or '' !!}" class="i996 list-group-item {!!((isset($s['parent']) && $c['id']==$s['id']) || (isset($s['category']) && in_array($c['id'],$s['category'])))?'active':''!!}" style="font-weight: bold;">{!!$c['title'] or '' !!}</a>@endif
      @foreach($category as $c2) @if($c2['parent']==$c['id'])
      @if($c2['hasChild'])
      @if($c2['postCount']>0)<a href="javascript:void(0)" class="i997 list-group-item p-l-20 catParent parent{!!$c2['id'] or '' !!} {!!((isset($s['parent']) && $c2['id']==$s['id']) || (isset($s['category']) && in_array($c2['id'],$s['categoryParent'])))?'active':''!!}" data-id="{!!$c2['id'] or '' !!}">{!!$c2['title'] or '' !!}<i class="i998 fa fa-plus"></i><i class="i999 fa fa-minus"></i></a>@endif
      @foreach($category as $c3) @if($c3['parent']==$c2['id'])
      @if($c3['postCount']>0)<a href="{!!$c3['link'] or '' !!}" class="i1000 list-group-item p-l-40 catChild child{!!$c2['id'] or '' !!} {!!((isset($s['parent']) && $c3['id']==$s['id']) || (isset($s['category']) && in_array($c3['id'],$s['categoryParent'])))?'active':''!!}" data-parent="{!!$c2['id'] or '' !!}" style="display: none;">{!!$c3['title'] or '' !!}</a>@endif
      @endif @endforeach
      @else
      @if($c2['postCount']>0)<a href="{!!$c2['link'] or '' !!}" class="i1001 list-group-item p-l-20 {!!((isset($s['parent']) && $c2['id']==$s['id']) || (isset($s['category']) && in_array($c2['id'],$s['categoryParent'])))?'active':''!!}">{!!$c2['title'] or '' !!}</a>@endif
      @endif @endif @endforeach
      @endif @endforeach
      @else
      @php($i=0) @foreach($post as $p) @if(in_array(2, $p['categoryParent']) && $i++<50) 
      <a href="{!!$p['link'] or '' !!}" class="i1002 list-group-item">{!!$p['title'] or '' !!}</a>
      @endif @endforeach
      @endif
    </div>
    <div class="i1003 list-group m-t-10 box-thong-tin-sidebar">
      <div class="i1004 list-group-item nohover p-10" style="background: #eee;">
        <h4 class="i1005 " >@lang('Hỗ trợ mua hàng')</h4>
        @site('doan-thong-tin-lien-he')
      </div>
    </div>
  </div>
  {{-- <div class="i1006 widget clearfix widget-shop">
    <a class="i1007 "  href="{!!$category[2]['link'] or ''!!}"><h4 class="i1008 widget-title tieu-de-danh-muc m-b-15">{!!$category[2]['title'] or ''!!}</h4></a>
    @php($i=0) @foreach($post as $p) @if(in_array(2, $p['categoryParent']) && $i++<6)
    <div class="i1009 product">
      <div class="i1010 product-image">
        <a class="i1011 "  href="{!!$p['link'] or '' !!}">
          <img class="i1012 productImage" alt="{!!$p['title'] or '' !!}" src="{!!$p['img_thumb'] or '' !!}">
        </a>
      </div>
      <div class="i1013 product-description">
        <div class="i1014 product-title">
          <h3 class="i1015 " ><a class="i1016 "  href="{!!$p['link'] or '' !!}">{!!$p['title'] or '' !!}</a></h3>
        </div>
        <div class="i1017 product-price">
          @if(empty($p['price_promo']))
          <ins class="i1018 " >@money($p['price'])</ins>
          @else
          <ins class="i1019 " >@money($p['price_promo'])</ins>
          <del class="i1020 " >@money($p['price'])</del>
          @endif
        </div>
      </div>
    </div>
    @endif @endforeach
  </div> --}}
</div>
@endif