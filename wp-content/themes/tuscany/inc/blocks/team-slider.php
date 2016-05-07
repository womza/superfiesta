<?php global $tuscany_opt;
    $block_title = $tuscany_opt['tuscany-team-title'];
    if (isset($tuscany_opt['tuscany-team-wood-img'])) {
        $wood_img  = $tuscany_opt['tuscany-team-wood-img']['url'];
    }
?>

<!-- Team Members -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
        <div class="divider"></div>
        <?php if (!empty($block_title)): ?>
            <div class="title-wrapp">
                <div>
                    <h2><?php echo $block_title; ?></h2>
                </div>
            </div>
        <?php endif ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="menu-slides team-members-slides">
            <?php
               $args = array( 'post_type' => 'our-team', 'posts_per_page' => -1 );
               $loop = new WP_Query( $args );
               if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
               $png_image = get_post_meta($post->ID, '_cmb_png_image_two', true);
               $bubble_img = get_post_meta($post->ID, '_cmb_bubble_png', true);
               ?>
                <div class="text-center">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="member-thumbnail-img">
                            <?php the_post_thumbnail('global', array('class' => 'img-thumbnail')); ?>
                        </div>
                    <?php elseif (!empty($png_image) && isset($png_image)): ?>
                    <div>
                        <div class="product-holder" <?php echo (!empty($wood_img)) ? 'style="background-image:url('.esc_url($wood_img).');"' : ''; ?>>
                            <?php if (!empty($bubble_img) && isset($bubble_img)): ?>
                                <span class="speak-bubble" <?php echo 'style="background-image:url('.esc_url($bubble_img).');"'; ?>></span>
                            <?php endif ?>
                            <img src="<?php echo esc_url($png_image); ?>" alt="Member Image">
                        </div>
                    </div>
                    <?php else: ?><?php endif ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo get_the_excerpt(); ?></p>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>
<!-- End Team Members -->