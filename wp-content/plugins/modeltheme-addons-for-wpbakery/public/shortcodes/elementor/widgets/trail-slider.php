<?php
namespace Elementor;

class addons_trail_slider extends Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-trail-slider', plugins_url( '../../../css/trail-slider.css' , __FILE__ ));
        wp_enqueue_script( 'imagesloaded', plugins_url( '../../../js/plugins/imagesloaded/imagesloaded.pkgd.min.js' , __FILE__));
        wp_enqueue_script( 'TweenMax', plugins_url( '../../../js/plugins/TweenMax/TweenMax.js' , __FILE__));
        wp_enqueue_script( 'mt-addons-trail-slider', plugins_url( '../../../js/trail-slider.js' , __FILE__));
        
        return [
            'trail_slider',
        ];
    }

    public function get_name()
    {
        return 'trail_slider';
    }

    public function get_title()
    {
        return esc_html__('MT - Trail slider', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-long-arrow-right';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'trail', 'slider', 'animation'];
    }

    protected function register_controls()
    {   

        $this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
			]
		);
        $this->add_control(
            'button__prev',
            [
                'label' => esc_html__( 'Button prev', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'prev', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control(
            'button__next',
            [
                'label' => esc_html__( 'Button next', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'next', 'modeltheme-addons-for-wpbakery' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
		$repeater->add_control(
	    	'title',
	        [
	            'label' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	        ]
	    );
        $repeater->add_control(
            'opacity',
            [
                'label' => esc_html__( 'Title/Image Opacity', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '0', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $repeater->add_control(
			'content_img',
			[
				'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
	    $this->add_control( 
	        'list',
	        [
	            'label' => esc_html__('List of items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls(),
                  'default' => [
                    [
                        'title' => esc_html__( 'Title 1', 'modeltheme-addons-for-wpbakery' ),
                        'opacity' => esc_html__( '1', 'modeltheme-addons-for-wpbakery' ),
                    ],
                    [
                        'title' => esc_html__( 'Title 2', 'modeltheme-addons-for-wpbakery' ),
                        'opacity' => esc_html__( '0', 'modeltheme-addons-for-wpbakery' ),
                    ],
                    [
                        'title' => esc_html__( 'Title 3', 'modeltheme-addons-for-wpbakery' ),
                        'opacity' => esc_html__( '0', 'modeltheme-addons-for-wpbakery' ),
                    ],
                ],
	        ]
	    );
		$this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .mt-addons-trail-slider-content__text-inner',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-trail-slider-content__text-inner' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'padding_title',
            [
                'label' => esc_html__( 'Title Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-trail-slider-content__text-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'navigation_style',
            [
                'label' => esc_html__( 'Navigation Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'navigation_typography',
                'selector' => '{{WRAPPER}} .mt-addons-trail-slider-content__nav-button',
            ]
        );
        $this->add_control(
            'navigation_color',
            [
                'label' => esc_html__( 'Navigation Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-trail-slider-content__nav-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'navigation_title',
            [
                'label' => esc_html__( 'Navigation Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-trail-slider-content__nav-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $list = $settings['list'];
        $button__prev = $settings['button__prev'];
        $button__next = $settings['button__next'];
        ?>
        <div class="mt-addons-trail-slider content">
            <?php foreach ( $list as $item ) {
            $title = $item['title'];
            $opacity = $item['opacity'];
            $content_img = $item['content_img']['url'];
             ?>   
                <div class="mt-addons-trail-slider-content__slide--current mt-addons-trail-slider-content__slide">
                    <div class="mt-addons-trail-slider-content__img" style="opacity:<?php echo esc_attr($opacity)?>; transform: matrix(1, 0, 0, 1, 0, 0);">
                        <div class="mt-addons-trail-slider-content__img-inner" style=" transform: matrix(1, 0, 0, 1, 0, 0);"><img src="<?php echo esc_url($content_img); ?>" alt="" /></div>
                    </div>
                    <div class="mt-addons-trail-slider-content__text-wrap">
                        <span class="mt-addons-trail-slider-content__text" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner mt-addons-trail-slider-content__text-inner--stroke"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text mt-addons-trail-slider-content__text--full" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner mt-addons-trail-slider-content__text-inner--stroke"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner mt-addons-trail-slider-content__text-inner--stroke"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text mt-addons-trail-slider-content__text--full" style="opacity:<?php echo esc_attr($opacity)?>">
                            <span class="mt-addons-trail-slider-content__text-inner">
                                <?php echo esc_html($title); ?>
                            </span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner mt-addons-trail-slider-content__text-inner--bottom"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text mt-addons-trail-slider-content__text--full" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner mt-addons-trail-slider-content__text-inner--stroke"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text" style="opacity: 0;">
                            <span
                                class="mt-addons-trail-slider-content__text-inner mt-addons-trail-slider-content__text-inner--stroke mt-addons-trail-slider-content__text-inner--bottom"><?php echo esc_html($title); ?></span>
                        </span>
                        <span class="mt-addons-trail-slider-content__text" style="opacity: 0;">
                            <span class="mt-addons-trail-slider-content__text-inner"><?php echo esc_html($title); ?></span>
                        </span>
                    </div>
                </div>
                <?php } ?>
                <nav class="mt-addons-trail-slider-content__nav">
                    <button class="mt-addons-trail-slider-content__nav-button mt-addons-trail-slider-content__nav-button--prev"><?php echo esc_html($button__prev); ?></button>
                    <button class="mt-addons-trail-slider-content__nav-button mt-addons-trail-slider-content__nav-button--next"><?php echo esc_html($button__next); ?></button>
                </nav>
            </div>
<?php
}

    protected function content_template() {}
}

   