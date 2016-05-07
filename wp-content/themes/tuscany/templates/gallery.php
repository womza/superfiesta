<?php
/*
Template Name: 08 Gallery
*/

get_header(); ?>

<!-- Latest News -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
        <div class="divider"></div>
        <div class="title-wrapp">
            <div>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                $layout_type          = get_post_meta($post->ID, '_cmb_gallery_layout_type', true);
                ?>
                	<h2><?php the_title(); ?></h2>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alpha">
        <?php if ($layout_type == 'slider'): ?>
            <div class="latest-news-wrapper gallery-slider top-divide">
                <?php
                   $args = array( 'post_type' => 'our-gallery', 'posts_per_page' => -1 );
                   $loop = new WP_Query( $args );
                   if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                   ?>
                    <div>
                        <?php if (has_post_thumbnail()) { ?>
                          <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('slider-img', array('class' => 'img-responsive')); ?>
                          </a>
                        <?php } ?>
                        <div class="new-holder">
                            <div class="news-content">
                                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                <span class="date-holder"><?php the_time('d.m.Y'); ?></span>
                            </div>
                            <div class="author-holder">
                                <a href="<?php the_permalink(); ?>"><?php _e('View Gallery', THEME_NAME); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            </div>
        <?php else: ?>
            <div class="latest-news-wrapper gallery-paginated top-divide">
            <div class="row">
                <?php
                   $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                   $temp = $wp_query;
                     $wp_query = null;
                     $wp_query = new WP_Query();
                     $wp_query->query('showposts=8&post_type=our-gallery'.'&paged='.$paged);

                     while ($wp_query->have_posts()) : $wp_query->the_post();
                   ?>
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 latest-new-holder">
                        <?php if (has_post_thumbnail()) { ?>
                          <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('slider-img', array('class' => 'img-responsive')); ?>
                          </a>
                        <?php } ?>
                        <div class="new-holder">
                            <div class="news-content">
                                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                <span class="date-holder"><?php the_time('d.m.Y'); ?></span>
                            </div>
                            <div class="author-holder">
                                <a href="<?php the_permalink(); ?>"><?php _e('View Gallery', THEME_NAME); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="clearfix">
                    <div class="paginated-arrows-gallery text-center">
                        <?php previous_posts_link('Newer') ?>
                        <?php next_posts_link('Older') ?>
                    </div>
                </div>
            </div>
            </div>
            </div>
        <?php endif ?>
    </div>
</div>
<!-- End Latest News -->

<?php get_footer(); ?>