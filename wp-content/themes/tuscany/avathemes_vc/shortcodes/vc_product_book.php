<?php
/**
 *	Product Book Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_product_book extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'       => ''
		), $atts));

		global $tuscany_opt;
		$bg_img       = $tuscany_opt['tuscany-book-background-img']['url'];
		$book_wrapper = $tuscany_opt['tuscany-book-cover-img']['url'];

		ob_start();
		?>

		<!-- Recipes Book -->
		<div class="ava_themes_block recipes-book-wrapper hidden-xs" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($bg_img)) ? 'style="background-image:url('.esc_url($bg_img).');"' : ''; ?>>
		    <div class="container">
		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 book-recipe-wrapper">
		            <?php if (isset($tuscany_opt['tuscany-book-images'])) {
		                $gallery = explode(',', $tuscany_opt['tuscany-book-images']);
		                foreach ($gallery as $images => $image) {
		                    echo wp_get_attachment_image( $image, 'full' );
		                }
		            } ?>
		            <div class="book_wrapper" <?php echo (!empty($book_wrapper)) ? 'style="background-image:url('.esc_url($book_wrapper).');"' : ''; ?>>
		                <a id="next_page_button"></a>
		                <a id="prev_page_button"></a>
		                <div id="loading" class="loading"><?php _e('Loading pages!', THEME_NAME); ?>...</div>
		                <div id="mybook" style="display:none;">
		                    <div class="b-load">
		                        <?php
		                           $args = array( 'post_type' => 'product', 'posts_per_page' => -1 );
		                           $loop = new WP_Query( $args );
		                           $counter = 0;
		                           echo "<div><ul>";
		                           if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		                           <?php if ($counter == 8): ?>
		                           	<?php echo '</ul></div><div><ul>'; $counter = 0; ?>
		                           <?php endif ?>
		                                <li>
			                                <a href="<?php the_permalink(); ?>">
			                                    <div class="meal-name"><?php the_title(); ?></div>
			                                    <div class="meal-price"><?php echo $product->get_price_html(); ?></div>
			                                </a>
		                                </li>
		                        <?php $counter++; endwhile; endif; ?>
		                        <?php echo '</ul></div>'; ?>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- End Recipes Book -->

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Products Book", 'js_composer'),
	"description" => __('Shortcode for embeding book of products.', 'js_composer'),
	"base"		=> "vc_product_book",
	"class"		=> "vc_product_book_block",
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