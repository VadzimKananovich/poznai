<script>
	'use strict';
</script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js" integrity="sha256-mFypf4R+nyQVTrc8dBd0DKddGB5AedThU73sLmLWdc0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/preloader.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
<script type="text/javascript" src="js/responsee.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script type="text/javascript" src="assets/owl-carousel/owl.carousel.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/jquery.mixitup.min.js"></script>

<script src="jsdb/js/JSONconnect.js"></script>
<script src="js/sendMail.js"></script>
<script src="js/get_tours.js"></script>
<script src="js/showModalTour.js"></script>
<script src="js/about_belarus_info.js"></script>
<script src="js/header_slider.js"></script>
<script src="js/custom_select.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


<script type="text/javascript">
new Preloader;
jQuery(document).ready(function($) {
	var theme_slider = $("#owl-demo");
	$("#owl-demo2").owlCarousel({
		slideSpeed: 300,
		autoPlay: true,
		navigation: true,
		navigationText: ["&#xf007","&#xf006"],
		pagination: false,
		singleItem: true
	});

	$('#modalRequest').on('hidden.bs.modal', function () {
		let input = document.querySelector('#tourInput');
		input.value = '';
	});
});

new SendMail('modalRequestForm',{
	'name': 'empty',
},true);
new HeaderSlider('headerCarousel');


</script>
