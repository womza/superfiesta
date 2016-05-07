<?php
/*
Template Name: 09 Reservations
*/

get_header(); global $tuscany_opt; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	$reservation_form = get_post_meta($post->ID, '_cmb_reservation-shortcode', true);
	$staff_one        = get_post_meta($post->ID, '_cmb_contact_staff_one', true);
	$staff_two        = get_post_meta($post->ID, '_cmb_contact_staff_two', true);
	$food_check       = get_post_meta($post->ID, '_cmb_food-check', true);
	$food_images      = get_post_meta($post->ID, '_cmb_food-images', true);

	if (!empty($staff_one)) {
	    echo "<style>.our-description-text:before{background-image: url(".esc_url($staff_one).");}</style>";
	}
	if (!empty($staff_two)) {
	    echo "<style>.our-description-text:after{background-image: url(".esc_url($staff_two).");}</style>";
	}
?>

	<div class="about-us-wrapper" data-stellar-background-ratio="0.5">
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
	                   	    <?php echo do_shortcode($reservation_form); ?>
	                   	<?php endif ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

<?php endwhile; endif; ?>

<?php get_template_part('inc/blocks/team-members'); ?>

<?php get_template_part('inc/blocks/blackboard'); ?>

<?php get_template_part('inc/blocks/history'); ?>

<?php get_template_part('inc/blocks/testimonials-slider'); ?>

<?php get_template_part('inc/blocks/gallery-slider'); ?>


<?php get_footer(); ?>