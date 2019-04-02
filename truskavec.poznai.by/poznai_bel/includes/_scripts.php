<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js" integrity="sha256-mFypf4R+nyQVTrc8dBd0DKddGB5AedThU73sLmLWdc0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/responsee.js"></script>

<script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/jquery.mixitup.min.js"></script>
<script src="jsdb/js/jsonconnect.js"></script>
<script src="js/sendMail.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


<script type="text/javascript">
jQuery(document).ready(function($) {
	var theme_slider = $("#owl-demo");
	$("#owl-demo").owlCarousel({
		navigation: false,
		slideSpeed: 300,
		paginationSpeed: 400,
		autoPlay: 6000,
		addClassActive: true,
		// transitionStyle: "fade",
		singleItem: true
	});
	$("#owl-demo2").owlCarousel({
		slideSpeed: 300,
		autoPlay: true,
		navigation: true,
		navigationText: ["&#xf007","&#xf006"],
		pagination: false,
		singleItem: true
	});

	jQuery('#popularslider').mixItUp({
		selectors: {
			target: '.tile',
			filter: '.filter'
			//           sort: '.sort-btn'
		},
		animation: {
			animateResizeContainer: false,
			effects: 'fade scale'
		}

	});

	$('.portfolio-img').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});


	// vad.connect()
	// .then (vad.write.bind(vad,'home','tours',{
	// 	'italy': {'name':'Италия', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'popular'},
	// 	'italy2': {'name':'Италия', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'popular'},
	// 	'italy3': {'name':'Италия', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'popular'},
	// 	'italy4': {'name':'Италия', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'popular'},
	// 	'italy5': {'name':'Италия', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'popular'},
	// 	'italy6': {'name':'Италия', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'popular'},
	// 	'italy7': {'name':'Италия', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'popular'},
	// 	'italy123': {'name':'Италия123', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'all'},
	// 	'italy123': {'name':'Италия123', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'all'},
	// 	'italy123': {'name':'Италия1234', 'img':'img/tours/italy', 'desc':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'price':'230', 'currency':'BIN','type':'all'}
	// }));



});

</script>
