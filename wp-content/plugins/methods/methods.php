<?php
/*
Plugin Name: NGI Methods
Plugin URI: https://github.com/NationalGenomicsInfrastructure/ngisweden.se
Description: Plugin to handle administration, submission and display of library prep methods on the NGI website.
Version: 1.0
Author: Phil Ewels
Author URI: http://phil.ewels.co.uk
License: MIT
*/

//////////////////////////
// Custom Post Type setup
//////////////////////////
function method_post_type() {
    $labels = array(
        'name' => 'Methods',
        'singular_name' => 'Method',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Method',
        'edit_item' => 'Edit Method',
        'new_item' => 'New Method',
        'view_item' => 'View Method',
        'search_items' => 'Search Methods',
        'not_found' => 'No Methods found',
        'not_fount_in_trash' => 'No Methods found in Trash'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-media-text',
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'page',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'revisions'
        ),
        # Gutenberg editor config stuff from here on
        'show_in_rest' => true,
        'template' => array(
            array('core/heading', array('content' => 'Sample Requirements')),
            array('core/list'),
            array('core/heading', array('content' => 'How to evaluate the sample quality')),
            array('core/paragraph', array('content' => 'We check your samples upon arrival, however we still require our users to do their own QC steps before sending samples. For this library prep method, we require:')),
            array('core/list'),
            array('core/paragraph', array('content' => 'If you are not able to carry out these steps, or your samples are below the required thresholds, please get in touch.')),
            array('core/heading', array('content' => 'What we do with your samples')),
            array('core/paragraph'),
            array('core/heading', array('content' => 'Library Preparation', 'level' => '3')),
            array('core/paragraph'),
            array('core/heading', array('content' => 'Library QC and Sequencing', 'level' => '3')),
            array('core/paragraph'),
            array('core/heading', array('content' => 'Expected Results')),
            array('core/paragraph'),
            array('core/heading', array('content' => 'Bioinformatics')),
            array('core/paragraph'),
        ),
    );
    register_post_type('methods', $args);
}
add_action('init', 'method_post_type');

// Set up the taxonomy (categories)
function create_method_tax() {
    $cat_labels = array(
        'name'                       => _x( 'Applications', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Application', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Applications', 'text_domain' ),
        'all_items'                  => __( 'All Applications', 'text_domain' ),
        'parent_item'                => __( 'Parent Application', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Application:', 'text_domain' ),
        'new_item_name'              => __( 'New Application', 'text_domain' ),
        'add_new_item'               => __( 'Add Application', 'text_domain' ),
        'edit_item'                  => __( 'Edit Application', 'text_domain' ),
        'update_item'                => __( 'Update Application', 'text_domain' ),
        'view_item'                  => __( 'View Application', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate applications with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove applications', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Applications', 'text_domain' ),
        'search_items'               => __( 'Search Applications', 'text_domain' ),
        'not_found'                  => __( 'No applications found', 'text_domain' ),
        'no_terms'                   => __( 'No applications', 'text_domain' ),
        'items_list'                 => __( 'Applications list', 'text_domain' ),
        'items_list_navigation'      => __( 'Applications list navigation', 'text_domain' ),
    );
    $cat_args = array(
        'labels'                     => $cat_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'applications', 'methods', $cat_args );

    $keyword_labels = array(
        'name'                       => __( 'Associated Keywords' ),
        'singular_name'              => __( 'Associated Keyword' ),
        'search_items'               => __( 'Search Keywords' ),
        'popular_items'              => __( 'Popular Keywords' ),
        'all_items'                  => __( 'All Keywords' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Keyword' ),
        'update_item'                => __( 'Update Keyword' ),
        'add_new_item'               => __( 'Add New Keyword' ),
        'new_item_name'              => __( 'New Keyword Name' ),
        'separate_items_with_commas' => __( 'Separate keywords with commas' ),
        'add_or_remove_items'        => __( 'Add or remove keywords' ),
        'choose_from_most_used'      => __( 'Choose from the most used keywords' ),
        'not_found'                  => __( 'No keywords found.' ),
        'menu_name'                  => __( 'Keywords' ),
    );
    $keyword_args = array(
        'hierarchical'          => false,
        'labels'                => $keyword_labels,
        'show_ui'               => true,
        'show_admin_column'     => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
    );
    register_taxonomy('keywords', 'methods', $keyword_args);
}
add_action( 'init', 'create_method_tax', 0 );


// Add custom fields to the Applications taxonomy
function applications_taxonomy_custom_fields($tag) {
    $term_meta = get_option( "application_page_".$tag->term_id ); ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="application_page"><?php _e('Application page'); ?></label>
        </th>
        <td>
            <?php wp_dropdown_pages(array(
                'selected' => $term_meta['application_page'],
                'id' => 'application_page',
                'name' => 'application_page',
                'show_option_none'  => '[ choose a page ]',
                'option_none_value' => 0,
            )); ?>
            <p><?php _e('Used so that we can write more than just a short description box.'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="application_icon"><?php _e('Application Icon'); ?></label>
        </th>
        <td>
            <input type="text" name="application_icon" id="application_icon" size="25" style="width:60%;" value="<?php echo $term_meta['application_icon'] ? $term_meta['application_icon'] : ''; ?>"><br />
            <p><?php _e('Find an icon and click + copy the text associated into the above box.'); ?>
            <a href="<?php echo get_template_directory_uri() ?>/includes/icons/index.php" target="_blank"><?php _e('Click here to find icon URLs'); ?></a></p>
        </td>
    </tr>
    <?php
}
// A callback function to save our extra taxonomy field(s)
function save_applications_tax_custom_fields( $term_id ) {
    $term_meta = get_option( "application_icon_".$term_id );
    if ( isset( $_POST['application_page'] ) ) {
        $term_meta['application_page'] = $_POST['application_page'];
    }
    if ( isset( $_POST['application_icon'] ) ) {
        $term_meta['application_icon'] = $_POST['application_icon'];
    }
    update_option( "application_page_".$term_id, $term_meta );
}
add_action( 'applications_add_form_fields', 'applications_taxonomy_custom_fields', 10, 2 );
add_action( 'applications_edit_form_fields', 'applications_taxonomy_custom_fields', 10, 2 );
add_action( 'edited_applications', 'save_applications_tax_custom_fields', 10, 2 );
add_action( 'create_applications', 'save_applications_tax_custom_fields', 10, 2 );

// Show this in the table of applications
function applications_pageurl_column_header( $columns ){
    $columns['header_name'] = 'Application Page';
    return $columns;
}
add_filter( "manage_edit-applications_columns", 'applications_pageurl_column_header', 10);

function applications_pageurl_column_content( $value, $column_name, $tax_id ){
    $term_meta = get_option( "application_page_".$tax_id );
    if(isset($term_meta['application_page'])){
        $ptitle = get_the_title($term_meta['application_page']);
        $purl = get_page_link($term_meta['application_page']);
        echo '<a href="'.$purl.'">'.$ptitle.'</a>';
    } else {
        echo '-';
    }
}
add_action( "manage_applications_custom_column", 'applications_pageurl_column_content', 10, 3);
