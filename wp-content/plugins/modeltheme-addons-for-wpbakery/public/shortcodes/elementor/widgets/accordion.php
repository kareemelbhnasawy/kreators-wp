<?php
namespace Elementor;

class addons_accordion extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'accordion', plugins_url( '../../../css/accordion.css' , __FILE__ ));
        return [
            'accordion',
        ];
    }
    public function get_script_depends() {
        
        wp_register_script( 'accordion-js', plugins_url( '../../../js/accordion.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'accordion', 'accordion-js' ];
    }  	
	public function get_name() {
		return 'accordion';
	}
	
	public function get_title() {
		return 'MT - Accordion';
	}
	
	public function get_icon() {
		return 'eicon-toggle';
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
			'styles',
			[
				'label' => __( 'Background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 				=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'border' 		=> __( 'Border', 'modeltheme-addons-for-wpbakery' ),
					'background'	=> __( 'Background', 'modeltheme-addons-for-wpbakery' ),
					'boxed' 		=> __( 'Boxed', 'modeltheme-addons-for-wpbakery' ),

				],
			]
		);
	    $repeater = new Repeater();
		$repeater->add_control(
	    'title',
	        [
	            'label' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'description',
	        [
	            'label' => esc_html__('Description', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXTAREA
	        ]
	    );

	    $this->add_control(
	        'accordion_groups',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );

		$this->end_controls_section();
        $this->start_controls_section(
            'style_accordion',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'fileds_typography',
                'label'    => esc_html__( 'Title Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-accordion-holder .mt-addons-accordion-header',
            ]
        );                
		$this->add_control(
			'background_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'styles' => 'background',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		); 

		$this->end_controls_section();
	}
	    
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $styles 				= $settings['styles'];
        $accordion_groups 		= $settings['accordion_groups'];
        $background_color 		= $settings['background_color'];
        $text_color 			= $settings['text_color'];


        $shortcode_content = '';

		$serialized_accordion_groups = base64_encode(serialize($accordion_groups));

        $shortcode_content .= do_shortcode('[mt-addons-accordion page_builder="elementor" styles="'.$styles.'" accordion_groups="'.$serialized_accordion_groups.'" background_color="'.$background_color.'" text_color="'.$text_color.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}