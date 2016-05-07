<?php
/**
 *	Gallery Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_galleries extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'  => '',
			'images' => '',
			'type'   => 'type_one'
		), $atts));

		global $tuscany_opt;
		if (isset($tuscany_opt['tuscany-gallery-bg'])) {
		    $bg_image = $tuscany_opt['tuscany-gallery-bg']['url'];
		}

		$imagesArray = explode(',', $images);

		ob_start();
		?>

		<?php if ($type == 'type_one'): ?>
			<div class="container top-divide">
			    <?php if (!empty($title)): ?>
			    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title">
			    	    <div class="divider"></div>
			    	    <div class="title-wrapp">
			    	        <div>
			    	            <h2><?php echo $title; ?></h2>
			    	        </div>
			    	    </div>
			    	</div>
			    <?php endif ?>
			</div>
			<div class="gallery-bg clearfix top-divide" <?php echo !empty($bg_image) ? 'style="background-image:url('.esc_url($bg_image).');"' : ''; ?>>
			    <div class="container">
			        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alpha">
			            <div class="gallery-wrapper clearfix">
			                <?php foreach ($imagesArray as $img) {
			                    $img_url = wp_get_attachment_image_src($img, 'full');
			                    echo '<a href="'.esc_url($img_url[0]).'" rel="prettyPhoto[gallery]">
			                            '.wp_get_attachment_image( $img, 'medium-thumb' ).'
			                            <span><i class="fa fa-search"></i></span>
			                        </a>';
			                } ?>
			            </div>
			        </div>
			    </div>
			</div>
		<?php else: ?>
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
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        <div class="our-gallery-slider top-divide">
			            <div class="gallery-wrapp clearfix">
			            <?php if (isset($tuscany_opt['tuscany-gallery-images'])) {
			                $counter = 0;
			                foreach ($imagesArray as $images => $image) {
			                    $image_url = wp_get_attachment_image_src($image, 'full');

			                    if ($counter == 8) {
			                        echo '</div><div class="gallery-wrapp clearfix">';
			                        $counter = 0;
			                    }

			                    echo '<a href="'.esc_url($image_url[0]).'" rel="prettyPhoto[gallery]">
			                            '.wp_get_attachment_image( $image, 'slider-img' ).'
			                            <span><i class="fa fa-search"></i></span>
			                        </a>';

			                $counter++; }
			            } ?>
			            </div>
			        </div>
			    </div>
			</div>
		<?php endif ?>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Gallery", 'js_composer'),
	"description" => __('Image Gallery block.', 'js_composer'),
	"base"		=> "vc_galleries",
	"class"		=> "vc_galleries_block",
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
			"type" => "attach_images",
			"heading" => __("Images", 'js_composer'),
			"param_name" => "images",
			"value" => "",
			"description" => __("Select images for you gallery.", "js_composer")
		),
		array(
			'type'                          => 'dropdown',
			'heading'                       => __( 'Gallery Type', 'js_composer' ),
			'param_name'                    => 'type',
			'description'                   => __( 'Choose your type', 'js_composer' ),
			'value'                         => array(
				__( 'Images Grid', 'js_composer' ) => 'type_one',
				__( 'Images Slider', 'js_composer' ) => 'type_two'
			),
			'std'                           => 'type_one'
		)
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);