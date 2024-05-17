@extends('layouts.frontend')
@section('content')
@include('module.khoatruycap')
@include('module.breadcumb')
<script class="c517  i348 "  type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "NewsArticle",
		"mainEntityOfPage": 
		{
			"@type": "WebPage",
			"@id": "{!!$domain or '' !!}{!!$s['link'] or ''!!}"
		},
		"headline": "{!!str_replace('"','',trim(strip_tags($s['title'])))!!}",
		"image": [
		"{!!$domain or '' !!}{!!$s['img'] or ''!!}"
		],
		"datePublished": "{!!$s['created_at'] or ''!!}",
		"dateModified": "{!!$s['updated_at'] or $s['created_at'] or ''!!}",
		"author": 
		{
			"@type": "Person",
			"name": "{!!env('DB_DATABASE')!!}"
		},
		"publisher": 
		{
			"@type": "Organization",
			"name": "{!!env('COMPANY_NAME')!!}",
			"logo": 
			{
				"@type": "ImageObject",
				"url": "{!!$domain or '' !!}@site('anh-logo')"
			}
		},
		"description": "{!!str_replace('"','',trim(strip_tags($s['desc'])))!!}"
	}
</script>
@if($s["f1"] == "1") 
<section class="c518 c72 "  id="s1" style='background-image:url("{!! $s["f2"] or "" !!}");background-size: cover;background-position: center;'>
	<p class="c519 c73x visible-xs visible-sm"><img class="c520 c73x2" src="{!! $s["f3"] or "" !!}"></p>
	<div class="c521 c73 {{-- container --}}">
		<div class="c522 c74 row">
			<div class="c523 c75 col-md-4 col-md-offset-8  wow bounceInRight">
				@include('module.formdangky')
			</div>
		</div>
	</div>
</section>
@endif
@if($s["f4"] == "1") 
<section class="c524 "  id="" style='background-image:url("{!! $post[36]["f5"] or "" !!}");background-size: cover;background-position: center;'>
	<div class="c525 container">
		<div class="c526 heading wow fadeInUp " style='background-image:url("{!! $post[36]["f6"] or "" !!}");background-size: contain;background-position: center;background-repeat: no-repeat;'>
			<h2 class="c527 " >{!! $s["f7"] or "" !!}</h2>
			<p class="c529 " >{!! $s["f8"] or "" !!}</p>
		</div>
		<div class="c530 wow fadeInUp  " >
			<div class="c531 row">
				<div class="c532 col-md-4">
					<div class="c533 matchHeight" >
						<p class="c534 "><img class="c535 " src="{!! $post[36]["f9"] or "" !!}"></p>
						<p class="c536 "><img class="c537 " src="{!! $s["f10"] or "" !!}"></p>  
					</div>
				</div>
				<div class="c538 col-md-8">
					<div class="c539 matchHeight" >
						<div class="c539x">{!! $s["f11"] or "" !!}</div>
						<p class="c545 " ><a href="javascript:void(0)"  class="c546 btn btn-mua btn-my" data-name="{!!$s['title'] or ''!!}">{!! $post[36]["f12"] or "" !!} <img class="c547 "  src="{!! $post[36]["f13"] or "" !!}"></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endif
