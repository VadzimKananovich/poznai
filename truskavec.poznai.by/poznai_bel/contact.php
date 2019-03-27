<?php
include 'includes/_main.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Ponzai.bel</title>
  <?php
  include 'includes/_stylesheet.php';
  ?>
</head>
<body class="size-1140">
  <?php
  include 'includes/nav.php';
  ?>
  <section class="header">
    <?php
    include 'includes/header.php';
    ?>
  </section>

  <?php
  include 'includes/contact/contact.php';
  include 'includes/contact/onmap.php';
  ?>

  <?php
  include 'includes/footer.php';
  ?>
  <?php
  include 'includes/_scripts.php';
  ?>

  <script>
  new SendMail('contactForm',{
    'email': 'empty',
    'name': 'empty',
    'message': 'empty'
  });
  </script>
</body>
</html>
