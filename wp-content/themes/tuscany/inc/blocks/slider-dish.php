<?php global $tuscany_opt;
$title      = $tuscany_opt['tuscany-slider-title'];
?>

<!-- Best Dishes -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
        <div class="divider"></div>
        <?php if (!empty($title)): ?>
            <div class="title-wrapp">
                <div>
                    <h2><?php echo $title; ?></h2>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<div class="dishes-slick-track">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="menu-slides best-dishes">
                    <?php
                       $args = array( 'post_type' => 'product', 'posts_per_page' => 10 );
                       $loop = new WP_Query( $args );
                       if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                       global $product; ?>
                        <div class="text-center">
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
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Best Dishes -->