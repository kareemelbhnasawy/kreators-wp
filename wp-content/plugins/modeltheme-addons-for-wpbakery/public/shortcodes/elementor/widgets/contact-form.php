<?php
namespace Elementor;

class addons_contact_form extends Widget_Base {
    
    public function get_style_depends() {
        wp_enqueue_style( 'contact-form', plugins_url( '../../../css/contact-form.css' , __FILE__ ));
        return [
            'contact-form',
        ];
    }

    public function get_name() {
        return 'mt-contact-form';
    }
     
    public function get_title() {
        return 'MT - Contact Form';
    }
    
    public function get_icon() {
        return 'eicon-form-horizontal';
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

        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
        $contact_forms = array();
        if ( $cf7 ) {
        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->ID ] = $cform->post_title;

        }
        } else {
            $contact_forms[ esc_html__( 'No contact forms found', 'modeltheme-addons-for-wpbakery' ) ] = 0;
        }
        $this->add_control(
            'contact_forms',
                [
                    'label' => __( 'Select Contact Form', 'modeltheme-addons-for-wpbakery' ),
                    'label_block' => true,
                    'type' => Controls_Manager::SELECT,
                    'options' => $contact_forms,
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_sub_heading',
            [
                'label' => esc_html__( 'Fields Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'fileds_typography', 
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} input[type="text"] .wpcf7-form input, .mt-addons-contact-form .wpcf7-form label, .wpcf7-form textarea',
            ]
        );

        $this->add_control(
            'styling',
            [
                'label' => __( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''              => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
                    'style-1'       => __( 'Style 1', 'modeltheme-addons-for-wpbakery' ),
                    'style-2'       => __( 'Style 2', 'modeltheme-addons-for-wpbakery' ),
                ]
            ]
        );
        $this->add_control(
            'placeholder_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Placeholder Color', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-contact-form ::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'label_width',
                [
                    'label' => esc_html__('Label Width', 'modeltheme-addons-for-wpbakery'),
                    'placeholder' => esc_html__( 'Type your width here', 'modeltheme-addons-for-wpbakery' ),
                    'type' => Controls_Manager::NUMBER,
                    'description' => esc_html__( 'in px', 'modeltheme-addons-for-wpbakery' ),
                    'selectors' => [
                        ' {{WRAPPER}} .mt-addons-contact-form .wpcf7-form textarea, {{WRAPPER}} .wpcf7-form-control:not(input[type="submit"])' => 'width: {{VALUE}}px',
                    ],
                ]
        );
        $this->add_responsive_control(
            'mobile_label_width',
            [
                'label'      => esc_html__( 'Margin', 'modeltheme-addons-for-wpbakery' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'background_label',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_padding_border',
                'label'    => esc_html__( 'Border', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .wpcf7-form input, .wpcf7-form textarea',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_padding_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form input, .wpcf7-form textarea',
            ]
        );

        $this->add_responsive_control(
            'styling_fields',
            [
                'label'      => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form input, .wpcf7-form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'btn_padding',
                [
                    'label' => esc_html__('Padding', 'modeltheme-addons-for-wpbakery'),
                    'type' => Controls_Manager::DIMENSIONS,
                     'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form-control:not(input[type="submit"])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],

                ]
                
        );
        $this->end_controls_tab();

        $this->end_controls_section();
        $this->start_controls_section(
            'focus_fields',
            [
                'label' => esc_html__( 'Focus Fields', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'focus_border',
                'label'    => esc_html__( 'Border', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .wpcf7-form input:focus, .wpcf7-form textarea:focus',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();
        
        $this->start_controls_section(
            'style_button',
            [
                'label' => esc_html__( 'Button', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typography',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .wpcf7-form button',
            ]
        );
        $this->add_control(
            'nav_top_bottom_pos',
                [
                    'label' => esc_html__('Top Bottom Position', 'modeltheme-addons-for-wpbakery'),
                    'placeholder' => esc_html__( 'Type your width here', 'modeltheme-addons-for-wpbakery' ),
                    'type' => Controls_Manager::NUMBER,
                    'description' => esc_html__( '%', 'modeltheme-addons-for-wpbakery' ),
                    'selectors' => [
                        '{{WRAPPER}} .mt-addons-contact-form .wpcf7-form button' => 'transform: translateY({{VALUE}}%)',
                    ],
                ]
        );
        $this->add_control(
            'button_background_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Button background color', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-contact-form button' => 'background: {{VALUE}}',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'button_background_hover_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Hover Background Color', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-contact-form button:hover' => 'background: {{VALUE}}',
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'button_background_text',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Button text color', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-contact-form button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_submit_border',
                'label'    => esc_html__( 'Border', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .wpcf7-form button',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_submit_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form button',
            ]
        );
        $this->add_responsive_control(
            'btn_submit_border',
            [
                'label'      => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7-form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'btn_submit_padding',
            [
                'label'      => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mt-addons-contact-form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->add_control(
            'form_theme_default',
            [
                'label' => __( 'Theme Default Form?', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( "If checked, the form will inherit styling from the theme (input/textarea/button). By selecting a style from the option above, the default options will be overridden", 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
                'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->end_controls_section();

    }
        
    protected function render() {
        $settings                 = $this->get_settings_for_display();
        $contact_forms            = $settings['contact_forms'];
        $styling                  = $settings['styling'];
        $form_theme_default       = $settings['form_theme_default'];
        $background_label         = $settings['background_label'];
        $placeholder_color        = $settings['placeholder_color'];
        $btn_padding              = $settings['btn_padding'];
        $styling_fields           = $settings['styling_fields'];
        $button_background_color  = $settings['button_background_color'];
        $button_background_text   = $settings['button_background_text'];
        $btn_submit_padding       = $settings['btn_submit_padding'];
        $label_width              = $settings['label_width'];
        $nav_top_bottom_pos       = $settings['nav_top_bottom_pos'];
        $mobile_label_width       = $settings['mobile_label_width'];

        // echo '<pre>' . var_export($styling_fields, true) . '</pre>';

        $shortcode_content = '';
        if ($contact_forms) {
            $shortcode_content .= do_shortcode('[mt-addons-contact-form page_builder="elementor" contact_forms="'.$contact_forms.'" 
                styling="'.$styling.'" 
                form_theme_default="'.$form_theme_default.'" 
                background_label="'.$background_label.'" 
                placeholder_color="'.$placeholder_color.'" 
                btn_padding="'.$btn_padding.'" 
                button_background_color="'.$button_background_color.'" 
                button_background_text="'.$button_background_text.'" 
                btn_submit_padding="'.$btn_submit_padding.'"
                label_width="'.$label_width.'"
                nav_top_bottom_pos="'.$nav_top_bottom_pos.'"]');
        }
        echo $shortcode_content;
    }
    protected function content_template() {

    }
}