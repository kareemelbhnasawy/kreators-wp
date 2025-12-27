<?php
namespace Elementor;

class addons_title_subtitle extends Widget_Base {
	
	public function get_name() {
		return 'title-subtitle';
	}
	
	public function get_title() {
		return 'MT - Title & Subtitle';
	}
	
	public function get_icon() {
		return 'eicon-post-title';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	
	

	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		

		$this->add_control(
            'section_align',
            [
                'label'   => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left'   => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'text-right'  => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle'  => false,
            ]
        );
		// $this->add_control(
		// 	'section_align',
		// 	[
		// 		'label' => __( 'Aligment', 'modeltheme-addons-for-wpbakery' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::SELECT,
		// 		'options' => [
		// 			'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
		// 			'text-left' 		=> __( 'Left', 'modeltheme-addons-for-wpbakery' ),
		// 			'text-center'		=> __( 'Center', 'modeltheme-addons-for-wpbakery' ),
		// 			'text-right' 		=> __( 'Right', 'modeltheme-addons-for-wpbakery' ),
		// 		]
		// 	]
		// );
		$this->add_control(
			'title',
			[
				'label' => __( 'Normal Text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
        $this->add_control(
            'title_underline',
            [
                'label' => __( 'Underline Text', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $this->add_control(
            'title_2',
            [
                'label' => __( 'Normal Text 2', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
		// $this->add_control(
		// 	'title_tag',
		// 	[
		// 		'label' => __( 'Element tag', 'modeltheme-addons-for-wpbakery' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::SELECT,
		// 		'options' => [
		// 			'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
		// 			'h1' 		=> __( 'h1', 'modeltheme-addons-for-wpbakery' ),
		// 			'h2'		=> __( 'h2', 'modeltheme-addons-for-wpbakery' ),
		// 			'h3' 		=> __( 'h3', 'modeltheme-addons-for-wpbakery' ),
		// 			'h4' 		=> __( 'h4', 'modeltheme-addons-for-wpbakery' ),
		// 			'h5' 		=> __( 'h5', 'modeltheme-addons-for-wpbakery' ),
		// 			'h6' 		=> __( 'h6', 'modeltheme-addons-for-wpbakery' ),
		// 			'p' 		=> __( 'p', 'modeltheme-addons-for-wpbakery' ),

		// 		],
		// 		'default' => 'h1',
		// 	]
		// );
		// $this->add_control(
		// 	'title_color',
		// 	[
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
		// 		'label_block' => true,
		// 	]
		// );
		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'title_line',
			[
				'label' => esc_html__( 'Line height', 'modeltheme-addons-for-wpbakery' ),
				'placeholder' => esc_html__( 'E.g.: 1.5 (Min: 0.1 - Max 3)', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0.1,
				'max' => 3,
				'step' => 0.1,
			]
		);
		$this->add_control(
			'title_weight',
			[
				'label' => esc_html__( 'Font weight', 'modeltheme-addons-for-wpbakery' ),
				'placeholder' => esc_html__( 'E.g.: 500', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__( 'Title Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'fields_typography',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-title-section',
            ]
        );
        $this->add_control(
            'underline_style',
            [
                'label' => esc_html__( 'Underline Style', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'curved',
                'options' => [
                    'curved'  => esc_html__( 'Curved', 'modeltheme-addons-for-wpbakery' ),
                    'straight'  => esc_html__( 'Straight', 'modeltheme-addons-for-wpbakery' ),

                ],
            ]
        );
		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Element tag', 'modeltheme-addons-for-wpbakery' ),
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

				],
				'default' => 'h1',
			]
		);
		$this->add_control(
			'title_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
        $this->add_control(
            'line_color',
            [
                'label' => esc_html__( 'Line Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .curved:after' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .straight:after' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_section();
		$this->start_controls_section(
			'subtitle_tab',
			[
				'label' => __( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'subtitle_position',
			[
				'label' => __( 'Subtitle placement', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 	 => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					'up'       => __( 'Above Heading', 'modeltheme-addons-for-wpbakery' ),
					'down' 	   => __( 'Below Heading', 'modeltheme-addons-for-wpbakery' ),
				],
			]
		);
		// $this->add_control(
		// 	'subtitle_size',
		// 	[
		// 		'label' => esc_html__( 'Font size', 'modeltheme-addons-for-wpbakery' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 	]
		// );
		// $this->add_control(
		// 	'subtitle_line',
		// 	[
		// 		'label' => esc_html__( 'Line height', 'modeltheme-addons-for-wpbakery' ),
		// 		'placeholder' => esc_html__( 'E.g.: 1.5 (Min: 0.1 - Max 3)', 'modeltheme-addons-for-wpbakery' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 0.1,
		// 		'max' => 3,
		// 		'step' => 0.1,
		// 	]
		// );
		// $this->add_control(
		// 	'subtitle_weight',
		// 	[
		// 		'label' => esc_html__( 'Font weight', 'modeltheme-addons-for-wpbakery' ),
		// 		'placeholder' => esc_html__( 'E.g.: 500', 'modeltheme-addons-for-wpbakery' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 	]
		// );

		$this->end_controls_section();
		$this->start_controls_section(
            'style_subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'fileds_typography_subtitle',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-subtitle-section',
            ]
        ); 
        $this->add_control(
			'subtitle_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
        $this->end_controls_tab();

        $this->end_controls_section();
		$this->start_controls_section(
			'separator_tab',
			[
				'label' => __( 'Separator', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'separator_status',
			[
				'label' => __( 'Status', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'separator_type',
			[
				'label' => __( 'Type', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	=> __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					'svg'       => __( 'SVG', 'modeltheme-addons-for-wpbakery' ),
					'image' 	=> __( 'Image', 'modeltheme-addons-for-wpbakery' ),
				],
				'condition' => [
					'separator_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'separator',
			[
				'label' => __( 'Separator', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'separator_type' => 'image',
				],
			]
		);
		$this->add_control(
			'delimitator_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'separator_type' => 'svg',
				],
			
			]
		);
		$this->add_control(
			'content_svg',
			[
				'label' => __( 'HTML SVG', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'separator_type' => 'svg',
				],
				
			]
		);
	

		$this->end_controls_section();

	}
	
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $section_align 			= $settings['section_align'];
        $title 					= $settings['title'];
        $title_underline        = $settings['title_underline'];
        $title_2 				= $settings['title_2'];
        $title_tag 				= $settings['title_tag'];
        $underline_style        = $settings['underline_style'];
        $title_color 			= $settings['title_color'];
        $title_size 			= $settings['title_size'];
        $title_line 			= $settings['title_line'];
        $title_weight 			= $settings['title_weight'];
        $subtitle 				= $settings['subtitle'];
        $subtitle_position 		= $settings['subtitle_position'];
        $subtitle_color 		= $settings['subtitle_color'];
        // $subtitle_size 			= $settings['subtitle_size'];
        // $subtitle_line 			= $settings['subtitle_line'];
        // $subtitle_weight 		= $settings['subtitle_weight'];
        $separator_status 		= $settings['separator_status'];
        $separator_type 		= $settings['separator_type'];
        $separator 				= $settings['separator'];
        $delimitator_color 		= $settings['delimitator_color'];
        $content_svg 			= $settings['content_svg'];
		$btn_atts = '';

        if(!empty($separator)){ 

		$btn_atts .= $separator['id'].',';
	}
        $shortcode_content = '';


        $shortcode_content .= do_shortcode('[mt-addons-title-subtitle section_align="'.$section_align.'" title="'.$title.'" title_underline="'.$title_underline.'" title_2="'.$title_2.'" title_tag="'.$title_tag.' underline_style="'.$underline_style.'" title_color="'.$title_color.'" title_size="'.$title_size.'" title_weight="'.$title_weight.'" subtitle="'.$subtitle.'" subtitle_position="'.$subtitle_position.'" subtitle_color="'.$subtitle_color.'" separator_status="'.$separator_status.'" separator_type="'.$separator_type.'" separator="'.$btn_atts.'" delimitator_color="'.$delimitator_color.'" content_svg="'.$content_svg.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}