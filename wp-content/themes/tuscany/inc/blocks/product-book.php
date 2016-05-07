<?php global $tuscany_opt;
if (isset($tuscany_opt['tuscany-book-background-img']['url'])) {
  $bg_img       = $tuscany_opt['tuscany-book-background-img']['url'];
}
if (isset($tuscany_opt['tuscany-book-cover-img']['url'])) {
  $book_wrapper = $tuscany_opt['tuscany-book-cover-img']['url'];
}
?>

<!-- Recipes Book -->
<div class="recipes-book-wrapper" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($bg_img)) ? 'style="background-image:url('.esc_url($bg_img).');"' : ''; ?>>
    <div class="container hidden-xs">
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
    <div class="container visible-xs">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div id="recipes_mobile">
            <?php
            $args = array( 'post_type' => 'product', 'posts_per_page' => -1 );
            $loop = new WP_Query( $args );
            $counter = 0;
            echo '<div class="recipes-slider-mobile"><div>';
            if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
            <?php if ($counter == 8): ?>
            <?php echo '</div><div>'; $counter = 0; ?>
            <?php endif ?>
            <li>
            <a href="<?php the_permalink(); ?>">
            <div class="meal-name"><?php the_title(); ?></div>
            <div class="meal-price"><?php echo $product->get_price_html(); ?></div>
            </a>
            </li>
            <?php $counter++; endwhile; endif; ?>
            <?php echo '</div></div>'; ?>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- End Recipes Book -->