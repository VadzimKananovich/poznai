<?php get_header(); ?> 
<div class="row align-center" style="background:url(<?php echo get_template_directory_uri(); ?>/dist/images/tailand.jpg) center center">
	<div class="col col-9">
	<div class="row align-middle">
		<div class="col col-3"><br/><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.png" alt=""></a></div>
		<div class="col col-6 text-center"><br/><br/><h2 style="color:#fff;">+375 (29) 694-50-11<br/>+375 (17) 284-44-62</h2></div>
		<div class="col col-3" style="text-align:right;"><br/><button class="button upper round " data-component="modal" data-target="#my-modal">Перезвонить Вам?</button></div>
	</div>
	<div class="row align-center">
		<div class="col"><h1 class="text-center" style="margin:80px 0;color:#fff;"><b>ГОРЯЩИЕ ТУРЫ В ТАИЛАНД от <span class="red">482$</span></b></h1></div>
	</div>
	<div class="row align-center" style="background-color:#edcd0c;border-radius:10px 10px;margin-bottom:60px;padding:10px 30px;">
	<div class="col-8  align-center">
	<?php echo do_shortcode('[contact-form-7 id="7" title="Главная форма"]'); ?>
		</div></div>
	</div>
</div>

<div class="row" style="background-color:#23282d;color:#fff;padding:0px 20px">
    <div class="col-12 text-center">
<div id="navbar">
	<div id="navbar-brand"><b>Куда? </b> </div>
	<nav id="navbar-main">
		<ul>
			<li><a href="http://hot.poznai.by/">Египет</a></li>
			<li><a href="http://hot.poznai.by/indiya/">Индия</a></li>
			<li><a href="http://hot.poznai.by/tajland/" class="active">Тайланд</a></li>
			<li><a href="http://hot.poznai.by/oae/">ОАЭ</a></li>
			<li><a href="http://hot.poznai.by/shri-lanka/">Шри-Ланка</a></li>
			<li><a href="http://hot.poznai.by/vetnam/">Вьетнам</a></li>
			<li><a href="http://hot.poznai.by/kuba/">Куба</a></li>
			<li><a href="http://hot.poznai.by/dominikana/">Доминикана</a></li>
			<li><a href="http://hot.poznai.by/marokko/">Марокко</a></li>
			<li><a href="http://hot.poznai.by/o-bali/">о.Бали</a></li>
			<li><a href="http://hot.poznai.by/kambodzha/">Камбоджа</a></li>
			<li><a href="http://hot.poznai.by/maldivy/">Мальдивы</a></li>
		</ul>
	</nav>
</div>
	</div>
</div>

<div class="row" style="margin:50px 0px 60px;">
	<div class="col col-1"></div>
	<div class="col col-3"><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.png" alt=""></a></div>
	<div class="col col-4 text-center"><h2>+375 (29) 694-50-11<br/>+375 (17) 284-44-62<br/><a href="mailto:sales@poznai.by">sales@poznai.by</a></h2></div>
	<div class="col col-3 text-center"><button class="button upper" data-component="modal" data-target="#my-modal-3">Задать вопрос менеджеру</button></div>
	<div class="col col-1"></div>
</div>
<?php get_footer(); ?>