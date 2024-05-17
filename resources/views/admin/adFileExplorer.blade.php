@extends('layouts.backend')
@section('content')
<section class="content-header">
	<h1>
		@lang('Quản lý file')
		<a class="btn btn-info btn-sm" style="float: right;" href="/">@lang('Xem trang web') <i class="fa fa-arrow-right"></i></a>
	</h1>
</section>
<section class="content">
	<iframe src="/public/filemanager/dialog.php?type=2&amp;" style="width: 100%;height: 100%;border: none;min-height: 600px"></iframe>
	<style type="text/css">
		html,body,.content {
			height: 100%;
		}
	</style>
</section>
@endsection