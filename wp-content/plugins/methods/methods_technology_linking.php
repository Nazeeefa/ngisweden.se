<?php

function add_meta_boxes_methods_link_tech() {
    add_meta_box('methods_tech_link_metabox', 'Relevant Technologies', 'technologies_link_metabox_fields', 'methods', 'side', 'low');
}
add_action( 'add_meta_boxes_methods', 'add_meta_boxes_methods_link_tech' );

function technologies_link_metabox_fields() {
    global $post;
    $selected_technologies = get_post_meta($post->ID, '_technologies', true);
    $all_technologies = get_posts( array(
        'post_type' => 'technologies',
        'numberposts' => -1,
        'orderby' => 'post_title',
        'order' => 'ASC'
    ) );
    echo '<input type="hidden" name="technologies_nonce" value="'.wp_create_nonce( basename( __FILE__ ) ).'" />';
    echo '<div style="max-height: 200px; overflow-y: scroll;">';
    foreach ( $all_technologies as $tech ){
        $selected = '';
        if(is_array($selected_technologies) && in_array( $bioinfo->ID, $selected_technologies )){
            $selected = ' checked="checked"';
        }
        echo '<div style="margin-bottom: 8px;">';
        echo '<input id="tech_page_link_'.$tech->ID.'" name="technologies[]" type="checkbox" value="'.$tech->ID.'"'.$selected.'>';
        echo '<label for="tech_page_link_'.$tech->ID.'">'.$tech->post_title.'</label>';
        echo '</div>';
    }
    echo '</div>';
}

add_action( 'save_post', 'save_technologies_link_metabox_fields' );
function save_technologies_link_metabox_fields( $post_id ) {
    // only run this for series
    if (get_post_type( $post_id ) != 'methods'){ return $post_id; }
    // verify nonce
    if ( empty( $_POST['technologies_nonce'] ) || !wp_verify_nonce( $_POST['technologies_nonce'], basename( __FILE__ ) ) ){
        return $post_id;
    }
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ return $post_id; }
    // check permissions
    if ( !current_user_can( 'edit_post', $post_id ) ){ return $post_id; }

    // save
    update_post_meta( $post_id, '_technologies', array_map( 'intval', $_POST['technologies'] ) );
}
