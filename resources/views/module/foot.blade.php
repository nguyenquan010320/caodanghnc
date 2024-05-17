{{-- <script src=/public/frontend/js/jquery.elevateZoom-3.0.8.min.js></script>
<script type="text/javascript">
	if (typeof window.orientation !== 'undefined') {
		$('#product-gallery').on('click', 'a', function(event) {
			$('#product-gallery > a').removeClass('active');
			$(this).addClass('active');
			$('.main-product-img').attr('src',$(this).data('image'));
		});
	}else{
		$(".main-product-img").elevateZoom({
			zoomWindowWidth:372,
			zoomWindowHeight:447,
			cursor:'crosshair',
			zoomLens:'false',
			lensOpacity:0,
			galleryActiveClass: 'active',
			gallery:'product-gallery',
		});
	}
</script> --}}
<script type=text/javascript>
	window.addEventListener('DOMContentLoaded', function() {
		(function($) {
			$('.c361').on('click', function(event) {
				$('.c361').removeClass('active');
				$('.c364').removeClass('active');
				$(this).addClass('active');
				$('.c364-'+$(this).data('id')).addClass('active');
			});
			// $('.lazy').Lazy();
			$(".matchHeight").matchHeight({byRow:true,property:"height",target:null,remove:false});
			$(".matchHeight1").matchHeight({byRow:true,property:"height",target:null,remove:false});
			$(".matchHeight2").matchHeight({byRow:true,property:"height",target:null,remove:false});
			$(".matchHeight3").matchHeight({byRow:true,property:"height",target:null,remove:false});
			$(".matchHeight4").matchHeight({byRow:true,property:"height",target:null,remove:false});
			$(".matchHeight5").matchHeight({byRow:true,property:"height",target:null,remove:false});
			$(".matchHeight6").matchHeight({byRow:true,property:"height",target:null,remove:false});
			// $(".sticky").sticky({topSpacing:0});
			new WOW().init();
			if (typeof fbq === 'function') {
				fbq('track', 'ViewContent', {
					content_ids: ['{!!$s['id'] or ''!!}'],
					content_type: 'product',
					value: '{!!$s['price_real'] or ''!!}',
					currency: 'VND'
				});
			}

			$("input:checkbox").on('click', function() {
			  // in the handler, 'this' refers to the box clicked on
			  var $box = $(this);
			  if ($box.is(":checked")) {
			    // the name of the box is retrieved using the .attr() method
			    // as it is assumed and expected to be immutable
			    var group = "input:checkbox[name='" + $box.attr("name") + "']";
			    // the checked state of the group/box on the other hand will change
			    // and the current value is retrieved using .prop() method
			    $(group).prop("checked", false);
			    $box.prop("checked", true);
			  } else {
			  	$box.prop("checked", false);
			  }
			});

			if ($(window).width() > 767 && $('.pinBox').length && $('.pinned').length) {
				var divWidth = $('.pinBox').width();
				$('.pinBox').css('height',$('.pinBox').height());
				var pinOffset = $('.pinBox').offset().top - 100;
				console.log(divWidth,pinOffset); 
				$(window).scroll(function(event) {
					var screenTop = $(document).scrollTop();
					console.log(screenTop,pinOffset); 
					if(screenTop>=pinOffset){
						$('.pinned').css('position','fixed').css('top','90px').css('width',divWidth);
					}else{
						$('.pinned').css('position','relative').css('top','0');
					}
				});
			}

			if($(window).width() > 950){
				$('body').on('click', '.btn-hotline-pc', function(event) {
					event.preventDefault();
					console.log(1);
					$('#modalHotline').modal('show');
				});
			}

			$('body').on('click', '.btn-mua', function(event) {
				console.log(1);
				$('#modalForm').modal('show');
				$('#modalForm').find('.sp-name').val($(this).data('name'));
				$('#modalForm').find('.sp-id').val($(this).data('id'));
				$('#modalForm').find('.sp-price').val($(this).data('price'));

				var device = (isMobile())?'Mobile':'PC';
				var utm = getUrlParameter('utm_source');
				var action='Khách hàng bấm nút đăng ký '+$(this).data('name');
				var currenturl=window.location.href;

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/ds-add.php",
					data: ({device:device, utm:utm, action:action, currenturl:currenturl}),
					success: function(){},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});

			});

			// <div class="form-group">
			// <input type="file" class="form-control fileupload" name="" value="">
			// <input type="hidden" class="form-control fileuploadlink" name="File CV">
			// </div>

			$(".fileupload").on('change', function(event) {
				console.log('fileupload'); 
				event.preventDefault();
				var fileparent = $(this).parents('.form-group');
				var fileinput = $(this);
				var filelink = fileparent.find('.fileuploadlink');

				var fd = new FormData();
				var files = $(this)[0].files;
				if(files.length > 0 ){
					fd.append('file',files[0]);
					$.ajax({
						url: '/public/fileupload.php',
						type: 'post',
						data: fd,
						contentType: false,
						processData: false,
						success: function(response){
							if(response != 0){
								console.log(response); 
								filelink.val('{!!'http://'.$_SERVER['HTTP_HOST']!!}/public/'+response); 
								// $(".preview img").show();
							}else{
								alert('@lang('Tải lên KHÔNG thành công, vui lòng chọn một file ảnh, file văn bản hoặc file PDF')!');
								filelink.val(''); 
								fileinput.val(''); 
							}
						},
					});
				}else{
					alert("@lang('Vui lòng chọn một file ảnh, file văn bản hoặc file PDF')");
				}
			});

			$('body').on('change', '#variant', function(event) {
				var id = $(this).find('option:selected').data('id');
				console.log(id); 
				if(id != undefined){
					$('.imgmain').hide();
					$('#variant_'+id).show();
					$('.giaban').text($(this).find('option:selected').data('price'));
					$('#price').val($(this).find('option:selected').data('pricereal'));
				}else{
					$('.imgmain').hide();
					$('.imgmainmain').show();
				}
			});

			$('.list-group').on('click', '.catParent', function(event) {
				event.preventDefault();
				var id = $(this).data('id');
				$('.child'+id).toggle();
				$(this).find('i.fa-plus').toggle();
				$(this).find('i.fa-minus').toggle();
			});
			$('.list-group-item').each(function(index, el) {
				if($(this).hasClass('active')){
					var parent = $(this).data('parent');
					$('.parent'+parent).trigger('click');
				}
			});
			$("table").each(function(index, el) {
				if(!$(this).hasClass('table')){
					$(this).addClass('table').addClass('table-bordered');
				}
			});
			$('.carousel-click .carousel-click-item').each(function(index, el) {
				$(this).on('click', function(event) {
					event.preventDefault();
					$('.carousel-click .owl-dot:nth('+index+')').trigger('click');
				});
			});
			$(".chi-tiet-bai-viet img").wrap("<p class='text-center'></p>");
			$(".chi-tiet-bai-viet video").wrap("<p class='text-center'></p>");
			$(".chi-tiet-bai-viet img").each(function() {
				$(this).attr('title', $(this).attr('alt'));
				$(this).attr('width', 2000);
				$(this).attr('height', 2000);
			});
			// $(".chi-tiet-bai-viet img").click(function(event) {
			// 	$('#modalImg').modal('show');
			// 	$('#modalImgSrc').attr('src', $(this).attr('src').replace('/thumbs','/upload/'));
			// });
			$(".noianh").click(function(event) {
				$('#modalImg').modal('show');
				$('#modalImgSrc').attr('src', $(this).data('src').replace('/thumbs','/upload/'));
			});
			if(isMobile()){
				$(".table-to-responsive table").each(function(index, el) {
					$(this).wrap("<div class='table-responsive'></div>");
					$(this).css('width','900px');
					$(this).css('max-width','900px');
					$(this).css('table-layout','fixed');
					// $(this).find('td').css('width','33%');
				});
			}
			$('.mce-object-video').each(function(index, el) {
				var video = $(this).data('mce-html');
				video = video.replace('%0A%3Csource%20src%3D%22','');
				video = video.replace('%22%20type%3D%22video/mp4%22%20/%3E','');
				$('<video width="550" height="350" controls><source src="'+video+'" type="video/mp4">Your browser does not support the video tag.</video>').insertAfter($(this));
			});

			if(isMobile()){
				$('#mainMenu a.scroll-to').click(function(event) {
					$('#mainMenu-trigger button').trigger('click');
				});
			}

			var device = (isMobile())?'Điện thoại':'Máy tính';
			var utm = getUrlParameter('utm_source');
			$('.utm').val(utm);
			$('.device').val(device);
			var action = '';
			// $.ajax({
			// 	dataType: "html",
			// 	type: "POST",
			// 	evalScripts: true,
			// 	url: "/ds-add.php",
			// 	data: ({device:device, utm:utm, action:action}),
			// 	success: function(){}
			// });

			$('form').on('click', '.btn-send-mail', function(event) {
				event.preventDefault();
				var form = $(this).parents('form');
				var name=form.find('.name').val();
				var phone=form.find('.phone').val();
				var email=form.find('.email').val();
				if(name!=undefined && (name=='' || name==null)){
					alert('@lang('Vui lòng điền tên của bạn')!'); return;
				} else if(phone!=undefined && (phone=='' || phone==null)){
					alert('@lang('Vui lòng điền số điện thoại của bạn')!'); return;
				// } else if(phone!=undefined && !isPhone(phone)){
					// alert('@lang('Vui lòng kiểm tra lại số điện thoại, có thể bạn điền chưa đúng')!'); return;
				} else if(email!=undefined && (email=='' || email==null)){
					alert('@lang('Vui lòng điền địa chỉ email của bạn')!'); return;
				} else if(email!=undefined && email!='' && email!=null && !isEmail(email)){
					alert('@lang('Vui lòng kiểm tra lại địa chỉ email, có thể bạn điền chưa đúng')!'); return;
				}

				$(this).replaceWith('<p>@lang('Đang gửi')...</p>');

				var element = form.data('element');
				var data = form.serializeArray();
				var json_data = JSON.stringify(data);
				var device = (isMobile())?'@lang('Điện thoại')':'@lang('Máy tính')';
				var utm = getUrlParameter('utm_source');
				var action = $(this).data('action');
				var currenturl = window.location.href;

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/ds-add.php",
					data: ({device:device, utm:utm, action:action, json_data:json_data, currenturl:currenturl}),
					success: function(){},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/w/updateDataElement",
					data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data)}),
					success: function(){},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});

				var taive = '';
				console.log($(this).data('taive')); 
				if($(this).data('taive') != undefined){
					taive = $(this).data('taive');

				}

