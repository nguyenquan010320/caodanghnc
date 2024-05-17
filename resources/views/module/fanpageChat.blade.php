@ifnotempty('link-chat-facebook')
<div class="fb-livechat {{-- visible-xs --}}"> 
	<a rel="nofollow" href="{!!$site["link-chat-facebook"]!!}" target="_blank" title="@lang('Gửi tin nhắn cho chúng tôi qua Facebook')" class="ctrlq fb-button btn-action" data-action="Khách hàng bấm nút chat trực tuyến"> 
		<div class="bubble">1</div>
		<div class="bubble-msg">@lang('Bạn cần hỗ trợ?')</div>
	</a>
</div>
@endif
