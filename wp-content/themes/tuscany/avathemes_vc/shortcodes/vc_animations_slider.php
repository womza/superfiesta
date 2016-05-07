<?php
/**
 *	Animations Product Slider Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_animations_slider extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'       => ''
		), $atts));

		global $tuscany_opt;

		$title_img      = $tuscany_opt['tuscany-great-subtitle-img']['url'];
		$animate_images = $tuscany_opt['tuscany-great-animated-images'];
		$custom_css     = $tuscany_opt['tuscany-great-css-mod'];
		$blackboard_img = $tuscany_opt['tuscany-great-table-img']['url'];

		ob_start();
		?>

		<!-- The Great Slider -->
		<div class="great-slider">
		    <div class="container">
		        <div class="hidden-sm hidden-xs hidden-md col-lg-6">
		            <div class="great-elements">
		                <?php if (isset($tuscany_opt['tuscany-great-animated-images'])) {
		                    $gallery = explode(',', $tuscany_opt['tuscany-great-animated-images']);
		                    foreach ($gallery as $images => $image) {
		                        echo wp_get_attachment_image( $image, 'full' );
		                    }
		                } ?>
		            </div>
		        </div>
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
		            <div class="great-wrapper" <?php echo (!empty($blackboard_img)) ? 'style="background-image:url('.esc_url($blackboard_img).');"' : ''; ?>>
		                <?php if (!empty($title)): ?>
		                	<h2><span><img src="<?php echo get_template_directory_uri(); ?>/img/the-white.png" height="54" width="48" alt="The"></span><?php echo $title; ?></h2>
		                <?php endif ?>
		                <div class="great-slider">
		                    <div class="menu-slides great-dishes">
		                        <?php
		                           $args = array( 'post_type' => 'product', 'posts_per_page' => 12 );
		                           $loop = new WP_Query( $args );
		                           $counter = 0;
		                           echo '<div class="text-center great-dish">';
		                           if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		                           		<?php if ($counter == 4): ?>
		                           			<?php echo '</div><div class="text-center great-dish">'; $counter = 0; ?>
		                           		<?php endif ?>
		                           	    <div>
		                           	        <?php if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'png-product')): ?>
		                           	            <div class="product-holder no-table-bg">
		                           	                <span class="price"><?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?> <?php echo get_woocommerce_currency_symbol(); ?></span>
		                           	                <?php
		                           	                MultiPostThumbnails::the_post_thumbnail(
		                           	                        get_post_type(),
		                           	                        'png-product'
		                           	                    );
		                           	                ?>
		                           	            </div>
		                           	        <?php else: ?>
		                           	            <?php if (has_post_thumbnail()): ?>
		                           	               <div class="dish-thumbnail">
		                           	                   <span class="price"><?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?> <?php echo get_woocommerce_currency_symbol(); ?></span>
		                           	                   <a href="<?php the_permalink(); ?>">
		                           	                       <?php the_post_thumbnail('global', array('class' => 'img-thumbnail')); ?>
		                           	                   </a>
		                           	               </div>
		                           	            <?php endif ?>
		                           	        <?php endif ?>
		                           	        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		                           	        <p><?php echo wp_trim_words(get_the_excerpt(), 5); ?></p>
		                           	    </div>
		                        <?php $counter++; endwhile; endif; ?>
		                        <?php echo '</div>' ?>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- End Great Slider -->

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Animations Product Slider", 'js_composer'),
	"description" => __('Insert product slider with animated images.', 'js_composer'),
	"base"		=> "vc_animations_slider",
	"class"		=> "vc_animations_slider_block",
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