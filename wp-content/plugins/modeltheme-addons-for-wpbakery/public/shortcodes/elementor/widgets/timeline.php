<?php
namespace Elementor;

class addons_timeline extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'timeline', plugins_url( '../../../css/timeline.css' , __FILE__ ));
        return [
            'timeline',
        ];
    }

	public function get_name() {
		return 'mt-timeline';
	}
	
	public function get_title() {
		return 'MT - Timeline';
	}
	
	public function get_icon() {
		return 'eicon-time-line';
	} 
	public function get_script_depends() {
    	wp_enqueue_script( 'timeline', plugins_url( '../../../js/timeline.js' , __FILE__));
        return [ 'jquery', 'elementor-frontend', 'timeline' ];
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
			'line_status',
			[
				'label' => esc_html__( 'Disable Vertical Line', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => esc_html__( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'item_date_image',
			[
				'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
                'description' => esc_attr__('Choose image for timeline pin.', 'modeltheme-addons-for-wpbakery'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		$repeater->add_control(
			'item_date',
			[
				'label' => esc_html__( 'Item Date', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
          		'description'  => esc_attr__('Enter the date for current timeline item. Format example: 2017 November 15th', 'modeltheme-addons-for-wpbakery'),
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
            'style_timeline',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'block_bg',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Block Background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'title_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		); 
		$this->add_control(
			'title_size',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Size', 'modeltheme-addons-for-wpbakery' ),
			]
		); 
		$this->add_control(
			'title_line',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Line height', 'modeltheme-addons-for-wpbakery' ),
				'placeholder' => '0',
				'min' => 0.1,
				'max' => 3,
				'step' => 0.1,
				'default' => 0.1,
			]
		);
		$this->add_control(
			'title_weight',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Font weight', 'modeltheme-addons-for-wpbakery' ),
				'placeholder' => '0',
				'min' => 0.1,
				'max' => 3,
				'step' => 0.1,
				'default' => 0.1,
			]
		);
		$this->add_control(
			'desc_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Description Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);        
		$this->end_controls_section();
	}
	           
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $line_status 				= $settings['line_status'];
        $accordion_groups 			= $settings['accordion_groups'];
        $block_bg 		    		= $settings['block_bg'];
        $title_color 				= $settings['title_color'];
        $title_size 				= $settings['title_size'];
        $title_line 				= $settings['title_line'];
        $title_weight 				= $settings['title_weight'];
        $desc_color 				= $settings['desc_color'];
   

		$shortcode_content = '';
		
		$serialized_accordion_groups = base64_encode(serialize($accordion_groups));

		// echo '<pre>' . var_export($infinite_loop, true) . '</pre>';

        $shortcode_content .= do_shortcode('[mt-addons-timeline page_builder="elementor" line_status="'.$line_status.'" accordion_groups="'.$serialized_accordion_groups.'" block_bg="'.$block_bg.'" title_color="'.$title_color.'" title_size="'.$title_size.'" title_line="'.$title_line.'" title_weight="'.$title_weight.'" desc_color="'.$desc_color.'" ]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}