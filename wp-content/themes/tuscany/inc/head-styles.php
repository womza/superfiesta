<?php
function tuscany_head_stuff() {
	global $tuscany_opt;

	if (isset($tuscany_opt['tuscany-woody-texture'])) {
		$woody_bg = $tuscany_opt['tuscany-woody-texture']['url'];
	}

	echo "<style>";
	if (!empty($woody_bg)) {
		echo '.page-template-templatesevents-php, .page-template-templatesgallery-php, .single-our-gallery { background-image: url('.esc_url($woody_bg).');}';
	}
	echo "</style>";
}
add_filter('wp_head', 'tuscany_head_stuff');