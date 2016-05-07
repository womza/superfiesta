<?php
/**
 * The template for displaying all single galleries.
 *
 * @package Tuscany
 */

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
$gallery_images = get_post_meta($post->ID, '_cmb_gallery_images', true);
$single_type    = get_post_meta($post->ID, '_cmb_single_page_layout', true);
?>

	<!-- Images Gallery -->
	<div class="container top-divide">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
	        <div class="divider"></div>
	        <div class="title-wrapp">
	            <div>
	                <h2><?php the_title(); ?></h2>
	            </div>
	        </div>
	    </div>
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
	        <?php if ($single_type == 'slider'): ?>
	        	<div class="main-images-gallery-wrapp">
	        	    <div class="gallery-big-pappa">
	        	        <?php if (!empty($gallery_images)) {
	        	        	foreach ($gallery_images as $images => $image) {
	        	        		echo '<div>'.wp_get_attachment_image( $images, 'big-sizy', false, array('class' => 'img-responsive') ).'</div>';
	        	        	}
	        	        } ?>
	        	    </div>
	        	    <div class="gallery-thumb-pappa">
	        	        <?php if (!empty($gallery_images)) {
	        	        	foreach ($gallery_images as $images => $image) {
	        	        		echo '<div><span><i class="fa fa-search"></i></span>'.wp_get_attachment_image( $images, 'small-sizy', false, array('class' => 'img-responsive') ).'</div>';
	        	        	}
	        	        } ?>
	        	    </div>
	        	</div>
	        <?php elseif($single_type == 'shadowboxed'): ?>
	        	<div class="latest-news-wrapper gallery-paginated top-divide">
		        	<div class="row">
			        	    <?php if (!empty($gallery_images)) {
			        	    foreach ($gallery_images as $images => $image) {
			        	    	echo '<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 latest-new-holder"><a rel="prettyPhoto[gallery]" href="'.esc_url($image).'">'.wp_get_attachment_image( $images, 'thumbnail' ).'</a></div>';
			        	    }
			        	    } ?>
		        	</div>
	        	</div>
	        <?php else: ?>
	        	<div class="video-gallery-wrapp"><?php the_content(); ?></div>
	        <?php endif ?>
	    </div>
	</div>
	<!-- Images Gallery END -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>