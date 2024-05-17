<div id="google_translate_element"></div>
<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'vi', includedLanguages: 'de,en,fr,it,ja,ko,vi,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

{{-- @if(!empty(LANGUAGE_NAMES))
@php($languageName = unserialize(LANGUAGE_NAMES))
@endif
@if(!empty(LANGUAGES))
@php($languagesList = unserialize(LANGUAGES))
@if(!empty($languagesList))
@foreach($languagesList as $l=>$k)
<li class="hidden-xs"><a href="#googtrans(vi|{!!$k!!})" class="lang-select"><img src="{{$languageName[$k]['img'] or ''}}"></a></li>
@endforeach
<li class="visible-xs">
  <div class="topbar-dropdown">
    <a class="title"><i class="fa fa-globe"></i></a>
    <div class="dropdown-list">
      @if(!empty(LANGUAGES))
      @php($languagesList = unserialize(LANGUAGES))
      @foreach($languagesList as $l=>$k)
      <a class="list-entry" href="#googtrans(vi|{!!$k!!})" class="lang-select"><img src="{{$languageName[$k]['img'] or ''}}"></a>
      @endforeach
      @endif
    </div>
  </div>
</li>
@endif
@endif

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'vi', layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT}, 'google_translate_element');
  }

  function triggerHtmlEvent(element, eventName) {
    var event;
    if (document.createEvent) {
      event = document.createEvent('HTMLEvents');
      event.initEvent(eventName, true, true);
      element.dispatchEvent(event);
    } else {
      event = document.createEventObject();
      event.eventType = eventName;
      element.fireEvent('on' + event.eventType, event);
    }
  }

  $('.lang-select').on('click', function(event) {
    event.preventDefault();
    console.log('.lang-select'); 
    var theLang = jQuery(this).attr('data-lang');
    console.log('theLang',theLang); 
    $('.goog-te-combo').val(theLang);
    window.location = jQuery(this).attr('href');
    location.reload();
  });
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style type="text/css">
.goog-te-banner-frame.skiptranslate,.skiptranslate {display: none !important;} 
body {top: 0px !important;}
</style> --}}