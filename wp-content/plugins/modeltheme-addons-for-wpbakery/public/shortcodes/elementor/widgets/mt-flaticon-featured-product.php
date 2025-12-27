<?php
namespace Elementor;
require_once(__DIR__.'/../../../fonts/flaticon_list.php');


class addons_mt_flaticon_featured_product extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'mt-featured-product', plugins_url( '../../../css/mt-flaticon-featured-product.css' , __FILE__ ));
        wp_enqueue_style( 'flaticon-css', plugins_url( '../../../css/flaticon.css' , __FILE__ ));

        return [
            'mt-flaticon-featured-product',
        ];

    }

    public function get_name()
    {
        return 'mt-flaticon-featured-product';
    }

    public function get_title()
    {
        return esc_html__('MT - Flaticon Featured Product', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-product-info';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'mt', 'featured', 'product', 'custom' ];
    }



    protected function register_controls()
    {
        $this->start_controls_section(
            'section_columns',
            [
                'label' => esc_html__('No. Of Columns', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'columns_number',
            [
                'label' => esc_html__( 'Columns Number', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '' => esc_html__( 'Default', 'modeltheme-addons-for-wpbakery' ),
                    'col-md-2' => esc_html__( '2 Cols', 'modeltheme-addons-for-wpbakery' ),
                    'col-md-3'  => esc_html__( '3 Cols', 'modeltheme-addons-for-wpbakery' ),
                    'col-md-4' => esc_html__( '4 Cols', 'modeltheme-addons-for-wpbakery' ),
                    'col-md-5' => esc_html__( '5 Cols', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'repeater_section',
            [
                'label' => esc_html__( 'List', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'item_link',
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
        $repeater->add_control(
            'additional_title',
            [
                'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'flaticon-bread' => esc_html__( 'Bread', 'modeltheme-addons-for-wpbakery' ),
                    'flaticon-fruits' => esc_html__( 'Fruits', 'modeltheme-addons-for-wpbakery' ),
                    'flaticon-flour'  => esc_html__( 'Flour', 'modeltheme-addons-for-wpbakery' ),
                    'flaticon-alcohol' => esc_html__( 'Alchohol', 'modeltheme-addons-for-wpbakery' ),
                    'flaticon-snacks' => esc_html__( 'Snacks', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $repeater->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'items',
            [
                'label' => __( 'List Items', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '',
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $columns = $settings['columns_number'];
        $items = $settings['items'];

        $html = '';
        $html .= '<div class="mt-addons-course-categories-wrapper row">';
            $html .= '<div class="mt-addons-categories-content mt_'.esc_attr($columns).'">';
                    foreach ($items as $item) {
                        $item_link = $item['item_link']['url'];
                        $additional_title = $item['additional_title'];
                        $icon_color = $item['icon_color'];
                        $icon = $item['icon'];


                        $html .= '<ul class="mt-addons-single-category-wrapper">';
                            $html .= '<li class="mt-addons-single-category glyph"><a href="'.esc_url($item_link).'">';
                            $html .= '<i style="color:'.$icon_color.' !important;" class="'.esc_attr($icon).' glyph-icon"></i>';
                            $html .= '<span class="mt-addons-category-title">'.esc_attr($additional_title).'</span>';
                        $html .= '</a></li>';
                        $html .= '</ul>';
                    }
             $html .= '</div>';
        $html .= '</div>';

        echo  $html;
    }

    protected function content_template() {}
}

