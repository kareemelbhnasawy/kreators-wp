<?php
namespace Elementor;

class addons_map_pins extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'map-pins', plugins_url( '../../../css/map-pins.css' , __FILE__ ));
        return [
            'map-pins',
        ];
    }
	public function get_name() {
		return 'mt-map-pins';
	} 
	
	public function get_title() {
		return 'MT - Map Pins';
	}
	
	public function get_icon() {
		return 'eicon-map-pin';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	public function get_script_depends() {
        
        wp_register_script( 'map-pins', plugins_url( '../../../js/map-pins.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'map-pins' ];
    }
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'item_image_map',
			[
				'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		); 
		$repeater = new \Elementor\Repeater(); 
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Pin Title', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'rows' => 5,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your description here', 'modeltheme-addons-for-wpbakery' ),
				'default' => '',
			]
		);
		$repeater->add_control(
			'pin_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Pin Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		); 
		$repeater->add_control(
			'pin_bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Pin Bg Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		); 
		$repeater->add_control(
			'image',
			[
				'label' => __( 'Thumbnail', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);
		$repeater->add_control(
			'coordinates_x',
			[
				'label' => __( 'Coordinates on x axis', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::NUMBER,
				'placeholder' => __( 'Enter coordinates on x axis in percentange)', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$repeater->add_control(
			'coordinates_y',
			[
				'label' => __( 'Coordinates on y axis', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::NUMBER,
				'placeholder' => __( 'Enter coordinates on y axis in percentange', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$repeater->add_control(
			'el_class',
			[
				'label' => __( 'Extra class name', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'map_pins',
			[
				'label' => __( 'Map Pins', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '',
			]
		);
	$this->end_controls_section();

	}
	                    
	protected function render() {
        $settings 						= $this->get_settings_for_display();
        $item_image_map 				= $settings['item_image_map']['id'];
        $map_pins 						= $settings['map_pins'];

  //       $image_id = '';
		// if ($item_image_map['source'] == 'library') {
		// 	$image_id .= $item_image_map['id'].',';
  //       }

        $shortcode_content = ''; 

        $shortcode_content .= '[mt_addons_map_pins_short page_builder="elementor" item_image_map="'.$item_image_map.'"]';
        	foreach ($map_pins as $pins ) {
        		$title 							= $pins['title'];
		        $subtitle 						= $pins['subtitle'];
		        $pin_color 						= $pins['pin_color'];
		        $pin_bg_color 					= $pins['pin_bg_color'];
		        $image 							= $pins['image']['id'];
		        $coordinates_x 					= $pins['coordinates_x'];
		        $coordinates_y 					= $pins['coordinates_y'];

        		$shortcode_content .= '[mt_addons_map_pins_short_item page_builder="elementor"  coordinates_y="'.$coordinates_y.'" coordinates_x="'.$coordinates_x.'" image="'.$image.'" pin_bg_color="'.$pin_bg_color.'" pin_color="'.$pin_color.'"  subtitle="'.$subtitle.'"  title="'.$title.'"]';
        		$shortcode_content .= '[/mt_addons_map_pins_short_item]';

        	}
        $shortcode_content .= '[/mt_addons_map_pins_short]';


        echo do_shortcode($shortcode_content);
	}
	protected function content_template() {

    }
}