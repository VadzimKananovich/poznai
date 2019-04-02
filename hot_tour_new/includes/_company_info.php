<?php
class CompanyInfo extends Eseful {

	private $conn, $url, $page_conn;

	private $translate = array(
		'velcom'=>'Velcom',
		'mts'=>'МТС',
		'life'=>'Life',
		'urban'=>'Городской',
		'email'=>'Email',
		'skypeName'=>'Имя в skype',

		'whatsapp'=>'WhatsApp',
		'viber'=>'Viber',
		'telegram'=>'Телеграм',
		'skype'=>'Skype',

		'vk'=>'ВКонтакте',
		'in'=>'Instagram',
		'ok'=>'Одноклассники',
		'fb'=>'FaceBook',
		'yt'=>'YouTube'
	);

	private $ico = array(
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

	public $info, $json_ld, $meta_tags;
	public $email = array(), $phone = array(), $social = array(), $page_info = array();

	function __construct($host,$user,$pass,$db,$url, $page_conn, $page) {
		$this->url = $url;
		$this->page_conn = $page_conn;
		$this->create_conn($host,$user,$pass,$db);
		$this->create_info();
		$this->create_logo();
		$this->create_email();
		$this->create_phone();
		$this->create_social();
		$this->create_page_info();
		$this->create_schema($page);

		// new DisplayVar($this);

	}

	private function create_conn($host,$user,$pass,$db){
		$conn = new mysqli($host,$user,$pass,$db);
		if($conn->connect_error){
			die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
		} else {
			$conn->set_charset('utf8');
			$this->conn = $conn;
		}
	}

	private function create_info(){
		$query = "SELECT * FROM `info`";
		$res = $this->conn->query($query);
		$this->info = $res->fetch_array(MYSQLI_ASSOC);
	}

	private function create_logo(){
		$src = $this->info['logo'];
		$this->info['logo'] = array('src'=>$src);
		$logo = &$this->info['logo'];

		if(file_exists($logo['src'])){
			list($_logo_width, $_logo_height, $_logo_type, $_logo_attr) = getimagesize($logo['src']);
			if($_logo_width > $_logo_height || $_logo_width === $_logo_height){
				$ratio = $_logo_width / $_logo_height;
				$logo['height'] = 300;
				$logo['width'] = 300 * $ratio;
			} else {
				$ratio = $_logo_height / $_logo_width;
				$logo['width'] = 300;
				$logo['height'] = 300 * $ratio;
			}
		} else {
			$logo['height'] = 200;
			$logo['width'] = 300;
		}
	}

	private function create_email(){
		$query = "SELECT * FROM `email` ORDER BY `id`";
		$res = $this->conn->query($query);
		$result = array();
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			array_push($result,$row);
		}
		foreach($result as $email){
			array_push($this->email,$email['email']);
		}
	}

