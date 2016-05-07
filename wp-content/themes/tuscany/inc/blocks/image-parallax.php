<?php global $tuscany_opt;
	if (isset($tuscany_opt['tuscany-parallax-bg'])) {
		$parallax_img = $tuscany_opt['tuscany-parallax-bg']['url'];
	}
	if (isset($tuscany_opt['tuscany-parallax-image'])) {
		$image = $tuscany_opt['tuscany-parallax-image']['url'];
	}
?>

<!-- Parallax With Image -->
<div class="parallax-block image-parallax" data-stellar-horizontal-offset="50" data-stellar-background-ratio="0.5" <?php echo (!empty($parallax_img)) ? 'style="background-image:url('.esc_url($parallax_img).');"' : ''; ?>>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <?php if (!empty($image)): ?>
            	<img class="img-responsive" src="<?php echo esc_url($image); ?>" alt="Image">
            <?php endif ?>
        </div>
    </div>
</div>
<!-- Parallax With Image -->