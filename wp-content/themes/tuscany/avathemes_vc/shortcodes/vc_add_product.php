<?php
/**
 *	Advertising Product Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_add_product extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'       => ''
		), $atts));

		global $tuscany_opt;
		$price          = $tuscany_opt['tuscany-add-price'];
		$description    = $tuscany_opt['tuscany-add-description'];
		$product_img    = $tuscany_opt['tuscany-add-img']['url'];
		$additional_img = $tuscany_opt['tuscany-add-additional']['url'];

		ob_start();
		?>
		
		<!-- Addvertisement Item -->
		<div class="container top-divide">
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		        <div class="add-banner">
		            <div class="additional-border"></div>
		            <?php if (!empty($additional_img)): ?>
		            	<div class="text-add cell-section hidden-xs hidden-sm element-animate" data-animation="zoomInLeft" <?php echo 'style="background-image: url('.esc_url($additional_img).');"' ?>></div>
		            <?php endif ?>
		            <?php if (!empty($product_img)): ?>
		            	<div class="image-add cell-section text-center element-animate" data-animation="flipInX">
		            	    <img src="<?php echo esc_url($product_img); ?>"  alt="Add Image">
		            	</div>
		            <?php endif ?>
		            <div class="add-content cell-section element-animate" data-animation="zoomInRight">
		                <?php if (!empty($price)): ?>
		                	<div class="hidden-xs col-sm-4 col-md-4 col-lg-4 omega alpha">
		                	    <div class="pricing-tag">
		                	        <div class="border-rounded additional-border border-white"></div>
		                	        <?php echo $price; ?>
		                	    </div>
		                	</div>
		                <?php endif ?>
		                <?php if (!empty($description)): ?>
		                	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 omega alpha">
		                	    <div>
		                	        <p><?php echo $description; ?></p>
		                	    </div>
		                	</div>
		                <?php endif ?>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- End Addvertisement Item -->

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Advertising Product Block", 'js_composer'),
	"description" => __('Add advertising block.', 'js_composer'),
	"base"		=> "vc_add_product",
	"class"		=> "vc_add_product_block",
	"icon"		=> "icon-class",
	"controls"	=> "full",
	"category"  => __('AvaThemes', 'js_composer'),
	"params"	=> array(
		array(
			"type"        => "textfield",
			"heading"     => __("Title", 'js_composer'),
			"param_name"  => "title",
			"value"       => "",
			"description" => __("Add title for your history block", 'js_composer')
		)
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);