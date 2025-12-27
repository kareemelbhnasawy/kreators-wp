<?php
namespace Elementor;

class addons_pricing_table extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'mt-pricing-table', plugins_url( '../../../css/pricing-table.css' , __FILE__ ));
        return [
            'mt-pricing-table',
        ];
    }
	public function get_name() {
		return 'pricing-table';
	}
	
	public function get_title() {
		return 'MT - Pricing Table'; 
	}
	
	public function get_icon() {
		return 'eaicon-post-block';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	
	

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'style_var', 
			[
				'label' => __( 'Style', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 	=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'style_1' 		=> __( 'Style 1', 'modeltheme-addons-for-wpbakery' ),
					'style_2' 		=> __( 'Style 2', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'inline_row',
			[
				'label' => __( 'Inline', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'style_var' => 'style_2',
				],
			]
		); 
		$this->add_control(
			'no_container_row',
			[
				'label' => __( 'Container', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 		=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'padding' 			=> __( 'Margin', 'modeltheme-addons-for-wpbakery' ),
					'nomargin' 			=> __( 'No Margin', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'package_name',
			[
				'label' => __( 'Package name', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            'styling_title',
            [
                'label' => esc_html__( 'Title', 'invent-slider' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_align',
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
			'title_size',
			[
				'label' => esc_html__( 'Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'package_name_color', 
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'package_background_title',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title Background Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'style_var' => 'style_1',
					'style_var' => 'style_2',
				],
			] 
		); 
		$this->end_controls_section();
		$this->start_controls_section(
            'content_price',
            [
                'label' => esc_html__( 'Price', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control(
			'package_currency',
			[
				'label' => __( 'Package currency', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control( 
			'package_price',
			[
				'label' => esc_html__( 'Package price', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            'styling_price',
            [
                'label' => esc_html__( 'Price', 'invent-slider' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'section_align',
            [
                'label'   => esc_html__( 'Price Alignment', 'modeltheme-addons-for-wpbakery' ),
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
			'price_size',
			[
				'label' => esc_html__( 'Price size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'price_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Price Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'content_description',
            [
                'label' => esc_html__( 'Description', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
		$this->add_control( 
			'package_description',
			[
				'label' => __( 'Package Description', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'content',
			[
				'label' => __( "Package's feature", "modeltheme-addons-for-wpbakery" ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'modeltheme-addons-for-wpbakery' ) . '</p>',
				   'condition' => [
					'style_var' => 'style_1',
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'package_feature',
			[
				'label' => __( "Package's feature List", 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$repeater->add_control(
			'feature_list',
			[
				'label' => __( "Package's feature List Position", 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 		=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'text-left' 			=> __( 'Left', 'modeltheme-addons-for-wpbakery' ),
					'text-center' 			=> __( 'Center', 'modeltheme-addons-for-wpbakery' ),
					'text-right' 			=> __( 'Right', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$repeater->add_control(
			'package_feature_icon',
			[
				'label' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'feature_icon_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
	        'pricing_groups',
	        [
	            'label' => esc_html__('Pricing Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'condition' => [
					'style_var' => 'style_2',
				],
	            'fields' => $repeater->get_controls()
	        ]
	    );
		$this->end_controls_section();
        $this->start_controls_section(
            'styling_description',
            [
                'label' => esc_html__( 'Description', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'description_align',
			[
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .mt-addons-pricing-table-sub-v2' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'description_size',
			[
				'label' => esc_html__( 'Description size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'package_description_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Description Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		); 
		$this->end_controls_section();
		$this->start_controls_section(
            'content_button',
            [
                'label' => esc_html__( 'Button', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control(
			'title',
			[
				'label' => __( 'Pricing Button Title', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);	
		$this->add_control(
			'button_url',
			[
				'label' => esc_html__( 'Pricing Button', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            'styling_button',
            [
                'label' => esc_html__( 'Button', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );	
		$this->add_control(
			'btn_size',
			[
				'label' => __( 'Button size', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 	=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'btn btn-sm' 		=> __( 'Small', 'modeltheme-addons-for-wpbakery' ),
					'btn btn-medium' 		=> __( 'Medium', 'modeltheme-addons-for-wpbakery' ),
					'btn btn-lg' 		=> __( 'Large', 'modeltheme-addons-for-wpbakery' ),
					'extra-large' 		=> __( 'Extra-Large', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'btn_style',
			[
				'label' => __( 'Shape', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 		=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'btn-square' 		=> __( 'Square (Default)', 'modeltheme-addons-for-wpbakery' ),
					'btn-rounded' 	=> __( 'Rounded (5px Radius)', 'modeltheme-addons-for-wpbakery' ),
					'btn-round' 		=> __( 'Round (30px Radius)', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		); 
		$this->add_control(
			'font_size',
			[
				'label' => esc_html__( 'Pricing Button', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		); 
		$this->add_control(
			'button_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Button Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            'styling_package',
            [
                'label' => esc_html__( 'Package', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );	
		$this->add_control(
			'package_background_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Package Background Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control( 
			'package_bg_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Package Background Color - Hover', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'style_var' => 'style_2',
				],
			]
		);
		$this->add_control(
			'border_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Border Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'style_var' => 'style_1',
				],
			]
		);
		$this->end_controls_section();

	}
	                 
	protected function render() {
        $settings 					= $this->get_settings_for_display();

        $style_var 					= $settings['style_var'];
        $package_name 				= $settings['package_name'];
        $title_align 				= $settings['title_align'];
        $title_size 				= $settings['title_size'];
        $section_align 				= $settings['section_align'];
        $package_price 				= $settings['package_price'];
        $price_size 				= $settings['price_size'];
        $package_currency 			= $settings['package_currency'];
        $package_description 		= $settings['package_description'];
        $description_size 			= $settings['description_size'];
        $content 					= $settings['content'];
        
        $button_url 				= $settings['button_url'];
        $font_size 					= $settings['font_size'];
        $btn_size 					= $settings['btn_size'];
        $button_bg_color 			= $settings['button_bg_color'];
        $package_background_title 	= $settings['package_background_title'];
        $package_background_color 	= $settings['package_background_color'];
        $package_bg_color_hover 	= $settings['package_bg_color_hover'];
        $package_name_color 		= $settings['package_name_color'];
        $price_color 				= $settings['price_color'];
        $package_description_color 	= $settings['package_description_color'];
        $border_color 				= $settings['border_color'];
        $inline_row 				= $settings['inline_row'];
        $no_container_row 			= $settings['no_container_row'];
        $pricing_groups 			= $settings['pricing_groups'];
        $title 						= $settings['title'];
        $button_color 				= $settings['button_color'];
        $description_align 			= $settings['description_align'];


		$btn_atts = '';
		$btn_atts .= $button_url['url'].',';
		$btn_atts .= $button_url['is_external'].',';
		$btn_atts .= $button_url['nofollow'].',';
		$btn_atts .= $title.',';

		$shortcode_content = '';
	

		$serialized_pricing_groups = base64_encode(serialize($pricing_groups));

		// echo '<pre>' . var_export($content, true) . '</pre>';

        $shortcode_content .= do_shortcode('[mt-addons-pricing-table 
        	page_builder="elementor" 
        	pricing_groups="'.$serialized_pricing_groups.'" 
        	style_var="'.$style_var.'" 
        	package_name="'.$package_name.'" 
        	title_align="'.$title_align.'" 
        	title_size="'.$title_size.'"  
        	section_align="'.$section_align.'"  
        	package_price="'.$package_price.'" 
        	price_size="'.$price_size.'" 
        	package_currency="'.$package_currency.'" 
        	package_description="'.$package_description.'" 
        	description_size="'.$description_size.'" 
        	content="'.$content.'" 
        	button_url="'.$btn_atts.'" 
        	font_size="'.$font_size.'" 
        	btn_size="'.$btn_size.'" 
        	button_bg_color="'.$button_bg_color.'" 
        	button_color="'.$button_color.'" 
        	package_background_title="'.$package_background_title.'" 
        	package_background_color="'.$package_background_color.'" 
        	package_bg_color_hover="'.$package_bg_color_hover.'" 
        	package_name_color="'.$package_name_color.'" 
        	price_color="'.$price_color.'" 
        	package_description_color="'.$package_description_color.'" 
        	border_color="'.$border_color.'" 
        	inline_row="'.$inline_row.'" 
        	description_align="'.$description_align.'" 
        	no_container_row="'.$no_container_row.'"]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}