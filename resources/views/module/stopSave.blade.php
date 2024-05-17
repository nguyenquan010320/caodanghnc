@ifturnon('chong-copy-bai-viet')
<style type="text/css">
body{-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}
</style>
<script type="text/javascript"> 
  var message="Sorry, right-click has been disabled"; 
  function clickIE() {if (document.all) {(message);return false;}} 
  function clickNS(e) {
    if (document.layers||(document.getElementById&&!document.all)) { 
      if (e.which==2||e.which==3) {(message);return false;}
    }
  } 
  if (document.layers){
    document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;
  }else{
    document.onmouseup=clickNS;document.oncontextmenu=clickIE;
  } 
  document.oncontextmenu=new Function("return false") 
</script> 
<script language="JavaScript">
  // document.onkeypress = function (event) {
  //   event = (event || window.event);
  //   if (event.keyCode == 123 || event.keyCode == 83) {
  //     return false;
  //   }
  // }
  // document.onmousedown = function (event) {
  //   event = (event || window.event);
  //   if (event.keyCode == 123 || event.keyCode == 83) {
  //     return false;
  //   }
  // }
  // document.onkeydown = function (event) {
  //   event = (event || window.event);
  //   if (event.keyCode == 123 || event.keyCode == 83) {
  //     return false;
  //   }
  // }
</script>
@endif