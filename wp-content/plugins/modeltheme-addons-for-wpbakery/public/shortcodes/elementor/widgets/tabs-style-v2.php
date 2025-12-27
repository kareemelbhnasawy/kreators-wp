<?php
namespace Elementor;

class addons_tabs_style_v2 extends Widget_Base {
    
    public function get_style_depends() {
        wp_enqueue_style( 'tabs-style-v2', plugins_url( '../../../css/tabs-style-v2.css' , __FILE__ ));
        return [
            'tabs-style-v2',
        ];
    }
    public function get_name() {
        return 'mt-tabs-style-v2';
    }
    public function get_title() {
        return 'MT - Tabs Style v2';
    }
    public function get_icon() {
        return 'eicon-tabs';
    }
    public function get_categories() {
        return [ 'addons-widgets' ];
    } 
    public function get_script_depends() {
        
        wp_enqueue_script( 'tabs-v2', plugins_url( '../../../js/tabs-v2.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'tabs-v2' ];
    }
    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control(
            'top_title',
            [
                'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        // start repeater
        $repeater = new Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => __( 'Tab Title', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'desc_image', 
            [
                'label' => esc_html__( 'Description Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        ); 
        $repeater->add_control(
            'desc_title',
            [
                'label' => __( 'Description Title', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'desc_content',
            [
                'label' => esc_html__( 'Description Content', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Default description', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your description here', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button text', 'modeltheme-addons-for-wpbakery' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'button_url',
            [
                'label' => esc_html__( 'Button URL', 'modeltheme-addons-for-wpbakery' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'button_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Button Color', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        ); 
        $repeater->add_control(
            'button_bg_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Background Color', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        ); 
        $this->add_control(
            'category_tabs',
            [
                'label' => esc_html__('Tabs Items', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls()
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_btn', 
            [
                'label' => esc_html__( 'Tab Styling', 'invent-slider' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'background_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Tab Backgroung (active)', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        ); 
        $this->add_control(
            'tab_text',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Tab Text Color', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_btns', 
            [
                'label' => esc_html__( 'Button Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'btn_content_border',
            [
                'label'      => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mt-addons-tab-content-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style', 
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'top_title_color',
            [
                'label' => esc_html__( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-tabs-nav-title-top' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mt-addons-tabs-nav-title-top',
            ]
        );
        $this->add_responsive_control(
            'padding_title',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-tabs-nav-title-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $category_tabs          = $settings['category_tabs'];
        $background_color       = $settings['background_color'];
        $tab_text               = $settings['tab_text'];
        $top_title              = $settings['top_title'];

        ?>
            <div class="mt-addons-tabs-v2">
                <nav>
                    <div class="mt-addons-header-tabs col-md-12">
                        <h5 class="mt-addons-tabs-nav-title-header-top col-md-6"></h5>

                        <h5 class="mt-addons-tabs-nav-title-top col-md-6"><?php echo esc_html($top_title);?></h5>
                    </div>
                    <ul class="mt-addons-tabs-nav-v2 col-md-6" style="background:<?php echo esc_attr($background_color);?>"> 
                        <?php $tab_id = 1; ?>
                        <?php if ($category_tabs) { ?>
                            <?php foreach ($category_tabs as $tab) { 
                                $title = $tab['title'];
                                ?>  

                              <li><a href="#section-iconbox-<?php echo $tab_id;?>"> 
                                <h5 class="mt-addons-tabs-nav-title" style="color:<?php echo esc_attr($tab_text); ?>;"><?php echo esc_html($title);?></h5>
                              </a></li> 
                              <?php $tab_id++; ?>
                            <?php } ?>
                        <?php }?>
                    </ul>
                </nav>
                <div class="mt-addons-tab-content-v2">
                    <?php $content_id = 1; ?>
                    <?php if ($category_tabs) { ?>
                        <?php foreach ($category_tabs as $tab) { 
                            $desc_image         = $tab['desc_image']['url'];
                            $desc_title         = $tab['desc_title'];
                            $desc_content       = $tab['desc_content'];
                            $button_text        = $tab['button_text'];
                            $button_url         = $tab['button_url'];
                            $button_color       = $tab['button_color'];
                            $button_bg_color    = $tab['button_bg_color'];

                        ?>
                        <section id="section-iconbox-<?php echo $content_id;?>">
                            <div class="row">
                                <div class="col-md-6 text-left"> 
                                    <img class="mt-addons-tab-content-image" src="<?php echo esc_url($desc_image); ?>" alt="tabs-image">
                                </div>
                                <div class="mt-addons-tab-v2-description col-md-6 text-left">
                                    <p class="mt-addons-tab-content-title"><?php echo esc_html($desc_title); ?></p>
                                    <div class="mt-addons-tab-content-v2"><?php echo $tab['desc_content']; ?></div>
                                     <?php  if($button_url != ''){ ?>
                                      <a class="mt-addons-tab-content-button"style="background-color: <?php echo esc_attr($button_bg_color); ?>; color: <?php echo esc_attr($button_color); ?>;" href="<?php echo esc_url($button_url); ?>" > <?php echo esc_html($tab['button_text']); ?>
                                      </a>
                                     <?php  } ?>
                                </div>
                          </div>                     
                        </section>
                        <?php $content_id++; ?>
                      <?php } ?>
                    <?php } ?>
                </div>
            </div>
    <?php }

    protected function content_template() {}
}
