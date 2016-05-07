<?php
/**
 *	Gallery Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_testimonials_one extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title' => '',
			'image' => ''
		), $atts));

		global $tuscany_opt;
		if (isset($tuscany_opt['tuscany-switch-image']) && !$tuscany_opt['tuscany-switch-image']) {
		    echo "<style>.testimonials-wrapp > div {vertical-align:middle;}</style>";
		}

		$image_url = wp_get_attachment_image_src($image,'full', true);

		ob_start();
		?>

		<!-- Parallax Testimonials -->
		<div class="ava_themes_block parallax-block parallax-testimonials top-divide" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($image_url)) ? 'style="background-image: url('.esc_url($image_url[0]).');"' : ''; ?>>
		    <div class="container">
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		            <div class="testimonials-wrapp">
		                <div class="nav-arrows">
		                    <a href="" data-dir="up" class="fa fa-chevron-up"></a>
		                    <a href="" data-dir="down" class="fa fa-chevron-down"></a>
		                </div>
		                <div class="testimonial-content">
		                	<?php
		                	   $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );
		                	   $loop = new WP_Query( $args );
		                	   if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		                	   global $post;
		                	   if (has_post_thumbnail()) {
		                	   	$class_content = "col-xs-12 col-sm-7 col-md-7 col-lg-7 omega alpha";
		                	   } else {
		                	   	$class_content = "col-xs-12 col-sm-7 col-md-12 col-lg-12 omega alpha";
		                	   }
		                	   ?>
		                	   	<div>
		                	   	    <div class="<?php echo $class_content; ?>">
		                	   	        <h4><?php the_title(); ?></h4>
		                	   	        <?php the_content(); ?>
		                	   	        <?php if($post->post_excerpt): ?>
		                	   	        <span>- <?php echo $post->post_excerpt; ?></span>
		                	   	        <?php endif; ?>
		                	   	    </div>
		                	   	    <?php if (has_post_thumbnail() && $tuscany_opt['tuscany-switch-image']): ?>
		                	   	    	<div class="hidden-xs col-sm-5 col-md-5 col-lg-5 omega alpha">
		                	   	    	    <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
		                	   	    	</div>
		                	   	    <?php endif ?>
		                	   	</div>
		                	<?php endwhile; endif; ?>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- End Parallax Testimonials -->

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Testimonials V1", 'js_composer'),
	"description" => __('Testimonials V1 block.', 'js_composer'),
	"base"		=> "vc_testimonials_one",
	"class"		=> "vc_testimonials_one_block",
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
		array(
			"type" => "attach_image",
			"heading" => __("Background Image", 'js_composer'),
			"param_name" => "image",
			"value" => "",
			"description" => __("Set the parallax image.", "js_composer")
		),
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);