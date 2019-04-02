<?php

//==============================================================================
//														ESEFUL FUNCTIONS
//==============================================================================
class Eseful {
	function clear_path($pathStr){
		$pathStr = strip_tags($pathStr);
		$pathStr = str_replace(' ','',$pathStr);
		$ex_path = explode('/',$pathStr);
		$filter_arr = array_filter($ex_path);
		$res_path = implode('/',$filter_arr).'/';
		return $res_path;
	}
	function clear_str($str){
		$str = strip_tags($str);
		return str_replace(' ','',$str);
	}
	function create_img_src($path,$img){
		$imgPath = $this->clear_path($path);
		$imgFile = $this->clear_str($img);
		return $imgPath.$imgFile;
	}
	function randomName($length = 10) {
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}


//==============================================================================
//												DISPLAY PHP VAR IN CONSOLE
//==============================================================================
class DisplayVar extends Eseful {

	private $var, $script;

	function __construct($var){
		$this->var = json_encode($var);
		$this->create_script();
		$this->create_element();
	}
	private function create_script(){
		$name = $this->randomName(10);
		$this->script = '
		<script>
		class '.$name.' {
			constructor(){
				this.init();
			}
			init(){
				let el = document.querySelectorAll(\'.php_var_value\');
				el.forEach(item=>{
					console.log(JSON.parse(item.textContent));
					item.parentNode.parentNode.removeChild(item.parentNode);
				});
			}
		}
		new '.$name.';
		</script>
		';
	}
	private function create_element(){
		echo '
		<div class="php_var">
		<div class="php_var_value">
		'.$this->var.'
		</div>
		'.$this->script.'
		</div>
		';
	}
}







//==============================================================================
//															COMMON CLASSES
//==============================================================================
class GetTours{

	private $conn,$status;
	public $result = array();

	function __construct($conn,$status){
		$this->conn = $conn;
		$this->status = $status;
		$this->get_tours();
	}
	private function get_tours(){
		$conn = $this->conn;
		$status = $this->status;
		$query = "SELECT * FROM `tours` WHERE `status` = '$status' ORDER BY `sort`";
		$result = $conn->query($query);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			array_push($this->result,$row);
		}
	}
}

class InfoTour{
	private $conn,$tour;
	public $info;

	function __construct($conn,$tour){
		$this->conn = $conn;
		$this->tour = $tour;
		$this->get_info();
	}
	private function get_info(){
		$query = "SELECT * FROM `countries` WHERE `country_key` = '$this->tour'";
		$result = $this->conn->query($query);
		$this->info = $result->fetch_array(MYSQLI_ASSOC);
	}
}

class InfoBlock {
	private $conn,$block;
	public $info;

	function __construct($conn,$block){
		$this->conn = $conn;
		$this->block = $block;
		$this->get_info();
	}
	private function get_info(){
		$query = "SELECT `title`, `sub_title` FROM `hot.poznai.by_blocks` WHERE `block` = '{$this->block}'";
		$result = $this->conn->query($query);
		$this->info = $result->fetch_array(MYSQLI_ASSOC);
	}
}

class InfoBlog {
	private $conn;
	public $blog = array();

	function __construct($conn){
		$this->conn = $conn;
		$this->get_blog();
	}

	private function get_blog() {
		$query = "SELECT * FROM `blog` WHERE `country_key` IS NOT NULL ORDER BY `id`";
		$result = $this->conn->query($query);
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			array_push($this->blog,$row);
		}
	}
}

class Comments {
	private $conn;
	public $comments = array();

	function __construct($conn){
		$this->conn = $conn;
		$this->get_comments();
	}
	private function get_comments(){
		$query = "SELECT * FROM `comments` WHERE `status` = 'accept'";
		$result = $this->conn->query($query);
		if($row = $result->fetch_array(MYSQLI_ASSOC)){
			array_push($this->comments,$row);
		}
	}
}

class MenuDates {
	private $conn;
	public $menu = array();

	function __construct($conn){
		$this->conn = $conn;
		$this->get_menu();
	}
	private function get_menu(){
		$query= "SELECT * FROM `hot.poznai.by_menu` WHERE `link_type` IS NOT NULL AND `href` IS NOT NULL ORDER BY `id`";
		$result = $this->conn->query($query);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			array_push($this->menu,$row);
		}
	}
}

class Info {
	public $info;

	function __construct($conn){
		$query = "SELECT * FROM `info`";
		$res = $conn->query($query);
		$this->info = $res->fetch_array(MYSQLI_ASSOC);
	}

}


//==============================================================================
//																	MENU
//==============================================================================
class Menu {
	private $url, $menu, $info;

