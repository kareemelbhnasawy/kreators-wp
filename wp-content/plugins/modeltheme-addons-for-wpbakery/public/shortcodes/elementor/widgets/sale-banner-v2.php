<?php
namespace Elementor;

class addons_sale_banner_v2 extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'styled-blog', plugins_url( '../../../css/sale-banner-v2.css' , __FILE__ ));

        return [
            'sale-banner-v2',
        ];

    }

    public function get_name()
    {
        return 'sale-banner-v2';
    }

    public function get_title()
    {
        return esc_html__('MT - Sale Banner V2', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'styled', 'blog', 'blogging', 'custom' ];
    }



    protected function register_controls()
    {
        $this->start_controls_section(
            'section_options',
            [
                'label' => esc_html__('Options', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control(
            'banner_count',
            [
                'label' => esc_html__( 'Banner Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'color_style',
            [
                'label' => esc_html__( 'Color Style', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'dark',
                'options' => [
                    'dark' => esc_html__( 'Dark', 'modeltheme-addons-for-wpbakery' ),
                    'light' => esc_html__( 'Light', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Layout Style', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'center' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                    'bottom' => esc_html__( 'Bottom', 'modeltheme-addons-for-wpbakery' ),
                    'right-center' => esc_html__( 'Right Center', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $banner_img = $settings['image'];
        $banner_button_url = $settings['button_link']['url'];
        $banner_button_text = $settings['button_text'];
        $banner_button_count = $settings['banner_count'];
        $color_style = $settings['color_style'];
        $layout = $settings['layout'];

        if (isset($layout)) {
            if ($layout == '' || $layout == 'right-center') {
                $layout_type = 'sale_banner_holder right';
            }elseif($layout == 'center'){
                $layout_type = 'sale_banner_center';
            }elseif($layout == 'bottom'){
                $layout_type = 'sale_banner_holder';
            }
        }else{
            $layout_type = 'sale_banner_holder';
        }

        $shortcode_content = '';
        #SALE BANNER
        $shortcode_content .= '<div class="sale_banner relative">';
        $shortcode_content .= '<img src="'.esc_url( $settings['image']['url'] ).'" alt="'.$banner_button_text.'" />';
        $shortcode_content .= '<a href="'.$banner_button_url.'">
                                    <div class="'.$layout_type.'">';
        $shortcode_content .= '<div class="masonry_holder '.$color_style.'">';
        $shortcode_content .= '<h3 class="category_name">'.$banner_button_text.'</h3>';
        $shortcode_content .= '<p class="category_count">'.$banner_button_count.'</p>';
        $shortcode_content .= '<span class="read-more">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
        $shortcode_content .= '</div>';
        $shortcode_content .= '</div></a>';
        $shortcode_content .= '</div>';

        echo $shortcode_content;
    }

    protected function content_template() {}
}

