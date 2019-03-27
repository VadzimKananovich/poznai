<?php
$path = '';
include 'includes/_main.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Познай Бел ✪✪✪ контакты</title>
  <meta name="description" content="
  Познай Бел ➢ viber, whatsapp, skype.
  <?php
  for($i = 0; $i < count($phone); $i++){
    echo '☎ '.$phone[$i]->tel.' ';
  }
  for($i = 0; $i < count($email); $i++){
    echo '✉ '.$email[$i].' ';
  }
  ?>
  ">
  <meta name="keywords" content="туры, экскурсии, Беларусь, Минск, Россия, познай, бел, контакты, связаться, позвонить, на карте, офис">

  <?php
  include 'includes/_stylesheet.php';
  include 'includes/create_schema.php';
  $json_ld = create_contact_schema();
  ?>
  <script type="application/ld+json">
  { "@context": "http://schema.org",
  "@type": "Organization",
  "name": "Познай.бел",
  "legalName" : "ООО «ФУТЭН»",
  "url": "<?php echo $url; ?>",
  "logo": "<?php echo $url; ?>img/logo/logo.png",
  "foundingDate": "2009",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?php echo $json_ld[1]; ?>",
    "addressLocality": "<?php echo $json_ld[0]; ?>",
    "addressRegion": "<?php echo $json_ld[0]; ?>",
    "postalCode": "<?php echo $json_ld[2]; ?>",
    "addressCountry": "BY"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer support",
    <?php
    echo '"telephone": ["'.$json_ld[4][0]->tel.'"],';
    echo '"email": [';
    for($i = 0; $i < count($json_ld[3]); $i++){
      if($i === count($json_ld[3])-1){
        echo '"'.$json_ld[3][$i].'"';
      } else {
        echo '"'.$json_ld[3][$i].'",';
      }
    }
    echo ']';
    ?>
  },
  "sameAs": [
    <?php
    for($i = 0; $i < count($json_ld[5]); $i++){
      if($i === count($json_ld[5])-1){
        echo '"'.$json_ld[5][$i]->link.'"';
      } else {
        echo '"'.$json_ld[5][$i]->link.'",';
      }
    }
    ?>
  ]}
  </script>
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
  include 'includes/contact/contact.php';
  include 'includes/contact/onmap.php';
  ?>

  <?php
  include 'includes/footer.php';
  ?>
  <?php
  include 'includes/modal.php';
  include 'includes/_scripts.php';
  ?>

  <script>
  new SendMail('contactForm',{
    'email': 'empty',
    'name': 'empty',
    'message': 'empty'
  },true);
  </script>
</body>
</html>