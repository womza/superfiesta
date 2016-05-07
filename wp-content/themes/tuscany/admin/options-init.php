<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('tuscany_Redux_Framework_config')) {

    class tuscany_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'tuscany-options'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'tuscany-options'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'tuscany-options'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'tuscany-options'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'tuscany-options'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'tuscany-options') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'tuscany-options'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            $this->sections[] = array(
                'title'     => __('Customization Settings', 'tuscany-options'),
                'desc'      => __('Here you can change your theme settings', 'tuscany-options'),
                'icon'      => 'el-icon-css',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'        => 'custom-styles-tuscany',
                        'type'      => 'ace_editor',
                        'title'     => __('CSS Code', 'tuscany-options'),
                        'subtitle'  => __('Paste your CSS code here.', 'tuscany-options'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'desc'      => 'Enter custom CSS code',
                        'default'   => "#yourselector{\nmargin: 0 auto;\n}"
                    ),
                    array(
                        'id'        => 'tuscany-theme-color',
                        'type'      => 'color',
                        'output'    => array('.menu-wrapper .slick-slide h3 a:hover,.testimonials-wrapp .nav-arrows a:hover,.latest-news-wrapper .news-content h1 a:hover, .schedule-wrapp .schedule-time p span, label:hover, .btn-tuscany-submit:hover,.copyright-tuscany a:hover,.custom-menu-nav a:hover,.tuscany-nav li a:hover,a,a:hover, a:focus,#mybook ul li a:hover,.testimonials-nav-arrows a:hover,.menu-slides.best-dishes h3 a:hover,.circled-member ul li a:hover,.author-holder > a:hover,.pagination li a:hover,.footer-widget a:hover, .widget ul li a:hover,.footer-widget a:hover,.post-meta > div a:hover,code'),
                        'title'     => __('Theme Color', 'tuscany-options'),
                        'subtitle'  => __('Pick a color for the theme (default: #f99d28).', 'tuscany-options'),
                        'default'   => '#f99d28',
                        'validate'  => 'color',
                    ),
                    array(
                            'id'                    => 'tuscany-theme-background-color',
                            'type'                  => 'background',
                            'output'                => array('.additionals-head ul li a:hover,.add-banner .pricing-tag,.main-about-circle:before,.product-holder .price,.tuscany-nav li a span,.pagination li span, .pagination li a,.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover,.woocommerce span.onsale, .woocommerce-page span.onsale'),
                            'background-image'      => false,
                            'background-repeat'     => false,
                            'background-attachment' => false,
                            'background-position'   => false,
                            'background-image'      => false,
                            'background-size'       => false,
                            'transparent'           => false,
                            'preview'               => false,
                            'title'                 => __('Theme Background Color', 'tuscany-options'),
                            'subtitle'              => __('Body background color. Change it if you want it!', 'tuscany-options'),
                            'default'               => array(
                            'background-color'      => '#f99d28',
                        )
                    ),
                    array(
                        'id'            => 'tuscany-global-paragraphs',
                        'type'          => 'typography',
                        'title'         => __('Typography - Global Paragraph Font', 'tuscany-options'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Typography option with each property can be called individually.', 'tuscany-options')
                    ),
                    array(
                        'id'            => 'tuscany-global-headings',
                        'type'          => 'typography',
                        'title'         => __('Typography - Global Headings Font', 'tuscany-options'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Typography option with each property can be called individually.', 'tuscany-options')
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'title'     => __('Home Settings', 'tuscany-options'),
                'desc'      => __('Here you can change your home settings', 'tuscany-options'),
                'icon'      => 'el-icon-home',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'    => 'tuscany-home-video',
                        'title' => 'Homepage Video',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-video-title',
                        'type'      => 'text',
                        'title'     => __('Title', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-video-intro-content',
                        'type'      => 'textarea',
                        'title'     => __('Intro Content', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-video-button-text',
                        'type'      => 'text',
                        'title'     => __('Button Text', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-video-vegies',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Vegies Icon', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload your theme icon.', 'tuscany-options'),
                        'subtitle'  => __('Image size must be 266x252 in pixels!!', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-video-format-mp4',
                        'type'      => 'text',
                        'title'     => __('Video Format URL - MP4', 'tuscany-options'),
                        'desc' => __('Upload video on your server and paste URL on enter existing one.', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-video-format-webm',
                        'type'      => 'text',
                        'title'     => __('Video Format URL - WEBM', 'tuscany-options'),
                        'desc' => __('Upload video on your server and paste URL on enter existing one.', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-video-format-ogv',
                        'type'      => 'text',
                        'title'     => __('Video Format URL - OGV', 'tuscany-options'),
                        'desc' => __('Upload video on your server and paste URL on enter existing one.', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-video-background',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Mobile Fallback Background Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload your image.', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                ),
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('Layout Manager', 'tuscany-options'),
                'subsection' => true,
                'fields'    => array(
                    array(
                        'id'        => 'home-main-manager',
                        'type'      => 'sorter',
                        'title'     => 'Homepage Main',
                        'desc'      => 'Organize how you want the layout to appear on the page',
                        'compiler'  => 'true',
                        'options'   => array(
                            'disabled'  => array(
                                'images-gallery'    => 'Images Slider',
                                'slider-animations' => 'Animations Products Slider',
                                'image-parallax'    => 'Parallax With Image',
                                'schedule-slider'     => 'RevSlider Scheduler',
                                'slider-woody'        => 'RevSlider Woody',
                                'testimonials-slider' => 'Testimonials Slider',
                                'history'             => 'History',
                                'latest-news-two'     => 'Latest News Two',
                                'how-we-started'      => 'How We Started',
                                'best-dishes'         => 'Best Dishes',
                                'counter'             => 'Counter',
                                'about-board'         => 'About Board',
                                'product-book'        => 'Products Book',
                                'parallax'            => 'Parallax',
                                'news-slider'         => 'News Slider',
                                'testimonials-two'    => 'Testimonials Two',
                                'gallery-slider'      => 'Gallery Slider',
                                'slider-dish'         => 'Bar Slider Dish',
                                'opening-images'      => 'Opening Time Two',
                                'team-slider'         => 'Team Slider',
                            ),
                            'enabled'   => array(
                                'big-product-revolution'   => 'RevSlider FullScreen',
                                'product-add'              => 'Advertising Product',
                                'about-content'            => 'About Content',
                                'small-product-revolution' => 'RevSlider Small',
                                'dish-slider'              => 'Dishes Slider',
                                'testimonials'             => 'Testimonials',
                                'latest-news'              => 'Latest News',
                                'gallery'                  => 'Gallery Block',
                                'opening'                  => 'Opening Time',
                            ),
                        ),
                    ),
                    array(
                        'id'        => 'home-video-manager',
                        'type'      => 'sorter',
                        'title'     => 'Homepage Video',
                        'desc'      => 'Organize how you want the layout to appear on the page',
                        'compiler'  => 'true',
                        'options'   => array(
                            'disabled'  => array(
                                'images-gallery'    => 'Images Slider',
                                'slider-animations' => 'Animations Products Slider',
                                'image-parallax'    => 'Parallax With Image',
                                'slider-woody'        => 'RevSlider Woody',
                                'schedule-slider'          => 'RevSlider Scheduler',
                                'testimonials-slider'      => 'Testimonials Slider',
                                'history'                  => 'History',
                                'latest-news-two'          => 'Latest News Two',
                                'how-we-started'           => 'How We Started',
                                'best-dishes'              => 'Best Dishes',
                                'counter'                  => 'Counter',
                                'big-product-revolution'   => 'RevSlider FullScreen',
                                'product-add'              => 'Advertising Product',
                                'about-content'            => 'About Content',
                                'small-product-revolution' => 'RevSlider Small',
                                'dish-slider'              => 'Dishes Slider',
                                'testimonials'             => 'Testimonials',
                                'latest-news'              => 'Latest News',
                                'gallery'                  => 'Gallery Block',
                                'opening'                  => 'Opening Time',
                            ),
                            'enabled'   => array(
                                'about-board'         => 'About Board',
                                'product-book'        => 'Products Book',
                                'team-slider'         => 'Team Slider',
                                'parallax'            => 'Parallax',
                                'news-slider'         => 'News Slider',
                                'testimonials-two'    => 'Testimonials Two',
                                'gallery-slider'      => 'Gallery Slider',
                                'slider-dish'         => 'Bar Slider Dish',
                                'opening-images'      => 'Opening Time Two',
                            ),
                        ),
                    ),
                    array(
                        'id'        => 'home-revolution-manager',
                        'type'      => 'sorter',
                        'title'     => 'Homepage Revolution',
                        'desc'      => 'Organize how you want the layout to appear on the page',
                        'compiler'  => 'true',
                        'options'   => array(
                            'disabled'  => array(
                                'images-gallery'    => 'Images Slider',
                                'slider-animations' => 'Animations Products Slider',
                                'image-parallax'    => 'Parallax With Image',
                                'slider-woody'        => 'RevSlider Woody',
                                'schedule-slider'          => 'RevSlider Scheduler',
                                'big-product-revolution'   => 'RevSlider FullScreen',
                                'product-add'              => 'Advertising Product',
                                'about-content'            => 'About Content',
                                'small-product-revolution' => 'RevSlider Small',
                                'dish-slider'              => 'Dishes Slider',
                                'testimonials'             => 'Testimonials',
                                'latest-news'              => 'Latest News',
                                'gallery'                  => 'Gallery Block',
                                'about-board'              => 'About Board',
                                'product-book'             => 'Products Book',
                                'team-slider'              => 'Team Slider',
                                'parallax'                 => 'Parallax',
                                'news-slider'              => 'News Slider',
                                'testimonials-two'         => 'Testimonials Two',
                                'gallery-slider'           => 'Gallery Slider',
                                'slider-dish'              => 'Bar Slider Dish',
                                'opening-images'           => 'Opening Time Two',
                            ),
                            'enabled'   => array(
                                'counter'                  => 'Counter',
                                'best-dishes'              => 'Best Dishes',
                                'how-we-started'           => 'How We Started',
                                'history'                  => 'History',
                                'testimonials-slider'      => 'Testimonials Slider',
                                'latest-news-two'          => 'Latest News Two',
                                'opening'                  => 'Opening Time',
                            ),
                        ),
                    ),
                    array(
                        'id'        => 'home-woody-manager',
                        'type'      => 'sorter',
                        'title'     => 'Homepage Woody',
                        'desc'      => 'Organize how you want the layout to appear on the page',
                        'compiler'  => 'true',
                        'options'   => array(
                            'disabled'  => array(
                                'schedule-slider'          => 'RevSlider Scheduler',
                                'big-product-revolution'   => 'RevSlider FullScreen',
                                'product-add'              => 'Advertising Product',
                                'about-content'            => 'About Content',
                                'small-product-revolution' => 'RevSlider Small',
                                'dish-slider'              => 'Dishes Slider',
                                'testimonials'             => 'Testimonials',
                                'latest-news'              => 'Latest News',
                                'gallery'                  => 'Gallery Block',
                                'about-board'              => 'About Board',
                                'product-book'             => 'Products Book',
                                'team-slider'              => 'Team Slider',
                                'parallax'                 => 'Parallax',
                                'testimonials-two'         => 'Testimonials Two',
                                'gallery-slider'           => 'Gallery Slider',
                                'slider-dish'              => 'Bar Slider Dish',
                                'counter'                  => 'Counter',
                                'best-dishes'              => 'Best Dishes',
                                'history'                  => 'History',
                                'testimonials-slider'      => 'Testimonials Slider',
                                'latest-news-two'          => 'Latest News Two',
                                'opening'                  => 'Opening Time',
                            ),
                            'enabled'   => array(
                                'slider-woody'             => 'RevSlider Woody',
                                'how-we-started'    => 'How We Started',
                                'slider-animations' => 'Animations Products Slider',
                                'image-parallax'    => 'Parallax With Image',
                                'news-slider'       => 'News Slider',
                                'images-gallery'    => 'Images Slider',
                                'opening-images'    => 'Opening Time Two',
                            ),
                        ),
                    ),
                )
            );

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('General Settings', 'tuscany-options'),
                'fields'    => array(
                    array(
                        'id'        => 'tuscany-socials',
                        'type'      => 'slides',
                        'title'     => __('Social Icons', 'tuscany-options'),
                        'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'tuscany-options'),
                        'desc'      => __('Click <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">HERE</a> and choose your icon and paste its class in correct field!', 'tuscany-options'),
                        'placeholder'   => array(
                            'title'         => __('This is a title', 'tuscany-options'),
                            'description'   => __('Icon Class', 'tuscany-options'),
                            'url'           => __('URL', 'tuscany-options'),
                        ),
                    ),
                    array(
                        'id'        => 'tuscany-woody-texture',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Woody Texture Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload your texture.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'google-anlytcs',
                        'type'      => 'textarea',
                        'title'     => __('Tracking Code', 'tuscany-options'),
                        'subtitle'  => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'tuscany-options'),
                        'validate'  => 'js',
                        'desc'      => 'Validate that it\'s javascript!',
                    ),
                    array(
                        'id'        => 'tuscany-animations',
                        'type'      => 'checkbox',
                        'title'     => __('Enable Animations', 'tuscany-options'),
                        'default'   => '1'// 1 = on | 0 = off
                    ),
                    array(
                        'id'        => 'tuscany-favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Favicon', 'theme-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Basic media uploader with disabled URL input field.', 'theme-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'theme-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                )
            );

            $this->sections[] = array(
                'title'     => __('Header Settings', 'tuscany-options'),
                'desc'      => __('Here you can change your header settings', 'tuscany-options'),
                'icon'      => 'el-icon-cogs',
                'subsection' => true,
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'        => 'tuscany-logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Logo', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload your theme logo.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-logo-light',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Logo Light', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload your theme logo.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-logo-ribbon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Logo Ribbon', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload your theme logo.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-header-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Texture', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload your header texture.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                ),
            );

            $this->sections[] = array(
                'title'     => __('Footer Settings', 'tuscany-options'),
                'desc'      => __('Here you can change your footer settings', 'tuscany-options'),
                'icon'      => 'el-icon-cogs',
                'subsection' => true,
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'    => 'tuscany-info-foot',
                        'title' => 'Footer Informations',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-footer-phone',
                        'type'      => 'text',
                        'title'     => __('Phone Number', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-footer-address',
                        'type'      => 'text',
                        'title'     => __('Address', 'tuscany-options')
                    ),
                    array(
                        'id'    => 'tuscany-info-footer',
                        'title' => 'Footer Content',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'footer-form-shortcode',
                        'type'      => 'text',
                        'title'     => __('Form Shortcode', 'tuscany-options'),
                        'desc'      => __('Create form via Contact Form 7 Plugin then paste form shortcode here!', 'tuscany-options'),
                    ),
                    array(
                        'id'        => 'tuscany-footer-about',
                        'type'      => 'textarea',
                        'title'     => __('About', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-footer-info',
                        'type'      => 'textarea',
                        'title'     => __('More Info', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-footer-image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Footer Texture Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload your image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-footer-copyright',
                        'type'      => 'textarea',
                        'title'     => __('Copyright', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                ),
            );

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon'      => 'el-icon-th',
                'title'     => __('Tuscany Blocks Settings', 'tuscany-options'),
                'fields'    => array(
                    array(
                        'id'    => 'info-latest-news',
                        'title' => 'Latest News',
                        'type'  => 'info'
                    ),
                    array(
                        'id'      => 'tuscany-latest-news',
                        'type'    => 'text',
                        'title'   => __('Title', 'tuscany-options'),
                        'default' => 'Latest News'
                    ),
                    array(
                        'id'    => 'info-gallery',
                        'title' => 'Gallery',
                        'type'  => 'info'
                    ),
                    array(
                        'id'      => 'tuscany-gallery-title',
                        'type'    => 'text',
                        'title'   => __('Title', 'tuscany-options'),
                        'default' => 'Gallery'
                    ),
                    array(
                        'id'        => 'tuscany-gallery-bg',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Background Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload background image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-gallery-images',
                        'type'      => 'gallery',
                        'title'     => __('Add/Edit Gallery', 'tuscany-options'),
                        'subtitle'  => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'tuscany-options'),
                        'desc'      => __('This is the description field, again good for additional info.', 'tuscany-options'),
                    ),
                    array(
                        'id'    => 'info-schedule',
                        'title' => 'Schedule',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-schedule-word',
                        'type'      => 'text',
                        'title'     => __('Circled Word', 'tuscany-options'),
                    ),
                    array(
                        'id'        => 'tuscany-working-days',
                        'type'      => 'text',
                        'title'     => __('Working Days', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-weekends',
                        'type'      => 'text',
                        'title'     => __('Weekends', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-quote-schedule',
                        'type'      => 'textarea',
                        'title'     => __('Quote', 'tuscany-options'),
                    ),
                    array(
                        'id'        => 'tuscany-schedule-images',
                        'type'      => 'gallery',
                        'title'     => __('Add/Edit Animated Vegies', 'tuscany-options'),
                        'subtitle'  => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'tuscany-options'),
                        'desc'      => __('This is the description field, again good for additional info.', 'tuscany-options'),
                    ),
                    array(
                        'id'    => 'info-image-parallax',
                        'title' => 'Image Parallax',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-parallax-bg',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Parallax Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload background image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-parallax-image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'    => 'tuscany-info-history',
                        'title' => 'History',
                        'type'  => 'info'
                    ),
                    array(
                        'id'      => 'tuscany-history-title',
                        'type'    => 'text',
                        'title'   => __('Title', 'tuscany-options'),
                        'default' => 'History'
                    ),
                    array(
                        'id'        => 'tuscany-history',
                        'type'      => 'slides',
                        'title'     => __('History Events', 'tuscany-options'),
                        'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'tuscany-options'),
                        'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'tuscany-options'),
                        'placeholder'   => array(
                            'title'         => __('This is a title', 'tuscany-options'),
                            'description'   => __('Description Here', 'tuscany-options'),
                            'url'           => __('unavailable', 'tuscany-options'),
                        ),
                    ),
                    array(
                        'id'        => 'tuscany-history-images',
                        'type'      => 'gallery',
                        'title'     => __('Add/Edit History Gallery', 'tuscany-options'),
                        'subtitle'  => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'tuscany-options'),
                        'desc'      => __('This is the description field, again good for additional info.', 'tuscany-options'),
                    ),
                    array(
                        'id'    => 'tuscany-info-blackboard',
                        'title' => 'Blackboard',
                        'type'  => 'info'
                    ),
                    array(
                        'id'      => 'tuscany-blackboard-title',
                        'type'    => 'text',
                        'title'   => __('Title', 'tuscany-options'),
                        'default' => 'our ingredients are fresh'
                    ),
                    array(
                        'id'        => 'tuscany-text-description-one',
                        'type'      => 'textarea',
                        'title'     => __('Left Board Content', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-text-description-two',
                        'type'      => 'textarea',
                        'title'     => __('Right Board Content', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-board-image-one',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-board-image-two',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-board-image-three',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-board-bg',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Background Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'    => 'tuscany-info-testimonials',
                        'title' => 'Testimonials',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-testimonials-bg',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Background Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-switch-image',
                        'type'      => 'switch',
                        'title'     => __('Use Testimonial Image', 'tuscany-options'),
                        'subtitle'  => __('Look, it\'s on!', 'tuscany-options'),
                        'default'   => true,
                    ),
                    array(
                        'id'    => 'tuscany-info-how-we-started',
                        'title' => 'How We Started',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-started-bg',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Background Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-corner-image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Corner Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-started-images',
                        'type'      => 'gallery',
                        'title'     => __('Add/Edit Animated Images', 'tuscany-options'),
                        'subtitle'  => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'tuscany-options'),
                        'desc'      => __('This is the description field, again good for additional info.', 'tuscany-options'),
                    ),
                    array(
                        'id'        => 'tuscany-started-images-two',
                        'type'      => 'gallery',
                        'title'     => __('Add/Edit Text Images', 'tuscany-options'),
                        'subtitle'  => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'tuscany-options'),
                        'desc'      => __('This is the description field, again good for additional info.', 'tuscany-options'),
                    ),
                    array(
                        'id'        => 'tuscany-started-content',
                        'type'      => 'textarea',
                        'title'     => __('Board Content', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-started-content-two',
                        'type'      => 'textarea',
                        'title'     => __('Board Content Two', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'    => 'tuscany-info-our-team',
                        'title' => 'Our Team',
                        'type'  => 'info'
                    ),
                    array(
                        'id'      => 'tuscany-team-title',
                        'type'    => 'text',
                        'title'   => __('Title', 'tuscany-options'),
                        'default' => 'Our Team'
                    ),
                    array(
                        'id'        => 'tuscany-team-wood-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Wood Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        'subtitle'  => __('Image size must be 301x93 in pixels !!', 'tuscany-options')
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'    => 'tuscany-info-counter',
                        'title' => 'Counter',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-counter',
                        'type'      => 'slides',
                        'title'     => __('Counters', 'tuscany-options'),
                        'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'tuscany-options'),
                        'desc'      => __('Insert Tuscany Counters', 'tuscany-options'),
                        'placeholder'   => array(
                            'title'         => __('Title', 'tuscany-options'),
                            'description'   => __('Count Number', 'tuscany-options'),
                            'url'           => __('Hexadecimal Counter Color Code', 'tuscany-options'),
                        ),
                    ),
                )
            );

            $this->sections[] = array(
                'title'     => __('About Additional Blocks', 'tuscany-options'),
                'desc'      => __('Additional content about your thing!', 'tuscany-options'),
                'icon'      => 'el-icon-idea',
                'subsection' => true,
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'    => 'tuscany-info-about-board',
                        'title' => 'About Board Table',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-big-table-background',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Background Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-big-table-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Big Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-about-content-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Content Image One', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image. Image size must be 341x323 in pixels !!', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-about-content-img-two',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Content Image Two', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image. Image size must be 217x149 in pixels !!', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-about-quote-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Quote Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-about-table-content-one',
                        'type'      => 'textarea',
                        'title'     => __('Content Main', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-about-table-content-two',
                        'type'      => 'textarea',
                        'title'     => __('Content Secondary', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'    => 'tuscany-info-about-restaurant',
                        'title' => 'Our Restaurant Content',
                        'type'  => 'info'
                    ),
                    array(
                        'id'      => 'tuscany-title-about',
                        'type'    => 'text',
                        'title'   => __('Title', 'tuscany-options'),
                        'default' => 'About Our Restaurant'
                    ),
                    array(
                        'id'        => 'tuscany-rest-content-main',
                        'type'      => 'textarea',
                        'title'     => __('Main Content', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-rest-secondary-one',
                        'type'      => 'textarea',
                        'title'     => __('Secondary Content', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-rest-secondary-two',
                        'type'      => 'textarea',
                        'title'     => __('Secondary Content Two', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options'),
                        'desc'      => __('This field is even HTML validated!', 'tuscany-options'),
                        'validate'  => 'html',
                    ),
                    array(
                        'id'        => 'tuscany-rest-img-one',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Image - Circled Big', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-rest-img-two',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Image - Circled Small', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-rest-img-three',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Main Content Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-rest-img-four',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Secondary Content Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-rest-img-five',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Secondary Content Image Two', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                ),
            );

            $this->sections[] = array(
                'title'     => __('Shop Settings', 'tuscany-options'),
                'desc'      => __('Here you can change your shop settings', 'tuscany-options'),
                'icon'      => 'el-icon-shopping-cart',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'    => 'tuscany-add-block',
                        'title' => 'Addvertising Block',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-add-price',
                        'type'      => 'text',
                        'title'     => __('Product Price', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-add-description',
                        'type'      => 'textarea',
                        'title'     => __('Description', 'tuscany-options'),
                        'subtitle'  => __('Just like a text box widget.', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-add-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Product Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-add-additional',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Additional Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'    => 'tuscany-best-dishes',
                        'title' => 'Best Dishes',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-dishes-title',
                        'type'      => 'text',
                        'title'     => __('Title', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-dishes-subtitle',
                        'type'      => 'text',
                        'title'     => __('Subtitle for Dishes', 'tuscany-options')
                    ),
                    array(
                        'id'    => 'tuscany-dishes-slides',
                        'title' => 'Dishes Slider',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-slider-title',
                        'type'      => 'text',
                        'title'     => __('Title', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-nav-word-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Navigation Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-dish-table-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Dish Table Image. Image size must be 301x93 in pixels!', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany_product_cat_select',
                        'type'      => 'select',
                        'data'      => 'categories',
                        'args' => array('taxonomy' => array('product_cat')),
                        'multi'     => true,
                        'title'     => __('Select Product Categories', 'redux-options'),
                        'subtitle'  => __('Select one or more product categories as your sliders.', 'redux-options'),
                        'desc'      => __('This is the description field, again good for additional info.', 'redux-options'),
                    ),
                    array(
                        'id'    => 'tuscany-slider-with-animations',
                        'title' => 'Product Slider with Animated Elements',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-great-title',
                        'type'      => 'text',
                        'title'     => __('Title', 'tuscany-options')
                    ),
                    array(
                        'id'        => 'tuscany-great-table-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Blackboard Image. Image size must be 592x807 in pixels!', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-great-subtitle-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Title Image', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image.', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-great-animated-images',
                        'type'      => 'gallery',
                        'title'     => __('Animated Images', 'tuscany-options'),
                        'subtitle'  => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'tuscany-options'),
                        'desc'      => __('This is the description field, again good for additional info.', 'tuscany-options'),
                    ),
                    array(
                        'id'        => 'tuscany-great-css-mod',
                        'type'      => 'textarea',
                        'title'     => __('Custom CSS for Animated Elements', 'tuscany-options'),
                        'subtitle'  => __('Select Animated Images via proper css selector and use this field to reposition them your way!', 'tuscany-options'),
                        'desc' => __('This field is even CSS validated!', 'tuscany-options'),
                        'validate'  => 'css',
                    ),
                    array(
                        'id'    => 'tuscany-book-block',
                        'title' => 'Product Book',
                        'type'  => 'info'
                    ),
                    array(
                        'id'        => 'tuscany-book-cover-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Book Cover', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image. Image size must be 808x572 in pixels!', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-book-background-img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Background Image Parallax', 'tuscany-options'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload image. Image size must be 808x572 in pixels!', 'tuscany-options'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'tuscany-book-images',
                        'type'      => 'gallery',
                        'title'     => __('Background Images', 'tuscany-options'),
                        'subtitle'  => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'tuscany-options'),
                        'desc'      => __('This is the description field, again good for additional info.', 'tuscany-options'),
                    ),
                ),
            );

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'tuscany-options') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'tuscany-options') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'tuscany-options') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'tuscany-options') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'tuscany-options'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }

            $this->sections[] = array(
                'title'     => __('Import / Export', 'tuscany-options'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'tuscany-options'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'tuscany-options'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'tuscany-options'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'tuscany-options'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'tuscany-options'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'tuscany-options')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'tuscany-options'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'tuscany-options')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'tuscany-options');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'tuscany_opt',
                'page_slug' => '_options',
                'page_title' => 'Theme Options',
                'update_notice' => true,
                'intro_text' => '<p>Welcome to Tuscany Theme Options. Feel free to contact our support any time you need it!</p>',
                'footer_text' => '<p>Welcome to Tuscany Theme Options. Feel free to contact our support any time you need it!</p>',
                'admin_bar' => true,
                'menu_type' => 'menu',
                'menu_title' => 'Theme Options',
                'menu_icon' => 'dashicons-admin-settings',
                'allow_sub_menu' => true,
                'page_parent_post_type' => 'your_post_type',
                'page_priority' => 3,
                'dev_mode' => false,
                'customizer' => true,
                'default_mark' => '*',
                'hints' =>
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_color' => 'lightgray',
                  'icon_size' => 'normal',
                  'tip_style' =>
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' =>
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' =>
                  array(
                    'show' =>
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' =>
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => true,
                'transient_time' => '3600',
                'network_sites' => true,
              );

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args["display_name"] = $theme->get("Name");
            $this->args["display_version"] = $theme->get("Version");

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

        }

    }

    global $reduxConfig;
    $reduxConfig = new tuscany_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('tuscany_my_custom_field')):
    function tuscany_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('tuscany_validate_callback_function')):
    function tuscany_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
