/* Template: Villa - Bed & Breakfast Landing Page Template
Author: InovatikThemes
Version: 1.2
Created: Sep 2017
Description: Custom JS file
*/

/* PRELOADER */
$(window).load(function() {
	"use strict";
	var preloaderFadeOutTime = 500;
	function hidePreloader() {
		var preloader = $('.spinner-wrapper');
		setTimeout(function() {
			preloader.fadeOut(preloaderFadeOutTime);
		}, 500);
	}
	hidePreloader();
});


$( document ).ready(function() {



	var allDoc = $("html").innerHeight();
	var vw = $(window).width();
	var vh = $(window).height();

	var parBottom = $( ".paralax-bottom");
	var parLeft = $(".paralax-left");
	var parRight = $(".paralax-right");
	var parOpacity = $(".paralax-opacity");
	var parHeight = $(".paralax-height");
	var navMenu = $("#navMenu");
	var userScroll = 0;


	// FUNCTION SCROLL PAGE
	$(window).scroll(function(){
		// PARALAX FROM BOTTOM
		for(var i =0; i<parBottom.length;i++){
			var newBottom = $(parBottom[i]);
			if(newBottom.offset().top< $(window).scrollTop() + vh){
				newBottom.addClass("from-bottom-show");
			}
		}
		// PARALAX FROM RIGHT
		for(var i =0; i<parRight.length;i++){
			var newRight = $(parRight[i]);
			if(newRight.offset().top< $(window).scrollTop() + vh){
				newRight.addClass("from-right-show");
			}
		}
		// PARALAX FROM LEFT
		for(var i =0; i<parLeft.length;i++){
			var newLeft = $(parLeft[i]);
			if(newLeft.offset().top< $(window).scrollTop() + vh){
				newLeft.addClass("from-left-show");
			}
		}
		// PARALAX OPACITY
		for(var i =0; i<parOpacity.length;i++){
			var newOpacity = $(parOpacity[i]);
			if(newOpacity.offset().top< $(window).scrollTop() + vh){
				newOpacity.addClass("from-opacity-show");
			}
		}
		// PARALAX HEIGHT
		for(var i =0; i<parHeight.length;i++){
			var newOpacity = $(parOpacity[i]);
			if(newOpacity.offset().top< $(window).scrollTop() + vh){
				newOpacity.addClass("from-opacity-show");
			}
		}

});


	});


	(function($) {
		"use strict";

		// Gallery
		//-------------------------------------------------------------
		$(".gallery .gallery-thumbnail-container").on("click", function () {

			var src = $(this).find("img").data('img');
			var galleryImg = $('<img/>').attr('src', src).addClass('img-responsive');

			var galleryImgWidth;
			galleryImg.load(function () {
				galleryImgWidth = this.width;
			});

			var imgTitle = $(this).find('.gallery-img-title').html();
			var imgSubtitle = $(this).find('.gallery-img-subtitle').html();


			$('#galleryModal').modal();
			$('#galleryModal').on('shown.bs.modal', function () {
				$('#galleryModal .modal-dialog').css('max-width', galleryImgWidth);
				$('#galleryModal .modal-body').html(galleryImg);
				$('#galleryModal .modal-nav .title').html(imgTitle + ' - ' + imgSubtitle);
			});
			$('#galleryModal').on('hidden.bs.modal', function () {
				$('#galleryModal .modal-body').html('');
			});
		});


		/* fix vertical when not overflow
		call fullscreenFix() if .fullscreen content changes */
		function fullscreenFix() {
			var h = $('body').height();
			// set .fullscreen height
			$(".content-b").each(function (i) {
				if ($(this).innerHeight() <= h) {
					$(this).closest(".fullscreen").addClass("not-overflow");
				}
			});
		}

		$(window).resize(fullscreenFix);
		fullscreenFix();


		/* resize background images */
		function backgroundResize() {
			var windowH = $(window).height();
			$(".header-full-screen-img").each(function (i) {
				var path = $(this);
				// variables
				var contW = path.width();
				var contH = path.height();
				var imgW = path.attr("data-img-width");
				var imgH = path.attr("data-img-height");
				var ratio = imgW / imgH;
				// overflowing difference
				var diff = parseFloat(path.attr("data-diff"));
				diff = diff ? diff : 0;
				// remaining height to have fullscreen image only on parallax
				var remainingH = 0;
				if (path.hasClass("parallax")) {
					var maxH = contH > windowH ? contH : windowH;
					remainingH = windowH - contH;
				}
				// set img values depending on cont
				imgH = contH + remainingH + diff;
				imgW = imgH * ratio;
				// fix when too large
				if (contW > imgW) {
					imgW = contW;
					imgH = imgW / ratio;
				}
				//
				path.data("resized-imgW", imgW);
				path.data("resized-imgH", imgH);
				path.css("background-size", imgW + "px " + imgH + "px");
			});
		}

		$(window).resize(backgroundResize);
		$(window).focus(backgroundResize);
		backgroundResize();


		/* NAVBAR SCRIPTS */
		//jQuery to collapse the navbar on scroll
		$(window).scroll(function() {
			if ($(".navbar").offset().top > 50) {
				$(".navbar-fixed-top").addClass("top-nav-collapse");
			} else {
				$(".navbar-fixed-top").removeClass("top-nav-collapse");
			}
		});

		//jQuery for page scrolling feature - requires jQuery Easing plugin
		$(function() {
			$(document).on('click', 'a.page-scroll', function(event) {
				var $anchor = $(this);
				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top
				}, 800, 'easeInOutExpo');
				event.preventDefault();
			});
		});
		// closes the responsive menu on menu item click
		$(".navbar-nav li a").on("click", function(event) {
			if (!$(this).parent().hasClass('dropdown'))
			$(".navbar-collapse").collapse('hide');
		});


		/* DATEPICKER FORM COMPONENT */
		$('#start').datepicker({
			todayHighlight: true,
			autoclose: true,
			format: 'MM/dd/yyyy'
		});

		$('#end').datepicker({
			autoclose: true,
			format: 'MM/dd/yyyy'
		});


		// Contact Form
		//-------------------------------------------------------------

		$("#contact-form-gmap").submit(function () {

			$('#contact-form-gmap-msg').addClass('hidden');
			$('#contact-form-gmap-msg').removeClass('alert-success');
			$('#contact-form-gmap-msg').removeClass('alert-danger');

			$('#contact-form-gmap .btn-submit').attr('disabled', 'disabled');

			$.ajax({
				type: "POST",
				url: "php/index.php",
				data: $("#contact-form-gmap").serialize(),
				dataType: "json",
				success: function (data) {

					if ('success' == data.result) {
						$('#contact-form-gmap-msg').css('visibility', 'visible').hide().fadeIn().removeClass('hidden').addClass('alert-success');
						$('#contact-form-gmap-msg').html(data.msg[0]);
						$('#contact-form-gmap .btn-submit').removeAttr('disabled');
						$('#contact-form-gmap')[0].reset();
					}

					if ('error' == data.result) {
						$('#contact-form-gmap-msg').css('visibility', 'visible').hide().fadeIn().removeClass('hidden').addClass('alert-danger');
						$('#contact-form-gmap-msg').html(data.msg[0]);
						$('#contact-form-gmap .btn-submit').removeAttr('disabled');
					}

				}
			});

			return false;
		});


		/* CONTACT FORM */
		$("#ContactForm").validator().on("submit", function(event) {
			if (event.isDefaultPrevented()) {
				// handle the invalid form...
				formCError();
				submitCMSG(false, "Check if all fields are filled in!");
			} else {
				// everything looks good!
				event.preventDefault();
				submitCForm();
			}
		});

		function submitCForm() {
			// initiate variables with form content
			var cfirstname = $("#cfirstname").val();
			var clastname = $("#clastname").val();
			var cemail = $("#cemail").val();
			var cmessage = $("#cmessage").val();

			$.ajax({
				type: "POST",
				url: "php/contactform-process.php",
				data: "firstname=" + cfirstname + "&lastname=" + clastname + "&email=" + cemail + "&message=" + cmessage,
				success: function(text) {
					if (text == "success") {
						formCSuccess();
					} else {
						formCError();
						submitCMSG(false, text);
					}
				}
			});
		}

		function formCSuccess() {
			$("#ContactForm")[0].reset();
			submitCMSG(true, "Message Submitted!")
		}

		function formCError() {
			$("#ContactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).removeClass();
			});
		}

		function submitCMSG(valid, msg) {
			if (valid) {
				var msgClasses = "h3 text-center tada animated text-success";
			} else {
				var msgClasses = "h3 text-center text-danger";
			}
			$("#cmsgSubmit").removeClass().addClass(msgClasses).text(msg);
		}


		/* ROOM 1 DETAILS OWL CAROUSEL IMAGE SLIDER */
		$('.owl-carousel').owlCarousel({
			items: 1,
			nav: true,
			loop: true,
			navText : ["<i class='fa fa-chevron-circle-left'></i>","<i class='fa fa-chevron-circle-right'></i>"]
		});


		/* ROOM 1 DETAILS NESTED MAGNIFIC POPUPS */
		$('.popup-with-move-anim-1').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			preloader: false,
			midClick: true,
			mainClass: 'my-mfp-slide-bottom',
			closeBtnInside: true,
			closeOnBgClick: false,
			closeOnContentClick: false,
			callbacks: {
				beforeOpen: function() {
					$.magnificPopup.instance.close = function() {
						$.magnificPopup.proto.close.call(this);
					};
					// $.magnificPopup.proto.close.call(this);
					// console.log('before open has been initiated');
				}
			}
		});

		$('.popup-link-1').on('click', function() {
			$.magnificPopup.proto.close.call(this);
		});

		$('.popup-link-1').magnificPopup({
			type: 'image',
			gallery:{
				enabled:true //enable gallery mode
			},
			closeBtnInside: true,
			closeOnBgClick: false,
			closeOnContentClick: false,
			callbacks: {
				beforeOpen: function() {
					$.magnificPopup.instance.close = function() {
						$.magnificPopup.proto.close.call(this);
						$('.popup-with-move-anim-1').trigger('click');
					};
					// $.magnificPopup.proto.close.call(this);
					// console.log('before open has been initiated');
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure ' + this.st.el.attr('data-effect'));
				},
				beforeClose: function() {
					$('.mfp-figure').addClass('fadeOut');
				},
				close: function() {
					// console.log('Popup 2 close has been initiated');
				}
			}
		});


		/* ROOM 2 DETAILS NESTED MAGNIFIC POPUPS */
		$('.popup-with-move-anim-2').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			preloader: false,
			midClick: true,
			mainClass: 'my-mfp-slide-bottom',
			closeBtnInside: true,
			closeOnBgClick: false,
			closeOnContentClick: false,
			callbacks: {
				beforeOpen: function() {
					$.magnificPopup.instance.close = function() {
						$.magnificPopup.proto.close.call(this);
					};
					// $.magnificPopup.proto.close.call(this);
					// console.log('before open has been initiated');
				}
			}
		});

		$('.popup-link-2').on('click', function() {
			$.magnificPopup.proto.close.call(this);
		});

		$('.popup-link-2').magnificPopup({
			type: 'image',
			gallery:{
				enabled:true //enable gallery mode
			},
			closeBtnInside: true,
			closeOnBgClick: false,
			closeOnContentClick: false,
			callbacks: {
				beforeOpen: function() {
					$.magnificPopup.instance.close = function() {
						$.magnificPopup.proto.close.call(this);
						$('.popup-with-move-anim-2').trigger('click');
					};
					// $.magnificPopup.proto.close.call(this);
					console.log('before open has been initiated');
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure ' + this.st.el.attr('data-effect'));
				},
				beforeClose: function() {
					$('.mfp-figure').addClass('fadeOut');
				},
				close: function() {
					// console.log('Popup 2 close has been initiated');
				}
			}
		});


		/* ROOM 3 DETAILS NESTED MAGNIFIC POPUPS */
		$('.popup-with-move-anim-3').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			preloader: false,
			midClick: true,
			mainClass: 'my-mfp-slide-bottom',
			closeBtnInside: true,
			closeOnBgClick: false,
			closeOnContentClick: false,
			callbacks: {
				beforeOpen: function() {
					$.magnificPopup.instance.close = function() {
						$.magnificPopup.proto.close.call(this);
					};
					// $.magnificPopup.proto.close.call(this);
					// console.log('before open has been initiated');
				}
			}
		});

		$('.popup-link-3').on('click', function() {
			$.magnificPopup.proto.close.call(this);
		});

		$('.popup-link-3').magnificPopup({
			type: 'image',
			gallery:{
				enabled:true //enable gallery mode
			},
			closeBtnInside: true,
			closeOnBgClick: false,
			closeOnContentClick: false,
			callbacks: {
				beforeOpen: function() {
					$.magnificPopup.instance.close = function() {
						$.magnificPopup.proto.close.call(this);
						$('.popup-with-move-anim-3').trigger('click');
					};
					// $.magnificPopup.proto.close.call(this);
					console.log('before open has been initiated');
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure ' + this.st.el.attr('data-effect'));
				},
				beforeClose: function() {
					$('.mfp-figure').addClass('fadeOut');
				},
				close: function() {
					// console.log('Popup 2 close has been initiated');
				}
			}
		});


		/* MAGNIFIC POPUP FOR IMAGE GALLERY SWIPER */
		$('.popup-link').magnificPopup({
			removalDelay: 300,
			type: 'image',
			callbacks: {
				beforeOpen: function() {
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure ' + this.st.el.attr('data-effect'));
				}
			},
			gallery:{
				enabled:true //enable gallery mode
			}
		});


		/* IMAGE GALLERY SWIPER */
		var swiper = new Swiper('.swiper-container', {
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			slidesPerView: 3,
			spaceBetween: 20,
			autoplay: 2800,
			autoplayStopOnLast: false,
			freeMode: true,
			breakpoints: {
				992: {
					slidesPerView: 3,
					spaceBetween: 30
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 20
				},
				468: {
					slidesPerView: 1,
					spaceBetween: 10
				}
			}
		});


		/* BACK TO TOP BUTTON */
		// create the back to top button
		$('body').prepend('');
		var amountScrolled = 700;
		$(window).scroll(function() {
			if ($(window).scrollTop() > amountScrolled) {
				$('a.back-to-top').fadeIn('500');
			} else {
				$('a.back-to-top').fadeOut('500');
			}
		});


		/* REMOVES LONG FOCUS ON BUTTONS */
		$(".button, a, button").mouseup(function(){
			$(this).blur();
		});

	})(jQuery);
