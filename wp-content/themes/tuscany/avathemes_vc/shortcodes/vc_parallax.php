<?php
/**
 *	Parallax Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_parallax extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'       => '',
			'description' => '',
			'image'       => ''
		), $atts));

		$image_url = wp_get_attachment_image_src($image,'full', true);

		ob_start();
		?>

		<!-- Parallax With Image -->
		<div class="ava_themes_block parallax-block image-parallax" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($image_url )) ? 'style="background-image:url('.esc_url($image_url[0]).');"' : ''; ?>>
		    <div class="container">
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
		            <?php if (!empty($title)): ?>
		                <?php echo "<h3>".$title."</h3>"; ?>
		            <?php endif ?>
		            <?php if (!empty($description)): ?>
		                <?php echo "<p>".$description."</p>"; ?>
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
	"name"		=> __("Parallax", 'js_composer'),
	"description" => __('Parallax block with title, description and image.', 'js_composer'),
	"base"		=> "vc_parallax",
	"class"		=> "vc_parallax_block",
	"icon"		=> "icon-class",
	"controls"	=> "full",
	"category"  => __('AvaThemes', 'js_composer'),
	"params"	=> array(
		array(
			"type"        => "textfield",
			"heading"     => __("Title", 'js_composer'),
			"param_name"  => "title",
			"value"       => "",
			"description" => __("Add title for your parallax", 'js_composer')
		),
		array(
			"type"        => "textarea",
			"heading"     => __("Description", 'js_composer'),
			"param_name"  => "description",
			"value"       => "",
			"description" => __("Add description for your parallax", 'js_composer')
		),
		array(
			"type" => "attach_image",
			"heading" => __("Image", 'js_composer'),
			"param_name" => "image",
			"value" => "",
			"description" => __("Set the parallax image.", "js_composer")
		),
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);