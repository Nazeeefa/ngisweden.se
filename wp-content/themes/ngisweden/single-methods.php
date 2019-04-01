<?php get_header(); ?>

<div class="container main-page">

  <?php
  if (have_posts()) {
    while (have_posts()) {
      the_post();

      echo '<h1>'.$status_icon.get_the_title().'</h1>';

      // Get the status icon
      $method_statuses = get_the_terms(null, 'method_status');
      if ($method_statuses && !is_wp_error($method_statuses)){
        foreach($method_statuses as $status){
          $status_meta = get_option( "method_status_icon_".$status->term_id );
          if($status_meta && isset($status_meta['method_status_icon'])){
            $icon_colour = $status_meta['method_status_colour'];
            $icon_url = get_stylesheet_directory().'/'.$status_meta['method_status_icon'];
            if(file_exists($icon_url) && is_file($icon_url)){
              echo '<a href="'.get_term_link($status->slug, 'method_status').'" data-toggle="tooltip" title="Status: '.$status->name.'" class="method-status-icon badge badge-'.$icon_colour.'">';
              echo file_get_contents($icon_url).' '.$status->name;
              echo '</a> ';
            }
          }
        }
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

      echo '<p class="methods-lead">'.get_the_excerpt().'</p>';
      the_content();
    }
  }
  ?>

</div>

<?php get_footer();
