{{-- EXAMPLE: <button class="btn-favorite" data-id="1"></button> --}}
<script type="text/javascript">
  (function ($) {
    $.fn.extend({
      cookieList: function (cookieName) {
        var cookie = $.cookie(cookieName);
        var items = cookie ? eval("([" + cookie + "])") : [];
        return {
          add: function (val) {
            var index = items.indexOf(val);
            if (index == -1) {
              items.push(val);
              $.cookie(cookieName, items.join(','), { expires: 365, path: '/' });
            }
          },
          remove: function (val) {
            var index = items.indexOf(val);
            if (index != -1) {
              items.splice(index, 1);
              $.cookie(cookieName, items.join(','), { expires: 365, path: '/' });
            }
          },
          indexOf: function (val) {
            return items.indexOf(val);
          },
          clear: function () {
            items = null;
            $.cookie(cookieName, null, { expires: 365, path: '/' });
          },
          items: function () {
            return items;
          },
          length: function () {
            return items.length;
          },
          join: function (separator) {
            return items.join(separator);
          }
        };
      }
    });
  })(jQuery);

  var cookieProduct = $.fn.cookieList("favoriteProducts");
  jQuery(document).ready(function() {
    $('body').on('click', '.btn-favorite', function(event) {
      if($(this).parent().hasClass('active')){
        cookieProduct.remove($(this).data('id'));
        $(this).parent().removeClass('active');
      }else{
        cookieProduct.add($(this).data('id'));
        $(this).parent().addClass('active');
      }
      console.log(cookieProduct.length);
    });
  });
</script>