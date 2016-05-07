<?php global $tuscany_opt;
$block_title = $tuscany_opt['tuscany-gallery-title'];
?>

<!-- Images Gallery -->
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
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <div class="main-images-gallery-wrapp">
            <div class="gallery-big-pappa">
                <?php if (isset($tuscany_opt['tuscany-gallery-images'])) {
                    $gallery = explode(',', $tuscany_opt['tuscany-gallery-images']);
                    foreach ($gallery as $images => $image) {
                        echo "<div>".wp_get_attachment_image( $image, 'big-sizy' )."</div>";
                    }
                } ?>
            </div>
            <div class="gallery-thumb-pappa">
                <?php if (isset($tuscany_opt['tuscany-gallery-images'])) {
                    $gallery = explode(',', $tuscany_opt['tuscany-gallery-images']);
                    foreach ($gallery as $images => $image) {
                        echo '<div><span><i class="fa fa-search"></i></span>'.wp_get_attachment_image( $image, 'small-sizy', false, array('class' => 'img-responsive') ).'</div>';
                    }
                } ?>
            </div>
        </div>
    </div>
</div>
<!-- Images Gallery END -->