<?php global $tuscany_opt, $woocommerce;
if (isset($tuscany_opt['tuscany-socials'])) {
    $socials = $tuscany_opt['tuscany-socials'];
}
if (isset($tuscany_opt['tuscany-logo'])) {
    $logo_url = $tuscany_opt['tuscany-logo-light']['url'];
}
?>

<script>
    (function($) {
        $(document).ready(function() {
            $('.tuscany-nav.tuscany-two').find('.logo-holder a').html('<img src="<?php echo $logo_url; ?>" alt="Logo" />');
            var linksArray = $('.tuscany-nav.tuscany-two').find('> li:not(.logo-holder) > a').toArray();
            $.each(linksArray, function(index, val) {
                $this = $(val);
                $this.prepend('<span></span>');
            });
        });
    })(jQuery);
</script>

<!-- Header -->
<header class="tuscany-header tuscany-two">
    <div class="additionals-head tuscany-two">
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
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="mobile-section tuscany-two">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo $logo_url; ?>" alt="Tuscany Logo">
                </a>
                <a href="#" id="open-canvas" class="fa fa-list"></a>
            </div>
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                // User has assigned menu to this location;
                // output it
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav',
                    'container'      => '',
                    'items_wrap'     => '<ul class="tuscany-nav tuscany-two">%3$s</ul>',
                ) );
            } else {
                echo '<ul class="tuscany-nav tuscany-two">
                        <li><a href="'.admin_url().'nav-menus.php">Create your Menu</a></li>
                    </ul>';
            }
            ?>
        </div>
    </div>
</header>
<!-- End Header -->