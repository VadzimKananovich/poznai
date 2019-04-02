<?php


//==============================================================================
//														ESEFUL FUNCTIONS
//==============================================================================
class Eseful {
	function clear_path($pathStr){
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
		$this->var = htmlspecialchars(json_encode($var));
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

?>