@if($s["f14"] == "1") 
<section class="c548 "  id="" style='background-image:url("{!! $post[36]["f15"] or "" !!}");background-size: cover;background-position: center;'>
	<div class="c549 container">
		<div class="c550 heading wow fadeInUp " style='background-image:url("{!! $post[36]["f16"] or "" !!}");background-size: contain;background-position: center;background-repeat: no-repeat;'>
			<h2 class="c551 " >{!! $s["f17"] or "" !!}</h2>
		</div>
		<div class="c553 row">
			<div class="c554 col-md-5 wow bounceInLeft ">
				<div class="c555 " >
					<p class="c556 "><img class="c557 " src="{!! $s["f18"] or "" !!}"></p> 
				</div>
			</div>
			<div class="c558 col-md-7 wow bounceInRight ">
				<div class="c559 " >
					<div class="c560x ">{!! $s["f19"] or "" !!}</div>
					<p class="c561 c565" ><img class="c562 c566" src="{!! $post[36]["f20"] or "" !!}">{!! $s["f21"] or "" !!}</p>
					<div class="c564 " >
						<p class="c565 " ><img class="c566 " src="{!! $post[36]["f22"] or "" !!}">{!! $s["f23"] or "" !!}</p>
						<div class="c565x ">{!! $s["f24"] or "" !!}</div>
					</div>
					<p class="c576 " ><a href="javascript:void(0)"  class="c577 btn btn-mua btn-my" data-name="{!!$s['title'] or ''!!}">{!! $post[36]["f25"] or "" !!} <img class="c578 "  src="{!! $post[36]["f26"] or "" !!}"></a></p>
				</div>
			</div>
		</div>
	</div>
</section>

@endif
@if($s["f27"] == "1") 
<section class="c579 "  id="" style='background-image:url("{!! $post[36]["f28"] or "" !!}");background-size: cover;background-position: center;'>
	<div class="c580 container">
		<div class="c581 heading wow fadeInUp " style='background-image:url("{!! $post[36]["f29"] or "" !!}");background-size: contain;background-position: center;background-repeat: no-repeat;'>
			<h2 class="c582 " >{!! $s["f30"] or "" !!}</h2>
		</div>
		<p class="c584 c360  wow fadeInUp " >
			<a class="c585 c361 active" data-id="1"  href="javascript:void(0)">{!! $s["f31"] or "" !!}</a>
			<a class="c586 c361 " data-id="2"  href="javascript:void(0)">{!! $s["f32"] or "" !!}</a>
		</p>
		<div class="c587 c364x wow fadeInUp ">
			<div class="c588 c364 active c364-1">
				<div class="c590 c218 row ">
					<div class="c591 c219 col-md-6 {{-- @if(empty($s["f40"])) col-md-offset-2 @endif --}} wow fadeInUp ">
						<a class="c592 "  href="javascript:void(0)">
							<div class="c593 c220 matchHeight" >
								<p class="c594 c221 "><span style='background-image:url("{!! $s["f33"] or "" !!}");background-size: cover;background-position: center;' class="c595 c222 "></span></p> 
								<p class="c596 c223 p5 matchHeight1" >{!! $s["f34"] or "" !!}</p>
								<div class="c597 c166 matchHeight2" >{!! $s["f35"] or "" !!}</div>
							</div>
						</a>
					</div>
					{{-- <div class="c603 c219 col-md-4 wow fadeInUp ">
						<a class="c604 "  href="javascript:void(0)">
							<div class="c593 c220 matchHeight" >
								<p class="c606 c221 "><span style='background-image:url("{!! $s["f36"] or "" !!}");background-size: cover;background-position: center;' class="c607 c222 "></span></p> 
								<p class="c608 c223 p6 matchHeight1" >{!! $s["f37"] or "" !!}</p>
								<div class="c609 c166 " >{!! $s["f38"] or "" !!}</div>
							</div>
						</a>
					</div> --}}
					<div class="c614 c219 col-md-6 wow fadeInUp ">
						<a class="c615 "  href="javascript:void(0)">
							<div class="c593 c220 matchHeight" >
								<p class="c617 c221 "><span style='background-image:url("{!! $s["f39"] or "" !!}");background-size: cover;background-position: center;' class="c618 c222 "></span></p> 
								<p class="c619 c223 p7 matchHeight1" >{!! $s["f40"] or "" !!}</p>
								<div class="c620 c166 matchHeight2" >{!! $s["f41"] or "" !!}</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="c589 c364 c364-2">
				<div class="c590 c218 row ">
					<div class="c591 c219 col-md-6 {{-- @if(empty($s["f48"])) col-md-offset-2 @endif --}} wow fadeInUp ">
						<a class="c592 "  href="javascript:void(0)">
							<div class="c593 c220 matchHeight" >
								<p class="c594 c221 "><span style='background-image:url("{!! $s["f42"] or "" !!}");background-size: cover;background-position: center;' class="c595 c222 "></span></p> 
								<p class="c596 c223 p5 matchHeight1" >{!! $s["f43"] or "" !!}</p>
								<div class="c597 c166 matchHeight2" >{!! $s["f44"] or "" !!}</div>
							</div>
						</a>
					</div>
					{{-- <div class="c603 c219 col-md-4 wow fadeInUp ">
						<a class="c604 "  href="javascript:void(0)">
							<div class="c593 c220 matchHeight" >
								<p class="c606 c221 "><span style='background-image:url("{!! $s["f45"] or "" !!}");background-size: cover;background-position: center;' class="c607 c222 "></span></p> 
								<p class="c608 c223 p6 matchHeight1" >{!! $s["f46"] or "" !!}</p>
								<div class="c609 c166 " >{!! $s["f47"] or "" !!}</div>
							</div>
						</a>
					</div> --}}
					<div class="c614 c219 col-md-6 wow fadeInUp ">
						<a class="c615 "  href="javascript:void(0)">
							<div class="c593 c220 matchHeight" >
								<p class="c617 c221 "><span style='background-image:url("{!! $s["f48"] or "" !!}");background-size: cover;background-position: center;' class="c618 c222 "></span></p> 
								<p class="c619 c223 p7 matchHeight1" >{!! $s["f49"] or "" !!}</p>
								<div class="c620 c166 matchHeight2" >{!! $s["f50"] or "" !!}</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<p class="c625  wow fadeInUp " >
			<a href="javascript:void(0)" class="c626 btn btn-my btn-mua" data-name="{!!$s['title'] or ''!!}">{!! $post[36]["f51"] or "" !!} <img class="c627 "  src="{!! $post[36]["f52"] or "" !!}"></a>
			<a href="/" class="c628 btn btn-my" data-name="{!!$s['title'] or ''!!}">{!! $post[36]["f53"] or "" !!} <img class="c629 "  src="{!! $post[36]["f54"] or "" !!}"></a>
		</p>
	</div>
