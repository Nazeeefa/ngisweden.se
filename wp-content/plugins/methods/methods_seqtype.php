<?php

//////////////////////////
// Sequencing Types Taxonomy
//////////////////////////

// Set up the taxonomy (categories)
function create_method_tax_seqtype() {
    $cat_labels = array(
        'name'                       => _x( 'Sequencing Types', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Sequencing Type', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Sequencing Types', 'text_domain' ),
        'all_items'                  => __( 'All Sequencing Types', 'text_domain' ),
        'parent_item'                => __( 'Parent Sequencing Type', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Sequencing Type:', 'text_domain' ),
        'new_item_name'              => __( 'New Sequencing Type', 'text_domain' ),
        'add_new_item'               => __( 'Add Sequencing Type', 'text_domain' ),
        'edit_item'                  => __( 'Edit Sequencing Type', 'text_domain' ),
        'update_item'                => __( 'Update Sequencing Type', 'text_domain' ),
        'view_item'                  => __( 'View Sequencing Type', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate sequencing types with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove sequencing types', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Sequencing Types', 'text_domain' ),
        'search_items'               => __( 'Search Sequencing Types', 'text_domain' ),
        'not_found'                  => __( 'No sequencing types found', 'text_domain' ),
        'no_terms'                   => __( 'No sequencing types', 'text_domain' ),
        'items_list'                 => __( 'Sequencing Types list', 'text_domain' ),
        'items_list_navigation'      => __( 'Sequencing Types list navigation', 'text_domain' ),
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
    register_taxonomy( 'sequencing types', 'methods', $cat_args );
}
add_action( 'init', 'create_method_tax_seqtype', 0 );
