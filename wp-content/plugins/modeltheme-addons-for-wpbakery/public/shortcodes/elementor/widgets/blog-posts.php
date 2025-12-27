<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_blog_posts extends Widget_Base {
	public function get_style_depends() {
    	wp_enqueue_style( 'blog-posts-carousel', plugins_url( '../../../css/blog-posts.css' , __FILE__ ));
      	wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));


        return [
            'blog-posts-carousel', 
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
		return 'blog-posts';
	}
	
	public function get_title() {
		return 'MT - Blog Posts';
	}
	
	public function get_icon() {
		return 'eaicon-post-block';
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
			'number',
			[
				'label' => esc_html__( 'Number', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);
	    $post_category_tax = get_terms('category');
	    $post_category = array();
	    if ($post_category_tax) {
	      foreach ( $post_category_tax as $term ) {
	        $post_category[$term->name] = $term->slug;
	      }
	    }
	    $this->add_control(
			'category',
				[
					'label' => __( 'Category', 'modeltheme-addons-for-wpbakery' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT,
					'options' => $post_category,
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
			'read_more_btn',
			[
				'label' => __( 'Read More Text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'comments_blog',
			[
				'label' => __( 'Comments', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'excerpt_blog',
			[
				'label' => __( 'Excerpt', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'brightness_blog',
			[
				'label' => esc_html__( 'Brightness', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0.1,
				'max' => 0.9,
				'step' => 0.1,
				'default' => '',
			]
		);
		$this->add_control(
			'style_var',
			[
				'label' => __( 'Style', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 	=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'style_1' 		=> __( 'Style 1', 'modeltheme-addons-for-wpbakery' ),
					'style_2' 		=> __( 'Style 2', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => __( 'Title Style', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 	=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'mt_addons_title_top' 		=> __( 'Title top', 'modeltheme-addons-for-wpbakery' ),
					'mt_addons_title_down' 		=> __( 'Title down', 'modeltheme-addons-for-wpbakery' ),
				],
				'condition' => [
					'style_var' => 'style_2',
				],
			]
		);
		$this->add_control(
			'image_post',
			[
				'label' => __( 'Image', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'style_var' => 'style_1',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'title_tab',
			[
				'label' => __( 'Styling', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Title Font size', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
			]
		);
		$this->add_control(
			'title_line',
			[
				'label' => esc_html__( 'Title Line height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0.1,
				'max' => 3,
				'step' => 0.1,
				'default' => '',
			]
		);
		$this->add_control(
			'title_weight',
			[
				'label' => esc_html__( 'Title Font weight', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
			]
		);
		$this->add_control(
			'background_color_ov',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Box Background color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_background',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Button Background', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Button text Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'date_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Date text Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'excerpt_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Excerpt text Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

	}
	
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $number 					= $settings['number'];
        $category 					= $settings['category'];
        $featured_image_size 		= $settings['featured_image_size'];
        $read_more_btn 				= $settings['read_more_btn'];
        $comments_blog 				= $settings['comments_blog'];
        $excerpt_blog 				= $settings['excerpt_blog'];
        $style_var 				    = $settings['style_var'];
        $image_post 				= $settings['image_post'];
        $text_color 				= $settings['text_color'];
        $title_size 				= $settings['title_size'];
        $title_line 				= $settings['title_line'];
        $title_weight 				= $settings['title_weight'];
        $background_color_ov 		= $settings['background_color_ov'];
        $button_background 			= $settings['button_background'];
        $button_color 				= $settings['button_color'];
        $date_color 				= $settings['date_color'];
        $excerpt_color 				= $settings['excerpt_color'];
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
        $brightness_blog 			= $settings['brightness_blog'];
        $title_style 			= $settings['title_style'];

		//end carousel
		$shortcode_content = '';

		// echo '<pre>' . var_export($collectors_groups_imploded, true) . '</pre>';

        $shortcode_content .= do_shortcode('[mt-addons-blog-posts-carousel page_builder="elementor" number="'.$number.'" category="'.$category.'" featured_image_size="'.$featured_image_size.'" read_more_btn="'.$read_more_btn.'"  title_style="'.$title_style.'"  comments_blog="'.$comments_blog.'" excerpt_blog="'.$excerpt_blog.'" style_var="'.$style_var.'" image_post="'.$image_post.'" text_color="'.$text_color.'" title_size="'.$title_size.'" title_line="'.$title_line.'" title_weight="'.$title_weight.'" background_color_ov="'.$background_color_ov.'" button_background="'.$button_background.'" button_color="'.$button_color.'" date_color="'.$date_color.'" excerpt_color="'.$excerpt_color.'" autoplay="'.$autoplay.'" delay="'.$delay.'" items_desktop="'.$items_desktop.'" items_mobile="'.$items_mobile.'" items_tablet="'.$items_tablet.'" space_items="'.$space_items.'" touch_move="'.$touch_move.'" effect="'.$effect.'" grab_cursor="'.$grab_cursor.'" infinite_loop="'.$infinite_loop.'" columns="'.$columns.'" layout="'.$layout.'" centered_slides="'.$centered_slides.'" navigation_position="'.$navigation_position.'" nav_style="'.$nav_style.'" navigation_color="'.$navigation_color.'" navigation_bg_color="'.$navigation_bg_color.'" navigation_color_hover="'.$navigation_color_hover.'" navigation_bg_color_hover="'.$navigation_bg_color_hover.'" pagination_color="'.$pagination_color.'" navigation="'.$navigation.'" pagination="'.$pagination.'" brightness_blog="'.$brightness_blog.'"]');

        echo  $shortcode_content;

}
	protected function content_template() {

    }
}