<?php
function generate_site_map($url){
	$map_location = '';
	$tours_belarus_file = json_decode(file_get_contents('../../jsdb/JSON/tours/belarus.json'));
	$tours_foreigners_file = json_decode(file_get_contents('../../jsdb/JSON/tours/foreigners.json'));
	$xml_top = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
	http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	';
	$xml_belarus = create_tours_xml($tours_belarus_file[0],'belarus',$url);
	$xml_foreigners = create_tours_xml($tours_foreigners_file[0],'foreigners',$url);
	$xml_top_links = create_xml_top_links(array(
		array(
			"link"=>$url,
			"changefreq"=>'always',
			"priority"=>'1'
		),
		array(
			"link"=>$url.'belarus',
			"changefreq"=>'always',
			"priority"=>'1'
		),
		array(
			"link"=>$url.'foreigners',
			"changefreq"=>'always',
			"priority"=>'1'
		),
		array(
			"link"=>$url.'about',
			"changefreq"=>'always',
			"priority"=>'1'
		),
		array(
			"link"=>$url.'contact',
			"changefreq"=>'always',
			"priority"=>'1'
		)
	));
	$xml_images = '
	';
	$xml_preview = create_preview_xml($url, 'always', '0.5');
	$xml_images .= create_images_xml($url);
	$xml_bottom = '</urlset>';

	$fp = fopen('../../'.$map_location.'sitemap.xml','w');
	fwrite($fp,$xml_top.$xml_top_links.$xml_belarus.$xml_foreigners.$xml_preview.$xml_images.$xml_bottom);
	fclose($fp);
}






function create_xml_top_links($items){
	$body = '';
	for($i = 0; $i < count($items); $i++){
		$body .= create_url($items[$i]['link'], $items[$i]['changefreq'], $items[$i]['priority']);
	}
	return $body;
}

function create_tours_xml($item,$page,$url){
	$body = '';
	foreach($item as $key => $value){
		for($i = 1; $i < count($value); $i++){
			$link = $url.$page.'?tour='.$page.'&amp;key='.$key.'&amp;index='.$i;
			$body = $body.create_url($link,'always','0.8',$url);
		}
	}
	return $body;
}





function create_images_xml($url){
	$head_img_file = json_decode(file_get_contents('../../jsdb/JSON/common/header.json'));
	$head_img = $head_img_file[0];

	$top = '<url>
	<loc>'.$url.'</loc>';
	$body_img = '';
	foreach($head_img as $key => $value){
		$body_img .= '
		<image:image>
		<image:loc>'.$url.'img/header/'.$value->img.'</image:loc>
		<image:title>'.$value->name.'</image:title>
		<image:caption>'.$value->desc.'</image:caption>
		</image:image>';
	}

	$bottom = '
	</url>
	';
	return $top.$body_img.$bottom;
}





function create_preview_xml($url, $changefreq, $priority){
	$about_belarus_file = json_decode(file_get_contents('../../jsdb/JSON/home/about_belarus.json'));
	$about_belarus = $about_belarus_file[0];
	$body = '';
	foreach($about_belarus as $key => $value){
		$image = $value->img;
		for($i = 0; $i < count($image); $i++){
			$link = $url.'?preview=home&amp;key='.$key.'&amp;item='.$i;
			$body .= create_url($link,$changefreq,$priority);
		}
	}
	return $body;
}


function create_url($link, $changefreq, $priority){
	return '
	<url>
	<loc>'.$link.'</loc>
	<changefreq>'.$changefreq.'</changefreq>
	<priority>'.$priority.'</priority>
	</url>
	';
}

?>
