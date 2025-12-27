<?php
namespace Elementor;

class addons_absolute_element extends Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'absolute-element', plugins_url( '../../../css/absolute-element.css' , __FILE__ ));
        return [
            'absolute-element',
        ];
    }    
    public function get_name() {
        return 'mt-absolute-element'; 
    }
    public function get_title() {
        return 'MT - Absolute Element';
    }
    public function get_icon() {
        return 'eicon-elementor-circle';
    }
    public function get_categories() {
        return [ 'addons-widgets' ];
    }
    
    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control(
            'image_shape',
            [
                'label' => __( 'Image Shape', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'options' => [
                    ''                  => __( 'Select', 'modeltheme-addons-for-wpbakery' ),
                    'img-rounded'       => __( 'Rounded', 'modeltheme-addons-for-wpbakery' ),
                    'img-circle'        => __( 'Circle', 'modeltheme-addons-for-wpbakery' ),
                    'img-square'        => __( 'Square', 'modeltheme-addons-for-wpbakery' ),
                ]
            ]
        );
        // start repeater
        $repeater = new Repeater();
        $repeater->add_control(
            'image', 
            [
                'label' => esc_html__( 'Element Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'element_photo_height',
            [
                'label' => esc_html__( 'Element Height', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
            ]
        );
        $repeater->add_control( 
            'left_percent',
            [
                'label' => esc_html__( "Left (%) - Do not write the '%'", 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
            ]
        );
        $repeater->add_control(
            'top_percent',
            [
                'label' => esc_html__("Top (%) - Do not write the '%'", 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
            ]
        );
        $repeater->add_control(
            'enable_animation',
            [
                'label' => __( 'Image Animation', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
                'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'animation_type',
            [
                'label' => __( 'Animation Type', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'options' => [
                    ''              => __( 'Select', 'modeltheme-addons-for-wpbakery' ),
                    'rotate'        => __( 'Rotate', 'modeltheme-addons-for-wpbakery' ),
                    'float'         => __( 'Float', 'modeltheme-addons-for-wpbakery' ),
                ],
                'condition' => [
                    'enable_animation' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'elements',
            [
                'label' => esc_html__('Elements Items', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls()
            ]
        );
        // end repeater;
    }
    protected function render() {
        $settings               = $this->get_settings_for_display();
        $image_shape            = $settings['image_shape'];
        $elements               = $settings['elements'];
       

        $serialized_elements_groups = base64_encode(serialize($elements));
        
        $shortcode_content = '';
        // echo '<pre>' . var_export($member_groups, true) . '</pre>';
        $shortcode_content .= do_shortcode('[mt-addons-absolute-element page_builder="elementor" elements="'.$serialized_elements_groups.'" image_shape="'.$image_shape.'"]');

        echo  $shortcode_content;


    }
    protected function content_template() {

    }
}