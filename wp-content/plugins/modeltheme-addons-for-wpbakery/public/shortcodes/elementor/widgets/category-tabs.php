<?php
namespace Elementor;

class addons_category_tabs extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'category-tabs', plugins_url( '../../../css/category-tabs.css' , __FILE__ ));
        return [
            'category-tabs',
        ];
    }
    public function get_script_depends() {
        wp_register_script( 'category-tabs', plugins_url( '../../../js/category-tabs.js' , __FILE__));
        return [ 
        	'jquery', 'elementor-frontend', 'category-tabs' ];
    }
	public function get_name() {
		return 'mt-category-tabs';
	}
	
	public function get_title() {
		return 'MT - Category Tabs';
	}
	
	public function get_icon() {
		return 'eicon-tabs';
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
  		$product_category = array();
	    if ( class_exists( 'WooCommerce' ) ) {
	      $product_category_tax = get_terms( 'product_cat', array(
	        'parent'      => 0,
	      ));
	      if ($product_category_tax) {
	        foreach ( $product_category_tax as $term ) {
	          if ($term) {
	             $product_category[$term->slug] = $term->name.' ('.$term->count.')';
	          }
	        }
	      }
	    }
 		$repeater = new Repeater();
 		$repeater->add_control(
			'category',
			[
				'label' => __( 'Category', 'modeltheme-addons-for-wpbakery' ),
          		'description' => esc_attr__('Select Category', 'modeltheme-addons-for-wpbakery'),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => $product_category,
			]
		);
 		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
	 	$repeater->add_control(
	    	'title',
	        [
	            'label' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $this->add_control(
	        'category_tabs',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
	    $this->add_control(
			'background_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Tab Backgroung (active)', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();
	}
	              
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $category_tabs 				= $settings['category_tabs'];
        $background_color 			= $settings['background_color'];
        
		$shortcode_content = '';

		$serialized_category_tabs = base64_encode(serialize($category_tabs));

		// echo '<pre>' . var_export($attribute, true) . '</pre>';

        $shortcode_content .= do_shortcode('[mt-addons-category_tabs page_builder="elementor" category_tabs="'.$serialized_category_tabs.'" background_color="'.$background_color.'"]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}