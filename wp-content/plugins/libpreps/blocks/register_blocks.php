<?php

// New gutenberg block category for library preps
function libprep_block_categories( $categories, $post ) {
    return array_merge( $categories, array( array(
        'slug' => 'libpreps',
        'title' => __( 'Library Preps', 'libpreps' ),
    )));
}
add_filter( 'block_categories', 'libprep_block_categories', 10, 2);

// Add a custom Gutenberg block for 'you would use this prep when'
function libpreps_usewhen_gutenberg_block() {
    wp_register_script(
        'libpreps-usewhen',
        plugins_url( 'usewhen.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' )
    );
    register_block_type( 'libpreps/usewhen', array(
        'editor_script' => 'libpreps-usewhen',
        'editor_style' => 'libpreps-usewhen',
    ) );
}
add_action( 'init', 'libpreps_usewhen_gutenberg_block' );
