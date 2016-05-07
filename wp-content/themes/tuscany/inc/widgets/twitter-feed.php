<?php

function tuscany_twitter_feed() {
	register_widget('tuscany_feeds');
}

add_action('widgets_init', 'tuscany_twitter_feed');

class tuscany_feeds extends WP_Widget {

/* Widget setup. */

function tuscany_feeds() {
	$widget_ops = array('classname' => 'tuscany_feeds', 'description' => __('A widget that displays latest twitter feed.', THEME_NAME) );
	$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'tuscany_feeds');
	$this->WP_Widget( 'tuscany_feeds', __('Tuscany - Twitter Feed', THEME_NAME), $widget_ops, $control_ops);
}

/* Display the widget on the screen. */

function widget($args, $instance) {
	extract($args);
	$title = apply_filters('widget_title', $instance['title'] );
	$feeds = $instance['feeds'];
	$username = $instance['username'];

	echo $before_widget;

	if($title) { echo $before_title . $title . $after_title; } ?>

	<?php
		$args = array(
		"include_rts" => false,
		"exclude_replies" => true);
	  $tweets = getTweets(intval($feeds), $username, $args);
	  if (is_array($tweets)) {
	  	echo "<ul>";
	  	foreach ($tweets as $tweet) {
	  		$the_tweet = $tweet['text'];
	  		if(is_array($tweet['entities']['urls'])){
	  		    foreach($tweet['entities']['urls'] as $key => $link){
	  		        $the_tweet = preg_replace(
	  		            '`'.$link['url'].'`',
	  		            '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
	  		            $the_tweet)."<div>".date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours'))."</div>";
	  		    }
	  		}

	  		echo "<li class='tweet-feed'>".$the_tweet."</li>";
	  	}
	  	echo "</ul>";
	  }
	?>
<?php echo $after_widget; }

/* Update the widget settings. */

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title']    = $new_instance['title'];
	$instance['feeds']    = $new_instance['feeds'];
	$instance['username'] = $new_instance['username'];
	return $instance;
}

function form($instance) {
	$defaults = array('title' => 'Twitter Feed', 'feeds' => 5, 'username' => 'smashingmag');
	$instance = wp_parse_args((array) $instance, $defaults); ?>

	<!-- Widget title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Widget Username Twitter: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:', THEME_NAME) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" />
	</p>

	<!-- Number of posts: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id('feeds'); ?>"><?php _e('Number of Feeds:', THEME_NAME) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('feeds'); ?>" name="<?php echo $this->get_field_name('feeds'); ?>" value="<?php echo $instance['feeds']; ?>" />
	</p>

<?php } } ?>