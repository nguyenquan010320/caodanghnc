@extends('layouts.backend')
@section('content')
<section class="content-header">
	<h1>Upload Excel</h1>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<form role="form">
				<div class="box-body">
					<div class="form-group"><label>File excel</label>
						<div class="input-group">
							<input type="text" class="form-control file-excel" id="file-excel" name="excel" value="" placeholder="Chưa có file nào">
							<div class="input-group-btn"><a href="javascript:void(0)" class="btn btn-info file-btn"><i class="fa fa-folder-open"></i> Chọn file</a></div>
						</div>
						<p class="help-block">Định dạng .xls hoặc .xlsx.</p>
						<p>
							<button type="button" class="btn btn-primary excel-btn"><i class="fa fa-eye"></i> Xem dữ liệu</button>
							<button type="button" class="btn btn-default btn-nhap-vao"><i class="fa fa-sign-in"></i> Nhập vào hệ thống</button>
							<a href="/public/mauexcel.xlsx" class="btn btn-default" download="Mau_Excel.xlsx"><i class="fa fa-download"></i> Tải file Excel mẫu</a>
						</p>
						<p><b><u>Lưu ý:</u> Tên file viết liền không dấu, không ký tự đặc biệt, không có dấu cách, nếu không hệ thống sẽ không thể cập nhật.<br>Các dòng không có mã vận đơn sẽ không được nhập vào hệ thống.</b></p>
					</div>
				</div>
			</form>

			<div class="dulieu" style="padding: 10px">
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		// $('body').on('change', '.file-excel', function(event) {
		// 	if($(this).val()!=null && $(this).val()!=undefined && $(this).val()!=''){
		// 		$('.excel-btn').prop('disabled', true);
		// 	}else{
		// 		$('.excel-btn').prop('disabled', false);
		// 	}
		// });
		$('body').on('click', '.excel-btn', function(event) {
			var fileExcel = $('.file-excel').val();
			if(fileExcel!=null && fileExcel!=undefined && fileExcel!=''){
				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "{{action('AdminController@adUploadExcelAjax')}}",
					data: ({"_token": "{{ csrf_token() }}",fileExcel:fileExcel}),
					success: function(data){
						$('.dulieu').html(data);
					}
				});
			}else{
				alert('Bạn cần tải lên và chọn file excel!')
			}
		});
		$('body').on('click', '.btn-nhap-vao', function(event) {
			var fileExcel = $('.file-excel').val();
			if(fileExcel!=null && fileExcel!=undefined && fileExcel!=''){
				if(confirm('Bạn chắc chắn nhập file này vào hệ thống?')){
					$.ajax({
						dataType: "html",
						type: "POST",
						evalScripts: true,
						url: "{{action('AdminController@adUploadExcelAjax')}}",
						data: ({"_token": "{{ csrf_token() }}",fileExcel:fileExcel,nhapvao:1}),
						success: function(data){
							alert('Nhập thành công!');
						}
					});
				}
			}else{
				alert('Bạn cần tải lên và chọn file excel!')
			}
		});
	});
</script>
@endsection
