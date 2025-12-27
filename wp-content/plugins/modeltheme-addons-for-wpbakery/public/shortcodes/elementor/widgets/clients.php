<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_clients extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'mt-clients', plugins_url( '../../../css/clients-carousel.css' , __FILE__ ));
      	wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));
        return [
            'mt-clients',
            'swiper-bundle',
        ];
    }
    public function get_script_depends() {
        
        wp_register_script( 'swiper', plugins_url( '../../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
        wp_register_script( 'hero-slider', plugins_url( '../../../js/swiper.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'swiper', 'hero-slider' ];
    }
	use ContentControlSlider;

	public function get_name() {
		return 'mt-clients';
	}
	
	public function get_title() {
		return 'MT - Clients';
	}
	
	public function get_icon() {
		return 'eicon-gallery-grid';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
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
		'client_name_status',
		[
			'label' => __( 'Client Names', 'modeltheme-addons-for-wpbakery' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
			'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
			'return_value' => 'yes',
			'default' => 'no',
		]
	);
    $this->add_control(
		'client_border',
		[
			'label' => __( 'Border', 'modeltheme-addons-for-wpbakery' ),
			'label_block' => true,
			'type' => Controls_Manager::SELECT,
			'options' => [
				'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
				'clients-border' 	=> __( 'Border', 'modeltheme-addons-for-wpbakery' ),
				''					=> __( 'No Border', 'modeltheme-addons-for-wpbakery' ),
			]
		]
	);
	$this->add_control(
		'client_photo_height',
		[
			'label' => esc_html__( 'Photo Height', 'modeltheme-addons-for-wpbakery' ),
			'type' => \Elementor\Controls_Manager::NUMBER,
		]
	);
	$this->add_control(
		'image_shape', 
		[
			'label' => __( 'Image Shape', 'modeltheme-addons-for-wpbakery' ),
			'label_block' => true,
			'type' => Controls_Manager::SELECT,
			'options' => [
				'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
				'img-rounded' 		=> __( 'Rounded', 'modeltheme-addons-for-wpbakery' ),
				'img-circle'		=> __( 'Circle', 'modeltheme-addons-for-wpbakery' ),
				'img-square' 		=> __( 'Square', 'modeltheme-addons-for-wpbakery' ),
			]
		]
	);
	$repeater = new Repeater();
	$repeater->add_control(
	'clients_image',
		[
			'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
			'type' => \Elementor\Controls_Manager::MEDIA,
			'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			],
		]
	);
	$repeater->add_control(
    'clients_name',
        [
            'label' => esc_html__('Name', 'modeltheme-addons-for-wpbakery'),
            'type' => Controls_Manager::TEXT
        ]
    );
	$repeater->add_control(
	'client_url',
		[
			'label' => esc_html__( 'Link', 'modeltheme-addons-for-wpbakery' ),
			'type' => Controls_Manager::TEXT,
			'default' => '',
		]
	);
    $this->add_control(
        'clients_groups',
        [
            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls()
        ]
    );
    $this->add_control( 
		'grid_rows',
		[
			'label' => __( 'Show Grid', 'modeltheme-addons-for-wpbakery' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
			'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
			'return_value' => 'yes',
			'default' => 'no',
		]
	);
	// end repeater;
	$this->end_controls_section();

	}
	    
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $client_name_status 	= $settings['client_name_status'];
        $client_border 			= $settings['client_border'];
        $client_photo_height 	= $settings['client_photo_height'];
        $image_shape 			= $settings['image_shape'];
        $clients_groups 		= $settings['clients_groups'];
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
        $grid_rows 				= $settings['grid_rows'];

		//end carousel

        $shortcode_content = '';
		$serialized_member_groups = base64_encode(serialize($clients_groups));
        $shortcode_content .= do_shortcode('[mt-addons-clients-carusel page_builder="elementor" clients_groups="'.$serialized_member_groups.'" client_name_status="'.$client_name_status.'" client_border="'.$client_border.'"  client_photo_height="'.$client_photo_height.'" image_shape="'.$image_shape.'"   autoplay="'.$autoplay.'"  delay="'.$delay.'" items_desktop="'.$items_desktop.'" items_mobile="'.$items_mobile.'" items_tablet="'.$items_tablet.'" space_items="'.$space_items.'" touch_move="'.$touch_move.'" effect="'.$effect.'" grab_cursor="'.$grab_cursor.'" infinite_loop="'.$infinite_loop.'" columns="'.$columns.'" layout="'.$layout.'" centered_slides="'.$centered_slides.'" navigation_position="'.$navigation_position.'" nav_style="'.$nav_style.'" navigation_color="'.$navigation_color.'" navigation_bg_color="'.$navigation_bg_color.'" navigation_color_hover="'.$navigation_color_hover.'" navigation_bg_color_hover="'.$navigation_bg_color_hover.'" pagination_color="'.$pagination_color.'" navigation="'.$navigation.'" pagination="'.$pagination.'" grid_rows="'.$grid_rows.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}