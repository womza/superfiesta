<?php global $tuscany_opt;
    $block_title = $tuscany_opt['tuscany-gallery-title'];
    if (isset($tuscany_opt['tuscany-gallery-bg'])) {
        $bg_image = $tuscany_opt['tuscany-gallery-bg']['url'];
    }
?>

<!-- Gallery -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title">
        <div class="divider"></div>
        <?php if (!empty($block_title)): ?>
            <div class="title-wrapp">
                <div>
                    <h2><?php echo $block_title; ?></h2>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<div class="gallery-bg clearfix top-divide" <?php echo !empty($bg_image) ? 'style="background-image:url('.esc_url($bg_image).');"' : ''; ?>>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alpha">
            <div class="gallery-wrapper clearfix">
                <?php if (isset($tuscany_opt['tuscany-gallery-images'])) {
                    $gallery = explode(',', $tuscany_opt['tuscany-gallery-images']);
                    foreach ($gallery as $images => $image) {
                        $image_url = wp_get_attachment_image_src($image, 'full');
                        echo '<a href="'.esc_url($image_url[0]).'" rel="prettyPhoto[gallery]">
                                '.wp_get_attachment_image( $image, 'medium-thumb' ).'
                                <span><i class="fa fa-search"></i></span>
                            </a>';
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
<!-- End Gallery -->