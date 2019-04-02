<?php
$other_files = json_decode(file_get_contents($src_url.'JSON/other.json'));
$title = strip_tags($other_files->program_title);
$sub_title = strip_tags($other_files->program_sub_title);
?>

<section id="programSection" class="tour-include-section">
  <h2 class="section-title mrb-2 aos-wrap">
    <span class="block aos-el" data-aos="fade-down"><?php echo $title; ?></span>
    <span class="divider-xs aos-el" data-aos="flip-left"></span>
  </h2>
  <h5 class="section-sub-title mrb-3 aos-wrap">
    <span class="aos-el" data-aos="fade-up"><?php echo $sub_title; ?></span>
  </h5>
  <div class="program-days-container">
    <div id="day2" class="aos-wrap"></div>
    <div id="day3"></div>
    <div id="day4"></div>
    <div id="day5"></div>
    <div id="day6"></div>
    <div id="day7"></div>
    <div id="day8" class="aos-wrap"></div>
  </div>

</section>
