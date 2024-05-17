@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
<section class="i832 ">
	<div class="i833 container">
		{!!$s['desc_full'] or '' !!}
		<p class="i834 " style="font-size: 17px;text-align: center;">@lang('Quý khách sẽ được tự động chuyển về trang trước trong') <span id="countdown">5</span> @lang('giây')</p>
		<script type="text/javascript">/*<![CDATA[*/var seconds=10;function countdown(){seconds=seconds-1;if(seconds<0){history.back();}else{document.getElementById("countdown").innerHTML=seconds;window.setTimeout("countdown()",1000)}}countdown();/*]]>*/</script>
	</div>
</section>
@endsection
