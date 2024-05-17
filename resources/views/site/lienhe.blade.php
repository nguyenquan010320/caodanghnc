@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
<section class="i289 p-t-40 lienhe">
	<div class="i290 container">
		<div class="i291 heading heading-center m-b-20">
			<h1 class="i292 m-b-40">{!!$title!!}</h1>
		</div>
		<div class="i293 row">
			<div class="i294 col-md-6">
				<div class="i295 widget clearfix widget-contact-us m-b-10">
					<h2 class="i296 widget-title p-t-10 m-b-20" style="">@lang('Thông tin liên hệ')</h2>
					<div class="i297 chi-tiet-bai-viet">
						{!!$s['desc_full'] or '' !!}
					</div>
					@if(Helper::checkEmptyString($s['desc_full']))
					@site('doan-thong-tin-lien-he')
					@endif
				</div>
			</div>
			<div class="i298 col-md-6">
				<div class="i299 widget clearfix widget-contact-us m-b-10">
					<h2 class="i300 widget-title p-t-10 m-b-20" style="">@lang('Gửi tin nhắn và góp ý')</h2>
					<form class="i301 widget-contact-form" data-element="mail-to-admin">
						<div class="i302 form-group m-b-10">
							{{-- <label class="i303 "  for="name">Tên của bạn</label> --}}
							<input type="text" name="Name" class="i304 form-control name" placeholder="@lang('Tên của bạn')">
						</div>
						<div class="i305 form-group m-b-10">
							{{-- <label class="i306 "  for="phone">Số điện thoại</label> --}}
							<input type="text" name="Phone" class="i307 form-control phone" placeholder="@lang('Số điện thoại')">
						</div>
						<div class="i308 form-group m-b-10">
							{{-- <label class="i309 "  for="email">Email</label> --}}
							<input type="email" name="Email" class="i310 form-control email" placeholder="@lang('Email')">
						</div>
						<div class="i311 form-group  m-b-10">
							{{-- <label class="i312 "  for="message">Lời nhắn</label> --}}
							<textarea type="text" name="Note" rows="3" class="i313 form-control" placeholder="@lang('Lời nhắn')"></textarea>
						</div>
						<div class="i314 form-group text-center">
							<input class="i315 "  type="hidden" name="mail-to" value="@site('dia-chi-email-nhan-thong-bao')">
							<input class="i316 "  type="hidden" name="subject" value="@lang('Liên hệ và góp ý')">
							<input type="hidden" class="i317 utm" name="utm" value="">
							<input type="hidden" class="i318 device" name="device" value="">
							<button class="i319 btn btn-my btn-send-mail" data-action="@lang('Khách hàng gửi thông tin từ trang liên hệ')" type="button" style="width: 100%">@lang('Gửi tin nhắn')</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@if(!empty($site["lat-google-maps"]) && !empty($site["long-google-maps"]))
<section class="i320 p-0">
	<div class="i321 "  id=myMap style="height: 350px"></div>
</section>
<script class="i322 "  src=https://maps.googleapis.com/maps/api/js?key=></script>
<script class="i323 "  type=text/javascript>
	$(document).ready(function() {
		var c = 21.179591,
		g = 105.946374,
		f = 16;
		var a = "/public/frontend/image/pin.png";
		var j = [{
			stylers: [{hue: "#363e50"}, {saturation: 10}, {gamma: 2.15}, {lightness: 12}]
		}];
		var h = {
			center: new google.maps.LatLng(c, g),
			zoom: f,
			panControl: true,
			zoomControl: true,
			mapTypeControl: true,
			streetViewControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false,
			styles: j
		};
		var i = new google.maps.Map(document.getElementById("myMap"), h);
		var e = new google.maps.Marker({
			position: new google.maps.LatLng(c, g),
			map: i,
			visible: true,
			icon: a
		});
		var d = '<div class="i324 "  id="mapcontent"><p class="i325 "  style="float: left;line-height: 21px; margin:0"><b class="i326 " >@site('tieu-de-trang')</b><br class="i327 " >Hotline: @site('so-hotline')</p></div>';
		var b = new google.maps.InfoWindow({
			maxWidth: 500,
			content: d
		});
		google.maps.event.addListener(e, "click", function() {
			b.open(i, e)
		});
		google.maps.event.trigger(e, 'click');

		setTimeout(function() {
			$('#myMap > div:nth-child(2)').hide();
		},1000);
	});
</script>
@elseif(!empty($site["ma-nhung-ban-do-google-maps"]))
<section class="i328 p-0">
	<div class="i329 google-maps p-0" style="height: 300px">@site('ma-nhung-ban-do-google-maps')</div>
</section>
@endif
@endsection