window.location.href="{!!$post[3]['link'] or ''!!}";

// Xem Hướng dẫn:https://github.com/levinunnink/html-form-to-google-sheet?tab=readme-ov-file

				// form.addEventListener("submit", function(e) {
					// e.preventDefault();
					var datax = new FormData(document.getElementById("formdangky"));
					fetch("Link google sheet script để chèn data", {
						method: 'POST',
						body: datax,
					})
					.then(() => {
						$.ajax({
							dataType: "html",
							type: "POST",
							evalScripts: true,
							url: "//api.ihappy.vn/sendMail",
							data: ({to:'@site('dia-chi-email-nhan-thong-bao')',url:window.location.hostname,json_data:json_data @if(!empty(env('CUSTOM_AGENCY'))) ,{!!env('CUSTOM_AGENCY')!!}:1, noname:1 @endif }),
							success: function(){
								if(taive == ''){
									window.location.href="{!!$post[3]['link'] or ''!!}";
								}else{
									$('#modalTaive').modal('toggle');
									window.open(
										taive,
										'_blank'
										);
								}
							},
							error: function (xhr, ajaxOptions, thrownError) {
								//alert(xhr.responseText);
								alert(thrownError);
							}
						});
						// window.location.href="{!!$post[3]['link'] or ''!!}?url="+document.referrer;
				      // alert("Success!");
				    })
				// });

				

				{{-- @if(env('IHAPPY_MAIL_SERVICE')) --}}
				// $.ajax({
				// 	dataType: "html",
				// 	type: "POST",
				// 	evalScripts: true,
				// 	url: "//api.ihappy.vn/sendMail",
				// 	data: ({to:'@site('dia-chi-email-nhan-thong-bao')',url:window.location.hostname,json_data:json_data @if(!empty(env('CUSTOM_AGENCY'))) ,{!!env('CUSTOM_AGENCY')!!}:1, noname:1 @endif }),
				// 	success: function(){
				// 		if(taive == ''){
				// 			window.location.href="{!!$post[3]['link'] or ''!!}";
				// 		}else{
				// 			$('#modalTaive').modal('toggle');
				// 			window.open(
				// 				taive,
				// 				'_blank'
				// 				);
				// 		}
				// 	},
				// 	error: function (xhr, ajaxOptions, thrownError) {
				// 		//alert(xhr.responseText);
				// 		alert(thrownError);
				// 	}
				// });
				{{-- @else --}}
				// window.location.href="{!!$post[3]['link'] or ''!!}";
				 {{-- @endif --}}
			});

			{{-- <p class="text-center"><button class="btn btn-taive" data-taive="{!!$p['field1']!!}"><i class="fa fa-download"></i> Tải về</button></p> --}}
			$('body').on('click', '.btn-taive', function(event) {
				console.log(1);
				$('#modalTaive').modal('show');
				$('#modalTaive').find('.btn-link-tai').data('taive',$(this).data('taive'));
			});

			$('.btn-action').click(function(event) {
				var device = (isMobile())?'Mobile':'PC';
				var utm = getUrlParameter('utm_source');
				var action=$(this).data('action');

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/ds-add.php",
					data: ({device:device, utm:utm, action:action}),
					success: function(){},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});
			});

			$('form').on('click', '.btn-gio-hang', function(event) {
				$(this).html('<i class="fa fa-angle-double-right"></i> @lang('Đang thêm')...');
				event.preventDefault();
				var form = $(this).parents('form');
				var element = form.data('element');
				var data = form.serializeArray();
				var json_data = JSON.stringify(data);
				var device = (isMobile())?'@lang('Điện thoại')':'@lang('Máy tính')';
				var utm = getUrlParameter('utm_source');
				var action = $(this).data('action');

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/ds-add.php",
					data: ({device:device, utm:utm, action:action, json_data:json_data}),
					success: function(){},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/w/updateDataElement",
					data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data)}),
					success: function(){
						if (typeof fbq === 'function') {
							fbq('track', 'Purchase', {
								content_ids: ['{!!$s['id'] or ''!!}'],
								content_type: 'product',
								value: '{!!$s['price_real'] or ''!!}',
								currency: 'VND'
							});
						}
						form.find('.btn-gio-hang').html('<i class="fa fa-check"></i> @lang('Đã thêm vào giỏ hàng')');
						console.log($('.cartCount:visible').text()); 
						$('.cartCount:visible').text((parseInt($('.cartCount:visible').text())+1));
					},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});
			});

			$('form').on('click', '.btn-mua-ngay', function(event) {
				event.preventDefault();
				var form = $(this).parents('form');
				var element = form.data('element');
				var data = form.serializeArray();
				var json_data = JSON.stringify(data);
				var device = (isMobile())?'@lang('Điện thoại')':'@lang('Máy tính')';
				var utm = getUrlParameter('utm_source');
				var action = $(this).data('action');

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/w/updateDataElement",
					data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data)}),
					success: function(){
						if (typeof fbq === 'function') {
							fbq('track', 'Purchase', {
								content_ids: ['{!!$s['id'] or ''!!}'],
								content_type: 'product',
								value: '{!!$s['price_real'] or ''!!}',
								currency: 'VND'
							});
						}
						window.location.href="{!!$post[2]['link'] or ''!!}";
					},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});
			});

			$('form').on('click', '.btn-xoa-gio-hang', function(event) {
				event.preventDefault();
				var form = $(this).parents('form');
				var element = form.data('element');
				var data = form.serializeArray();
				var json_data = JSON.stringify(data);
				var device = (isMobile())?'@lang('Điện thoại')':'@lang('Máy tính')';
				var utm = getUrlParameter('utm_source');
				var action = $(this).data('action');

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/w/updateDataElement",
					data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data)}),
					success: function(){
						window.location.href="{!!$post[2]['link'] or ''!!}";
					},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});
			});

			$('form.update-gio-hang').on('change', 'select, input', function(event) {
				console.log(1); 
				event.preventDefault();
				var form = $(this).parents('form');
				var element = form.data('element');
				var data = form.serializeArray();
				var json_data = JSON.stringify(data);
				var device = (isMobile())?'@lang('Điện thoại')':'@lang('Máy tính')';
				var utm = getUrlParameter('utm_source');
				var action = $(this).data('action');

				$.ajax({
					dataType: "html",
					type: "POST",
					evalScripts: true,
					url: "/w/updateDataElement",
					data: ({"_token": "{{ csrf_token() }}",element:element, json_data:JSON.stringify(data)}),
					success: function(){
						window.location.href="{!!$post[2]['link'] or ''!!}"; 
					},
					error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr.responseText);
						alert(thrownError);
					}
				});
			});
		})(jQuery);
	});

var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
	sURLVariables = sPageURL.split('&'),
	sParameterName,
	i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
};

function isMobile() {
	return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
}

function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function isPhone(phone) {
	var isnum = /^\d+$/.test(phone);
	if(isnum){
		return (phone.match(/\d/g).length===10 && phone.match("^0"));
	}
	return false;
}
</script>