<?php
/**
 * Laborator Visual Composer Settings
 *
 */

/* ! Layout Elements */
$curr_dir = dirname(__FILE__);

//////////////////////////////////////////
// Remove some of the defaults elements //
//////////////////////////////////////////
$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;

/* Register Own Param Types */


/* Shortcodes */
add_action('init', 'avathemes_vc_shortcodes');

function avathemes_vc_shortcodes()
{
	global $curr_dir;

	include_once($curr_dir . '/shortcodes/vc_parallax.php');
	include_once($curr_dir . '/shortcodes/vc_parallax_image.php');
	include_once($curr_dir . '/shortcodes/vc_gallery.php');
	include_once($curr_dir . '/shortcodes/vc_latest_news.php');
	include_once($curr_dir . '/shortcodes/vc_testimonials_one.php');
	include_once($curr_dir . '/shortcodes/vc_testimonials_two.php');
	include_once($curr_dir . '/shortcodes/vc_history.php');
	include_once($curr_dir . '/shortcodes/vc_about.php');
	include_once($curr_dir . '/shortcodes/vc_add_product.php');
	include_once($curr_dir . '/shortcodes/vc_opening.php');
	include_once($curr_dir . '/shortcodes/vc_how_we_started.php');
	include_once($curr_dir . '/shortcodes/vc_news_slider.php');
	include_once($curr_dir . '/shortcodes/vc_counter.php');
	include_once($curr_dir . '/shortcodes/vc_about_board.php');
	include_once($curr_dir . '/shortcodes/vc_slider_dish.php');
	include_once($curr_dir . '/shortcodes/vc_product_book.php');
	include_once($curr_dir . '/shortcodes/vc_animations_slider.php');
	include_once($curr_dir . '/shortcodes/vc_events.php');
	include_once($curr_dir . '/shortcodes/vc_bar_slider_dish.php');
	include_once($curr_dir . '/shortcodes/vc_team_members.php');

	if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option( 'active_plugins'))))
	{
		include_once($curr_dir . '/shortcodes/vc_dishes_slider.php');
	}
}

/* Admin Styles */
add_action('admin_enqueue_scripts', 'avathemes_vc_styles', 50);
function avathemes_vc_styles()
{
	wp_enqueue_style('avathemes_vc_backend', get_template_directory_uri().'/avathemes_vc/assets/avathemes_vc_main.css', array(), '1.0', 'all' );
}

/* Frontend Styles */
add_action('wp_enqueue_scripts', 'avathemes_vc_styles_frontend', 50);
function avathemes_vc_styles_frontend()
{
	wp_enqueue_style('avathemes_vc_frontend', get_template_directory_uri().'/avathemes_vc/assets/frontend_vc.css', array(), '1.0', 'all' );
}