<?php
class Eseful {

	function clear_path($pathStr){
		$pathStr = str_replace(' ','',$pathStr);
		$ex_path = explode('/',$pathStr);
		$filter_arr = array_filter($ex_path);
		$res_path = implode('/',$filter_arr).'/';
		return $res_path;
	}

	function clear_str($str){
		return str_replace(' ','',$str);
	}

	function create_img_src($path,$img){
		$imgPath = $this->clear_path($path);
		$imgFile = $this->clear_str($img);
		return $imgPath.$imgFile;
	}

}


// =============================================================================
//															SLIDER IN HEADER
// =============================================================================
class Slider {

	private $title, $for, $slogan, $desc, $img, $eseful;
	public $item;

	function __construct($set,$className,$key){
		$this->eseful = new Eseful;
		$this->title = strip_tags($set->title);
		$this->for = strip_tags($set->for);
		$this->slogan = strip_tags($set->slogan);
		$this->desc = strip_tags($set->desc);
		$imgPath = strip_tags($this->eseful->clear_path($set->imgPath));
		$imgFile = $this->eseful->clear_str($set->img);
		$this->img = $imgPath.$imgFile;
		$this->item = $this->create_item($className,$key);
	}
	private function create_item($className,$key){
		$title = $this->create_title();
		$for = $this->create_for();
		$slogan = $this->create_slogan();
		$desc = $this->create_desc();
		$btn = $this->create_btn($key);
		return '
		<div class="item'.$className.'" style="background-image: URL(\''.$this->img.'\')">
		<div class="overlay">
		<div class="header-container">
		'.$title.'
		'.$for.'
		'.$slogan.'
		'.$desc.'
		'.$btn.'
		</div>
		</div>
		</div>
		';
	}
	private function create_img(){
		return '<img src="'.$this->img.'" alt="'.$this->for.'">';
	}
	private function create_title(){
		return '<h3 class="carousel-title">'.$this->title.'</h3>';
	}
	private function create_for(){
		return '<h1 class="carousel-for">'.$this->for.'</h1>';
	}
	private function create_slogan(){
		return '<h1 class="second_heading carousel-slogan">'.$this->slogan.'</h1>';
	}
	private function create_desc(){
		return '<p class="carousel-content">'.$this->desc.'</p>';
	}
	private function create_btn($key){
		return '
		<div class="btn-wrap">
		<button type="button" data-key="'.$key.'" class="read-more-btn btn know_btn">Узнать больше</button>
		<button type="button" data-toggle="modal" data-target="#contactModal" class="contact-btn btn know_btn btn-reverse">Консультация</button>
		</div>
		';
	}
}


// =============================================================================
//															ABOUT PRODUCT
// =============================================================================
class AboutProduct {

	private $eseful,$title,$subTitle,$desc,$img,$bg;
	public $result;

	function __construct(){
		$this->eseful = new Eseful;
		$this->get_elements();
		$this->write_result();
	}
	private function get_elements(){
		$object = json_decode(file_get_contents('JSON/about.json'));
		$this->title = strip_tags($object->title);
		$this->subTitle = strip_tags($object->sub_title);
		$array = &$object->content[0];
		$this->desc = $array->desc;
		$imgPath = $this->eseful->clear_path(strip_tags($array->imgPath));
		$imgFile = $this->eseful->clear_str(strip_tags($array->img));
		$imgBg = $this->eseful->clear_str(strip_tags($array->bgImg));
		$this->img = $imgPath.$imgFile;
		$this->bg = $imgPath.$imgBg;
	}
	private function write_result(){
		$this->result = array(
			'title' => $this->title,
			'subTitle' => $this->subTitle,
			'desc' => $this->desc,
			'img' => $this->img,
			'bg' => $this->bg
		);
	}
}


// =============================================================================
//															WHY WE
// =============================================================================
class WhyWe extends Eseful {

	private $title,$subTitle,$cards;
	public $whyWe;

	function __construct(){
		$this->get_dates();
		$this->write_dates();
	}
	private function get_dates(){
		$object = json_decode(file_get_contents('JSON/whyWe.json'));
		$this->title = strip_tags($object->title);
		$this->subTitle = strip_tags($object->sub_title);
		$this->cards = &$object->whyWe;
	}
	private function write_dates(){
		$this->whyWe = array(
			'title'=>$this->title,
			'subTitle'=>$this->subTitle
		);
	}
	public function insertCards(){
		foreach($this->cards as $card){
			echo '
			<div class="col-md-3 col-sm-6">
				<div class="why_us_item" data-aos="zoom-in" data-aos-duration="1000">
					<i class="'.$card->ico.'"></i>
					<h4>'.$card->title.'</h4>
					<p>
					</p>
				</div>
			</div>
			';
		}
	}
}

// =============================================================================
//																	WITH US
// =============================================================================
class WithUs extends Eseful{

	private $cards;
	public $title;

	function __construct(){
		$this->get_dates();
	}
	private function get_dates(){
		$object = json_decode(file_get_contents('JSON/withUs.json'));
		$this->title = strip_tags($object->title);
		$this->cards = &$object->cards;
	}
	public function insertCards(){
		foreach($this->cards as $card){
			$imgPath = $this->clear_path($card->imgPath);
			$imgFile = $this->clear_str($card->img);
			$img = $imgPath.$imgFile;
			echo '
			<div class="col-md-4">
			<div class="with_us_item" data-aos="fade-up">
			<div class="with_us_img" style="background-image: url(\''.$img.'\')"></div>
			<h3>'.strip_tags($card->title).'</h3>
			<p>
			'.$card->desc.'
			</p>
			</div>
			</div>
			';
		}
	}
}


// =============================================================================
//																	COMMENTS
// =============================================================================
class Comments extends Eseful{

	private $comments;
	public $dates;

	function __construct(){
		$this->get_dates();
	}
	private function get_dates(){
		$object = json_decode(file_get_contents('JSON/comments.json'));
		$this->dates = array(
			'title'=>strip_tags($object->title),
			'subTitle'=>strip_tags($object->sub_title)
		);
		$this->comments = &$object->comments;
	}
	public function insertComments(){
		foreach($this->comments as $comment){
			$img = $this->create_img_src($comment->imgPath,$comment->img);
			echo '
			<div class="col-md-4">
				<div class="testimonial_item">
					<div class="testimonial_content" data-aos="fade-in">
						<p>'.strip_tags($comment->comment).'</p>
					</div>
					<div class="testimonial_img">
						<div class="wrap_img" data-aos="zoom-in" style="background-image:url(\''.$img.'\');"></div>
						<p class="worker_name">'.strip_tags($comment->name).'</p>
					</div>
				</div>
			</div>
			';
		}
	}
}
?>
