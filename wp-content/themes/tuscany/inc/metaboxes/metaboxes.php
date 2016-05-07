<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Repeatable Field Groups
	 */
	$meta_boxes['member_socials'] = array(
		'id'         => 'member_socials',
		'title'      => __( 'Member Socials', 'cmb' ),
		'pages'      => array( 'our-team', ),
		'fields'     => array(
			array(
				'name' => __( 'PNG Member Image - Circled', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL of PNG Image.', 'cmb' ),
				'id'   => $prefix . 'png_image',
				'type' => 'file',
			),
			array(
				'name' => __( 'PNG Member Image - Tall', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL of PNG Image.', 'cmb' ),
				'id'   => $prefix . 'png_image_two',
				'type' => 'file',
			),
			array(
				'name' => __( 'Slider Bubble', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL of PNG Image. NOTE: Image size must be 135x117 !!', 'cmb' ),
				'id'   => $prefix . 'bubble_png',
				'type' => 'file',
			),
			array(
				'id'          => $prefix . 'social',
				'type'        => 'group',
				'description' => __( 'Create Member Social Icon', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Social Icon {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Social Icon', 'cmb' ),
					'remove_button' => __( 'Remove Social Icon', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Social Media Name',
						'id'   => 'icon_title',
						'type' => 'text'
					),
					array(
						'name' => 'Icon Class',
						'id'   => 'icon_class',
						'description' => 'Click <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">HERE</a> and choose your icon and paste its class in correct field!',
						'type' => 'text'
					),
					array(
						'name' => 'URL',
						'id'   => 'icon_url',
						'type' => 'text'
					)
				),
			)
		),
	);

	/**
	 * Add MetaBoxes to Page Template Contact
	 */
	$meta_boxes['contact_template_metaboxes'] = array(
		'id'         => 'contact_template_metaboxes',
		'title'      => __( 'Template Additional Fields', 'cmb' ),
		'pages'      => array( 'page' ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/contact.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => 'Contact Form Shortcode',
				'id'   => $prefix.'form-shortcode',
				'type' => 'text'
			),
			array(
				'name' => __( 'Marker Image', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL.', 'cmb' ),
				'id'   => $prefix . 'marker_image',
				'type' => 'file',
			),
			array(
				'name' => 'Map Zoom Level',
				'id'   => $prefix . 'map_zoom',
				'desc' => 'Enter number between 0 and 15 for zoom level',
				'default' => 14,
				'type' => 'text',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			),
			array(
				'name' => 'Map Style',
				'id'   => $prefix . 'map_style',
				'desc' => 'Choose your map style from <a href="https://snazzymaps.com/" target="_blank">HERE</a>. Click on the map you like, click COPY and paste content here!',
				'default' => "",
				'type' => 'textarea',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			),
		),
	);

	/**
	 * Add MetaBoxes to Page Template Contact
	 */
	$meta_boxes['reservations_meta_boxes'] = array(
		'id'         => 'reservations_meta_boxes',
		'title'      => __( 'Additional Fields', 'cmb' ),
		'pages'      => array( 'page' ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/reservations.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => 'Reservation Form Shortcode',
				'id'   => $prefix.'reservation-shortcode',
				'type' => 'text'
			)
		),
	);

	$meta_boxes['contact_reservation_fields'] = array(
		'id'         => 'contact_reservation_fields',
		'title'      => __( 'Additional Fields', 'cmb' ),
		'pages'      => array( 'page' ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => array('templates/contact.php', 'templates/reservations.php') ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( 'Use Food Images', 'cmb' ),
				'desc'    => __( 'Check if you want images around content wrapper.', 'cmb' ),
				'id'      => $prefix . 'food-check',
				'type'    => 'checkbox'
			),
			array(
				'name'         => __( 'Upload Images', 'cmb' ),
				'desc'         => __( 'If above field is checked, upload your images here!', 'cmb' ),
				'id'           => $prefix . 'food-images',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			array(
				'name' => __( 'Staff One', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL of PNG Image!', 'cmb' ),
				'id'   => $prefix . 'contact_staff_one',
				'type' => 'file',
			),
			array(
				'name' => __( 'Staff Two', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL of PNG Image!', 'cmb' ),
				'id'   => $prefix . 'contact_staff_two',
				'type' => 'file',
			),
		),
	);

	/**
	 * Add MetaBoxes to Page Template Contact
	 */
	$meta_boxes['testimonials_boxes'] = array(
		'id'         => 'testimonials_boxes',
		'title'      => __( 'Additional Fields', 'cmb' ),
		'pages'      => array( 'testimonials' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Testimonial Slider Image', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL.', 'cmb' ),
				'id'   => $prefix . 'testimonial_slider_img',
				'type' => 'file',
			),
		),
	);

	/**
	 * Add MetaBoxes to Page Template Contact
	 */
	$meta_boxes['events_meta_boxes'] = array(
		'id'         => 'events_meta_boxes',
		'title'      => __( 'Event Date', 'cmb' ),
		'pages'      => array( 'our-events' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => 'Enter Date eg. 12th January 2014',
				'id'   => $prefix . 'event_date',
				'type' => 'text',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			),
		),
	);

	/**
	 * Add MetaBoxes to Page Template Contact
	 */
	$meta_boxes['gallery_meta_boxes'] = array(
		'id'         => 'gallery_meta_boxes',
		'title'      => __( 'Additional Fields', 'cmb' ),
		'pages'      => array( 'our-gallery' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( 'Single Page Layout', 'cmb' ),
				'id'      => $prefix . 'single_page_layout',
				'type'    => 'radio_inline',
				'desc'         => __( 'To use VIDEO as your gallery, you need to check it and install some of video gallery wordpress plugins. After installation, create a gallery and paste its shortcode in content field! Video Gallery Plugin Link - Click <a href="https://wordpress.org/plugins/gallery-video/" target="_blank">HERE</a>', 'cmb' ),
				'options' => array(
					'slider'      => __( 'Slider', 'cmb' ),
					'shadowboxed' => __( 'Shadowboxed', 'cmb' ),
					'video' => __( 'Video', 'cmb' ),
				),
				'default' => 'slider'
			),
			array(
				'name'         => __( 'Gallery Images', 'cmb' ),
				'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb' ),
				'id'           => $prefix . 'gallery_images',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
		),
	);

	/**
	 * Repeatable Field Groups
	 */
	$meta_boxes['field_group'] = array(
		'id'         => 'field_group',
		'title'      => __( 'Generate Map Markers', 'cmb' ),
		'pages'      => array( 'page' ),
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/contact.php' ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'marker_locations',
				'type'        => 'group',
				'description' => __( 'Generate Marker Location PS. Get Latitude & Longitude by clicking <a href="http://itouchmap.com/latlong.html" target="_blank">HERE</a>', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Marker {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Marker', 'cmb' ),
					'remove_button' => __( 'Remove Marker', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Place Name',
						'id'   => 'place_name',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					array(
						'name' => 'Latitude',
						'id'   => 'marker_latitude',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					array(
						'name' => 'Longitude',
						'id'   => 'marker_longitude',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
				),
			),
		),
	);

	$meta_boxes['meta_boxes_gallery'] = array(
		'id'         => 'meta_boxes_gallery',
		'title'      => __( 'Additional Fields', 'cmb' ),
		'pages'      => array( 'page' ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/gallery.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( 'Layout Gallery Type', 'cmb' ),
				'id'      => $prefix . 'gallery_layout_type',
				'type'    => 'radio_inline',
				'options' => array(
					'slider'    => __( 'Gallery Slider', 'cmb' ),
					'paginated' => __( 'Paginated Gallery', 'cmb' ),
				),
				'default' => 'slider'
			),
		),
	);

	/**
	 * Add MetaBoxes to Page Template Contact
	 */
	$meta_boxes['about_template_boxes'] = array(
		'id'         => 'about_template_boxes',
		'title'      => __( 'Additional Template Fields', 'cmb' ),
		'pages'      => array( 'page' ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/about.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( 'Use Food Images', 'cmb' ),
				'desc'    => __( 'Check if you want images around content wrapper.', 'cmb' ),
				'id'      => $prefix . 'staff-check',
				'type'    => 'checkbox',
			),
			array(
				'name'         => __( 'Upload Images', 'cmb' ),
				'desc'         => __( 'If above field is checked, upload your images here!', 'cmb' ),
				'id'           => $prefix . 'staff-images',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			array(
				'name' => __( 'Staff One', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL of PNG Image!', 'cmb' ),
				'id'   => $prefix . 'about_staff_one',
				'type' => 'file',
			),
			array(
				'name' => __( 'Staff Two', 'cmb' ),
				'desc' => __( 'Upload an image or enter a URL of PNG Image!', 'cmb' ),
				'id'   => $prefix . 'about_staff_two',
				'type' => 'file',
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
