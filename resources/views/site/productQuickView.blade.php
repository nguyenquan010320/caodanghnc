{!!Helper::youtube($s['video'])!!}
<div class="i794 ajax-quick-view">
  <div class="i795 quick-view-content">
    <div class="i796 product m-t-0">
      <div class="i797 row">
        <div class="i798 col-md-12">
          <div class="i799 product-description">
            <div class="i800 product-category">{!!$s['categoryInfo']['title'] or '' !!}</div>
            <div class="i801 product-title">
              <h3 class="i802 " ><a class="i803 "  href="{!!$s['link'] or '' !!}">{!!$s['title'] or '' !!}</a></h3>
            </div>
            <div class="i804 product-price"><ins class="i805 " >@date($s['created_at'])</ins>
            </div>
            <div class="i806 product-rate">
              <i class="i807 fa fa-star"></i>
              <i class="i808 fa fa-star"></i>
              <i class="i809 fa fa-star"></i>
              <i class="i810 fa fa-star"></i>
              <i class="i811 fa fa-star-half-o"></i>
            </div>
            {{-- <div class="i812 product-reviews"><a class="i813 "  href="#">3 bình luận</a></div> --}}
            <div class="i814 seperator m-b-10"></div>
            <p class="i815 " >{!!$s['desc'] or '' !!}</p>
            @include('module.tags')
            <button class="i816 btn btn-my btn-mua btn-rounded" type="button">@lang('Tư vấn cho tôi')</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
