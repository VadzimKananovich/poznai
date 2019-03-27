<?php
//===================================================================================
//																ICONS ARRAY
//===================================================================================
$_icon = array(
	'mts'=>'mobo-mts',
	'velcom'=>'mobo-velcom',
	'life'=>'mobo-life',
	'beltelecom'=>'mobo-beltelecom',
	'mobile'=>'mobo-default',
	'urban'=>'mobo-home',

	'vk'=>'fab fa-vk vk-ico',
	'instagram'=>'fab fa-instagram instagram-ico',
	'facebook'=>'fab fa-facebook-f fb-ico',
	'ok'=>'fab fa-odnoklassniki ok-ico',
	'youtube'=>'fab fa-youtube youtube-ico',

	'viber'=>'fab fa-viber viber-ico',
	'whatsapp'=>'fab fa-whatsapp whatsapp-ico',
	'skype'=>'fab fa-skype skype-ico',
	'telegram'=>'fab fa-telegram-plane telegram-ico',

	'email'=>'far fa-envelope email-ico'
);


//===================================================================================
//																COMMON FUNCTIONS
//===================================================================================
function cleare_path_str_main($pathStr){
	$pathStr = str_replace(' ','',$pathStr);
	$ex_path = explode('/',$pathStr);
	$filter_arr = array_filter($ex_path);
	$res_path = implode('/',$filter_arr).'/';
	return $res_path;
}

function create_phone_number($tel,$link = false){
	if(strpos($tel,'@')) return clear_str($tel);
	$text = strip_tags($tel);
	$text = str_replace(' ','',$text);
	$text = str_replace('+','',$text);
	if(!$link){
		if(strpos($text,'-')) $text = str_replace('-','',$text);
		return '+'.$text;
	} else {
		$ex_text = explode('-',$text);
		$fltr_text = array_filter($ex_text);
		$imp_text = implode('-',$fltr_text);
		$res = '+'.$imp_text;
		return $res;
	}
}

function clear_str($str){
	$str = strip_tags($str);
	return str_replace(' ','',$str);
}


//===================================================================================
//																CREATE ABOUT
//===================================================================================
$about_file = json_decode(file_get_contents($url.'JSON/about_company.json'));
$logo_array = &$about_file->logo[0];
$path_logo = cleare_path_str_main($logo_array->imgPath);

$_company_name = strip_tags($about_file->companyName);
$_company_legal_name = strip_tags($about_file->companyLegalName);
$_company_founding_date = strip_tags($about_file->foundingDate);
$_company_desc = strip_tags($about_file->companyDesc);
$_logo = $path_logo.$logo_array->img;
$_logo_title = strip_tags($logo_array->logoTitle);
list($_logo_width, $_logo_height, $_logo_type, $_logo_attr) = getimagesize($url.$_logo);


if($_logo_width > $_logo_height || $_logo_width === $_logo_height){
	$ratio = $_logo_width / $_logo_height;
	$_schema_logo_height = 300;
	$_schema_logo_width = 300 * $ratio;
} else {
	$ratio = $_logo_height / $_logo_width;
	$_schema_logo_width = 300;
	$_schema_logo_height = 300 * $ratio;
}


//===================================================================================
//																CREATE CONTACT
//===================================================================================
$contact_file = json_decode(file_get_contents($url.'JSON/contacts.json'));
$_address = &$contact_file->address;
$_city = &$contact_file->city;
$_country = &$contact_file->country;
$_postal = &$contact_file->postal;
$_region = &$contact_file->region;

$_social = &$contact_file->social;
$_email = &$contact_file->email;
$_phone = &$contact_file->phone;


// CREATE EMAIL
for($i = 0; $i < count($_email); $i++){
	$_email[$i] = clear_str($_email[$i]);
}

// CREATE PHONE
for($i = 0; $i < count($_phone); $i++){
	if($_phone[$i]->operator !== 'skypeName' && $_phone[$i]->operator !== 'email'){
		$_phone[$i]->tel_link = create_phone_number($_phone[$i]->tel);
		$_phone[$i]->tel = create_phone_number($_phone[$i]->tel,true);
	} else {
		$_phone[$i]->tel_link = clear_str($_phone[$i]->tel);
		$_phone[$i]->tel = clear_str($_phone[$i]->tel);
	}
	if($_phone[$i]->operator === 'mts'){
		$_phone[$i]->ico = &$_icon['mts'];
		$_phone[$i]->name = 'МТС';
	}
	if($_phone[$i]->operator === 'velcom') {
		$_phone[$i]->ico = &$_icon['velcom'];
		$_phone[$i]->name = 'Велком';
	}
	if($_phone[$i]->operator === 'life') {
		$_phone[$i]->ico = &$_icon['life'];
		$_phone[$i]->name = 'Life';
	}
	if($_phone[$i]->operator === 'urban') {
		$_phone[$i]->ico = &$_icon['urban'];
		$_phone[$i]->name = 'Городской';
	}
	if($_phone[$i]->operator === 'skypeName' || $_phone[$i]->operator === 'email') {
		$_phone[$i]->ico = &$_icon['skype'];
		$_phone[$i]->name = 'Skype';
	}
	$mess = &$_phone[$i]->messenger;
	for($j = 0; $j < count($mess); $j++){
		if($mess[$j] === 'viber') {
			$mess_link = 'viber://tel:'.$_phone[$i]->tel_link;
			$mess[$j] = array('key'=>'viber','name'=>'Viber','ico'=>&$_icon['viber'],'link'=>$mess_link);
		}
		if($mess[$j] === 'whatsapp') {
			$mess_link = 'whatsapp://tel:'.$_phone[$i]->tel_link;
			$mess[$j] = array('key'=>'whatsapp','name'=>'WhatsApp','ico'=>&$_icon['whatsapp'],'link'=>$mess_link);
		}
		if($mess[$j] === 'skype') {
			$mess_link = 'skype://'.$_phone[$i]->tel_link.'?call';
			$mess[$j] = array('key'=>'skype','name'=>'Skype','ico'=>&$_icon['skype'],'link'=>$mess_link);
		}
	}
}
// echo print_r($_phone);

