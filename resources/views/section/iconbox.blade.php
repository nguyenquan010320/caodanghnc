<section class="i1032 " >
    <div class="i1033 container">
      @ifnotempty('tieu-de-phan-o-noi-bat')
      <div class="i1034 heading heading-center wow fadeInUp">
        <a class="i1035 "  href="#"><h2 class="i1036 " >{!!$site["tieu-de-phan-o-noi-bat"] or ''!!}</h2></a>
        <p class="i1037 " >@site("doan-mo-ta-phan-o-noi-bat")</p>
      </div>
      @endif
      <div class="i1038 row text-center wow fadeInUp">
        @for ($i = 1; $i < 9; $i++)
        <div class="i1039 col-md-3">
          <div class="i1040 icon-box effect medium center">
            <div class="i1041 icon"> <a class="i1042 "  href="{!!$site["link-chuyen-den-khi-click-anh-icon-o-noi-bat-".$i] or ''!!}"><img class="i1043 "  src="{!!$site["anh-icon-o-noi-bat-".$i] or ''!!}"></a> </div>
            <h3 class="i1044 matchHeight3">{!!$site["tieu-de-o-noi-bat-".$i] or ''!!}</h3>
            <p class="i1045 matchHeight4">{!!$site["noi-dung-o-noi-bat-".$i] or ''!!}</p>
          </div>
        </div>
        @endfor
      </div>
    </div>
  </section>