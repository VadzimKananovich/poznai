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
//												CREATE DOM ELEMENTS
//==============================================================================
class DomConstructor {
	private $reg_open_tag = "/(<[^\/][^>]*>)/";
	private $reg_content = "/([^<]*)/";
	private $reg_close_tag = "/<\/[^>]*>/";

	public function createElement($name = false,$att = false,$content = false){
		if(!$name){
			return false;
		}
		$res = '<'.$name;
		if($att){
			foreach($att as $key => &$value){
				$res .= ' '.$key.'="'.$value.'"';
			}
		}
		$res .= '>';
		if($content){
			$res .= "\n".$content;
		}
		$res .= "\n".'</'.$name.'>';
		return $res;
	}
	public function appendChild($parent=false,$child=false){
		if(!$parent || !$child){
			return false;
		}
		$match = array();
		preg_match_all($this->reg_close_tag,$parent,$match,PREG_OFFSET_CAPTURE);
		$end = $match[0][count($match[0])-1][1];
		$first_part = substr($parent,0,$end);
		$end_part = substr($parent,$end);
		return $first_part."\n".$child."\n".$end_part;
	}
}




//==============================================================================
//												DISPLAY PHP VAR IN CONSOLE
//==============================================================================
class DisplayVar extends Eseful {
	private $var, $script;
	private $dom;
	function __construct($var){
		$this->dom =  new DomConstructor;
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
		$dom = &$this->dom;
		$element = $dom->createElement('div',array('class'=>'php_var_value'),$this->var);
		echo $dom->createElement('div',array('class'=>'php_var'),$element."\n".$this->script);
	}
}




//==============================================================================
//												SLIDER IN HEADER
//==============================================================================
class HeaderSlider extends Eseful {

	private $slider, $src;

	function __construct($src){
		$this->src = $src;
		$this->get_slider();
		$this->init();
	}

	private function get_slider(){
		$object = json_decode(file_get_contents('JSON/header.json'));
		$this->slider = $object->slider;
	}

	private function init(){
		$slider = $this->slider;
		foreach($slider as $key => $value){
			echo $this->create_item($key,$value);
		}
	}

	private function create_item($i,$item){
		return '
		<div class="item overlay" style="background-image: URL(\''.$this->src.$this->create_img_src($item->imgPath,$item->img).'\')">
		<div class="like-section carousel-content">
		<h2 class="like-h1">'.strip_tags($item->title).'</h2>
		<div class="section-content">'.$item->desc.'</div>
		<div class="btn-group center">
		<button type="button" class="btn reverse open-modal" data-target="#contactModal">обратный звонок</button>
		</div>
		</div>
		</div>
		';
	}
}




//==============================================================================
//														SECTION COUNTER
//==============================================================================
class Counter extends Eseful {

	private $cards, $title, $subTitle, $src;

	function __construct($src){
		$this->src = $src;
		$this->get_counter();
		$this->init();
	}

	private function get_counter(){
		$object = json_decode(file_get_contents('JSON/tourAudio.json'));
		$this->cards = $object->cards;
		$this->title = strip_tags($object->title);
		$this->subTitle = strip_tags($object->subTitle);
	}

	private function init(){
		echo '<h3 class="like-h1 content-center">'.$this->title.'</h3>';
		echo '<h4 class="sub-title">'.$this->subTitle.'</h4>';
		echo '<div class="counter-container">';
		foreach($this->cards as $key => $value){
			echo $this->create_item($key,$value);
		}
		echo '</div>';
	}

	private function create_item($i,$item){
		$num = strip_tags($item->num);
		$counterStep = $this->check_counter_step($num);
		return '
		<div class="counter-item">
		<div class="counter-ico"><i class="'.strip_tags($item->ico).'"></i></div>
		<div class="counter-content">
		<span>'.strip_tags($item->beforeNumText).'</span>
		<span class="counter"'.$counterStep.'>'.strip_tags($item->num).'</span>
		<p class="counter-desc">'.strip_tags($item->afterNumText).'</p>
		</div>
		</div>
		';
	}

	private function check_counter_step($num){
		if($num > 100 && $num <= 1000){
			return ' data-counter-step="10"';
		}
		if($num > 1000 && $num <= 5000){
			return ' data-counter-step="40"';
		}
		if($num > 5000){
			return ' data-counter-step="100"';
		}
		return '';
	}
}



//==============================================================================
//														SECTION ABOUT PRODUCT
//==============================================================================
class AboutProduct extends Eseful {

	private $products, $src;

	function __construct($src){
		$this->src = $src;
		$this->get_json();
		$this->init();
	}

	private function get_json(){
		$object = json_decode(file_get_contents('JSON/products.json'));
		$this->products = $object->products;
	}

	private function init(){
		foreach($this->products as $key => $value){
			echo $this->create_item($key,$value);
		}
	}

	private function create_item($i,$item){
		$reverse = (($i+1) % 2) === 0 ? ' reverse'  : '';
		return '
		<div class="like-section">
		<h3 class="like-h1 content-center">'.strip_tags($item->title).'</h3>
		<div class="section-container row-section'.$reverse.'">
		<div class="section-img" style="background-image: URL(\''.$this->src.$this->create_img_src($item->imgPath,$item->img).'\')"></div>
		<div class="section-content">'.$item->desc.'</div>
		<div class="btn-group">
		<button type="button" class="btn open-modal" data-target="#contactModal">Обратный звонок</button>
		</div>
		</div>
		</div>
		';
	}

}



//==============================================================================
//														SECTION CONTACT US
//==============================================================================
class Contact extends Eseful {

	private $contact, $src;

	function __construct($src){
		$this->src = $src;
		$this->get_json();
		$this->init();
	}

	private function get_json(){
		$this->contact = json_decode(file_get_contents('JSON/contact_section.json'));
	}

	private function init(){
		echo '
		<h2 class="like-h1 content-center">'.strip_tags($this->contact->title).'</h2>
	  <h4 class="sub-title">'.strip_tags($this->contact->subTitle).'</h4>
		';
	}

}

?>
