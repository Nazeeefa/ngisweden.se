<?php get_header(); ?>

<div class="container main-page">

  <?php
  // Display the WordPress page that is linked to this taxonomy if we can
  $taxonomy = get_queried_object();
  $term_meta = get_option( "application_page_".$taxonomy->term_id );
  $page_title = $taxonomy->name;
  $page_intro = '';
  $app_description = trim(strip_tags(term_description($taxonomy->term_id, 'applications')));
  if($app_description && strlen($app_description)){
    $page_intro = '<p class="methods-lead">'.$app_description.'</p>';
  }
  $page_contents = '';
  // Get title and contents from the linked WP Page, if we have one
  if($term_meta && isset($term_meta['application_page'])){
    $app_page = get_post($term_meta['application_page']);
    $page_title = $app_page->post_title;
    $page_contents = $app_page->post_content;
  }
  echo '<h1>'.$page_title.'</h1>';
  echo $page_intro;
  // Loop through the methods in this application and show snippets
  if (have_posts()) {
    $postcounter = null;
    while (have_posts()) {
      the_post();
      $postcounter = $wp_query->current_post;
      if($wp_query->current_post % 3 == 0){
        echo '<div class="ngisweden-application-methods card-deck">';
      }
      ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h5>
          <?php
          // Excerpt intro text
          if(has_excerpt()) {
            echo '<p class="card-text">'.strip_tags(get_the_excerpt()).'</p>';
          }
          // General keywords
          $method_keywords = get_the_terms(null, 'method_keywords');
          if ($method_keywords && !is_wp_error($method_keywords)){
            foreach($method_keywords as $kw){
              echo '<a href="'.get_term_link($kw->slug, 'method_keywords').'" rel="tag" class="badge badge-secondary method-keyword '.$kw->slug.'">'.$kw->name.'</a> ';
            }
          }
          // Sequencing type
          $method_seqtypes = get_the_terms(null, 'sequencing_type');
          if ($method_seqtypes && !is_wp_error($method_seqtypes)){
            foreach($method_seqtypes as $kw){
              echo '<a href="'.get_term_link($kw->slug, 'sequencing_type').'" rel="tag" class="badge badge-info method-keyword '.$kw->slug.'">'.$kw->name.'</a> ';
            }
          }
          ?>

        </div>
        <div class="card-footer">
          <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Read more</a>
        </div>
      </div>
      <?php
      if($wp_query->current_post % 3 == 2){
        echo '</div>';
      }
    }
    if($postcounter % 3 != 2){
      echo '</div>';
    }
  }
  echo $page_contents;
  ?>

</div>

<?php get_footer();