// CREATE SOCIAL
for($i = 0; $i < count($_social); $i++){
	$_social[$i]->link = property_exists($_social[$i],'link') ? clear_str($_social[$i]->link) : '';
	if($_social[$i]->name === 'vk') {
		$_social[$i]->key = 'vk';
		unset($_social[$i]->name);
		$_social[$i]->name = 'ВКонтакте';
		$_social[$i]->ico = &$_icon['vk'];
	}
	if($_social[$i]->name === 'in') {
		$_social[$i]->key = 'in';
		unset($_social[$i]->name);
		$_social[$i]->name = 'Instagram';
		$_social[$i]->ico = &$_icon['instagram'];
	}
	if($_social[$i]->name === 'ok') {
		$_social[$i]->key = 'ok';
		unset($_social[$i]->name);
		$_social[$i]->name = 'Однокласники';
		$_social[$i]->ico = &$_icon['ok'];
	}
	if($_social[$i]->name === 'fb') {
		$_social[$i]->key = 'fb';
		unset($_social[$i]->name);
		$_social[$i]->name = 'Facebook';
		$_social[$i]->ico = &$_icon['facebook'];
	}
	if($_social[$i]->name === 'yt') {
		$_social[$i]->key = 'yt';
		unset($_social[$i]->name);
		$_social[$i]->name = 'YouTube';
		$_social[$i]->ico = &$_icon['youtube'];
	}
}
// echo print_r($_social);




//===================================================================================
//																CREAT SCHEMA JSON LD
//===================================================================================

if($_phone && count($_phone) > 0 || $_email && count($_email)){
	$_json_ld_contact = ',
	"contactPoint": {
		"@type": "ContactPoint",
		"contactType": "customer support"';
		if($_phone && count($_phone) > 0){
			$_json_ld_contact .= ',
			"telephone": "['.$_phone[0]->tel.']"';
		}
		if($_email && count($_email)){
			$_json_ld_contact .= ',
			"email": "'.$_email[0].'"';
		}
		$_json_ld_contact .= '
	}';
} else {
	$_json_ld_contact = '';
}

if($_social && count($_social) > 0){
	$_json_ld_same = ',
	"sameAs": [
		';
		for($i = 0; $i < count($_social); $i++){
			if($i === (count($_social)-1)){
				$_json_ld_same .= '"'.$_social[$i]->link.'"
				';
			} else {
				$_json_ld_same .= '"'.$_social[$i]->link.'",
				';
			}

		}
		$_json_ld_same .= ']';
	} else {
		$_json_ld_same = '';
	}

	$_json_ld_organization = '
	{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "'.$_company_name.'",
		"legalName" : "'.$_company_legal_name.'",
		"url": "'.$url.'",
		"logo": "'.$url.$_logo.'",
		"foundingDate": "'.$_company_founding_date.'",
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "'.$_address.'",
			"addressLocality": "'.$_country.'",
			"postalCode": "'.$_postal.'",
			"addressCountry": "BLR"
		}'.$_json_ld_contact.$_json_ld_same.'
	}
	';

	$_meta_tags = '
	<meta itemprop="name" content="'.$_company_name.'"/>
	<meta itemprop="description" content="
	Продажа/аренда радиогидов и оборудования для синхронного перевода с доставкой по лучшей цене. Гарантия качественного звука. Конференции, туры, экскурсии.
	"/>
	<meta itemprop="image" content="'.$url.$_logo.'"/>

	<meta property="og:locale" content="ru_RU"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Аренда, продажа радиогидов Синхронный перевод Аудиогиды"/>
	<meta property="og:description" content="
	Продажа/аренда радиогидов и оборудования для синхронного перевода с доставкой по лучшей цене. Гарантия качественного звука. Конференции, туры, экскурсии.
	"/>
	<meta property="og:image" content="'.$url.$_logo.'"/>
	<meta property="og:image:width" content="'.$_schema_logo_width.'">
	<meta property="og:image:height" content="'.$_schema_logo_height.'">
	<meta property="og:url" content="'.$url.'"/>
	<meta property="og:site_name" content="'.$_company_name.'"/>

	<meta name="twitter:card" content="Аренда, продажа радиогидов Синхронный перевод Аудиогиды">
	<meta name="twitter:site" content="'.$_company_name.'">
	<meta name="twitter:title" content="Аренда, продажа радиогидов Синхронный перевод Аудиогиды">
	<meta name="twitter:description" content="
	Продажа/аренда радиогидов и оборудования для синхронного перевода с доставкой по лучшей цене. Гарантия качественного звука. Конференции, туры, экскурсии.
	">
	<meta name="twitter:image" content="'.$url.$_logo.'">
	';
	?>
