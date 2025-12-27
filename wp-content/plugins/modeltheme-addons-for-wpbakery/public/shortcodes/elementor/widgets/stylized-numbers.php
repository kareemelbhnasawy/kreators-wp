<?php
namespace Elementor;

class addons_stylized_numbers extends Widget_Base { 
	public function get_style_depends() {
    	wp_enqueue_style( 'mt-stylized-numbers', plugins_url( '../../../css/stylized-numbers.css' , __FILE__ ));
        return [
            'mt-stylized-numbers',
        ];
    }
	public function get_name() {
		return 'mt-stylized-numbers';
	}
	
	public function get_title() {
		return 'MT - Stylized Numbers';
	}
	
	public function get_icon() {
		return 'eicon-number-field';
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
		$this->add_control(
			'custom_number',
			[
				'label' => esc_html__( 'Number', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		); 
		$this->end_controls_section();
        $this->start_controls_section(
            'style_number',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
        $this->add_control(
			'number_size',
			[
				'label' => esc_html__( 'Number Size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		); 
		$this->add_control(
			'text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
      			'description' => esc_html__( 'Select Text Color.', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				
			]
		);
		$this->add_control(
			'background',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Color', 'modeltheme-addons-for-wpbakery' ),
      			'description' => esc_html__( 'Select Background Color.', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				
			]
		);
		$this->add_control(
			'gradient_bg',
			[
				'label' => __( 'Gradient', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'gradient_color_1',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Gradient 1"', 'modeltheme-addons-for-wpbakery' ),
      			'description' => esc_html__( 'Select Gradient 1.', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'gradient_bg' => 'yes',
				],
			]
		); 
		$this->add_control(
			'gradient_color_2',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Gradient 2"', 'modeltheme-addons-for-wpbakery' ),
      			'description' => esc_html__( 'Select Background Gradient 2.', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'gradient_bg' => 'yes',
				],
			]
		);
		$this->add_control(
			'gradient_color_3',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Gradient 3', 'modeltheme-addons-for-wpbakery' ),
      			'description' => esc_html__( 'Select Background Gradient 3.', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'gradient_bg' => 'yes',
				],
			]
		);
		
	$this->end_controls_section();

	}
	            
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $custom_number 			= $settings['custom_number'];
        $section_align 			= $settings['section_align'];
        $number_size 			= $settings['number_size'];
        $text_color 			= $settings['text_color'];
        $background 			= $settings['background'];
        $gradient_bg 			= $settings['gradient_bg'];
        $gradient_color_1 		= $settings['gradient_color_1'];
        $gradient_color_2 		= $settings['gradient_color_2'];
        $gradient_color_3 		= $settings['gradient_color_3'];

      

        $shortcode_content = '';
		// $serialized_member_groups = base64_encode(serialize($clients_groups));
        $shortcode_content .= do_shortcode('[mt-addons-stylized-numbers page_builder="elementor" custom_number="'.$custom_number.'" section_align="'.$section_align.'" number_size="'.$number_size.'"  text_color="'.$text_color.'" background="'.$background.'"   gradient_bg="'.$gradient_bg.'"  gradient_color_1="'.$gradient_color_1.'" gradient_color_2="'.$gradient_color_2.'" gradient_color_3="'.$gradient_color_3.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}