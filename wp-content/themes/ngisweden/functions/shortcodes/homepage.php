<?php

// Shortcodes for content to go on the homepage

function ngisweden_homepage_applications($atts_raw){

  $output = '<div class="homepage-applications">';

  // Print the ajax search lite search form
  $output .= do_shortcode('[wpdreams_ajaxsearchlite]');

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

  $output .= '</div>';
  return $output;
}
add_shortcode('homepage_applications', 'ngisweden_homepage_applications');
