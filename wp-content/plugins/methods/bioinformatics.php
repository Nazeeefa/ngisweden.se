<?php

/////////////////////////////////////
// Custom Post Type setup - Bioinformatics Analyses
/////////////////////////////////////
function bioinformatics_post_type() {
    $labels = array(
        'name' => 'Bioinformatics',
        'singular_name' => 'Bioinformatics',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Bioinformatics Analysis',
        'edit_item' => 'Edit Bioinformatics Analysis',
        'new_item' => 'New Bioinformatics Analysis',
        'view_item' => 'View Bioinformatics Analysis',
        'search_items' => 'Search Bioinformatics Analyses',
        'not_found' => 'No Bioinformatics Analyses found',
        'not_fount_in_trash' => 'No Bioinformatics Analyses found in Trash'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-desktop',
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
        'taxonomies' => [ 'applications', 'sequencing_type', 'method_keywords', 'method_status' ],
        # Gutenberg editor config stuff from here on
        'show_in_rest' => true,
        'template' => array(
//            array('core/heading', array('content' => 'Sample Requirements')),
//            array('core/list'),
//            array('core/heading', array('content' => 'How to evaluate the sample quality')),
//            array('core/paragraph', array('content' => 'We check your samples upon arrival, however we still require our users to do their own QC steps before sending samples. For this library prep method, we require:')),
//            array('core/list'),
//            array('core/paragraph', array('content' => 'If you are not able to carry out these steps, or your samples are below the required thresholds, please get in touch.')),
//            array('core/heading', array('content' => 'What we do with your samples')),
//            array('core/paragraph'),
//            array('core/heading', array('content' => 'Library Preparation', 'level' => '3')),
//            array('core/paragraph'),
//            array('core/heading', array('content' => 'Library QC and Sequencing', 'level' => '3')),
//            array('core/paragraph'),
//            array('core/heading', array('content' => 'Expected Results')),
//            array('core/paragraph'),
//            array('core/heading', array('content' => 'Bioinformatics')),
//            array('core/paragraph'),
        ),
    );
    register_post_type('bioinformatics', $args);
}
add_action('init', 'bioinformatics_post_type');
