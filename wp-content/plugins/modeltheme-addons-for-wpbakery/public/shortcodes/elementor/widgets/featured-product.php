<?php
namespace Elementor;

class addons_featured_product extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'featured-product', plugins_url( '../../../css/featured-product.css' , __FILE__ ));
        return [
            'featured-product',
        ];
    }
	public function get_name() {
		return 'mt-featured-product';
	}
	 
	public function get_title() {
		return 'MT - Featured Product';
	}
	
	public function get_icon() {
		return 'eicon-products';
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
	    	'select_product',
	        [
	            'label' => esc_html__('Write Product ID', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
		$this->add_control(
	    	'subtitle_product',
	        [
	            'label' => esc_html__('Write Subtitle Product', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $this->add_control( 
			'button_text',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __( 'Button text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
        $this->end_controls_tab();
		$this->end_controls_section();
		$this->start_controls_section(
            'style_product',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(  
			'background_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Featured product background color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'category_text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Product category color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'product_name_text_color',  
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Product name color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'price_text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Product price color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_background_color1',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Button gradient color - 1', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		); 
		$this->add_control(
			'button_background_color2',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Button gradient color - 2', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Button text color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
	$this->end_controls_section();

	}
      
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $select_product 			= $settings['select_product'];
        $subtitle_product 			= $settings['subtitle_product'];
        $background_color 			= $settings['background_color'];
        $category_text_color 		= $settings['category_text_color'];
        $product_name_text_color 	= $settings['product_name_text_color'];
        $price_text_color 			= $settings['price_text_color'];
        $button_text 				= $settings['button_text'];
        $button_background_color1 	= $settings['button_background_color1'];
        $button_background_color2 	= $settings['button_background_color2'];
        $button_text_color 			= $settings['button_text_color'];
      
        $shortcode_content = ''; 
  
		// $serialized_process_groups = base64_encode(serialize($process_groups));
        $shortcode_content .= do_shortcode('[mt-addons-featured-product page_builder="elementor" select_product="'.$select_product.'" subtitle_product="'.$subtitle_product.'" subtitle_product="'.$subtitle_product.'" background_color="'.$background_color.'" category_text_color="'.$category_text_color.'" product_name_text_color="'.$product_name_text_color.'" price_text_color="'.$price_text_color.'" button_text="'.$button_text.'" button_background_color1="'.$button_background_color1.'" button_background_color2="'.$button_background_color2.'" button_text_color="'.$button_text_color.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}