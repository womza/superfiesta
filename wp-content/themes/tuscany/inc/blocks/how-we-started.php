<?php global $tuscany_opt;
    $content = $tuscany_opt['tuscany-started-content'];
    if (isset($tuscany_opt['tuscany-corner-image'])) {
        $corner_image = $tuscany_opt['tuscany-corner-image']['url'];
    }
    if (isset($tuscany_opt['tuscany-started-bg'])) {
        $parallax_img = $tuscany_opt['tuscany-started-bg']['url'];
    }
?>

<!-- About Tisue -->
<div class="parallax-block parallax-started" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($parallax_img)) ? 'style="background-image: url('.esc_url($parallax_img).');"' : ''; ?>>
    <div class="container">
    <div class="starting-point">
        <div class="hidden-sm hidden-xs col-md-7 col-lg-6 animation-text-div">
            <?php if (isset($tuscany_opt['tuscany-started-images'])) {
                $gallery = explode(',', $tuscany_opt['tuscany-started-images']);
                foreach ($gallery as $images => $image) {
                    $image_url = wp_get_attachment_image_src($image, 'full');
                    echo wp_get_attachment_image( $image, 'full' );
                }
            } ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
            <div class="papper-tisue">
                <div class="tus-scroll">
                    <?php if (!empty($corner_image)): ?>
                        <img class="hidden-md hidden-xs" src="<?php echo esc_url($corner_image); ?>" alt="Corner Image">
                    <?php endif ?>
                    <?php if (!empty($content)): ?>
                        <?php echo $content; ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- End About Tisue -->