<?php global $tuscany_opt;
	$block_title = $tuscany_opt['tuscany-team-title'];
?>

<!-- Our team -->
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
</div>
<div class="container">
	<?php
	   $args = array( 'post_type' => 'our-team', 'posts_per_page' => -1 );
	   $loop = new WP_Query( $args );
	   if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
	   global $post;
	   $social_icons = get_post_meta($post->ID, '_cmb_social', true);
	   $png_image = get_post_meta($post->ID, '_cmb_png_image', true);
	   ?>
	   	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center circled-member element-animate" data-animation="zoomIn">
	   	    <?php if (has_post_thumbnail()): ?>
	   	    	<?php the_post_thumbnail('global', array('class' => 'img-thumbnail')); ?>
	   	    <?php elseif (!empty($png_image) && isset($png_image)): ?>
				<div>
				    <img src="<?php echo esc_url($png_image); ?>" alt="Member Image">
				</div>
	   	    <?php else: ?><?php endif ?>
	   	    <h4><?php the_title(); ?></h4>
	   	    <?php if($post->post_excerpt): ?>
	   	    <span><?php echo $post->post_excerpt; ?></span>
	   	    <?php endif; ?>
	   	    <?php the_content(); ?>
	   	    <?php if (!empty($social_icons)): ?>
	   	    	<ul>
	   	    	    <?php foreach ($social_icons as $icon): ?>
	   	    	    	<li><a href="<?php echo esc_url($icon['icon_url']); ?>" target="_blank" class="fa <?php echo esc_attr($icon['icon_class']); ?>" title="<?php echo esc_attr($icon['icon_title']); ?>"></a></li>
	   	    	    <?php endforeach ?>
	   	    	</ul>
	   	    <?php endif ?>
	   	</div>
	<?php endwhile; endif; ?>
</div>
<!-- End Our team -->