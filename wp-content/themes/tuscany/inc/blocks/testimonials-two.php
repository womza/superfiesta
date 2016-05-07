<?php global $tuscany_opt;
    if (isset($tuscany_opt['tuscany-testimonials-bg'])) {
        $testimonials_bg = $tuscany_opt['tuscany-testimonials-bg']['url'];
    }
    if (isset($tuscany_opt['tuscany-switch-image']) && !$tuscany_opt['tuscany-switch-image']) {
        echo "<style>.testimonials-wrapp > div {vertical-align:middle;} .testimonials-wrapp.testimonials-wrapp-two .slick-slider {padding-top: 0;}</style>";
    }
?>

<!-- Parallax Testimonials -->
<div class="parallax-block parallax-testimonials top-divide" data-stellar-background-ratio="0.5" data-stellar-horizontal-offset="50" <?php echo (!empty($testimonials_bg)) ? 'style="background-image: url('.esc_url($testimonials_bg).');"' : ''; ?>>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="testimonials-wrapp testimonials-wrapp-two">
                <div class="testimonial-content">
                <?php
                   $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );
                   $loop = new WP_Query( $args );
                   if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                   global $post;
                   if (has_post_thumbnail()) {
                    $class_content = "col-xs-12 col-sm-8 col-md-8 col-lg-8 omega alpha";
                   } else {
                    $class_content = "col-xs-12 col-sm-12 col-md-12 col-lg-12 omega alpha";
                   }
                   ?>
                    <div>
                        <div class="<?php echo $class_content; ?>">
                            <h4><?php the_title(); ?></h4>
                            <?php the_content(); ?>
                            <?php if($post->post_excerpt): ?>
                            <span>- <?php echo $post->post_excerpt; ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if (has_post_thumbnail() && $tuscany_opt['tuscany-switch-image']): ?>
                            <div class="hidden-xs col-sm-4 text-right col-md-4 col-lg-4 omega alpha">
                                <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endwhile; endif; ?>
                </div>
            </div>
            <div class="testimonials-nav-arrows">
                <div>
                    <a href="#" class="fa fa-chevron-up" data-dir="up"></a>
                    <a href="#" class="fa fa-chevron-down" data-dir="down"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Parallax Testimonials -->