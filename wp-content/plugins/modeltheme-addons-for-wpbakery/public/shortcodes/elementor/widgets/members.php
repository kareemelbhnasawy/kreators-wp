<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_members extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'mt-members', plugins_url( '../../../css/members.css' , __FILE__ ));
        wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));

        return [
            'mt-members',
            'swiper-bundle',
        ];
    }
	use ContentControlSlider;

	public function get_name() {
		return 'mt-members';
	} 
	
	public function get_title() {
		return 'MT - Members';
	}
	
	public function get_icon() {
		return 'eicon-person';
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
        $this->style_title();
        
    }
	protected function section_title() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
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
			'links_target',
			[
				'label' => __( 'Open Link In New Tab', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
	    $repeater = new Repeater();
		$repeater->add_control(
			'list_image',
			[
				'label' => esc_html__( 'Image', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
	    	'member_name',
	        [
	            'label' => esc_html__('Name', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
		$repeater->add_control( 
			'name_size',
			[
				'label' => esc_html__( 'Name Font Size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$repeater->add_control(
	    	'member_position',
	        [
	            'label' => esc_html__('Position', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
		$repeater->add_control(
	    	'member_description',
	        [
	            'label' => esc_html__('Short description', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
		$repeater->add_control(
	    	'member_url',
	        [
	            'label' => esc_html__('Website', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'email',
	        [
	            'label' => esc_html__('Email', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'facebook',
	        [
	            'label' => esc_html__('Facebook URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'twitter',
	        [
	            'label' => esc_html__('Twitter URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'pinterest',
	        [
	            'label' => esc_html__('Pinterest URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'instagram',
	        [
	            'label' => esc_html__('Instagram URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'youtube',
	        [
	            'label' => esc_html__('YouTube URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'linkedin',
	        [
	            'label' => esc_html__('LinkedIn URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'dribbble',
	        [
	            'label' => esc_html__('Dribbble URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'deviantart',
	        [
	            'label' => esc_html__('Deviantart URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'digg',
	        [
	            'label' => esc_html__('Digg URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'flickr',
	        [
	            'label' => esc_html__('Flickr URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'tumblr',
	        [
	            'label' => esc_html__('Tumblr URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'stumbleupon',
	        [
	            'label' => esc_html__('Stumbleupon URL', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $this->add_control(
	        'member_groups',
	        [
	            'label' => esc_html__('Members Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    );
		$this->end_controls_section();

	}
    private function style_title() {

        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'overlay_bg',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Overlay Backgroud', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'icons_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Icons Color', 'modeltheme-addons-for-wpbakery' ),
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
		$this->add_control(
			'position_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Position Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'description_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Short Description Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);

	}
	    
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $image_shape 			= $settings['image_shape'];
        $featured_image_size 	= $settings['featured_image_size'];
        $links_target 			= $settings['links_target'];
        $member_groups 			= $settings['member_groups'];
        $overlay_bg 			= $settings['overlay_bg'];
        $icons_color 			= $settings['icons_color'];
        $title_color 			= $settings['title_color'];
        $position_color 		= $settings['position_color'];
        $description_color 		= $settings['description_color'];
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

		$serialized_member_groups = base64_encode(serialize($member_groups));
		
        $shortcode_content = '';
		// echo '<pre>' . var_export($member_groups, true) . '</pre>';
        $shortcode_content .= do_shortcode('[mt-addons-members page_builder="elementor" member_groups="'.$serialized_member_groups.'" image_shape="'.$image_shape.'" featured_image_size="'.$featured_image_size.'" links_target="'.$links_target.'" overlay_bg="'.$overlay_bg.'" icons_color="'.$icons_color.'" title_color="'.$title_color.'" position_color="'.$position_color.'" description_color="'.$description_color.'" delay="'.$delay.'" items_desktop="'.$items_desktop.'" items_mobile="'.$items_mobile.'" items_tablet="'.$items_tablet.'" space_items="'.$space_items.'" touch_move="'.$touch_move.'" effect="'.$effect.'" grab_cursor="'.$grab_cursor.'" infinite_loop="'.$infinite_loop.'" columns="'.$columns.'" layout="'.$layout.'" centered_slides="'.$centered_slides.'" navigation_position="'.$navigation_position.'" nav_style="'.$nav_style.'" navigation_color="'.$navigation_color.'" navigation_bg_color="'.$navigation_bg_color.'" navigation_color_hover="'.$navigation_color_hover.'" navigation_bg_color_hover="'.$navigation_bg_color_hover.'" pagination_color="'.$pagination_color.'" navigation="'.$navigation.'" pagination="'.$pagination.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}