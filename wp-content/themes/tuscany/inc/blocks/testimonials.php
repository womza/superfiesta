<?php global $tuscany_opt;
	if (isset($tuscany_opt['tuscany-testimonials-bg'])) {
		$testimonials_bg = $tuscany_opt['tuscany-testimonials-bg']['url'];
	}
    if (isset($tuscany_opt['tuscany-switch-image']) && !$tuscany_opt['tuscany-switch-image']) {
        echo "<style>.testimonials-wrapp > div {vertical-align:middle;}</style>";
    }
?>

<!-- Parallax Testimonials -->
<div class="parallax-block parallax-testimonials top-divide" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($testimonials_bg)) ? 'style="background-image: url('.esc_url($testimonials_bg).');"' : ''; ?>>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="testimonials-wrapp">
                <div class="nav-arrows">
                    <a href="" data-dir="up" class="fa fa-chevron-up"></a>
                    <a href="" data-dir="down" class="fa fa-chevron-down"></a>
                </div>
                <div class="testimonial-content">
                	<?php
                	   $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );
                	   $loop = new WP_Query( $args );
                	   if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                       global $post;
                	   if (has_post_thumbnail()) {
                	   	$class_content = "col-xs-12 col-sm-7 col-md-7 col-lg-7 omega alpha";
                	   } else {
                	   	$class_content = "col-xs-12 col-sm-7 col-md-12 col-lg-12 omega alpha";
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
                	   	    	<div class="hidden-xs col-sm-5 col-md-5 col-lg-5 omega alpha">
                	   	    	    <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                	   	    	</div>
                	   	    <?php endif ?>
                	   	</div>
                	<?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Parallax Testimonials -->