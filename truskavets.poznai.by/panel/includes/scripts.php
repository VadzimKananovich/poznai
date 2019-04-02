<?php

if(isset($_GET['level'])){
	$sub = (int)$_GET['level'];
	$path = '';
	for($i = 0; $i < count($sub); $i++){
		$path .='../';
	}
}

?>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script> -->
<!-- <script data-require="MomentJS@2.10.0" data-semver="2.10.0" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ru.js"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.ru.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="<?php echo $url;  ?>panel/js/dropzone.js?v=<?php echo microtime(); ?>"></script>
<script src="<?php echo $url;  ?>panel/js/common_functions.js?v=<?php echo microtime(); ?>"></script>
<script src="<?php echo $url;  ?>panel/js/buttons.js?v=<?php echo microtime(); ?>"></script>
<script src="<?php echo $url;  ?>panel/js/form_elements.js?v=<?php echo microtime(); ?>"></script>
<script src="<?php echo $url;  ?>panel/js/modal_window.js?v=<?php echo microtime(); ?>"></script>
<script src="<?php echo $url;  ?>panel/js/table.js?v=<?php echo microtime(); ?>"></script>
<script src="<?php echo $url;  ?>panel/js/table_set.js?v=<?php echo microtime(); ?>"></script>
<script src="<?php echo $url;  ?>panel/js/admin.js?v=<?php echo microtime(); ?>"></script>
<script type="text/javascript" src="<?php echo $url; ?>js/owl.carousel.min.js?v=<?php echo microtime(); ?>"></script>
