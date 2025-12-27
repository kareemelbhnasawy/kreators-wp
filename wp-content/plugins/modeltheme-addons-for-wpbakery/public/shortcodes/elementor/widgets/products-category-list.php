<?php
namespace Elementor;

class addons_products_category_list extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'products-category-list', plugins_url( '../../../css/collectors-list.css' , __FILE__ ));

        return [
            'products-category-list',
        ];
    }
	public function get_name() {
		return 'products-category-list';
	} 
	
	public function get_title() {
		return 'MT - Products Category List';
	}
	
	public function get_icon() {
		return 'eicon-editor-list-ul';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'number_of_columns',
			[
				'label' => __( 'Columns', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'col-md-12' 		=> __( 'One', 'modeltheme-addons-for-wpbakery' ),
					'col-md-6'		    => __( 'Two', 'modeltheme-addons-for-wpbakery' ),
					'col-md-4' 		    => __( 'Three', 'modeltheme-addons-for-wpbakery' ),
					'col-md-3' 		    => __( 'Four', 'modeltheme-addons-for-wpbakery' ),

				]
			]
		);
		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'recent' 		=> __( 'Recent', 'modeltheme-addons-for-wpbakery' ),
					'oldest'		    => __( 'Oldest', 'modeltheme-addons-for-wpbakery' ),
					'alpha' 		    => __( 'Alphabetical', 'modeltheme-addons-for-wpbakery' ),

				]
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
			'subtitle_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Subtitle Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'color_number',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Number Color ', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $number 			= $settings['number'];
        $number_of_columns 	= $settings['number_of_columns'];
        $order 				= $settings['order'];
        $title_color 		= $settings['title_color'];
        $subtitle_color 	= $settings['subtitle_color'];
        $color_number 		= $settings['color_number'];

		echo do_shortcode( '[mt-addons-collectors-list number="'.$number.'" number_of_columns="'.$number_of_columns.'" order="'.$order.'" title_color="'.$title_color.'" subtitle_color="'.$subtitle_color.'" color_number="'.$color_number.'"]' );


	}
	protected function content_template() {

    }
}