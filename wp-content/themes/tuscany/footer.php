<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Tuscany
 */
global $tuscany_opt;

if (isset($tuscany_opt['tuscany-footer-address'])) {
    $footer_address = $tuscany_opt['tuscany-footer-address'];
}
if (isset($tuscany_opt['tuscany-footer-phone'])) {
    $footer_number  = $tuscany_opt['tuscany-footer-phone'];
}
if (isset($tuscany_opt['tuscany-footer-about'])) {
    $about_column  = $tuscany_opt['tuscany-footer-about'];
}
if (isset($tuscany_opt['footer-form-shortcode'])) {
    $form_shortcode  = $tuscany_opt['footer-form-shortcode'];
}
if (isset($tuscany_opt['tuscany-footer-info'])) {
    $more_info  = $tuscany_opt['tuscany-footer-info'];
}
if (isset($tuscany_opt['tuscany-footer-image'])) {
    $texture  = $tuscany_opt['tuscany-footer-image']['url'];
}
if (isset($tuscany_opt['tuscany-footer-copyright'])) {
    $copyright  = $tuscany_opt['tuscany-footer-copyright'];
}
?>

<a href="#" class="goTop"></a>

<!-- Footer -->
<footer class="tuscany-footer top-divide" <?php echo (!empty($texture)) ? 'style="background-image: url('.esc_url($texture).');"' : ''; ?>>
    <?php if (!empty($footer_address) && !empty($footer_number)): ?>
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="contact-infos">
                    <div>
                        <i class="fa fa-phone"></i> &nbsp;&nbsp;
                        <?php echo $footer_number; ?>
                    </div>
                    <div>
                        <i class="fa fa-map-marker"></i> &nbsp;&nbsp;
                        <?php echo $footer_address; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="container additional-contact-fields">
        <?php if (is_active_sidebar( 'footer-widgets' )): ?>
            <?php dynamic_sidebar( 'footer-widgets' ); ?>
        <?php else: ?>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 info-holder has-border">
                <div>
                    <?php if (class_exists('WPCF7_ContactForm') && isset($tuscany_opt['footer-form-shortcode'])): ?>
                        <?php echo do_shortcode($form_shortcode); ?>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 info-holder has-border">
                <?php if (!empty($about_column)): ?>
                    <div>
                        <?php echo $about_column; ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 info-holder">
                <div>
                    <?php if (!empty($more_info)): ?>
                        <?php echo $more_info; ?>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</footer>
<!-- End Footer -->

<div class="copyright-tuscany">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <?php if (!empty($copyright)): ?>
            <?php echo $copyright; ?>
        <?php endif ?>
        </div>
    </div>
</div>

<?php if ($tuscany_opt['tuscany-animations']): ?>
    <script type="text/javascript">
        (function($) {
            $('.element-animate').removeClass('element-animate');
        })(jQuery);
    </script>
<?php endif ?>

<?php wp_footer(); ?>

</body>
</html>
