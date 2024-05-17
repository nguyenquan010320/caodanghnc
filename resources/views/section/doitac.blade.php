<section class="productCategory background-grey doitac-section">
  <div class=container>
    <div class="heading heading-center">
      <h2>@site('tieu-de-doi-tac')</h2>
      <p>@site('mo-ta-doi-tac')</p>
    </div>
    <div class="shop">
      <div class="carousel" data-items="5" data-items-xs="2" data-items-xxs="2" data-margin="30" data-loops=false data-autoplay=true data-dots=false>
        @for ($i = 1; $i < 121; $i++)
        @if(!empty($site["anh-logo-doi-tac-".$i."-300x200"]))
        <a href="{!!$site["link-tro-den-khi-click-logo-doi-tac-".$i]!!}">
          <span style="background-image: url('{!!$site["anh-logo-doi-tac-".$i."-300x200"]!!}');background-size: contain; background-position: center; background-repeat: no-repeat;">&nbsp;</span>
          <p>{!!$site["ten-doi-tac-".$i]!!}</p>
        </a>@endif
        @endfor
      </div>
    </div>
  </div>
</section>
<section class="productCategory background-grey doitac-section">
  <div class=container>
    <div class="heading heading-center">
      <h2>@site('tieu-de-khach-hang')</h2>
      <p>@site('mo-ta-khach-hang')</p>
    </div>
    <div class="shop">
      <div class="carousel" data-items="5" data-items-xs="2" data-items-xxs="2" data-margin="30" data-loops=false data-autoplay=true data-dots=false>
        @for ($i = 1; $i < 121; $i++)
        @if(!empty($site["anh-logo-khach-hang-".$i."-300x200"]))
        <a href="{!!$site["link-tro-den-khi-click-logo-khach-hang-".$i]!!}">
          <span style="background-image: url('{!!$site["anh-logo-khach-hang-".$i."-300x200"]!!}');background-size: contain; background-position: center; background-repeat: no-repeat;">&nbsp;</span>
          <p>{!!$site["ten-khach-hang-".$i]!!}</p>
        </a>@endif
        @endfor
      </div>
    </div>
  </div>
</section>