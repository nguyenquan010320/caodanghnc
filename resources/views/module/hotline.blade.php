@ifnotempty('hien-so-hotline-o-cuoi-trang')
<a href="tel:{!!preg_replace("/[^0-9]/","",$site['so-hotline'])!!}" class="btn text-light btn-hotline-noi btn-hotline-pc @ifnotempty('so-hotline-2') btn-hotline-noi-1 @endif btn-action @ifnotempty('so-hotline-3') visible-xs @endif" data-action="@lang('Khách hàng bấm nút hotline')"><span>@lang('HOTLINE')</span><span>@site('so-hotline')</span></a>
@ifnotempty('so-hotline-2')
<a href="tel:{!!preg_replace("/[^0-9]/","",$site['so-hotline-2'])!!}" class="btn text-light btn-hotline-noi btn-hotline-noi-2 btn-hotline-pc btn-action @ifnotempty('so-hotline-3') visible-xs @endif" data-action="@lang('Khách hàng bấm nút hotline 2')"><span>@lang('HOTLINE')</span><span>@site('so-hotline-2')</span></a>
@endif
@ifnotempty('so-hotline-3')
<div class="hotline-bar hidden-xs text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<p>Tư vấn trực tuyến 24/7</p>
			</div>
			<div class="col-md-3">
				<p><a href="tel:{!!preg_replace("/[^0-9]/","",$site['so-hotline'])!!}" class="btn-hotline-pc"><i class="fa fa-phone"></i> @site('so-hotline')</a></p>
			</div>
			<div class="col-md-3">
				<p><a href="tel:{!!preg_replace("/[^0-9]/","",$site['so-hotline-2'])!!}" class="btn-hotline-pc"><i class="fa fa-phone"></i> @site('so-hotline-2')</a></p>
			</div>
			<div class="col-md-3">
				<p><a href="tel:{!!preg_replace("/[^0-9]/","",$site['so-hotline-3'])!!}" class="btn-hotline-pc"><i class="fa fa-phone"></i> @site('so-hotline-3')</a></p>
			</div>
		</div>
	</div>
</div>
@endif
@endif