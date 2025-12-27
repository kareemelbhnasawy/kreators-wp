<?php
namespace Elementor;

class addons_pricing_table_v2 extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'pricing-table-v2', plugins_url( '../../../css/pricing-table-v2.css' , __FILE__ ));

        return [
            'pricing-table-v2',
        ];

    }

    public function get_name()
    {
        return 'pricing-table-v2';
    }

    public function get_title()
    {
        return esc_html__('MT - Pricing Table V2', 'modeltheme-addons-for-wpbakery');
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
            'section_title',
            [
                'label' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
            ]
        );
        $this->add_control(
            'tag_select',
            [
                'label' => esc_html__('Tag Select', 'modeltheme-addons-for-wpbakery'),
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
            'section_price',
            [
                'label' => esc_html__('Price', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'currency',
            [
                'label' => esc_html__('Currency', 'modeltheme-addons-for-wpbakery'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Currency', 'modeltheme-addons-for-wpbakery'),
            ]
        );
        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'modeltheme-addons-for-wpbakery'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => esc_html__('Price', 'modeltheme-addons-for-wpbakery'),
            ]
        );
        $this->add_control(
            'period',
            [
                'label' => esc_html__('Period', 'modeltheme-addons-for-wpbakery'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Period', 'modeltheme-addons-for-wpbakery'),
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
            'section_card_style',
            [
                'label' => esc_html__('Card Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'card_color',
            [
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-table-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                'default' => 'left',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .price-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_price_style',
            [
                'label' => esc_html__('Price Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'price_align',
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
                'default' => 'left',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .cd-value-year',
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cd-value-year' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .cd-duration',
            ]
        );
        $this->add_control(
            'period_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cd-duration' => 'color: {{VALUE}}',
                ],
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
                'selector' => '{{WRAPPER}} .mt-btn',
            ]
        );
        $this->add_group_control(
            'box-shadow',
            [
                'name'     => 'button_content_box_shadow',
                'selector' => '{{WRAPPER}} .mt-btn',
            ]
        );
        $this->add_control(
            'border-radius',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border Button', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-btn',
            ]
        );
        $this->add_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_text_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .mt-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_text_color_hover',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Color Hover', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .mt-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .mt-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_color_hover',
            [
                'label' => esc_html__( 'Background Hover', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-btn:hover' => 'background-color: {{VALUE}}',
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
            'icon',
            [
                'label' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .package-list-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $repeater->add_control(
            'package_text',
            [
                'label' => esc_html__('Package Text', 'modeltheme-addons-for-wpbakery'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Package Text', 'modeltheme-addons-for-wpbakery'),
            ]
        );
        $repeater->add_control(
            'package_color',
            [
                'label' => esc_html__( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .package-list-text' => 'color: {{VALUE}}',
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
            ]
        );
        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $tag_select = $settings['tag_select'];

        $currency = $settings['currency'];
        $period = $settings['period'];
        $price = $settings['price'];

        $title_align = $settings['title_align'];
        $price_align = $settings['price_align'];

        $list = $settings['list'];

        $button_title = $settings['button_title'];
        $button_align = $settings['text_align'];
        $button_link = $settings['button_link']['url'];

        if ( ! empty( $settings['button_link']['url'] ) ) {
            $this->add_link_attributes( 'button_link', $settings['button_link'] );
        }

        ?>
            <div class="price-table-container">
                <div class="mt-package-title" style="text-align: <?php echo $title_align; ?>">
                    <div class="mt-addon-spacer"></div>
                    <<?php echo esc_attr($tag_select); ?> class="price-title">
                        <?php echo $title; ?>
                    </<?php echo esc_attr($tag_select); ?>>
                </div>
                <div class="mt-package-price" style="text-align: <?php echo $price_align; ?>">
                    <span class="cd-value-year">
                        <sup><?php echo $currency; ?></sup>
                            <?php echo $price; ?>
                        <span class="line">/</span>
                    </span>
                    <span class="cd-duration"><?php echo $period; ?></span>
                </div>
                <div class="mt-package-list">
                    <ul>
                        <?php foreach ( $list as $feature ) {
                            $icon = $feature['icon']['value'];
                            $icon_color = $feature['icon_color'];
                            $package_text = $feature['package_text'];
                            ?>

                            <li class="package-list-item">
                                <i class="package-list-icon <?php echo $icon; ?>" style="color: <?php echo $icon_color; ?>"aria-hidden="true"></i>
                                <span class="package-list-text"><?php echo $package_text; ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="mt-btn-zone" style="justify-content: <?php echo $button_align ?>">
                    <?php
                    if ( 'yes' === $settings['show_button'] ) {
                        echo '<a class="mt-btn" href="'.$button_link.'">'.$button_title.'</a>';
                    } ?>
                </div>
            </div>
        <?php
    }

    protected function content_template() {}
}

