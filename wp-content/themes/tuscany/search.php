<?php
/**
 * The template for displaying search results pages.
 *
 * @package Tuscany
 */

get_header(); ?>

<!-- Latest News -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
        <div class="divider"></div>
        <div class="title-wrapp">
            <div>
                <h2><?php printf( __( 'Resultados para: %s', 'tuscany' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alpha">
        <div class="latest-news-wrapper top-divide">
        <div class="row">
			
        	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 latest-new-holder">
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
