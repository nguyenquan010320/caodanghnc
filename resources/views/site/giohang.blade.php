@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
<section class="i437 productCategory p-b-10 p-t-10">
	<div class="i438 container">
		<div class="i439 heading m-b-0">
			<h1 class="i440 m-b-0 text-left">{!!$title!!}</h1>
			{{-- <p class="i441 text-left m-b-0">{!!$desc!!}</p> --}}
		</div>
	</div>
</section>
<hr class="i442 p-0 m-0">
<section class="i443 " >
	<div class="i444 container">
		@php($giohang = json_decode(Session::get('giohang')))
		@if(empty($giohang))
		<div class="i445 p-t-10 m-b-20 text-center">
			<div class="i446 heading-fancy heading-line text-center">
				<h4 class="i447 " >@lang('Chưa có sản phẩm nào trong giỏ.')</h4>
			</div>
			<a class="i448 btn btn-my icon-left" href="/"><span class="i449 " >@lang('Quay lại Shop')</span></a>
		</div>
		@else
		<div class="i450 shop-cart">
			<div class="i451 heading">
				<h2 class="i452 text-left">@lang('Thông tin sản phẩm')
					<a href="{!!$category[2]['link'] or ''!!}" class="i453 btn btn-my float-right hidden-xs"><i class="i454 fa fa-shopping-cart"></i> Mua thêm sản phẩm</a>
				</h2>
			</div>
			<div class="i455 table table-condensed table-striped">
				<table class="i456 table">
					<thead class="i457 " >
						<tr class="i458 " >
							<th class="i459 text-center cart-product-remove"></th>
							<th class="i460 text-center cart-product-thumbnail hidden-xs"></th>
							<th class="i461 cart-product-thumbnail hidden-xs">@lang('Sản phẩm')</th>
							@ifnotempty('truong-phan-loai-1')<th class="i462 text-center cart-product-size">@site('truong-phan-loai-1')</th>@endif
							@ifnotempty('truong-phan-loai-2')<th class="i463 text-center cart-product-color">@site('truong-phan-loai-2')</th>@endif
							@ifnotempty('truong-phan-loai-3')<th class="i464 text-center cart-product-color">@site('truong-phan-loai-3')</th>@endif
							<th class="i465 text-center cart-product-quantity">@lang('Số lượng')</th>
							<th class="i466 text-center cart-product-price text-right">@lang('Giá bán')</th>
							<th class="i467 text-center cart-product-subtotal text-right">@lang('Tổng cộng')</th>
						</tr>
					</thead>
					<tbody class="i468 " >
						@php($totalAmount = 0)
						@foreach ($giohang as $k=>$g)
						@php($g = (array) $g)
						@if(isset($g['id']) && !empty($post[$g['id']]))
						@php($p = $post[$g['id']])
						@php($price = $p['price_real'])
						@if(!empty($g['price']))
						@php($price = $g['price'])
						@endif
						<tr class="i469 visible-xs"><td class="i470 "  colspan="4"><a href="{!!$p['link'] or '' !!}" class="i471 cart-product-thumbnail-name">{!!$p['title'] or '' !!} {!!$g['type1'] or '' !!}</a></td></tr>
						<tr class="i472 " >
							<td class="i473 cart-product-remove">
								<form class="i474 "  data-element="delete-cart">
									<a href="#" class="i475 btn-xoa-gio-hang"><i class="i476 fa fa-close"></i></a>
									<input class="i477 "  type="hidden" name="delete-key" value="{!!$k!!}">
								</form>
							</td>
							<td class="i478 cart-product-thumbnail hidden-xs">
								<a class="i479 "  href="{!!$p['link'] or '' !!}">
									<img class="i480 "  src="{!!$p['img_thumb'] or '' !!}" alt="{!!$p['title'] or '' !!}"><br class="i481 " >
								</a>
							</td>
							<td class="i482 cart-product-thumbnail hidden-xs">
								<a href="{!!$p['link'] or '' !!}" class="i483 cart-product-thumbnail-name">{!!$p['title'] or '' !!} {!!$g['type1'] or '' !!}</a>
							</td>
							@ifnotempty('truong-phan-loai-1')
							<td class="i484 cart-product-description">
								@if(!empty($p['type1']))
								<form data-element="update-cart" class="i485 update-gio-hang">
									<input class="i486 "  type="hidden" name="update-key" value="{!!$k!!}">
									@php($type1s = explode(',', $p['type1']))
									<select name="type1" class="i487 select form-control">
										<option class="i488 "  value="" disabled="" selected="">@lang('Chọn') @site('truong-phan-loai-1')</option>
										@foreach ($type1s as $type1)
										<option class="i489 "  value="{!!$type1!!}" {!!(isset($g['type1']) && $g['type1']==$type1) ? 'selected=""':'' !!}>{!!$type1!!}</option>
										@endforeach 
									</select>
								</form>
								@endif
							</td>
							@endif
							@ifnotempty('truong-phan-loai-2')
							<td class="i490 cart-product-description">
								@if(!empty($p['type2']))
								<form data-element="update-cart" class="i491 update-gio-hang">
									<input class="i492 "  type="hidden" name="update-key" value="{!!$k!!}">
									@php($type2s = explode(',', $p['type2']))
									<select name="type2" class="i493 select form-control">
										<option class="i494 "  value="" disabled="" selected="">@lang('Chọn') @site('truong-phan-loai-2')</option>
										@foreach ($type2s as $type2)
										<option class="i495 "  value="{!!$type2!!}" {!!(isset($g['type2']) && $g['type2']==$type2) ? 'selected=""':'' !!}>{!!$type2!!}</option>
										@endforeach 
									</select>
								</form>
								@endif
							</td>
							@endif
							@ifnotempty('truong-phan-loai-3')
							<td class="i496 cart-product-description">
								@if(!empty($p['type3']))
								<form data-element="update-cart" class="i497 update-gio-hang">
									<input class="i498 "  type="hidden" name="update-key" value="{!!$k!!}">
									@php($type3s = explode(',', $p['type3']))
									<select name="type3" class="i499 select form-control">
										<option class="i500 "  value="" disabled="" selected="">@lang('Chọn') @site('truong-phan-loai-3')</option>
										@foreach ($type3s as $type3)
										<option class="i501 "  value="{!!$type3!!}" {!!(isset($g['type3']) && $g['type3']==$type3) ? 'selected=""':'' !!}>{!!$type3!!}</option>
										@endforeach 
									</select>
								</form>
								@endif
							</td>
							@endif
							<td class="i502 cart-product-description">
								<form data-element="update-cart" class="i503 update-gio-hang">
									<input class="i504 "  type="hidden" name="update-key" value="{!!$k!!}">
									<?php if(empty($g['quantity'])) {$g['quantity']=1;} else {$g['quantity']=preg_replace("/[^0-9]/","",$g['quantity']);} ?>
									<input type="number" name="quantity" class="i505 form-control" style="width: 100%;" value="{!!$g['quantity'] or '1'!!}">
									{{-- <select name="quantity" class="i506 select form-control">
										<option class="i507 "  value="" disabled="" selected="">@lang('Chọn số lượng')</option>
										@for ($i = 1; $i < 200; $i++)
										<option class="i508 "  value="{!!$i!!}" {!!(isset($g['quantity']) && $g['quantity']==$i) ? 'selected=""':'' !!}>{!!$i!!}</option>
										@endfor
									</select> --}}
								</form>
							</td>
							<td class="i509 cart-product-price text-right">
								<span class="i510 amount">@money($price)</span>
							</td>
							<td class="i511 cart-product-subtotal text-right">
								@php($totalAmount += ($g['quantity']*$price))
								<span class="i512 amount">@money($g['quantity']*$price)</span>
							</td>
						</tr>
						@endif @endforeach
						<tr class="i513 " >
							<td class="i514 "  colspan="2"><b class="i515 " >@lang('Tổng thanh toán')</b></td>
							<td colspan="100%" class="i516 text-right"><b class="i517 " >@money($totalAmount)</b></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		@endif
	</div>
