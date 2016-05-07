<?php
/*
Template Name: 10 Contact
*/

get_header(); global $tuscany_opt; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	$marker_placements = get_post_meta($post->ID, '_cmb_marker_locations', true);
	$zoom_lvl          = get_post_meta($post->ID, '_cmb_map_zoom', true);
	$map_marker        = get_post_meta($post->ID, '_cmb_marker_image', true);
	$map_style         = get_post_meta($post->ID, '_cmb_map_style', true);
	$contact_form      = get_post_meta($post->ID, '_cmb_form-shortcode', true);
	$image_id          = get_post_thumbnail_id();
	$image_url         = wp_get_attachment_image_src($image_id,'large', true);
	$food_check        = get_post_meta($post->ID, '_cmb_food-check', true);
	$food_images       = get_post_meta($post->ID, '_cmb_food-images', true);
	$staff_one    = get_post_meta($post->ID, '_cmb_contact_staff_one', true);
	$staff_two    = get_post_meta($post->ID, '_cmb_contact_staff_two', true);

	if (!empty($staff_one)) {
	    echo "<style>.our-description-text:before{background-image: url(".esc_url($staff_one).");}</style>";
	}
	if (!empty($staff_two)) {
	    echo "<style>.our-description-text:after{background-image: url(".esc_url($staff_two).");}</style>";
	}
?>

	<div class="about-us-wrapper" data-stellar-background-ratio="0.5" <?php echo (!empty($image_url[0])) ? 'style="background-image:url('.esc_url($image_url[0]).');"' : ''; ?>>
	    <div class="container">
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	            <?php if ($food_images): ?>
	            	<?php if ($food_check): ?>
	            		<div class="animation-about-food contact-animation-food">
	            		    <?php foreach ($food_images as $images => $image): ?>
	            		        <?php echo wp_get_attachment_image( $images, 'full' ); ?>
	            		    <?php endforeach ?>
	            		</div>
	            	<?php endif ?>
	            <?php endif ?>
	            <div class="our-description-text our-contact-form element-animate" data-animation="bounceInUp">
	                <div class="tus-scroll">
	                    <h2><?php the_title(); ?></h2>
	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
	                        <?php the_content(); ?>
	                    </div>
	                   	<?php if (class_exists('WPCF7_ContactForm')): ?>
	                   	    <?php echo do_shortcode($contact_form); ?>
	                   	<?php endif ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<?php get_template_part('inc/blocks/best-dishes'); ?>

	<!-- Google Map -->
	<div class="google-map-holder top-divide">
	    <div id="map-canvas" style="width: 100%; height: 100%"></div>
	</div>
	<!-- End GoogleMap -->
<?php endwhile; endif; ?>

<?php

wp_enqueue_script( 'tuscany-map', get_template_directory_uri() . '/js/min/map-dist.js', array(), '1.0', true );

wp_localize_script(
    'tuscany-map',
    'map_vars',
    array(
		'map_marker' => $map_marker,
		'places'     => $marker_placements,
		'zoom_lvl'   => $zoom_lvl,
		'map_style'  => $map_style
    )
);

?>

<?php get_template_part('inc/blocks/opening'); ?>

<?php get_footer(); ?>