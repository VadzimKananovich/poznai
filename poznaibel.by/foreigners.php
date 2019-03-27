<?php
$path = '';
header('Content-Type: text/html; charset=utf-8');
include 'includes/_main.php';
$curr_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <?php
  if(isset($_GET['tour'])){
    include 'includes/create_schema.php';
    $tour = urldecode($_GET['tour']);
    $key = urldecode($_GET['key']);
    $index = urldecode($_GET['index']);
    $json_ld = create_tour_schema($tour,$key,$index,$url);
    $page_title = 'Познай Бел ✪✪✪ ❝'.$json_ld[0].'❞ от '.$json_ld[2].$json_ld[3];
    $page_desc = 'Маршрут: '.$json_ld[4].'. '.$json_ld[5].'. ➢ '.$json_ld[1];
    $page_keywords = 'туры, Беларусь, познай, бел,'.implode(",", $json_ld[8]);
  } else {
    $page_title = 'Познай Бел ✪✪✪ туры в Беларусь';
    $page_desc = '
    Туры в Беларусь ➢ Увлекательные сборные туры. Туры на любой вкус для корпоративных и школьных групп.
    ';
    $page_keywords = 'экскурсии, Беларусь, познай, бел, для школ, семейные';
  }
  ?>
  <title><?php echo $page_title; ?></title>
  <meta name="description" content="<?php echo $page_desc; ?>">
  <meta name="keywords" content="<?php echo $page_keywords; ?>">
  <?php
  include 'includes/_stylesheet.php';
  ?>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org/",
    "@type": "Service",
    "name": "<?php echo $json_ld[0]; ?>",
    "image": "<?php echo $json_ld[7]; ?>",
    "description": "<?php echo $json_ld[1]; ?>",
    "provider": "Познай.бел",
    "serviceType": "туры в Беларусь",
    "offers": {
      "@type": "AggregateOffer",
      "priceCurrency": "<?php echo $json_ld[3]; ?>",
      "lowPrice": "<?php echo $json_ld[2]; ?>"
    }
  }
</script>
<meta itemprop="name" content="<?php echo $page_title; ?>"/>
<meta itemprop="description" content="<?php echo $page_desc; ?>"/>
<meta itemprop="image" content="<?php echo $json_ld[7]; ?>"/>

<meta property="og:locale" content="ru_RU"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="<?php echo $page_title; ?>"/>
<meta property="og:description" content="<?php echo $page_desc; ?>"/>
<meta property="og:image" content="<?php echo $json_ld[7]; ?>"/>
<meta property="og:image:width" content="450">
<meta property="og:image:height" content="300">
<meta property="og:image:alt" content="<?php echo $page_title; ?>">
<meta property="og:url" content="<?php echo $curr_url; ?>"/>
<meta property="og:site_name" content="Познай.бел"/>

<meta name="twitter:card" content="Познай.бел">
<meta name="twitter:site" content="Познай.бел">
<meta name="twitter:title" content="<?php echo $page_title; ?>">
<meta name="twitter:description" content="<?php echo $page_desc; ?>">
<meta name="twitter:image" content="<?php echo $json_ld[7]; ?>">
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

ym(52679569, "init", {
  clickmap:true,
  trackLinks:true,
  accurateTrackBounce:true,
  webvisor:true
});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52679569" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body class="size-1140">
  <?php
  include 'includes/nav.php';
  ?>
  <?php
  include 'includes/header.php';
  ?>

  <?php
  if(file_exists('jsdb/JSON/tours/foreigners.json')){
    $file = json_decode(file_get_contents('jsdb/JSON/tours/foreigners.json'))[0];
    $check_value = false;
    foreach($file as $key => $value){
      if(array_key_exists(1,$value)){
        $check_value = true;
      }
    }
    if($check_value){
      include 'includes/foreigners/all_tours.php';
    }
  }
  if(file_exists('jsdb/JSON/tours/foreigners_pref.json')){
    $file = json_decode(file_get_contents('jsdb/JSON/tours/foreigners_pref.json'))[0];
    $check_value = false;
    foreach($file as $key => $value){
      if(array_key_exists(1,$value)){
        $check_value = true;
      }
    }
    if($check_value){
      include 'includes/foreigners/all_tours_pref.php';
    }
  }
  include 'includes/foreigners/how_work.php';
  include 'includes/foreigners/search_tour.php';
  if(isset($_GET['tour'])){
    include 'includes/foreigners/_schema.php';
  }
  ?>





  <?php
  include 'includes/footer.php';
  ?>
  <?php
  include 'includes/modal.php';
  include 'includes/_scripts.php';
  ?>
  <script src="js/tabs_tour.js"></script>
  <script src="js/parallax.min.js"></script>
  <script src="js/search_tour.js"></script>
  <script>
  new TabsTour('foreigners_all_tours');
  new TabsTour('foreigners_pref_tours');
  // $('#howWeWork').parallax({imageSrc: 'img/station.jpg', zIndex: '-100'});
  new SearchTour('foreigners');
  </script>
</body>
</html>
