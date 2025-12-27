<?php
namespace Elementor;

	class addons_cta_banner extends Widget_Base {

		public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-cta-banner', plugins_url( '../../../css/cta-banner.css' , __FILE__ ));
        
        return [
            'mt-addons-cta-banner',
        ];
    }

    public function get_name()
    {
        return 'cta-banner';
    }

    public function get_title()
    {
        return esc_html__('MT - CTA Banner', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'cta', 'banner', 'call'];
    }

	public function register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'content_align',
            [
                'label' => esc_html__( 'Content Align', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Start', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-v-aligniddle',
                    ],
                    'end' => [
                        'title' => esc_html__( 'End', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'start',
                'toggle' => true,
            ]
        );
		$this->add_control(
            'content_img',
            [
                'label' => esc_html__( 'Banner Image', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
		$this->add_control(
	    	'title',
	        [
	            'label' => esc_html__('Main Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	            'default' => 'Example Title',
	        ]
	    );
	    $this->add_control(
	    	'subtitle',
	        [
	            'label' => esc_html__('Main Subtitle', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	            'default' => 'Example Subtitle',

	        ]
	    );
        $this->add_control(
	    	'paragraph',
	        [
	            'label' => esc_html__('Main Paragraph', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXTAREA,
	            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus nisl vitae magna pulvinar laoreet. Nullam erat ipsum, mattis nec mollis ac, accumsan a enim. Nunc at euismod arcu. Aliquam ullamcorper eros justo, vel mollis neque facilisis vel.',
	        ]
	    );
	    $this->add_control(
			'show_link',
			[
				'label' => esc_html__( 'Enable Link', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => esc_html__( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
	    $this->add_control(
			'content_link',
			[
				'label' => esc_html__( 'Content Link', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'button',
			[
				'label' => __( 'Button', 'modeltheme-addons-for-wpbakery' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'show_button',
			[
				'label' => esc_html__( 'Show Button', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'modeltheme-addons-for-wpbakery' ),
				'label_off' => esc_html__( 'Hide', 'modeltheme-addons-for-wpbakery' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
	    	'button_text',
	        [
	            'label' => esc_html__('Button Text', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	            'default' => 'Read More',
	        ]
	    );
	    $this->add_control(
            'button_align',
            [
                'label' => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );
	    $this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
            'icon_holder',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
            ]
            );
		$this->add_control(
        	'button_color',
            [
                'label' => esc_html__( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-html--link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            	'label' => esc_html__( 'Text Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .mt-addons-cta-banner-html--link',
            ]
        );
        $this->add_control(
            'button_background',
            [
                'label' => esc_html__( 'Background Button', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-html--link' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_background_hover',
            [
                'label' => esc_html__( 'Background Color (Hover)', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .mt-addons-cta-banner-html--link:hover' => 'background-color: {{VALUE}}',
            	],
          	]
        );
        $this->add_control(
            'padding_button',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_radius',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-html--link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
	    $this->end_controls_section();
		$this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_align',
            [
                'label' => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            	'label' => esc_html__( 'Title Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mt-addons-cta-banner-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'padding_title',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__('Subtitle Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'subtitle_align',
            [
                'label' => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            	'label' => esc_html__( 'Subtitle Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .mt-addons-cta-banner-subtitle',
            ]
        );
        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'padding_subtitle',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'paragraph_style',
            [
                'label' => esc_html__('Paragraph Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'paragraph_align',
            [
                'label' => esc_html__( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'modeltheme-addons-for-wpbakery' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            	'label' => esc_html__( 'Paragraph Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'paragraph_typography',
                'selector' => '{{WRAPPER}} .mt-addons-cta-banner-text',
            ]
        );
        $this->add_control(
            'paragraph_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'padding_paragraph',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style',
            [
                'label' => esc_html__('Banner Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .mt-addons-cta-banner-shortcode',
			]
		);
		$this->add_control(
            'padding_item',
            [
                'label' => esc_html__( 'Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-shortcode' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-cta-banner-shortcode' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'textdomain' ),
                'selector' => '{{WRAPPER}} .mt-addons-cta-banner-shortcoder',
            ]
        );
		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $content_align = $settings['content_align'];
        $content_link = $settings['content_link']['url'];
        $title = $settings['title'];
        $title_align = $settings['title_align'];
        $subtitle = $settings['subtitle'];
        $subtitle_align = $settings['subtitle_align'];
        $paragraph = $settings['paragraph'];
        $paragraph_align = $settings['paragraph_align'];
        $button_text = $settings['button_text'];
        $button_link = $settings['button_link']['url'];
        $button_align = $settings['button_align'];
        $content_img = $settings['content_img']['url'];
        $icon_holder = $settings['icon_holder'];
        ?>
       	<div class="mt-addons-cta-banner-shortcode mt-addons-cta-banner  mt-addons-cta-banner-inner mt-addons-cta-banner-layout--standard mt-addons-cta-banner-vertical--bottom mt-addons-cta-banner-horizontal--left mt-addons-cta-banner-image--hover-zoom ">
       		<?php if(!empty($content_img)){?>
				<div class="mt-addons-cta-banner-image">
					<img src="<?php echo esc_url($content_img); ?>" alt="<?php echo esc_attr($title); ?>">
				</div>
			<?php }?>
			<div class="mt-addons-cta-banner-content" style="justify-content:<?php echo esc_attr($content_align); ?>;">
				<div class="mt-addons-cta-banner-content-inner">
					<?php if(!empty($subtitle)){?>
						<h5 class="mt-addons-cta-banner-subtitle" style="text-align: <?php echo esc_attr($subtitle_align); ?>"><?php echo esc_html($subtitle); ?> </h5>
					<?php }?>
					<?php if(!empty($title)){?>
						<h3 class="mt-addons-cta-banner-title" style="text-align: <?php echo esc_attr($title_align); ?>"><?php echo esc_html($title); ?> </h3>
					<?php }?>
					<?php if(!empty($paragraph)){?>
						<p class="mt-addons-cta-banner-text" style="text-align: <?php echo esc_attr($paragraph_align); ?>"><?php echo esc_html($paragraph); ?></p>
					<?php }?>
					<?php if ( 'yes' === $settings['show_button'] ) { ?>
						<div class="mt-addons-cta-banner-button" style="text-align: <?php echo esc_attr($button_align); ?>">
							<a href="<?php echo esc_url($button_link); ?>" class="mt-addons-cta-banner-shortcode mt-addons-cta-banner  mt-addons-cta-banner-button mt-addons-cta-banner-html--link mt-addons-cta-banner-layout--textual mt-addons-cta-banner-type--standard   mt-addons-cta-banner-icon--right mt-addons-cta-banner-hover--iconove-horizontal-short   mt-addons-cta-banner-text-underline mt-addons-cta-banner-underline--left">
								<span class="mt-addons-cta-banner-text"><?php echo esc_html($button_text); ?></span> 
								<span class="mt-addons-cta-banner-icon "> 
									<span class="mt-addons-cta-banner-icon-inner"> 
										 <?php \Elementor\Icons_Manager::render_icon( $settings['icon_holder'], [ 'aria-hidden' => 'true' ] ) ?>
									</span> 
								</span>
							</a> 
						</div>
					<?php }?>
				</div>
			</div>
			<?php if ( 'yes' === $settings['show_link'] ) { ?>
				<a href="<?php echo esc_url($content_link); ?>" itemprop="url" class="mt-addons-cta-banner-inner-link" target="_self"></a>
			<?php }?>
		</div><?php
	}
    protected function content_template() {}
}

