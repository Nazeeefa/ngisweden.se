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
      $app_url = get_term_link($application->slug, 'applications');
      $term_meta = get_option( "application_page_".$application->term_id );
      $application_icon = get_stylesheet_directory().'/includes/icons/fontawesome-svgs/solid/flask.svg';
      if(isset($term_meta['application_icon'])){
        $a_icon = get_stylesheet_directory().'/'.$term_meta['application_icon'];
        if(file_exists($a_icon) && is_file($a_icon)){
          $application_icon = $a_icon;
        }
      }
      if(isset($term_meta['application_page'])){
        if(strlen(trim(get_the_excerpt($term_meta['application_page'])))){
          $app_tooltip = 'data-toggle="tooltip" data-delay=\'{ "show": 1000, "hide": 0 }\' title="'.get_the_excerpt($term_meta['application_page']).'"';
        }
      } else {
        $app_tooltip = '';
      }
      echo '<div class="homepage-application">
        <a href="'.$app_url.'" class="app-link" '.$app_tooltip.'>
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
