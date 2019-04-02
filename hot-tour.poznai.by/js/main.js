/* ========================================================================= */
/*	Preloader
/* ========================================================================= */




function closeModal(){
	let myModal = document.querySelector('#myModal');
	myModal.style.display = 'none';
	clearBody();
}

let tourListButton = document.querySelector('.tour-list-label');
let tourList = document.querySelector('#tourList');
let tourListLabel = document.querySelector('.tour-list-text-label');
let modalTour = document.querySelector('#modalTour');


function tourListFun(value) {
	tourListLabel.innerHTML = value;
	modalTour.setAttribute('value', value);
	if(tourList.classList.contains('tour-list-show')){
		tourList.classList.remove('tour-list-show');
	} else {
		tourList.classList.add('tour-list-show');
	}
}

tourListButton.addEventListener('click', function () {

	if(tourList.classList.contains('tour-list-show')){
		tourList.classList.remove('tour-list-show');
	} else {
		tourList.classList.add('tour-list-show');
	}

});

jQuery(window).load(function(){

	$("#preloader").fadeOut("slow");

	$('.openModal').click(function(action) {
		action.preventDefault();
	})
	$('.closeModal').click(function(action) {
		action.preventDefault();
	})
	$('.closeModal').click(function(action) {
		$('.modal').plainModal('close', {duration: 500});
	})


	$('.openegypt').click(function(action) {
		$('#modalegypt').plainModal('open', {duration: 500});
	});
	$('.openvietnam').click(function(action) {
		$('#modalvietnam').plainModal('open', {duration: 500});
	});
	$('.opensriLanka').click(function(action) {
		$('#modalsriLanka').plainModal('open', {duration: 500});
	});
	$('.openthailand').click(function(action) {
		$('#modalthailand').plainModal('open', {duration: 500});
	});
	$('.openindia').click(function(action) {
		$('#modalindia').plainModal('open', {duration: 500});
	});
	$('.openjordan').click(function(action) {
		$('#modaljordan').plainModal('open', {duration: 500});
	});
	$('.openisrael').click(function(action) {
		$('#modalisrael').plainModal('open', {duration: 500});
	});
	$('.opencuba').click(function(action) {
		$('#modalcuba').plainModal('open', {duration: 500});
	});
	$('.opendominican').click(function(action) {
		$('#modaldominican').plainModal('open', {duration: 500});
	});
	$('.openmexico').click(function(action) {
		$('#modalmexico').plainModal('open', {duration: 500});
	});


	// BOOKING FORM SHOW
	$('.opengreece').click(function(action) {
		$('#modalgreece').plainModal('open', {duration: 500});
	});
	$('.opencyprus').click(function(action) {
		$('#modalcyprus').plainModal('open', {duration: 500});
	});
	$('.openspain').click(function(action) {
		$('#modalspain').plainModal('open', {duration: 500});
	});
	$('.opentunisia').click(function(action) {
		$('#modaltunisia').plainModal('open', {duration: 500});
	});
	$('.openbulgaria').click(function(action) {
		$('#modalbulgaria').plainModal('open', {duration: 500});
	});
	$('.opengeorgia').click(function(action) {
		$('#modalgeorgia').plainModal('open', {duration: 500});
	});
	$('.openalbania').click(function(action) {
		$('#modalalbania').plainModal('open', {duration: 500});
	});
	$('.openmontenegro').click(function(action) {
		$('#modalmontenegro').plainModal('open', {duration: 500});
	});
	$('.openitaly').click(function(action) {
		$('#modalitaly').plainModal('open', {duration: 500});
	});
	$('.openturkey').click(function(action) {
		$('#modalturkey').plainModal('open', {duration: 500});
	});




});

/* ========================================================================= */
/*  Welcome Section Slider
/* ========================================================================= */

$(function() {

	var Page = (function() {

		var $navArrows = $( '#nav-arrows' ),
		$nav = $( '#nav-dots > span' ),
		slitslider = $( '#slider' ).slitslider( {
			onBeforeChange : function( slide, pos ) {

				$nav.removeClass( 'nav-dot-current' );
				$nav.eq( pos ).addClass( 'nav-dot-current' );

			}
		} ),

		init = function() {

			initEvents();

		},
		initEvents = function() {

			// add navigation events
			$navArrows.children( ':last' ).on( 'click', function() {

				slitslider.next();
				return false;

			} );

			$navArrows.children( ':first' ).on( 'click', function() {

				slitslider.previous();
				return false;

			} );

			$nav.each( function( i ) {

				$( this ).on( 'click', function( event ) {

					var $dot = $( this );

					if( !slitslider.isActive() ) {

						$nav.removeClass( 'nav-dot-current' );
						$dot.addClass( 'nav-dot-current' );

					}

					slitslider.jump( i + 1 );
					return false;

				} );

			} );

		};

		return { init : init };

	})();

	Page.init();

});



