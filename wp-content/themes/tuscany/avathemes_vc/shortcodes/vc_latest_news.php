<?php
/**
 *	Latest News Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_latest_news extends  WPBakeryShortCode
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
		    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title">
		    	    <div class="divider"></div>
		    	    <div class="title-wrapp">
		    	        <div>
		    	            <h2><?php echo $title; ?></h2>
		    	        </div>
		    	    </div>
		    	    <div class="custom-menu-nav-news custom-menu-nav">
		    	        <a href="#" data-dir="prev" class="fa fa-chevron-left"></a>
		    	        <a href="#" data-dir="next" class="fa fa-chevron-right"></a>
		    	    </div>
		    	</div>
		    <?php endif ?>
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alpha">
		        <div class="latest-news-wrapper news-slider top-divide">
		            <?php while($news_query->have_posts()): $news_query->the_post(); ?>
		                <div>
		                    <?php if (has_post_thumbnail()) { ?>
		                        <a href="<?php the_permalink(); ?>">
		                            <?php the_post_thumbnail('slider-img', array('class' => 'img-responsive')); ?>
		                        </a>
		                    <?php } else {
		                        echo '<img class="img-responsive" src="https://api.fnkr.net/testimg/500x300/150d05/FFF/?text=img+placeholder" alt="image">';
		                    } ?>
		                    <div class="new-holder">
		                        <div class="news-content">
		                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		                            <?php the_excerpt(); ?>
		                            <span class="date-holder"><?php the_time('d.m.Y'); ?></span>
		                        </div>
		                        <div class="author-holder">
		                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 85 ); ?>
		                        </div>
		                    </div>
		                </div>
		            <?php endwhile; ?>
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
	"name"		=> __("Latest News", 'js_composer'),
	"description" => __('Create a loop and insert block with latest news.', 'js_composer'),
	"base"		=> "vc_latest_news",
	"class"		=> "vc_latest_news_block",
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