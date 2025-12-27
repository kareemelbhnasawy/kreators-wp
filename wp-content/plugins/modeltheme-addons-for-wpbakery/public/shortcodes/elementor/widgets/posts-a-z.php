<?php
namespace Elementor;

class addons_posts_a_z extends Widget_Base {
	
	public function get_style_depends() {
  		wp_enqueue_style( 'mt-posts-a-z', plugins_url( '../../../css/posts-a-z.css' , __FILE__ ));

        return [
            'mt-posts-a-z',
        ];
    }
	public function get_name() {
		return 'mt-posts-a-z';
	}
	
	public function get_title() {
		return 'MT - Posts A-Z';
	}
	
	public function get_icon() {
		return 'eicon-post-list';
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
    	$all_posts = modeltheme_addons_posts_array('page');
		$this->add_control(
			'post_types',
			[
				'label' => esc_html__( 'Select Post Type', 'plugin-name' ),
          		'description' => __( 'Only Choose one. If more than one are selected, the A-Z list will only show posts from the 1st selected type.', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'post'    => esc_html__( 'Post', 'modeltheme-addons-for-wpbakery' ),
					'page' 	  => esc_html__( 'Page', 'modeltheme-addons-for-wpbakery' ),
					'product' => esc_html__( 'Product', 'modeltheme-addons-for-wpbakery' ),
				],
			]
		);
		$this->add_control( 
			'excluded_ids',
			[
				'label' => esc_html__( 'Exclude Items from the list', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $all_posts,
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'style_posts',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'alignment',
            [
                'label'   => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left'   => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'text-right'  => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle'  => false,
            ]
        ); 
        $this->add_control(
			'az_letters_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'A-Z Letters Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
	    $this->add_control(
			'title_background',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title Background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
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
	$this->end_controls_section();
	}
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $post_types 				= $settings['post_types'];
        $excluded_ids 				= $settings['excluded_ids'];
        $alignment 					= $settings['alignment'];
        $az_letters_color 			= $settings['az_letters_color'];
        $title_background 			= $settings['title_background'];
        $title_color 				= $settings['title_color'];

        $shortcode_content = ''; 
        $shortcode_content .= do_shortcode('[mt-addons-posts-az page_builder="elementor" post_types="'.$post_types.'" excluded_ids="'.$excluded_ids.'" alignment="'.$alignment.'" az_letters_color="'.$az_letters_color.'" title_background="'.$title_background.'" title_color="'.$title_color.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}