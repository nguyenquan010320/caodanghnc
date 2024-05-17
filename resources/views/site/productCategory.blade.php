@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
{{-- @if(sizeof($postList)==1)
<script class="i725 "  type="text/javascript">
  @foreach($postList as $p)
  window.location.href="{!!$p['link'] or '' !!}";
  @endforeach
</script>
@elseif($s['childCount'] == 1)
<script class="i726 "  type="text/javascript">
  @foreach($s['child'] as $c)
  window.location.href="{!!$category[$c]['link'] or '' !!}";
  @endforeach
</script>
@endif --}}
<section class="i727 productCategory p-b-10 p-t-10">
  <div class="i728 container">
    <div class="i729 heading m-b-0">
      <h1 class="i730 m-b-0 text-left">{!!$title!!}</h1>
      {{-- <p class="i731 text-left m-b-0">{!!$desc!!}</p> --}}
    </div>
  </div>
</section>
<hr class="i732 p-0 m-0">
<section class="i733 sidebar-left san-pham">
  <div class="i734 container">
    @if(!empty($site['hien-cot-danh-muc-trang-san-pham']))
    <div class="i735 row">
      <div class="i736 content col-md-9 m-t-0"> @else <div class="i737 " ><div class="i738 " > @endif

        {{-- <form class="i739 "  method="get" action="{!!$category[2]['link'] or ''!!}">
          <div class="i740 row">
            <div class="i741 col-md-6">
              <p class="i742 " ><b class="i743 " >Bộ lọc:</b></p>
            </div>
            <div class="i744 col-md-2">
              <p class="i745 text-right"><b class="i746 " >Sắp xếp:</b></p>
            </div>
            <div class="i747 col-md-4">
              @if(!empty(ORDER_OPTION))
              @php($order = unserialize(ORDER_OPTION))
              @endif
              <select class="i748 form-control" name="order" onchange="$(this).parents('form').submit();">
                @foreach($order as $k=>$o)
                <option class="i749 "  value="{!!$k or ''!!}" @if(Request::get('order') == $k) selected="" @endif>{!!$o['title'] or ''!!}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="i750 row m-b-20">
            <div class="i751 col-md-2">
              <div class="i752 form-group">
                <select class="i753 form-control" name="category">
                  <option class="i754 "  selected="" value="">Kiểu dáng điều hòa</option>
                  @foreach($category as $c) @if($c['parent']==2)
                  <option class="i755 "  value="{!!$c['id'] or ''!!}" @if(Request::get('category') == $c['id'] || $s['id'] == $c['id']) selected="" @endif>{!!$c['title'] or ''!!}</option>
                  @endif @endforeach
                </select>
              </div>
            </div>
            <div class="i756 col-md-2">
              <div class="i757 form-group">
                <select class="i758 form-control" name="field1">
                  <option class="i759 "  selected="" value="">{!!$category[16]['title'] or ''!!}</option>
                  @foreach($category as $c) @if($c['parent']==16)
                  <option class="i760 "  value="{!!$c['id'] or ''!!}" @if(Request::get('field1') == $c['id']) selected="" @endif>{!!$c['title'] or ''!!}</option>
                  @endif @endforeach
                </select>
              </div>
            </div>
            <div class="i761 col-md-2">
              <div class="i762 form-group">
                <select class="i763 form-control" name="field2">
                  <option class="i764 "  selected="" value="">{!!$category[22]['title'] or ''!!}</option>
                  @foreach($category as $c) @if($c['parent']==22)
                  <option class="i765 "  value="{!!$c['id'] or ''!!}" @if(Request::get('field2') == $c['id']) selected="" @endif>{!!$c['title'] or ''!!}</option>
                  @endif @endforeach
                </select>
              </div>
            </div>
            <div class="i766 col-md-2">
              <div class="i767 form-group">
                <select class="i768 form-control" name="field3">
                  <option class="i769 "  selected="" value="">{!!$category[25]['title'] or ''!!}</option>
                  @foreach($category as $c) @if($c['parent']==25)
                  <option class="i770 "  value="{!!$c['id'] or ''!!}" @if(Request::get('field3') == $c['id']) selected="" @endif>{!!$c['title'] or ''!!}</option>
                  @endif @endforeach
                </select>
              </div>
            </div>
            <div class="i771 col-md-2">
              <div class="i772 form-group">
                <select class="i773 form-control" name="price">
                  <option class="i774 "  selected="" value="">@lang('Khoảng giá')</option>
                  <option class="i775 "  value="1" @if(Request::get('price') == 1) selected="" @endif>@lang('Dưới') 5.000.000đ</option>
                  <option class="i776 "  value="5" @if(Request::get('price') == 5) selected="" @endif>5.000.000 - 8.000.000</option>
                  <option class="i777 "  value="8" @if(Request::get('price') == 8) selected="" @endif>8.000.000 - 12.000.000</option>
                  <option class="i778 "  value="12" @if(Request::get('price') == 12) selected="" @endif>@lang('Trên') 12.000.000</option>
                </select>
              </div>
            </div>
            <div class="i779 col-md-2">
              <button type="submit" class="i780 btn btn-my btn-my-2" style="width: 100%">Tìm kiếm</button>
            </div>
          </div>
        </form> --}}

        {{-- @if($s['id'] == 2)
        @foreach($category as $p2) @if($p2['parent']==2)
        <div class="i781 heading">
          <h2 class="i782 line-ben-duoi">{!!$p2['title'] or ''!!}</h2>
        </div>
        <div class="i783 row">
          @foreach($category as $p) @if($p['parent']==$p2['id'])
          <div class="i784 col-md-4">
            @include('module.eachProduct')
          </div>
          @endif @endforeach
        </div>
        @endif @endforeach --}}

        @if($s['hasChild'])
        <div class="i785 row">
          @foreach($category as $p) @if($p['parent']==$s['id'])
          <div class="i786 col-md-4">
            @include('module.eachProduct')
          </div>
          @endif @endforeach
        </div>
        @else
        @if(empty($postList))
        <blockquote class="i787 blockquote-color text-light"><p class="i788 " >@lang('Đang cập nhật...')</p></blockquote>
        @endif
        <!--p>
          <?php
          //$hang = [];
          //foreach ($s['postId'] as $p) { 
          //  $hang[] = $post[$p]['field1'];
          //}
          //$hang = array_filter($hang);
          //$hang = array_unique($hang);
          //asort($hang);
          ?>

          {{-- @foreach($hang as $h)
          <a href="{!!$s['link'] or ''!!}?field1={!!$h or ''!!}" class="i789 btn btn-light @if(Request::get('field1') == $h) active @endif">{!!$category[$h]['title'] or ''!!}</a>
          @endforeach --}}
        </p-->
        <div class="i790 row">
          @foreach($postList as $p)
          <div class="i791 col-md-4">
            @include('module.eachProduct')
          </div>
          @endforeach
        </div>
        @include('module.paging')
        @endif
        @if(!Helper::checkEmptyString($s['desc_full']))
        <div class="i792 chi-tiet-bai-viet">
          {!!$s['desc_full'] or '' !!}
        </div>
        <div class="i793 m-t-20">
          @site('doan-thong-tin-lien-he-duoi-moi-san-pham')
        </div>
        @endif
      </div>
      @include('module.productSidebar')
    </div>
  </div>
</section>
{{-- @include('section.dangky') --}}
@endsection