</section>

@endif
@if($s["f55"] == "1") 
<section class="c630 "  id="">
	<div class="c631 container">
		<div class="c632 row">
			<div class="c633 col-md-5 wow bounceInLeft ">
				<div class="c634 " >
					<p class="c635 "><img class="c636 " src="{!! $post[36]["f56"] or "" !!}"></p> 
					<p class="c637 "><img class="c638 " src="{!! $s["f57"] or "" !!}"></p> 
				</div>
			</div>
			<div class="c639 col-md-7 wow bounceInRight ">
				<div class="c640 " >
					<p class="c641 "><img class="c642 " src="{!! $post[36]["f58"] or "" !!}"></p>
					<p class="c643 "><img class="c644 " src="{!! $post[36]["f59"] or "" !!}">{!! $s["f60"] or "" !!}</p>
					<div class="c646">
						<div class="c648 " >
							<p class="c649 " >{!! $s["f61"] or "" !!}</p>
							<div class="c650 " >{!! $s["f62"] or "" !!}</div>
						</div>
						<p class="c655 "><img class="c656 " src="{!! $post[36]["f63"] or "" !!}"></p> 
					</div>
					<div class="c646">
						<div class="c648 " >
							<p class="c649 " >{!! $s["f64"] or "" !!}</p>
							<div class="c650 " >{!! $s["f65"] or "" !!}</div>
						</div>
						<p class="c655 "><img class="c656 " src="{!! $post[36]["f66"] or "" !!}"></p> 
					</div>
				</div>
			</div>
		</div>
		<div class="c666 row">
			<div class="c667 col-md-6 wow bounceInLeft ">
				<div class="c668 " >
					<p class="c669 c641 "><img class="c670 c642 " src="{!! $post[36]["f67"] or "" !!}"></p>
					<p class="c643 "><img class="c644 " src="{!! $post[36]["f68"] or "" !!}">{!! $s["f69"] or "" !!}</p>
					<div class="c643x ">
						@if(!empty($s["f71"]))<p class="c674 "><img class="c675 " src="{!! $post[36]["f70"] or "" !!}">{!! $s["f71"] or "" !!}</p> @endif
						@if(!empty($s["f73"]))<p class="c674 "><img class="c675 " src="{!! $post[36]["f70"] or "" !!}">{!! $s["f73"] or "" !!}</p> @endif
						@if(!empty($s["f75"]))<p class="c674 "><img class="c675 " src="{!! $post[36]["f70"] or "" !!}">{!! $s["f75"] or "" !!}</p> @endif
						@if(!empty($s["f77"]))<p class="c674 "><img class="c675 " src="{!! $post[36]["f70"] or "" !!}">{!! $s["f77"] or "" !!}</p> @endif
						@if(!empty($s["f79"]))<p class="c674 "><img class="c675 " src="{!! $post[36]["f70"] or "" !!}">{!! $s["f79"] or "" !!}</p> @endif
						@if(!empty($s["f81"]))<p class="c674 "><img class="c675 " src="{!! $post[36]["f70"] or "" !!}">{!! $s["f81"] or "" !!}</p> @endif
					</div>
					<p class="c678 " ><a href="javascript:void(0)"  class="c679 btn btn-my btn-mua" data-name="{!!$s['title'] or ''!!}">{!! $post[36]["f82"] or "" !!} <img class="c680 "  src="{!! $post[36]["f83"] or "" !!}"></a></p>
				</div>
			</div>
			<div class="c681 col-md-6 wow bounceInRight ">
				<div class="c682 " >
					<p class="c683 "><img class="c684 " src="{!! $s["f84"] or "" !!}"></p> 
				</div>
			</div>
		</div>
	</div>
