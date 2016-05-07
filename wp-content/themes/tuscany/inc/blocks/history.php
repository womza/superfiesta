<?php global $tuscany_opt;
	if (isset($tuscany_opt['tuscany-history'])) {
		$history_events = $tuscany_opt['tuscany-history'];
	}
	if (isset($tuscany_opt['tuscany-history-images'])) {
		$history_gallery = $tuscany_opt['tuscany-history-images'];
	}
	if (isset($tuscany_opt['tuscany-history-title'])) {
		$block_title = $tuscany_opt['tuscany-history-title'];
	}
?>

<!-- Our History -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title text-center">
        <div class="divider"></div>
        <?php if (!empty($block_title)): ?>
            <div class="title-wrapp">
                <div>
                    <h2><?php echo $block_title; ?></h2>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<div class="container history-gallery">
    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
        <div class="history-wrapp">
            <?php if (!empty($history_events[0]['title'])): ?>
            	<?php foreach ($history_events as $event):
            	?>
            		<div class="history-holder element-animate" data-animation="fadeInUp">
            		    <?php if (!empty($event['attachment_id'])): ?>
            		    	<div>
            		    	    <?php echo wp_get_attachment_image( $event['attachment_id'], 'attachment-round', false, array( 'class' => 'img-circle' ) ); ?>
            		    	</div>
            		    <?php endif ?>
            		    <div>
            		        <h3><?php echo $event['title']; ?></h3>
            		        <p><?php echo $event['description']; ?></p>
            		    </div>
            		</div>
            	<?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 alpha">
        <div class="history-images clearfix">
            <?php if (isset($tuscany_opt['tuscany-history-images'])) {
                $gallery = explode(',', $tuscany_opt['tuscany-history-images']);
                $counter = 1;
                foreach ($gallery as $images => $image) {
                    $image_url = wp_get_attachment_image_src($image, 'full');

                    if ($counter == 1) {
                    	echo '<a href="'.esc_url($image_url[0]).'" rel="prettyPhoto[gallery]">
                    	        '.wp_get_attachment_image( $image, 'global', false, array( 'class' => 'img-responsive' ) ).'
                    	        <span><i class="fa fa-search"></i></span>
                    	    </a>';
                    } else {
                    	echo '<a href="'.esc_url($image_url[0]).'" rel="prettyPhoto[gallery]">
                    	        '.wp_get_attachment_image( $image, 'vertical', false, array( 'class' => 'img-responsive' ) ).'
                    	        <span><i class="fa fa-search"></i></span>
                    	    </a>';
                    }

                $counter++; }
            } ?>
        </div>
    </div>
</div>
<!-- End Our History -->