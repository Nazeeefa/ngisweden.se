<?php get_header(); ?>

<div class="container main-page">

  <?php
  // Display the WordPress page that is linked to this taxonomy if we can
  $taxonomy = get_queried_object();
  $term_meta = get_option( "application_page_".$taxonomy->term_id );
  $page_title = $taxonomy->name;
  $page_excerpt = '';
  $page_contents = '';
  // Get title and contents from the linked WP Page, if we have one
  if($term_meta && isset($term_meta['application_page'])){
    $app_page = get_post($term_meta['application_page']);
    $page_title = $app_page->post_title;
    $page_excerpt = '<p class="methods-lead">'.get_the_excerpt($app_page).'</p>';
    $page_contents = $app_page->post_content;
  }
  echo '<h1>'.$page_title.'</h1>';
  echo $page_excerpt;
  // Loop through the methods in this application and show snippets
  if (have_posts()) {
    echo '<div class="ngisweden-application-methods row">';
    while (have_posts()) {
      the_post();
      ?>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h5>
            <p class="card-text"><?php echo strip_tags(get_the_excerpt()); ?></p>
          </div>
          <div class="card-footer">
            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Read more</a>
          </div>
        </div>
      </div>
      <?php
    }
    echo '</div>';
  }
  echo $page_contents;
  ?>

</div>

<?php get_footer();