</section>
@endif
@if($s["f85"] == "1") 
<section class="c685 c395 "  id="s8" style='background-image:url("@site("anh-frontend-1712829878-80")");background-size: cover;background-position: center;'>
	<div class="c686 c396 container">
		<div class="c687 c397 row">
			<div class="c688 c398 col-md-7 wow bounceInLeft ">
				<div class="c689 c399 " >
					<p class="c690 c400 "><img class="c691 c401 " src="{!! $s["f86"] or "" !!}"></p> 
					<p class="c692 c402 " >@site("tieu-de-frontend-1712829878-82")</p>
					<p class="c693 c403 " >@site("tieu-de-frontend-1712829878-83")</p>
				</div>
			</div>
			<div class="c694 c404 col-md-4 col-md-offset-1 wow bounceInRight ">
				@include('module.formdangky')
			</div>
		</div>
	</div>
</section>
@endif
@if($s["f87"] == "1") 
<section class="c695 c213 "  id="">
	<div class="c696 container">
		<div class="c697 heading wow fadeInUp "  style='background-image:url("{!! $post[36]["f88"] or "" !!}");background-size: contain;background-position: center;background-repeat: no-repeat;'>
			<h2 class="c698 " >{!! $s["f89"] or "" !!}</h2>
		</div>
		<div class="c700 c218 row ">
			@php($i=0) @foreach($relatedPost as $p) @if(in_array(23, $p['categoryParent']) && $p['id']!=$id && $i++<6)
			<div class="c701 c219 col-md-4 wow fadeInUp matchHeight">
				<a class="c702 "  href="{!!$p['link'] or ''!!}">
					<div class="c703 c220 " >
						<p class="c704 c221 "><span style='background-image:url("{!!$p['img'] or ''!!}");background-size: cover;background-position: center;' class="c705 c222 "></span></p> 
						<p class="c706 c223 p{!!$i%4!!} matchHeight1" >{!!$p['title'] or ''!!}</p>
						<div class="c707 matchHeight2" >
							{!!$p['desc_full'] or ''!!}
						</div>
						<p class="c708 c240 " ><button  class="c709 c241 btn " data-name="{!!$p['title'] or ''!!}">@site("tieu-de-frontend-1712829877-62")</button></p>
					</div>
				</a>
			</div>
			@endif @endforeach
		</div>
	</div>
</section>
@endif
@endsection