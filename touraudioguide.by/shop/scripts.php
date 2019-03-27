
<script src="shop/shopArray.js"></script>
<script src="shop/commonElements.js"></script>
<script src="shop/modal.js"></script>
<script src="shop/slide.js"></script>

<!-- =========================================================================== MENU -->
<!-- <script src="shop/menu/drop_down.js"></script>
<script src="shop/menu/display.js"></script>
<script src="shop/menu/series.js"></script>
<script src="shop/menu/category.js"></script>
<script src="shop/menu/sort.js"></script>
<script src="shop/menu/setAlert.js"></script>
<script src="shop/menu/filter.js"></script>
<script src="shop/menu/search.js"></script>
<script src="shop/menu/cartResult.js"></script>
<script src="shop/menu/cart.js"></script>
<script src="shop/menu/main.js"></script> -->

<!-- =========================================================================== body -->
<script src="shop/body/rowItem.js"></script>
<script src="shop/body/category.js"></script>
<script src="shop/body/navButtons.js"></script>
<script src="shop/body/main.js"></script>

<script src="shop/controlFunctions.js"></script>
<script src="shop/main.js"></script>

<script>
$(document).ready(function(){
	if(shop){
		$.ajax({
			cache: false,
			type: "POST",
			url: "includes/request.php",
			processData: true,
			data: {request:'products'},
			success: function(res) {
				let products = $.parseJSON(res);
				let shop = new Shop(products,'#shop');
			}
		});
	}
});
</script>
