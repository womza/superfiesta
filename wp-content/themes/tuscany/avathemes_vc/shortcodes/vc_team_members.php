<?php
/**
 *	Team Members Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_team_members extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'       => '',
			'description' => '',
			'image'       => ''
		), $atts));

		ob_start();
		?>

		<!-- Our team -->
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
		<div class="container">
			<?php
			   $args = array( 'post_type' => 'our-team', 'posts_per_page' => -1 );
			   $loop = new WP_Query( $args );
			   if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); global $post;
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

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Team Members", 'js_composer'),
	"description" => __('Insert block with team members.', 'js_composer'),
	"base"		=> "vc_team_members",
	"class"		=> "vc_team_members_block",
	"icon"		=> "icon-class",
	"controls"	=> "full",
	"category"  => __('AvaThemes', 'js_composer'),
	"params"	=> array(
		array(
			"type"        => "textfield",
			"heading"     => __("Title", 'js_composer'),
			"param_name"  => "title",
			"value"       => "",
			"description" => __("Add title for your block", 'js_composer')
		),
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);