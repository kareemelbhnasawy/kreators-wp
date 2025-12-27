<?php
namespace Elementor;

class addons_sale_banner extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'sale-banner', plugins_url( '../../../css/sale-banner.css' , __FILE__ ));

        return [
            'sale-banner',
        ];

    }

    public function get_name()
    {
        return 'sale-banner';
    }

    public function get_title()
    {
        return esc_html__('MT - Sale Banner', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-price-list';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'discount', 'sale', 'banner', 'highlight', 'custom' ];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'section_bg',
            [
                'label' => esc_html__('Container', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .mt-discount-container',
            ]
        );
        $this->add_control(
            'border-radius-bg',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-discount-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__( 'Container Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-discount-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_text_1',
            [
                'label' => esc_html__('Title Section', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_text_1',
            [
                'label' => esc_html__( 'Show Text', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'your-plugin' ),
                'label_off' => esc_html__( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'text_1',
            [
                'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
                'condition' => [
                    'show_text_1' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'margin_text_1',
            [
                'label' => esc_html__( 'Title Spacing', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .first-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_text_1' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_text_2',
            [
                'label' => esc_html__('Subtitle Section', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_text_2',
            [
                'label' => esc_html__( 'Show Text', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'your-plugin' ),
                'label_off' => esc_html__( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'text_2',
            [
                'label' => esc_html__( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
                'condition' => [
                    'show_text_2' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'margin_text_2',
            [
                'label' => esc_html__( 'Subtitle Spacing', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .second-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_text_2' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_text_3',
            [
                'label' => esc_html__('Paragraph Section', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_text_3',
            [
                'label' => esc_html__( 'Show Text', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'your-plugin' ),
                'label_off' => esc_html__( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'text_3',
            [
                'label' => esc_html__( 'Paragraph', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Paragraph', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
                'condition' => [
                    'show_text_3' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'margin_text_3',
            [
                'label' => esc_html__( 'Paragraph Spacing', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .third-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_text_3' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_btn',
            [
                'label' => esc_html__('Button Section', 'modeltheme-addons-for-wpbakery'),
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
        $this->add_control (
            'btn_title', [
                'label' => esc_html__( 'Button Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Button Title' , 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Button Link', 'modeltheme-addons-for-wpbakery' ),
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
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'text_style_1',
            [
                'label' => esc_html__('Title Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_text_1' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'text_1_align',
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
                'default' => 'flex-start',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_1_typography',
                'selector' => '{{WRAPPER}} .first-text',
            ]
        );
        $this->add_control(
            'text_color_1',
            [
                'label' => esc_html__( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .first-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'text_style_2',
            [
                'label' => esc_html__('Subtitle Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_text_2' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'text_2_align',
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
                'default' => 'flex-start',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_2_typography',
                'selector' => '{{WRAPPER}} .second-text',
            ]
        );
        $this->add_control(
            'text_color_2',
            [
                'label' => esc_html__( 'Subtitle Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .second-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'text_style_3',
            [
                'label' => esc_html__('Paragraph Section', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_text_3' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'text_3_align',
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
                'default' => 'flex-start',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_3_typography',
                'selector' => '{{WRAPPER}} .third-text',
            ]
        );
        $this->add_control(
            'text_color_3',
            [
                'label' => esc_html__( 'Paragraph Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .third-text' => 'color: {{VALUE}}',
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
            'button_align',
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
                'selector' => '{{WRAPPER}} .discount-btn',
            ]
        );
        $this->add_control(
            'border-radius',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .discount-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border Button', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .discount-btn',
            ]
        );
        $this->add_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .discount-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_text_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .discount-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_text_color_hover',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Color Hover', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .discount-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .discount-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_color_hover',
            [
                'label' => esc_html__( 'Background Hover', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .discount-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();

        $text_1 = $settings['text_1'];
        $text_2 = $settings['text_2'];
        $text_3 = $settings['text_3'];

        $text_1_align = $settings['text_1_align'];
        $text_2_align = $settings['text_2_align'];
        $text_3_align = $settings['text_3_align'];

        $button_link = $settings['button_link']['url'];
        $button_title = $settings['btn_title'];
        $button_align = $settings['button_align'];

        if ( ! empty( $settings['button_link']['url'] ) ) {
            $this->add_link_attributes( 'button_link', $settings['button_link'] );
        }
        ?>
        <div class="mt-discount-container">
            <div class="mt-discount-content">
                    <?php   if ( 'yes' === $settings['show_text_1'] ) {
                        echo  '<div class="first-text" style="text-align: '.$text_1_align.'">' .$text_1.'</div>';
                    } ?>
                    <?php   if ( 'yes' === $settings['show_text_2'] ) {
                        echo  '<div class="second-text" style="text-align: '.$text_2_align.'">' .$text_2.'</div>';
                    } ?>
                    <?php   if ( 'yes' === $settings['show_text_3'] ) {
                        echo  '<div class="third-text" style="text-align: '.$text_3_align.'">' .$text_3.'</div>';
                    } ?>
                <div class="discount-btn-zone" style="justify-content: <?php echo $button_align ?>">
                    <?php
                    if ( 'yes' === $settings['show_button'] ) {
                        echo   '<a class="discount-btn" href="'.$button_link.'" >' .$button_title.' </a>';
                    } ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}
}

