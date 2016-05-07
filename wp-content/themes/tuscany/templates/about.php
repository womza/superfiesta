<?php
/*
Template Name: 05 About
*/

get_header(); global $tuscany_opt; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    $image_id     = get_post_thumbnail_id();
    $image_url    = wp_get_attachment_image_src($image_id,'large', true);
    $staff_check  = get_post_meta($post->ID, '_cmb_staff-check', true);
    $staff_images = get_post_meta($post->ID, '_cmb_staff-images', true);
    $staff_one    = get_post_meta($post->ID, '_cmb_about_staff_one', true);
    $staff_two    = get_post_meta($post->ID, '_cmb_about_staff_two', true);

    if (!empty($staff_one)) {
        echo "<style>.our-description-text:before{background-image: url(".esc_url($staff_one).");}</style>";
    }
    if (!empty($staff_two)) {
        echo "<style>.our-description-text:after{background-image: url(".esc_url($staff_two).");}</style>";
    }
?>

<!-- About Block -->
<div class="about-us-wrapper" data-stellar-background-ratio="0.5" <?php echo (!empty($image_url[0])) ? 'style="background-image:url('.esc_url($image_url[0]).');"' : ''; ?>>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if ($staff_check): ?>
                <div class="animation-about-food">
                    <?php foreach ($staff_images as $images => $image): ?>
                        <?php echo wp_get_attachment_image( $images, 'full' ); ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <div class="our-description-text element-animate" data-animation="bounceInUp">
                <div class="tus-scroll">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About Block -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>