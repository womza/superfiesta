<?php
/**
 *	About Board Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_about_board extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'       => ''
		), $atts));

		global $tuscany_opt;
		if (isset($tuscany_opt['tuscany-big-table-background'])) {
		    $parallax_bg = $tuscany_opt['tuscany-big-table-background']['url'];
		}
		if (isset($tuscany_opt['tuscany-big-table-img'])) {
		    $big_img = $tuscany_opt['tuscany-big-table-img']['url'];
		}
		if (isset($tuscany_opt['tuscany-about-content-img'])) {
		    $content_img = $tuscany_opt['tuscany-about-content-img']['url'];
		    if (!empty($content_img)) {
		        echo "<style>.mat-about > div:nth-child(2):before {background-image: url(".esc_url($content_img).");}</style>";
		    }
		}
		if (isset($tuscany_opt['tuscany-about-content-img-two'])) {
		    $content_img_two = $tuscany_opt['tuscany-about-content-img-two']['url'];
		    if (!empty($content_img_two)) {
		        echo "<style>.mat-about > div:nth-child(2):after {background-image: url(".esc_url($content_img_two).");}</style>";
		    }
		}
		if (isset($tuscany_opt['tuscany-about-quote-img'])) {
		    $quote_img = $tuscany_opt['tuscany-about-quote-img']['id'];
		}
		if (isset($tuscany_opt['tuscany-about-table-content-one'])) {
		    $content_one = $tuscany_opt['tuscany-about-table-content-one'];
		}
		if (isset($tuscany_opt['tuscany-about-table-content-two'])) {
		    $content_two = $tuscany_opt['tuscany-about-table-content-two'];
		}

		ob_start();
		?>

		<!-- About Us -->
		<div class="ava_themes_block about-mat-block" <?php echo (!empty($parallax_bg)) ? 'style="background-image:url('.$parallax_bg.')";' : ''; ?>>
		    <div class="container">
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		            <div class="mat-about">
		                <div class="element-animate" data-animation="zoomInLeft">
		                    <div class="image-cell" <?php echo (!empty($big_img)) ? 'style="background-image:url('.$big_img.')";' : ''; ?>></div>
		                    <div class="additional-border border-white"></div>
		                </div>
		                <div class="element-animate" data-animation="fadeInUp">
		                    <?php if (!empty($content_one)): ?>
		                        <div class="content-about-wrapp">
		                            <?php echo $content_one; ?>
		                        </div>
		                    <?php endif ?>
		                </div>
		                <div class="element-animate" data-animation="zoomInRight">
		                    <div class="additional-border"></div>
		                    <?php if (!empty($quote_img)): ?>
		                        <div class="img-holder">
		                            <div class="additional-border border-white border-rounded"></div>
		                            <?php echo wp_get_attachment_image( $quote_img, 'quote-circle', false, array('class' => 'img-circle') ); ?>
		                        </div>
		                    <?php endif ?>
		                    <?php if (!empty($content_two)): ?>
		                        <?php echo $content_two; ?>
		                    <?php endif ?>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- End About Us -->

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("About Board Section", 'js_composer'),
	"description" => __('Shortcode for embeding about board block.', 'js_composer'),
	"base"		=> "vc_about_board",
	"class"		=> "vc_about_board_block",
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