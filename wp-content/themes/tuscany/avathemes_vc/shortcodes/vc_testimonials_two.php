<?php
/**
 *	Testimonials V2 Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_testimonials_two extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title' => '',
			'image' => ''
		), $atts));

		global $tuscany_opt;

		$image_url = wp_get_attachment_image_src($image,'full', true);

		ob_start();
		?>

		<!-- Parallax With Image -->
		<div class="ava_themes_block parallax-block clients-testimonials top-divide" data-stellar-background-ratio="0.5" data-stellar-horizontal-offset="50" <?php echo (!empty($image_url)) ? 'style="background-image: url('.esc_url($image_url[0]).');"' : ''; ?>>
		    <div class="container">
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		            <div class="clients-speaks-slider">
		                <div>
		                    <?php
		                       $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );
		                       $loop = new WP_Query( $args );
		                       $counter = 1;
		                       if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		                       global $post;
		                       $slider_img = get_post_meta($post->ID, '_cmb_testimonial_slider_img', true);
		                       ?>
		                       <?php if ($counter % 4 == 0) {
		                           echo "</div><div>";
		                       } ?>
		                        <div class="testimonial-slide">
		                            <div>
		                                <div class="testi-text">
		                                    <h4><?php the_title(); ?></h4>
		                                    <?php the_content(); ?>
		                                    <?php if($post->post_excerpt): ?>
		                                    <span>- <?php echo $post->post_excerpt; ?></span>
		                                    <?php endif; ?>
		                                </div>
		                                <?php if (isset($slider_img) && !empty($slider_img)): ?>
		                                    <img src="<?php echo esc_url($slider_img); ?>" alt="Testimonial Image">
		                                <?php else: ?>
		                                    <div style="min-height: 495px; width: 100%;"></div>
		                                <?php endif ?>
		                            </div>
		                        </div>
		                    <?php $counter++; endwhile; endif; ?>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- Parallax With Image -->

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Testimonials V2", 'js_composer'),
	"description" => __('Testimonials V2 block.', 'js_composer'),
	"base"		=> "vc_testimonials_two",
	"class"		=> "vc_testimonials_two_block",
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