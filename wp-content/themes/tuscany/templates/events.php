<?php
/*
Template Name: 06 Events
*/

get_header(); ?>

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
        <div class="latest-news-wrapper gallery-slider top-divide">
            <?php
               $args = array( 'post_type' => 'our-events', 'posts_per_page' => -1 );
               $loop = new WP_Query( $args );
               if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
               $date = get_post_meta($post->ID, '_cmb_event_date', true);
               ?>
               	<div>
               	    <?php if (has_post_thumbnail()) { ?>
               	        <a href="<?php the_permalink(); ?>">
               	            <?php the_post_thumbnail('slider-img', array('class' => 'img-responsive')); ?>
               	        </a>
               	    <?php } else {
               	        echo '<img class="img-responsive" src="https://api.fnkr.net/testimg/500x300/150d05/FFF/?text=img+placeholder" alt="image">';
               	    } ?>
               	    <div class="new-holder">
               	        <div class="news-content">
               	            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <?php the_excerpt(); ?>
               	        </div>
               	        <div class="author-holder">
               	            <?php if (!empty($date)): ?>
               	            	<div class="event-date">
               	            	    <div></div>
               	            	    <?php echo $date; ?>
               	            	</div>
               	            <?php endif ?>
               	        </div>
               	    </div>
               	</div>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>
<!-- End Latest News -->

<?php get_footer(); ?>