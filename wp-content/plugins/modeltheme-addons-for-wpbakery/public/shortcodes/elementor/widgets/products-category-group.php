<?php
namespace Elementor; 

use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_products_category_group extends Widget_Base {
	public function get_style_depends() {
   	 	wp_enqueue_style( 'collectors-group', plugins_url( '../../../css/collectors-group.css' , __FILE__ ));
      	wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));
        return [
            'collectors-group',
            'swiper-bundle',
        ];
    }
	use ContentControlSlider;
	
	public function get_name() {
		return 'products-category-group';
	}
	
	public function get_title() {
		return 'MT - Product Category Group';
	}
	
	public function get_icon() {
		return 'eicon-product-categories';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	public function get_script_depends() {
        
        wp_register_script( 'swiper', plugins_url( '../../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
        wp_register_script( 'hero-slider', plugins_url( '../../../js/swiper.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'swiper', 'hero-slider' ];
    }
    
	protected function register_controls() {

        $this->section_title();
        $this->section_slider_hero_settings();

    }
    private function section_title() {

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Content', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
		$this->add_control(
			'number',
			[
				'label' => __( 'Number of items', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 	 => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					'one-item' => __( '1 Item', 'modeltheme-addons-for-wpbakery' ),
					'2' 	   => __( '2 Items', 'modeltheme-addons-for-wpbakery' ),
					'4' 	   => __( '4 Items', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'featured_image_size',
				[
					'label' => __( 'Featured Image size', 'modeltheme' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'options' => modeltheme_addons_image_sizes_array(),
				]
		);
		$this->add_control(
			'collector_style_var',
			[
				'label' => __( 'Style Collector', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'collector_style_1' => __( 'Collector Image Floating', 'modeltheme-addons-for-wpbakery' ),
					'collector_style_2' => __( 'Collector Image In Wrapper', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'author_status',
			[
				'label' => __( 'Author', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'collector_style_var' => 'collector_style_2',
				],
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
	    $repeater = new \Elementor\Repeater();

		$this->add_control(
		    'category',
			[
		        'label' => __( 'Select Category', 'elementor' ),
		        'type' => Controls_Manager::REPEATER,
		        'fields' => [
		            [
		                'name' => 'category',
		                'label' => __( 'Select Products Category', 'elementor' ),
		                'type' => Controls_Manager::SELECT,
		                'label_block' => true,
						'options' => $product_category,
		            ],
		        ],
	        ],
		);
	
		$this->end_controls_section();
	}
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $number 					= $settings['number'];
        $featured_image_size 		= $settings['featured_image_size'];
        $collector_style_var 		= $settings['collector_style_var'];
        $author_status 				= $settings['author_status'];
        $collectors_groups 			= $settings['category'];
		//carousel
        $autoplay 					= $settings['autoplay'];
        $delay 					    = $settings['delay'];
        $items_desktop 				= $settings['items_desktop'];
        $items_mobile 				= $settings['items_mobile'];
        $items_tablet 				= $settings['items_tablet'];
        $space_items 				= $settings['space_items'];
        $touch_move 				= $settings['touch_move'];
        $effect 					= $settings['effect'];
        $grab_cursor 				= $settings['grab_cursor'];
        $infinite_loop 				= $settings['infinite_loop'];
        // $carousel 					= $settings['carousel'];
        $columns 					= $settings['columns'];
        $layout 					= $settings['layout'];
        $centered_slides 			= $settings['centered_slides'];
        // $select_navigation 			= $settings['select_navigation'];
        $navigation_position 		= $settings['navigation_position'];
        $nav_style 					= $settings['nav_style'];
        $navigation_color 			= $settings['navigation_color'];
        $navigation_bg_color 		= $settings['navigation_bg_color'];
        $navigation_bg_color_hover 	= $settings['navigation_bg_color_hover'];
        $navigation_color_hover 	= $settings['navigation_color_hover'];
        $pagination_color 			= $settings['pagination_color'];
        $navigation 				= $settings['navigation'];
        $pagination 				= $settings['pagination'];
		//end carousel
		$shortcode_content = '';

        $collectors_groups_string = '';
	    if ($collectors_groups) {
	      	foreach ($collectors_groups as $key => $collector) {
			    if ($key === array_key_last($collectors_groups)) {
		        	$collectors_groups_string .= $collector['category'];
			    }else{
		        	$collectors_groups_string .= $collector['category'].',';
			    }
      		}
  		}
		// echo '<pre>' . var_export($infinite_loop, true) . '</pre>';

        $shortcode_content .= do_shortcode('[mt-addons-collectors-group page_builder="elementor" collectors_groups="'.$collectors_groups_string.'" number="'.$number.'" featured_image_size="'.$featured_image_size.'" collector_style_var="'.$collector_style_var.'" author_status="'.$author_status.'" autoplay="'.$autoplay.'" delay="'.$delay.'" items_desktop="'.$items_desktop.'" items_mobile="'.$items_mobile.'" items_tablet="'.$items_tablet.'" space_items="'.$space_items.'" touch_move="'.$touch_move.'" effect="'.$effect.'" grab_cursor="'.$grab_cursor.'" infinite_loop="'.$infinite_loop.'" columns="'.$columns.'" layout="'.$layout.'" centered_slides="'.$centered_slides.'" navigation_position="'.$navigation_position.'" nav_style="'.$nav_style.'" navigation_color="'.$navigation_color.'" navigation_bg_color="'.$navigation_bg_color.'" navigation_color_hover="'.$navigation_color_hover.'" navigation_bg_color_hover="'.$navigation_bg_color_hover.'" pagination_color="'.$pagination_color.'" navigation="'.$navigation.'" pagination="'.$pagination.'"]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}