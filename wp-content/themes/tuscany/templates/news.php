<?php
/*
Template Name: 07 News
*/

get_header(); global $tuscany_opt; ?>

<!-- Latest News -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
        <div class="divider"></div>
        <div class="title-wrapp">
            <div>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                	<h2><?php the_title(); ?></h2>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alpha">
        <div class="latest-news-wrapper top-divide">
        <div class="row">

        	<?php
        	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
        	$args = array( 'post_type' => 'post', 'paged' => $paged );
        	$wp_query = new WP_Query( $args );
        	if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
        		<div <?php post_class('col-xs-12 col-sm-4 col-md-3 col-lg-3 latest-new-holder match-me'); ?>>
        		    <?php if (has_post_thumbnail()) { ?>
        		    	<a href="<?php the_permalink(); ?>">
        		    		<?php the_post_thumbnail('slider-img', array('class' => 'img-responsive')); ?>
        		    	</a>
        		    <?php } ?>
        		    <div class="new-holder">
        		        <div class="news-content">
        		            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        		            <?php the_excerpt(); ?>
        		            <span class="date-holder"><?php the_time('d.m.Y'); ?></span>
        		        </div>
        		        <div class="author-holder">
        		            <?php echo get_avatar( get_the_author_meta( 'ID' ), 85 ); ?>
        		        </div>
        		    </div>
        		</div>
        	<?php endwhile; else: ?>
        		<p><?php _e('You dont have any posts yet.', THEME_NAME); ?></p>
        	<?php endif; ?>

            <?php tuscany_pagination(); ?>
        </div>
        </div>
    </div>
</div>
<!-- End Latest News -->

<?php get_footer(); ?>