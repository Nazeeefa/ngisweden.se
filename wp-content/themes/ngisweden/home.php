<?php
/*
  News archive page
  Lists all of the news posts
*/

get_header(); ?>

<div class="ngisweden-sidebar-page">
  <div class="container main-page">
    <div class="row">
      <div class="col-sm-9">
        <h1>News</h1>
        <hr>
        <?php
        if (have_posts()) {
          while (have_posts()) {
            the_post();
            echo '<h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
            if ( has_post_thumbnail() ) {
              echo '<a href="'.get_the_permalink().'" class="alignright">'.get_the_post_thumbnail('thumb').'</a>';
            }
            the_excerpt();
            echo '<p class="small text-muted">'.get_the_date().' &nbsp;-&nbsp; Categories: <em>'.get_the_category_list(', ').'</em></p>';
            echo '<hr>';
          }
        }
        ?>
      </div>
      <div class="col-sm-3 ngisweden-sidebar-page-sidebar">
        <h5 class="mt-3">News Archives</h5>
        <ul>
          <?php
          wp_get_archives(array(
            'type' => 'yearly'
          ));
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php get_footer();
