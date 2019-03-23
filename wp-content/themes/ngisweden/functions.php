<?php
/* NGIsweden Theme Functions */

$ngisweden_theme_version = 0.1;

// Enqueue Bootstrap JS and CSS files
function ngis_wp_bootstrap_scripts_styles() {
  wp_enqueue_script('jqueryjs', get_stylesheet_directory_uri().'/includes/js/jquery-3.3.1.slim.min.js', array(), '3.3.1', true );
  wp_enqueue_script('popperjs', get_stylesheet_directory_uri().'/includes/js/popper.min.js', array(), '1.14.7', true );
  wp_enqueue_script('bootstrapjs', get_stylesheet_directory_uri().'/includes/js/bootstrap.min.js', array(), '4.3.1', true );
  wp_enqueue_style('bootstrapcss', get_stylesheet_directory_uri().'/includes/css/bootstrap.min.css', array(),'4.3.1');
  wp_enqueue_style('fontawesomecss', get_stylesheet_directory_uri().'/includes/css/fontawesome.all.min.css', array(),'5.8.1');
  wp_enqueue_style('style', get_stylesheet_directory_uri().'/style.css', array(), $ngisweden_theme_version);
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
