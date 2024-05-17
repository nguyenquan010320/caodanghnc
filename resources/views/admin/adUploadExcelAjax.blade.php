<div class="table-responsive">
	<table class="table table-bordered" style="font-size: 12px">
		@if(!empty($excel[0]))
		<tr>
			<th>STT</th>
			@foreach($excel[0] as $k=>$b) @if(!empty($k))
			<th>{!!$k!!}</th>
			@endif @endforeach
		</tr>
		@endif
		@php($i=1)
		@foreach($excel as $k=>$b)
		@if(is_array($b) && !empty($b))
		<tr>
			<td>{!!$i++!!}</td>
			@foreach($b as $kbc=>$bc) @if(!empty($kbc))
			<td>{!!$bc or ''!!}</td>
			@endif @endforeach
		</tr>
		@endif
		@endforeach
	</table>
</div>
