<?php

//////////////////////////
// Method Status Taxonomy
//////////////////////////

// Set up the taxonomy (categories)
function create_method_tax_status() {
    $cat_labels = array(
        'name'                       => _x( 'Status', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Status', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Statuses', 'text_domain' ),
        'all_items'                  => __( 'All Statuses', 'text_domain' ),
        'parent_item'                => __( 'Parent Status', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Status:', 'text_domain' ),
        'new_item_name'              => __( 'New Status', 'text_domain' ),
        'add_new_item'               => __( 'Add Status', 'text_domain' ),
        'edit_item'                  => __( 'Edit Status', 'text_domain' ),
        'update_item'                => __( 'Update Status', 'text_domain' ),
        'view_item'                  => __( 'View Status', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate statuses with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove statuses', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Statuses', 'text_domain' ),
        'search_items'               => __( 'Search Statuses', 'text_domain' ),
        'not_found'                  => __( 'No statuses found', 'text_domain' ),
        'no_terms'                   => __( 'No statuses', 'text_domain' ),
        'items_list'                 => __( 'Statuses list', 'text_domain' ),
        'items_list_navigation'      => __( 'Statuses list navigation', 'text_domain' ),
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
    register_taxonomy( 'method_status', 'methods', $cat_args );
}
add_action( 'init', 'create_method_tax_status', 0 );
