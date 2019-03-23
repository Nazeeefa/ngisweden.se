<?php get_header(); ?>

<?php echo do_shortcode('[image-carousel]'); ?>

<div class="container main-page">
  <div class="homepage-applications">
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
          <span class="application-icon"><img src="'.$application_icon.'"></span>
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



<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  <div class="col-md-5 p-lg-5 mx-auto my-5">
    <h1 class="display-4 font-weight-normal">Punny headline</h1>
    <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.</p>
    <a class="btn btn-outline-secondary" href="#">Coming soon</a>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>



<?php get_footer(); ?>
