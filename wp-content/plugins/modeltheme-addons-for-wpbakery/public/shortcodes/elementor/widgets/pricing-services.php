<?php
namespace Elementor;

class addons_pricing_services extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'pricing-services', plugins_url( '../../../css/pricing-services.css' , __FILE__ ));

        return [
            'pricing-services',
        ];

    }

    public function get_name()
    {
        return 'pricing-services';
    }

    public function get_title()
    {
        return esc_html__('MT - Pricing Services', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'prcing', 'table', 'highlight', 'custom' ];
    }



    protected function register_controls()
    {
        $this->start_controls_section(
            'section_service',
            [
                'label' => esc_html__( 'Service', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'padding_price_list',
            [
                'label' => esc_html__( 'Padding price list', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-list-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'textdomain' ),
                'selector' => '{{WRAPPER}} .price-container',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .price-container',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control (
            'tag_select',
            [
                'label'=> esc_html__('Tag Select Title', 'modeltheme-addons-for-wpbakery'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __('Select', 'modeltheme-addons-for-wpbakery'),
                    'h1' => __('h1', 'modeltheme-addons-for-wpbakery'),
                    'h2' => __('h2', 'modeltheme-addons-for-wpbakery'),
                    'h3' => __('h3', 'modeltheme-addons-for-wpbakery'),
                    'h4' => __('h4', 'modeltheme-addons-for-wpbakery'),
                    'h5' => __('h5', 'modeltheme-addons-for-wpbakery'),
                    'h6' => __('h6', 'modeltheme-addons-for-wpbakery'),
                ],
                'default' => 'h1',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'title_card_color_section',
            [
                'label' => esc_html__( 'Title Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .mt-price-title',
            ]
        );
        $this->add_control(
            'card_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'default' => '#fefefe',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-price-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_align',
            [
                'label' => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'padding_title',
            [
                'label' => esc_html__( 'Padding Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-price-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
        $this->add_control (
            'tag_select2',
            [
                'label'=> esc_html__('Tag Select Subtitle', 'modeltheme-addons-for-wpbakery'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __('Select', 'modeltheme-addons-for-wpbakery'),
                    'h1' => __('h1', 'modeltheme-addons-for-wpbakery'),
                    'h2' => __('h2', 'modeltheme-addons-for-wpbakery'),
                    'h3' => __('h3', 'modeltheme-addons-for-wpbakery'),
                    'h4' => __('h4', 'modeltheme-addons-for-wpbakery'),
                    'h5' => __('h5', 'modeltheme-addons-for-wpbakery'),
                    'h6' => __('h6', 'modeltheme-addons-for-wpbakery'),
                ],
                'default' => 'h3',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'subtitle_card_color_section',
            [
                'label' => esc_html__( 'Subtitle Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content2_typography',
                'selector' => '{{WRAPPER}} .mt-price-subtitle',
            ]
        );
        $this->add_control(
            'card_color2',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'default' => '#fefefe',
            ]
        );
        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-price-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'subtitle_align',
            [
                'label' => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'padding_subtitle',
            [
                'label' => esc_html__( 'Padding Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-price-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'image_subtitle_section',
            [
                'label' => esc_html__( 'Image Card', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'full',
            ]
        );
        $this->add_responsive_control(
            'image_align',
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'elementor' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'section_icon',
                [
                    'label' => esc_html__( 'Icon', 'elementor' ),
                ]
            );
    
            $this->add_control(
                'icon_holder',
                [
                    'label' => esc_html__( 'Icon', 'text-domain' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                ]
            );
    
            $this->add_control(
                'icon_align',
                [
                    'label' => esc_html__( 'Alignment', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'plugin-name' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'plugin-name' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'plugin-name' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'toggle' => true,
                ]
            );
        $this->end_controls_section();
            
        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__( 'Button', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_button',
            [
                'label' => esc_html__( 'Show Button', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'modeltheme-addons-for-wpbakery' ),
                'label_off' => esc_html__( 'Hide', 'modeltheme-addons-for-wpbakery' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'button_title',
            [
                'label' => esc_html__( 'Button Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Button', 'modeltheme-addons-for-wpbakery' ),
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'condition' => [
                    'show_button' => 'yes',
                ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'list_style',
            [
                'label' => esc_html__( 'List Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'list_color',
            [
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-list-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'list_title_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-list-item' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'list_typography',
                'selector' => '{{WRAPPER}} .price-list-item',
            ]
        );
        $this->add_control(
            'padding_list',
            [
                'label' => esc_html__( 'Padding list item', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .price-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'service_align',
            [
                'label' => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'Icon_style',
            [
                'label' => esc_html__( 'Icon Style', 'essential-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icons_options',
            [
                'label' => esc_html__( 'Icons Style', 'essential-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );  

        $this->add_control(
            'icons_color',
            [
                'label' => esc_html__( 'Color', 'essential-elementor-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .icon-section' => 'color: {{VALUE}}',
                ],
            ]
        );  

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'icons_typography',
                'selector' => '{{WRAPPER}} .icon-section',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__( 'Button Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_content_typography',
                'selector' => '{{WRAPPER}} .pricing-btn',
            ]
        );
        $this->add_control(
            'border-radius',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__( 'Border Button', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .pricing-btn',
            ]
        );
        $this->add_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_text_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .pricing-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_text_color_hover',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Color Hover', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .pricing-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .pricing-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_color_hover',
            [
                'label' => esc_html__( 'Background Hover', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-btn:hover' => 'background-color: {{VALUE}}',
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
            'service_name', [
                'label' => esc_html__( 'Service Name', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Service Name' , 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'service_color',
            [
                'label' => esc_html__( 'Service Name Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-service' => 'color: {{VALUE}}',
                ],
            ]
        );
        $repeater->add_control(
            'service_price', [
                'label' => esc_html__( 'Service Price', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '$69' , 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Service Name Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-service-price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'list',
            [
                'label' => __( 'List Items', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '',
                'default' => [
                    [
                        'service_name' => esc_html__( 'Service 1', 'modeltheme-addons-for-wpbakery' ),
                        'service_price' => esc_html__( '10$', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'service_name' => esc_html__( 'Service 2', 'modeltheme-addons-for-wpbakery' ),
                        'service_price' => esc_html__( '15$', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'service_name' => esc_html__( 'Service 3', 'modeltheme-addons-for-wpbakery' ),
                        'service_price' => esc_html__( '20$', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'service_name' => esc_html__( 'Service 4', 'modeltheme-addons-for-wpbakery' ),
                        'service_price' => esc_html__( '25$', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'service_name' => esc_html__( 'Service 5', 'modeltheme-addons-for-wpbakery' ),
                        'service_price' => esc_html__( '30$', 'modeltheme-addons-for-wpbakery' ),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $tag_select = $settings['tag_select'];
        $card_color = $settings['card_color'];
        $title_align = $settings['title_align'];
        
        $subtitle = $settings['subtitle'];
        $tag_select2 = $settings['tag_select2'];
        $subtitle_align = $settings['subtitle_align'];

        $image = $settings['image'];
        $image_align = $settings['image_align'];

        $icon_holder = $settings['icon_holder'];

        $list = $settings['list'];
        $service_align = $settings['service_align'];

        $button_title = $settings['button_title'];
        $button_align = $settings['text_align'];
        $button_link = $settings['button_link']['url'];


        if ( ! empty( $settings['button_link']['url'] ) ) {
        $this->add_link_attributes( 'button_link', $settings['button_link'] );
        }
        ?>

        <div class="services-container">
            <div class="price-container">
                <div class="title-pricing" style="background-color: <?php echo esc_attr($card_color); ?> ">
                    <div class="title-align" style="text-align: <?php echo esc_attr($title_align); ?>">
                        <<?php echo esc_attr($tag_select); ?> class="mt-price-title">
                            <?php echo esc_html($title); ?>
                        </<?php echo esc_attr($tag_select); ?>>
                    </div>
                </div>
                <div class="image-section" style="text-align: <?php echo esc_attr($image_align); ?>">
                    <div class="<?php echo esc_url($image); ?> col-sm-12 col-12 thumb-img">
                        <div class="mt-contact-card-img-wrapper">
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image') ?>
                        </div>
                    </div>
                </div>
                <div style="text-align: <?php echo esc_attr( $settings['icon_align'] ) ?>;">
                    <div class=" icon-section">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['icon_holder'], [ 'aria-hidden' => 'true' ] ) ?>
                    </div>
                </div>
                <div class=" subtitle-pricing" style="text-align: <?php echo esc_attr($subtitle_align); ?>">
                    <<?php echo esc_attr($tag_select2); ?> class="mt-price-subtitle">
                        <?php if (!empty($subtitle)){?>
                            <?php echo esc_html($subtitle); ?>
                        <?php } ?>
                    </<?php echo esc_attr($tag_select2); ?>>
                </div>
                <div class=" price-list-container">
                    <ul class="price-list">
                        <?php foreach (  $list as $item ) {
                            $service_name = $item['service_name'];
                            $service_price = $item['service_price']; ?>
                            <li class="price-list-item">
                                <span class="mt-service" style="text-align: <?php echo esc_attr($service_align); ?>"><?php echo esc_attr($service_name); ?></span>
                                <strong class="mt-service-price"><?php echo  esc_html($service_price); ?></strong>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="btn-zone" style="justify-content: <?php echo esc_attr($button_align); ?>">
                        <?php if ( 'yes' === $settings['show_button'] ) { echo '<a class="pricing-btn" href="'.$button_link.'">'.$button_title.'</a>'; }?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    protected function content_template() {}
}