<div class="i1064 modal fade" id="modalForm" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true">
  <div class="i1065 modal-dialog">
    <form class="i1066 modal-content" data-element="mail-to-admin">
      <div class="i1070 modal-body">
        <button type="button" class="i1068 close" data-dismiss="modal" aria-hidden="true">×</button>
        @include('module.formdangky')
      </div>
    </form>
  </div>
</div>
{{-- <div class="i1104 modal fade" id="modalImg" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true">
  <div class="i1105 modal-dialog">
    <div class="i1106 modal-content" style="padding: 0;background: transparent;box-shadow: none;border: none;">
      <div class="i1107 modal-body" style="padding: 0;">
        <p class="i1108 text-center" style="margin: 0;padding: 0;width: fit-content;margin: auto;position: relative;">
          <button type="button" class="i1109 close" data-dismiss="modal" aria-hidden="true" style="position: absolute;opacity: 1;top: -4px;right: 5px;z-index: 2;color: #fff">×</button>
          <img class="i1110 "  src="" id="modalImgSrc" alt="images">
        </p>
      </div>
    </div>
  </div>
</div> --}}
<div class="i1111 modal fade" id="modalTaive" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true">
  <div class="i1112 modal-dialog">
    <form class="i1113 modal-content" data-element="mail-to-admin">
      <button type="button" class="i1114 close" data-dismiss="modal" aria-hidden="true">×</button>
      <div class="i1115 modal-body">
       <p class="i1116 a20 ">Tải về tài liệu</p>
       <form class="i1117 a21 " data-element="mail-to-admin">
         <div class="i1118 a22 form-group">
           <input type="text" aria-required="true" name="Họ và tên" class="i1119 a23 form-control required name" placeholder="Họ và tên">
         </div>
         <div class="i1120 a24 form-group">
           <input type="text" aria-required="true" name="Số điện thoại" class="i1121 a25 form-control required phone" placeholder="Số điện thoại">
         </div>
         <div class="i1122 a26 form-group">
           <input type="email" aria-required="true" name="email" class="i1123 a27 form-control required email" placeholder="Email">
         </div>
         <div class="i1124 a28 form-group ">
           <input class="i1125 "  type="hidden" name="mail-to" value="@site('dia-chi-email-nhan-thong-bao')">
           <input type="hidden" class="i1126 a29 utm" name="utm" value="">
           <input type="hidden" class="i1127 a30 device" name="device" value="">
           <button type="button" class="i1128 a31 btn btn-my btn-send-mail btn-link-tai" data-taive=""><i class="i1129 fa fa-download"></i> Tải về tài liệu</button>
         </div>
       </form>
      </div>
    </form>
  </div>
</div>
<div class="i1130 modal fade" id="modalHotline" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true">
  <div class="i1131 modal-dialog modal-sm">
    <form class="i1132 modal-content" data-element="mail-to-admin">
      <div class="i1133 modal-header">
        <button type="button" class="i1134 close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="i1135 modal-title" id="modal-label">@lang('Tư vấn cho tôi')</h4>
      </div>
      <div class="i1136 modal-body">
        <div class="i1137 form-group">
          <label class="i1138 " >@lang('Tên của bạn')*</label>
          <input type="text" class="i1139 form-control name" name="Name" value="">
        </div>
        <div class="i1140 form-group">
          <label class="i1141 " >@lang('Điện thoại')*</label>
          <input type="text" class="i1142 form-control phone" name="Phone" value="">
        </div>
      </div>
      <div class="i1143 modal-footer">
        <input type="hidden" class="i1144 utm" name="utm" value="">
        <input type="hidden" class="i1145 device" name="device" value="">
        <button type="button" class="i1146 btn btn-my btn-send-mail" data-action="@lang('Khách hàng yêu cầu báo giá')">@lang('Gửi')</button>
      </div>
    </form>
  </div>
</div>