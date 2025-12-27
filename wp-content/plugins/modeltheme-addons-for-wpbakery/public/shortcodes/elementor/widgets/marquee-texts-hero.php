<?php
namespace Elementor;

class addons_marquee_texts_hero extends Widget_Base {
	
	public function get_style_depends() {
        wp_enqueue_style( 'mt-marquee-texts-hero', plugins_url( '../../../css/marquee-texts-hero.css' , __FILE__ ));
        return [
            'highlighted-text',
        ];
    }
	public function get_name() {
		return 'mt-marquee-texts-hero';
	}
	
	public function get_title() {
		return 'MT - Marquee Texts Hero';
	}
	
	public function get_icon() {
		return ' eicon-animation-text';
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
			'mix_blend_mode',
			[
				'label' => __( 'Mix Blend Mode (Item Text Hover)', 'modeltheme-addons-for-wpbakery' ),
                'description'        => esc_html__( 'This is a special CSS effect compatible with any major browser.', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'normal' 			=> __( 'normal', 'modeltheme-addons-for-wpbakery' ),
					'multiply'			=> __( 'multiply', 'modeltheme-addons-for-wpbakery' ),
					'overlay' 			=> __( 'overlay', 'modeltheme-addons-for-wpbakery' ),
					'screen' 			=> __( 'screen', 'modeltheme-addons-for-wpbakery' ),
					'darken' 			=> __( 'darken', 'modeltheme-addons-for-wpbakery' ),
					'lighten' 			=> __( 'lighten', 'modeltheme-addons-for-wpbakery' ),
					'color-dodge' 		=> __( 'color-dodge', 'modeltheme-addons-for-wpbakery' ),
					'color-burn' 		=> __( 'color-burn', 'modeltheme-addons-for-wpbakery' ),
					'hard-light' 		=> __( 'hard-light', 'modeltheme-addons-for-wpbakery' ),
					'soft-light' 		=> __( 'soft-light', 'modeltheme-addons-for-wpbakery' ),
					'difference' 		=> __( 'difference', 'modeltheme-addons-for-wpbakery' ),
					'exclusion' 		=> __( 'exclusion', 'modeltheme-addons-for-wpbakery' ),
					'hue' 				=> __( 'hue', 'modeltheme-addons-for-wpbakery' ),
					'saturation' 		=> __( 'saturation', 'modeltheme-addons-for-wpbakery' ),
					'color' 			=> __( 'color', 'modeltheme-addons-for-wpbakery' ),
					'luminosity' 		=> __( 'luminosity', 'modeltheme-addons-for-wpbakery' ),

				]
			]
		);
    	$repeater = new Repeater();
		$repeater->add_control(
	    	'title',
	        [
	            'label' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	        ]
	    );
	    $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
	    $this->add_control( 
	        'items',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
		$this->end_controls_section();
        $this->start_controls_section( 
            'style_marquee',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'text_border_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Item Text Store Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
	$this->end_controls_section();

	}
         
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $mix_blend_mode 			= $settings['mix_blend_mode'];
        $items 						= $settings['items'];
        $text_border_color 			= $settings['text_border_color'];

        $shortcode_content = ''; 
		$serialized_items = base64_encode(serialize($items));

        $shortcode_content .= do_shortcode('[mt-addons-marquee-texts-hero page_builder="elementor" items="'.$serialized_items.'" mix_blend_mode="'.$mix_blend_mode.'" text_border_color="'.$text_border_color.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}