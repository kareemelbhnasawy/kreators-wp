<?php
/**
  ReduxFramework faimos Theme Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */



if (!class_exists("Redux_Framework_faimos_config")) {

    class Redux_Framework_faimos_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }
            
            // This is needed. Bah WordPress bugs.  ;)
            if ( get_template_directory() && strpos( Redux_Functions_Ex::wp_normalize_path( __FILE__ ), Redux_Functions_Ex::wp_normalize_path( get_template_directory() ) ) !== false) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);    
            }
        }

        public function initSettings() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }       
            
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

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

       

        

        public function setSections() {

            include_once(get_template_directory() . '/redux-framework/modeltheme-config.arrays.php');

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $faimos_patterns_path = ReduxFramework::$_dir . '../polygon/patterns/';
            $faimos_patterns_url = ReduxFramework::$_url . '../polygon/patterns/';
            $faimos_patterns = array();

            if (is_dir($faimos_patterns_path)) :

                if ($faimos_patterns_dir = opendir($faimos_patterns_path)) :
                    $faimos_patterns = array();

                    while (( $faimos_patterns_file = readdir($faimos_patterns_dir) ) !== false) {

                        if (stristr($faimos_patterns_file, '.png') !== false || stristr($faimos_patterns_file, '.jpg') !== false) {
                            $name = explode(".", $faimos_patterns_file);
                            $name = str_replace('.' . end($name), '', $faimos_patterns_file);
                            $faimos_patterns[] = array('alt' => $name, 'img' => $faimos_patterns_url . $faimos_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'faimos'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                    <a href="<?php echo esc_url(wp_customize_url()); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                        <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','faimos'); ?>" />
                    </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','faimos'); ?>" />
            <?php endif; ?>

                <h4>
            <?php echo esc_html($this->theme->display('Name')); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'faimos'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'faimos'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'faimos') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo esc_html($this->theme->display('Description')); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . esc_html__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'faimos') . '</p>', esc_html__('http://codex.WordPress.org/Child_Themes', 'faimos'), $this->theme->parent()->display('Name'));
                }
                ?>

                </div>

            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();


            /*
             *
             * ---> START SECTIONS
             *
             */
            include_once(get_template_directory(). '/redux-framework/modeltheme-config.responsive.php');


            # General Settings
            $this->sections[] = array(
                'icon' => 'el-icon-wrench',
                'title' => esc_html__('General Settings', 'faimos'),
            );
            # General
            $this->sections[] = array(
                'icon' => 'el el-chevron-right',
                'subsection' => true,
                'title' => esc_html__('Breadcrumbs', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_general_breadcrumbs',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Breadcrumbs</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos-enable-breadcrumbs',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Breadcrumbs', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable breadcrumbs', 'faimos'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'breadcrumbs-delimitator',
                        'type'     => 'text',
                        'title'    => esc_html__('Breadcrumbs delimitator', 'faimos'),
                        'subtitle' => esc_html__('This is a little space under the Field Title in the Options table, additional info is good in here.', 'faimos'),
                        'desc'     => esc_html__('This is the description field, again good for additional info.', 'faimos'),
                        'default'  => '/'
                    ),
                )
            );
            $this->sections[] = array(
                'icon' => 'el el-bulb',
                'subsection' => true,
                'title' => esc_html__('Dark Mode', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_general_dark',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Dark Mode</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos-enable-dark',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Dark Mode', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable Dark Mode', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'    => 'faimos_info_dark',
                        'type'  => 'info',
                        'style' => 'success',
                        'title' => esc_html__('Note:', 'faimos'),
                        'icon'  => 'el-icon-info-sign',
                        'desc'  => __( 'This dropdown will enable or disable the <strong>Dark Mode</strong> styling across your website. This is only applied to archive pages, blog and single templates. Other pages that are editable with WP Bakery have separate color settings. ', 'faimos')
                    ),
                )
            );
            # General -> Sidebars
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => esc_html__('Sidebars', 'faimos'),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'   => 'faimos_sidebars_generator',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Generate Unlimited Sidebars</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'dynamic_sidebars',
                        'type'     => 'multi_text',
                        'title'    => esc_html__( 'Sidebars', 'faimos' ),
                        'subtitle' => esc_html__( 'Use the "Add More" button to create unlimited sidebars.', 'faimos' ),
                        'add_text' => esc_html__( 'Add one more Sidebar', 'faimos' )
                    )
                )
            );



            # Section #2: Styling Settings
            $this->sections[] = array(
                'icon' => 'el-icon-magic',
                'title' => esc_html__('Styling Settings', 'faimos'),
            );
            // Colors
            $this->sections[] = array(
                'icon' => 'el-icon-magic',
                'subsection' => true,
                'title' => esc_html__('Colors', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_divider_links',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Links Colors(Regular, Hover, Active/Visited)</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_global_link_styling',
                        'type'     => 'link_color',
                        'title'    => esc_html__('Links Color Option', 'faimos'),
                        'subtitle' => esc_html__('Only color validation can be done on this field type(Default Regular:#1878f2; Default Hover: #1878f2; Default Active: #484848;)', 'faimos'),
                        'default'  => array(
                            'regular'  => '#1878f2', // blue
                            'hover'    => '#1878f2', // blue-x3
                            'active'   => '#484848',  // blue-x3
                            'visited'  => '#484848',  // blue-x3
                        )
                    ),
                    array(
                        'id'   => 'faimos_divider_main_colors',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Main Colors & Backgrounds</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_style_main_texts_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Main texts color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #1878F2', 'faimos'),
                        'default'  => '#1878F2',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'faimos_style_main_backgrounds_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Main background color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #1878F2', 'faimos'),
                        'default'  => '#1878F2',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'faimos_style_main_backgrounds_color_hover',
                        'type'     => 'color',
                        'title'    => esc_html__('Main background color (hover)', 'faimos'), 
                        'subtitle' => esc_html__('Default: #ffffff', 'faimos'),
                        'default'  => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'faimos_style_semi_opacity_backgrounds',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Semitransparent blocks background', 'faimos' ),
                        'default'  => array(
                            'color' => '#f02222',
                            'alpha' => '.95'
                        ),
                        'output' => array(
                            'background-color' => '.fixed-sidebar-menu',
                        ),
                        'mode'     => 'background'
                    ),
                    array(
                        'id'   => 'faimos_divider_text_selection',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Text Selection Color & Background</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_text_selection_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Text selection color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #ffffff', 'faimos'),
                        'default'  => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'faimos_text_selection_background_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Text selection background color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #1878F2', 'faimos'),
                        'default'  => '#1878F2',
                        'validate' => 'color',
                    ),


                    array(
                        'id'   => 'faimos_divider_nav_menu',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Menus Styling</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_nav_menu_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Nav Menu Text Color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #ffffff', 'faimos'),
                        'default'  => '#000',
                        'validate' => 'color',
                        'output' => array(
                            'color' => '#navbar .menu-item > a,
                                        .navbar-nav .search_products a,
                                        .navbar-default .navbar-nav > li > a,
                                        .header-v3 span.top-register,
                                        .header-v4 .header-top-contact-method a,
                                        .header-v4 .header-top-contact-method',
                        )
                    ),
                    array(
                        'id'       => 'faimos_nav_menu_color_hover',
                        'type'     => 'color',
                        'title'    => esc_html__('Nav Menu Text Color on hover', 'faimos'), 
                        'subtitle' => esc_html__('Default: #fff', 'faimos'),
                        'default'  => '#000',
                        'validate' => 'color',
                        'output' => array(
                            'color' => '#navbar .menu-item > a:hover, 
                                        .navbar-nav .search_products a:hover, 
                                        .navbar-nav .search_products a:focus,
                                        .navbar-default .navbar-nav > li > a:hover, 
                                        .navbar-default .navbar-nav > li > a:focus',
                        )
                    ),
                    array(
                        'id'   => 'faimos_divider_nav_submenu',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Submenus Styling</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_nav_submenu_background',
                        'type'     => 'color',
                        'title'    => esc_html__('Nav Submenu Background Color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #FFF', 'faimos'),
                        'default'  => '#ffffff',
                        'validate' => 'color',
                        'output' => array(
                            'background-color' => '#navbar .sub-menu, .navbar ul li ul.sub-menu',
                        )
                    ),
                    array(
                        'id'       => 'faimos_nav_submenu_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Nav Submenu Text Color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #484848', 'faimos'),
                        'default'  => '#484848',
                        'validate' => 'color',
                        'output' => array(
                            'color' => '#navbar ul.sub-menu li a,.bot_nav_cat_wrap li a:hover',
                        )
                    ),
                    array(
                        'id'       => 'faimos_nav_submenu_hover_background_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Nav Submenu Hover Background Color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #FFF', 'faimos'),
                        'default'  => '#ffffff',
                        'validate' => 'color',
                        'output' => array(
                            'background-color' => '#navbar ul.sub-menu li a:hover',
                        )
                    ),
                    array(
                        'id'       => 'faimos_nav_submenu_hover_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Nav Submenu Hover Background Color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #F29202', 'faimos'),
                        'default'  => '#1878F2',
                        'validate' => 'color',
                        'output' => array(
                            'color' => '#navbar ul.sub-menu li a:hover',
                        )
                    ),
                )
            );
            // Fonts
            $this->sections[] = array(
                'icon' => 'el-icon-fontsize',
                'subsection' => true,
                'title' => esc_html__('Typography', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_styling_gfonts',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Import Google Fonts</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_google_fonts_select',
                        'type'     => 'select',
                        'multi'    => true,
                        'title'    => esc_attr__('Import Google Font Globally', 'faimos'), 
                        'subtitle' => esc_attr__('Select one or multiple fonts', 'faimos'),
                        'desc'     => esc_attr__('Importing fonts made easy', 'faimos'),
                        'options'  => $google_fonts_list,
                        'default'  => array(
                            'Barlow:300,300italic,regular,italic,500,500italic,700,700italic,900,900italic,latin-ext,latin,cyrillic'
                        ),
                    ),
                    array(
                        'id'   => 'faimos_styling_fonts',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Set the main site font</h3>', 'faimos' )
                    ),
                    array(
                        'id'          => 'faimos-body-typography',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Body Font family', 'faimos'),
                        'google'      => true, 
                        'font-backup' => true,
                        'color'       => false,
                        'text-align'  => false,
                        'letter-spacing'  => false,
                        'line-height'  => false,
                        'font-weight'  => false,
                        'font-size'   => false,
                        'font-style'  => false,
                        'subsets'     => false,
                        'output'      => array('body'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-family' => 'Barlow', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'   => 'faimos_divider_5',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Headings</h3>', 'faimos' )
                    ),
                    array(
                        'id'          => 'faimos_heading_h1',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Heading H1 Font family', 'faimos'),
                        'google'      => true, 
                        'font-backup' => true,
                        'color'       => true,
                        'text-align'  => false,
                        'letter-spacing'  => true,
                        'line-height'  => true,
                        'font-weight'  => false,
                        'font-size'   => true,
                        'font-style'  => false,
                        'subsets'     => false,
                        'output'      => array('h1', 'h1 span'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-family' => 'Barlow', 
                            'font-size' => '60px',
                            'line-height' => '69px',  
                            'color' => '#242424', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'faimos_heading_h2',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Heading H2 Font family', 'faimos'),
                        'google'      => true, 
                        'font-backup' => true,
                        'color'       => true,
                        'text-align'  => false,
                        'letter-spacing'  => true,
                        'line-height'  => true,
                        'font-weight'  => false,
                        'font-size'   => true,
                        'font-style'  => false,
                        'subsets'     => false,
                        'output'      => array('h2'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-family' => 'Barlow', 
                            'font-size' => '40px',
                            'line-height' => '49px',  
                            'color' => '#242424', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'faimos_heading_h3',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Heading H3 Font family', 'faimos'),
                        'google'      => true, 
                        'font-backup' => true,
                        'color'       => true,
                        'text-align'  => false,
                        'letter-spacing'  => true,
                        'line-height'  => true,
                        'font-weight'  => false,
                        'font-size'   => true,
                        'font-style'  => false,
                        'subsets'     => false,
                        'output'      => array('h3', '.post-name'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-family' => 'Barlow', 
                            'font-size' => '35px',
                            'line-height' => '43px',  
                            'color' => '#242424', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'faimos_heading_h4',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Heading H4 Font family', 'faimos'),
                        'google'      => true, 
                        'font-backup' => true,
                        'color'       => true,
                        'text-align'  => false,
                        'letter-spacing'  => true,
                        'line-height'  => true,
                        'font-weight'  => false,
                        'font-size'   => true,
                        'font-style'  => false,
                        'subsets'     => false,
                        'output'      => array('h4'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-family' => 'Barlow', 
                            'font-size' => '28px',
                            'line-height' => '34px',  
                            'color' => '#242424', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'faimos_heading_h5',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Heading H5 Font family', 'faimos'),
                        'google'      => true, 
                        'font-backup' => true,
                        'color'       => true,
                        'text-align'  => false,
                        'letter-spacing'  => true,
                        'line-height'  => true,
                        'font-weight'  => false,
                        'font-size'   => true,
                        'font-style'  => false,
                        'subsets'     => false,
                        'output'      => array('h5'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-family' => 'Barlow', 
                            'font-size' => '20px', 
                            'line-height' => '28px', 
                            'color' => '#242424', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'faimos_heading_h6',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Heading H6 Font family', 'faimos'),
                        'google'      => true, 
                        'font-backup' => true,
                        'color'       => true,
                        'text-align'  => false,
                        'letter-spacing'  => true,
                        'line-height'  => true,
                        'font-weight'  => false,
                        'font-size'   => true,
                        'font-style'  => false,
                        'subsets'     => false,
                        'output'      => array('h6'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-family' => 'Barlow', 
                            'font-size' => '16px',
                            'line-height' => '25px',  
                            'color' => '#242424', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'   => 'faimos_divider_6',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Inputs & Textareas Font family</h3>', 'faimos' )
                    ),
                    array(
                        'id'                => 'faimos_inputs_typography',
                        'type'              => 'typography', 
                        'title'             => esc_html__('Inputs Font family', 'faimos'),
                        'google'            => true, 
                        'font-backup'       => true,
                        'color'             => false,
                        'text-align'        => false,
                        'letter-spacing'    => false,
                        'line-height'       => false,
                        'font-weight'       => false,
                        'font-size'         => false,
                        'font-style'        => false,
                        'subsets'           => false,
                        'output'            => array('input', 'textarea'),
                        'units'             =>'px',
                        'subtitle'          => esc_html__('Font family for inputs and textareas', 'faimos'),
                        'default'           => array(
                            'font-family'       => 'Barlow', 
                            'google'            => true
                        ),
                    ),
                    array(
                        'id'   => 'faimos_divider_7',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Buttons Font family</h3>', 'faimos' )
                    ),
                    array(
                        'id'                => 'faimos_buttons_typography',
                        'type'              => 'typography', 
                        'title'             => esc_html__('Buttons Font family', 'faimos'),
                        'google'            => true, 
                        'font-backup'       => true,
                        'color'             => false,
                        'text-align'        => false,
                        'letter-spacing'    => false,
                        'line-height'       => false,
                        'font-weight'       => false,
                        'font-size'         => false,
                        'font-style'        => false,
                        'subsets'           => false,
                        'output'            => array(
                            'input[type="submit"]'
                        ),
                        'units'             =>'px',
                        'subtitle'          => esc_html__('Font family for buttons', 'faimos'),
                        'default'           => array(
                            'font-family'       => 'Barlow', 
                            'google'            => true
                        ),
                    ),
                )
            );
            // Fonts (mobile)
            $this->sections[] = $responsive_headings;
            // Custom CSS
            $this->sections[] = array(
                'icon' => 'el-icon-css',
                'subsection' => true,
                'title' => esc_html__('Custom CSS', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_styling_custom_css',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Custom CSS</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_css_editor',
                        'type'     => 'ace_editor',
                        'title'    => esc_html__('CSS Code', 'faimos'),
                        'subtitle' => esc_html__('Paste your CSS code here.', 'faimos'),
                        'mode'     => 'css',
                        'theme'    => 'monokai',
                        'desc'     => 'Add your own custom styling (CSS rules only)',
                        'default'     => '#header{margin: 0 auto;}',
                    )
                )
            );



            # Section #2: Header Settings

            $this->sections[] = array(
                'icon' => 'el-icon-arrow-up',
                'title' => __('Header Settings', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_header_variant',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Header Variant</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'header_layout',
                        'type'     => 'select',
                        'compiler' => true,
                        'title'    => esc_html__( 'Select Header layout', 'faimos' ),
                        'options'  => array(
                            'second_header' => 'Header #1'
                        ),
                        'default'  => 'second_header'
                    ),
                    array(
                        'id'   => 'mt_divider_first_header',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => '<h3>'.esc_html__( 'Header 1 Custom Background (Menu bar)', 'faimos' ).'</h3>',
                        'required' => array( 'header_layout', '=', 'first_header' ),
                    ),
                    array(         
                        'id'       => 'nav_main_background',
                        'type'     => 'background',
                        'title'    => esc_html__('Navigation background', 'faimos'),
                        'subtitle' => esc_html__('Override the Navigation background with color.', 'faimos'),
                        'required' => array( 'header_layout', '=', 'first_header' ),
                        'output'      => array('.header-v1 .navbar.bottom-navbar-default')
                    ),
                    array(
                        'id'   => 'mt_divider_second_header',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => '<h3>'.esc_html__( 'Header 2 Custom Top & Bottom Header Background', 'faimos' ).'</h3>',
                        'required' => array( 'header_layout', '=', 'second_header' ),
                    ),
                    array(
                        'id'       => 'mt_style_bottom_header2_color',
                        'type'     => 'background',
                        'title'    => esc_html__('Main Header - background color', 'faimos'), 
                        'subtitle' => esc_html__('This color is only available when using Header 2', 'faimos'),
                        'default'  => '#F27928',
                        'required' => array( 'header_layout', '=', 'second_header' ),
                        'default'  => array(
                            'background-color' => 'transparent',
                        ),
                    ),
                    array(
                        'id' => 'faimos_second_header_button',
                        'type' => 'text',
                        'title' => esc_html__('Join as Creator Link', 'faimos'),
                        'subtitle' => esc_html__('Enter button link', 'faimos'),
                        'default' => '#',
                        'required' => array( 'header_layout', '=', 'second_header' ),
                    ),
                    array(
                        'id' => 'faimos_second_header_button1',
                        'type' => 'text',
                        'title' => esc_html__('Join as Brand Link', 'faimos'),
                        'subtitle' => esc_html__('Enter button link', 'faimos'),
                        'default' => '#',
                        'required' => array( 'header_layout', '=', 'second_header' ),
                    ),
                    array(
                        'id'   => 'mt_divider_third_header',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => '<h3>'.esc_html__( 'Header 3 Custom Top & Bottom Header Background', 'faimos' ).'</h3>',
                        'required' => array( 'header_layout', '=', 'third_header' ),
                    ),
                    array(
                        'id'       => 'mt_style_top_header3_color',
                        'type'     => 'background',
                        'title'    => esc_html__('Main Header - background color', 'faimos'), 
                        'subtitle' => esc_html__('This color is only available when using Header 3', 'faimos'),
                        'default'  => '#1C1F26',
                        'required' => array( 'header_layout', '=', 'third_header' ),
                        'default'  => array(
                            'background-color' => '#1C1F26',
                        ),
                    ),
                    array(
                        'id'       => 'mt_style_bottom_header3_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Color Links (not navigation)', 'faimos'), 
                        'subtitle' => esc_html__('This color is only available when using Header 3', 'faimos'),
                        'required' => array( 'header_layout', '=', 'third_header' ),
                        'default'  =>  '#ffffff',
                        'validate' => 'color'
                    ),
                    array(
                        'id'   => 'mt_divider_fourth_header',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => '<h3>'.esc_html__( 'Header 4', 'faimos' ).'</h3>',
                        'required' => array( 'header_layout', '=', 'fourth_header' ),
                    ),
                    array(
                        'id'       => 'mt_disable_top_bar',
                        'type'     => 'switch', 
                        'title'    => __('Disable Top Bar Header 4', 'faimos'),
                        'subtitle' => __('Enable or disable the Top Bar Header', 'faimos'),
                        'required' => array( 'header_layout', '=', 'fourth_header' ),
                        'default'  => false,
                    ),
                    array(
                        'id' => 'faimos_fourth_header_button',
                        'type' => 'text',
                        'title' => __('Button Link', 'faimos'),
                        'subtitle' => __('Enter button link', 'faimos'),
                        'default' => '#',
                        'required' => array( 'header_layout', '=', 'fourth_header' ),
                    ),
                    array(
                        'id'       => 'faimos_fourth_header_button_bg',
                        'type'     => 'color',
                        'title'    => esc_html__('Button Background', 'faimos'),
                        'subtitle' => __('Enter button color', 'faimos'), 
                        'default'  => '#fff',
                        'validate' => 'background',
                        'required' => array( 'header_layout', '=', 'fourth_header' ),
                        'output' => array(
                            'background-color' => '#faimos-main-head .button-inquiry a',
                        )
                    ),
                    array(
                        'id'       => 'faimos_fourth_header_button_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Button Color', 'faimos'),
                        'subtitle' => __('Enter button color', 'faimos'), 
                        'default'  => '#222222',
                        'validate' => 'color',
                        'required' => array( 'header_layout', '=', 'fourth_header' ),
                        'output' => array(
                            'color' => '#faimos-main-head .button-inquiry a,.header-v4 #faimos-main-head .button-inquiry a:hover',
                        )
                    ),
                    array(
                        'id'   => 'mt_divider_fifth_header',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => '<h3>'.esc_html__( 'Header 5 Custom Navigation Header Background', 'faimos' ).'</h3>',
                        'required' => array( 'header_layout', '=', 'fifth_header' ),
                    ),
                    array(
                        'id'       => 'mt_style_top_header5_color',
                        'type'     => 'background',
                        'title'    => esc_html__('Main Header - background color', 'faimos'), 
                        'subtitle' => esc_html__('This color is only available when using Header 5', 'faimos'),
                        'default'  => '#1C1F26',
                        'required' => array( 'header_layout', '=', 'fifth_header' ),
                        'default'  => array(
                            'background-color' => '#0c0c0c',
                        ),
                    ),
                    array(
                        'id'   => 'mt_divider_sixth_header',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => '<h3>'.esc_html__( 'Header 6 General Options', 'faimos' ).'</h3>',
                        'required' => array( 'header_layout', '=', 'sixth_header' ),
                    ),
                    array(
                        'id' => 'faimos_sixth_header_button',
                        'type' => 'text',
                        'title' => __('Button Link', 'faimos'),
                        'subtitle' => __('Enter button link', 'faimos'),
                        'default' => '#',
                        'required' => array( 'header_layout', '=', 'sixth_header' ),
                    ),
                    array(
                        'id'       => 'faimos_sixth_header_button_bg',
                        'type'     => 'color',
                        'title'    => esc_html__('Button Background', 'faimos'),
                        'subtitle' => __('Enter button color', 'faimos'), 
                        'default'  => '#fff',
                        'validate' => 'background',
                        'required' => array( 'header_layout', '=', 'sixth_header' ),
                        'output' => array(
                            'background-color' => '#faimos-main-head .button-inquiry',
                        )
                    ),
                    array(
                        'id'       => 'faimos_sixth_header_button_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Button Color', 'faimos'),
                        'subtitle' => esc_html__('Enter button color', 'faimos'), 
                        'default'  => '#222222',
                        'validate' => 'color',
                        'required' => array( 'header_layout', '=', 'sixth_header' ),
                        'output' => array(
                            'color' => '#faimos-main-head .button-inquiry a,.header-v6 #faimos-main-head .button-inquiry a:hover',
                        )
                    ),
                    array(
                        'id'       => 'is_nav_sticky',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Fixed Navigation menu?', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable "fixed positioned navigation menu".', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_header_category_menu',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Category menu enabled?', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable "category navigation menu".', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_header_language_switcher',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Language Switcher Dropdown', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable "Language Switcher Dropdown".', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_header_currency_switcher',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Right menu enabled?', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable "Right navigation menu".', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_top',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Icon Groups on Top Header (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Icon Group on Top Header.', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_top_search',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Search Icon Groups on Top Header (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Search Icon Group on Top Header.', 'faimos'),
                        'required' => array( 'faimos_header_mobile_switcher_top', '=', true ),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_top_cart',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Cart Icon Groups on Top Header (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Cart Icon Group on Top Header.', 'faimos'),
                        'required' => array( 'faimos_header_mobile_switcher_top', '=', true ),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_top_wishlist',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Wishlist Icon Groups on Top Header (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Wishlist Icon Group on Top Header.', 'faimos'),
                        'required' => array( 'faimos_header_mobile_switcher_top', '=', true ),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_footer',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Icon Groups on Sticky Footer (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Icon Group on Sticky Footer.', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_footer_search',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Search Icon Groups on Sticky Footer (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Search Icon Group on Sticky Footer.', 'faimos'),
                        'required' => array( 'faimos_header_mobile_switcher_footer', '=', true ),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_footer_cart',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Cart Icon Groups on Sticky Footer (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Cart Icon Group on Sticky Footer.', 'faimos'),
                        'required' => array( 'faimos_header_mobile_switcher_footer', '=', true ),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_footer_wishlist',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Wishlist Icon Groups on Sticky Footer (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Wishlist Icon Group on Sticky Footer.', 'faimos'),
                        'required' => array( 'faimos_header_mobile_switcher_footer', '=', true ),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'faimos_header_mobile_switcher_footer_account',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Account Icon Groups on Sticky Footer (Mobile only)', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Account Icon Group on Sticky Footer.', 'faimos'),
                        'required' => array( 'faimos_header_mobile_switcher_footer', '=', true ),
                        'default'  => true,
                    ),
                    array(
                        'id'   => 'faimos_header_search_settings',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Search Settings</h3>', 'faimos' )
                    ),
                    array(
                        'id'        => 'search_for',
                        'type'      => 'select',
                        'title'     => esc_html__('Search form for:', 'faimos'),
                        'subtitle'  => esc_html__('Select the scope of the header search form(Search for PRODUCTS or POSTS).', 'faimos'),
                        'options'   => array(
                                'products'   => 'Products',
                                'posts'   => 'Posts'
                            ),
                        'default'   => 'products',
                    ),
                    array(
                        'id'   => 'faimos_header_logo_settings',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Logo & Favicon Settings</h3>', 'faimos' )
                    ),
                    array(
                        'id' => 'faimos_logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Logo as image', 'faimos'),
                        'compiler' => 'true',
                        'default' => array('url' => get_template_directory_uri().'/images/logo-faimos.svg'),
                    ),
                    array(
                        'id'        => 'logo_max_width',
                        'type'      => 'slider',
                        'title'     => esc_html__('Logo Max Width', 'faimos'),
                        'subtitle'  => esc_html__('Use the slider to increase/decrease max size of the logo.', 'faimos'),
                        'desc'      => esc_html__('Min: 1px, max: 500px, step: 1px, default value: 140px', 'faimos'),
                        "default"   => 165,
                        "min"       => 1,
                        "step"      => 1,
                        "max"       => 500,
                        'display_value' => 'label'
                    ),
                    array(
                        'id' => 'faimos_favicon',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Favicon url', 'faimos'),
                        'compiler' => 'true',
                        'subtitle' => esc_html__('Use the upload button to import media.', 'faimos'),
                        'default' => array('url' => get_template_directory_uri().'/images/favicon.png'),
                    ),
                    array(
                        'id'   => 'faimos_header_styling_settings',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => esc_html__( '<h3>Header Styling Settings</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_category_background',
                        'type'     => 'color',
                        'title'    => esc_html__('Category 2 Background color', 'faimos'), 
                        'subtitle' => esc_html__('Default: #ffffff', 'faimos'),
                        'default'  => '#ffffff',
                        'validate' => 'background',
                        'output' => array(
                            'background-color' => '.bot_nav_cat .bot_nav_cat_wrap',
                        )
                    ),
                    array(         
                        'id'       => 'header_top_bar_background',
                        'type'     => 'background',
                        'title'    => esc_html__('Header (top small bar) - background', 'faimos'),
                        'subtitle' => esc_html__('Header background with image or color.', 'faimos'),
                        'output'      => array('.top-header'),
                        'default'  => array(
                            'background-color' => '#ffffff',
                        )
                    ),
                    array(         
                        'id'       => 'header_main_background',
                        'type'     => 'background',
                        'title'    => esc_html__('Header (main-header) - background', 'faimos'),
                        'subtitle' => esc_html__('Header background with image or color.', 'faimos'),
                        'output'      => array('.navbar-default,.top-navigation'),
                        'default'  => array(
                            'background-color' => '#232f3e',
                        )
                    ),
                    array(
                        'id'   => 'faimos_header_styling_settings',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Top Header Information Settings</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_top_header_info_switcher',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Header Discount Block', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable the Header Discount Block.', 'faimos'),
                        'default'  => false,
                    ),
                    array(         
                        'id'       => 'discout_header_background',
                        'type'     => 'background',
                        'title'    => esc_html__('Header Discount Background', 'faimos'),
                        'subtitle' => esc_html__('Header background with image or color.', 'faimos'),
                        'output'      => array('.faimos-top-banner'),
                        'required' => array( 'faimos_top_header_info_switcher', '=', true ),
                        'default'  => array(
                            'background-color' => '#f5f5f5',
                        )
                    ),
                    array(
                        'id' => 'discout_header_text',
                        'type' => 'text',
                        'required' => array( 'faimos_top_header_info_switcher', '=', true ),
                        'title' => esc_html__('Header Discount Text', 'faimos'),
                        'default' => 'New Student Deal..'
                    ),
                    array(
                        'id' => 'discout_header_date',
                        'type' => 'date',
                        'required' => array( 'faimos_top_header_info_switcher', '=', true ),
                        'title' => esc_html__('Header Discount Expiration Date', 'faimos'),
                        'default' => '22/02/2022'
                    ),
                    array(
                        'id' => 'discout_header_btn_text',
                        'type' => 'text',
                        'required' => array( 'faimos_top_header_info_switcher', '=', true ),
                        'title' => esc_html__('Button Text', 'faimos'),
                        'default' => 'Join Now'
                    ),
                    array(
                        'id' => 'discout_header_btn_link',
                        'type' => 'text',
                        'required' => array( 'faimos_top_header_info_switcher', '=', true ),
                        'title' => esc_html__('Button Link', 'faimos'),
                        'default' => '#'
                    ),
                    array(
                        'id'       => 'discout_header_btn_color',
                        'type'     => 'color',
                        'required' => array( 'faimos_top_header_info_switcher', '=', true ),
                        'title'    => esc_html__('Button Background', 'faimos'), 
                        'default'  => '#ef6f31',
                        'validate' => 'background',
                        'output' => array(
                            'background-color' => '.faimos-top-banner .button',
                        )
                    ),
                )
            );


            # General Settings
            $this->sections[] = array(
                'icon' => 'el-icon-arrow-down',
                'title' => __('Footer Settings', 'faimos'),
            );
            $this->sections[] = array(
                'icon' => 'el-icon-circle-arrow-up',
                'subsection' => true,
                'title' => __('Footer Top', 'faimos'),
                'fields' => array(
                    array(         
                        'id'       => 'footer_top_background',
                        'type'     => 'background',
                        'title'    => esc_html__('Footer (top) - background', 'faimos'),
                        'subtitle' => esc_html__('Footer background with image or color.', 'faimos'),
                        'output'      => array('footer,.widget_faimos_social_icons a'),
                        'default'  => array(
                            'background-color' => '#00306e'
                        )
                    ),
                    array(         
                        'id'       => 'footer_top_color_text',
                        'type'     => 'color',
                        'title'    => esc_html__('Footer (top) - color text', 'faimos'),
                        'subtitle' => esc_html__('Footer text color.', 'faimos'),
                        'default'  =>  '#ffffff',
                        'validate' => 'color'
                    ),
                    array(
                        'id'   => 'faimos_footer_row1',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Footer Widgets (Row #1)</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos-enable-footer-widgets',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Status', 'faimos'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'faimos_number_of_footer_columns',
                        'type'     => 'select',
                        'title'    => esc_html__('Footer Widgets Row #1 - Number of columns', 'faimos'), 
                        'options'  => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6'
                        ),
                        'default'  => '4',
                        'required' => array('faimos-enable-footer-widgets','equals',true),
                    ),
                    array(
                        'id'             => 'footer_row_1_spacing',
                        'type'           => 'spacing',
                        'output'         => array('.container.footer-top, .prefooter .container'),
                        'mode'           => 'padding',
                        'units'          => array('px'),
                        'units_extended' => 'false',
                        'title'          => esc_html__('Footer Widgets Row #1 - Padding', 'faimos'),
                        'default'            => array(
                            'padding-top'     => '0px', 
                            'padding-bottom'  => '0px', 
                            'units'          => 'px', 
                        ),
                        'required' => array('faimos-enable-footer-widgets','equals',true),
                    ),
                    array(
                        'id'   => 'faimos_footer_row2',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Footer Widgets (Row #2)</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos-enable-footer-widgets-row2',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Status', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_number_of_footer_columns_row2',
                        'type'     => 'select',
                        'title'    => esc_html__('Footer Widgets Row #2 - Number of columns', 'faimos'), 
                        'options'  => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6'
                        ),
                        'default'  => '4',
                        'required' => array('faimos-enable-footer-widgets-row2','equals',true),
                    ),
                    array(
                        'id'             => 'footer_row_2_spacing',
                        'type'           => 'spacing',
                        'output'         => array('.footer-top .footer-row-2'),
                        'mode'           => 'padding',
                        'units'          => array('px'),
                        'units_extended' => 'false',
                        'title'          => esc_html__('Footer Widgets Row #2 - Padding', 'faimos'),
                        'default'            => array(
                            'padding-top'     => '0px', 
                            'padding-bottom'  => '0px', 
                            'units'          => 'px', 
                        ),
                        'required' => array('faimos-enable-footer-widgets-row2','equals',true),
                    ),

                    array(
                        'id'   => 'faimos_footer_row3',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Footer Widgets (Row #3)</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos-enable-footer-widgets-row3',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Status', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'faimos_number_of_footer_columns_row3',
                        'type'     => 'select',
                        'title'    => esc_html__('Footer Widgets Row #3 - Number of columns', 'faimos'), 
                        'options'  => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6'
                        ),
                        'default'  => '4',
                        'required' => array('faimos-enable-footer-widgets-row3','equals',true),
                    ),
                    array(
                        'id'             => 'footer_row_3_spacing',
                        'type'           => 'spacing',
                        'output'         => array('.footer-top .footer-row-3'),
                        'mode'           => 'padding',
                        'units'          => array('px'),
                        'units_extended' => 'false',
                        'title'          => esc_html__('Footer Widgets Row #3 - Padding', 'faimos'),
                        'default'            => array(
                            'padding-top'     => '0px', 
                            'padding-bottom'  => '0px', 
                            'units'          => 'px', 
                        ),
                        'required' => array('faimos-enable-footer-widgets-row3','equals',true),
                    ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-circle-arrow-down',
                'subsection' => true,
                'title' => esc_html__('Footer Bottom (Copyright)', 'faimos'),
                'fields' => array(
                    array(
                        'id' => 'faimos_footer_text_left',
                        'type' => 'editor',
                        'title' => esc_html__('Footer Text Left', 'faimos'),
                        'default' => 'Copyright by ModelTheme. All Rights Reserved.',
                    ),
                    array(
                        'id' => 'faimos_footer_text_right',
                        'type' => 'editor',
                        'title' => esc_html__('Footer Text Right', 'faimos'),
                        'default' => 'Elite Author on ThemeForest.',
                    ),
                    array(
                        'id' => 'faimos_card_icons1',
                        'type' => 'background',
                        'title' => esc_html__('Footer card icons', 'faimos'),
                        'compiler' => 'true',
                        'background-color' => 'false',
                        'background-repeat' => 'false',
                        'background-size' => 'false',
                        'background-attachment' => 'false',
                        'background-position' => 'false',
                        'output'      => array('.card-icons1'),
                        'default' => '',
                    ),
                    array(         
                        'id'       => 'footer_bottom_background',
                        'type'     => 'background',
                        'title'    => esc_html__('Footer (bottom) - background', 'faimos'),
                        'subtitle' => esc_html__('Footer background with image or color.', 'faimos'),
                        'output'      => array('footer .footer'),
                        'default'  => array(
                            'background-color' => 'transparent',
                        )
                    ),
                    array(         
                        'id'       => 'footer_bottom_color_text',
                        'type'     => 'color',
                        'title'    => esc_html__('Footer (bottom) - texts color', 'faimos'),
                        'subtitle' => esc_html__('Footer text color.', 'faimos'),
                        'default'  =>  '#ffffff',
                        'validate' => 'color'
                    ),
                    array(         
                        'id'       => 'footer_bottom_color_links',
                        'type'     => 'color',
                        'title'    => esc_html__('Footer (bottom) - links color', 'faimos'),
                        'subtitle' => esc_html__('Footer links color.', 'faimos'),
                        'default'  =>  '#fff',
                        'validate' => 'color'
                    ),
                    array(         
                        'id'       => 'footer_bottom_color_icons',
                        'type'     => 'color',
                        'title'    => esc_html__('Footer (bottom) - icons color', 'faimos'),
                        'subtitle' => esc_html__('Footer icons.', 'faimos'),
                        'default'  =>  '#FFF',
                        'validate' => 'color'
                    ),

                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-caret-up',
                'subsection' => true,
                'title' => esc_html__('Back to Top', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_back_to_top',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Back to Top Settings</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_backtotop_status',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Back to Top Button Status', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable "Back to Top Button"', 'faimos'),
                        'default'  => true,
                    ),
                    array(         
                        'id'       => 'faimos_backtotop_bg_color',
                        'type'     => 'background',
                        'title'    => esc_html__('Back to Top Button Status Backgrond', 'faimos'), 
                        'subtitle' => esc_html__('Default: #2695FF', 'faimos'),
                        'default'  => array(
                            'background-color' => '#2695FF',
                            'background-repeat' => 'no-repeat',
                            'background-position' => 'center center',
                            'background-image' => get_template_directory_uri().'/images/mt-to-top-arrow.svg',
                        )
                    ),

                )
            );


            # Section #4: Contact Settings

            $this->sections[] = array(
                'icon' => 'el-icon-map-marker-alt',
                'title' => __('Contact Settings', 'faimos'),
                'fields' => array(
                    array(
                        'id' => 'faimos_contact_phone',
                        'type' => 'text',
                        'title' => esc_html__('Phone Number', 'faimos'),
                        'subtitle' => esc_html__('Contact phone number displayed on the contact us page.', 'faimos'),
                        'validate_callback' => 'redux_validate_callback_function',
                        'default' => ''
                    ),
                    array(
                        'id' => 'faimos_contact_email',
                        'type' => 'text',
                        'title' => esc_html__('Email', 'faimos'),
                        'subtitle' => esc_html__('Contact email displayed on the contact us page., additional info is good in here.', 'faimos'),
                        'validate' => 'email',
                        'msg' => 'custom error message',
                        'default' => ''
                    ),
                    array(
                        'id' => 'faimos_work_program',
                        'type' => 'text',
                        'title' => esc_html__('Program', 'faimos'),
                        'subtitle' => esc_html__('Enter your work program', 'faimos'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'faimos_contact_address',
                        'type' => 'text',
                        'title' => esc_html__('Address', 'faimos'),
                        'subtitle' => esc_html__('Enter your contact address', 'faimos'),
                        'default' => ''
                    ),
                )
            );

            # Section: Popup Settings
            $this->sections[] = array(
                'icon' => 'fa fa-angle-double-up',
                'title' => __('Popup Settings', 'faimos'),
                'fields' => array(
                    array(
                        'id'       => 'faimos-enable-popup',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Popup', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable popup', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'   => 'faimos_popup_design',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Popup Design</h3>', 'faimos' )
                    ),
                    array(
                        'id' => 'faimos-enable-popup-img',
                        'type' => 'media',
                        'url' => true,
                        'title'    => esc_html__('Popup Image', 'faimos'),
                        'subtitle' => esc_html__('Set your popup image', 'faimos'),
                        'compiler' => 'true'
                    ),
                    array(
                        'id' => 'faimos-enable-popup-company',
                        'type' => 'media',
                        'url' => true,
                        'title'    => esc_html__('Your Company Logo', 'faimos'),
                        'subtitle' => esc_html__('Set your company logo', 'faimos'),
                        'compiler' => 'true'
                    ),
                    array(
                        'id' => 'faimos-enable-popup-desc',
                        'type' => 'text',
                        'title' => esc_html__('Subtitle Description', 'faimos'),
                        'subtitle' => esc_html__('Write a few words as description', 'faimos'),
                        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet sagittis sem, at sollicitudin lectus.'
                    ),
                    array(
                        'id' => 'faimos-enable-popup-form',
                        'type' => 'editor',
                        'title' => esc_html__('Custom Form Shortcode', 'faimos'),
                        'subtitle' => esc_html__('Write a few words as description', 'faimos'),
                         'args'   => array(
                            'teeny'            => true,
                            'textarea_rows'    => 10
                        )
                    ),
                    array(
                        'id'       => 'faimos-enable-popup-additional',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Disable Login message?', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable Login message.', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id'   => 'faimos_popup_settings',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Popup Settings</h3>', 'faimos' )
                    ),
                    array(
                        'id'        => 'faimos-enable-popup-expire-date',
                        'type'      => 'select',
                        'title'     => esc_html__('Expiring Cookie', 'faimos'),
                        'subtitle'  => esc_html__('Select the days for when the cookies to expire.', 'faimos'),
                        'options'   => array(
                                '1'    => 'One day',
                                '3'    => 'Three days',
                                '7'    => 'Seven days',
                                '30'   => 'One Month',
                                '3000' => 'Be Remembered'
                            ),
                        'default'   => '1',
                    ),
                    array(
                        'id'        => 'faimos-enable-popup-show-time',
                        'type'      => 'select',
                        'title'     => esc_html__('Show Popup', 'faimos'),
                        'subtitle'  => esc_html__('Select a specific time to show the popup.', 'faimos'),
                        'options'   => array(
                                '5000'     => '5 seconds',
                                '10000'    => '10 seconds',
                                '20000'    => '20 seconds'
                            ),
                        'default'   => '5000',
                    ),
                )
            );

            # Section #6: Blog Settings

            $icons = array(
            'fa fa-angellist'      => 'fa fa-angellist',
            'fa fa-area-chart'     => 'fa fa-area-chart',
            'fa fa-at'             => 'fa fa-at',
            'fa fa-bell-slash'     => 'fa fa-bell-slash',
            'fa fa-bell-slash-o'   => 'fa fa-bell-slash-o',
            'fa fa-bicycle'        => 'fa fa-bicycle',
            'fa fa-binoculars'     => 'fa fa-binoculars',
            'fa fa-birthday-cake'  => 'fa fa-birthday-cake',
            'fa fa-bus'            => 'fa fa-bus',
            'fa fa-calculator'     => 'fa fa-calculator',
            'fa fa-cc'             => 'fa fa-cc',
            'fa fa-cc-amex'        => 'fa fa-cc-amex',
            'fa fa-cc-discover'    => 'fa fa-cc-discover',
            'fa fa-cc-mastercard'  => 'fa fa-cc-mastercard',
            'fa fa-cc-paypal'      => 'fa fa-cc-paypal',
            'fa fa-cc-stripe'      => 'fa fa-cc-stripe',
            'fa fa-cc-visa'        => 'fa fa-cc-visa',
            'fa fa-copyright'      => 'fa fa-copyright',
            'fa fa-eyedropper'     => 'fa fa-eyedropper',
            'fa fa-futbol-o'       => 'fa fa-futbol-o',
            'fa fa-google-wallet'  => 'fa fa-google-wallet',
            'fa fa-ils'            => 'fa fa-ils',
            'fa fa-ioxhost'        => 'fa fa-ioxhost',
            'fa fa-lastfm'         => 'fa fa-lastfm',
            'fa fa-lastfm-square' => 'fa fa-lastfm-square',
            'fa fa-line-chart' => 'fa fa-line-chart',
            'fa fa-meanpath' => 'fa fa-meanpath',
            'fa fa-newspaper-o' => 'fa fa-newspaper-o',
            'fa fa-paint-brush' => 'fa fa-paint-brush',
            'fa fa-paypal' => 'fa fa-paypal',
            'fa fa-pie-chart' => 'fa fa-pie-chart',
            'fa fa-plug' => 'fa fa-plug',
            'fa fa-shekel' => 'fa fa-shekel',
            'fa fa-sheqel' => 'fa fa-sheqel',
            'fa fa-slideshare' => 'fa fa-slideshare',
            'fa fa-soccer-ball-o' => 'fa fa-soccer-ball-o',
            'fa fa-toggle-off' => 'fa fa-toggle-off',
            'fa fa-toggle-on' => 'fa fa-toggle-on',
            'fa fa-trash' => 'fa fa-trash',
            'fa fa-tty' => 'fa fa-tty',
            'fa fa-twitch' => 'fa fa-twitch',
            'fa fa-wifi' => 'fa fa-wifi',
            'fa fa-yelp' => 'fa fa-yelp',
            'fa fa-adjust' => 'fa fa-adjust',
            'fa fa-anchor' => 'fa fa-anchor',
            'fa fa-archive' => 'fa fa-archive',
            'fa fa-arrows' => 'fa fa-arrows',
            'fa fa-arrows-h' => 'fa fa-arrows-h',
            'fa fa-arrows-v' => 'fa fa-arrows-v',
            'fa fa-asterisk' => 'fa fa-asterisk',
            'fa fa-automobile' => 'fa fa-automobile',
            'fa fa-ban' => 'fa fa-ban',
            'fa fa-bank' => 'fa fa-bank',
            'fa fa-bar-chart' => 'fa fa-bar-chart',
            'fa fa-bar-chart-o' => 'fa fa-bar-chart-o',
            'fa fa-barcode' => 'fa fa-barcode',
            'fa fa-bars' => 'fa fa-bars',
            'fa fa-beer' => 'fa fa-beer',
            'fa fa-bell' => 'fa fa-bell',
            'fa fa-bell-o' => 'fa fa-bell-o',
            'fa fa-bolt' => 'fa fa-bolt',
            'fa fa-bomb' => 'fa fa-bomb',
            'fa fa-book' => 'fa fa-book',
            'fa fa-bookmark' => 'fa fa-bookmark',
            'fa fa-bookmark-o' => 'fa fa-bookmark-o',
            'fa fa-briefcase' => 'fa fa-briefcase',
            'fa fa-bug' => 'fa fa-bug',
            'fa fa-building' => 'fa fa-building',
            'fa fa-building-o' => 'fa fa-building-o',
            'fa fa-bullhorn' => 'fa fa-bullhorn',
            'fa fa-bullseye' => 'fa fa-bullseye',
            'fa fa-cab' => 'fa fa-cab',
            'fa fa-calendar' => 'fa fa-calendar',
            'fa fa-calendar-o' => 'fa fa-calendar-o',
            'fa fa-camera' => 'fa fa-camera',
            'fa fa-camera-retro' => 'fa fa-camera-retro',
            'fa fa-car' => 'fa fa-car',
            'fa fa-caret-square-o-down' => 'fa fa-caret-square-o-down',
            'fa fa-caret-square-o-left' => 'fa fa-caret-square-o-left',
            'fa fa-caret-square-o-right' => 'fa fa-caret-square-o-right',
            'fa fa-caret-square-o-up' => 'fa fa-caret-square-o-up',
            'fa fa-certificate' => 'fa fa-certificate',
            'fa fa-check' => 'fa fa-check',
            'fa fa-check-circle' => 'fa fa-check-circle',
            'fa fa-check-circle-o' => 'fa fa-check-circle-o',
            'fa fa-check-square' => 'fa fa-check-square',
            'fa fa-check-square-o' => 'fa fa-check-square-o',
            'fa fa-child' => 'fa fa-child',
            'fa fa-circle' => 'fa fa-circle',
            'fa fa-circle-o' => 'fa fa-circle-o',
            'fa fa-circle-o-notch' => 'fa fa-circle-o-notch',
            'fa fa-circle-thin' => 'fa fa-circle-thin',
            'fa fa-clock-o' => 'fa fa-clock-o',
            'fa fa-close' => 'fa fa-close',
            'fa fa-cloud' => 'fa fa-cloud',
            'fa fa-cloud-download' => 'fa fa-cloud-download',
            'fa fa-cloud-upload' => 'fa fa-cloud-upload',
            'fa fa-code' => 'fa fa-code',
            'fa fa-code-fork' => 'fa fa-code-fork',
            'fa fa-coffee' => 'fa fa-coffee',
            'fa fa-cog' => 'fa fa-cog',
            'fa fa-cogs' => 'fa fa-cogs',
            'fa fa-comment' => 'fa fa-comment',
            'fa fa-comment-o' => 'fa fa-comment-o',
            'fa fa-comments' => 'fa fa-comments',
            'fa fa-comments-o' => 'fa fa-comments-o',
            'fa fa-compass' => 'fa fa-compass',
            'fa fa-credit-card' => 'fa fa-credit-card',
            'fa fa-crop' => 'fa fa-crop',
            'fa fa-crosshairs' => 'fa fa-crosshairs',
            'fa fa-cube' => 'fa fa-cube',
            'fa fa-cubes' => 'fa fa-cubes',
            'fa fa-cutlery' => 'fa fa-cutlery',
            'fa fa-dashboard' => 'fa fa-dashboard',
            'fa fa-database' => 'fa fa-database',
            'fa fa-desktop' => 'fa fa-desktop',
            'fa fa-dot-circle-o' => 'fa fa-dot-circle-o',
            'fa fa-download' => 'fa fa-download',
            'fa fa-edit' => 'fa fa-edit',
            'fa fa-ellipsis-h' => 'fa fa-ellipsis-h',
            'fa fa-ellipsis-v' => 'fa fa-ellipsis-v',
            'fa fa-envelope' => 'fa fa-envelope',
            'fa fa-envelope-o' => 'fa fa-envelope-o',
            'fa fa-envelope-square' => 'fa fa-envelope-square',
            'fa fa-eraser' => 'fa fa-eraser',
            'fa fa-exchange' => 'fa fa-exchange',
            'fa fa-exclamation' => 'fa fa-exclamation',
            'fa fa-exclamation-circle' => 'fa fa-exclamation-circle',
            'fa fa-exclamation-triangle' => 'fa fa-exclamation-triangle',
            'fa fa-external-link' => 'fa fa-external-link',
            'fa fa-external-link-square' => 'fa fa-external-link-square',
            'fa fa-eye' => 'fa fa-eye',
            'fa fa-eye-slash' => 'fa fa-eye-slash',
            'fa fa-fax' => 'fa fa-fax',
            'fa fa-female' => 'fa fa-female',
            'fa fa-fighter-jet' => 'fa fa-fighter-jet',
            'fa fa-file-archive-o' => 'fa fa-file-archive-o',
            'fa fa-file-audio-o' => 'fa fa-file-audio-o',
            'fa fa-file-code-o' => 'fa fa-file-code-o',
            'fa fa-file-excel-o' => 'fa fa-file-excel-o',
            'fa fa-file-image-o' => 'fa fa-file-image-o',
            'fa fa-file-movie-o' => 'fa fa-file-movie-o',
            'fa fa-file-pdf-o' => 'fa fa-file-pdf-o',
            'fa fa-file-photo-o' => 'fa fa-file-photo-o',
            'fa fa-file-picture-o' => 'fa fa-file-picture-o',
            'fa fa-file-powerpoint-o' => 'fa fa-file-powerpoint-o',
            'fa fa-file-sound-o' => 'fa fa-file-sound-o',
            'fa fa-file-video-o' => 'fa fa-file-video-o',
            'fa fa-file-word-o' => 'fa fa-file-word-o',
            'fa fa-file-zip-o' => 'fa fa-file-zip-o',
            'fa fa-film' => 'fa fa-film',
            'fa fa-filter' => 'fa fa-filter',
            'fa fa-fire' => 'fa fa-fire',
            'fa fa-fire-extinguisher' => 'fa fa-fire-extinguisher',
            'fa fa-flag' => 'fa fa-flag',
            'fa fa-flag-checkered' => 'fa fa-flag-checkered',
            'fa fa-flag-o' => 'fa fa-flag-o',
            'fa fa-flash' => 'fa fa-flash',
            'fa fa-flask' => 'fa fa-flask',
            'fa fa-folder' => 'fa fa-folder',
            'fa fa-folder-o' => 'fa fa-folder-o',
            'fa fa-folder-open' => 'fa fa-folder-open',
            'fa fa-folder-open-o' => 'fa fa-folder-open-o',
            'fa fa-frown-o' => 'fa fa-frown-o',
            'fa fa-gamepad' => 'fa fa-gamepad',
            'fa fa-gavel' => 'fa fa-gavel',
            'fa fa-gear' => 'fa fa-gear',
            'fa fa-gears' => 'fa fa-gears',
            'fa fa-gift' => 'fa fa-gift',
            'fa fa-glass' => 'fa fa-glass',
            'fa fa-globe' => 'fa fa-globe',
            'fa fa-graduation-cap' => 'fa fa-graduation-cap',
            'fa fa-group' => 'fa fa-group',
            'fa fa-hdd-o' => 'fa fa-hdd-o',
            'fa fa-headphones' => 'fa fa-headphones',
            'fa fa-heart' => 'fa fa-heart',
            'fa fa-heart-o' => 'fa fa-heart-o',
            'fa fa-history' => 'fa fa-history',
            'fa fa-home' => 'fa fa-home',
            'fa fa-image' => 'fa fa-image',
            'fa fa-inbox' => 'fa fa-inbox',
            'fa fa-info' => 'fa fa-info',
            'fa fa-info-circle' => 'fa fa-info-circle',
            'fa fa-institution' => 'fa fa-institution',
            'fa fa-key' => 'fa fa-key',
            'fa fa-keyboard-o' => 'fa fa-keyboard-o',
            'fa fa-language' => 'fa fa-language',
            'fa fa-laptop' => 'fa fa-laptop',
            'fa fa-leaf' => 'fa fa-leaf',
            'fa fa-legal' => 'fa fa-legal',
            'fa fa-lemon-o' => 'fa fa-lemon-o',
            'fa fa-level-down' => 'fa fa-level-down',
            'fa fa-level-up' => 'fa fa-level-up',
            'fa fa-life-bouy' => 'fa fa-life-bouy',
            'fa fa-life-buoy' => 'fa fa-life-buoy',
            'fa fa-life-ring' => 'fa fa-life-ring',
            'fa fa-life-saver' => 'fa fa-life-saver',
            'fa fa-lightbulb-o' => 'fa fa-lightbulb-o',
            'fa fa-location-arrow' => 'fa fa-location-arrow',
            'fa fa-lock' => 'fa fa-lock',
            'fa fa-magic' => 'fa fa-magic',
            'fa fa-magnet' => 'fa fa-magnet',
            'fa fa-mail-forward' => 'fa fa-mail-forward',
            'fa fa-mail-reply' => 'fa fa-mail-reply',
            'fa fa-mail-reply-all' => 'fa fa-mail-reply-all',
            'fa fa-male' => 'fa fa-male',
            'fa fa-map-marker' => 'fa fa-map-marker',
            'fa fa-meh-o' => 'fa fa-meh-o',
            'fa fa-microphone' => 'fa fa-microphone',
            'fa fa-microphone-slash' => 'fa fa-microphone-slash',
            'fa fa-minus' => 'fa fa-minus',
            'fa fa-minus-circle' => 'fa fa-minus-circle',
            'fa fa-minus-square' => 'fa fa-minus-square',
            'fa fa-minus-square-o' => 'fa fa-minus-square-o',
            'fa fa-mobile' => 'fa fa-mobile',
            'fa fa-mobile-phone' => 'fa fa-mobile-phone',
            'fa fa-money' => 'fa fa-money',
            'fa fa-moon-o' => 'fa fa-moon-o',
            'fa fa-mortar-board' => 'fa fa-mortar-board',
            'fa fa-music' => 'fa fa-music',
            'fa fa-navicon' => 'fa fa-navicon',
            'fa fa-paper-plane' => 'fa fa-paper-plane',
            'fa fa-paper-plane-o' => 'fa fa-paper-plane-o',
            'fa fa-paw' => 'fa fa-paw',
            'fa fa-pencil' => 'fa fa-pencil',
            'fa fa-pencil-square' => 'fa fa-pencil-square',
            'fa fa-pencil-square-o' => 'fa fa-pencil-square-o',
            'fa fa-phone' => 'fa fa-phone',
            'fa fa-phone-square' => 'fa fa-phone-square',
            'fa fa-photo' => 'fa fa-photo',
            'fa fa-picture-o' => 'fa fa-picture-o',
            'fa fa-plane' => 'fa fa-plane',
            'fa fa-plus' => 'fa fa-plus',
            'fa fa-plus-circle' => 'fa fa-plus-circle',
            'fa fa-plus-square' => 'fa fa-plus-square',
            'fa fa-plus-square-o' => 'fa fa-plus-square-o',
            'fa fa-power-off' => 'fa fa-power-off',
            'fa fa-print' => 'fa fa-print',
            'fa fa-puzzle-piece' => 'fa fa-puzzle-piece',
            'fa fa-qrcode' => 'fa fa-qrcode',
            'fa fa-question' => 'fa fa-question',
            'fa fa-question-circle' => 'fa fa-question-circle',
            'fa fa-quote-left' => 'fa fa-quote-left',
            'fa fa-quote-right' => 'fa fa-quote-right',
            'fa fa-random' => 'fa fa-random',
            'fa fa-recycle' => 'fa fa-recycle',
            'fa fa-refresh' => 'fa fa-refresh',
            'fa fa-remove' => 'fa fa-remove',
            'fa fa-reorder' => 'fa fa-reorder',
            'fa fa-reply' => 'fa fa-reply',
            'fa fa-reply-all' => 'fa fa-reply-all',
            'fa fa-retweet' => 'fa fa-retweet',
            'fa fa-road' => 'fa fa-road',
            'fa fa-rocket' => 'fa fa-rocket',
            'fa fa-rss' => 'fa fa-rss',
            'fa fa-rss-square' => 'fa fa-rss-square',
            'fa fa-search' => 'fa fa-search',
            'fa fa-search-minus' => 'fa fa-search-minus',
            'fa fa-search-plus' => 'fa fa-search-plus',
            'fa fa-send' => 'fa fa-send',
            'fa fa-send-o' => 'fa fa-send-o',
            'fa fa-share' => 'fa fa-share',
            'fa fa-share-alt' => 'fa fa-share-alt',
            'fa fa-share-alt-square' => 'fa fa-share-alt-square',
            'fa fa-share-square' => 'fa fa-share-square',
            'fa fa-share-square-o' => 'fa fa-share-square-o',
            'fa fa-shield' => 'fa fa-shield',
            'fa fa-shopping-cart' => 'fa fa-shopping-cart',
            'fa fa-sign-in' => 'fa fa-sign-in',
            'fa fa-sign-out' => 'fa fa-sign-out',
            'fa fa-signal' => 'fa fa-signal',
            'fa fa-sitemap' => 'fa fa-sitemap',
            'fa fa-sliders' => 'fa fa-sliders',
            'fa fa-smile-o' => 'fa fa-smile-o',
            'fa fa-sort' => 'fa fa-sort',
            'fa fa-sort-alpha-asc' => 'fa fa-sort-alpha-asc',
            'fa fa-sort-alpha-desc' => 'fa fa-sort-alpha-desc',
            'fa fa-sort-amount-asc' => 'fa fa-sort-amount-asc',
            'fa fa-sort-amount-desc' => 'fa fa-sort-amount-desc',
            'fa fa-sort-asc' => 'fa fa-sort-asc',
            'fa fa-sort-desc' => 'fa fa-sort-desc',
            'fa fa-sort-down' => 'fa fa-sort-down',
            'fa fa-sort-numeric-asc' => 'fa fa-sort-numeric-asc',
            'fa fa-sort-numeric-desc' => 'fa fa-sort-numeric-desc',
            'fa fa-sort-up' => 'fa fa-sort-up',
            'fa fa-space-shuttle' => 'fa fa-space-shuttle',
            'fa fa-spinner' => 'fa fa-spinner',
            'fa fa-spoon' => 'fa fa-spoon',
            'fa fa-square' => 'fa fa-square',
            'fa fa-square-o' => 'fa fa-square-o',
            'fa fa-star' => 'fa fa-star',
            'fa fa-star-half' => 'fa fa-star-half',
            'fa fa-star-half-empty' => 'fa fa-star-half-empty',
            'fa fa-star-half-full' => 'fa fa-star-half-full',
            'fa fa-star-half-o' => 'fa fa-star-half-o',
            'fa fa-star-o' => 'fa fa-star-o',
            'fa fa-suitcase' => 'fa fa-suitcase',
            'fa fa-sun-o' => 'fa fa-sun-o',
            'fa fa-support' => 'fa fa-support',
            'fa fa-tablet' => 'fa fa-tablet',
            'fa fa-tachometer' => 'fa fa-tachometer',
            'fa fa-tag' => 'fa fa-tag',
            'fa fa-tags' => 'fa fa-tags',
            'fa fa-tasks' => 'fa fa-tasks',
            'fa fa-taxi' => 'fa fa-taxi',
            'fa fa-terminal' => 'fa fa-terminal',
            'fa fa-thumb-tack' => 'fa fa-thumb-tack',
            'fa fa-thumbs-down' => 'fa fa-thumbs-down',
            'fa fa-thumbs-o-down' => 'fa fa-thumbs-o-down',
            'fa fa-thumbs-o-up' => 'fa fa-thumbs-o-up',
            'fa fa-thumbs-up' => 'fa fa-thumbs-up',
            'fa fa-ticket' => 'fa fa-ticket',
            'fa fa-times' => 'fa fa-times',
            'fa fa-times-circle' => 'fa fa-times-circle',
            'fa fa-times-circle-o' => 'fa fa-times-circle-o',
            'fa fa-tint' => 'fa fa-tint',
            'fa fa-toggle-down' => 'fa fa-toggle-down',
            'fa fa-toggle-left' => 'fa fa-toggle-left',
            'fa fa-toggle-right' => 'fa fa-toggle-right',
            'fa fa-toggle-up' => 'fa fa-toggle-up',
            'fa fa-trash-o' => 'fa fa-trash-o',
            'fa fa-tree' => 'fa fa-tree',
            'fa fa-trophy' => 'fa fa-trophy',
            'fa fa-truck' => 'fa fa-truck',
            'fa fa-umbrella' => 'fa fa-umbrella',
            'fa fa-university' => 'fa fa-university',
            'fa fa-unlock' => 'fa fa-unlock',
            'fa fa-unlock-alt' => 'fa fa-unlock-alt',
            'fa fa-unsorted' => 'fa fa-unsorted',
            'fa fa-upload' => 'fa fa-upload',
            'fa fa-user' => 'fa fa-user',
            'fa fa-users' => 'fa fa-users',
            'fa fa-video-camera' => 'fa fa-video-camera',
            'fa fa-volume-down' => 'fa fa-volume-down',
            'fa fa-volume-off' => 'fa fa-volume-off',
            'fa fa-volume-up' => 'fa fa-volume-up',
            'fa fa-warning' => 'fa fa-warning',
            'fa fa-wheelchair' => 'fa fa-wheelchair',
            'fa fa-wrench' => 'fa fa-wrench',
            'fa fa-file' => 'fa fa-file',
            'fa fa-file-o' => 'fa fa-file-o',
            'fa fa-file-text' => 'fa fa-file-text',
            'fa fa-file-text-o' => 'fa fa-file-text-o',
            'fa fa-bitcoin' => 'fa fa-bitcoin',
            'fa fa-btc' => 'fa fa-btc',
            'fa fa-cny' => 'fa fa-cny',
            'fa fa-dollar' => 'fa fa-dollar',
            'fa fa-eur' => 'fa fa-eur',
            'fa fa-euro' => 'fa fa-euro',
            'fa fa-gbp' => 'fa fa-gbp',
            'fa fa-inr' => 'fa fa-inr',
            'fa fa-jpy' => 'fa fa-jpy',
            'fa fa-krw' => 'fa fa-krw',
            'fa fa-rmb' => 'fa fa-rmb',
            'fa fa-rouble' => 'fa fa-rouble',
            'fa fa-rub' => 'fa fa-rub',
            'fa fa-ruble' => 'fa fa-ruble',
            'fa fa-rupee' => 'fa fa-rupee',
            'fa fa-try' => 'fa fa-try',
            'fa fa-turkish-lira' => 'fa fa-turkish-lira',
            'fa fa-usd' => 'fa fa-usd',
            'fa fa-won' => 'fa fa-won',
            'fa fa-yen' => 'fa fa-yen',
            'fa fa-align-center' => ' fa fa-align-center',
            'fa fa-align-justify' => 'fa fa-align-justify',
            'fa fa-align-left' => 'fa fa-align-left',
            'fa fa-align-right' => 'fa fa-align-right',
            'fa fa-bold' => 'fa fa-bold',
            'fa fa-chain' => 'fa fa-chain',
            'fa fa-chain-broken' => 'fa fa-chain-broken',
            'fa fa-clipboard' => 'fa fa-clipboard',
            'fa fa-columns' => 'fa fa-columns',
            'fa fa-copy' => 'fa fa-copy',
            'fa fa-cut' => 'fa fa-cut',
            'fa fa-dedent' => 'fa fa-dedent',
            'fa fa-files-o' => 'fa fa-files-o',
            'fa fa-floppy-o' => 'fa fa-floppy-o',
            'fa fa-font' => 'fa fa-font',
            'fa fa-header' => 'fa fa-header',
            'fa fa-indent' => 'fa fa-indent',
            'fa fa-italic' => 'fa fa-italic',
            'fa fa-link' => 'fa fa-link',
            'fa fa-list' => 'fa fa-list',
            'fa fa-list-alt' => 'fa fa-list-alt',
            'fa fa-list-ol' => 'fa fa-list-ol',
            'fa fa-list-ul' => 'fa fa-list-ul',
            'fa fa-outdent' => 'fa fa-outdent',
            'fa fa-paperclip' => 'fa fa-paperclip',
            'fa fa-paragraph' => 'fa fa-paragraph',
            'fa fa-paste' => 'fa fa-paste',
            'fa fa-repeat' => 'fa fa-repeat',
            'fa fa-rotate-left' => 'fa fa-rotate-left',
            'fa fa-rotate-right' => 'fa fa-rotate-right',
            'fa fa-save' => 'fa fa-save',
            'fa fa-scissors' => 'fa fa-scissors',
            'fa fa-strikethrough' => 'fa fa-strikethrough',
            'fa fa-subscript' => 'fa fa-subscript',
            'fa fa-superscript' => 'fa fa-superscript',
            'fa fa-table' => 'fa fa-table',
            'fa fa-text-height' => 'fa fa-text-height',
            'fa fa-text-width' => 'fa fa-text-width',
            'fa fa-th' => 'fa fa-th',
            'fa fa-th-large' => 'fa fa-th-large',
            'fa fa-th-list' => 'fa fa-th-list',
            'fa fa-underline' => 'fa fa-underline',
            'fa fa-undo' => 'fa fa-undo',
            'fa fa-unlink' => 'fa fa-unlink',
            'fa fa-angle-double-down' => ' fa fa-angle-double-down',
            'fa fa-angle-double-left' => 'fa fa-angle-double-left',
            'fa fa-angle-double-right' => 'fa fa-angle-double-right',
            'fa fa-angle-double-up' => 'fa fa-angle-double-up',
            'fa fa-angle-down' => 'fa fa-angle-down',
            'fa fa-angle-left' => 'fa fa-angle-left',
            'fa fa-angle-right' => 'fa fa-angle-right',
            'fa fa-angle-up' => 'fa fa-angle-up',
            'fa fa-arrow-circle-down' => 'fa fa-arrow-circle-down',
            'fa fa-arrow-circle-left' => 'fa fa-arrow-circle-left',
            'fa fa-arrow-circle-o-down' => 'fa fa-arrow-circle-o-down',
            'fa fa-arrow-circle-o-left' => 'fa fa-arrow-circle-o-left',
            'fa fa-arrow-circle-o-right' => 'fa fa-arrow-circle-o-right',
            'fa fa-arrow-circle-o-up' => 'fa fa-arrow-circle-o-up',
            'fa fa-arrow-circle-right' => 'fa fa-arrow-circle-right',
            'fa fa-arrow-circle-up' => 'fa fa-arrow-circle-up',
            'fa fa-arrow-down' => 'fa fa-arrow-down',
            'fa fa-arrow-left' => 'fa fa-arrow-left',
            'fa fa-arrow-right' => 'fa fa-arrow-right',
            'fa fa-arrow-up' => 'fa fa-arrow-up',
            'fa fa-arrows-alt' => 'fa fa-arrows-alt',
            'fa fa-caret-down' => 'fa fa-caret-down',
            'fa fa-caret-left' => 'fa fa-caret-left',
            'fa fa-caret-right' => 'fa fa-caret-right',
            'fa fa-caret-up' => 'fa fa-caret-up',
            'fa fa-chevron-circle-down' => 'fa fa-chevron-circle-down',
            'fa fa-chevron-circle-left' => 'fa fa-chevron-circle-left',
            'fa fa-chevron-circle-right' => 'fa fa-chevron-circle-right',
            'fa fa-chevron-circle-up' => 'fa fa-chevron-circle-up',
            'fa fa-chevron-down' => 'fa fa-chevron-down',
            'fa fa-chevron-left' => 'fa fa-chevron-left',
            'fa fa-chevron-right' => 'fa fa-chevron-right',
            'fa fa-chevron-up' => 'fa fa-chevron-up',
            'fa fa-hand-o-down' => 'fa fa-hand-o-down',
            'fa fa-hand-o-left' => 'fa fa-hand-o-left',
            'fa fa-hand-o-right' => 'fa fa-hand-o-right',
            'fa fa-hand-o-up' => 'fa fa-hand-o-up',
            'fa fa-long-arrow-down' => 'fa fa-long-arrow-down',
            'fa fa-long-arrow-left' => 'fa fa-long-arrow-left',
            'fa fa-long-arrow-right' => 'fa fa-long-arrow-right',
            'fa fa-long-arrow-up' => 'fa fa-long-arrow-up',
            'fa fa-backward' => 'fa fa-backward',
            'fa fa-compress' => 'fa fa-compress',
            'fa fa-eject' => 'fa fa-eject',
            'fa fa-expand' => 'fa fa-expand',
            'fa fa-fast-backward' => 'fa fa-fast-backward',
            'fa fa-fast-forward' => 'fa fa-fast-forward',
            'fa fa-forward' => 'fa fa-forward',
            'fa fa-pause' => 'fa fa-pause',
            'fa fa-play' => 'fa fa-play',
            'fa fa-play-circle' => 'fa fa-play-circle',
            'fa fa-play-circle-o' => 'fa fa-play-circle-o',
            'fa fa-step-backward' => 'fa fa-step-backward',
            'fa fa-step-forward' => 'fa fa-step-forward',
            'fa fa-stop' => 'fa fa-stop',
            'fa fa-youtube-play' => 'fa fa-youtube-play'
            );

            $this->sections[] = array(
                'icon' => 'el-icon-comment',
                'title' => esc_html__('Blog Settings', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_divider_blog_archive_layout',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Blog Archive Layout</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_blog_layout',
                        'type'     => 'image_select',
                        'compiler' => true,
                        'title'    => esc_html__( 'Blog List Layout', 'faimos' ),
                        'subtitle' => esc_html__( 'Select Blog List layout.', 'faimos' ),
                        'options'  => array(
                            'faimos_blog_left_sidebar' => array(
                                'alt' => '2 Columns - Left sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                            ),
                            'faimos_blog_fullwidth' => array(
                                'alt' => '1 Column - Full width',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                            ),
                            'faimos_blog_right_sidebar' => array(
                                'alt' => '2 Columns - Right sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                            )
                        ),
                        'default'  => 'faimos_blog_right_sidebar'
                    ),
                    array(
                        'id'       => 'faimos_blog_layout_sidebar',
                        'type'     => 'select',
                        'data'     => 'sidebars',
                        'title'    => esc_html__( 'Blog List Sidebar', 'faimos' ),
                        'subtitle' => esc_html__( 'Select Blog List Sidebar.', 'faimos' ),
                        'default'   => 'sidebar-1',
                        'required' => array('faimos_blog_layout', '!=', 'faimos_blog_fullwidth'),
                    ),
                    array(
                        'id'        => 'blog-grid-columns',
                        'type'      => 'select',
                        'title'     => esc_html__('Grid columns', 'faimos'),
                        'subtitle'  => esc_html__('Select how many columns you want.', 'faimos'),
                        'options'   => array(
                                '1'   => '1',
                                '2'   => '2',
                                '3'   => '3',
                                '4'   => '4'
                            ),
                        'default'   => '1',
                    ),
                    array(
                        'id'   => 'faimos_divider_blog_single_layout',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Blog Single Article Layout</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_single_blog_layout',
                        'type'     => 'image_select',
                        'compiler' => true,
                        'title'    => esc_html__( 'Single Blog Layout', 'faimos' ),
                        'subtitle' => esc_html__( 'Select Single Blog Layout.', 'faimos' ),
                        'options'  => array(
                            'faimos_blog_left_sidebar' => array(
                                'alt' => '2 Columns - Left sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                            ),
                            'faimos_blog_fullwidth' => array(
                                'alt' => '1 Column - Full width',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                            ),
                            'faimos_blog_right_sidebar' => array(
                                'alt' => '2 Columns - Right sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                            )
                        ),
                        'default'  => 'faimos_blog_right_sidebar',
                        ),
                    array(
                        'id'       => 'faimos_single_blog_sidebar',
                        'type'     => 'select',
                        'data'     => 'sidebars',
                        'title'    => esc_html__( 'Single Blog Sidebar', 'faimos' ),
                        'subtitle' => esc_html__( 'Select Single Blog Sidebar.', 'faimos' ),
                        'default'   => 'sidebar-1',
                        'required' => array('faimos_single_blog_layout', '!=', 'faimos_blog_fullwidth'),
                    ),

                    array(
                        'id'   => 'faimos_divider_blog_single_tyography',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Blog Single Article Typography</h3>', 'faimos' )
                    ),
                    array(
                        'id'          => 'faimos-blog-post-typography',
                        'type'        => 'typography', 
                        'title'       => esc_html__('Blog Post Font family', 'faimos'),
                        'google'      => true, 
                        'font-backup' => true,
                        'color'       => true,
                        'text-align'  => false,
                        'letter-spacing'  => false,
                        'line-height'  => true,
                        'font-weight'  => true,
                        'font-size'   => true,
                        'font-style'  => false,
                        'subsets'     => false,
                        'output'      => array('p'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-family' => 'Barlow', 
                            'font-size' => '18px', 
                            'line-height' => '27px', 
                            'font-weight' => '400', 
                            'color' => '#373737', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'       => 'post_featured_image',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Enable/disable featured image for single post.', 'faimos'),
                        'subtitle' => esc_html__('Show or Hide the featured image from blog post page.".', 'faimos'),
                        'default'  => true,
                    ),
                )
            );


            # Tab: Shop Settings
            $this->sections[] = array(
                'icon' => 'el-icon-shopping-cart-sign',
                'title' => esc_html__('Shop Settings', 'faimos'),
            );
            // Subtab: Shop Archives
            $this->sections[] = array(
                'subsection' => true,
                'icon' => 'el-icon-th',
                'title' => esc_html__('Shop Archives', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_shop_archive',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Shop Archives</h3>', 'faimos' )
                    ),
                    array(
                        'id'       => 'faimos_shop_layout',
                        'type'     => 'image_select',
                        'compiler' => true,
                        'title'    => esc_html__( 'Shop List Products Layout', 'faimos' ),
                        'subtitle' => esc_html__( 'Select Shop List Products layout.', 'faimos' ),
                        'options'  => array(
                            'faimos_shop_left_sidebar' => array(
                                'alt' => '2 Columns - Left sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                            ),
                            'faimos_shop_fullwidth' => array(
                                'alt' => '1 Column - Full width',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                            ),
                            'faimos_shop_right_sidebar' => array(
                                'alt' => '2 Columns - Right sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                            )
                        ),
                        'default'  => 'faimos_shop_left_sidebar'
                    ),

                    array(
                        'id'       => 'faimos_shop_grid_list_switcher',
                        'type'     => 'select', 
                        'title'    => esc_html__('Grid / List default', 'faimos'),
                        'subtitle' => esc_html__('Choose which format products should display in by default.', 'faimos'),
                        'options'   => array(
                            'grid'   => esc_html__( 'Grid', 'faimos' ),
                            'list'   => esc_html__( 'List', 'faimos' ),
                        ),
                        'default'   => 'grid',
                    ),

                    array(
                        'id'       => 'faimos_shop_layout_sidebar',
                        'type'     => 'select',
                        'data'     => 'sidebars',
                        'title'    => esc_html__( 'Shop List Sidebar', 'faimos' ),
                        'subtitle' => esc_html__( 'Select Shop List Sidebar.', 'faimos' ),
                        'default'   => 'woocommerce',
                        'required' => array('faimos_shop_layout', '!=', 'faimos_shop_fullwidth'),
                    ),
                    array(
                        'id'        => 'faimos-shop-columns',
                        'type'      => 'select',
                        'title'     => esc_html__('Number of shop columns', 'faimos'),
                        'subtitle'  => esc_html__('Number of products per column to show on shop list template.', 'faimos'),
                        'options'   => array(
                            '2'   => '2 columns',
                            '3'   => '3 columns',
                            '4'   => '4 columns'
                        ),
                        'default'   => '4',
                    ),
                    array(
                        'id'       => 'faimos-enable-client-slider',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Enable Client Slider', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable Client Slider', 'faimos'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'faimos-enable-padding-cont',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Contain Products on Grid', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable extra padding for grid', 'faimos'),
                        'default'  => false,
                    ),
                )
            );

            // Subtab: Product Single
            $this->sections[] = array(
                'subsection' => true,
                'icon' => 'el-icon-shopping-cart-sign',
                'title' => esc_html__('Product Single', 'faimos'),
                'fields' => array(
                    array(
                        'id'   => 'faimos_shop_single_product',
                        'type' => 'info',
                        'class' => 'faimos_divider',
                        'desc' => __( '<h3>Product Page</h3>', 'faimos' )
                    ),
                    array(
                        'id'        => 'faimos_layout_version',
                        'type'      => 'select',
                        'title'     => esc_html__('Select Single Product layout', 'faimos'),
                        'subtitle'  => esc_html__('Unique layout to show on single product template.', 'faimos'),
                        'options'   => array(
                            ''   => 'Override default',
                            'main'   => 'Main Single Product'
                        ),
                        'default'   => 'main'
                    ),
                    array(
                        'id'       => 'faimos_single_product_layout',
                        'type'     => 'image_select',
                        'compiler' => true,
                        'title'    => esc_html__( 'Single Product Layout', 'faimos' ),
                        'subtitle' => esc_html__( 'Select Single Product Layout.', 'faimos' ),
                        'options'  => array(
                            'faimos_shop_left_sidebar' => array(
                                'alt' => '2 Columns - Left sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-left.jpg'
                            ),
                            'faimos_shop_fullwidth' => array(
                                'alt' => '1 Column - Full width',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-no.jpg'
                            ),
                            'faimos_shop_right_sidebar' => array(
                                'alt' => '2 Columns - Right sidebar',
                                'img' => get_template_directory_uri().'/redux-framework/assets/sidebar-right.jpg'
                            )
                        ),
                        'default'  => 'faimos_shop_fullwidth'
                    ),
                    array(
                        'id'       => 'faimos_single_shop_sidebar',
                        'type'     => 'select',
                        'data'     => 'sidebars',
                        'title'    => esc_html__( 'Shop Single Product Sidebar', 'faimos' ),
                        'subtitle' => esc_html__( 'Select Shop List Sidebar.', 'faimos' ),
                        'default'   => 'sidebar-1',
                        'required' => array('faimos_single_product_layout', '!=', 'faimos_shop_fullwidth'),
                    ),
                    array(
                        'id'       => 'faimos-enable-related-products',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Related Products', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable related products on single product', 'faimos'),
                        'default'  => true,
                    ),
                    array(
                        'id'        => 'faimos-related-products-number',
                        'type'      => 'select',
                        'title'     => esc_html__('Number of related products', 'faimos'),
                        'subtitle'  => esc_html__('Number of related products to show on single product template.', 'faimos'),
                        'options'   => array(
                            '2'   => '3',
                            '3'   => '6',
                            '4'   => '9'
                        ),
                        'default'   => '4',
                        'required' => array('faimos-enable-related-products', '=', true),
                    ),
                    array(
                        'id'       => 'faimos-enable-general-info',
                        'type'     => 'switch', 
                        'title'    => esc_html__('General Information', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable General Information on single product', 'faimos'),
                        'default'  => false,
                    ),
                    array(
                        'id' => 'faimos-enable-general-img1',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('First Icon', 'faimos') ,
                        'compiler' => 'true',
                        'required' => array('faimos-enable-general-info', '=', true),
                    ),
                    array(
                        'id' => 'faimos-enable-general-desc1',
                        'type' => 'editor',
                        'title' => esc_html__('First Block', 'faimos') ,
                        'default' => '<span>'.esc_html__('Lorem ipsum dolor sit amet, consectetur adipisc elit. Duis sollicitudin diam in diamui varius, sed anim.', 'faimos').'</span>',
                        'required' => array('faimos-enable-general-info', '=', true),
                    ),
                    array(
                        'id' => 'faimos-enable-general-img2',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Second Icon', 'faimos') ,
                        'compiler' => 'true',
                        'required' => array('faimos-enable-general-info', '=', true),
                    ),
                    array(
                        'id' => 'faimos-enable-general-desc2',
                        'type' => 'editor',
                        'title' => esc_html__('Second Block', 'faimos') ,
                        'default' => '<span>'.esc_html__('Lorem ipsum dolor sit amet, consectetur adipisc elit. Duis sollicitudin diam in diamui varius, sed anim.', 'faimos').'</span>',
                        'required' => array('faimos-enable-general-info', '=', true),
                    ),
                    array(
                        'id' => 'faimos-enable-general-img3',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Third Icon', 'faimos') ,
                        'compiler' => 'true',
                        'required' => array('faimos-enable-general-info', '=', true),
                    ),
                    array(
                        'id' => 'faimos-enable-general-desc3',
                        'type' => 'editor',
                        'title' => esc_html__('Third Block', 'faimos') ,
                        'default' => '<span>'.esc_html__('Lorem ipsum dolor sit amet, consectetur adipisc elit. Duis sollicitudin diam in diamui varius, sed anim.', 'faimos').'</span>',
                        'required' => array('faimos-enable-general-info', '=', true),
                    ),
                    array(
                        'id' => 'faimos-enable-general-img4',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Fourth Icon', 'faimos') ,
                        'compiler' => 'true',
                        'required' => array('faimos-enable-general-info', '=', true),
                    ),
                    array(
                        'id' => 'faimos-enable-general-desc4',
                        'type' => 'editor',
                        'title' => esc_html__('Fourth Block', 'faimos') ,
                        'default' => '<span>'.esc_html__('Lorem ipsum dolor sit amet, consectetur adipisc elit. Duis sollicitudin diam in diamui varius, sed anim.', 'faimos').'</span>',
                        'required' => array('faimos-enable-general-info', '=', true),
                    ),
                    array(
                        'id'       => 'faimos-enable-contact-info',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Contact Information', 'faimos'),
                        'subtitle' => esc_html__('Enable or disable Contact Information on single product', 'faimos'),
                        'default'  => true,
                    ),
                    array(
                        'id' => 'faimos-enable-contact-img',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Contact Icon', 'faimos') ,
                        'compiler' => 'true',
                        'required' => array('faimos-enable-contact-info', '=', true),
                    ),
                    array(
                        'id' => 'faimos-enable-contact-desc',
                        'type' => 'editor',
                        'title' => esc_html__('Contact Block', 'faimos') ,
                        'default' => '<span>'.esc_html__('Lorem ipsum dolor sit amet, consectetur adipisc elit. Duis sollicitudin diam in diamui varius, sed anim.', 'faimos').'</span>',
                        'required' => array('faimos-enable-contact-info', '=', true),
                    ),
                )
            );


            # Section: Social Media Settings
            $this->sections[] = array(
                'icon' => 'el-icon-myspace',
                'title' => esc_html__('Social Media Settings', 'faimos'),
                'fields' => array(
                    array(
                        'id' => 'faimos_social_fb',
                        'type' => 'text',
                        'title' => esc_html__('Facebook URL', 'faimos'),
                        'subtitle' => __('Type your Facebook url.', 'faimos'),
                        'validate' => 'url',
                        'default' => 'http://facebook.com'
                    ),
                    array(
                        'id' => 'faimos_social_tw',
                        'type' => 'text',
                        'title' => esc_html__('Twitter username', 'faimos'),
                        'subtitle' => esc_html__('Type your Twitter username.', 'faimos'),
                        'default' => 'google'
                    ),
                    array(
                        'id' => 'faimos_social_pinterest',
                        'type' => 'text',
                        'title' => esc_html__('Pinterest URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Pinterest url.', 'faimos'),
                        'validate' => 'url',
                        'default' => ''
                    ),
                    array(
                        'id' => 'faimos_social_skype',
                        'type' => 'text',
                        'title' => esc_html__('Skype Name', 'faimos'),
                        'subtitle' => esc_html__('Type your Skype username.', 'faimos'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'faimos_social_instagram',
                        'type' => 'text',
                        'title' => esc_html__('Instagram URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Instagram url.', 'faimos'),
                        'validate' => 'url',
                        'default' => 'http://instagram.com'
                    ),
                    array(
                        'id' => 'faimos_social_youtube',
                        'type' => 'text',
                        'title' => esc_html__('YouTube URL', 'faimos'),
                        'subtitle' => esc_html__('Type your YouTube url.', 'faimos'),
                        'validate' => 'url',
                        'default' => ''
                    ),
                    array(
                        'id' => 'faimos_social_dribbble',
                        'type' => 'text',
                        'title' => esc_html__('Dribbble URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Dribbble url.', 'faimos'),
                        'validate' => 'url',
                        'default' => ''
                    ),
                    array(
                        'id' => 'faimos_social_gplus',
                        'type' => 'text',
                        'title' => esc_html__('Google+ URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Google+ url.', 'faimos'),
                        'validate' => 'url',
                        'default' => ''
                    ),
                    array(
                        'id' => 'faimos_social_linkedin',
                        'type' => 'text',
                        'title' => esc_html__('LinkedIn URL', 'faimos'),
                        'subtitle' => esc_html__('Type your LinkedIn url.', 'faimos'),
                        'validate' => 'url',
                        'default' => 'http://linkedin.com'
                    ),
                    array(
                        'id' => 'faimos_social_deviantart',
                        'type' => 'text',
                        'title' => esc_html__('Deviant Art URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Deviant Art url.', 'faimos'),
                        'validate' => 'url',
                        'default' => 'http://deviantart.com'
                    ),
                    array(
                        'id' => 'faimos_social_digg',
                        'type' => 'text',
                        'title' => esc_html__('Digg URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Digg url.', 'faimos'),
                        'validate' => 'url'
                    ),
                    array(
                        'id' => 'faimos_social_flickr',
                        'type' => 'text',
                        'title' => esc_html__('Flickr URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Flickr url.', 'faimos'),
                        'validate' => 'url'
                    ),
                    array(
                        'id' => 'faimos_social_stumbleupon',
                        'type' => 'text',
                        'title' => esc_html__('Stumbleupon URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Stumbleupon url.', 'faimos'),
                        'validate' => 'url'
                    ),
                    array(
                        'id' => 'faimos_social_tumblr',
                        'type' => 'text',
                        'title' => esc_html__('Tumblr URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Tumblr url.', 'faimos'),
                        'validate' => 'url'
                    ),
                    array(
                        'id' => 'faimos_social_vimeo',
                        'type' => 'text',
                        'title' => esc_html__('Vimeo URL', 'faimos'),
                        'subtitle' => esc_html__('Type your Vimeo url.', 'faimos'),
                        'validate' => 'url'
                    ),
                )
            );


            $theme_info = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'faimos') . '<a href="' . esc_url($this->theme->get('ThemeURI')) . '" target="_blank">' . esc_html($this->theme->get('ThemeURI')) . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'faimos') . esc_html($this->theme->get('Author')) . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'faimos') . esc_html($this->theme->get('Version')) . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . esc_html($this->theme->get('Description')) . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'faimos') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => esc_html__('', 'faimos'),
                'content' => esc_html__('', 'faimos')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => esc_html__('', 'faimos'),
                'content' => esc_html__('', 'faimos')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('', 'faimos');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'redux_demo', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Theme Panel', 'faimos'),
                'page' => esc_html__('Theme Panel', 'faimos'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'menu_icon' => get_template_directory_uri().'/images/svg/theme-panel-menu-icon.svg', // Specify a custom URL to an icon
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => 'faimos_redux', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                'domain'              => 'faimos', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '',      
                'show_options_object' => false,   
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(esc_html__('', 'faimos'), $v);
            } else {
                $this->args['intro_text'] = esc_html__('', 'faimos');
            }

            // Add content after the form.
            $this->args['footer_text'] = esc_html__('', 'faimos');
        }

    }

    new Redux_Framework_faimos_config();
}