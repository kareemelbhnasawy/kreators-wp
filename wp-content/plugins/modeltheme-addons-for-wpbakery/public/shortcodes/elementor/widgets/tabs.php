<?php
namespace Elementor;

class addons_tabs extends Widget_Base {
    
    public function get_style_depends() {
        wp_enqueue_style( 'tabs-css', plugins_url( '../../../css/tabs.css' , __FILE__ ));
        return [
            'tabs-css',
        ];
    }

    public function get_name() {
        return 'mt-tabs';
    }
    public function get_title() {
        return 'MT - Tabs';
    }
    public function get_icon() {
        return 'eicon-tabs';
    }
    public function get_categories() {
        return [ 'addons-widgets' ];
    } 
    public function get_script_depends() {
        
        wp_enqueue_script( 'tabs-js', plugins_url( '../../../js/tabs.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'tabs-js' ];
    }
    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        // start repeater
        $repeater = new Repeater();
        $repeater->add_control(
            'image', 
            [
                'label' => esc_html__( 'Tab Icon', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
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
                'label' => __( 'Description Content', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
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
        // end repeater;
    }
    protected function render() {
        $settings               = $this->get_settings_for_display();
        $category_tabs          = $settings['category_tabs'];
        $background_color       = $settings['background_color'];
        $tab_text               = $settings['tab_text'];
       

        $serialized_category_tabs = base64_encode(serialize($category_tabs));
        
        $shortcode_content = '';
        // echo '<pre>' . var_export($member_groups, true) . '</pre>';
        $shortcode_content .= do_shortcode('[mt-addons-tabs page_builder="elementor" category_tabs="'.$serialized_category_tabs.'" tab_text="'.$tab_text.'" background_color="'.$background_color.'"]');

        echo  $shortcode_content;


    }
    protected function content_template() {

    }
}