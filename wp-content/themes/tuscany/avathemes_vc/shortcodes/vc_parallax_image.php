<?php
/**
 *	Parallax Block with Image Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_parallax_img extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'image_bg' => '',
			'image'    => ''
		), $atts));

		$image_url = wp_get_attachment_image_src($image_bg,'full', true);
		$image_src = wp_get_attachment_image_src($image,'full', true);

		ob_start();
		?>

		<!-- Parallax With Image -->
		<div class="ava_themes_block parallax-block image-parallax" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($image_url )) ? 'style="background-image:url('.esc_url($image_url[0]).');"' : ''; ?>>
		    <div class="container">
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
		            <?php if (isset($image_src) && !empty($image_src)): ?>
		            	<img class="img-responsive" src="<?php echo esc_url($image_src[0]); ?>" alt="Parallax Image">
		            <?php endif ?>
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
	"name"		=> __("Parallax With Image", 'js_composer'),
	"description" => __('Parallax block with image.', 'js_composer'),
	"base"		=> "vc_parallax_img",
	"class"		=> "vc_parallax_img_block",
	"icon"		=> "icon-class",
	"controls"	=> "full",
	"category"  => __('AvaThemes', 'js_composer'),
	"params"	=> array(
		array(
			"type" => "attach_image",
			"heading" => __("Background Image", 'js_composer'),
			"param_name" => "image_bg",
			"value" => "",
			"description" => __("Set the parallax image.", "js_composer")
		),
		array(
			"type" => "attach_image",
			"heading" => __("Image", 'js_composer'),
			"param_name" => "image",
			"value" => "",
			"description" => __("Set the image.", "js_composer")
		),
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);