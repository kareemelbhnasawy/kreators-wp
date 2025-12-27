<?php
namespace Elementor;

class addons_typed_text extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'typed-text', plugins_url( '../../../css/typed-text.css' , __FILE__ ));
        return [
            'typed-text',
        ];
    }

	public function get_name() {
		return 'mt-typed-text';
	}
	
	public function get_title() {
		return 'MT - Typed Text';
	}
	
	public function get_icon() {
		return 'eicon-typography';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	public function get_script_depends() {
    	wp_enqueue_script( 'typed', plugins_url( '../../../js/plugins/typed/typed.js' , __FILE__));
        return [ 'jquery', 'elementor-frontend', 'typed' ];
    }
	

	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
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
			'texts', 
			[
				'label' => __( 'Texts', 'modeltheme-addons-for-wpbakery' ),
				'description' => __( "Eg: 'String Text 1', 'String Text 2', 'String Text 3'", 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
        $this->add_control(
			'beforetext',
			[
				'label' => __( 'Before text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
        $this->add_control(
			'aftertext',
			[
				'label' => __( 'After text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            'style_typed_test',
            [
                'label' => esc_html__( 'Styling', 'invent-slider' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
	      'font_size',
	      [
	        'label' => esc_html__( 'Font Size', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	      ]
	    ); 
	    $this->add_control(
	      'cursor_font_size',
	      [
	        'label' => esc_html__( 'Cursor Font Size', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	      ]
	    );
	    $this->add_control(
	      'weight',
	      [
	        'label' => esc_html__( 'Font Weight', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
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
        $settings 				= $this->get_settings_for_display();
        $section_align 			= $settings['section_align'];
        $texts 					= $settings['texts'];
        $beforetext 			= $settings['beforetext'];
        $aftertext 				= $settings['aftertext'];
        $font_size 				= $settings['font_size'];
        $cursor_font_size 		= $settings['cursor_font_size'];
        $weight 				= $settings['weight'];
        $color 					= $settings['color'];
 
		$shortcode_content = '';

        $shortcode_content .= do_shortcode('[mt-addons-typed-text page_builder="elementor" section_align="'.$section_align.'" texts="'.$texts.'" beforetext="'.$beforetext.'" aftertext="'.$aftertext.'" font_size="'.$font_size.'" cursor_font_size="'.$cursor_font_size.'" weight="'.$weight.'"  color="'.$color.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}