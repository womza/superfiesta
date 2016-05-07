<?php
/**
 *	Opening Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_opening extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'  => '',
			'layout' => 'type_one'
		), $atts));
		global $tuscany_opt;
		$circle_word  = $tuscany_opt['tuscany-schedule-word'];
		$working_days = $tuscany_opt['tuscany-working-days'];
		$weekends     = $tuscany_opt['tuscany-weekends'];
		$quote        = $tuscany_opt['tuscany-quote-schedule'];

		ob_start();
		?>

		<?php switch ($layout) {
			case 'type_one': ?>
			<!-- Schedule -->
			<div class="container top-divide">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
			        <div class="schedule-wrapp element-animate" data-animation="fadeInUp">
			            <?php if (!empty($circle_word)): ?>
			            	<div class="hidden-xs">
			            	    <div class="schedule-date">
			            	        <div><?php echo $circle_word; ?></div>
			            	    </div>
			            	</div>
			            <?php endif ?>
			            <?php if (!empty($working_days) && !empty($weekends) && !empty($quote)): ?>
			            	<div>
			            	    <div class="schedule-time clearfix">
			            	        <div class="time-wrapp clearfix">
			            	            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			            	                <p><?php echo $working_days; ?></p>
			            	            </div>
			            	            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			            	                <p><?php echo $weekends; ?></p>
			            	            </div>
			            	        </div>
			            	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			            	            <blockquote>
			            	                <?php echo $quote; ?>
			            	            </blockquote>
			            	        </div>
			            	    </div>
			            	</div>
			            <?php endif ?>
			        </div>
			    </div>
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
			</div>
			<!-- End Schedule -->
			<?php break;

			case 'type_two': ?>
			<!-- Working Schedule -->
			<div class="container top-divide">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        <div class="schedule-holder text-center">
			            <?php if (isset($tuscany_opt['tuscany-schedule-images'])) {
			                $gallery = explode(',', $tuscany_opt['tuscany-schedule-images']);
			                foreach ($gallery as $images => $image) {
			                    $image_url = wp_get_attachment_image_src($image, 'full');
			                    echo '<span>'.wp_get_attachment_image( $image, 'full' ).'</span>';
			                }
			            } ?>
			            <?php if (!empty($working_days) && !empty($weekends) && !empty($quote)): ?>
			            	<div>
			            	    <div>
			            	        <h3><?php echo $working_days; ?></h3>
			            	        <h3><?php echo $weekends; ?></h3>
			            	    </div>
			            	    <p><?php echo $quote; ?></p>
			            	</div>
			            <?php endif ?>
			        </div>
			    </div>
			</div>
			<!-- End Working Schedule -->
			<?php break;

			default: ?>
			<!-- Schedule -->
			<div class="container top-divide">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
			        <div class="schedule-wrapp element-animate" data-animation="fadeInUp">
			            <?php if (!empty($circle_word)): ?>
			            	<div class="hidden-xs">
			            	    <div class="schedule-date">
			            	        <div><?php echo $circle_word; ?></div>
			            	    </div>
			            	</div>
			            <?php endif ?>
			            <?php if (!empty($working_days) && !empty($weekends) && !empty($quote)): ?>
			            	<div>
			            	    <div class="schedule-time clearfix">
			            	        <div class="time-wrapp clearfix">
			            	            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			            	                <p><?php echo $working_days; ?></p>
			            	            </div>
			            	            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			            	                <p><?php echo $weekends; ?></p>
			            	            </div>
			            	        </div>
			            	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			            	            <blockquote>
			            	                <?php echo $quote; ?>
			            	            </blockquote>
			            	        </div>
			            	    </div>
			            	</div>
			            <?php endif ?>
			        </div>
			    </div>
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
			</div>
			<!-- End Schedule -->
			<?php break;
		} ?>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Schedule Block", 'js_composer'),
	"description" => __('Schedule Block.', 'js_composer'),
	"base"		=> "vc_opening",
	"class"		=> "vc_opening_block",
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