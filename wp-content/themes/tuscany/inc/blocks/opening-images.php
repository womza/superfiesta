<?php global $tuscany_opt;
    if (isset($tuscany_opt['tuscany-working-days'])) {
       $working_days = $tuscany_opt['tuscany-working-days'];
    }
    if (isset($tuscany_opt['tuscany-weekends'])) {
       $weekends     = $tuscany_opt['tuscany-weekends'];
    }
    if (isset($tuscany_opt['tuscany-quote-schedule'])) {
       $quote        = $tuscany_opt['tuscany-quote-schedule'];
    }
?>

<?php if (is_page_template('templates/homepage-woody.php')): ?>
    <?php echo '<div class="half-schedule-wrapp">' ?>
<?php endif ?>

<!-- Working Schedule -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="schedule-holder text-center">
            <?php if (isset($tuscany_opt['tuscany-schedule-images'])) {
                $gallery = explode(',', $tuscany_opt['tuscany-schedule-images']);
                foreach ($gallery as $images => $image) {
                    $image_url = wp_get_attachment_image_src($image, 'full');
                    echo '<span>'.wp_get_attachment_image( $image, 'full' ).'</span>';
                }
            } ?>
            <?php if (!empty($working_days) && !empty($weekends) && !empty($quote)): ?>
            	<div>
            	    <div>
            	        <h3><?php echo $working_days; ?></h3>
            	        <h3><?php echo $weekends; ?></h3>
            	    </div>
            	    <p><?php echo $quote; ?></p>
            	</div>
            <?php endif ?>
        </div>
    </div>
</div>
<!-- End Working Schedule -->

<?php if (is_page_template('templates/homepage-woody.php')): ?>
    <?php echo '</div>' ?>
<?php endif ?>