	private function create_phone() {
		$query = "SELECT * FROM `phones` ORDER BY `id`";
		$res = $this->conn->query($query);
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			array_push($this->phone,$row);
		}
		foreach($this->phone as &$phone){
			unset($phone['id']);
			$phone['num'] = $this->create_phone_format($phone['phone'],'bel');
			$phone['link'] = $phone['phone'];
			$phone['ico'] = $this->ico[$phone['operator']];
			$phone['oper_name'] = $this->translate[$phone['operator']];
			unset($phone['phone']);
			if(count($phone['messenger']) > 0){
				$mess = json_decode($phone['messenger']);
				$phone['messenger'] = array();
				foreach($mess as $key){
					$phone['messenger'][$key] = array(
						'name'=>$this->translate[$key],
						'ico'=>$this->ico[$key]
					);
				}
			} else {
				unset($phone['messenger']);
			}
		}
	}

	private function create_social() {
		$query = "SELECT * FROM `social` ORDER BY `id`";
		$res = $this->conn->query($query);
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			array_push($this->social,$row);
		}
		foreach($this->social as &$social){
			unset($social['id']);
			$social['name'] = $this->translate[$social['social']];
			$social['ico'] = $this->ico[$social['social']];
		}
	}

	private function create_page_info(){
		$query = "SELECT * FROM `hot.poznai.by_seo`";
		$res = $this->page_conn->query($query);
		$result = array();
		while($row = $res->fetch_array(MYSQLI_ASSOC)){
			array_push($result,$row);
		}
		foreach($result as &$info){
			$page = $info['page'];
			unset($info['page']);
			$this->page_info[$page] = $info;
		}
	}

	private function create_phone_format($num,$type){
		switch($type){
			case 'bel':
			$country = substr($num,0,4);
			$operator = substr($num,4,2);
			$one = substr($num,6,3);
			$two = substr($num,9,2);
			$three = substr($num,11,2);
			return $country.' ('.$operator.') '.$one.'-'.$two.'-'.$three;
			break;
		}
	}


	private function create_schema($page){
		$_phone = $this->phone;
		$_email = $this->email;
		$_social = $this->social;
		$page_info = $this->page_info[$page];

		if($_phone && count($_phone) > 0 || $_email && count($_email)){
			$_json_ld_contact = ',
			"contactPoint": {
				"@type": "ContactPoint",
				"contactType": "customer support"';
				if($_phone && count($_phone) > 0){
					$_json_ld_contact .= ',
					"telephone": "['.$_phone[0]['link'].']"';
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
						$_json_ld_same .= '"'.$_social[$i]['link'].'"
						';
					} else {
						$_json_ld_same .= '"'.$_social[$i]['link'].'",
						';
					}

				}
				$_json_ld_same .= ']';
			} else {
				$_json_ld_same = '';
			}

			$_company_name = $this->info['name'];
			$_company_legal_name = $this->info['legal_name'];
			$_company_founding_date = $this->info['founding'];
			$_address = $this->info['street'];
			$_city = $this->info['city'];
			$_country = $this->info['country'];
			$_postal = $this->info['index'];
			$url = $this->url;
			$logo = $this->info['logo'];

			$this->json_ld = '
			<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "Organization",
				"name": "'.$_company_name.'",
				"legalName" : "'.$_company_legal_name.'",
				"url": "'.$url.'",
				"logo": "'.$logo['src'].'",
				"foundingDate": "'.$_company_founding_date.'",
				"address": {
					"@type": "PostalAddress",
					"streetAddress": "'.$_address.'",
					"addressLocality": "'.$_city.'",
					"postalCode": "'.$_postal.'",
					"addressCountry": "'.$_country.'"
				}'.$_json_ld_contact.$_json_ld_same.'
			}
			</script>
			';

			if($page_info['logo']){
				$logo = $page_info['logo'];
			}

			$_schema_logo_width = $logo['width'];
			$_schema_logo_height = $logo['height'];

			$this->meta_tags = '
			<title>'.$page_info['title'].'</title>
			<meta name="keywords" content="'.$page_info['keywords'].'">
			<meta name="description" content="'.$page_info['description'].'">

			<meta itemprop="name" content="'.$page_info['title'].'"/>
			<meta itemprop="description" content="'.$page_info['description'].'"/>
			<meta itemprop="image" content="'.$logo['src'].'"/>

			<meta property="og:locale" content="ru_RU"/>
			<meta property="og:type" content="website"/>
			<meta property="og:title" content="'.$page_info['title'].'"/>
			<meta property="og:description" content="'.$page_info['description'].'"/>
			<meta property="og:image" content="'.$logo['src'].'"/>
			<meta property="og:image:width" content="'.$_schema_logo_width.'">
			<meta property="og:image:height" content="'.$_schema_logo_height.'">
			<meta property="og:url" content="'.$url.'"/>
			<meta property="og:site_name" content="'.$_company_name.'"/>

			<meta name="twitter:card" content="'.$page_info['title'].'">
			<meta name="twitter:site" content="'.$_company_name.'">
			<meta name="twitter:title" content="'.$page_info['title'].'">
			<meta name="twitter:description" content="'.$page_info['description'].'">
			<meta name="twitter:image" content="'.$logo['src'].'">
			';
		}

	}

	?>
