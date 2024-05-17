<section class="i1021 background-grey gioithieu-section">
	<div class="i1022 container">
		<div class="i1023 row">
			<div class="i1024 col-md-6 heading text-left p-r-40 m-b-0 wow fadeInUp">
				<h2 class="i1025 m-b-20">{!!$site['tieu-de-gioi-thieu-trang-chu'] or '' !!}</h2>
				@site('doan-gioi-thieu-trang-chu')
				<p class="i1026 " ><a href="tel:@site('so-hotline')" class="i1027 btn btn-my btn-action" data-action="@lang('Khách hàng bấm nút gọi hotline trên trang:')"><i class="i1028 fa fa-phone"></i> @site('so-hotline')</a><a href="{!!$post[4]['link'] or ''!!}" class="i1029 btn btn-my">@lang('Xem chi tiết')</a></p>
			</div>
			<div class="i1030 col-md-6 wow fadeInUp p-t-20" >
				@if(empty($site['link-video-youtube-gioi-thieu-trang-chu']))
				<img class="i1031 "  src="@site('anh-gioi-thieu-trang-chu')" style="width: 100%">
				@else
				{!!Helper::youtube($site['link-video-youtube-gioi-thieu-trang-chu'])!!}
				@endif
			</div>
		</div>
	</div>
</section>