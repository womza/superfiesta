<?php
/**
 *	Latest News Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_news_slider extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'      => '',
			'news_query' => ''
		), $atts));

		list($args, $news_query) = vc_build_loop_query($news_query);

		ob_start();
		?>

		<!-- Latest News -->
		<div class="container top-divide">
		    <?php if (!empty($title)): ?>
		    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
		    	    <div class="divider"></div>
		    	    <div class="title-wrapp">
		    	        <div>
		    	            <h2><?php echo $title; ?></h2>
		    	        </div>
		    	    </div>
		    	</div>
		    <?php endif ?>
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		        <div class="latest-news-slider-wrapper">
		            <div class="additional-border border-white"></div>
		            <div class="latest-slider">
		            	<?php while($news_query->have_posts()): $news_query->the_post(); ?>
		            	   	<div>
		            	   	    <div class="new-holder">
		            	   	        <div>
		            	   	            <div class="additional-border"></div>
		            	   	            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		            	   	            <?php the_excerpt(); ?>
		            	   	            <span class="date-holder"><?php the_time('d.m.Y'); ?></span>
		            	   	            <a href="<?php the_permalink(); ?>" class="read-new">
		            	   	            	<?php _e('Read More', THEME_NAME); ?>
		            	   	            </a>
		            	   	            <img src="<?php echo get_template_directory_uri(); ?>/img/new-dish.png" height="143" width="248" alt="Featured Image">
		            	   	        </div>
		            	   	    </div>
		            	   	</div>
		            	<?php endwhile; ?>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- End Latest News -->
		
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Latest News Slider", 'js_composer'),
	"description" => __('Create a loop and insert block with latest news.', 'js_composer'),
	"base"		=> "vc_news_slider",
	"class"		=> "vc_news_slider_block",
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
			"type" => "loop",
			"heading" => __("News Query", 'js_composer'),
			"param_name" => "news_query",
			'settings' => array(
				'size'                => array('hidden' => false, 'value' => 12),
				'order_by'            => array('value' => 'date'),
				'post_type'           => array('value' => 'post', 'hidden' => false)
			),
			"description" => __("Create WordPress loop, to populate news from your site.", 'js_composer')
		),
	)
);

// Add & init the shortcode
wpb_map($opts);
#new WPBakeryShortCode_laborator_banner2($opts);