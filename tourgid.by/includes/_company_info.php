<?php
class CompanyInfo extends Eseful {

	private $set;
	private $contacts,$info,$ico,$translate;
	public $about = array();
	public $json_organisation, $meta_tags;

	function __construct($set){
		$this->init_default_set();
		$this->init_passed_set($set);

		$contact_path = 'JSON/contacts.json';
		$about_path = 'JSON/about_company.json';
		if(file_exists($contact_path) && file_exists($about_path)){
			$this->about['info'] = &$this->info;
			$this->about['contacts'] = &$this->contacts;

			$this->get_dates();
			$this->create_icons();
			$this->create_translate();

			$this->create_contacts();
			$this->create_info();
		} else {
			$this->about = false;
		}
	}

	private function init_default_set(){
		$this->set = array(
			'url'=>'/',
			'numRegional'=>'BEL'
		);
	}
	private function init_passed_set($set){
		foreach($set as $key => $value){
			$this->set[$key] = $value;
		}
	}

	private function get_dates(){
		$this->contacts = json_decode(file_get_contents($this->set['url'].'JSON/contacts.json'));
		$this->info = json_decode(file_get_contents($this->set['url'].'JSON/about_company.json'));
	}

	private function create_icons(){
		$this->ico = array(
			'mts'=>'mobo-mts',
			'velcom'=>'mobo-velcom',
			'life'=>'mobo-life',
			'beltelecom'=>'mobo-beltelecom',
			'mobile'=>'mobo-default',
			'urban'=>'mobo-home',

			'vk'=>'fab fa-vk vk-ico',
			'in'=>'fab fa-instagram instagram-ico',
			'fb'=>'fab fa-facebook-f fb-ico',
			'ok'=>'fab fa-odnoklassniki ok-ico',
			'yt'=>'fab fa-youtube youtube-ico',

			'viber'=>'fab fa-viber viber-ico',
			'whatsapp'=>'fab fa-whatsapp whatsapp-ico',
			'skype'=>'fab fa-skype skype-ico',
			'telegram'=>'fab fa-telegram-plane telegram-ico',

			'email'=>'far fa-envelope email-ico'
		);
	}

	private function create_translate(){
		$this->translate = array(
			'velcom'=>'Velcom',
			'mts'=>'МТС',
			'life'=>'Life',
			'urban'=>'Городской',
			'email'=>'Email',
			'skypeName'=>'Имя в skype',

			'whatsapp'=>'WhatsApp',
			'viber'=>'Viber',
			'skype'=>'Skype',

			'vk'=>'ВКонтакте',
			'in'=>'Instagram',
			'ok'=>'Одноклассники',
			'fb'=>'FaceBook',
			'yt'=>'YouTube'
		);
	}

	private function create_contacts(){
		$this->contacts->address = strip_tags($this->contacts->address);
		$this->contacts->city = strip_tags($this->contacts->city);
		$this->contacts->country = strip_tags($this->contacts->country);
		$this->contacts->postal = strip_tags($this->contacts->postal);
		$this->contacts->region = strip_tags($this->contacts->region);
		$this->contacts->email = $this->clear_email($this->contacts->email);
		$this->contacts->phone = $this->create_phone_array($this->contacts->phone);
		$this->contacts->social = $this->create_social_array($this->contacts->social);
	}

	private function clear_email($email){
		for($i = 0; $i < count($email); $i++){
			$email[$i] = strip_tags($email[$i]);
			$email[$i] = $this->clear_str($email[$i]);
		}
		return $email;
	}

	private function create_phone_array($phone){
		for($i = 0; $i < count($phone); $i++) {
			$phone[$i] = $this->create_phone_object($phone[$i]);
		}
		return $phone;
	}

	private function create_phone_object($phone){
		foreach($phone as $key => $value){
			if($key === 'messenger'){
				$phone->$key = $this->create_messenger($value);
			} else {
				$phone->$key = strip_tags($value);
			}
			if($key === 'operator'){
				$phone->ico = $this->ico[$value];
			}
			if($key === 'tel'){
				$phone->num_link = strip_tags($this->create_num_link($value));
				$phone->num_value = strip_tags($this->create_num_value($value));
			}
		}
		return $phone;
	}

