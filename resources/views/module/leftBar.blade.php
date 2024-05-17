@ifnotempty('hien-thanh-lien-he-nhanh')
<div class="left-bar hidden-xs hidden-sm hidden-md">
  @ifnotempty('so-zalo')<a href="#" style="background:url(/public/frontend/image/zalo.jpg)"><span>Zalo: @site('so-zalo')</span></a>@endif
  @ifnotempty('link-skype')<a href="#" style="background:url(/public/frontend/image/skype.jpg)"><span>Skype: @site('link-skype')</span></a>@endif
  @ifnotempty('so-wechat')<a href="#" style="background:url(/public/frontend/image/wechat.jpg)"><span>Wechat: @site('so-wechat')</span></a>@endif
@ifnotempty('link-facebook')<a href="@site('link-facebook')" style="background:url(/public/frontend/image/face.jpg)"><span>@site('link-facebook')</span></a>@endif
  @ifnotempty('so-hotline')<a href="tel:@site('so-hotline')" style="background:url(/public/frontend/image/phone.jpg)"><span>@lang('Hotline:') @site('so-hotline')</span></a>@endif
  <a href="#" style="background:url(/public/frontend/image/truck.jpg)"><span>@lang('Miễn phí vận chuyển')</span></a>
</div>
@endif