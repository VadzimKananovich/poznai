<?php
$path = '';
include 'includes/_main.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Познай Бел ✪✪✪ о компании &mdash; отзывы</title>
  <meta name="description" content="
  Познай Бел ➢ туры и экскурсии по всей Беларусь.
  ① Профессиональная команда, ② Опыт более 5 лет, ③ Качественные туры, ④ Индивидуфльный подход, ⑤ Полное сопровождение">
  <meta name="keywords" content="туры, экскурсии, Беларусь, Минск, Россия, познай, бел, о компании, отзывы">
  <?php
  include 'includes/_stylesheet.php';
  include 'includes/create_schema.php';
  $json_ld_contact = create_contact_schema();
  $json_ld_comments = create_comments_schema();
  ?>
  <link rel="stylesheet" href="css/swiper.css">
  <script type="application/ld+json">
  <?php for($i = 0; $i < count($json_ld_comments); $i++){
    if($json_ld_comments[$i]->state === 'confirm'){
      ?>
      {
        "@context": "http://schema.org",
        "@type": "CommentAction",
        "agent": {
          "@type": "Person",
          "name": "<?php echo $json_ld_comments[$i]->name; ?>"
        },
        "resultComment": {
          "@type": "Comment",
          "text": "<?php echo $json_ld_comments[$i]->comment; ?>"
        },
        "about": {
          "@type": "Service",
          "name": "Туры и экскурсии по Буларуси от компании Познай.бел",
          "provider": "Познай.бел",
          "logo": "<?php echo $url; ?>img/logo/logo.png"
        }
      }
      <?php } } ?>


      {
        "@context": "http://schema.org",
        "@type": "Organization",
        "url": "<?php echo $url; ?>",
        "name": "Познай.бел",
        "description": "Познай.бел - туры и экскурсии по всей Беларуси.",
        "sameAs": [
          <?php
          for($i = 0; $i < count($json_ld_contact[5]); $i++){
            if($i === count($json_ld_contact[5])-1){
              echo '"'.$json_ld_contact[5][$i]->link.'"';
            } else {
              echo '"'.$json_ld_contact[5][$i]->link.'",';
            }
          }
          ?>
        ],
        "logo": "<?php echo $url; ?>img/logo/logo.png",
        "address": {
          "addressCountry": "BY",
          "addressRegion": "<?php echo $json_ld_contact[0]; ?>",
          "postalCode": "<?php echo $json_ld_contact[2]; ?>",
          "streetAddress": "<?php echo $json_ld_contact[1]; ?>"
        }
      }
      </script>

      <script async src="https://www.googletagmanager.com/gtag/js?id=GA_TRACKING_ID"></script>
  </head>
  <body class="size-1140">
    <?php
    include 'includes/nav.php';
    ?>
    <?php
    include 'includes/header.php';
    ?>


    <?php
    include 'includes/about/about.php';
    // include 'includes/about/progress.php';
    include 'includes/about/comments.php';
    ?>


    <?php
    include 'includes/footer.php';
    ?>
    <?php
    include 'includes/modal.php';
    include 'includes/_scripts.php';
    ?>
    <script src="js/swiper.jquery.min.js"></script>
    <script src="js/comments.js"></script>
    <script>
    new Comment('comments');
    let sendComment = new SendMail('leaveComment',{
      'name': 'empty',
      'email': 'empty',
      'comment': 'empty'
    },false,() => new LeaveComment('leaveComment'));
    // let conn = new JSONconnect;
    // conn.json_push('about','comments',{
    //   'name':'vadzim',
    //   'email':'vadzim.kananovich.by@gmail.com',
    //   'comment':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    //   'img':'no','date':'13/03/1995',
    //   'state':'pending'
    // });
    </script>
  </body>
  </html>
