<?php
/*
Plugin Name: Library Preps
Plugin URI: https://github.com/NationalGenomicsInfrastructure/ngisweden.se
Description: Plugin to handle administration, submission and display of library prep methods on the NGI website.
Version: 1.0
Author: Phil Ewels
Author URI: http://phil.ewels.co.uk
License: MIT
*/

require_once('blocks/register_blocks.php');

//////////////////////////
// Custom Post Type setup
//////////////////////////
function libprep_post_type() {
    $labels = array(
        'name' => 'Library Preps',
        'singular_name' => 'Library Prep',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Library Prep',
        'edit_item' => 'Edit Library Prep',
        'new_item' => 'New Library Prep',
        'view_item' => 'View Library Prep',
        'search_items' => 'Search Library Preps',
        'not_found' => 'No Library Preps found',
        'not_fount_in_trash' => 'No Library Preps found in Trash'
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
            array( 'libpreps/usewhen'),
            array( 'core/paragraph', array('placeholder' => 'Short one-sentence introduction')),
            array( 'core/heading', array('content' => 'Sample Requirements')),
            array( 'core/list'),
            array( 'core/heading', array('content' => 'How to evaluate the sample quality')),
            array( 'core/paragraph', array('content' => 'We check your samples upon arrival, however we still require our users to do their own QC steps before sending samples. For this library prep method, we require:')),
            array( 'core/list'),
            array( 'core/paragraph', array('content' => 'If you are not able to carry out these steps, or your samples are below the required thresholds, please get in touch.')),
            array( 'core/heading', array('content' => 'What we do with your samples')),
            array( 'core/paragraph'),
            array( 'core/heading', array('content' => 'Library Preparation', 'level' => '3')),
            array( 'core/paragraph'),
            array( 'core/heading', array('content' => 'Library QC and Sequencing', 'level' => '3')),
            array( 'core/paragraph'),
            array( 'core/heading', array('content' => 'Expected Results')),
            array( 'core/paragraph'),
            array( 'core/heading', array('content' => 'Bioinformatics')),
            array( 'core/paragraph'),
        ),
    );
    register_post_type('libpreps', $args);
}
add_action('init', 'libprep_post_type');

// Set up the taxonomy (categories)
function create_libprep_tax() {
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
    register_taxonomy( 'applications', 'libpreps', $cat_args );

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
    register_taxonomy('keywords', 'libpreps', $keyword_args);
}
add_action( 'init', 'create_libprep_tax', 0 );
