<?php

namespace Modeltheme_Addons_For_Wpbakery\includes;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

trait ContentControlSlider {
    /**
     * Slider Settings
     *
     * @return void
     */
    private function section_slider_hero_settings() {

        $this->start_controls_section(
          'section_slider_hero_settings',
          [
              'label' => esc_html__( 'Carousel/Grid', 'modeltheme-addons-for-wpbakery' ),
          ]
        );
        $this->add_control(
          'layout',
          [
            'label' => __( 'Layout', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
              ''          => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
              'carousel'    => __( 'Carousel', 'modeltheme-addons-for-wpbakery' ),
              'grid'      => __( 'Grid', 'modeltheme-addons-for-wpbakery' ),
            ],
          ]
        );
        $this->add_control(
          'items_desktop',
          [
            'label' => esc_html__( 'Visible Items (Desktop)', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 4,
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'items_mobile',
          [
            'label' => esc_html__( 'Visible Items (Mobiles)', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 1,
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'items_tablet',
          [
            'label' => esc_html__( 'Visible Items (Tablets)', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 4,
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'autoplay',
          [
            'label' => __( 'AutoPlay', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
            'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'delay',
          [
            'label' => esc_html__( 'Slide Speed (in ms)', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 500,
            'max' => 10000,
            'step' => 100,
            'default' => 600,
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'navigation',
          [
            'label' => __( 'Navigation', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
            'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'navigation_position',
          [
            'label' => __( 'Navigation Position', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
              ''           => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
              'nav_above_left'       => __( 'Above Slider Left', 'modeltheme-addons-for-wpbakery' ),
              'nav_above_center'     => __( 'Above Slider Center', 'modeltheme-addons-for-wpbakery' ),
              'nav_above_right'      => __( 'Above Slider Right', 'modeltheme-addons-for-wpbakery' ),
              'nav_top_left'         => __( 'Top Left (In Slider)', 'modeltheme-addons-for-wpbakery' ),
              'nav_top_center'     => __( 'Top Center (In Slider)', 'modeltheme-addons-for-wpbakery' ),
              'nav_top_right'      => __( 'Top Right (In Slider)', 'modeltheme-addons-for-wpbakery' ),
              'nav_middle'         => __( 'Middle Left/Right ( In Slider)', 'modeltheme-addons-for-wpbakery' ),
              'nav_middle_slider'  => __( 'Middle (Left/Right)', 'modeltheme-addons-for-wpbakery' ),
              'nav_bottom_left'      => __( 'Bottom Left (In Slider)', 'modeltheme-addons-for-wpbakery' ),
              'nav_bottom_center'    => __( 'Bottom Center (In Slider)', 'modeltheme-addons-for-wpbakery' ),
              'nav_bottom_right'     => __( 'Bottom Right (In Slider)', 'modeltheme-addons-for-wpbakery' ),
              'nav_below_left'     => __( 'Below Slider Left', 'modeltheme-addons-for-wpbakery' ),
              'nav_below_center'     => __( 'Below Slider Center', 'modeltheme-addons-for-wpbakery' ),
              'nav_below_right'      => __( 'Below Slider Right', 'modeltheme-addons-for-wpbakery' ),
            ],
            'condition' => [
              'navigation' => 'yes',
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'nav_style',
          [
            'label' => __( 'Navigation Shape', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
              ''           => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
              'nav-square'       => __( 'Square', 'modeltheme-addons-for-wpbakery' ),
              'nav-rounde'     => __( 'Rounded (5px Radius)', 'modeltheme-addons-for-wpbakery' ),
              'nav-round'      => __( 'Round (50px Radius)', 'modeltheme-addons-for-wpbakery' ),
            ],
            'condition' => [
              'navigation' => 'yes',
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'navigation_color',
          [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => __( 'Navigation color', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'condition' => [
              'navigation' => 'yes',
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'navigation_bg_color',
          [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => __( 'Navigation Background color', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'condition' => [
              'navigation' => 'yes',
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'navigation_color_hover',
          [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => __( 'Navigation Color Hover', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'selectors' => [
                '{{WRAPPER}} .swiper-button-prev:hover, {{WRAPPER}} .swiper-button-next:hover' => 'color: {{VALUE}};',
            ],
            'condition' => [
              'navigation' => 'yes',
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'navigation_bg_color_hover',
          [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => __( 'Navigation Background color - Hover', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'selectors' => [
                '{{WRAPPER}} .swiper-button-prev:hover, {{WRAPPER}} .swiper-button-next:hover' => 'background: {{VALUE}}',
            ],
            'condition' => [
              'navigation' => 'yes',
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'pagination',
          [
            'label' => __( 'Pagination (dots)', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
            'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'pagination_color',
          [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => __( 'Pagination color', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'selectors' => [
                '{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}}',
            ],
            'condition' => [
              'pagination' => 'yes',
            ],
          ]
        );
        $this->add_control(
          'space_items',
          [
            'label' => esc_html__( 'Space Between Items', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 30,
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'touch_move',
          [
            'label' => __( 'Allow Touch Move', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
            'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'grab_cursor',
          [
            'label' => __( 'Grab Cursor', 'modeltheme-addons-for-wpbakery' ),
            'placeholder' => esc_html__( 'If checked, will show the mouse pointer over the carousel', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
            'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
            'return_value' => 'yes',
            'default'      => 'no',
            'condition'    => [
              'layout'     => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'effect',
          [
            'label' => __( 'Carousel Effect', 'modeltheme-addons-for-wpbakery' ),
            'placeholder' => esc_html__( "See all availavble effects on <a target='_blank' href='https://swiperjs.com/demos#effect-fade'>swiperjs.com</a>", 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
              ''               => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
              'creative'       => __( 'Creative', 'modeltheme-addons-for-wpbakery' ),
              'cards'          => __( 'Cards', 'modeltheme-addons-for-wpbakery' ),
              'coverflow'      => __( 'Coverflow', 'modeltheme-addons-for-wpbakery' ),
              'cube'           => __( 'Cube', 'modeltheme-addons-for-wpbakery' ),
              'fade'           => __( 'Fade', 'modeltheme-addons-for-wpbakery' ),
              'flip'           => __( 'Flip', 'modeltheme-addons-for-wpbakery' ),
            ],
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'infinite_loop',
          [
            'label' => __( 'Infinite Loop', 'modeltheme-addons-for-wpbakery' ),
            'placeholder' => esc_html__( 'If checked, will show the numerical value of infinite loop', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
            'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'centered_slides',
          [
            'label' => __( 'Centered Slides', 'modeltheme-addons-for-wpbakery' ),
            'placeholder' => esc_html__( 'If checked, the left side and the right side will have a partial slide visible.', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
            'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition' => [
              'layout' => 'carousel',
            ],
          ]
        );
        $this->add_control(
          'columns',
          [
            'label' => __( 'Columns', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
              ''                => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
              'col-md-12'       => __( '1 Column', 'modeltheme-addons-for-wpbakery' ),
              'col-md-6'        => __( '2 Columns', 'modeltheme-addons-for-wpbakery' ),
              'col-md-4'        => __( '3 Columns', 'modeltheme-addons-for-wpbakery' ),
              'col-md-3'        => __( '4 Columns', 'modeltheme-addons-for-wpbakery' ),
              'col-md-2'        => __( '6 Columns', 'modeltheme-addons-for-wpbakery' ),
            ],
            'condition' => [
              'layout'  => 'grid',
            ],
          ]
        );


        $this->end_controls_section();
    }

}

if (!function_exists('modeltheme_addons_swiper_attributes')) {
  function modeltheme_addons_swiper_attributes($id = '', $autoplay = '', $delay = '', $items_desktop = '', $items_mobile = '', $items_tablet = '', $space_items = '', $touch_move = '', $effect = '', $grab_cursor = '', $infinite_loop = '', $centered_slides = '' , $navigation = '', $pagination = '', $grid_rows = ''){
    ?>
        data-swiper-id="<?php echo esc_attr($id); ?>"  
        data-swiper-autoplay="<?php echo esc_attr($autoplay); ?>"
        data-swiper-delay="<?php echo esc_attr($delay); ?>" 
        data-swiper-desktop-items="<?php echo esc_attr($items_desktop); ?>" 
        data-swiper-mobile-items="<?php echo esc_attr($items_mobile); ?>" 
        data-swiper-tablet-items="<?php echo esc_attr($items_tablet); ?>" 
        data-swiper-space-between-items="<?php echo esc_attr($space_items); ?>" 
        data-swiper-allow-touch-move="<?php echo esc_attr($touch_move); ?>" 
        data-swiper-effect="<?php echo esc_attr($effect); ?>"
        data-swiper-grab-cursor ="<?php echo esc_attr($grab_cursor); ?>"
        data-swiper-infinite-loop ="<?php echo esc_attr($infinite_loop); ?>"
        data-swiper-centered-slides ="<?php echo esc_attr($centered_slides); ?>"
        data-swiper-navigation ="<?php echo esc_attr($navigation); ?>"
        data-swiper-pagination ="<?php echo esc_attr($pagination); ?>"
        data-swiper-grid-rows="<?php echo esc_attr($grid_rows); ?>"
        

    <?php 
  }
}