<?php global $tuscany_opt;
	$price          = $tuscany_opt['tuscany-add-price'];
	$description    = $tuscany_opt['tuscany-add-description'];
	$product_img    = $tuscany_opt['tuscany-add-img']['url'];
	$additional_img = $tuscany_opt['tuscany-add-additional']['url'];
?>

<!-- Addvertisement Item -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="add-banner">
            <div class="additional-border"></div>
            <?php if (!empty($additional_img)): ?>
            	<div class="text-add cell-section hidden-xs hidden-sm element-animate" data-animation="zoomInLeft" <?php echo 'style="background-image: url('.esc_url($additional_img).');"' ?>></div>
            <?php endif ?>
            <?php if (!empty($product_img)): ?>
            	<div class="image-add cell-section text-center element-animate" data-animation="flipInX">
            	    <img src="<?php echo esc_url($product_img); ?>"  alt="Add Image">
            	</div>
            <?php endif ?>
            <div class="add-content cell-section element-animate" data-animation="zoomInRight">
                <?php if (!empty($price)): ?>
                	<div class="hidden-xs col-sm-4 col-md-4 col-lg-4 omega alpha">
                	    <div class="pricing-tag">
                	        <div class="border-rounded additional-border border-white"></div>
                	        <?php echo $price; ?>
                	    </div>
                	</div>
                <?php endif ?>
                <?php if (!empty($description)): ?>
                	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 omega alpha">
                	    <div>
                	        <p><?php echo $description; ?></p>
                	    </div>
                	</div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- End Addvertisement Item -->