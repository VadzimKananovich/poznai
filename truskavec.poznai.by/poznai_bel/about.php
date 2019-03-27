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
  <link rel="stylesheet" href="css/swiper.css">
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
  include 'includes/about/work.php';
  include 'includes/about/about.php';
  // include 'includes/about/services.php';
  include 'includes/about/comments.php';
  ?>


  <?php
  include 'includes/footer.php';
  ?>
  <?php
  include 'includes/_scripts.php';
  ?>
  <script src="js/swiper.jquery.min.js"></script>
  <script src="js/comments.js"></script>
  <script>


function connect(){
  const http = new XMLHttpRequest();
  const url = 'http://192.168.137.1:888/jsdb/includes/bd_request.php?action=connection';
  http.open('POST',url,true);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  let postFile = 'from='+window.location.host;
  http.send(postFile);
  http.onreadystatechange=()=>{
    if(http.readyState === 4 && http.status === 200){
      console.log(http.responseText);
      // alert(http.responseText);
    }
  }
}
connect();
let comment = new Comment('comments');
// let v = new JSONconnect('vadzim','arrogaminca');
// v.connect()
// .then(()=>{v.addRecord('about','comments',{'name':'vadzim'})})
// .then(()=>{
//   console.log(v);
// })

  // let vad = new JSONconnect('vadzim','arrogaminca');
  // vad.connect().then(()=>{
  //   vad.write('about','comments',[
  //     {'name':'vadzim','comment':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','img':'no','date':'13/03/1995'},
  //     {'name':'vadzim','comment':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','img':'no','date':'13/03/1995'},
  //     {'name':'vadzim','comment':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','img':'no','date':'13/03/1995'},
  //     {'name':'vadzim','comment':'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','img':'no','date':'13/03/1995'}
  //   ]).then(()=>{
  //     vad.disconnect();
  //   });
  // });

  </script>
</body>
</html>
