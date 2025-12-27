<?php
namespace Elementor;

use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_products_list extends Widget_Base {
 	
 	public function get_style_depends() {
    	wp_enqueue_style( 'products-list', plugins_url( '../../../css/products-list.css' , __FILE__ ));
        wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));

        return [
            'products-list',
            'swiper-bundle',
        ];
    }
	use ContentControlSlider;

	public function get_name() {
		return 'mt-products-list';
	}
	
	public function get_title() {
		return 'MT - Products List';
	}
	
	public function get_icon() {
		return 'eicon-products';
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
				'label' => esc_html__( 'Number of categories to show', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control( 
			'number_of_products_by_category',
			[
				'label' => esc_html__( 'Number of products to show for each category', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'hide_empty',
			[
				'label' => __( 'Show categories without products?', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
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
			'border_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Border Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'text_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Text Color - Hover', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control( 
			'color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'active_tab_bg',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Active Tab', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
	
		$this->end_controls_section();
	}
	        
	protected function render() {
		// global $enefti_redux;
        $settings 					= $this->get_settings_for_display();
        $number 					= $settings['number'];
        $number_of_products_by_category = $settings['number_of_products_by_category'];
        $hide_empty 				= $settings['hide_empty'];
        $border_color 				= $settings['border_color'];
        $text_color 				= $settings['text_color'];
        $text_color_hover 			= $settings['text_color_hover'];
        $color 						= $settings['color'];
        $active_tab_bg 				= $settings['active_tab_bg'];
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


        $shortcode_content .= do_shortcode('[mt-addons-products-list page_builder="elementor" number_of_products_by_category="'.$number_of_products_by_category.'" number="'.$number.'" hide_empty="'.$hide_empty.'" border_color="'.$border_color.'" text_color="'.$text_color.'" text_color_hover="'.$text_color_hover.'" color="'.$color.'" active_tab_bg="'.$active_tab_bg.'"autoplay="'.$autoplay.'" delay="'.$delay.'" items_desktop="'.$items_desktop.'" items_mobile="'.$items_mobile.'" items_tablet="'.$items_tablet.'" space_items="'.$space_items.'" touch_move="'.$touch_move.'" effect="'.$effect.'" grab_cursor="'.$grab_cursor.'" infinite_loop="'.$infinite_loop.'" columns="'.$columns.'" layout="'.$layout.'" centered_slides="'.$centered_slides.'" navigation_position="'.$navigation_position.'" nav_style="'.$nav_style.'" navigation_color="'.$navigation_color.'" navigation_bg_color="'.$navigation_bg_color.'" navigation_color_hover="'.$navigation_color_hover.'" navigation_bg_color_hover="'.$navigation_bg_color_hover.'" pagination_color="'.$pagination_color.'" navigation="'.$navigation.'" pagination="'.$pagination.'"]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}