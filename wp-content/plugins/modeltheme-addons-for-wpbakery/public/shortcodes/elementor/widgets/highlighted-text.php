<?php
namespace Elementor;

class addons_highlighted_text extends Widget_Base {
	
	public function get_style_depends() {
        wp_enqueue_style( 'highlighted-text', plugins_url( '../../../css/highlighted-text.css' , __FILE__ ));
        return [
            'highlighted-text',
        ];
    }
	public function get_name() {
		return 'mt-addons-highlighted-text';
	}
	
	public function get_title() {
		return 'MT - Highlighted Text';
	}
	
	public function get_icon() {
		return ' eicon-code-highlight';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	public function get_script_depends() {
        wp_register_script( 'highlighted-text', plugins_url( '../../../js/highlighted-text.js' , __FILE__));
        return [ 'jquery', 'elementor-frontend', 'highlighted-text-js' ];
    }
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
			]
		);
    	$repeater = new Repeater();
		$repeater->add_control(
			'text_type',
			[
				'label' => __( 'Text Type', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'simple' 			=> __( 'Simple', 'modeltheme-addons-for-wpbakery' ),
					'highlighted'		=> __( 'Highlighted', 'modeltheme-addons-for-wpbakery'),
				]
			]
		);
		$repeater->add_control(
	    	'text_normal',
	        [
	            'label' => esc_html__('Text', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	            'condition' => [
					'text_type' => 'simple',
				],
	        ]
	    );
	    $repeater->add_control(
	    	'text_highlighted',
	        [
	            'label' => esc_html__('Text', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	            'condition' => [
					'text_type' => 'highlighted',
				],
	        ]
	    );
	    $this->add_control(
	        'texts_groups',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
		$this->end_controls_section();
        $this->start_controls_section( 
            'style_highlighted',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'aligment',
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
			'title_line',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Line height', 'plugin-name' ),
				'min' => 0.1,
				'max' => 3,
				'step' => 0.1,
			]
		);
		$this->add_control(
			'title_weight',
			[
				'label' => esc_html__( 'Font weight', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'highlight_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Highligh Background Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'highlight_text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Highligh Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
	$this->end_controls_section();

	}
       
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $texts_groups 				= $settings['texts_groups'];
        $highlight_color 			= $settings['highlight_color'];
        $color 						= $settings['color'];
        $aligment 					= $settings['aligment'];
        $title_size 				= $settings['title_size'];
        $title_line 				= $settings['title_line'];
        $title_weight 				= $settings['title_weight'];
        $highlight_text_color 		= $settings['highlight_text_color'];


        $shortcode_content = ''; 
		$serialized_texts_groups = base64_encode(serialize($texts_groups));

        $shortcode_content .= do_shortcode('[mt-addons-highlighted-text 
        	page_builder="elementor" 
        	texts_groups="'.$serialized_texts_groups.'" 
        	highlight_color="'.$highlight_color.'"  
        	color="'.$color.'" 
        	aligment="'.$aligment.'" 
        	title_size="'.$title_size.'" 
        	title_line="'.$title_line.'" 
        	title_weight="'.$title_weight.'"
        	highlight_text_color="'.$highlight_text_color.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}