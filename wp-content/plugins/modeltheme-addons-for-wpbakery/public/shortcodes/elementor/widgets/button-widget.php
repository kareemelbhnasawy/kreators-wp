<?php
namespace Elementor;

class addons_button_widget extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'mt-button', plugins_url( '../../../css/button.css' , __FILE__ ));
        return [
            'mt-button',
        ];
    }
	public function get_name() {
		return 'button-widget';
	}
	
	public function get_title() {
		return 'MT - Button';
	}
	
	public function get_icon() {
		return 'eicon-button';
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
			'btn_url',
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
		$this->add_control(
			'btn_size',
			[
				'label' => __( 'Size', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'mt-addons-btn-sm' 	=> __( 'Small', 'modeltheme-addons-for-wpbakery' ),
					'mt-addons-btn-medium' 		=> __( 'Medium', 'modeltheme-addons-for-wpbakery' ),
					'mt-addons-btn-lg'		=> __( 'Large', 'modeltheme-addons-for-wpbakery' ),
					'mt-addons-btn-extra-large' 		=> __( 'Extra-Large', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'font_size',
			[
				'label' => esc_html__( 'Font Size', 'modeltheme-addons-for-wpbakery' ),
				'placeholder' => esc_html__( 'in pixels', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
			]
		);
		$this->add_control(
			'font_weight',
			[
				'label' => esc_html__( 'Font weight', 'modeltheme-addons-for-wpbakery' ),
				'placeholder' => esc_html__( 'E.g.: 500', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
			]
		);
		$this->add_control(
			'btn_style',
			[
				'label' => __( 'Shape', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'btn-square' 	=> __( 'Square (Default)', 'modeltheme-addons-for-wpbakery' ),
					'btn-rounded' 		=> __( 'Rounded (5px Radius)', 'modeltheme-addons-for-wpbakery' ),
					'btn-round' 		=> __( 'Round (30px Radius)', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text-left' 	=> __( 'Left', 'modeltheme-addons-for-wpbakery' ),
					'text-center' 		=> __( 'Center', 'modeltheme-addons-for-wpbakery' ),
					'text-right' 		=> __( 'Right', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
			'display_type',
			[
				'label' => __( 'Inline Block', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'placeholder' => esc_html__( 'If checked, the button will allow other content next to it', 'modeltheme-addons-for-wpbakery' ),

			]
		);
		$this->add_control(
			'margin',
			[
				'label' => __( 'Margin', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'placeholder' => esc_html__( 'If checked, the button will allow to set custom margin', 'modeltheme-addons-for-wpbakery' ),
				
			]
		);
		$this->add_control(
			'btn_margin',
			[
				'label' => __( 'Button Margin', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Example: 25px 50px 75px 100px (top margin is 25px; right margin is 50px;
          bottom margin is 75px;left margin is 100px)', 'modeltheme-addons-for-wpbakery' ),
				'condition' => [
					'margin' => 'yes',
				],
			]
		);
		$this->add_control(
			'padding',
			[
				'label' => __( 'Padding', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'placeholder' => esc_html__( 'If checked, the button will allow to set custom padding', 'modeltheme-addons-for-wpbakery' ),
				
			]
		);
		$this->add_control(
			'btn_padding',
			[
				'label' => __( 'Button Padding', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Example: 25px 50px 75px 100px (top margin is 25px; right margin is 50px;
          bottom margin is 75px;left margin is 100px)', 'modeltheme-addons-for-wpbakery' ),
				'condition' => [
					'padding' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_tab',
			[
				'label' => __( 'Styling', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'btn_theme_default',
			[
				'label' => __( 'Theme Default Button?', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'placeholder' => esc_html__( 'If checked, the button will inherit styling from the theme (colors/border/box shadow). By filling the options below the default options will be overridden.', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'bg_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background color - hover', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Text color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'text_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Text color - hover', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'border_status',
			[
				'label' => __( 'Border', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'placeholder' => esc_html__( 'If checked, the button have border.', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'border_width',
			[
				'label' => esc_html__( 'Border Width', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
				'condition' => [
					'border_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'border_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Border Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'border_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'border_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Border Color - Hover', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'border_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'box_shadow_status',
			[
				'label' => __( 'Box Shadow', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => __( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
				'placeholder' => esc_html__( 'If checked, the button have box shadow.', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'box_shadow_offset_x',
			[
				'label' => esc_html__( 'Box Shadow Offset X (px)', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
				'condition' => [
					'box_shadow_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'box_shadow_offset_y',
			[
				'label' => esc_html__( 'Box Shadow Offset Y (px)', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
				'condition' => [
					'box_shadow_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'box_shadow_blur',
			[
				'label' => esc_html__( 'Box Shadow Blur (px)', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '',
				'condition' => [
					'box_shadow_status' => 'yes',
				],
			]
		);
		$this->add_control(
			'box_shadow_color',
			[
				'label' => esc_html__( 'Box Shadow Color (It can be RGBA)', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'box_shadow_status' => 'yes',
				],
			]
		);
		$this->end_controls_section();

	}
	
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $btn_url 				= $settings['btn_url'];
        $title 					= $settings['title'];
        $btn_size 				= $settings['btn_size'];
        $font_size 				= $settings['font_size'];
        $font_weight 			= $settings['font_weight'];
        $btn_style 				= $settings['btn_style'];
        $align 					= $settings['align'];
        $display_type 			= $settings['display_type'];
        $margin 				= $settings['margin'];
        $btn_margin 			= $settings['btn_margin'];
        $padding 				= $settings['padding'];
        $btn_padding 			= $settings['btn_padding'];
        $btn_theme_default 		= $settings['btn_theme_default'];
        $color 					= $settings['color'];
        $bg_color_hover 		= $settings['bg_color_hover'];
        $text_color 			= $settings['text_color'];
        $text_color_hover 		= $settings['text_color_hover'];
        $border_status 			= $settings['border_status'];
        $border_width 			= $settings['border_width'];
        $border_color 			= $settings['border_color'];
        $border_color_hover 	= $settings['border_color_hover'];
        $box_shadow_status 		= $settings['box_shadow_status'];
        $box_shadow_offset_x 	= $settings['box_shadow_offset_x'];
        $box_shadow_offset_y 	= $settings['box_shadow_offset_y'];
        $box_shadow_blur 		= $settings['box_shadow_blur'];
        $box_shadow_color 		= $settings['box_shadow_color'];

        $shortcode_content = '';

        // echo var_dump($title);
		// echo '<pre>' . var_export($btn_url, true) . '</pre>';
		$btn_atts = '';
		$btn_atts .= $btn_url['url'].',';
		$btn_atts .= $btn_url['is_external'].',';
		$btn_atts .= $btn_url['nofollow'].',';
		$btn_atts .= $title.',';

        $shortcode_content .= do_shortcode('[mt-addons-button page_builder="elementor" btn_url="'.$btn_atts.'" btn_size="'.$btn_size.'" font_size="'.$font_size.'" font_weight="'.$font_weight.'" btn_style="'.$btn_style.'" align="'.$align.'" display_type="'.$display_type.'" margin="'.$margin.'" btn_margin="'.$btn_margin.'" padding="'.$padding.'" btn_padding="'.$btn_padding.'" btn_theme_default="'.$btn_theme_default.'" color="'.$color.'" bg_color_hover="'.$bg_color_hover.'" text_color="'.$text_color.'" text_color_hover="'.$text_color_hover.'" border_status="'.$border_status.'" border_width="'.$border_width.'" border_color="'.$border_color.'" border_color_hover="'.$border_color_hover.'" box_shadow_status="'.$box_shadow_status.'" box_shadow_offset_x="'.$box_shadow_offset_x.'" box_shadow_offset_y="'.$box_shadow_offset_y.'" box_shadow_blur="'.$box_shadow_blur.'" box_shadow_color="'.$box_shadow_color.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}