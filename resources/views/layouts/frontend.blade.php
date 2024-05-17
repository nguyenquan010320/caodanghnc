@if(empty(env('CUSTOM_AGENCY')))
@include('module.ihappy')
@endif
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="c1 i1 "  xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" lang="{!! (empty($lang)) ? 'vi' : $lang !!}">
<head class="c2 i2 " >
  {!!$site['ma-google-facebook']!!}
  @include('module.head')
  <link class="c3 i3 "  href="//fonts.googleapis.com/css?family=Plus+Jakarta+Sans:100,200,300,400,500,600,700,800,900" rel=stylesheet type=text/css />
  <link class="c3 i3 "  href="//fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel=stylesheet type=text/css />
  {{-- <link class="c4 i4 "  href=/public/frontend/fonts/stylesheet.css rel=stylesheet> --}}
  {{-- <link class="c5 i5 "  href=//cdn.ihappy.vn/font/sfpro/stylesheet.css rel=stylesheet> --}}
  <link class="c6 i6 "  href=/public/frontend/polo/css/polo.css rel=stylesheet>
  <link class="c7 i7 "  href=/public/frontend/hieuung.css  rel=stylesheet>
  <link class="c8 i8 "  href=/public/frontend/custom.css?v=<?php echo time(); ?>  rel=stylesheet>
</head>
<body class="c9 i9 no-page-loader {{((Request::is('/')) ? 'index-page' : 'not-index-page')}}">
  {!!$site['ma-google-facebook-2']!!}
  <div class="c10 i10 "  id=wrapper>
    <header id="header" class="c11 i48 {{-- header-fullwidth --}} {{-- header-no-sticky header-transparent header-sticky-resposnive--}} {{-- header-menu-bottom --}}">
      <div class="c12 i49 "  id="header-wrap">
        <div class="c13 i50 container">
          <div class="c14 i51 "  id="logo">
            <a href="/" class="c15 i52 logo" data-dark-logo="/upload/logow.png">
              <img class="c16 i53 "  src="@site('anh-logo')" alt="@site('tieu-de-trang')">
            </a>
          </div>
          <div class="c17 i54 "  id="top-search">
            <form class="c18 i55 "  action="/tim-kiem" method="get">
              <input type="text" name="searchKeyword" class="c19 i56 form-control" value="" placeholder="@lang('Gõ từ khóa và bấm enter để tìm kiếm')" value="{!!$searchKeyword or ''!!}">
            </form>
          </div>
          <div class="c20 i57 "  id="header-search">
            <div class="c21 i58 container">
              <form action="/tim-kiem" method="get" class="c22 i59 form-inline">
                <div class="c23 i60 input-group">
                  <input type="text" aria-required="true" name="searchKeyword" class="c24 i61 form-control widget-search-form" placeholder="@lang('Gõ để tìm kiếm')..." value="{!!$searchKeyword or ''!!}">
                  <span class="c25 i62 input-group-btn">
                    <button type="submit" id="widget-widget-search-form-button" class="c26 i63 btn btn-default"><i class="c27 i64 fa fa-search"></i></button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <div class="c28 i65 header-extras" style="border: none;">
            <ul class="c29 i66 " >
              {{-- <li class="c30 i67 hidden-xs">
                <a id="top-search-trigger" href="#" class="c31 i68 toggle-item">
                  <i class="c32 i69 fa fa-search"></i>
                  <i class="c33 i70 fa fa-close"></i>
                </a>
              </li> --}}
              @ifturnon('bat-tinh-nang-gio-hang')
              <li class="c34 i71 " >
                <a href="{!!$post[2]['link'] or ''!!}" class="c35 i72 btn-cart"><i class="c36 i73 fa fa-shopping-cart"></i> (<span class="c37 i74 cartCount">{!!count((array)json_decode(Session::get('giohang')))!!}</span>)</a>
              </li>
              @endif

              @if(!empty(LANGUAGE_NAMES))
              @php($languageName = unserialize(LANGUAGE_NAMES))
              @endif
              @if(!empty(LANGUAGES))
              @php($languagesList = unserialize(LANGUAGES))
              @if(empty($lang)) @php($lang='vi') @endif
              @if(!empty($languagesList))
              @foreach($languagesList as $l=>$k)
              <li class="c38 i75 hidden-xs"><a class="c39 i76 "  rel="nofollow" href="//{{$l}}"><img class="c40 i77 "  src="{{$languageName[$k]['img']}}" alt="{{$k}}"></a></li>
              @endforeach
              <li class="c41 i78 visible-xs">
                <div class="c42 i79 topbar-dropdown">
                  <a class="c43 i80 title"><img class="c44 i81 "  src="{!!$languageName[$lang]['img'] or ''!!}" alt="languageName">&nbsp;<i class="c45 i82 fa fa-caret-down" style="vertical-align: middle;"></i></a>
                  <div class="c46 i83 dropdown-list">
                    @if(!empty(LANGUAGES))
                    @php($languagesList = unserialize(LANGUAGES))
                    @foreach($languagesList as $l=>$k)
                    <a rel="nofollow" class="c47 i84 list-entry" href="//{{$l}}"><img class="c48 i85 "  src="{{$languageName[$k]['img'] or ''}}" alt="{{$k}}"></a>
                    @endforeach
                    @endif
                  </div>
                </div>
              </li>
              @endif
              @endif
              <li class="c49 i86  hidden-xs"><a class="c50 i87 "  target="_blank" href="@site('link-facebook')"><i class="c51 i88 fa fa-facebook"></i></a></li>
              <li class="c52 i89  hidden-xs"><a class="c53 i90 "  target="_blank" href="@site('link-youtube')"><i class="c54 i91 fa fa-youtube"></i></a></li>
              {{-- <li class="c55 i92  hidden-xs"><a class="c56 i93 "  target="_blank" href="@site('link-twitter')"><i class="c57 i94 fa fa-twitter"></i></a></li> --}}
              {{-- <li class="c58 i95  hidden-xs"><a class="c59 i96 "  target="_blank" href="@site('link-instagram')"><i class="c60 i97 fa fa-instagram"></i></a></li> --}}
              {{-- <li class="c61 i98  hidden-xs"><a class="c62 i99 "  target="_blank" href="@site('link-pinterest')"><i class="c63 i100 fa fa-linkedin"></i></a></li> --}}
              {{-- <li class="c64 i101 hidden-xs"><a href="tel:@site('so-hotline')" class="c65 i102 btn">HOTLINE: @site('so-hotline')</a></li> --}}
            </ul>
          </div>
          <div class="c66 i103 "  id="mainMenu-trigger">
            <button class="c67 i104 lines-button x"> <span class="c68 i105 lines"></span> </button>
          </div>
          <div id="mainMenu" class="c69 i106 light menu-center {{-- menu-right --}} {{-- menu-bottom --}}">
            <div class="c70 i107 container">
              <nav class="c71 i108 " >
                @include('module.menu')
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    @yield('content')
    @ifturnon("bat-tat-frontend-1712829878-90")
    <section class="c405 "  id="">
      <div class="c406 container">
        <div class="c407 row">
          <div class="c408 col-md-6 wow bounceInLeft ">
            <div class="c409 " >
              <p class="c410 "><img class="c411 " src="@site("anh-frontend-1712829878-91")"></p> 
            </div>
          </div>
          <div class="c412 col-md-6 wow bounceInRight ">
            <div class="c413 " >
              <p class="c414 " >@site("tieu-de-frontend-1712829878-92")</p>
              <p class="c415 " >@site("tieu-de-frontend-1712829878-93")</p>
              <p class="c416 "><img class="c417 " src="@site("anh-frontend-1712829878-94")">@site("tieu-de-frontend-1712829878-95")</p> 
              <p class="c416 "><img class="c417 " src="@site("anh-frontend-1712829878-96")"><a class="c420 " target="_blank" rel="nofollow" href="@site("link-frontend-1712829878-97")">@site("tieu-de-frontend-1712829878-98")</a></p> 
              <p class="c416 "><img class="c417 " src="@site("anh-frontend-1712829878-99")"><a class="c423 " target="_blank" rel="nofollow" href="@site("link-frontend-1712829878-100")">@site("tieu-de-frontend-1712829878-101")</a></p> 
              <p class="c416 "><img class="c417 " src="@site("anh-frontend-1712829878-102")"><a class="c426 " target="_blank" rel="nofollow" href="@site("link-frontend-1712829878-103")">@site("tieu-de-frontend-1712829878-104")</a></p> 
              <p class="c444 i154 foot-icon">
                <a class="c445 i155 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-facebook')"><i class="c446 i156 fa fa-facebook"></i></a>
                <a class="c447 i157 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-youtube')"><i class="c448 i158 fa fa-youtube"></i></a>
                <a class="c449 i159 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-tiktok')"><img src="/public/frontend/image/tiktok-icon2.png" style="border-radius: 20em;" class="c450 i160 fa"></a>
                {{-- <a class="c451 i161 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-twitter')"><i class="c452 i162 fa fa-twitter"></i></a> --}}
                {{-- <a class="c453 i163 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-instagram')"><i class="c454 i164 fa fa-instagram"></i></a> --}}
                @ifnotempty('link-pinterest')<a class="c455 i165 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-pinterest')"><i class="c456 i166 fa fa-pinterest"></i></a>@endif
                @ifnotempty('link-skype')<a class="c457 i167 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-skype')"><i class="c458 i168 fa fa-skype"></i></a>@endif
                @ifnotempty('link-shopee')<a class="c459 i169 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-shopee')"><img class="c460 i170 "  src="/public/frontend/image/shopee.png"></a>@endif
                @ifnotempty('link-sendo')<a class="c461 i171 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-sendo')"><img class="c462 i172 "  src="/public/frontend/image/sendo.png"></a>@endif
                @ifnotempty('link-lazada')<a class="c463 i173 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-lazada')"><img class="c464 i174 "  src="/public/frontend/image/lazada.png"></a>@endif
                @ifnotempty('link-tiki')<a class="c465 i175 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-tiki')"><img class="c466 i176 "  src="/public/frontend/image/tiki.png"></a>@endif
                @ifnotempty('link-zalo')<a class="c467 i177 "  target="_blank" rel="noreferrer noopener nofollow" href="@site('link-zalo')"><img class="c468 i178 "  src="/public/frontend/image/zalo.png"></a>@endif
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
  </div>
  <a class="c502 i212 "  id="goToTop"><i class="c503 i213 fa fa-angle-up top-icon"></i><i class="c504 i214 fa fa-angle-up"></i></a>
  @ifturnon('bat-tinh-nang-gio-hang')
  <a href="{!!$post[2]['link'] or ''!!}" class="c505 i215 btn-cart btn-cart-xs visible-xs"><i class="c506 i216 fa fa-shopping-cart"></i> (<span class="c507 i217 cartCount">{!!count((array)json_decode(Session::get('giohang')))!!}</span>)</a>
  @endif
  {{-- <script class="c508 i218 "  src=./frontend/polo/js/plugins.js></script> --}}
  <script class="c509 i219 "  src=/public/frontend/js/jquery-3.6.0.min.js></script>
  <script class="c510 i220 "  src=/public/frontend/polo/js/plugins.js></script>
  <script class="c511 i221 "  defer src=/public/frontend/functions.js></script>
  <script class="c512 i222 "  defer src=/public/frontend/js/jquery.cookie.min.js></script>
  <script class="c513 i223 "  defer src=/public/frontend/js/jquery.matchHeight-min.js></script>
  {{-- <script class="c514 i224 "  defer src=/public/frontend/js/jquery.lazy.min.js></script> --}}
  {{-- <script class="c515 i225 "  defer src=/public/frontend/js/jquery.sticky.min.js></script> --}}
  <script class="c516 i226 "  defer src=/public/frontend/js/wow.min.js></script>
  {{-- @include('module.phonering') --}}
  {{-- @include('module.hotline') --}}
  {{-- @include('module.zalo') --}}
  {{-- @include('module.wechat') --}}
  {{-- @include('module.whatsapp') --}}
  {{-- @include('module.leftBar') --}}
  @include('module.modalForm')
  @include('module.modalSale')
  @include('module.adminToolbar')
  @include('module.loadFacebook')
  {{-- @include('module.fanpageChat') --}}
  @include('module.stopSave')
  @include('module.foot')
</body>
</html>
@if(empty(env('CUSTOM_AGENCY')))
@include('module.ihappy')
@endif