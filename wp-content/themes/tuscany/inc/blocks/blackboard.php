<?php global $tuscany_opt;
    if (isset($tuscany_opt['tuscany-blackboard-title'])) {
        $block_title           = $tuscany_opt['tuscany-blackboard-title'];
    }
    if (isset($tuscany_opt['tuscany-text-description-one'])) {
        $block_description_one = $tuscany_opt['tuscany-text-description-one'];
    }
    if (isset($tuscany_opt['tuscany-text-description-two'])) {
        $block_description_two = $tuscany_opt['tuscany-text-description-two'];
    }
    if (isset($tuscany_opt['tuscany-board-image-one'])) {
        $image_one = $tuscany_opt['tuscany-board-image-one']['url'];
    }
    if (isset($tuscany_opt['tuscany-board-image-two'])) {
        $image_two = $tuscany_opt['tuscany-board-image-two']['url'];
    }
    if (isset($tuscany_opt['tuscany-board-image-three'])) {
        $image_three = $tuscany_opt['tuscany-board-image-three']['url'];
    }
    if (isset($tuscany_opt['tuscany-board-bg'])) {
        $bg = $tuscany_opt['tuscany-board-bg']['url'];
    }
?>

<!-- About Tisue -->
<div class="parallax-block parallax-started top-divide" <?php echo (!empty($bg)) ? 'style="background-image:url('.esc_url($bg).');"' : ''; ?> data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <?php if (!empty($block_title)): ?>
                <h4 class="board-title"><?php echo $block_title; ?></h4>
            <?php endif ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 about-ingredients element-animate" data-animation="zoomInUp">
            <div>
                <div class="text-center">
                    <?php if (!empty($image_one)): ?>
                        <img src="<?php echo esc_url($image_one); ?>" alt="Image">
                    <?php endif ?>
                    <?php if (!empty($block_description_one)): ?>
                        <?php echo $block_description_one; ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="hidden-xs hidden-sm col-md-4 col-lg-4 text-center about-ingredients element-animate" data-animation="zoomInUp">
            <div>
                <?php if (!empty($image_two)): ?>
                    <img src="<?php echo esc_url($image_two); ?>" alt="Image" class="img-responsive">
                <?php endif ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 about-ingredients element-animate" data-animation="zoomInUp">
            <div>
                <div class="text-center">
                    <?php if (!empty($image_three)): ?>
                        <img src="<?php echo esc_url($image_three); ?>" alt="Image">
                    <?php endif ?>
                    <?php if (!empty($block_description_two)): ?>
                       <?php echo $block_description_two; ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About Tisue -->