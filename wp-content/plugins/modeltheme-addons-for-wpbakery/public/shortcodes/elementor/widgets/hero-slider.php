<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_hero_slider extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'mt-hero-slider', plugins_url( '../../../css/hero-slider.css' , __FILE__ ));
      	wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));

        return [
            'mt-hero-slider',
            'swiper-bundle',
        ];
    }

	use ContentControlSlider;
	
	public function get_name() { 
		return 'hero-slider';
	}
	
	public function get_title() {
		return 'MT - Hero Slider';
	}
	
	public function get_icon() {
		return 'eaicon-post-block';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
    public function get_script_depends() {
        
        wp_register_script( 'swiper', plugins_url( '../../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
        wp_register_script( 'hero-slider', plugins_url( '../../../js/swiper.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'swiper', 'hero-slider' ];
    }

	protected function register_controls() {

        $this->section_slider();
        $this->section_slider_hero_settings();

    }
    private function section_slider() {

        $this->start_controls_section(
            'section_slider',
            [
                'label' => esc_html__( 'Content', 'modeltheme-addons-for-wpbakery' ),
            ]
        );

    	$repeater = new Repeater();
		$repeater->add_control(
			'background_image',
			[
				'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control( 
			'gradient_color_1',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'slider_image_height',
			[
				'label' => esc_html__( 'Image Height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'background_gradient',
			[
				'label' => __( 'Background Gradient', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'background_gradient' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'gradient_color_2',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Gradient Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'background_gradient' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'section_align',
			[
				'label' => __( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'text-left' 		=> __( 'Left', 'modeltheme-addons-for-wpbakery' ),
					'text-center'		=> __( 'Center', 'modeltheme-addons-for-wpbakery' ),
					'text-right' 		=> __( 'Right', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => __( 'Element Title Tag', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'h1' 		=> __( 'h1', 'modeltheme-addons-for-wpbakery' ),
					'h2'		=> __( 'h2', 'modeltheme-addons-for-wpbakery' ),
					'h3' 		=> __( 'h3', 'modeltheme-addons-for-wpbakery' ),
					'h4' 		=> __( 'h4', 'modeltheme-addons-for-wpbakery' ),
					'h5' 		=> __( 'h5', 'modeltheme-addons-for-wpbakery' ),
					'h6' 		=> __( 'h6', 'modeltheme-addons-for-wpbakery' ),
					'p' 		=> __( 'p', 'modeltheme-addons-for-wpbakery' ),
					'div' 		=> __( 'div', 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'h1',
			]
		);
		$repeater->add_responsive_control(
			'slider_title_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				 'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .mt-addons-hero-slider-title' => 'color: {{VALUE}}',
                ],
			]
		);
		$repeater->add_control(
			'slider_title_size',
			[
				'label' => esc_html__( 'Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_title_line',
			[
				'label' => esc_html__( 'Line heigh', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_title_weight',
			[
				'label' => esc_html__( 'Font weight', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' => __( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$repeater->add_control(
			'subtitle_tag',
			[
				'label' => __( 'Element Subtitle Tag', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'h1' 		=> __( 'h1', 'modeltheme-addons-for-wpbakery' ),
					'h2'		=> __( 'h2', 'modeltheme-addons-for-wpbakery' ),
					'h3' 		=> __( 'h3', 'modeltheme-addons-for-wpbakery' ),
					'h4' 		=> __( 'h4', 'modeltheme-addons-for-wpbakery' ),
					'h5' 		=> __( 'h5', 'modeltheme-addons-for-wpbakery' ),
					'h6' 		=> __( 'h6', 'modeltheme-addons-for-wpbakery' ),
					'p' 		=> __( 'p', 'modeltheme-addons-for-wpbakery' ),
					'div' 		=> __( 'div', 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'h1',
			]
		);
		$repeater->add_responsive_control(
			'slider_subtitle_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Subtitle Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .mt-addons-hero-slider-subtitle' => 'color: {{VALUE}}',
                ],
			]
		);
		$repeater->add_control(
			'slider_subtitle_size',
			[
				'label' => esc_html__( 'Subtitle Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_subtitle_line',
			[
				'label' => esc_html__( 'Subtitle Line height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_subtitle_weight',
			[
				'label' => esc_html__( 'Subtitle Font weight', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$repeater->add_control(
			'before_title',
			[
				'label' => __( 'Before Title Text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$repeater->add_control(
			'before_tag',
			[
				'label' => __( 'Element Before Tag', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'h1' 		=> __( 'h1', 'modeltheme-addons-for-wpbakery' ),
					'h2'		=> __( 'h2', 'modeltheme-addons-for-wpbakery' ),
					'h3' 		=> __( 'h3', 'modeltheme-addons-for-wpbakery' ),
					'h4' 		=> __( 'h4', 'modeltheme-addons-for-wpbakery' ),
					'h5' 		=> __( 'h5', 'modeltheme-addons-for-wpbakery' ),
					'h6' 		=> __( 'h6', 'modeltheme-addons-for-wpbakery' ),
					'p' 		=> __( 'p', 'modeltheme-addons-for-wpbakery' ),
					'div' 		=> __( 'div', 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'h1',
			]
		);
		$repeater->add_responsive_control(
			'slider_beftitle_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Before Title Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .mt-addons-hero-slider-beftitle' => 'color: {{VALUE}}',
                ],
			]
		);
		$repeater->add_control(
			'slider_beftitle_size',
			[
				'label' => esc_html__( 'Before Title Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_beftitle_line',
			[
				'label' => esc_html__( 'Before Title Line height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_beftitle_weight',
			[
				'label' => esc_html__( 'Before Title Font weight', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$repeater->add_control(
			'discount',
			[
				'label' => __( 'Discount Text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$repeater->add_control(
			'discount_tag',
			[
				'label' => __( 'Element Discount Tag', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'h1' 		=> __( 'h1', 'modeltheme-addons-for-wpbakery' ),
					'h2'		=> __( 'h2', 'modeltheme-addons-for-wpbakery' ),
					'h3' 		=> __( 'h3', 'modeltheme-addons-for-wpbakery' ),
					'h4' 		=> __( 'h4', 'modeltheme-addons-for-wpbakery' ),
					'h5' 		=> __( 'h5', 'modeltheme-addons-for-wpbakery' ),
					'h6' 		=> __( 'h6', 'modeltheme-addons-for-wpbakery' ),
					'p' 		=> __( 'p', 'modeltheme-addons-for-wpbakery' ),
					'div' 		=> __( 'div', 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'h1',
			]
		);
		$repeater->add_responsive_control(
			'slider_discount_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Discount Title Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .mt-addons-hero-slider-discount' => 'color: {{VALUE}}',
                ],
			]
		);
		$repeater->add_control(
			'slider_discount_bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Discount Title Background Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'slider_discount_size',
			[
				'label' => esc_html__( 'Discount Title Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_discount_line',
			[
				'label' => esc_html__( 'Discount Title Line height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_discount_weight',
			[
				'label' => esc_html__( 'Discount Title Font weight', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$repeater->add_control(
			'after_subtitle',
			[
				'label' => __( 'After Subtitle Text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$repeater->add_control(
			'after_tag',
			[
				'label' => __( 'Element After Tag', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'h1' 		=> __( 'h1', 'modeltheme-addons-for-wpbakery' ),
					'h2'		=> __( 'h2', 'modeltheme-addons-for-wpbakery' ),
					'h3' 		=> __( 'h3', 'modeltheme-addons-for-wpbakery' ),
					'h4' 		=> __( 'h4', 'modeltheme-addons-for-wpbakery' ),
					'h5' 		=> __( 'h5', 'modeltheme-addons-for-wpbakery' ),
					'h6' 		=> __( 'h6', 'modeltheme-addons-for-wpbakery' ),
					'p' 		=> __( 'p', 'modeltheme-addons-for-wpbakery' ),
					'div' 		=> __( 'div', 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'h1',
			]
		);
		$repeater->add_responsive_control(
			'slider_aftersubtitle_color', 
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'After Subtitle Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .mt-addons-hero-slider-aftersubtitle' => 'color: {{VALUE}}',
                ],

			]
		);
		$repeater->add_control(
			'slider_aftersubtitle_size',
			[
				'label' => esc_html__( 'After Subtitle Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_aftersubtitle_line',
			[
				'label' => esc_html__( 'After Subtitle Line height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'slider_aftersubtitle_weight',
			[
				'label' => esc_html__( 'After Subtitle Font weight', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
			'button_status',
			[
				'label' => __( 'Button', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'slider_button_text',
			[
				'label' => __( 'Text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'button_status' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'button_style',
			[
				'label' => __( 'Style', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'round' 		=> __( 'Round (30px Radius)', 'modeltheme-addons-for-wpbakery' ),
					'rounded'		=> __( 'Rounded (5px Radius)', 'modeltheme-addons-for-wpbakery' ),
					'square'		=> __( 'Square', 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'rounded',
				'condition' => [
					'button_status' => 'yes',
				],
			]
		);
		$repeater->add_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mt-addons-hero-slider-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$repeater->add_control(
	    	'slider_button_url',
	        [
	            'label' => esc_html__('Link', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	            'condition' => [
					'button_status' => 'yes',
				],
	        ]
	    );
		$repeater->add_control(
			'slider_button_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'button_status' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'slider_button_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Hover Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'button_status' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'slider_button_background',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'button_status' => 'yes',
				],
			]
		);
		$repeater->add_control( 
			'slider_button_hover_bg',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Hover', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .mt-addons-hero-slider-button:hover' => 'color: {{VALUE}}',
                ],
				'condition' => [
					'button_status' => 'yes',
				],
			]
		);
	    $this->add_control(
	        'sliders_groups',
	        [
	            'label' => esc_html__('Sliders Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
		$this->end_controls_section();
		$this->start_controls_section(
            'section_responsive',
            [
                'label' => esc_html__( 'Responsive', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_responsive_control(
			'title_status',
			[
				'label' => __( 'Show/Hide title text', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Off', 'modeltheme-addons-for-wpbakery' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .mt-addons-hero-slider-title' => 'display: {{label_on}}',
				],
			]
		);
        $this->add_responsive_control(
			'subtitle_status',
			[
				'label' => __( 'Show/Hide subtitle text', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Off', 'modeltheme-addons-for-wpbakery' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .mt-addons-hero-slider-subtitle' => 'display: {{label_on}}',
				],
			]
		);
		$this->add_responsive_control(
			'before_status',
			[
				'label' => __( 'Show/Hide before text', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Off', 'modeltheme-addons-for-wpbakery' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .mt-addons-hero-slider-beftitle' => 'display: {{label_on}}',
				],
			]
		);
		$this->add_responsive_control(
			'discount_status',
			[
				'label' => __( 'Show/Hide before text', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Off', 'modeltheme-addons-for-wpbakery' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .mt-addons-hero-slider-discount' => 'display: {{label_on}}',
				],
			]
		);
		$this->add_responsive_control(
			'after_status',
			[
				'label' => __( 'Show/Hide aftersubtitle text', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Off', 'modeltheme-addons-for-wpbakery' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .mt-addons-hero-slider-aftersubtitle' => 'display: {{label_on}}',
				],
			]
		);
		$this->add_responsive_control(
			'button_status',
			[
				'label' => __( 'Show/Hide button', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Off', 'modeltheme-addons-for-wpbakery' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .mt-addons-hero-slider-button' => 'display: {{label_on}}',
				],
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $sliders_groups 			= $settings['sliders_groups'];
        //carousel
        $autoplay 					= $settings['autoplay'];
        $delay 					    = $settings['delay'];
        $items_desktop 				= $settings['items_desktop'];
        $items_mobile 				= $settings['items_mobile'];
        $items_tablet 				= $settings['items_tablet'];
        $space_items 				= $settings['space_items'];
        $touch_move 				= $settings['touch_move'];
        $effect 					= $settings['effect'];
        $grab_cursor 				= $settings['grab_cursor'];
        $infinite_loop 				= $settings['infinite_loop'];
        $columns 					= $settings['columns'];
        $layout 					= $settings['layout'];
        $centered_slides 			= $settings['centered_slides'];
        $navigation_position 		= $settings['navigation_position'];
        $nav_style 					= $settings['nav_style'];
        $navigation_color 			= $settings['navigation_color'];
        $navigation_bg_color 		= $settings['navigation_bg_color'];
        $navigation_bg_color_hover 	= $settings['navigation_bg_color_hover'];
        $navigation_color_hover 	= $settings['navigation_color_hover'];
        $pagination_color 			= $settings['pagination_color'];
        $navigation 				= $settings['navigation'];
        $pagination 				= $settings['pagination'];
        $button_padding 			= $settings['button_padding'];
        $slider_button_background 	= $settings['slider_button_background'];
        $slider_button_hover_bg 	= $settings['slider_button_hover_bg']; 
        $slider_button_color_hover 	= $settings['slider_button_color_hover']; 

		$serialized_sliders_groups = base64_encode(serialize($sliders_groups));
		$shortcode_content = '';

        $shortcode_content .= do_shortcode('[mt-addons-hero-slider 
        	page_builder="elementor" 
        	sliders_groups="'.$serialized_sliders_groups.'"  
        	autoplay="'.$autoplay.'" 
        	delay="'.$delay.'" 
        	items_desktop="'.$items_desktop.'" 
        	items_mobile="'.$items_mobile.'" 
        	items_tablet="'.$items_tablet.'" 
        	space_items="'.$space_items.'" 
        	touch_move="'.$touch_move.'" 
        	effect="'.$effect.'" 
        	grab_cursor="'.$grab_cursor.'" 
        	infinite_loop="'.$infinite_loop.'" 
        	columns="'.$columns.'" 
        	layout="'.$layout.'" 
        	centered_slides="'.$centered_slides.'" 
        	navigation_position="'.$navigation_position.'" 
        	nav_style="'.$nav_style.'" 
        	navigation_color="'.$navigation_color.'" 
        	navigation_bg_color="'.$navigation_bg_color.'" 
        	navigation_color_hover="'.$navigation_color_hover.'" 
        	navigation_bg_color_hover="'.$navigation_bg_color_hover.'" 
        	pagination_color="'.$pagination_color.'" 
        	navigation="'.$navigation.'" 
        	pagination="'.$pagination.'"
        	button_padding="'.$button_padding.'"
        	slider_button_background="'.$slider_button_background.'"
        	slider_button_hover_bg="'.$slider_button_hover_bg.'"
        	slider_button_color_hover="'.$slider_button_color_hover.'"
        	]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}