<?php
/**
 * Gen Why Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Genwhy_Theme
 */

if ( ! function_exists( 'genwhy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function genwhy_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html( 'Primary Menu' ),
	) );

	// Switch search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif; // genwhy_setup
add_action( 'after_setup_theme', 'genwhy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function genwhy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'genwhy_content_width', 640 );
}
add_action( 'after_setup_theme', 'genwhy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function genwhy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html( 'Sidebar' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'genwhy_widgets_init' );

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function genwhy_minified_css( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( file_exists( get_template_directory() . '/build/css/style.min.css' ) ) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
	}

	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'genwhy_minified_css', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function genwhy_scripts() {
	wp_enqueue_style( 'genwhy-style', get_stylesheet_uri() );

	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

	wp_enqueue_style( 'style-bxslider', get_template_directory_uri() . '/js/js-bxslider/jquery.bxslider.css' );

	wp_enqueue_script( 'script-bxslider', get_template_directory_uri() . '/js/js-bxslider/jquery.bxslider.min.js', array('jquery'), false, true );

	wp_enqueue_script( 'scripts-js', get_template_directory_uri() . '/build/js/scripts.min.js', array('jquery'), false, true );

	wp_enqueue_script( 'genwhy-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'genwhy_scripts' );

// function current_jquery($version) {
//         global $wp_scripts;
//         if ( ( version_compare($version, $wp_scripts -> registered[jquery] -> ver) == 1 ) && !is_admin() ) {
//                 wp_deregister_script('jquery');

//                 wp_register_script('jquery',
//                         'http://ajax.googleapis.com/ajax/libs/jquery/'.$version.'/jquery.min.js',
//                         false, $version);
//         }
// }

// add_action( 'wp_head', current_jquery( '1.11.3' ) ); // change number to latest version

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
