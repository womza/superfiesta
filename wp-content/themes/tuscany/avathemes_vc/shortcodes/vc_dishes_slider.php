<?php
/**
 *	Dishes Slider Block Shortcode for Visual Composer
 */

class WPBakeryShortCode_vc_dishes_slider extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'title'  => ''
		), $atts));

		global $tuscany_opt;
		$nav_img    = $tuscany_opt['tuscany-nav-word-img']['url'];
		$dish_table = $tuscany_opt['tuscany-dish-table-img']['url'];

		ob_start();
		?>

		<!-- Menu -->
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
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alpha">
		        <?php if (!empty($tuscany_opt['tuscany_product_cat_select']) && isset($tuscany_opt['tuscany_product_cat_select'])):
		            $selected_categories = implode(',', $tuscany_opt['tuscany_product_cat_select']); ?>
		            <?php
		            $categories = get_categories('taxonomy=product_cat&include='.$selected_categories); //retrieve all the categories and save them as a variable $categories
		            $counter = 1;
		            foreach($categories as $category) : // Use foreach to split $categories into individual categories and store as variable $category
		            ?>

		            <div class="menu-wrapper">
		                <div class="menu-slider">
		                    <div class="row">
		                        <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
		                            <div class="menu-nav">
		                                <div>
		                                    <?php if (!empty($nav_img)): ?>
		                                        <p><img src="<?php echo esc_url($nav_img); ?>" alt="Nav Image"></p>
		                                    <?php endif ?>
		                                    <h3><?php echo $category->name; ?></h3>
		                                    <div class="custom-menu-nav-<?php echo $counter; ?> custom-menu-nav">
		                                        <a href="#" data-dir="prev" class="fa fa-chevron-left"></a>
		                                        <a href="#" data-dir="next" class="fa fa-chevron-right"></a>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
		                            <div class="menu-slides-<?php echo $counter; ?> menu-slides">
		                                <?php
		                                $catid = $category->cat_ID; //Store the category ID as a variable to be used in get_posts
		                                $args = array(
		                                'post_type' => 'product',
		                                'tax_query' => array(
		                                        array(
		                                            'taxonomy' => 'product_cat',
		                                            'field' => 'slug',
		                                            'terms' => $category->slug
		                                    )
		                                 ),
		                                'posts_per_page' => 10
		                                );
		                                $query = new WP_Query( $args );
		                                // Start the Loop. You can use your own loop here
		                                while ( $query->have_posts() ) : $query->the_post();
		                                global $product;
		                                $price_html = $product->get_price_html();
		                                $price_html_array = price_array($price_html);
		                                ?>
		                                <div class="text-center">
		                                    <?php if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'png-product')): ?>
		                                        <div class="product-holder" <?php echo (!empty($dish_table)) ? 'style="background-image:url('.esc_url($dish_table).');"' : ''; ?>>
		                                            <?php if (sizeof($price_html_array) == 2): ?>
		                                                <span class="price"><?php echo $price_html_array[1]; ?></span>
		                                            <?php else: ?>
		                                                <span class="price"><?php echo $price_html_array[0]; ?></span>
		                                            <?php endif ?>
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
		                                               <span class="price"><?php echo $product->get_price_html(); ?></span>
		                                               <a href="<?php the_permalink(); ?>">
		                                                   <?php the_post_thumbnail('global', array('class' => 'img-thumbnail')); ?>
		                                               </a>
		                                           </div>
		                                        <?php endif ?>
		                                    <?php endif ?>
		                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		                                    <p><?php echo wp_trim_words(get_the_excerpt(), 7); ?></p>
		                                </div>
		                                <?php
		                                endwhile;
		                                wp_reset_postdata(); ?>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>

		            <script type="text/javascript">
		                (function($) {
		                    $('.custom-menu-nav-<?php echo $counter; ?> a').click(function(event) {
		                        event.preventDefault();
		                        var dir = $(this).data('dir');
		                        if (dir == 'next') {
		                            $('.menu-slides-<?php echo $counter; ?>').slickNext();
		                        } else {
		                            $('.menu-slides-<?php echo $counter; ?>').slickPrev();
		                        }
		                    });
		                })(jQuery);
		            </script>

		            <?php $counter++; endforeach; ?>
		            <?php else: ?>

		            <?php endif ?>
		    </div>
		</div>
		<!-- End Menu -->

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}



$opts = array(
	"name"		=> __("Slider with Dishes", 'js_composer'),
	"description" => __('Insert Block with dishes sliders', 'js_composer'),
	"base"		=> "vc_dishes_slider",
	"class"		=> "vc_dishes_slider_block",
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