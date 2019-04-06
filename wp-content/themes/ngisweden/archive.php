<?php
/*
  Generic Archive page.
  Used to list stuff that is under custom taxonomies, like Sequencing Type, Status etc.
*/

get_header(); ?>

<div class="container main-page">

  <?php
  // Build the page header
  $term = get_queried_object();
  $taxonomy = get_taxonomy($term->taxonomy);
  echo '<h1>'.$taxonomy->label.': '.$term->name.'</h1>';
  $tax_description = trim(strip_tags($term->description));
  if($tax_description && strlen($tax_description)){
    echo '<p class="methods-lead">'.$tax_description.'</p>';
  }
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
