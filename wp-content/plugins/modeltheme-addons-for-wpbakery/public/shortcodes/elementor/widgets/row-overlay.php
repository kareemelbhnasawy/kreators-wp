<?php
namespace Elementor; 

class addons_row_overlay extends Widget_Base {
	
	public function get_style_depends() {
   	 	wp_enqueue_style( 'mt-row-overlay', plugins_url( '../../../css/row-overlay.css' , __FILE__ ));

        return [
            'mt-row-overlay',
        ];
    }
	public function get_name() {
		return 'mt-addons-row-overlay';
	}
	
	public function get_title() {
		return 'MT - Row Overlay';
	}
	
	public function get_icon() {
		return 'eicon-image-rollover';
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
			'background',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'inner_column',
			[
				'label' => __( 'Keep in Column?', 'modeltheme-addons-for-wpbakery' ),
                'description'        => esc_html__( 'If checked, the overlay will be only applied in a column. By default, it will be applied on row.', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'moving_images_grid',
			[
				'label' => __( 'Moving Images Grid?', 'modeltheme-addons-for-wpbakery' ),
                'description'        => esc_html__( 'If checked, an infinite moving images grid will appear below the overlay.', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(  
			'images_gap',
			[
				'label' => esc_html__( 'Images Gap', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'moving_images_grid' => 'yes',
				],
			]
		);
    	$repeater = new Repeater();
		$repeater->add_control(
			'images',
			[
				'label' => esc_html__( 'Upload Images for the current column', 'modeltheme-addons-for-wpbakery' ),
                'description'        => esc_html__( 'Each group will consist in a vertical images row', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);
		$repeater->add_control(
			'animation_type',
			[
				'label' => __( 'Animation type', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 		=> __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
					'mt_slide_up' 		=> __( 'Sliding Up', 'modeltheme-addons-for-wpbakery' ),
					'mt_slide_down' 	=> __( 'Sliding Down', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);	
	    $this->add_control(
	        'image_groups',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'condition' => [
	            	'moving_images_grid' => 'yes',
	            ],
	            'fields' => $repeater->get_controls()
	        ]
	    );
	// end repeater;
	$this->end_controls_section();

	}

	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $background 				= $settings['background'];
        $inner_column 				= $settings['inner_column'];
        $moving_images_grid 		= $settings['moving_images_grid'];
        $images_gap 				= $settings['images_gap'];
        $image_groups 				= $settings['image_groups'];


        $images = wp_list_pluck( $gallery['images'], 'id' );
		// echo '<pre>' . var_export($gallery_items, true) . '</pre>';
    

        $shortcode_content = ''; 
		$serialized_image_groups = base64_encode(serialize($image_groups));
        $shortcode_content .= do_shortcode('[mt-row-overlay 
        	page_builder="elementor" 
        	image_groups="'.$serialized_image_groups.'" 
        	background="'.$background.'" 
        	inner_column="'.$inner_column.'"  
        	moving_images_grid="'.$moving_images_grid.'" 
        	images_gap="'.$images_gap.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}