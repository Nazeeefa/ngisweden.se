<?php
/*
  News archive page
  Lists all of the news posts
*/

get_header(); ?>

<div class="container main-page">

  <h1>News</h1>

  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      echo '<h4>'.get_the_title().'</h4>';
      if(get_the_excerpt() and strlen(trim(get_the_excerpt()))){
        the_excerpt();
      }
    }
  }
  ?>

</div>

<?php get_footer();
