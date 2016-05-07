<?php
/**
 * The template for displaying all single posts.
 *
 * @package Tuscany
 */

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<!-- Single Wrapper -->
	<div class="single-wrapper">
	    <div class="container">
	        <div class="hidden-xs col-sm-4 col-md-3 col-lg-3">
	            <div class="sidebar-holder">
	                <?php dynamic_sidebar( 'sidebar-1' ); ?>
	            </div>
	        </div>
	        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
	            <div class="row post-info-top">
	                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	                    <h1 class="post-title"><?php the_title(); ?></h1>
	                </div>
	                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-right">
	                    <div class="author-post">
	                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 85 ); ?>
	                        <span><i class="fa fa-clock-o"></i> <?php the_time('d.m.Y'); ?></span>
	                        <div><?php echo get_the_author(); ?></div>
	                    </div>
	                </div>
	            </div>
	            <hr>
	            <div class="post-content-section">
	                <?php if (has_post_thumbnail()) {
	                	the_post_thumbnail('full', array('class' => 'img-responsive'));
	                } ?>
	                <?php if (is_singular('post')): ?>
	                	<div class="post-meta">
	                	    <div>
	                	        <?php echo get_the_term_list( $post->ID, 'category', 'Categories: ', ', ', '' ); ?>
	                	    </div>
	                	    <div>
	                	        <?php the_tags(); ?>
	                	    </div>
	                	</div>
	                <?php endif ?>
	                <?php the_content(); ?>
	                <?php wp_link_pages(); ?>
	            </div>

	            <?php if (is_singular('post')): ?>
	            	            <div class="related-post additional-block clearfix">
	            	                <h4><?php _e('Related Posts', THEME_NAME); ?></h4>
	            	                <hr>
	            	                <div class="latest-news-wrapper clearfix">
	            	                    <?php
	            	                    $orig_post = $post;
	            	                    global $post;
	            	                    $tags = wp_get_post_tags($post->ID);
	            	                    if ($tags) {

	            	                        $tag_ids = array();
	            	                        foreach($tags as $individual_tag) { $tag_ids[] = $individual_tag->term_id; }

	            	                    } else { $tag_ids = "";}
	            	                    $args = array(
	            							'tag__in'             => $tag_ids,
	            							'post__not_in'        => array($post->ID),
	            							'posts_per_page'      => 3, // Number of related posts to display.
	            							'ignore_sticky_posts' => 1
	            	                    );
	            	                    $wp_query = new WP_Query( $args );
	            	                    if ($wp_query->have_posts() ): while($wp_query->have_posts() ): $wp_query->the_post() ?>

	            	                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 latest-new-holder">
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
	            	                    <p><?php _e('No related posts!', THEME_NAME); ?></p>
	            	                <?php endif;
	            	                $post = $orig_post;
	            	                wp_reset_query();
	            	                ?>
	            	                </div>
	            	            </div>
	            	            <div class="comments-container additional-block clearfix">
	            	                <h4>Comments</h4>
	            	                <hr>
	            	                <?php comments_template(); ?>
	            	            </div>
	            <?php endif ?>
	        </div>
	        <div class="col-xs-12 visible-xs">
	            <div class="sidebar-holder">
	               	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- End Single Wrapper -->
	<?php endwhile; endif; ?>

<?php get_footer(); ?>