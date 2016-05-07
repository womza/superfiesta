<?php global $tuscany_opt;
    $block_title = $tuscany_opt['tuscany-latest-news'];
?>

<!-- Latest News -->
<div class="container top-divide">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tuscany-title">
        <div class="divider"></div>
        <?php if (!empty($block_title)): ?>
            <div class="title-wrapp">
                <div>
                    <h2><?php echo $block_title; ?></h2>
                </div>
            </div>
        <?php endif ?>
        <div class="custom-menu-nav-news custom-menu-nav">
            <a href="#" data-dir="prev" class="fa fa-chevron-left"></a>
            <a href="#" data-dir="next" class="fa fa-chevron-right"></a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alpha">
        <div class="latest-news-wrapper news-slider top-divide">
            <?php
               $args = array( 'post_type' => 'post', 'posts_per_page' => 10 );
               $loop = new WP_Query( $args );
               if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div>
                    <?php if (has_post_thumbnail()) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('slider-img', array('class' => 'img-responsive')); ?>
                        </a>
                    <?php } else {
                        echo '<img class="img-responsive" src="https://api.fnkr.net/testimg/500x300/150d05/FFF/?text=img+placeholder" alt="image">';
                    } ?>
                    <div class="new-holder">
                        <div class="news-content">
                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <?php the_excerpt(); ?>
                            <span class="date-holder"><?php the_time('d.m.Y'); ?></span>
                        </div>
                        <div class="author-holder">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 85 ); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; else: ?>
                <div>
                    <p><?php _e('You dont have any posts.', THEME_NAME); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- End Latest News -->