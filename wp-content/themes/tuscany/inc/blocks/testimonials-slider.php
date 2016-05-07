<?php global $tuscany_opt;

?>

<!-- Parallax With Image -->
<div class="parallax-block clients-testimonials top-divide" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="clients-speaks-slider">
                <div>
                    <?php
                       $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );
                       $loop = new WP_Query( $args );
                       $counter = 1;
                       if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                       global $post;
                       $slider_img = get_post_meta($post->ID, '_cmb_testimonial_slider_img', true);
                       ?>
                       <?php if ($counter % 4 == 0) {
                           echo "</div><div>";
                       } ?>
                        <div class="testimonial-slide">
                            <div>
                                <div class="testi-text">
                                    <h4><?php the_title(); ?></h4>
                                    <?php the_content(); ?>
                                    <?php if($post->post_excerpt): ?>
                                    <span>- <?php echo $post->post_excerpt; ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if (isset($slider_img) && !empty($slider_img)): ?>
                                    <img src="<?php echo esc_url($slider_img); ?>" alt="Testimonial Image">
                                <?php else: ?>
                                    <div style="min-height: 495px; width: 100%;"></div>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php $counter++; endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Parallax With Image -->