@ifturnon('chay-banner-khuyen-mai')
@if(
  (isset($site['chi-hien-o-trang-chu']) && $site['chi-hien-o-trang-chu']=='1' && Request::is('/'))
  || !isset($site['chi-hien-o-trang-chu']) 
  || $site['chi-hien-o-trang-chu']!='1'
  )
<div class="modal fade" id="modalSale" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <div class="modal-body p-0">
        <a href="@site('link-chuyen-den-khi-click-banner-khuyen-mai')" class="bannerLink" target="_blank">
          @ifnotempty('anh-banner-khuyen-mai')
          <img src="@site('anh-banner-khuyen-mai')">
          @endif
          @ifnotempty('doan-chu-tren-banner-khuyen-mai')
          <div class="kmtext">@site('doan-chu-tren-banner-khuyen-mai')</div>
          @endif
        </a>
        @ifturnon('hien-form-dien-thong-tin-tren-banner-khuyen-mai')
        <form class="form-inline p-10 p-t-0" data-element="mail-to-admin">
          <div class="form-group">
            <input type="text" class="form-control name" name="Name" value="" placeholder="@lang('Tên của bạn')">
          </div>
          <div class="form-group">
            <input type="text" class="form-control phone" name="Phone" value="" placeholder="@lang('Số điện thoại')">
          </div>
          <div class="form-group">
            <input type="hidden" name="mail-to" value="@site('dia-chi-email-nhan-thong-bao')">
            <input type="hidden" name="subject" value="@lang('Điền thông tin trên banner khuyến mãi')">
            <button type="button" class="btn btn-pinterest btn-send-mail" data-action="@lang('Khách hàng điền thông tin trên banner khuyến mãi')">@lang('Đăng kí')</button>
          </div>
        </form>
        @endif
      </div>
    </div>
  </div>
</div>
{{-- Nút bấm hotline kèm nút khuyến mãi --}}
{{-- <div class="saleButton hidden-xs">
  <a href="javascript:void(0)" onclick="alert('Vui lòng gọi số @site('so-hotline') để được tư vấn miễn phí!')" class="btn btn-action btn-pinterest" data-action="Click nút hotline"><span>TƯ VẤN MIỄN PHÍ</span> <span>@site('so-hotline')</span></a>
  <a href="javascript:void(0)" onclick="$('#modalSale').modal('show');" class="btn btn-action btn-facebook" data-action="Click nút nhận khuyến mãi"><span>Đăng kí nhận</span> <span>Giảm giá 5%</span></a>
</div> --}}

{{-- Luôn hiện khi vào trang --}}
@ifturnon('luon-hien-khi-vao-trang')
<script type="text/javascript">
  $(document).ready(function() {
    $('#modalSale').modal('show');
  });
</script>
@else
{{-- Chỉ hiện 1 lần 1 ngày --}}
<script type="text/javascript">
  $(document).ready(function() {
    if($.cookie("closeModalSale")==undefined){
      $('#modalSale').modal('show');
    }
    $('#modalSale').on('hidden.bs.modal', function () {
      $.cookie('closeModalSale', '1', { expires: 1, path: '/' });
    });
  });
</script>
@endif
@endif
@endif