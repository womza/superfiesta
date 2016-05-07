<?php
/**
 *	Counter Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_counter extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'       => ''
		), $atts));

		global $tuscany_opt;
		if (isset($tuscany_opt['tuscany-counter'])) {
			$counters  = $tuscany_opt['tuscany-counter'];
		}

		ob_start();
		?>

		<?php if (!empty($counters[0]['title'])): ?>
			<!-- Tuscany Counter -->
			<div class="tuscany-counter">
			    <div class="container">
			        <?php foreach ($counters as $counter): ?>
			        	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center element-animate" data-animation="flipInX">
			        	    <div class="counter-img" data-counter="<?php echo esc_attr($counter['description']); ?>">
			        	        <div style="color:<?php echo esc_attr($counter['url']); ?>;">
			        	            <img class="hidden-xs" src="<?php echo esc_url($counter['image']); ?>"  alt="Counter Image">
			        	        </div>
			        	    </div>
			        	    <h4><?php echo $counter['title']; ?></h4>
			        	</div>
			        <?php endforeach ?>
			    </div>
			</div>
			<!-- End Counter -->
		<?php endif ?>

		<script type="text/javascript">
		    (function($) {
		        $(document).ready(function() {
		            var selectors = $('.counter-img'),
		                members = $.makeArray(selectors);
		            $.each(members, function(index, val) {
		                var countNumber = $(val).data('counter').toString(),
		                    counterLenght = countNumber.length;
		                switch(counterLenght) {
		                    case 1:
		                    $(this).children().addClass('one-num');
		                    $(this).children().prepend('<span>'+countNumber+'</span>');
		                    break;

		                    case 2:
		                    $(this).children().addClass('two-num');
		                    $(this).children().prepend('<span>'+countNumber[1]+'</span>');
		                    $(this).children().prepend('<span>'+countNumber[0]+'</span>');
		                    break;

		                    case 3:
		                    $(this).children().addClass('three-num');
		                    $(this).children().prepend('<span>'+countNumber[0]+'</span>');
		                    $(this).children().prepend('<span>'+countNumber[1] + countNumber[2]+'</span>');
		                    break;
		                }
		            });
		        });
		        
		        if (Modernizr.touch) {
		            $('.tuscany-counter .col-lg-4.text-center').removeClass('element-animate');
		        }

		    })(jQuery);
		</script>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Counter Block", 'js_composer'),
	"description" => __('Insert block with the counter and images.', 'js_composer'),
	"base"		=> "counter",
	"class"		=> "counter_block",
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
		)
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);