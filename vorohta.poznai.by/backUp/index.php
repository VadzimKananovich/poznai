<?php
include 'includes/__main.php';

if(isset($_GET['action'])){

  if($_GET['action'] === 'send'){
    // SEND EMAIL CODE
    mail($mail,
    'Письмо с vorohta.poznai.by',
    'Вам написал: '.$_POST['name'].
    '<br />Его номер: '.$_POST['phone'],
    "Content-type:text/html;charset=utf-8");
    $alert = true;
  }

}

?>

<!DOCTYPE html>
<html >
<head>
  <!-- Site made with Mobirise Website Builder v4.8.7, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <meta name="description" content="">
  <title>КАРПАТЫ - ВОРОХТА КРУГЛЫЙ ГОД- POZNAI.BY</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>


  <?php
  include 'includes/nav.php';
  include 'includes/header.php';
  include 'includes/relax_in_vorohta.php';
  include 'includes/program.php';
  include 'includes/program_relax.php';
  include 'includes/footer.php';
  ?>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/parallax/jarallax.min.js"></script>
  <script src="assets/ytplayer/jquery.mb.ytplayer.min.js"></script>
  <script src="assets/vimeoplayer/jquery.mb.vimeo_player.js"></script>
  <script src="assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/slidervideo/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script>


let programBg = document.querySelectorAll('.content4-d-section > div');




console.log(programBg);
  // FIX MODAL WINDOW ON SLICK !!!!!! VERY IMPORTANT!!!!!!
  let relaxModal = document.querySelectorAll('.relax-modal-window');
  for (let i = 0; i <relaxModal.length; i++){
    let myModal = relaxModal[i];
    let myBody = document.querySelector('body');
    myBody.appendChild(myModal);
  }
  // END FIX MODAL WINDOW ON SLICK !!!!!! VERY IMPORTANT!!!!!!
  $(document).ready(function(){
    $('.relax-row').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 780,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 580,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });
  </script>


</body>
</html>
