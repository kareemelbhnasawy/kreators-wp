<?php
namespace Elementor;

class addons_products_category_banner extends Widget_Base {
	
	public function get_style_depends() {
   	 	wp_enqueue_style( 'products-category-banner', plugins_url( '../../../css/products-category-banner.css' , __FILE__ ));
        return [
            'products-category-banner',
        ];
    }
	public function get_name() {
		return 'products-category-banne';
	}
	
	public function get_title() {
		return 'MT - Products with Category Banner';
	}
	
	public function get_icon() {
		return 'eicon-banner';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Products', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$product_category = array();
	    if ( class_exists( 'WooCommerce' ) ) {
	      $product_category_tax = get_terms( 'product_cat', array(
	        'parent'      => 0,
	        'hide_empty'      => 1,
	      ));
	      if ($product_category_tax) {
	        foreach ( $product_category_tax as $term ) {
	          if ($term) {
	             $product_category[$term->slug] = $term->name.' ('.$term->count.')';
	          }
	        }
	      }
	    }
		$this->add_control(
			'category',
			[
				'label' => esc_html__( 'Border Style', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
              	'description' => esc_attr__('Select WooCommerce Category', 'modeltheme-addons-for-wpbakery'),
				'options' => $product_category,
				
			]
		); 
		$this->add_control(
			'styles',
			[
				'label' => __( 'Styles', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	   => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					'style_1' 	   => __( 'Style 1', 'modeltheme-addons-for-wpbakery' ),
					'style_2' 	   => __( 'Style 2', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'products_layout',
			[
				'label' => __( 'Layout', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	   => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					'image_left'   => __( 'Image Left', 'modeltheme-addons-for-wpbakery' ),
					'image_top'    => __( 'Image Top', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		); 
		$this->add_control(
			'number_of_products_by_category',
			[
				'label' => esc_html__( 'Number', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				
			]
		);
		$this->add_control(
			'number_of_columns',
			[
				'label' => __( 'Per column', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''     => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					'1'    => __( '1', 'modeltheme-addons-for-wpbakery' ),
					'2'    => __( '2', 'modeltheme-addons-for-wpbakery' ),
					'3'    => __( '3', 'modeltheme-addons-for-wpbakery' ),
					'4'    => __( '4', 'modeltheme-addons-for-wpbakery' ),

				]
			]
		); 
		$this->end_controls_section();
		$this->start_controls_section(
			'section_banner',
			[
				'label' => __( 'Banner', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Background Image (Optional)', 'modeltheme-addons-for-wpbakery' ),
                'description' => esc_attr__('If this option is empty, the colors from colorpickers will be applied.', 'modeltheme-addons-for-wpbakery'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'banner_pos',
			[
				'label' => __( 'Position', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 	 => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					''       		 => __( 'Left', 'modeltheme-addons-for-wpbakery' ),
					'float-right' 	 => __( 'Right', 'modeltheme-addons-for-wpbakery' ),
				],
			]
		);
		$this->add_control(
			'products_label_text',
			[
				'label' => esc_html__( "Replace 'Products' label", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Text', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'button_style',
			[
				'label' => __( 'Style', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''     => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					'rounded'    => __( 'Rounded', 'modeltheme-addons-for-wpbakery' ),
					'boxed'    	 => __( 'Rectangle', 'modeltheme-addons-for-wpbakery' ),

				]
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            'style_banner',
            [
                'label' => esc_html__( 'Styling Banner', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'overlay_color1',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Color 1', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'overlay_color2',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Color 2', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
	
		$this->end_controls_section();
	}
	           
	protected function render() {
        $settings 							= $this->get_settings_for_display();
        $category 							= $settings['category'];
        $styles 							= $settings['styles'];
        $products_layout 		    		= $settings['products_layout'];
        $number_of_products_by_category 	= $settings['number_of_products_by_category'];
        $number_of_columns 					= $settings['number_of_columns'];
        $bg_image 							= $settings['bg_image'];
        $banner_pos 						= $settings['banner_pos'];
        $products_label_text 				= $settings['products_label_text'];
        $button_text 						= $settings['button_text'];
        $button_style 						= $settings['button_style'];
        $overlay_color1 					= $settings['overlay_color1'];
        $overlay_color2 					= $settings['overlay_color2'];

		$shortcode_content = '';
		
		$image_id = '';
		if ($bg_image['source'] == 'library') {
			$image_id .= $bg_image['id'].',';
        }

		// echo '<pre>' . var_export($infinite_loop, true) . '</pre>';

        $shortcode_content .= do_shortcode('[mt-addons-products-category-banner page_builder="elementor" category="'.$category.'" styles="'.$styles.'" products_layout="'.$products_layout.'" number_of_products_by_category="'.$number_of_products_by_category.'" number_of_columns="'.$number_of_columns.'" bg_image="'.$image_id.'" banner_pos="'.$banner_pos.'" products_label_text="'.$products_label_text.'" button_text="'.$button_text.'" button_style="'.$button_style.'" overlay_color1="'.$overlay_color1.'" overlay_color2="'.$overlay_color2.'"]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}