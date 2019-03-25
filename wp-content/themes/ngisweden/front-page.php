<?php get_header(); ?>

<?php echo do_shortcode('[image-carousel]'); ?>

<div class="container main-page" id="front-page-container">
  <div class="homepage-applications">
    <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
    <?php
    $applications = get_terms( array(
      'taxonomy' => 'applications',
      'hide_empty' => false,
    ) );

    foreach($applications as $application){
      $application_icon = get_stylesheet_directory_uri().'/includes/fontawesome-svgs/solid/flask.svg';
      $term_meta = get_option( "application_page_".$application->term_id );
      if(isset($term_meta['application_page'])){
        $app_url = get_page_link($term_meta['application_page']);
      } else {
        $app_url = get_term_link($application->slug, 'applications');
      }
      if(isset($term_meta['application_icon'])){
        $application_icon = get_stylesheet_directory_uri().'/'.$term_meta['application_icon'];

      } else {
        $application_icon = get_stylesheet_directory_uri().'/includes/icons/fontawesome-svgs/solid/flask.svg';
      }
      echo '<div class="homepage-application">
        <a href="'.$app_url.'" class="app-link">
          <span class="application-icon">'.file_get_contents($application_icon).'</span>
          '.$application->name.'
        </a>
      </div>';
    }
    ?>
  </div>
  <div class="homepage-applications">

  </div>
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
