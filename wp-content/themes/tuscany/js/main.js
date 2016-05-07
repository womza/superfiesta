(function($) {
	'use strict';

	$(window).scroll(function(){
	    if ($(this).scrollTop() > 400) {
	        $('.goTop').fadeIn();
	    } else {
	        $('.goTop').fadeOut();
	    }
	});

	$('.goTop').click(function(){
	    $("html, body").animate({ scrollTop: 0 }, 600);
	    return false;
	});

	if (!Modernizr.touch) {
		$('.element-animate').css({
			opacity: 0
		});
	}

	$(document).ready(function() {

		$('.recipes-slider-mobile').slick({
			slidesToShow   : 1,
			slidesToScroll : 1,
			infinite       : true,
			dots           : true,
		});


		$("a[rel^='prettyPhoto']").prettyPhoto();

		$('.ava_themes_block').parents('.vc_row').addClass('ava_block_wrapp');
	});

	$('.product_list_widget img, .woocommerce ul.products li .thumbnail-img-hold img, .cart_list li img, #content div.product div.images div.thumbnails img').addClass('img-thumbnail');

	$('.widget_search .search-field, .comment-form-author input, .comment-form-url input, .comment-form-comment textarea, .comment-form-email input, .widget_product_search input[type="text"], .woocommerce-checkout form input[type="text"], .woocommerce-checkout textarea').addClass('form-control');
	$('.widget_search .search-submit, .widget_product_search input[type="submit"]').addClass('btn-tuscany-submit pull-right');
	$('.comment-form #submit').addClass('btn-tuscany-submit');

	$('.author-post .avatar').addClass('hidden-xs hidden-sm');

	$(window).load(function() {

		$('.loader-wrapp').fadeOut('slow', function() {
			$(this).remove();
		});

		$('.match-me').matchHeight({
		    byRow: true,
		    property: 'height',
		    target: null,
		    remove: false
		});


		setTimeout(function() {
			$.stellar();
		}, 100);

		var wHeight = $(window).height(),
			hHeight = $('.tuscany-header').outerHeight();
		$('.video-fix').css({
			height: wHeight - hHeight
		});
		$('.sizable-div').css({
			height : wHeight
		});

		$('#big-video-wrap').append('<div class="pattern"></div>');
		$('#big-video-wrap').append('<div class="gradient"></div>');

		var $animateEl = $('.animate-element').toArray();
		$.each($animateEl, function(index, val) {
			 $(val).addClass('animated ' + $(val).data('animation'));
		});

		$(".tus-scroll").mCustomScrollbar({
			axis:"y", // vertical and horizontal scrollbar
			theme:"dark"
		});

		if (!Modernizr.touch) {
			setTimeout(function() {
				$('.animation-text-div').waypoint(function() {
				 	$(this).addClass('animate-it');
				}, { offset: '40%' });
				$('.great-elements').waypoint(function() {
				 	$(this).addClass('animate-it');
				}, { offset: '40%' });
				$('.schedule-holder').waypoint(function() {
				 	$(this).addClass('animate-it');
				}, { offset: '70%' });
				$('.element-animate').waypoint(function() {
					var animationType = $(this).data('animation');
				 	$(this).addClass('animated ' + animationType);
				}, { offset: '70%' });
				$('.adittional-tissue-text').waypoint(function() {
				 	$(this).addClass('animate-images');
				}, { offset: '70%' });
			}, 50);

			setTimeout(function() {
				$('.animation-about-food').waypoint(function() {
				 	$(this).addClass('animate-about');
				}, { offset: '70%' });
			}, 1000);
		}

	});

	var $testimonialClients = $('.clients-speaks-slider');
	if ($testimonialClients.length > 0) {
		$testimonialClients.slick({
			infinite       : false,
			slidesToShow   : 1,
			slidesToScroll : 1,
			dots           : false,
			arrows          : false
		})
	}

	var $ourGallerySlider = $('.our-gallery-slider');
	if ($ourGallerySlider.length > 0) {
		$ourGallerySlider.slick({
			infinite       : false,
			slidesToShow   : 1,
			slidesToScroll : 1,
		})
	}

	var $bigPoppa = $('.gallery-big-pappa');
	if ($bigPoppa.length > 0) {
		$bigPoppa.slick({
		    slidesToShow: 1,
		    slidesToScroll: 1,
		    infinite: false,
		    arrows: false,
		    fade: true,
		    asNavFor: '.gallery-thumb-pappa'
		});
		$('.gallery-thumb-pappa').slick({
		    slidesToShow: 4,
		    slidesToScroll: 2,
		    infinite: false,
		    asNavFor: '.gallery-big-pappa',
		    dots: true,
		    focusOnSelect: true
		});
	}




	var $dishesSlider = $('.best-dishes');
	if ($dishesSlider.length > 0) {
		$dishesSlider.slick({
			infinite       : false,
			slidesToShow   : 4,
			slidesToScroll : 2,
			responsive: [
			    {
			      breakpoint: 1200,
			      settings: {
			        slidesToShow: 3,
			        slidesToScroll: 2,
			      }
			    },
			    {
			      breakpoint: 993,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 2
			      }
			    },
			    {
			      breakpoint: 650,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			]
		})
	}

	var $greatDishes = $('.great-dishes');
	if ($greatDishes.length > 0) {
		$greatDishes.slick({
			infinite       : false,
			slidesToShow   : 1,
			slidesToScroll : 1
		})
	}

	var $memberSlider = $('.team-members-slides');
	if ($memberSlider.length > 0) {
		$memberSlider.slick({
			infinite       : false,
			slidesToShow   : 3,
			slidesToScroll : 3,
			responsive: [
			    {
			      breakpoint: 1200,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1,
			      }
			    },
			    {
			      breakpoint: 993,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			]
		})
	}

	$('#open-canvas, #close-canvas').on('click', function(event) {
		event.preventDefault();
		$('.mobile-nav').toggleClass('open-menu');
	});

	$('.scroll-down').on('click', function(event) {
		event.preventDefault();
		$("html, body").animate({ scrollTop: $('.video-fix').height() + $('.tuscany-header').outerHeight() }, 1000);
	});

	$('.scroll-place').on('click', function(event) {
		event.preventDefault();
		$("html, body").animate({ scrollTop: $('#rev_slider_1_1_wrapper').height() + $('.tuscany-header').outerHeight() }, 1000);
	});

	var $newsSlider = $('.news-slider');
	if ($newsSlider.length > 0) {
		$newsSlider.slick({
			infinite       : true,
			slidesToShow   : 4,
			slidesToScroll : 2,
			arrows         : false,
			dots           : false,
			responsive: [
			    {
			      breakpoint: 993,
			      settings: {
			        slidesToShow: 3,
			        slidesToScroll: 2
			      }
			    },
			    {
			      breakpoint: 767,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1
			      }
			    },
			    {
			      breakpoint: 600,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			]
		})
	}

	var $gallerySlide = $('.gallery-slider');
	if ($gallerySlide.length > 0) {
		$gallerySlide.slick({
			infinite       : true,
			slidesToShow   : 4,
			slidesToScroll : 2,
			responsive: [
			    {
			      breakpoint: 993,
			      settings: {
			        slidesToShow: 3,
			        slidesToScroll: 2
			      }
			    },
			    {
			      breakpoint: 767,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1
			      }
			    },
			    {
			      breakpoint: 600,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			]
		})
	}

	var $latestSlider = $('.latest-slider');
	if ($latestSlider.length > 0) {
		$latestSlider.slick({
			infinite       : false,
			slidesToShow   : 3,
			slidesToScroll : 3,
			responsive: [
			    {
			      breakpoint: 1050,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 2
			      }
			    },
			    {
			      breakpoint: 700,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			]
		})
	}

	$('.custom-menu-nav-news a').click(function(event) {
		event.preventDefault();
		var dir = $(this).data('dir');
		if (dir == 'next') {
			$gallerySlide.slickNext();
			$newsSlider.slickNext();
		} else {
			$gallerySlide.slickPrev();
			$newsSlider.slickPrev();
		}
	});

	var $testimonialSlider = $('.testimonial-content');
	if ($testimonialSlider.length > 0) {
		$testimonialSlider.slick({
			infinite       : true,
			vertical       : true,
			slidesToShow   : 1,
			slidesToScroll : 1,
			arrows         : false,
			dots           : false,
		})
	}

	$('.nav-arrows a, .testimonials-nav-arrows a').click(function(event) {
		event.preventDefault();
		var dir = $(this).data('dir');
		if (dir == 'down') {
			$testimonialSlider.slickNext();
		} else {
			$testimonialSlider.slickPrev();
		}
	});

	var $menuSlider = $('.menu-slides');
	if ($menuSlider.length > 0) {
		$menuSlider.slick({
			infinite       : true,
			slidesToShow   : 3,
			slidesToScroll : 2,
			arrows         : false,
			dots           : false,
			responsive: [
			    {
			      breakpoint: 1200,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 1,
			      }
			    },
			    {
			      breakpoint: 993,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			]
		})
	}
	$('.custom-menu-nav-1 a').click(function(event) {
		event.preventDefault();
		var dir = $(this).data('dir');
		if (dir == 'next') {
			$('.menu-slides-1').slickNext();
		} else {
			$('.menu-slides-1').slickPrev();
		}
	});
	$('.custom-menu-nav-2 a').click(function(event) {
		event.preventDefault();
		var dir = $(this).data('dir');
		if (dir == 'next') {
			$('.menu-slides-2').slickNext();
		} else {
			$('.menu-slides-2').slickPrev();
		}
	});
	$('.custom-menu-nav-3 a').click(function(event) {
		event.preventDefault();
		var dir = $(this).data('dir');
		if (dir == 'next') {
			$('.menu-slides-3').slickNext();
		} else {
			$('.menu-slides-3').slickPrev();
		}
	});

})(jQuery);
