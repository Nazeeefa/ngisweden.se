<?php get_header();

// Recursive function to get application parents for the little applications badge
function singlepage_get_application_parents( $id, $visited = array() ) {
  $chain = '';
  $parent = get_term( $id, 'applications' );
  if ( is_wp_error( $parent ) ) return $parent;
  if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
    $visited[] = $parent->parent;
    $chain .= custom_get_application_parents( $parent->parent, $visited );
  }
  $chain .= $parent->name.' &raquo; ';
  return $chain;
}

?>

<div class="ngisweden-sidebar-page">
  <div class="container main-page">
    <div class="row">
      <div class="col-sm-9">
        <?php
        if (have_posts()) {
          while (have_posts()) {
            the_post();

            // Just the badges, for under the title on mobile
            $header_badges = array();

            // Get the status icon
            $method_status_badges = '';
            $method_statuses = get_the_terms(null, 'method_status');
            if ($method_statuses && !is_wp_error($method_statuses)){
              $color_classes = array(
                'red' => 'danger',
                'green' => 'success',
                'blue' => 'primary',
                'turquoise' => 'info',
                'orange' => 'warning'
              );
              foreach($method_statuses as $status){
                $colour = 'badge-secondary';
                $status_colour = get_option( "method_status_colour_".$status->term_id );
                if($status_colour){
                  $colour = 'badge-'.$color_classes[$status_colour];
                }
                $url = get_term_link($status->slug, 'method_status');
                $method_status_badges .= '<p class="mb-0"><a href="'.$url.'" class="method-status-icon badge '.$colour.'">'.$status->name.'</a></p>';
                $method_status_badges .= '<p class="small text-muted">'.$status->description.'</p>';
              }
            }

            // General keywords
            $method_keyword_badges = '';
            $method_keywords = get_the_terms(null, 'method_keywords');
            if ($method_keywords && !is_wp_error($method_keywords)){
              foreach($method_keywords as $kw){
                $method_keyword_badges .= '<a href="'.get_term_link($kw->slug, 'method_keywords').'" rel="tag" class="badge badge-secondary method-keyword '.$kw->slug.'">'.$kw->name.'</a> ';
              }
            }

            // Sequencing type
            $method_seqtype_badges = '';
            $method_seqtypes = get_the_terms(null, 'sequencing_type');
            if ($method_seqtypes && !is_wp_error($method_seqtypes)){
              foreach($method_seqtypes as $kw){
                $method_seqtype_badges .= '<a href="'.get_term_link($kw->slug, 'sequencing_type').'" rel="tag" class="badge badge-info method-keyword '.$kw->slug.'">'.$kw->name.'</a> ';
              }
            }

            // Application categories
            $method_application_badges = '';
            $method_applications = get_the_terms(null, 'applications');
            if ($method_applications && !is_wp_error($method_applications)){
              foreach($method_applications as $kw){
                $parents = '';
                if ( $kw->parent != 0 ) {
                  $parents = singlepage_get_application_parents( $kw->parent );
                }
                $method_application_badges .= '<a href="'.get_term_link($kw->slug, 'applications').'" rel="tag" class="badge badge-success method-keyword '.$kw->slug.'">'.$parents.$kw->name.'</a> ';
              }
            }

            echo '<h1>'.$status_icon.get_the_title().'</h1>';
            if(get_the_excerpt() and strlen(trim(get_the_excerpt()))){
                echo '<p class="methods-lead">'.get_the_excerpt().'</p>';
            }
            the_content();
          }
        }
        ?>
      </div>
      <div class="col-sm-3 ngisweden-sidebar-page-sidebar">
        <?php
        if($method_applications && !is_wp_error($method_applications) && count($method_applications) > 0){
          echo '<h5 class="mt-3">Applications</h5>';
          echo $method_application_badges;
        }
        if($method_statuses && !is_wp_error($method_statuses) && count($method_statuses) > 0){
          echo '<h5 class="mt-3">Method Status</h5>';
          echo $method_status_badges;
        }
        if($method_keywords && !is_wp_error($method_keywords) && count($method_keywords) > 0){
          echo '<h5 class="mt-3">Keywords</h5>';
          echo $method_keyword_badges;
        }
        if($method_seqtypes && !is_wp_error($method_seqtypes) && count($method_seqtypes) > 0){
          echo '<h5 class="mt-3">Sequencing Methods</h5>';
          echo $method_seqtype_badges;
        }

        // Show associated bioinformatics pipelines
        if(get_post_type() == 'methods'){
          $linked_bioinfo_posts = get_post_meta( get_the_ID(), '_bioinformatics', true );
          if($linked_bioinfo_posts && count($linked_bioinfo_posts) > 0){
            $series = new WP_Query( array(
              'post_type' => 'bioinformatics',
              'post__in' => $linked_bioinfo_posts,
              'nopaging' => true
            ) );
            if ( $series-> have_posts() ) {
              echo '<h5 class="mt-3">Bioinformatics Pipelines</h5>';
              while ( $series->have_posts() ) {
                $series->the_post();
                echo '<p class="mb-0"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
                echo '<p class="small text-muted">'.get_the_excerpt().'</p>';
              }
            }
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer();