$(document).ready(function(){

	/* ========================================================================= */
	/*	Menu item highlighting
	/* ========================================================================= */

	jQuery('#nav').singlePageNav({
		offset: jQuery('#nav').outerHeight(),
		filter: ':not(.external)',
		speed: 2000,
		currentClass: 'current',
		easing: 'easeInOutExpo',
		updateHash: true,
		beforeStart: function() {
			console.log('begin scrolling');
		},
		onComplete: function() {
			console.log('done scrolling');
		}
	});

	$(window).scroll(function () {
		if ($(window).scrollTop() > 400) {
			$(".navbar-brand a").css("color","#fff");
			$("#navigation").removeClass("animated-header");
		} else {
			$(".navbar-brand a").css("color","inherit");
			$("#navigation").addClass("animated-header");
		}
	});

	/* ========================================================================= */
	/*	Fix Slider Height
	/* ========================================================================= */

	// Slider Height
	var slideHeight = $(window).height();

	$('#home-slider, #slider, .sl-slider, .sl-content-wrapper').css('height',slideHeight);

	$(window).resize(function(){'use strict',
	$('#home-slider, #slider, .sl-slider, .sl-content-wrapper').css('height',slideHeight);
});



$("#comments, #testimonial").owlCarousel({
	navigation : true,
	pagination : false,
	slideSpeed : 700,
	paginationSpeed : 400,
	singleItem:true,
	navigationText: ["<i class='fa fa-angle-left fa-lg'></i>","<i class='fa fa-angle-right fa-lg'></i>"]
});


/* ========================================================================= */
/*	Featured Project Lightbox
/* ========================================================================= */

$(".fancybox").fancybox({
	padding: 0,

	openEffect : 'elastic',
	openSpeed  : 650,

	closeEffect : 'elastic',
	closeSpeed  : 550,

	closeClick : true,

	beforeShow: function () {
		this.title = $(this.element).attr('title');
		this.title = '<h3>' + this.title + '</h3>' + '<p>' + $(this.element).parents('.portfolio-item').find('img').attr('alt') + '</p>';
	},

	helpers : {
		title : {
			type: 'inside'
		},
		overlay : {
			css : {
				'background' : 'rgba(0,0,0,0.8)'
			}
		}
	}
});

});


/* ==========  START GOOGLE MAP ========== */
//
// // When the window has finished loading create our google map below
// google.maps.event.addDomListener(window, 'load', init);
//
// function init() {
//     // Basic options for a simple Google Map
//     // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
//
// 	    var myLatLng = new google.maps.LatLng(22.402789, 91.822156);
//
// 	    var mapOptions = {
// 	        zoom: 15,
// 	        center: myLatLng,
// 	        disableDefaultUI: true,
// 	        scrollwheel: false,
// 	        navigationControl: true,
// 	        mapTypeControl: false,
// 	        scaleControl: false,
// 	        draggable: true,
//
//         // How you would like to style the map.
//         // This is where you would paste any style found on Snazzy Maps.
//         styles: [{
//             featureType: 'water',
//             stylers: [{
//                 color: '#46bcec'
//             }, {
//                 visibility: 'on'
//             }]
//         }, {
//             featureType: 'landscape',
//             stylers: [{
//                 color: '#f2f2f2'
//             }]
//         }, {
//             featureType: 'road',
//             stylers: [{
//                 saturation: -100
//             }, {
//                 lightness: 45
//             }]
//         }, {
//             featureType: 'road.highway',
//             stylers: [{
//                 visibility: 'simplified'
//             }]
//         }, {
//             featureType: 'road.arterial',
//             elementType: 'labels.icon',
//             stylers: [{
//                 visibility: 'off'
//             }]
//         }, {
//             featureType: 'administrative',
//             elementType: 'labels.text.fill',
//             stylers: [{
//                 color: '#444444'
//             }]
//         }, {
//             featureType: 'transit',
//             stylers: [{
//                 visibility: 'off'
//             }]
//         }, {
//             featureType: 'poi',
//             stylers: [{
//                 visibility: 'off'
//             }]
//         }]
//     };
//
//     // Get the HTML DOM element that will contain your map
//     // We are using a div with id="map" seen below in the <body>
//     var mapElement = document.getElementById('map-canvas');
//
//     // Create the Google Map using our element and options defined above
//     var map = new google.maps.Map(mapElement, mapOptions);
//
//     // Let's also add a marker while we're at it
//     var marker = new google.maps.Marker({
//         position: new google.maps.LatLng(22.402789, 91.822156),
//         map: map,
// 		icon: 'img/icons/map-marker.png',
//     });
// }
//
// // ========== END GOOGLE MAP ========== //
//
// var wow = new WOW ({
// 	offset:       75,          // distance to the element when triggering the animation (default is 0)
// 	mobile:       false,       // trigger animations on mobile devices (default is true)
// });
// wow.init();
//
