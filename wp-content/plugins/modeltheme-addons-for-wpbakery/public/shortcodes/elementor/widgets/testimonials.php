<?php
namespace Elementor;
 
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_testimonials extends Widget_Base {
	public function get_style_depends() {
    	wp_enqueue_style( 'testimonials-css', plugins_url( '../../../css/testimonials.css' , __FILE__ ));
      	wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));
        return [
            'testimonials-css',
            'swiper-bundle',
        ];
    }
	use ContentControlSlider;

	public function get_name() {
		return 'mt-addons-testimonials';
	}
	
	public function get_title() {
		return 'MT - Testimonials';
	}
	
	public function get_icon() {
		return 'eicon-testimonial';
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

        $this->section_title();
        $this->section_slider_hero_settings();

    }
    private function section_title() {

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Content', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
		$this->add_control(
			'section_align',
			[
				'label' => __( 'Text Description Aligment', 'modeltheme-addons-for-wpbakery' ),
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
		$this->add_control(
			'section_align_image',
			[
				'label' => __( 'Image/Position Aligment', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'text-and-img-left' 		=> __( 'Left', 'modeltheme-addons-for-wpbakery' ),
					'text-and-img-center'		=> __( 'Center', 'modeltheme-addons-for-wpbakery' ),
					'text-and-img-right' 		=> __( 'Right', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'holder_image_position',
			[
				'label' => __( 'Holder image Position', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 							=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'mt-addons-holder_down' 		=> __( 'Down', 'modeltheme-addons-for-wpbakery' ),
					'mt-addons-holder_top'			=> __( 'Top', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
    	$repeater = new Repeater();
		$repeater->add_control(
		'list_image',
			[
				'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
	    'testimonial_description',
	        [
	            'label' => esc_html__('Description', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXTAREA
	        ]
	    );
	    $repeater->add_control(
	    	'testimonial_short_description',
	        [
	            'label' => esc_html__('Short Description', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'testimonial_name',
	        [
	            'label' => esc_html__('Name', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'testimonial_date',
	        [
	            'label' => esc_html__('Date', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
		$repeater->add_control(
	    	'testimonial_position',
	        [
	            'label' => esc_html__('Position', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $this->add_control(
	        'testimonials_groups',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
	// end repeater;
		$this->end_controls_section();
		$this->start_controls_section(
			'title_tab',
			[
				'label' => __( 'Quote', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(  
			'quote_testimonial',
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
			'aligment',
			[
				'label' => __( 'Quote Aligment', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'text-left' 		=> __( 'Left', 'modeltheme-addons-for-wpbakery' ),
					'text-center'		=> __( 'Center', 'modeltheme-addons-for-wpbakery' ),
					'text-right' 		=> __( 'Right', 'modeltheme-addons-for-wpbakery' ),
				],
				'condition' => [
					'quote_testimonial' => 'yes',
				],
			]
		);
		$this->add_control(
			'image_shape',
			[
				'label' => __( 'Image Shape', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'img-rounded' 		=> __( 'Rounded', 'modeltheme-addons-for-wpbakery' ),
					'img-circle'		=> __( 'Circle', 'modeltheme-addons-for-wpbakery' ),
					'img-square' 		=> __( 'Square', 'modeltheme-addons-for-wpbakery' ),
				],
			]
		);
		$this->add_control(
			'quote_position',
			[
				'label' => __( 'Quotes Position', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 							=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'top-content' 				=> __( 'Top Content', 'modeltheme-addons-for-wpbakery' ),
					'background-content'		=> __( 'Background Content', 'modeltheme-addons-for-wpbakery' ),
				],
				'condition' => [
					'quote_testimonial' => 'yes',
				],
			]
		); 
		$this->add_control(
			'quote_size',
			[
				'label' => esc_html__( 'Quote Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
				'condition' => [
					'layout' => 'grid',
				],
				'condition' => [
					'quote_testimonial' => 'yes',
				],
			]
		);
		$this->add_control(
			'quote_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Quote Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'quote_testimonial' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'title_tab_styling',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_fileds_typography',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} h3.mt-addons-testimonial-name',
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
		$this->end_controls_tab();
        $this->end_controls_section();
        $this->start_controls_section(
            'style_date',
            [
                'label' => esc_html__( 'Date', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'date_fileds_typography',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} p.mt-addons-testimonial-date',
            ]
        );
		$this->add_control(
			'testimonial_date_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		); 
		$this->end_controls_tab();
        $this->end_controls_section();
        $this->start_controls_section(
            'style_position',
            [
                'label' => esc_html__( 'Position', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'position_fileds_typography',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-testimonial-position',
            ]
        );
		$this->add_control(
			'position_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->end_controls_tab();
        $this->end_controls_section();
        $this->start_controls_section(
            'style_description',
            [
                'label' => esc_html__( 'Description', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_fileds_typography',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-testimonial-description',
            ]
        );
		$this->add_control(
			'description_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
            'description_padding',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-testimonial-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_section();
        $this->start_controls_section(
            'style_short_description',
            [
                'label' => esc_html__( 'Short Description', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'fileds_typography',
                'label'    => esc_html__( 'Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} p.mt-addons-testimonial-short-description',
            ]
        ); 
		$this->add_control(
			'short_description_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);

        $this->end_controls_tab();
		$this->end_controls_section();
		$this->start_controls_section(
            'style_block',
            [
                'label' => esc_html__( 'Block', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'testimonial_block_bg',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
            'block_padding',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'block_border-radius',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-testimonial-item',
            ]
        ); 
		$this->end_controls_tab();
        $this->end_controls_section();

        $this->start_controls_section(
            'style_image',
            [
                'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'image_padding',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-testimonial-image-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_border-radius',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-testimonial-image-holder img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();
        $this->end_controls_section();
	}
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $section_align 				= $settings['section_align'];
        $testimonials_groups 		= $settings['testimonials_groups'];
        $quote_testimonial 			= $settings['quote_testimonial'];
        $quote_position 			= $settings['quote_position'];
        $quote_size 				= $settings['quote_size'];
        $quote_color 				= $settings['quote_color'];
        $title_color 				= $settings['title_color'];
        $position_color 			= $settings['position_color'];
        $description_color 			= $settings['description_color'];
        $description_short_color 	= $settings['short_description_color'];
        $aligment 					= $settings['aligment'];
        $section_align_image 		= $settings['section_align_image'];
        $testimonial_date_color 	= $settings['testimonial_date_color'];
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
        // $carousel 					= $settings['carousel'];
        $columns 					= $settings['columns'];
        $layout 					= $settings['layout'];
        $centered_slides 			= $settings['centered_slides'];
        // $select_navigation 			= $settings['select_navigation'];
        $navigation_position 		= $settings['navigation_position'];
        $nav_style 					= $settings['nav_style'];
        $navigation_color 			= $settings['navigation_color'];
        $navigation_bg_color 		= $settings['navigation_bg_color'];
        $navigation_bg_color_hover 	= $settings['navigation_bg_color_hover'];
        $navigation_color_hover 	= $settings['navigation_color_hover'];
        $pagination_color 			= $settings['pagination_color'];
        $navigation 				= $settings['navigation'];
        $pagination 				= $settings['pagination'];
        $holder_image_position 		= $settings['holder_image_position'];
        $image_shape 				= $settings['image_shape'];
        $short_description_color 	= $settings['short_description_color'];
        $testimonial_block_bg		= $settings['testimonial_block_bg'];

		//end carousel

        $shortcode_content = ''; 
		$serialized_member_groups = base64_encode(serialize($testimonials_groups));
        $shortcode_content .= do_shortcode('[mt-addons-testimonials 
        	page_builder="elementor" 
        	testimonials_groups="'.$serialized_member_groups.'" 
        	section_align_image="'.$section_align_image.'" 
        	holder_image_position="'.$holder_image_position.'"  
        	quote_testimonial="'.$quote_testimonial.'" 
        	quote_testimonial="'.$quote_testimonial.'" 
        	aligment="'.$aligment.'" 
        	image_shape="'.$image_shape.'" 
        	quote_position="'.$quote_position.'" 
        	quote_size="'.$quote_size.'" 
        	quote_color="'.$quote_color.'" 
        	title_color="'.$title_color.'" 
        	position_color="'.$position_color.'" 
        	description_color="'.$description_color.'" 
        	description_short_color="'.$description_short_color.'" 
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
            short_description_color="'.$short_description_color.'"
            testimonial_block_bg="'.$testimonial_block_bg.'"
        ]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}