<?php get_header(); ?>

<div class="container main-page">
  <h1>404 - Page Not Found</h1>
  <p>Oh no! We couldn't find <strong><?php echo get_bloginfo('url').$_SERVER['REQUEST_URI']; ?></strong></p>
  <p>If you found a broken link, please <a href="mailto:<?php echo get_option('admin_email'); ?>">e-mail the webmaster</a>.</p>
  <?php echo get_search_form(); ?>
</div>

<?php get_footer(); ?>
