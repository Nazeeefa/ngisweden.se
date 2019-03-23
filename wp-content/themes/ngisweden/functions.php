<?php
/* NGIsweden Theme Functions */

$ngisweden_theme_version = 0.1;

// Enqueue Bootstrap JS and CSS files
function ngis_wp_bootstrap_scripts_styles() {
    wp_enqueue_script('jqueryjs', get_stylesheet_directory_uri().'/includes/js/jquery-3.3.1.slim.min.js', array(), '3.3.1', true );
    wp_enqueue_script('popperjs', get_stylesheet_directory_uri().'/includes/js/popper.min.js', array(), '1.14.7', true );
    wp_enqueue_script('bootstrapjs', get_stylesheet_directory_uri().'/includes/js/bootstrap.min.js', array(), '4.3.1', true );
    wp_enqueue_script('ngisweden', get_stylesheet_directory_uri().'/ngisweden.js', array(), $ngisweden_theme_version, true);
    wp_enqueue_style('bootstrapcss', get_stylesheet_directory_uri().'/includes/css/bootstrap.min.css', array(),'4.3.1');
    wp_enqueue_style('fontawesomecss', get_stylesheet_directory_uri().'/includes/css/fontawesome.all.min.css', array(),'5.8.1');
    wp_enqueue_style('ngisweden', get_stylesheet_directory_uri().'/style.css', array(), $ngisweden_theme_version);
}
add_action('wp_enqueue_scripts', 'ngis_wp_bootstrap_scripts_styles');

// Register navigation menus
require_once('includes/bs4navwalker.php');
function register_ngisweden_nav() {
    register_nav_menu('main-nav',__( 'Main Navigation' ));
    register_nav_menu('secondary-nav',__( 'Secondary Navigation' ));
}
add_action('init', 'register_ngisweden_nav');

// Register widget areas
function ngisweden_widgets_init() {
    register_sidebar( array(
        'name' => 'Footer - Column 1',
        'id' => 'footer-widget-area-1',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
    register_sidebar( array(
        'name' => 'Footer - Column 2',
        'id' => 'footer-widget-area-2',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
    register_sidebar( array(
        'name' => 'Footer - Column 3',
        'id' => 'footer-widget-area-3',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
    register_sidebar( array(
        'name' => 'Footer - Column 4',
        'id' => 'footer-widget-area-4',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
    register_sidebar( array(
        'name' => 'Footer - Column 5',
        'id' => 'footer-widget-area-5',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
}
add_action('widgets_init', 'ngisweden_widgets_init');

// Rename "Posts" to "News"
// https://gist.github.com/gyrus/3155982
add_action( 'admin_menu', 'ngisweden_change_post_menu_label' );
add_action( 'init', 'ngisweden_change_post_object_label' );
function ngisweden_change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    $submenu['edit.php'][16][0] = 'News Tags';
    echo '';
}
function ngisweden_change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News';
    $labels->new_item = 'News';
    $labels->view_item = 'View News';
    $labels->search_items = 'Search News';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
}

// Allow styling in the gutenberg editor to match front-end
function ngisweden_guten_block_editor_assets() {
    wp_enqueue_style(
        'ngisweden-editor-style',
        get_stylesheet_directory_uri() . "/editor.css",
        array(),
        '1.0'
    );
}
add_action('enqueue_block_editor_assets', 'ngisweden_guten_block_editor_assets');
