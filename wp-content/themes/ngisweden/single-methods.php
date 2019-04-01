<?php get_header(); ?>

<div class="ngisweden-sidebar-page">
  <div class="container main-page">
    <div class="row">
      <div class="col-sm-9">
        <?php
        if (have_posts()) {
          while (have_posts()) {
            the_post();

            // Get the status icon
            $method_status_badges = '';
            $method_statuses = get_the_terms(null, 'method_status');
            if ($method_statuses && !is_wp_error($method_statuses)){
              foreach($method_statuses as $status){
                $status_meta = get_option( "method_status_icon_".$status->term_id );
                $icon_colour = 'secondary';
                $icon_svg = '';
                if($status_meta && isset($status_meta['method_status_icon'])){
                  $icon_colour = $status_meta['method_status_colour'];
                  $icon_url = get_stylesheet_directory().'/'.$status_meta['method_status_icon'];
                  if(file_exists($icon_url) && is_file($icon_url)){
                    $icon_svg = file_get_contents($icon_url).' ';
                  }
                }
                $method_status_badges .= '<a href="'.get_term_link($status->slug, 'method_status').'" class="method-status-icon badge badge-'.$icon_colour.'">';
                $method_status_badges .= $icon_svg.$status->name;
                $method_status_badges .= '</a> ';
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
                $method_application_badges .= '<a href="'.get_term_link($kw->slug, 'applications').'" rel="tag" class="badge badge-success method-keyword '.$kw->slug.'">'.$kw->name.'</a> ';
              }
            }

            echo '<h1>'.$status_icon.get_the_title().'</h1>';

            echo '<div class="d-block d-sm-none">';
            if($method_applications && !is_wp_error($method_applications) && count($method_applications) > 1){
              echo $method_application_badges;
            }
            echo $method_status_badges . $method_keyword_badges . $method_seqtype_badges;
            echo '</div>';

            echo '<p class="methods-lead">'.get_the_excerpt().'</p>';
            the_content();
          }
        }
        ?>
      </div>
      <div class="col-sm-3 ngisweden-sidebar-page-sidebar">
        <div class="d-none d-sm-block">
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
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer();
