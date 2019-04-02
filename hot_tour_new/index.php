<?php

include 'includes/_main.php';
include 'includes/_classes.php';
include 'includes/_company_info.php';
$info = new CompanyInfo($host,$user,$pass,'poznaiby_info',$url,$conn,'index');

?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans|Open+Sans:800" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= $url; ?>css/animate.css">
  <link rel="stylesheet" href="<?= $url; ?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= $url; ?>css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= $url; ?>css/main.css">
  <?= $info->meta_tags; ?>
  <?= $info->json_ld; ?>
</head>
<body>

  <?php
  // new Menu($url,$conn);
  new HeaderSlider($url, $conn);
  new OurTours($url,$conn);
  new BoxTours($url,$conn,'hot');
  new BoxTours($url,$conn,'early');
  new Testimonials($url,$conn);

  ?>


  <!--===========================================================================
  //                                 FOOTER
  ============================================================================-->

  <footer class="footer">
    <div class="container">
      <div class="row about-row">
        <div class="col-md-6">
          <div class="about-company">
            <img src="<?= $url; ?>img/logo.png" alt="poznai.by" class="foot-logo">
            <h6 class="title">О компании</h6>
            <p>
              Для нас Ваш комфорт и удобство стоят на первом месте. Именно поэтому мы постоянно работаем над новыми услугами, чтобы сделать подбор и покупку тура максимально понятными и легкими для Вас, занимающими минимум времени и сил. С нами Ваш отдых станет незабываемым!
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-info">
            <h6 class="title">Контакты</h6>
            <address>
              <div class="address-row address">
                <span class="address-ico">I</span>
                <p>220029, г.Минск, пр-т Машерова, 17, офис 701</p>
              </div>
              <div class="address-row phone">
                <span class="address-ico">I</span>
                <a href="tel:+375257149178" class="address-link">+375 (29) 664-50-11 (Vel)</a>
              </div>
              <div class="address-row phone">
                <span class="address-ico">I</span>
                <a href="tel:+375257149178" class="address-link">+375 (29) 664-50-11 (Vel)</a>
              </div>
              <div class="address-row phone">
                <span class="address-ico">I</span>
                <a href="tel:+375257149178" class="address-link">+375 (29) 664-50-11 (Vel)</a>
              </div>
            </address>
          </div>
        </div>
      </div>
      <div class="row social-icons">
        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
      </div>
    </div>
  </footer>


  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
  <!-- <script src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js" integrity="sha256-mFypf4R+nyQVTrc8dBd0DKddGB5AedThU73sLmLWdc0=" crossorigin="anonymous"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="<?= $url; ?>js/plugin/owl.carousel.min.js"></script>
  <script type="module" src="<?= $url; ?>js/main.js"></script>
</body>
</html>
