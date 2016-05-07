<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Tuscany
 */

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<!-- Single Wrapper -->
	<div class="single-wrapper">
	    <div class="container">
	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
	                <?php the_content(); ?>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- End Single Wrapper -->
<?php endwhile; endif; ?>

<?php get_footer(); ?>
