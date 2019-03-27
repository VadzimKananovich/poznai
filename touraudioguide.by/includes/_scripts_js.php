<!-- <script src="assets/vendors/popup/lightbox.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {
  $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
    e.preventDefault();
    $(this).siblings('a.active').removeClass("active");
    $(this).addClass("active");
    var index = $(this).index();
    $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
    $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".currency_year").hide();
  $("#radio1").click(function(){
    $(".currency_year").hide();
    $(".currency_month").show();
  });
  $("#radio2").click(function(){
    $(".currency_month").hide();
    $(".currency_year").show();
  });
});

$('.tabs_label').click(function(){
  $('.tabs_label').removeClass('active_t');
  $(this).addClass('active_t');

})

</script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/vendors/animate/wow.min.js"></script>
<script src="assets/vendors/sidebar/main.js"></script>
<script src="assets/vendors/owl_carousel/carousel.js"></script>
<script src="assets/js/theme.js"></script>
<script src="js/upButton.js"></script>
<script src="js/sendMail.js"></script>

<script>
new SendMail('commentForm',{
  'commentName':'empty',
  'commentEmail':'empty',
  'commentText':'empty'
});

let upButton = new UpButton(true,300,'img/up.svg');
</script>