</section>
@if(!empty($giohang))
<section class="i518 background-grey">
	<div class="i519 container">
		<div class="i520 heading">
			<h2 class="i521 text-left">@lang('Thông tin khách hàng')</h2>
		</div>
		<div class="i522 row">
			<div class="i523 col-sm-8">
				<form class="i524 "  data-element="giohang">
					@php($totalAmount = 0)
					@php($count = 1)
					@foreach ($giohang as $k=>$g)
					@php($g = (array) $g)
					@if(isset($g['id']) && !empty($post[$g['id']]))
					@php($p = $post[$g['id']])
					@php($price = $p['price_real'])
					@if(!empty($g['price']))
					@php($price = $g['price'])
					@endif
					<?php if(empty($g['quantity'])) {$g['quantity']=1;} else {$g['quantity']=preg_replace("/[^0-9]/","",$g['quantity']);} ?>
					@php($totalAmount += ($g['quantity']*$price))
					<input class="i525 "  type="hidden" name="Product {!!$count++!!}" value="{!!$p['id'] or '' !!}: {!!str_replace('"', '', $p['title'])!!}{!!(!empty($g['type1'])) ? ' - '.$g['type1']:''!!}{!!(!empty($g['type2'])) ? ' - '.$g['type2']:''!!}{!!(!empty($g['type3'])) ? ' - '.$g['type1']:''!!} / Quantity: {!!$g['quantity'] or ''!!} / Price: @money($price)">
					@endif @endforeach
					<input class="i526 "  type="hidden" name="Amount" value="@money($totalAmount)">
					<div class="i527 row">
						<div class="i528 col-sm-4">
							<div class="i529 form-group"><label class="i530 " >@lang('Tên của bạn')*</label><input type="text" class="i531 form-control name" name="Name" value=""></div>
						</div>
						<div class="i532 col-sm-4">
							<div class="i533 form-group"><label class="i534 " >@lang('Điện thoại')*</label><input type="text" class="i535 form-control phone" name="Phone" value=""></div>
						</div>
						<div class="i536 col-sm-4">
							<div class="i537 form-group"><label class="i538 " >@lang('Email nếu có')</label><input type="text" class="i539 form-control email" name="Email" value=""></div>
						</div>
					</div>
					<div class="i540 form-group"><label class="i541 " >@lang('Địa chỉ nhận hàng')</label><input type="text" class="i542 form-control" name="Address"></div>
					<div class="i543 form-group"><label class="i544 " >@lang('Hình thức thanh toán')</label>
						<select class="i545 form-control" name="Payment">
							<option class="i546 "  value="@lang('Thanh toán khi nhận hàng (COD)')">@lang('Thanh toán khi nhận hàng (COD)')</option>
							<option class="i547 "  value="@lang('Thanh toán chuyển khoản')">@lang('Thanh toán chuyển khoản')</option>
							{{-- <option class="i548 "  value="@lang('Thanh toán online bằng thẻ')">@lang('Thanh toán online bằng thẻ')</option> --}}
						</select>
					</div>
					<div class="i549 form-group"><label class="i550 " >@lang('Ghi chú')</label>
						<textarea class="i551 form-control" name="Note"></textarea>
					</div>
					<input class="i552 "  type="hidden" name="mail-to" value="@site('dia-chi-email-nhan-thong-bao')">
					<input class="i553 "  type="hidden" name="subject" value="@lang('Đặt hàng trên trang giỏ hàng')">
					<input type="hidden" class="i554 utm" name="utm" value="">
					<input type="hidden" class="i555 device" name="device" value="">
					<p class="i556 text-center m-t-10"><button type="button" class="i557 btn btn-my btn-send-mail" data-action="@lang('Khách hàng đặt hàng trên form đặt hàng')">@lang('Đặt hàng')</button></p>
				</form>
			</div>
			<div class="i558 col-sm-4">
				<div class="i559 chi-tiet-bai-viet">
					{!!$s['desc_full'] or '' !!}
				</div>
			</div>
		</div>
	</div>
</section>
@endif
@endsection
