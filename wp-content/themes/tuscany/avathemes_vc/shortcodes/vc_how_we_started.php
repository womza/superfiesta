<?php
/**
 *	How We Started Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_how_we_started extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'  => '',
			'layout' => 'type_one'
		), $atts));

		global $tuscany_opt;

		ob_start();
		?>

		<?php switch ($layout) {
			case 'type_one': 
			$content = $tuscany_opt['tuscany-started-content'];
			if (isset($tuscany_opt['tuscany-corner-image'])) {
			    $corner_image = $tuscany_opt['tuscany-corner-image']['url'];
			}
			if (isset($tuscany_opt['tuscany-started-bg'])) {
			    $parallax_img = $tuscany_opt['tuscany-started-bg']['url'];
			}
			?>
			<!-- About Tisue -->
			<div class="ava_themes_block parallax-block parallax-started" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($parallax_img)) ? 'style="background-image: url('.esc_url($parallax_img).');"' : ''; ?>>
			    <div class="container">
			    <div class="starting-point">
			        <div class="hidden-sm hidden-xs col-md-7 col-lg-6 animation-text-div">
			            <?php if (isset($tuscany_opt['tuscany-started-images'])) {
			                $gallery = explode(',', $tuscany_opt['tuscany-started-images']);
			                foreach ($gallery as $images => $image) {
			                    $image_url = wp_get_attachment_image_src($image, 'full');
			                    echo wp_get_attachment_image( $image, 'full' );
			                }
			            } ?>
			        </div>
			        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
			            <div class="papper-tisue">
			                <div class="tus-scroll">
			                    <?php if (!empty($corner_image)): ?>
			                        <img class="hidden-md hidden-xs" src="<?php echo esc_url($corner_image); ?>" alt="Corner Image">
			                    <?php endif ?>
			                    <?php if (!empty($content)): ?>
			                        <?php echo $content; ?>
			                    <?php endif ?>
			                </div>
			            </div>
			        </div>
			    </div>
			    </div>
			</div>
			<!-- End About Tisue -->
			<?php break;

			case 'type_two':
			if (empty($tuscany_opt['tuscany-started-images-two'])) {
			    echo "<style>.adittional-tissue-text > div {vertical-align: middle;}</style>";
			}
			$content = $tuscany_opt['tuscany-started-content'];
			$content_two = $tuscany_opt['tuscany-started-content-two'];
			if (isset($tuscany_opt['tuscany-corner-image'])) {
			    $corner_image = $tuscany_opt['tuscany-corner-image']['url'];
			}
			if (isset($tuscany_opt['tuscany-started-bg'])) {
			    $parallax_img = $tuscany_opt['tuscany-started-bg']['url'];
			}
			?>
			<!-- About Tisue -->
			<div class="ava_themes_block parallax-block parallax-started top-divide" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($parallax_img)) ? 'style="background-image: url('.esc_url($parallax_img).');"' : ''; ?>>
			    <div class="container">
			    <div class="starting-point clearfix">
			        <div class="hidden-xs col-sm-6 col-md-6 col-lg-6">
			            <div class="adittional-tissue-text">
			                <?php if (isset($tuscany_opt['tuscany-started-images-two'])) {
			                    $gallery = explode(',', $tuscany_opt['tuscany-started-images-two']);
			                    foreach ($gallery as $images => $image) {
			                        $image_url = wp_get_attachment_image_src($image, 'full');
			                        echo wp_get_attachment_image( $image, 'full' );
			                    }
			                } ?>
			                <?php if (!empty($content_two)): ?>
			                    <div class="text-center">
			                        <?php echo $content_two; ?>
			                    </div>
			                <?php endif ?>
			            </div>
			        </div>
			        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
			            <div class="papper-tisue">
			                <div class="tus-scroll">
			                    <?php if (!empty($corner_image)): ?>
			                        <img class="hidden-md hidden-xs" src="<?php echo esc_url($corner_image); ?>" alt="Corner Image">
			                    <?php endif ?>
			                    <?php if (!empty($content)): ?>
			                        <?php echo $content; ?>
			                    <?php endif ?>
			                </div>
			            </div>
			        </div>
			    </div>
			    </div>
			</div>
			<!-- End About Tisue -->
			<?php break;

			default: 
			$content = $tuscany_opt['tuscany-started-content'];
			if (isset($tuscany_opt['tuscany-corner-image'])) {
			    $corner_image = $tuscany_opt['tuscany-corner-image']['url'];
			}
			if (isset($tuscany_opt['tuscany-started-bg'])) {
			    $parallax_img = $tuscany_opt['tuscany-started-bg']['url'];
			}
			?>
			<!-- About Tisue -->
			<div class="ava_themes_block parallax-block parallax-started" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($parallax_img)) ? 'style="background-image: url('.esc_url($parallax_img).');"' : ''; ?>>
			    <div class="container">
			    <div class="starting-point">
			        <div class="hidden-sm hidden-xs col-md-7 col-lg-6 animation-text-div">
			            <?php if (isset($tuscany_opt['tuscany-started-images'])) {
			                $gallery = explode(',', $tuscany_opt['tuscany-started-images']);
			                foreach ($gallery as $images => $image) {
			                    $image_url = wp_get_attachment_image_src($image, 'full');
			                    echo wp_get_attachment_image( $image, 'full' );
			                }
			            } ?>
			        </div>
			        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
			            <div class="papper-tisue">
			                <div class="tus-scroll">
			                    <?php if (!empty($corner_image)): ?>
			                        <img class="hidden-md hidden-xs" src="<?php echo esc_url($corner_image); ?>" alt="Corner Image">
			                    <?php endif ?>
			                    <?php if (!empty($content)): ?>
			                        <?php echo $content; ?>
			                    <?php endif ?>
			                </div>
			            </div>
			        </div>
			    </div>
			    </div>
			</div>
			<!-- End About Tisue -->
			<?php break;
		} ?>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("How we started section", 'js_composer'),
	"description" => __('Block section with blackboard, description and images about your job!.', 'js_composer'),
	"base"		=> "vc_how_we_started",
	"class"		=> "vc_how_we_started_block",
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
			'type'                          => 'dropdown',
			'heading'                       => __( 'Layout Type', 'js_composer' ),
			'param_name'                    => 'layout',
			'description'                   => __( 'Choose your type', 'js_composer' ),
			'value'                         => array(
				__( 'Layout One', 'js_composer' ) => 'type_one',
				__( 'Layout Two', 'js_composer' ) => 'type_two'
			),
			'std'                           => 'type_one'
		 )
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);