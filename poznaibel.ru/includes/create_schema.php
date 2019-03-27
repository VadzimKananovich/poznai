<?php

//================================================================
//                             TOURS SCHEMA
//================================================================

function create_tour_schema($tour,$key,$index,$url=''){
	if($tour === 'belarus'){
		$json = json_decode(file_get_contents('jsdb/JSON/tours/belarus.json'));
	}
	if($tour === 'belarus_pref'){
		$json = json_decode(file_get_contents('jsdb/JSON/tours/belarus_pref.json'));
	}
	if($tour === 'foreigners'){
		$json = json_decode(file_get_contents('jsdb/JSON/tours/foreigners.json'));
	}
	if($tour === 'foreigners_pref'){
		$json = json_decode(file_get_contents('jsdb/JSON/tours/foreigners_pref.json'));
	}
	$all_tours = $json[0]->$key;
	$curr_tour = $all_tours[(int)$index];
	$schema_name = strip_tags($curr_tour->name);
	$schema_desc = strip_tags($curr_tour->desc);
	$schema_price = strip_tags($curr_tour->price);
	$schema_currency = strip_tags($curr_tour->currency);
	$schema_route = strip_tags($curr_tour->route);
	$schema_keywords = create_keywords($schema_route);
	if(property_exists($curr_tour,'duration')){
		$schema_duration = strip_tags($curr_tour->duration);
	} else {
		$schema_duration = 'no dates';
	}
	$schema_program = strip_tags($curr_tour->program);
	$img = $curr_tour->img;
	$scan_dir = scandir($img);
	$schema_img = $url.$img.'/'.$scan_dir[2];
	return array(
		cleare_str($schema_name),
		cleare_str($schema_desc),
		cleare_str($schema_price),
		cleare_str($schema_currency),
		cleare_str($schema_route),
		cleare_str($schema_duration),
		cleare_str($schema_program),
		cleare_str($schema_img),
		$schema_keywords
	);
}

//================================================================
//                             CONTACT SCHEMA
//================================================================

function create_contact_schema(){
	$contacts_json = json_decode(file_get_contents('jsdb/JSON/common/contacts.json'));
	$contacts = $contacts_json[0];

	$city = $contacts->city;
	$address = $contacts->address;
	$postal = $contacts->postal;
	$email = cleare_white_space($contacts->email);
	$phone = cleare_phone($contacts->phone);
	$social = $contacts->social;

	return array(
		$city,
		$address,
		$postal,
		$email,
		$phone,
		$social
	);
}

//================================================================
//                             COMMENTS SCHEMA
//================================================================
function create_comments_schema(){
	$comments_file = json_decode(file_get_contents('jsdb/JSON/about/comments.json'));
	return $comments_file;
}



//================================================================
//                     PREVIEW HOME SLIDER SCHEMA
//================================================================
function create_schema_preview($key,$item){
	$about_files = json_decode(file_get_contents('jsdb/JSON/home/about_belarus.json'));
	$about_belarus = $about_files[0];

	$title = $about_belarus->$key->tabs_name;
	$image = 'img/about_belarus/'.$key.'/'.$about_belarus->$key->img[(int)$item]->src;
	$name = $about_belarus->$key->img[(int)$item]->title;
	$desc = $about_belarus->$key->img[(int)$item]->desc;

	return array($title,$image,$name,$desc,);

}
//================================================================
//                             OTHER FUNCTIONS
//================================================================

function cleare_str($str){
	$str = str_replace("'", "", $str);
	$str = str_replace("\"", "", $str);
	$str = preg_replace("/&#?[a-z0-9]{2,8};/i","",$str);
	$str= preg_replace("/  +/"," ",$str);
	return $str;
}
function cleare_phone($item){
	for($i = 0; $i < count($item); $i++){
		$item[$i]->tel = cleare_white_space($item[$i]->tel);
		$item[$i]->tel = str_replace('+', '', $item[$i]->tel);
		$item[$i]->tel = '+'.$item[$i]->tel;
	}
	return $item;
}
function cleare_white_space($str){
	return preg_replace('/\s+/', '', $str);
}
function create_keywords($item){

	$ex_item = explode('-', $item);
	for($i = 0; $i < count($ex_item); $i++){
		$ex_item[$i] = cleare_white_space($ex_item[$i]);
		$ex_item[$i] = str_replace('"', " ", $ex_item[$i]);
		$ex_item[$i] = str_replace("'", " ", $ex_item[$i]);
	}
	return $ex_item;
}
?>
