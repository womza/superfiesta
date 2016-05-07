<?php
/*
Template Name: 02 Homepage Video
*/

get_header(); global $tuscany_opt;
	$title         = $tuscany_opt['tuscany-video-title'];
	$intro_content = $tuscany_opt['tuscany-video-intro-content'];
	$button_text   = $tuscany_opt['tuscany-video-button-text'];
	if (isset($tuscany_opt['tuscany-video-vegies'])) {
		$vegies_icon   = $tuscany_opt['tuscany-video-vegies']['url'];
		if (!empty($vegies_icon)) {
			echo "<style>.video-intro-content h1:before {background-image:url(".esc_url($vegies_icon).");}</style>";
		}
	}
	$format_mp4  = $tuscany_opt['tuscany-video-format-mp4'];
	$format_webm = $tuscany_opt['tuscany-video-format-webm'];
	$format_ogv  = $tuscany_opt['tuscany-video-format-ogv'];
    if (isset($tuscany_opt['tuscany-parallax-bg'])) {
        $parallax_img = $tuscany_opt['tuscany-parallax-bg']['url'];
    }
    if (isset($tuscany_opt['tuscany-video-background'])) {
        $fallback_img = $tuscany_opt['tuscany-video-background']['url'];
    }
?>

<!-- Loader -->
<div class="loader-wrapp">
    <div>
        <div class="spinner">
          <div class="double-bounce1"></div>
          <div class="double-bounce2"></div>
        </div>
    </div>
</div>
<!-- End Loader -->

<!-- Video Fix -->
<div class="video-fix">
    <div class="container full-height">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 full-height">
            <?php if (!empty($title)): ?>
            	<div class="video-intro-content full-height">
            	    <div class="content-video text-center">
            	        <h1 class="animate-element" data-animation="bounceIn"><?php echo $title; ?></h1>
            	        <?php if (!empty($intro_content)): ?>
            	        	<p class="animate-element" data-animation="fadeInUp">
            	        		<?php echo $intro_content; ?>
            	        	</p>
            	        <?php endif ?>
            	        <?php if (!empty($button_text)): ?>
            	        	<a href="#" class="learn-more animate-element scroll-down" data-animation="rotateIn"><?php echo $button_text; ?></a>
            	        <?php endif ?>
            	    </div>
            	</div>
            <?php endif ?>
        </div>
    </div>
</div>
<!-- End Video Fix -->

<?php if (isset($tuscany_opt['home-video-manager'])) {
    $layout_manager = $tuscany_opt['home-video-manager']['enabled'];

    foreach ($layout_manager as $block => $value) {
        switch ($block) {
            case 'big-product-revolution':
            putRevSlider( "big-main" );
            break;

            case 'schedule-slider':
            putRevSlider( "scheduler" );
            break;

            case 'slider-woody':
            putRevSlider( "woody" );
            break;

            case 'images-gallery':
            get_template_part('inc/blocks/images-gallery');
            break;

            case 'slider-animations':
            get_template_part('inc/blocks/slider-animations');
            break;

            case 'image-parallax':
            get_template_part('inc/blocks/image-parallax');
            break;

            case 'product-add':
            get_template_part('inc/blocks/add-product');
            break;

            case 'about-content':
            get_template_part('inc/blocks/about-content');
            break;

            case 'small-product-revolution':
            putRevSlider( "small-product" );
            break;

            case 'dish-slider':
            get_template_part('inc/blocks/dishes-slider');
            break;

            case 'testimonials':
            get_template_part('inc/blocks/testimonials');
            break;

            case 'latest-news':
            get_template_part('inc/blocks/latest-news');
            break;

            case 'gallery':
            get_template_part('inc/blocks/gallery');
            break;

            case 'opening':
            get_template_part('inc/blocks/opening');
            break;

            case 'testimonials-slider':
            get_template_part('inc/blocks/testimonials-slider');
            break;

            case 'history':
            get_template_part('inc/blocks/history');
            break;

            case 'how-we-started':
            get_template_part('inc/blocks/how-we-started-two');
            break;

            case 'best-dishes':
            get_template_part('inc/blocks/best-dishes');
            break;

            case 'counter':
            get_template_part('inc/blocks/counter');
            break;

            case 'latest-news-two':
            get_template_part('inc/blocks/latest-news-rows');
            break;

            case 'parallax':
            get_template_part('inc/blocks/parallax');
            break;

            case 'team-slider':
            get_template_part('inc/blocks/team-slider');
            break;

            case 'slider-dish':
            get_template_part('inc/blocks/slider-dish');
            break;

            case 'gallery-slider':
            get_template_part('inc/blocks/gallery-slider');
            break;

            case 'opening-images':
            get_template_part('inc/blocks/opening-images');
            break;

            case 'news-slider':
            get_template_part('inc/blocks/news-slider');
            break;

            case 'product-book':
            get_template_part('inc/blocks/product-book');
            break;

            case 'about-board':
            get_template_part('inc/blocks/about-board');
            break;

            case 'testimonials-two':
            get_template_part('inc/blocks/testimonials-two');
            break;

        }
    }

} ?>

<script type="text/javascript">
(function($) {
    $(document).ready(function() {
        var BV = new $.BigVideo({useFlashForFirefox:false});
        BV.init();
        if (!Modernizr.touch) {
            BV.show([
                <?php echo (!empty($format_mp4)) ? '{ type: "video/mp4",  src: "'.esc_js($format_mp4).'" },' : ''; ?>
                <?php echo (!empty($format_webm)) ? '{ type: "video/webm",  src: "'.esc_js($format_webm).'" },' : ''; ?>
                <?php echo (!empty($format_ogv)) ? '{ type: "video/ogg",  src: "'.esc_js($format_ogv).'" }' : ''; ?>
            ], {ambient:true});
        } else {
            BV.show('<?php echo $fallback_img; ?>');
        }
    });
})(jQuery);
</script>

<?php get_footer(); ?>