	function __construct($url,$conn){
		$this->url = $url;
		$menu = new MenuDates($conn);
		$this->menu = $menu->menu;
		$info = new Info($conn);
		$this->info = $info->info;
		$this->create_menu();
	}
	private function create_menu(){
		echo '<nav class="nav-bar" id="navBar">';
		echo '<div class="container-fluid">';
		echo $this->create_logo();
		echo $this->create_nav();
		echo '</div>';
		echo '</nav>';
	}

	private function create_logo(){
		return '
		<div class="nav-logo">
		<i class="ico fas fa-plane-departure"></i>
		<h1 class="strong">'.$this->info['name'].'</h1>
		</div>
		';
	}

	private function create_nav(){
		$res = '
		<div class="nav-menu-wrap">
		<div class="drop-down-btn">
		<i class="fas fa-bars"></i>
		</div>
		<ul class="nav-menu" id="topMenu">
		';
		foreach($this->menu as $item){
			if($item['link_type'] === 'internal'){
				$href = $item['href'];
				$class = ' navigate';
			} else {
				$href = $this->url.$item['href'];
				$class = ' v-btn';
			}
			$res .= '
			<li class="nav-item"><a href="'.$href.'" class="nav-link'.$class.'">'.$item['title'].'</a></li>
			';
		}
		$res .= '
		<li class="close-btn">
		<i class="fas fa-times"></i>
		</li>
		';
		$res .= '
		</ul>
		</div>
		';
		return $res;
	}
}

//==============================================================================
//												SLIDER IN HEADER
//==============================================================================
class HeaderSlider extends Eseful {

	private $url, $tours, $conn;

	function __construct($url,$conn){
		$this->url = $url;
		$this->conn = $conn;
		$tours = new GetTours($conn,'hot');
		$this->tours = $tours->result;
		$this->create_slider();
	}

	private function create_slider(){
		$tours = $this->tours;
		echo '
		<header class="header">
		<div class="owl-carousel header-carousel">
		';
		foreach($tours as $tour){
			$info_tour = new InfoTour($this->conn, $tour['country_key']);
			echo $this->create_item($tour, $info_tour->info);
		}
		echo '
		</div>
		</header>
		';
	}

	private function create_item($tour, $info){
		return '
		<div class="item header-item overlay" style="background-image: URL(\'http://files.poznai.by/countries/'.$tour['country_key'].'/'.$tour['img'].'\')">
		<div class="header-content container-fluid">
		<div class="row">
		<div class="form-col col-md-6 order-2 order-md-1">
		<form class="header-form form" action="includes/request.php?action=send_request&id='.$tour['country_key'].'" method="post">
		<div class="form-head">
		<span class="flag" style="background-image:URL(\'http://files.poznai.by/countries/'.$tour['country_key'].'/flag.gif\');"></span>
		<h4 class="city-name strong">'.$info['name'].'</h4>
		</div>
		<div class="form-body">
		<div class="form-group">
		<label for="headerName">Имя</label>
		<input type="text" name="headerName" id="headerName" required>
		</div>
		<div class="form-group">
		<label for="headerNum">Телефон</label>
		<input type="text" name="headerNum" id="headerNum" value="+375" required>
		</div>
		</div>
		<div class="form-footer">
		<div class="btn-row center">
		<button type="submit" id="sendHeaderForm" class="v-btn dark">Заказать консультацию</button>
		</div>
		</div>
		</form>
		</div>
		<div class="desc-col col-md-6 order-1 order-md-2">
		<h2 class="big-title">Горящие туры '.$info['declension'].'</h2>
		<h5 class="section-sub-title strong">'.$info['shirt_desc'].'</h5>
		<h6 class="header-price big-title">от <span class="price">'.$tour['currency'].$tour['price'].'</span></h6>
		</div>
		</div>
		</div>
		</div>
		';
	}

}

//==============================================================================
//														OUR TOURS BLOCK
//==============================================================================
class OurTours extends Eseful {

	public $url, $info, $blog;

	function __construct($url,$conn){
		$this->url = $url;
		$this->conn = $conn;
		$block_info = new InfoBlock($conn,'2');
		$this->info = $block_info->info;
		$blog = new InfoBlog($conn);
		$this->blog = $blog->blog;
		$this->create_block();
	}

	private function create_block(){
		echo '<section class="section blog-slider" id="">';
		echo $this->insert_info();
		echo '<div class="owl-carousel blog-carousel">';
		foreach($this->blog as $article){
			echo $this->insert_slide_article($article);
		}
		echo '
		</div>
		</section>
		';
	}

