<?php

// Shortcodes for content to go on the homepage

function ngisweden_homepage_applications($atts_raw){

  $output = '<div class="homepage-applications" id="applications-shortcode-div">';

  // Print the ajax search lite search form
  // $output .= do_shortcode('[wpdreams_ajaxsearchlite]');

  // Tab buttons to switch between applications and technologies
  $output .= '
  <ul class="nav nav-pills nav-fill shadow-sm homepage-applications-tabbtns">
    <li class="nav-item">
      <a href="#homepage-applications-tabcontent" class="nav-link btn btn-light active" data-toggle="tab" role="tab">Applications</a>
    </li>
    <li class="nav-item">
      <a href="#homepage-technologies-tabcontent" class="nav-link btn btn-light" data-toggle="tab" role="tab">Technologies</a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link btn btn-light disabled">Bioinformatics</a>
    </li>
  </ul>
  ';

  $output .= '<div class="tab-content">';

  //
  // APPLICATIONS
  //

  $output .= '<div class="tab-pane fade show active" id="homepage-applications-tabcontent">';
  $output .= '<div class="homepage-applications-flexwrap">';

  // Get only top-level application terms
  $applications = get_terms( array(
    'taxonomy' => 'applications',
    'hide_empty' => false,
    'parent' => 0
  ) );

  foreach($applications as $application){
    $app_url = get_term_link($application->slug, 'applications');
    $term_meta = get_option( "application_page_".$application->term_id );
    $application_icon = get_stylesheet_directory().'/includes/icons/fontawesome-svgs/solid/flask.svg';
    if(isset($term_meta['application_icon'])){
      $a_icon = get_stylesheet_directory().'/'.$term_meta['application_icon'];
      if(file_exists($a_icon) && is_file($a_icon)){
        $application_icon = $a_icon;
      }
    }
    $app_description = trim(strip_tags(term_description($application->term_id, 'applications')));
    if($app_description && strlen($app_description)){
      $app_tooltip = 'data-toggle="tooltip" data-delay=\'{ "show": 1000, "hide": 0 }\' title="'.$app_description.'"';
    } else {
      $app_tooltip = '';
    }
    $output .= '<div class="homepage-application">
      <a href="'.$app_url.'" class="app-link" '.$app_tooltip.'>
        <span class="application-icon">'.file_get_contents($application_icon).'</span>
        '.$application->name.'
      </a>
    </div>';
  }

  $output .= '</div>'; // .homepage-applications-flexwrap
  $output .= '</div>'; // #homepage-applications-tabcontent

  //
  // TECHNOLOGIES
  //
  $output .= '<div class="tab-pane fade" id="homepage-technologies-tabcontent">';
  $output .= '<div class="homepage-applications-flexwrap">';

  // Get only top-level technology terms
  $sequencing_types = get_terms( array(
    'taxonomy' => 'sequencing_type',
    'hide_empty' => false,
    // 'parent' => 0
  ) );

  foreach($sequencing_types as $sequencing_type){
    $app_url = get_term_link($sequencing_type->slug, 'sequencing_type');
    $term_meta = get_option( "application_page_".$sequencing_type->term_id );
    $sequencing_type_icon = get_stylesheet_directory().'/includes/icons/fontawesome-svgs/solid/flask.svg';
    if(isset($term_meta['application_icon'])){
      $a_icon = get_stylesheet_directory().'/'.$term_meta['application_icon'];
      if(file_exists($a_icon) && is_file($a_icon)){
        $sequencing_type_icon = $a_icon;
      }
    }
    $app_description = trim(strip_tags(term_description($sequencing_type->term_id, 'sequencing_type')));
    if($app_description && strlen($app_description)){
      $app_tooltip = 'data-toggle="tooltip" data-delay=\'{ "show": 1000, "hide": 0 }\' title="'.$app_description.'"';
    } else {
      $app_tooltip = '';
    }
    $output .= '<div class="homepage-application">
      <a href="'.$app_url.'" class="app-link" '.$app_tooltip.'>
        <span class="application-icon">'.file_get_contents($sequencing_type_icon).'</span>
        '.$sequencing_type->name.'
      </a>
    </div>';
  }
  $output .= '</div>'; // .homepage-applications-flexwrap
  $output .= '</div>'; // #homepage-technologies-tabcontent


  $output .= '</div>'; // .tab-content
  $output .= '</div>'; // #applications-shortcode-div
  return $output;
}
add_shortcode('homepage_applications', 'ngisweden_homepage_applications');
