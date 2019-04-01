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


// Add custom fields to the Status taxonomy
function method_status_taxonomy_custom_fields($tag) {
    $term_meta = get_option( "method_status_icon_".$tag->term_id );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="method_status_colour"><?php _e('Status colour'); ?></label>
        </th>
        <td>
            <select name="method_status_colour" id="method_status_colour">
                <option value="primary"<?php if($term_meta['method_status_colour'] == 'primary'){ echo ' selected="selected"'; } ?>>Blue</option>
                <option value="info"<?php if($term_meta['method_status_colour'] == 'info'){ echo ' selected="selected"'; } ?>>Turquoise</option>
                <option value="success"<?php if($term_meta['method_status_colour'] == 'success'){ echo ' selected="selected"'; } ?>>Green</option>
                <option value="warning"<?php if($term_meta['method_status_colour'] == 'warning'){ echo ' selected="selected"'; } ?>>Orange</option>
                <option value="danger"<?php if($term_meta['method_status_colour'] == 'danger'){ echo ' selected="selected"'; } ?>>Red</option>
                <option value="secondary"<?php if($term_meta['method_status_colour'] == 'secondary'){ echo ' selected="selected"'; } ?>>Grey</option>
            </select>
            <p><?php _e('Set the colour of the icon'); ?></p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="method_status_icon"><?php _e('Status Icon'); ?></label>
        </th>
        <td>
            <input type="text" name="method_status_icon" id="method_status_icon" size="25" style="width:60%;" value="<?php echo $term_meta['method_status_icon'] ? $term_meta['method_status_icon'] : ''; ?>"><br />
            <p><?php _e('Find an icon and click + copy the text associated into the above box.'); ?>
            <a href="<?php echo get_template_directory_uri() ?>/includes/icons/index.php" target="_blank"><?php _e('Click here to find icon URLs'); ?></a></p>
        </td>
    </tr>
    <?php
}
// A callback function to save our extra taxonomy field(s)
function save_method_status_tax_custom_fields( $term_id ) {
    $term_meta = get_option( "method_status_icon_".$term_id );
    if ( isset( $_POST['method_status_colour'] ) ) {
        $term_meta['method_status_colour'] = $_POST['method_status_colour'];
    }
    if ( isset( $_POST['method_status_icon'] ) ) {
        $term_meta['method_status_icon'] = $_POST['method_status_icon'];
    }
    update_option( "method_status_icon_".$term_id, $term_meta );
}
add_action( 'method_status_add_form_fields', 'method_status_taxonomy_custom_fields', 10, 2 );
add_action( 'method_status_edit_form_fields', 'method_status_taxonomy_custom_fields', 10, 2 );
add_action( 'edited_method_status', 'save_method_status_tax_custom_fields', 10, 2 );
add_action( 'create_method_status', 'save_method_status_tax_custom_fields', 10, 2 );
