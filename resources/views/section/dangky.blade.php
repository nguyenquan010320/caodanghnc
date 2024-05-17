<section class="text-light timkiem dangky background-overlay" style="background: url('@ifnotempty('anh-nen-cuoi-trang')@site('anh-nen-cuoi-trang')@else/upload/bg2.jpg @endif'); background-size: cover;background-position: center;">
  <div class="container">
    <div class="heading heading-center text-center wow fadeInUp">
      <h2 class="uppercase">@lang('Điền thông tin nhận tư vấn và báo giá ngay')</h2>
      <p>@lang('Vui lòng điền thông tin dưới đây, chúng tôi sẽ liên hệ lại báo giá cho quý khách.')</p>
    </div>
    <form class="form-inline wow fadeInUp" data-element="mail-to-admin">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" class="form-control Name" name="Name" value="" placeholder="@lang('Họ và tên')">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" class="form-control Phone" name="Phone" value="" placeholder="@lang('Số điện thoại')">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" class="form-control" name="Email" value="" placeholder="@lang('Email/Facebook nếu có')">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <input type="hidden" name="mail-to" value="@site('dia-chi-email-nhan-thong-bao')">
            <input type="hidden" name="subject" value="@lang('Đăng ký nhận báo giá')">
            <input type="hidden" name="Note" value="@lang('Điền thông tin nhận tư vấn và báo giá ngay')">
            <button type="button" class="btn btn-send-mail" data-action="@lang('Đăng ký nhận tư vấn dịch vụ miễn phí')">@lang('Đăng ký báo giá')</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>