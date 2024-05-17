<script src=https://maps.googleapis.com/maps/api/js?key=AIzaSyAJtRRGlIigGHDlsrpP_h2APMhpaJ_EXn4></script>
<script type="text/javascript">
	$(document).ready(function(){
		var infowindow = null;
		var mapLat = 21.002829, mapLong = 105.803741,mapZoom = 15;
		var mapStyle = [{stylers: [{hue: "#363e50"}, {saturation: 10}, {gamma: 2.15}, {lightness: 12}]}];
		var mapOption = {
			center: new google.maps.LatLng(mapLat, mapLong),
			zoom: mapZoom,
			panControl: true,
			zoomControl: true,
			mapTypeControl: true,
			streetViewControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false,
			styles: mapStyle
		};
		var mapObject = new google.maps.Map(document.getElementById("myMap"), mapOption);
		$('#datatable').on('click', 'td', function(event) {
			event.preventDefault();
			$('#datatable td').removeClass('active');
			$(this).addClass('active');
			if (infowindow) { infowindow.close(); }
			var mapMarker = new google.maps.Marker({position: new google.maps.LatLng(mapLat, mapLong),map: mapObject,visible: true,icon: "/upload/map.png"});
			infowindowHtml = '<p><b>'+$(this).data('ten')+'</b><br>'+$(this).data('diachi')+'<br>Điện thoại:'+$(this).data('dienthoai');
			infowindow = new google.maps.InfoWindow({maxWidth: 500,content: infowindowHtml});
			infowindow.open(mapObject, mapMarker);
		});
	});
</script>