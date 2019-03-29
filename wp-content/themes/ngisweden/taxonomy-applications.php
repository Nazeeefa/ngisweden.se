<?php get_header(); ?>

<div class="container main-page">

  <?php
  // Display the WordPress page that is linked to this taxonomy if we can
  $taxonomy = get_queried_object();
  $term_meta = get_option( "application_page_".$taxonomy->term_id );
  if($term_meta && isset($term_meta['application_page'])){
    $app_page = get_post($term_meta['application_page']);
    echo '<h1>'.$app_page->post_title.'</h1>';
    echo $app_page->post_content;
  } else {
    // No page found - just print the taxonomy title
    echo '<h1>Title:'.$taxonomy->name.'</h1>';
  }
  // Loop through the methods in this application and show snippets
  if (have_posts()) {
    echo '<h2>Methods</h2>';
    echo '<ul>';
    while (have_posts()) {
      the_post();
      echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
    }
    echo '</ul>';
  }
  ?>

</div>

<?php get_footer();
