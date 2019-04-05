<?php get_header(); ?>

<div class="container main-page">

  <?php

  //
  // PAGE CONTENTS
  // Get the WordPress page that is linked to this taxonomy
  //

  // Start by setting defaults using the values from the application type
  $taxonomy = get_queried_object();
  $term_meta = get_option( "application_page_".$taxonomy->term_id );
  $page_title = $taxonomy->name;
  $page_intro = '';
  $app_description = trim(strip_tags(term_description($taxonomy->term_id, 'applications')));
  if($app_description && strlen($app_description)){
    $page_intro = '<p class="methods-lead">'.$app_description.'</p>';
  }
  $page_contents = '';

  // Overwrite with the title and contents from the linked WP Page, if we have one
  if(isset($term_meta['application_page']) && $term_meta['application_page']){
    $app_page = get_post($term_meta['application_page']);
    $page_title = $app_page->post_title;
    $page_contents = $app_page->post_content;
  }

  // Start the structure to collect the cards
  $card_decks = array(
    'applications' => array(
      'title' => 'Applications',
      'cards' => array()
    ),
    'methods' => array(
      'title' => 'Methods',
      'cards' => array()
    ),
    'bioinformatics' => array(
      'title' => 'Bioinformatics',
      'cards' => array()
    )
  );

  //
  // CHILD APPLICATIONS
  // Applications are hierarchical. If this is a parent, get the children
  //

  $term_children = get_term_children($taxonomy->term_id, 'applications');
  foreach ($term_children as $child) {
    // Get the sub-term details
    $subterm = get_term_by('id', $child, 'applications' );
    $subterm_app_description = trim(strip_tags(term_description($child, 'applications')));
    // Build the card itself
    $card_output = '
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          <a href="'.get_term_link($child, 'applications').'">'.$subterm->name.'</a>
        </h5>
        '.$subterm_app_description.'
      </div>
    </div>';
    // Add to the array of card outputs
    array_push($card_decks['applications']['cards'], $card_output);
  }



  //
  // LAB METHODS, BIOINFORMATICS METHODS
  // Get the methods directly associated with this application
  //

  // Loop through the methods in this application and show snippets
  $methods_cards = array();
  $bioinformatics_cards = array();
  if (have_posts()) {
    while (have_posts()) {
      the_post();

      // Get the status icon
      $status_icon = '';
      $method_statuses = get_the_terms(null, 'method_status');
      if ($method_statuses && !is_wp_error($method_statuses)){
        foreach($method_statuses as $status){
          $status_meta = get_option( "method_status_icon_".$status->term_id );
          if($status_meta && isset($status_meta['method_status_icon'])){
            $icon_colour = $status_meta['method_status_colour'];
            $icon_url = get_stylesheet_directory().'/'.$status_meta['method_status_icon'];
            if(file_exists($icon_url) && is_file($icon_url)){
              $status_icon = '<a href="'.get_term_link($status->slug, 'method_status').'" data-toggle="tooltip" title="Status: '.$status->name.'" class="method-status-icon badge badge-'.$icon_colour.'">';
              $status_icon .= file_get_contents($icon_url);
              $status_icon .= '</a> ';
            }
          }
        }
      }

      // Start building the method card
      $card_output = '
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            '.$status_icon.'
            <a href="'.get_the_permalink().'">'.get_the_title().'</a>
          </h5>';
      // Excerpt intro text
      if(has_excerpt()) {
        $card_output .= '<p class="card-text">'.strip_tags(get_the_excerpt()).'</p>';
      }
      // General keywords
      $method_keywords = get_the_terms(null, 'method_keywords');
      if ($method_keywords && !is_wp_error($method_keywords)){
        foreach($method_keywords as $kw){
          $card_output .= '<a href="'.get_term_link($kw->slug, 'method_keywords').'" rel="tag" class="badge badge-secondary method-keyword '.$kw->slug.'">'.$kw->name.'</a> ';
        }
      }
      // Sequencing type
      $method_seqtypes = get_the_terms(null, 'sequencing_type');
      if ($method_seqtypes && !is_wp_error($method_seqtypes)){
        foreach($method_seqtypes as $kw){
          $card_output .= '<a href="'.get_term_link($kw->slug, 'sequencing_type').'" rel="tag" class="badge badge-info method-keyword '.$kw->slug.'">'.$kw->name.'</a> ';
        }
      }
      $card_output .= '</div></div>';

      // Add to the relevant array of cards
      array_push( $card_decks[ get_post_type() ]['cards'], $card_output );
    }
  }





  //
  // PRINT OUTPUT
  // Build the page contents now that we have everything ready
  //

  // Print the title and introduction
  echo '<h1>'.$page_title.'</h1>';
  echo $page_intro;

  // Print the tab headers
  echo '<div class="row mt-3 mb-3"><div class="col-2"><div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">';
  $first = true;
  foreach($card_decks as $id => $deck){
    if(count($deck['cards']) > 0){
      // Card deck header
      echo '<a class="nav-link '.($first ? 'active' : '').'" id="v-pills-'.$id.'-tab" data-toggle="pill" href="#v-pills-'.$id.'" role="tab" aria-controls="v-pills-'.$id.'" '.($first ? 'aria-selected="true"' : '').'>
        '.$deck['title'].' <span class="badge badge-light">'.count($deck['cards']).'
      </a>';
      $first = false;
    }
  }
  echo '</div></div>';

  // Print each set of card decks
  echo '<div class="col-10"><div class="tab-content">';
  $first = true;
  foreach($card_decks as $id => $deck){
    if(count($deck['cards']) > 0){
      // Start of tab content area
      echo '<div class="tab-pane fade '.($first ? 'show active' : '').'" id="v-pills-'.$id.'" role="tabpanel" aria-labelledby="v-pills-'.$id.'-tab">';
      $postcounter = -1;
      foreach($deck['cards'] as $card){
        $postcounter++;
        // Start a row of cards
        if($postcounter % 3 == 0) echo '<div class="ngisweden-application-methods card-deck">';
        // Print the card
        echo $card;
        // Finish a row of 3 cards
        if($postcounter % 3 == 2) echo '</div>';
      }
      // Loop did not finish a row of 3 cards
      if($postcounter % 3 != 2) echo '</div>';
      // End of tab content area
      echo '</div>';
      $first = false;
    }
  }
  echo '</div></div></div>';

  // Echo the rest of the page contents
  echo $page_contents;

  ?>

</div>

<?php get_footer();
