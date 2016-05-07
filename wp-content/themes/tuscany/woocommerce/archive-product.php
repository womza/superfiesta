<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<?php putRevSlider( "shopify" ); ?>

<!-- Single Wrapper -->
<div class="single-wrapper">
    <div class="container">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">


            <?php if ( have_posts() ) : ?>

            	<div class="row">
            		<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
            			<?php woocommerce_result_count(); ?>
            		</div>
            		<div class="col-xs-12 col-sm-4 col-md-6 col-lg-6 text-right">
            			<?php woocommerce_catalog_ordering(); ?>
            		</div>
            	</div>


                <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php
                    /**
                     * woocommerce_after_shop_loop hook
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif; ?>

        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <div class="sidebar-holder">
                <?php
                    /**
                     * woocommerce_sidebar hook
                     *
                     * @hooked woocommerce_get_sidebar - 10
                     */
                    do_action( 'woocommerce_sidebar' );
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End Single Wrapper -->

<?php get_footer( 'shop' ); ?>