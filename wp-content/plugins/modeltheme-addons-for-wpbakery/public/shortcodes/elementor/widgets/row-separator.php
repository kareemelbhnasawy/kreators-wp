<?php
namespace Elementor;

class addons_row_separator extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'mt-row-separator', plugins_url( '../../../css/row-separator.css' , __FILE__ ));
        return [
            'mt-row-separator',
        ];
    }

	public function get_name() {
		return 'mt-row-separator'; 
	}
	
	public function get_title() {
		return 'MT - Row Separator';
	}
	
	public function get_icon() {
		return 'eicon-image-rollover';
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
			'clouds_position', 
			[
				'label' => __( 'Clouds Position', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 		=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'top-left' 			=> __( 'Style 1', 'modeltheme-addons-for-wpbakery' ),
					'top-right' 		=> __( 'Style 2', 'modeltheme-addons-for-wpbakery' ),
					'bottom-left' 		=> __( 'Style 3', 'modeltheme-addons-for-wpbakery' ),
					'bottom-right' 		=> __( 'Style 4', 'modeltheme-addons-for-wpbakery' ),
					'custom_separator' 	=> __( 'Custom', 'modeltheme-addons-for-wpbakery' ),

				]
			] 
		);
		$this->add_control(
			'custom_separator', 
			[
				'label' => __( 'Custom Separator', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 		=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'img' 			=> __( 'IMG', 'modeltheme-addons-for-wpbakery' ),
					'svg' 		=> __( 'SVG', 'modeltheme-addons-for-wpbakery' ),

				],
				'condition' => [
					'clouds_position' => 'custom_separator',
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'custom_separator' => 'img',
				],
			]
		); 
		$this->add_control(
			'content_svg',
			[
				'label' => esc_html__( 'HTML SVG', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'html',
				'rows' => 20,
				'condition' => [
					'custom_separator' => 'svg',
				],
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            'styling_price',
            [
                'label' => esc_html__( 'Styling', 'invent-slider' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );  
        $this->add_control(
			'bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Row Separator Background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
                'description' => esc_attr__( 'Set the background color of the Row Separator', 'modeltheme-addons-for-wpbakery' )
			]
		);
		$this->end_controls_section();

	}
	                     
	protected function render() {
        $settings 					= $this->get_settings_for_display();

        $clouds_position 	= $settings['clouds_position'];
        $custom_separator 	= $settings['custom_separator'];
        $image 				= $settings['image'];
        $content_svg 		= $settings['content_svg'];
        $bg_color 			= $settings['bg_color'];
       
		if ($image['source'] == 'library') {
			$image_id .= $image['id'].',';
        }

     

		$shortcode_content = '';
	


		// echo '<pre>' . var_export($content, true) . '</pre>';

        $shortcode_content .= do_shortcode('[mt-addons-row-separator page_builder="elementor" clouds_position="'.$clouds_position.'" custom_separator="'.$custom_separator.'" image="'.$image_id.'" content_svg="'.$content_svg.'" bg_color="'.$bg_color.'" ]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}