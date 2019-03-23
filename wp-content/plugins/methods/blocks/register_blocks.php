<?php

// New gutenberg block category for methods
function method_block_categories( $categories, $post ) {
    return array_merge( $categories, array( array(
        'slug' => 'methods',
        'title' => __( 'NGI Methods', 'methods' ),
    )));
}
add_filter( 'block_categories', 'method_block_categories', 10, 2);

// Add a custom Gutenberg block for 'you might use this prep when'
function methods_usewhen_gutenberg_block() {
    wp_register_script(
        'methods-usewhen',
        plugins_url('usewhen.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor')
    );
    register_block_type('methods/usewhen', array('editor_script' => 'methods-usewhen'));
}
add_action('init', 'methods_usewhen_gutenberg_block');
