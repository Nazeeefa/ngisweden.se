<?php get_header(); ?>

<div class="homepage_carousel_overlay">
  <div class="container">
    <div class="row align-items-center rounded-lg">
      <div class="col-sm-6">
        <?php
        if (is_active_sidebar('homepage-header-left')){
          dynamic_sidebar( 'homepage-header-left');
        } else {
          echo '<img src="'.get_stylesheet_directory_uri().'/img/NGI-logo-darkbg.png">';
        }
        ?>
      </div>
      <div class="col-sm-6 pt-3">
        <?php
        if (is_active_sidebar('homepage-header-right')){
          dynamic_sidebar( 'homepage-header-right');
        } else {
          echo '
          <p>NGI is one of SciLifeLab’s largest technical platforms.</p>
          <p>We provide access to technology for next generation DNA sequencing,
            genotyping and associated bioinformatics support to researchers based in Sweden.</p>
          ';
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php echo do_shortcode('[image-carousel]'); ?>

<div class="container main-page" id="front-page-container">
  <?php

  if (have_posts()) {
    while (have_posts()) {
      the_post();
      the_content();
    }
  }
  ?>
</div>


<?php get_footer(); ?>
