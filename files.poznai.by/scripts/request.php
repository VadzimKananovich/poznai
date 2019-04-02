<?php

if(isset($_GET['action'])){

  //=============================================================================
  //                        GET ALL COUNTRY IMAGES
  //=============================================================================

  if($_GET['action'] === 'get_country_img'){
    $country = $_GET['country'];
    $all_files = scan_dir('../tours/photo/'.$country);
    unset($all_files[0]);
    unset($all_files[1]);
    foreach($all_files as &$value){
      $value = 'tours/photo/'.$country.'/'.$value;
    }
    echo json_decode($all_files);
  }

  //=============================================================================
  //                        GET COUNTRY FLAG
  //=============================================================================
  if($_GET['action'] === 'get_country_flag'){
    $country = $_GET['country'];
    $all_files = scan_dir('../coutries/'.$country);
    unset($all_files[0]);
    unset($all_files[1]);
    foreach($all_files as &$value){
      $value = 'tours/photo/'.$country.'/'.$value;
    }
    echo json_decode($all_files);
  }

}

?>
