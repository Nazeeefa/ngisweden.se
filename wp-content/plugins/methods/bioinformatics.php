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
            array('core/shortcode', array('text' => '[github_badge repo=https://github.com/githubtraining/hellogitworld]')),
            array('core/heading', array('content' => 'Input data')),
            array('core/paragraph', array('placeholder' => 'For example, FastQ files, a reference genome and some metadata.')),
            array('core/list'),
            array('core/heading', array('content' => 'Results')),
            array('core/paragraph', array('placeholder' => 'Short description of what results the pipeline generates. Link to repository docs for detail.')),
            array('core/list'),
            array('core/heading', array('content' => 'Example Report')),
            array('core/paragraph', array('placeholder' => 'Upload one or more example outputs. eg. a MultiQC report.')),
        ),
    );
    register_post_type('bioinformatics', $args);
}
add_action('init', 'bioinformatics_post_type');
