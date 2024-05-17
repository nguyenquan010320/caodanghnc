<div id="google_translate_element"></div>
<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'vi', includedLanguages: 'en,ja', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <style type="text/css">
      .desc{border:4px red solid;padding: 40px;margin-bottom: 40px}
      .desc_full{border:4px red solid;padding: 40px;margin-top: 40px}
      .desc_full img{width: 100px}
      .desc_full p,.desc_full li,.desc_full span{font-size: 8px!important;line-height: 1;margin: 0}
    </style>
    {{-- <div class="desc">
      {!!$s["desc"]!!}
    </div> --}}
    <p style="text-align: right;"> <a href="{!!$post[$s['id']+1]['link'] or ''!!}?dich=1" class=""><button type="button">Bài tiếp theo</button></a></p>
    <div class="desc_full COPY O DAY NE PHUONG OI">
      {!!$s["desc_full"]!!}
    </div>