<?php
namespace Elementor;

class addons_mt_social_icon_box extends Widget_Base {
	public function get_style_depends() {
    	wp_enqueue_style( 'social-icon-box-css', plugins_url( '../../../css/social-icon-box.css' , __FILE__ ));
        return [
            'social-icon-box-css',
        ];
    }
	public function get_name() {
		return 'mt-addons-social-icons-box';
	}
	
	public function get_title() {
		return 'MT - Social Icon Box';
	}
	
	public function get_icon() {
		return 'eicon-icon-box';
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
			'box_shape',
			[
				'label' => __( 'Box Shape', 'modeltheme-addons-for-wpbakery' ),
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
		$this->add_control(
	    	'title_text',
	        [
	            'label' => esc_html__('Social/Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	        ]
	    );
		$this->add_control(
	    	'title_size',
			[
				'label' => esc_html__( 'Title Font Size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'color_content',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Color of content', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'background_box',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background of the box', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		//icon
		$this->add_control(
			'icon_type',
			[
				'label' => __( 'Type', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'font_icon' 		=> __( 'Font Icon', 'modeltheme-addons-for-wpbakery' ),
					'image' 		=> __( 'Image', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control( 
			'icon_fontawesome',
			[
				'label' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => 'font_icon',
				],
			]
		);
		$this->add_control(
	      'icon_size',
	      [
	        'label' => esc_html__( 'Icon Size', 'modeltheme-addons-for-wpbakery' ),
	        'type' => \Elementor\Controls_Manager::NUMBER,
	        'default' => 100,
	        'condition' => [
					'icon_type' => 'font_icon',
			],
	      ]
	    );
	    $this->add_control(
			'icon_image',
			[
				'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);
	    $this->add_control(
	      'icon_color',
	      [
	        'type' => \Elementor\Controls_Manager::COLOR,
	        'label' => __( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
	        'label_block' => true,
	        'condition' => [
				'icon_type' => 'font_icon',
			],
	      ]
	    );
		$this->add_control(
			'icon_url',
			[
				'label' => esc_html__( 'Link', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Text', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		//end icon
		
	
	   

		$this->end_controls_section();

	}
	
	protected function render() {
        $settings 			= $this->get_settings_for_display();
        $box_shape 			= $settings['box_shape'];
        $title_text 		= $settings['title_text'];
        $color_content 		= $settings['color_content'];
        $background_box 	= $settings['background_box'];
        $icon_fontawesome 	= $settings['icon_fontawesome'];
        $icon_size 			= $settings['icon_size'];
        $icon_color 		= $settings['icon_color'];
        $icon_url 			= $settings['icon_url'];
        $title 				= $settings['title'];
        // $image 				= $settings['image'];
        $icon_type 			= $settings['icon_type'];


        $btn_atts = '';
		$btn_atts .= $icon_url['url'].',';
		$btn_atts .= $icon_url['is_external'].',';
		$btn_atts .= $icon_url['nofollow'].',';
		$btn_atts .= $title.',';

        $shortcode_content = '';

    	$image_svg = '';
    	$elementor_icon_fontawesome = '';
        if ($icon_fontawesome['library'] == 'svg') {
        	$image_svg = $icon_fontawesome['value']['id'];
        }else{
        	$elementor_icon_fontawesome = $icon_fontawesome['value'];
        }

        $shortcode_content .= do_shortcode('[mt-addons-social-icons-box page_builder="elementor" icon_url="'.$btn_atts.'" box_shape="'.$box_shape.'"  title_text="'.$title_text.'"  color_content="'.$color_content.'"  background_box="'.$background_box.'" icon_type="'.$icon_type.'" elementor_icon_fontawesome="'.$elementor_icon_fontawesome.'"  image="'.$image_svg.'"  icon_size="'.$icon_size.'"  icon_color="'.$icon_color.'" ]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}