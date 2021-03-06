<?php global $tuscany_opt;
    $main_content  = $tuscany_opt['tuscany-rest-content-main'];
    $secondary_one = $tuscany_opt['tuscany-rest-secondary-one'];
    $secondary_two = $tuscany_opt['tuscany-rest-secondary-two'];
    $block_title   = $tuscany_opt['tuscany-title-about'];
    if (isset($tuscany_opt['tuscany-rest-img-one'])) {
        $big_circled = $tuscany_opt['tuscany-rest-img-one']['url'];
    }
    if (isset($tuscany_opt['tuscany-rest-img-two'])) {
        $small_circled = $tuscany_opt['tuscany-rest-img-two']['url'];
        if (!empty($small_circled)) {
            echo "<style>.main-about-circle:after{background-image: url(".esc_url($small_circled).");}</style>";
        }
    }
    if (isset($tuscany_opt['tuscany-rest-img-three'])) {
        $image_one = $tuscany_opt['tuscany-rest-img-three']['url'];
    }
    if (isset($tuscany_opt['tuscany-rest-img-four'])) {
        $image_two = $tuscany_opt['tuscany-rest-img-four']['url'];
    }
    if (isset($tuscany_opt['tuscany-rest-img-five'])) {
        $image_three = $tuscany_opt['tuscany-rest-img-five']['url'];
    }

    if (empty($image_two)) {
        $class_one = "col-xs-9 col-sm-9 col-md-12 col-lg-12";
    } else {
        $class_one = "col-xs-9 col-sm-9 col-md-12 col-lg-7";
    }

    if (empty($image_three)) {
        $class_two = "col-xs-9 col-sm-9 col-md-12 col-lg-12";
    } else {
        $class_two = "col-xs-9 col-sm-9 col-md-12 col-lg-7";
    }
?>

<!-- About Section -->
<div class="container top-divide bottom-divide">
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
    <div class="hidden-xs col-sm-4 col-md-4 col-lg-4 element-animate" data-animation="zoomInLeft">
        <div class="main-about-circle" <?php echo (!empty($big_circled)) ? 'style="background-image: url('.esc_url($big_circled).');"' : ''; ?>><div class="additional-border border-rounded border-white"></div></div>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 element-animate" data-animation="zoomInRight">
        <div class="about-wrapper">
            <div class="about-content">
                <?php if (!empty($image_one)): ?>
                    <div>
                        <img src="<?php echo esc_url($image_one); ?>" alt="ABout Us">
                    </div>
                <?php endif ?>
                <div class="text-center">
                    <?php if (!empty($main_content)): ?>
                        <?php echo $main_content; ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="about-services-wrapp">
            <hr>
            <div class="about-services">
                <div class="cell-section">
                    <?php if (!empty($image_two)): ?>
                        <div class="col-xs-3 col-sm-3 col-md-12 col-lg-5">
                            <img class="img-responsive" src="<?php echo esc_url($image_two); ?>" alt="About Image">
                        </div>
                    <?php endif ?>
                    <div class="<?php echo $class_one; ?>">
                        <?php if (!empty($secondary_one)): ?>
                            <?php echo $secondary_one; ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="cell-section">
                    <?php if (!empty($image_three)): ?>
                        <div class="col-xs-3 col-sm-3 col-md-12 col-lg-5">
                            <img class="img-responsive" src="<?php echo esc_url($image_three); ?>" alt="About Image">
                        </div>
                    <?php endif ?>
                    <div class="<?php echo $class_two; ?>">
                        <?php if (!empty($secondary_two)): ?>
                            <?php echo $secondary_two; ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About Section -->