	private function insert_info(){
		return '
		<h3 class="section-title">'.$this->info['title'].'</h3>
		<h6 class="section-sub-title">'.$this->info['sub_title'].'</h6>
		<span class="section-div"></span>
		';
	}

	private function insert_slide_article($art){
		return '
		<div class="item blog-item">
		<div class="card-img" style="background-image:URL(\'http://files.poznai.by/countries/'.$art['country_key'].'/'.$art['figure'].'\');"></div>
		<div class="blog-card-body">
		<h6 class="card-title strong">'.$art['title'].'</h6>
		<p class="card-des">'.$this->create_small_str($art['article'],250).'</p>
		</div>
		<div class="blog-card-footer btn-row center">
		<a href="./blog?article='.$art['id'].'" class="v-btn dark">Читать все <i class="fas fa-long-arrow-alt-right"></i></a>
		</div>
		</div>
		';
	}

	private function create_small_str($str,$len){
		if(strlen($str) > $len){
			return mb_substr(strip_tags($str),0,$len,'utf-8').'...';
		} else {
			return strip_tags($str).'...';
		}
	}
}


//==============================================================================
//														BOX TOURS
//==============================================================================
class BoxTours extends Eseful {

	public $url, $info, $tours;

	function __construct($url,$conn,$key){
		$this->url = $url;
		$this->conn = $conn;
		switch($key){
			case 'hot':
			$id = '3';
			$class = 'hot-tours';
			$sectionId = 'hotTours';
			break;
			case 'early':
			$id = '4';
			$class = 'early-tours';
			$sectionId = 'earlyTours';
			break;
		}
		$block_info = new InfoBlock($conn,$id);
		$this->info = $block_info->info;
		$tours = new GetTours($conn,$key);
		$this->tours = $tours->result;
		$this->create_block($class,$sectionId);
	}

	private function create_block($class, $sectionId){
		echo '<section class="'.$class.' section" id="'.$sectionId.'">';
		echo $this->insert_info();
		echo '<div class="tours-box container-fluid">';
		foreach($this->tours as $tour) {
			$info_tour = new InfoTour($this->conn, $tour['country_key']);
			echo $this->insert_card_tour($tour,$info_tour->info);
		}
		echo '
		</div>
		</section>
		';
	}
	private function insert_info(){
		return '
		<h3 class="section-title">'.$this->info['title'].'</h3>
		<h6 class="section-sub-title">'.$this->info['sub_title'].'</h6>
		<span class="section-div"></span>
		';
	}
	private function insert_card_tour($tour,$info){
		echo '
		<div class="box-item" style="background-image: URL(\'http://files.poznai.by/countries/'.$tour['country_key'].'/'.$tour['img'].'\');">
		<div class="box-content">
		<div class="item-desc">
		<h5 class="title">'.$info['name'].'</h5>
		<p>'.$info['shirt_desc'].'</p>
		<span class="strong price">'.$tour['currency'].$tour['price'].'</span>
		<div class="btn-row">
		<button class="v-btn light">Обратный звонок</button>
		</div>
		</div>
		</div>
		</div>
		';
	}
}



//==============================================================================
//														TESTIMONAILS
//==============================================================================
class Testimonials{
	private $url,$conn, $comments,$info;

	function __construct($url,$conn){
		$this->url = $url;
		$comments = new Comments($conn);
		$this->comments = $comments->comments;
		$info = new InfoBlock($conn,'5');
		$this->info = $info->info;
		$this->create_block();
	}

	private function create_block(){
		echo '<section class="testimonials section" id="testimonials">';
		echo $this->insert_info();
		echo '<div class="testimonials-carousel owl-carousel">';
		foreach($this->comments as $comment){
			echo $this->create_comment($comment);
		}
		echo '
		</div>
		<div class="btn-row center">
		<button type="button" class="v-btn dark btn-comment"><i class="far fa-comments"></i> Оставить отзыв</button>
		</div>
		</section>
		';
	}

	private function insert_info(){
		return '
		<h3 class="section-title">'.$this->info['title'].'</h3>
		<h6 class="section-sub-title">'.$this->info['sub_title'].'</h6>
		<span class="section-div"></span>
		';
	}

	private function create_comment($comment){
		return '
		<div class="item item-testimony">
		<div class="box-testimony">
		<blockquote>
		<span class="quote"><i class="fas fa-quote-right"></i></span>
		<p>
		<span class="comment-quote left">"</span>
		<span class="comment-content">'.$comment['comment'].'</span>
		<span class="comment-quote right">"</span>
		</p>
		</blockquote>
		<p class="author title">'.$comment['name'].'</p>
		</div>
		</div>
		';
	}
}


?>
