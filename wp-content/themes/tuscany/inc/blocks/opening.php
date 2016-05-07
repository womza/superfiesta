<?php global $tuscany_opt;
	$circle_word  = $tuscany_opt['tuscany-schedule-word'];
	$working_days = $tuscany_opt['tuscany-working-days'];
	$weekends     = $tuscany_opt['tuscany-weekends'];
	$quote        = $tuscany_opt['tuscany-quote-schedule'];
?>

<!-- Schedule -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
        <div class="schedule-wrapp element-animate" data-animation="fadeInUp">
            <?php if (!empty($circle_word)): ?>
            	<div class="hidden-xs">
            	    <div class="schedule-date">
            	        <div><?php echo $circle_word; ?></div>
            	    </div>
            	</div>
            <?php endif ?>
            <?php if (!empty($working_days) && !empty($weekends) && !empty($quote)): ?>
            	<div>
            	    <div class="schedule-time clearfix">
            	        <div class="time-wrapp clearfix">
            	            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            	                <p><?php echo $working_days; ?></p>
            	            </div>
            	            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            	                <p><?php echo $weekends; ?></p>
            	            </div>
            	        </div>
            	        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            	            <blockquote>
            	                <?php echo $quote; ?>
            	            </blockquote>
            	        </div>
            	    </div>
            	</div>
            <?php endif ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2"></div>
</div>
<!-- End Schedule -->