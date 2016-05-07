<?php

function tuscany_insta_feed() {
	register_widget('insta_tuscany');
}

add_action('widgets_init', 'tuscany_insta_feed');

class insta_tuscany extends WP_Widget {

/* Widget setup. */

function insta_tuscany() {
	$widget_ops = array('classname' => 'insta_tuscany', 'description' => __('A widget that displays latest instagram feed.', THEME_NAME) );
	$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'insta_tuscany');
	$this->WP_Widget( 'insta_tuscany', __('Tuscany - Instagram Feed', THEME_NAME), $widget_ops, $control_ops);
}

/* Display the widget on the screen. */

function widget($args, $instance) {
	extract($args);
	$title = apply_filters('widget_title', $instance['title'] );
	$username = $instance['username'];

	echo $before_widget;

	if($title) { echo $before_title . $title . $after_title; } ?>

	<!-- Content -->
	<div id="instafeed" class="clearfix"></div>

	<?php
	wp_enqueue_script( 'tuscany-instagram', THEME_URI . '/js/min/instafeed.min.js', array(), '1.0', true );
	?>

	<script type="text/javascript">
	    (function($) {
	    	$(document).ready(function() {
	    		var feed = new Instafeed({
	    		    get: 'tagged',
	    		    tagName: '<?php echo $username; ?>',
	    		    limit: 12,
	    		    accessToken: '1068835781.467ede5.bed6906b0d4f43279648a2d6bf6c7b0d',
	    		    template: '<div class="feed_img"><a href="{{link}}" target="_blank"><span><i class="fa fa-search"></i></span><img src="{{image}}" /></a></div>'
	    		});
	    		feed.run();
	    	});
	    })(jQuery);
	</script>
	
<?php echo $after_widget; }

/* Update the widget settings. */

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title']    = $new_instance['title'];
	$instance['token']    = $new_instance['token'];
	$instance['username'] = $new_instance['username'];
	return $instance;
}

function form($instance) {
	$defaults = array('title' => 'Instagram', 'username' => 'smashingmag', 'token' => '1068835781.467ede5.bed6906b0d4f43279648a2d6bf6c7b0d');
	$instance = wp_parse_args((array) $instance, $defaults); ?>

	<!-- Widget title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Widget Username Twitter: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Tag Name:', THEME_NAME) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" />
	</p>

	<!-- Widget Username Twitter: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('token'); ?>"><?php _e('Access Token:', THEME_NAME) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('token'); ?>" name="<?php echo $this->get_field_name('token'); ?>" value="<?php echo $instance['token']; ?>" />
	</p>

<?php } } ?>