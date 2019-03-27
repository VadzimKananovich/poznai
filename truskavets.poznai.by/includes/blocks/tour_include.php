<?php
$include_json = json_decode(file_get_contents($src_url.'JSON/tourInclude.json'));
$title = strip_tags($include_json->section_title);
$list = $include_json->tour_include_list;
?>

<section id="tourInclude" class="tour-include-section">
  <h2 class="section-title mrb-2 aos-wrap">
    <span class="block aos-el" data-aos="fade-down"><?php echo $title; ?></span>
    <span class="divider-xs aos-el" data-aos="flip-left"></span>
  </h2>

  <div id="tourIncludeSection" class="tour-include-container overflow" data-image-src="<?php echo $src_url; ?>img/tourInclude/bg.jpg">
    <ul class="tour-include-list">
      <?php
      for($i = 0; $i < count($list); $i++){
        echo '<li class="tour-include-item" data-aos="fade-left">'.$list[$i].'</li>';
      }
      ?>
    </ul>
  </div>
</section>
