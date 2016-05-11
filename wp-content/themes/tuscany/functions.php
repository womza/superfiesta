<?php
/**
 * Tuscany functions and definitions
 *
 * @package Tuscany
 */

/**
 * Define Constants
 */
define('THEME_NAME', 'tuscany');
define('THEME_URI', get_template_directory_uri());

/**
 * Add Redux Framework & extras
 */
require get_template_directory() . '/admin/admin-init.php';

/**
 * Embed VC Shortcodes if VC is installed
 */
if(in_array('js_composer/js_composer.php', apply_filters('active_plugins', get_option('active_plugins'))))
{
	require 'avathemes_vc/config.php';
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1024; /* pixels */
}

if ( ! function_exists( 'tuscany_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tuscany_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tuscany, use a find and replace
	 * to change 'tuscany' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tuscany', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	add_theme_support('woocommerce');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size('medium-thumb', 300, 300, true);
	add_image_size('slider-img', 400, 390, true);
	add_image_size('attachment-round', 100, 100, true);
	add_image_size('vertical', 400, 450, true);
	add_image_size('global', 800, 400, true);
	add_image_size('big-sizy', 1000, 400, true);
	add_image_size('small-sizy', 235, 225, true);
	add_image_size('quote-circle', 140, 140, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tuscany' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	// add_theme_support( 'post-formats', array(
	// 	'image'
	// ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tuscany_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // tuscany_setup
add_action( 'after_setup_theme', 'tuscany_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tuscany_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tuscany' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'tuscany' ),
		'id'            => 'footer-widgets',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="footer-widget col-xs-12 col-sm-6 col-md-3 col-lg-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'tuscany_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tuscany_scripts() {
	// Stylesheets
	wp_enqueue_style('tuscany-fontawesome', THEME_URI.'/css/font-awesome.css', array(), '1.0', 'all' );
	wp_enqueue_style('tuscany-prettyPhoto', THEME_URI.'/css/prettyPhoto.css', array(), '1.0', 'all' );
	wp_enqueue_style('tuscany-customScrollbar', THEME_URI.'/css/jquery.mCustomScrollbar.css', array(), '1.0', 'all' );
	if (is_page_template('templates/homepage-video.php') || is_page_template('templates/custom-page.php') || is_page_template('templates/menu.php')) {
		wp_enqueue_style('tuscany-video-styles', THEME_URI.'/css/bigvideo.css', array(), '1.0', 'all' );
	}
	wp_enqueue_style('tuscany-book-jquery', THEME_URI.'/css/jquery.booklet.1.1.0.css', array(), '1.0', 'all' );
	wp_enqueue_style('tuscany-book-styles', THEME_URI.'/css/book-styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('tuscany-animate', THEME_URI.'/css/animate.css', array(), '1.0', 'all' );
	wp_enqueue_style('tuscany-slick', THEME_URI.'/css/slick.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'tuscany-style', get_stylesheet_uri() );
	if (class_exists('woocommerce')) {
		wp_enqueue_style('tuscany-woocommerce-tuscany', THEME_URI.'/css/tuscany-commerce.css', array(), '1.0', 'all' );
	}

	// Javascripts
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'tuscany-modernizr', THEME_URI . '/js/vendor/modernizr-2.6.2.min.js', array(), '1.0' );
	wp_enqueue_script( 'tuscany-booklet', THEME_URI . '/js/min/jquery.booklet.1.1.0-dist.js', array(), '1.0', true );
	wp_enqueue_script( 'tuscany-booklet-custom', THEME_URI . '/js/min/book-script-dist.js', array(), '1.0', true );
	wp_enqueue_script( 'tuscany-plugins', THEME_URI . '/js/min/plugins-dist.js', array(), '1.0', true );
	wp_enqueue_script( 'tuscany-custom', THEME_URI . '/js/min/main-dist.js', array(), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tuscany_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/widgets/twitter-feed.php';

require get_template_directory() . '/inc/widgets/insta-feed.php';

require get_template_directory() . '/inc/metaboxes/metaboxes.php';

require get_template_directory() . '/inc/head-styles.php';


function tuscany_pagination() {
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'   => TRUE,
			'prev_text'    => __('', 'hipster'),
			'next_text'    => __('', 'hipster'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="tuscany-pagination text-center"><ul class="pagination">';
            foreach ( $pages as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul></div></div>';
        }
}

add_filter('get_avatar','tuscany_add_avatar_class');

function tuscany_add_avatar_class($class) {
    $class = str_replace("class='avatar", "class='avatar img-circle", $class);
    return $class;
}

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
			'label'     => 'PNG Product Image',
			'id'        => 'png-product',
			'post_type' => 'product'
        )
    );
}

function add_custom_styles_tuscany() {
	global $tuscany_opt;
	if (isset($tuscany_opt['custom-styles-tuscany'])) {
		echo "<style>".$tuscany_opt['custom-styles-tuscany']."</style>";
	}
}
add_filter('wp_head', 'add_custom_styles_tuscany');


function tracking_code_tuscany() {
    global $tuscany_opt;
    if (isset($tuscany_opt['google-anlytcs']) && !empty($tuscany_opt['google-anlytcs'])) {
    	echo $tuscany_opt['google-anlytcs'];
    }
}
add_action( 'wp_footer', 'tracking_code_tuscany' );

function price_array($price){
	$del = array('<span class="amount">', '</span>','<del>','<ins>');
	$price = str_replace($del, '', $price);
	$price = str_replace('</del>', '|', $price);
	$price = str_replace('</ins>', '|', $price);
	$price_arr = explode('|', $price);
	$price_arr = array_filter($price_arr);
	return $price_arr;
}

/**
 * Use WC 2.0 variable price format, now include sale price strikeout
 *
 * @param  string $price
 * @param  object $product
 * @return string
 */
function wc_wc20_variation_price_format( $price, $product ) {
    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice ) {
        $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
    }
    
    return $price;
}
add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );

remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );

//display 16 products per page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 16;' ), 20 );