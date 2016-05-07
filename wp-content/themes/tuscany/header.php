<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Tuscany
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php global $tuscany_opt;
if (isset($tuscany_opt['tuscany-favicon']) && !empty($tuscany_opt['tuscany-favicon'])) {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.esc_url($tuscany_opt['tuscany-favicon']['url']).'">';
} ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Mobile Canvas Menu -->
<div class="mobile-nav">
    <div>
        <ul>
            <li><a href="#" id="close-canvas" class="fa fa-close text-right"></a></li>
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                // User has assigned menu to this location;
                // output it
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav',
                    'container'      => '',
                    'items_wrap'     => '%3$s',
                ) );
            } else {
                echo '<li><a href="'.admin_url().'nav-menus.php">Create your Menu</a></li>';
            }
            ?>
        </ul>
    </div>
</div>
<!-- End Mobile Canvas -->

<?php if (is_page_template('templates/homepage-video.php')): ?>
    <?php get_template_part('inc/header-video'); ?>
<?php elseif(is_page_template('templates/homepage-woody.php')): ?>
    <?php get_template_part('inc/header-ribbon'); ?>
<?php else: ?>
    <?php get_template_part('inc/header-iconic'); ?>
<?php endif ?>

