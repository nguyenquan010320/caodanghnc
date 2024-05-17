@if(!empty($s['keyword']))
<div class="single-post">
	<div class="post-item">
		<div class="post-tags">
			<p>
				@foreach(explode(',', $s['keyword']) as $t) @if(!empty($t))
				<a href="/tim-kiem?searchKeyword={!!mb_strtolower($t)!!}">{!!$t!!}</a>
				@endif @endforeach
			</p>
		</div>
	</div>
</div>
@endif