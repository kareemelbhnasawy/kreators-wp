<?php
namespace Elementor;

class addons_circle_text extends Widget_Base {

	public function get_style_depends() {
        wp_enqueue_style( 'mt-circle-text', plugins_url( '../../../css/circle-text.css' , __FILE__ ));
        return [
            'mt-circle-text',
        ];
    }
	
	public function get_name() {
		return 'mt-circle-text';
	}
	
	public function get_title() {
		return 'MT - Circle Text';
	}
	
	public function get_icon() {
		return 'eicon-circle';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	
	

	protected function register_controls() { 

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Text Circle', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
	    	'text_animate',
	        [
	            'label' => esc_html__('Text Animate', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $this->add_control(
			'left_percent', 
			[
				'label' => esc_html__( "Let (%) - Do not write the '%'", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 82,
			]
		);
		$this->add_control(
			'top_percent',
			[
				'label' => esc_html__( "Top (%) - Do not write the '%'", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 40,

			]
		);
		$this->add_control(
			'circle_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color Text Animate', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'text_circle_size', 
			[
				'label' => esc_html__( "Text Animate - Font size", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 25,
			]
		);
		$this->add_control(
			'y_offset', 
			[
				'label' => esc_html__( "Defines the y offset", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 30,
			]
		);
		$this->add_control(
			'text_length', 
			[
				'label' => esc_html__( "Title - Text Length", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 1290,

			]
		);
		$this->add_control(
			'letter_spacing',
			[
				'label' => esc_html__( "Title - Letter Spacing", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 30,
			]
		); 
		$this->add_control(
			'circle_width',
			[
				'label' => esc_html__( "Circle - Width", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 80,
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'middle_tab',
			[
				'label' => __( 'Middle Element', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
		    'static_text',
		        [
		            'label' => esc_html__('Title Text', 'modeltheme-addons-for-wpbakery'),
		            'type' => Controls_Manager::TEXT
		        ]
		    );
		$this->add_control( 
			'text_static_size',
			[
				'label' => esc_html__( "Title  - Font size", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 100,
			]
		);
		$this->add_control(
			'title_x_offset',
			[
				'label' => esc_html__( "Title - y offset", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 160,

			]
		);
		$this->add_control(
			'title_y_offset',
			[
				'label' => esc_html__( "Title - x offset", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 270,
			]
		);
		$this->add_control( 
			'text_static_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'subtitle_tab',
			[
				'label' => __( 'Subtitle Middle', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
		    'static_sub_text',
		        [
		            'label' => esc_html__('Subtitle Text', 'modeltheme-addons-for-wpbakery'),
		            'type' => Controls_Manager::TEXT
		        ]
		    );
		$this->add_control(
			'text_sub_static_size', 
			[
				'label' => esc_html__( "Subtitle - Font size", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 30,

			]
		);
		$this->add_control(
			'subtitle_x_offset',
			[
				'label' => esc_html__( "Subtitle - x offset", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 210,
			]
		);
		$this->add_control(
			'subtitle_y_offset',
			[
				'label' => esc_html__( "Subtitle - y offset", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'default' => 320,

			]
		);
		$this->add_control(
			'text_sub_static_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Subtitle Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
	$this->end_controls_section();

	}
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $text_animate 			= $settings['text_animate'];
        $left_percent 			= $settings['left_percent'];
        $top_percent 			= $settings['top_percent'];
        $circle_color 			= $settings['circle_color'];
        $text_circle_size 		= $settings['text_circle_size'];
        $y_offset 				= $settings['y_offset'];
        $text_length 			= $settings['text_length'];
        $letter_spacing 		= $settings['letter_spacing'];
        $circle_width 			= $settings['circle_width'];

        $static_text 			= $settings['static_text'];
        $text_static_size 		= $settings['text_static_size'];
        $title_x_offset 		= $settings['title_x_offset'];
        $title_y_offset 		= $settings['title_y_offset'];
        $text_static_color 		= $settings['text_static_color'];

        $static_sub_text 		= $settings['static_sub_text'];
        $text_sub_static_size 	= $settings['text_sub_static_size'];
        $subtitle_x_offset 		= $settings['subtitle_x_offset'];
        $subtitle_y_offset 		= $settings['subtitle_y_offset'];
        $text_sub_static_color 	= $settings['text_sub_static_color'];

        $shortcode_content = '';

        $shortcode_content .= do_shortcode('[mt-addons-circle-text text_animate="'.$text_animate.'"  circle_color="'.$circle_color.'"  text_circle_size="'.$text_circle_size.'" y_offset="'.$y_offset.'" static_text="'.$static_text.'" text_static_size="'.$text_static_size.'" text_static_color="'.$text_static_color.'"  static_sub_text="'.$static_sub_text.'" text_sub_static_size="'.$text_sub_static_size.'" text_sub_static_color="'.$text_sub_static_color.'" subtitle_x_offset="'.$subtitle_x_offset.'" title_x_offset="'.$title_x_offset.'" title_y_offset="'.$title_y_offset.'" subtitle_y_offset="'.$subtitle_y_offset.'" letter_spacing="'.$letter_spacing.'" text_length="'.$text_length.'" circle_width="'.$circle_width.'" top_percent="'.$top_percent.'" left_percent="'.$left_percent.'"]');

        echo  $shortcode_content;


	}
	protected function content_template() {

    }
}