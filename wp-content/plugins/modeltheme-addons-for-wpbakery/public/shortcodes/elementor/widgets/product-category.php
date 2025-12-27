<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_products_category extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'product-category', plugins_url( '../../../css/product-category.css' , __FILE__ ));
      	wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));

        return [
            'product-category',
            'swiper-bundle',
        ];
    }
	use ContentControlSlider;

	public function get_name() { 
		return 'products-category';
	}
	
	public function get_title() {
		return 'MT - Product Categories';
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
			'featured_image_size',
				[
					'label' => __( 'Featured Image size', 'modeltheme-addons-for-wpbakery' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'options' => modeltheme_addons_image_sizes_array(),
				]
		);
		$this->add_control(
			'image_status',
			[
				'label' => __( 'Enable/Disable Category Image', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'btn_style',
			[
				'label' => __( 'Shape', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'btn-square' 	=> __( 'Square (Default)', 'modeltheme-addons-for-wpbakery' ),
					'btn-rounded' 		=> __( 'Rounded (5px Radius)', 'modeltheme-addons-for-wpbakery' ),
					'btn-round' 		=> __( 'Round (30px Radius)', 'modeltheme-addons-for-wpbakery' ),
				],
				'condition' => [
					'image_status' => '',
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
		$repeater->add_control(
			'category',
				[
					'label' => __( 'Category', 'modeltheme-addons-for-wpbakery' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'options' => $product_category,
				]
		);
		$repeater->add_control(
			'bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,

			]
		);
		$this->add_control(
	        'collectors_groups',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
	
		$this->end_controls_section();
	}
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        // $number 					= $settings['number'];
        $featured_image_size 		= $settings['featured_image_size'];
        $collectors_groups 			= $settings['collectors_groups'];
        // $category 					= $settings['category'];
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
        $image_status 				= $settings['image_status'];
        $btn_style 					= $settings['btn_style'];


  		$shortcode_content = '';
		// echo '<pre>' . var_export($image_status, true) . '</pre>';
		$serialized_collectors_groups = base64_encode(serialize($collectors_groups));

        $shortcode_content .= do_shortcode('[mt-addons-product-category page_builder="elementor" collectors_groups="'.$serialized_collectors_groups.'" featured_image_size="'.$featured_image_size.'" autoplay="'.$autoplay.'" delay="'.$delay.'" items_desktop="'.$items_desktop.'" items_mobile="'.$items_mobile.'" items_tablet="'.$items_tablet.'" space_items="'.$space_items.'" touch_move="'.$touch_move.'" effect="'.$effect.'" grab_cursor="'.$grab_cursor.'" infinite_loop="'.$infinite_loop.'" columns="'.$columns.'" layout="'.$layout.'" centered_slides="'.$centered_slides.'" navigation_position="'.$navigation_position.'" nav_style="'.$nav_style.'" navigation_color="'.$navigation_color.'" navigation_bg_color="'.$navigation_bg_color.'" navigation_color_hover="'.$navigation_color_hover.'" navigation_bg_color_hover="'.$navigation_bg_color_hover.'" pagination_color="'.$pagination_color.'" navigation="'.$navigation.'" pagination="'.$pagination.'" image_status="'.$image_status.'" btn_style="'.$btn_style.'"]');

        echo  $shortcode_content;


}
	protected function content_template() {

    }
}