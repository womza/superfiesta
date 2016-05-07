<?php
/*
Template Name: 03 Homepage Woody
*/

get_header(); ?>

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

<?php if (isset($tuscany_opt['home-woody-manager'])) {
	$layout_manager = $tuscany_opt['home-woody-manager']['enabled'];

	foreach ($layout_manager as $block => $value) {
		switch ($block) {
			case 'big-product-revolution':
			putRevSlider( "big-main" );
			break;

			case 'schedule-slider':
			putRevSlider( "scheduler" );
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

			case 'images-gallery':
			get_template_part('inc/blocks/images-gallery');
			break;

			case 'slider-animations':
			get_template_part('inc/blocks/slider-animations');
			break;

			case 'image-parallax':
			get_template_part('inc/blocks/image-parallax');
			break;

			case 'slider-woody':
			putRevSlider( "woody" );
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

<?php get_footer(); ?>