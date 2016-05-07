<?php global $tuscany_opt;
$block_title = $tuscany_opt['tuscany-latest-news'];
?>

<!-- Latest News -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
        <div class="divider"></div>
        <?php if (!empty($block_title)): ?>
            <div class="title-wrapp">
                <div>
                    <h2><?php echo $block_title; ?></h2>
                </div>
            </div>
        <?php endif ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="latest-news-slider-wrapper">
            <div class="additional-border border-white"></div>
            <div class="latest-slider">
            	<?php
            	   $args = array( 'post_type' => 'post', 'posts_per_page' => 10 );
            	   $loop = new WP_Query( $args );
            	   if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
            	   	<div>
            	   	    <div class="new-holder">
            	   	        <div>
            	   	            <div class="additional-border"></div>
            	   	            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            	   	            <?php the_excerpt(); ?>
            	   	            <span class="date-holder"><?php the_time('d.m.Y'); ?></span>
            	   	            <a href="<?php the_permalink(); ?>" class="read-new">
            	   	            	<?php _e('Read More', THEME_NAME); ?>
            	   	            </a>
            	   	            <img src="<?php echo get_template_directory_uri(); ?>/img/new-dish.png" height="143" width="248" alt="Featured Image">
            	   	        </div>
            	   	    </div>
            	   	</div>
            	<?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- End Latest News -->