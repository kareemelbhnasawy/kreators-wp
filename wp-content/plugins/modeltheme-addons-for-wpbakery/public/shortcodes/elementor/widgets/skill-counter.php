<?php
namespace Elementor;

class addons_skill_counter extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'skill-counter-css', plugins_url( '../../../css/skill-counter.css' , __FILE__ ));
        return [
            'skill-counter-css',
        ];
    }

	public function get_name() {
		return 'skill-counter';
	}
	 
	public function get_title() {
		return 'MT - Skill Counter';
	}
	
	public function get_icon() {
		return 'eicon-nerd';
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
			'columns',
			[
				'label' => __( 'Columns', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'col-md-12' 		=> __( '1 Column', 'modeltheme-addons-for-wpbakery' ),
					'col-md-6'			=> __( '2 Columns', 'modeltheme-addons-for-wpbakery' ),
					'col-md-4' 			=> __( '3 Columns', 'modeltheme-addons-for-wpbakery' ),
					'col-md-3' 			=> __( '4 Columns', 'modeltheme-addons-for-wpbakery' ),
					'col-md-2' 			=> __( '6 Columns', 'modeltheme-addons-for-wpbakery' ),

				]
			]
		);
		$this->add_control( 
			'border_left',
			[
				'label' => __( 'Border', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'mt-addons-border' 	=> __( 'Border', 'modeltheme-addons-for-wpbakery' ),
					'test'					=> __( 'No border', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control( 
			'icon_pos',
			[
				'label' => __( 'Border', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'before-content' 	=> __( 'Before Content', 'modeltheme-addons-for-wpbakery' ),
					'top-content'		=> __( 'Top Content', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'aligment',
			[
				'label' => __( 'Aligment', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'Left' 				=> __( 'Left', 'modeltheme-addons-for-wpbakery' ),
					'Center'			=> __( 'Center', 'modeltheme-addons-for-wpbakery' ),
					'Right' 			=> __( 'Right', 'modeltheme-addons-for-wpbakery' ),

				]
			]
		);
    	$repeater = new Repeater();
		$repeater->add_control(
			'tabs_item_service_icon_dropdown',
			[
				'label' => __( 'Type', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'choosed_fontawesome' 		=> __( 'Font Icon', 'modeltheme-addons-for-wpbakery' ),
					'choosed_img' 		=> __( 'Image', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$repeater->add_control(
			'tabs_item_service_icon_fa',
			[
				'label' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'tabs_item_service_icon_dropdown' => 'choosed_fontawesome',
				],
			]
		);
		$repeater->add_control(
			'use_img',
			[
				'label' => esc_html__( 'Image', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tabs_item_service_icon_dropdown' => 'choosed_img',
				],
			]
		);
		$repeater->add_control(
	      'icon_size',
	      [
	        'label' => esc_html__( 'Icon Size', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	      ]
	    );
		$repeater->add_control(
	      'list_icon_size',
	      [
	        'type' => \Elementor\Controls_Manager::COLOR,
	        'label' => __( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
	        'label_block' => true,
	      ]
	    );
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
	      'title_color',
	      [
	        'type' => \Elementor\Controls_Manager::COLOR,
	        'label' => __( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
	        'label_block' => true,
	      ]
	    );
	    $repeater->add_control(
	      'skill_value',
	      [
	        'label' => esc_html__( 'Skill value', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	      ]
	    );
	    $repeater->add_control(
	      'skill_color',
	      [
	        'type' => \Elementor\Controls_Manager::COLOR,
	        'label' => __( 'Skill Color', 'modeltheme-addons-for-wpbakery' ),
	        'label_block' => true,
	      ]
	    );
	    $repeater->add_control(
	      'skill_size',
	      [
	        'label' => esc_html__( 'Skill Font Size', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	      ]
	    );
	    $repeater->add_control(
			'suffix',
			[
				'label' => __( 'Suffix', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
	      'font_size',
	      [
	        'label' => esc_html__( 'Suffix Font Size', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	      ]
	    );
	    $this->add_control(
	        'skillcounter_groups',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
		$this->end_controls_section();
	}
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $columns 				= $settings['columns'];
        $icon_pos 				= $settings['icon_pos'];
        $aligment 				= $settings['aligment'];
        $skillcounter_groups 	= $settings['skillcounter_groups'];
        $border_left 			= $settings['border_left'];

    	$shortcode_content = '';
	   
		$serialized_skillcounter_groups = base64_encode(serialize($skillcounter_groups));

        $shortcode_content .= do_shortcode('[mt-addons-skill-counter page_builder="elementor" skillcounter_groups="'.$serialized_skillcounter_groups.'" columns="'.$columns.'" icon_pos="'.$icon_pos.'" aligment="'.$aligment.'" border_left="'.$border_left.'"]' );
        echo  $shortcode_content;
	}
	protected function content_template() {

    }
}