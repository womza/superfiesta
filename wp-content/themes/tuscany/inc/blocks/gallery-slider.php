<?php global $tuscany_opt;
    $block_title = $tuscany_opt['tuscany-gallery-title'];
?>

<!-- Our Gallery -->
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
        <div class="our-gallery-slider top-divide">
            <div class="gallery-wrapp clearfix">
            <?php if (isset($tuscany_opt['tuscany-gallery-images'])) {
                $gallery = explode(',', $tuscany_opt['tuscany-gallery-images']);
                $counter = 0;
                foreach ($gallery as $images => $image) {
                    $image_url = wp_get_attachment_image_src($image, 'full');

                    if ($counter == 8) {
                        echo '</div><div class="gallery-wrapp clearfix">';
                        $counter = 0;
                    }

                    echo '<a href="'.esc_url($image_url[0]).'" rel="prettyPhoto[gallery]">
                            '.wp_get_attachment_image( $image, 'slider-img' ).'
                            <span><i class="fa fa-search"></i></span>
                        </a>';

                $counter++; }
            } ?>
            </div>
        </div>
    </div>
</div>
<!-- End Our Gallery -->