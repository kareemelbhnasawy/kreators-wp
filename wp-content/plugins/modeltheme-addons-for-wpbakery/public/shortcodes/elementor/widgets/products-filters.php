<?php
namespace Elementor;

class addons_products_filters extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'product-filters', plugins_url( '../../../css/product-filters.css' , __FILE__ ));
        return [
            'product-filters',
        ];
    }
	public function get_name() {
		return 'mt-products-filters'; 
	}
	
	public function get_title() {
		return 'MT - Product Filters';
	}
	
	public function get_icon() {
		return 'eicon-filter';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	public function get_script_depends() {
    	
    	wp_enqueue_script( 'filters-main-js', plugins_url( '../../../js/filters-main.js' , __FILE__));
    	wp_enqueue_script( 'filters-mixitup-js', plugins_url( '../../../js/filters-mixitup.min.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'filters-main-js', 'filters-mixitup-js' ];
    }
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$all_attributes = array();
	    if (function_exists('wc_get_attribute_taxonomies')) {
	        $attribute_taxonomies = wc_get_attribute_taxonomies();
	        if ( $attribute_taxonomies ) {
	          foreach ( $attribute_taxonomies as $tax ) {
	            $all_attributes[$tax->attribute_name ] = $tax->attribute_name;
	          }
	        }
	    }
	    $search_filter = array('Null' => 'Choose ','search_on' => 'Search Enabled ', 'search_off' => 'Search Disabled ');
	    $categories_filter = array('Null' => 'Choose','categories_on' => 'Categories Enabled', 'categories_off' => 'Categories Disabled');
	    $tags_filter = array('Null' => 'Choose','tags_on' => 'Tags Enabled','tags_off' => 'Tags Disabled');
	    $attributes = array('Null' => 'Choose','tags_on' => 'Tags Enabled','tags_off' => 'Tags Disabled');
	    $product_categories = get_terms( 'product_cat', array('orderby' => 'count','order' => 'DESC', 'hide_empty' => true) );
    	$product_tags = get_terms( 'product_tag', array('orderby' => 'count','order' => 'DESC', 'hide_empty' => true) );
   

	    $this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number of products', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'attribute',
			[
				'label' => esc_html__( 'Select Products Attributes?', 'modeltheme-addons-for-wpbakery' ),
          		'description' => esc_attr__('The selected attributes will be used to filter the products from the left side', 'modeltheme-addons-for-wpbakery'),
				// 'type' => \Elementor\Controls_Manager::SELECT,
				'type' => Controls_Manager::SELECT,
				// 'multiple' => true,
       			'options' => $all_attributes,
			]
		);
		$this->add_control(
			'search_placeholder',
			[
				'label' => __( 'Search placeholder', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',

			]
		);
		$this->add_control(
			'searchfilter',
			[
				'label' => __( 'Enable or disable search on filter sidebar', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
       			'options' => $search_filter,

			]
		);
		$this->add_control(
				'categoriesfilter',
				[
					'label' => __( 'Enable or disable categories on filter sidebar', 'modeltheme-addons-for-wpbakery' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => $categories_filter,
				
				]
		);
		$this->add_control(
			'tagsfilter',
			[
				'label' => __( 'Enable or disable tags on filter sidebar', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => $tags_filter,
			
			]
		);
		$this->end_controls_section();
	}
	              
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $number 					= $settings['number'];
        $attribute 					= $settings['attribute'];
        $search_placeholder 		= $settings['search_placeholder'];
        $searchfilter 				= $settings['searchfilter'];
        $categoriesfilter 			= $settings['categoriesfilter'];
        $tagsfilter 				= $settings['tagsfilter'];
        
		$shortcode_content = '';


		// echo '<pre>' . var_export($attribute, true) . '</pre>';

        $shortcode_content .= do_shortcode('[mt-addons-product-filters page_builder="elementor" number="'.$number.'" attribute="'.$attribute.'" search_placeholder="'.$search_placeholder.'" searchfilter="'.$searchfilter.'" categoriesfilter="'.$categoriesfilter.'" tagsfilter="'.$tagsfilter.'"]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}