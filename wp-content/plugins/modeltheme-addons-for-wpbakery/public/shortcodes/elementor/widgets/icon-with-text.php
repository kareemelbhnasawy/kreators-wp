<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlElementorIcons;

class addons_icon_with_text extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'icon-list-group-item', plugins_url( '../../../css/icon-list-group-item.css' , __FILE__ ));

	        return [
	            'icon-list-group-item',
	        ];
    }
	use ContentControlElementorIcons;
	
	public function get_name() { 
		return 'icon-with-text';
	}
	
	public function get_title() {
		return 'MT - Icon With Text';
	}
	
	public function get_icon() {
		return 'eicon-nerd';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	
	protected function register_controls() {

        $this->section_title();
        $this->section_icons_settings();

    }
    private function section_title() {

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Content', 'modeltheme-addons-for-wpbakery' ),
            ]
        );

		// $this->add_control(
		// 	'section_aligment',
		// 	[
		// 		'label' => __( 'Section Aligment', 'modeltheme-addons-for-wpbakery' ),
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
            'section_aligment',
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
		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Icon Position', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'layout_before' 	=> __( 'Before Content', 'modeltheme-addons-for-wpbakery' ),
					'layout_top'		=> __( 'Top', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
	      'margin_right',
	      [
	        'label' => esc_html__( 'Margin Right', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	        'condition' => [
					'icon_position' => 'layout_before',
			],
	      ]
	    );
	    $this->add_control(
	      'style_margin_top',
	      [
	        'label' => esc_html__( 'Set space between items (Margin Top)', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	        'condition' => [
					'icon_position' => 'layout_before',
			],
	      ]
	    );
	    $this->add_control(
			'style_block',
			[
				'label' => __( 'Style', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'box_shadow'		=> __( 'Box Shadow', 'modeltheme-addons-for-wpbakery' ),
					'bg_box_color'			=> __( 'Backgroud Color', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
	      'background_box_color',
	      [
	        'type' => \Elementor\Controls_Manager::COLOR,
	        'label' => __( 'Backgroud Box Color', 'modeltheme-addons-for-wpbakery' ),
	        'label_block' => true,
	        'condition' => [
				'style_block' => 'bg_box_color',
			],
	      ]
	    );
		$this->add_control(
			'style_bg',
			[
				'label' => __( 'Style background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style_bg_color' 	=> __( 'Background Color', 'modeltheme-addons-for-wpbakery' ),
					''					=> __( 'No Background Color', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
	      'box_border_radius',
	      [
	        'label' => esc_html__( 'Box Border Radius', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	      ]
	    );
		$this->add_control(
	      'bg_color',
	      [
	        'type' => \Elementor\Controls_Manager::COLOR,
	        'label' => __( 'Image Background Color', 'modeltheme-addons-for-wpbakery' ),
	        'label_block' => true,
	        'condition' => [
				'style_bg' => 'style_bg_color',
			],
	      ]
	    );
		$this->end_controls_section();
		$this->start_controls_section(
			'title_tab',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title Label', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
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
		// $this->add_control(
		// 	'title_size',
		// 	[
		// 		'label' => esc_html__( 'Font size', 'modeltheme-addons-for-wpbakery' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 	]
		// );
		// $this->add_control(
		// 	'title_weight',
		// 	[
		// 		'label' => esc_html__( 'Font weight', 'modeltheme-addons-for-wpbakery' ),
		// 		'placeholder' => esc_html__( 'E.g.: 500', 'modeltheme-addons-for-wpbakery' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 	]
		// );
		// $this->add_control(
		// 	'title_height',
		// 	[
		// 		'label' => esc_html__( 'Line height', 'modeltheme-addons-for-wpbakery' ),
		// 		'placeholder' => esc_html__( 'E.g.: 1.5 (Min: 0.1 - Max 3)', 'modeltheme-addons-for-wpbakery' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'min' => 0.1,
		// 		'max' => 3,
		// 		'step' => 0.1,
		// 	]
		// );

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
				'label' => __( 'Label/SubTitle', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'subtitle_tag',
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
					'p' 		=> __( 'p' , 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'h3',
			]
		);
		// $this->add_control(
		// 	'subtitle_size',
		// 	[
		// 		'label' => esc_html__( 'SubTitle Font Size', 'modeltheme-addons-for-wpbakery' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 	]
		// );
		// $this->add_control(
		// 	'subtitle_weight',
		// 	[
		// 		'label' => esc_html__( 'SubTitle Font weight', 'modeltheme-addons-for-wpbakery' ),
		// 		'placeholder' => esc_html__( 'E.g.: 500', 'modeltheme-addons-for-wpbakery' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 	]
		// );


		$this->end_controls_section();

        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__( 'Title Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'fileds_typography',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-icon-listgroup-content-holder-inner .mt-icon-listgroup-title',
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
			'title_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color Hover', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
        $this->end_controls_tab();

        $this->end_controls_section();

        $this->start_controls_section(
            'style_subtitle',
            [
                'label' => esc_html__( 'Subtitle ', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'fileds_typography_subtitle',
                'label'    => esc_html__( 'Typography Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-icon-listgroup-text',
            ]
        ); 
		$this->add_control(
			'subtitle_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'SubTitle Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
        $this->end_controls_tab();

        $this->end_controls_section();


	}
	
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $section_aligment 		= $settings['section_aligment'];
        $icon_position 			= $settings['icon_position'];
        $style_block 			= $settings['style_block'];
        $title 			        = $settings['title'];
        // $title_size 			= $settings['title_size'];
        // $title_weight 			= $settings['title_weight'];
        $title_color 			= $settings['title_color'];
        $icon_color 			= $settings['icon_color'];
        $subtitle 				= $settings['subtitle'];
        // $subtitle_size 		    = $settings['subtitle_size'];
        $subtitle_color 		= $settings['subtitle_color'];
        $icon_url 				= $settings['icon_url'];
        $image 					= $settings['image'];
        $icon_fontawesome 		= $settings['icon_fontawesome'];
        $icon_type 				= $settings['icon_type'];
        $icon_size 				= $settings['icon_size'];
        $subtitle_tag 			= $settings['subtitle_tag'];
        $title_tag 				= $settings['title_tag'];
        $bg_color 				= $settings['bg_color'];
        $style_bg 				= $settings['style_bg'];
        $style_margin_top 		= $settings['style_margin_top'];
        $margin_right 			= $settings['margin_right'];
        // $subtitle_weight 		= $settings['subtitle_weight'];
        $image_max_width 		= $settings['image_max_width'];
        $use_svg 				= $settings['use_svg'];
        $background_box_color 	= $settings['background_box_color'];
        $box_border_radius 		= $settings['box_border_radius'];
        $title_color_hover 		= $settings['title_color_hover'];
        $image_margin 		= $settings['image_margin'];


        $btn_atts = '';
		$btn_atts .= $icon_url['url'].',';
		$btn_atts .= $icon_url['is_external'].',';
		$btn_atts .= $icon_url['nofollow'].',';
		$btn_atts .= $title.',';
    	$shortcode_content = '';

		$image_id = '';
        if(!empty($image)){ 
			if ($image['source'] == 'library') {
				$image_id .= $image['id'].',';
	        }
	    }


    	$image_svg = '';
    	$elementor_icon_fontawesome = '';
        if(!empty($icon_fontawesome)){ 
	        if ($icon_fontawesome['library'] == 'svg') {
	        	$image_svg = $icon_fontawesome['value']['id'];
	        }else{
	        	$elementor_icon_fontawesome = $icon_fontawesome['value'];
	        }
	    }
     
		 // echo '<pre>' . var_export($icon_url, true) . '</pre>';
    

        $shortcode_content .= do_shortcode('[mt-addons-icon-list page_builder="elementor" icon_url="'.$btn_atts.'" section_aligment="'.$section_aligment.'" icon_position="'.$icon_position.'"  icon_color="'.$icon_color.'" title_color_hover="'.$title_color_hover.'" style_block="'.$style_block.'" icon_type="'.$icon_type.'" icon_size="'.$icon_size.'" title="'.$title.'" title_color="'.$title_color.'" subtitle="'.$subtitle.'" subtitle_color="'.$subtitle_color.'" elementor_icon_fontawesome="'.$elementor_icon_fontawesome.'"  image="'.$image_id.'" use_svg="'.$image_svg.'" subtitle_tag="'.$subtitle_tag.'" title_tag="'.$title_tag.'" bg_color="'.$bg_color.'" style_bg="'.$style_bg.'" background_box_color="'.$background_box_color.'" style_margin_top="'.$style_margin_top.'" margin_right="'.$margin_right.'"  image_max_width="'.$image_max_width.'" box_border_radius="'.$box_border_radius.'" image_margin="'.$image_margin.'"]' );

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}