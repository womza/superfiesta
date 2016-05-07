<?php global $tuscany_opt;
	$title    = $tuscany_opt['tuscany-dishes-title'];
	$subtitle = $tuscany_opt['tuscany-dishes-subtitle'];
?>

<?php if (class_exists('woocommerce')): ?>
	<!-- Best Meals Section -->
	<div class="container top-divide">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
	        <div class="divider"></div>
	        <?php if (!empty($title)): ?>
	        	<div class="title-wrapp">
	        	    <div>
	        	        <h2><?php echo $title; ?></h2>
	        	    </div>
	        	</div>
	        <?php endif ?>
	    </div>
	</div>
	<div class="container best-meals">
	    <?php
	       $args = array( 'post_type' => 'product', 'posts_per_page' => 3 );
	       $loop = new WP_Query( $args );
	       if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
	       	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
	       	    <?php if (!empty($subtitle)): ?>
	       	    	<h2><?php echo str_replace('&', '&amp;', $subtitle); ?></h2>
	       	    <?php endif ?>
	       	    <?php if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'png-product')): ?>
	       	    	<div class="product-circle">
	       	    	    <?php
	       	    	    MultiPostThumbnails::the_post_thumbnail(
	       	    	            get_post_type(),
	       	    	            'png-product'
	       	    	        );
	       	    	    ?>
	       	    	</div>
	       	    <?php else: ?>
	       	    	<?php if (has_post_thumbnail()): ?>
	       	    		<?php the_post_thumbnail('global', array('class' => 'img-thumbnail')); ?>
	       	    	<?php endif ?>
	       	    <?php endif ?>

	       	    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	       	    <?php the_excerpt(); ?>
	       	</div>
	    <?php endwhile; endif; ?>
	</div>
	<!-- End Best Meals Section -->
<?php endif ?>