	private function create_messenger($mess){
		$result = array();
		for($i = 0; $i < count($mess); $i++){
			$result[$mess[$i]] = array();
			$result[$mess[$i]]['ico'] = $this->ico[$mess[$i]];
			$result[$mess[$i]]['name'] = $this->translate[$mess[$i]];
		}
		return $result;
	}

	private function create_num_link($num){
		$num = $this->clear_str($num);
		$num = str_replace(array('+','-','/'),'',$num);
		return '+'.$num;
	}

	private function create_num_value($num){
		switch($this->set['numRegional']){
			case 'BEL': return $this->create_BEL_num_value($num);
			break;
		}
	}

	private function create_BEL_num_value($num){
		$num = $this->create_num_link($num);
		$code_country = substr($num,0,4);
		$code_oper = substr($num,4,2);
		$part1 = substr($num,6,3);
		$part2 = substr($num,9,2);
		$part3 = substr($num,11,2);
		return $code_country.' '.$code_oper.' '.$part1.'-'.$part2.'-'.$part3;
	}

	private function create_social_array($social){
		for($i = 0; $i < count($social); $i++){
			$social[$i] = $this->create_social_object($social[$i]);
		}
		return $social;
	}

	private function create_social_object($social){
		$social->link = $this->clear_str($social->link);
		$key = $social->name;
		$social->key = $this->clear_str($key);
		$social->name = $this->translate[$key];
		$social->ico = $this->ico[$key];
		return $social;
	}

	private function create_info(){
		$this->info->companyDesc = strip_tags($this->info->companyDesc);
		$this->info->companyLegalName = strip_tags($this->info->companyLegalName);
		$this->info->companyName = strip_tags($this->info->companyName);
		$this->info->foundingDate = strip_tags($this->info->foundingDate);
		$this->info->favicon = $this->create_favicon($this->info->favicon);
		$this->info->logo = $this->create_logo($this->info->logo);
	}

	private function create_favicon($ico){
		return $this->set['url'].$this->clear_str($ico[0]->img);
	}

	private function create_logo($logo){
		$res = array();
		$res['img'] = $this->create_img_src($logo[0]->imgPath,$logo[0]->img);
		$res['title'] = strip_tags($logo[0]->logoTitle);
		if(file_exists($this->set['url'].$res['img'])){
			list($_logo_width, $_logo_height, $_logo_type, $_logo_attr) = getimagesize($this->set['url'].$res['img']);
			if($_logo_width > $_logo_height || $_logo_width === $_logo_height){
				$ratio = $_logo_width / $_logo_height;
				$res['height'] = 300;
				$res['width'] = 300 * $ratio;
			} else {
				$ratio = $_logo_height / $_logo_width;
				$res['width'] = 300;
				$res['height'] = 300 * $ratio;
			}
		} else {
			$res['height'] = 200;
			$res['width'] = 300;
		}
		return $res;
	}




	//===================================================================================
	//																CREAT SCHEMA JSON LD
	//===================================================================================

	function create_schema_ld(){
		$_phone = $this->about['contacts']->phone;
		$_email = $this->about['contacts']->email;

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

		$_social = $this->about['contacts']->social;

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

			$_company_name = $this->about['info']->companyName;
			$_company_legal_name = $this->about['info']->companyLegalName;
			$_company_founding_date = $this->about['info']->foundingDate;
			$_address = $this->about['contacts']->address;
			$_country = $this->about['contacts']->country;
			$_postal = $this->about['contacts']->postal;
			$_address = $this->about['contacts']->address;
			$url = $this->set['url'];
			$_logo = $this->about['info']->logo['img'];

			$this->json_organisation = '
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

			$_schema_logo_width = $this->about['info']->logo['width'];
			$_schema_logo_height = $this->about['info']->logo['height'];

			$this->meta_tags = '
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
		}

	}

	?>
