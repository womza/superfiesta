<?php global $tuscany_opt, $woocommerce;
if (isset($tuscany_opt['tuscany-logo'])) {
    $logo_url = $tuscany_opt['tuscany-logo-ribbon']['url'];
}
?>

<script>
    (function($) {
        $(document).ready(function() {
            $('.ribbon-wrapp').find('.logo-holder a').html('<img src="<?php echo esc_url($logo_url); ?>" alt="Logo" />');
        });
    })(jQuery);
</script>

<!-- Additional header -->
<div class="additionals-head tuscany-two hidden-sm">
    <?php if (!empty($socials[0]['title'])): ?>
        <ul>
            <?php foreach ($socials as $social => $icon): ?>
                <li><a href="<?php echo esc_url($icon['url']); ?>" target="_blank" title="<?php echo esc_attr($icon['title']); ?>" class="fa <?php echo esc_attr($icon['description']); ?>"></a></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
    <?php if (class_exists('woocommerce')): ?>
        <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="shopping-link fa fa-shopping-cart"></a>
    <?php endif ?>
</div>
<!-- End Additional Header -->

<!-- Navigation -->
<div class="sizable-div">
    <div class="track-nav">
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="ribbon-wrapp">
                    <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        // User has assigned menu to this location;
                        // output it
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'nav',
                            'container'      => '',
                            'items_wrap'     => '<ul class="hidden-sm hidden-xs">%3$s</ul>',
                        ) );
                    } else {
                        echo '<ul class="tuscany-nav iconic-nav">
                                <li><a href="'.admin_url().'nav-menus.php">Create your Menu</a></li>
                            </ul>';
                    }
                    ?>
                    <div class="button-mobile-nav visible-sm visible-xs">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ribon-logo-small.png" height="95" width="150" alt="Logo ">
                        <button id="open-canvas"><i class="fa fa-list"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Navigation -->

<script type="text/javascript">
    (function($) {
        $(window).load(function() {
            var $logoHolder = $('.logo-holder');
                if ($(window).width() > 1237) {
                    var logoW = $logoHolder.find('img:first-child').width();
                } else {
                    var logoW = $logoHolder.find('img:last-child').width();
                }
            $logoHolder.css({
                width: logoW
            });
        });
    })(jQuery);
</script>