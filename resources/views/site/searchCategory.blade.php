@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
<section class="i817 productCategory p-b-10 p-t-10">
  <div class="i818 container">
    <div class="i819 heading m-b-0">
      <h1 class="i820 m-b-0 text-left">{!!$title!!}</h1>
      <p class="i821 text-left m-b-0">{!!$desc!!}</p>
    </div>
  </div>
</section>
<hr class="i822 p-0 m-0">
<section class="i823 sidebar-left sanp p-b-20 p-t-20">
  <div class="i824 container">
    <div class="i825 row">
      <div class="i826 content @if(empty($site['hien-cot-danh-muc-trang-san-pham'])) col-md-12 @else col-md-9 @endif  m-t-0">
        @if(empty($postList))
        <blockquote class="i827 blockquote-color text-light"><p class="i828 ">@lang('Không tìm thấy sản phẩm bài viết nào!')</p></blockquote>
        @endif
        <div class="i829 row">
          {{-- <div class="i830 grid-layout grid-4-columns" data-margin=20 data-item="grid-item"> --}}
            @foreach($postList as $p)
            <div class="i831 col-md-3">
              @include('module.eachPost')
            </div>
            @endforeach
          </div>
          @include('module.paging')
        </div>
        @include('module.productSidebar')
      </div>
    </div>
  </section>
  {{-- @include('section.dangky') --}}
  @endsection