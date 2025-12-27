<?php
namespace Elementor;

class addons_crossroads_slider extends Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-crossroads-slider', plugins_url( '../../../css/crossroads-slider.css' , __FILE__ ));
        
        return [
            'mt-addons-crossroads-slider',
        ];
    }

     public function get_script_depends() {
        wp_enqueue_script( 'imagesloaded', plugins_url( '../../../js/plugins/imagesloaded/imagesloaded.js' , __FILE__));
        wp_enqueue_script( 'charming', plugins_url( '../../../js/plugins/charming/charming.js' , __FILE__));
        wp_enqueue_script( 'TweenMax', plugins_url( '../../../js/plugins/TweenMax/TweenMax.js' , __FILE__));
        wp_enqueue_script( 'mt-addons-crossroads-slider', plugins_url( '../../../js/crossroads-slider.js' , __FILE__));

        return [ 'jquery', 'elementor-frontend', 'imagesloaded', 'charming', 'TweenMax', 'crossroads-slider' ];
    }

    public function get_name()
    {
        return 'crossroads_slider';
    }

    public function get_title()
    {
        return esc_html__('MT - Crossroads slider', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-long-arrow-left';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'crossroads', 'slider', 'animation'];
    }

    protected function register_controls()
    {   

        $this->start_controls_section(
			'section_items',
			[
				'label' => __( 'List Area', 'modeltheme-addons-for-wpbakery' ),
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
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'number',
            [
                'label' => esc_html__('Number', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'paragraph',
            [
                'label' => esc_html__('Paragraph', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'button',
            [
                'label' => esc_html__('Button text', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::TEXT,
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
                        'title' => esc_html__( 'Title 01', 'modeltheme-addons-for-wpbakery' ),
                        'subtitle' => esc_html__( 'Subtitle 01', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '01', 'modeltheme-addons-for-wpbakery' ),
                        'paragraph' => esc_html__( 'Paragraph 01', 'modeltheme-addons-for-wpbakery' ),
                        'button' => esc_html__( 'Read More', 'modeltheme-addons-for-wpbakery' ),
                    ],
                   [
                        'title' => esc_html__( 'Title 02', 'modeltheme-addons-for-wpbakery' ),
                        'subtitle' => esc_html__( 'Subtitle 02', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '02', 'modeltheme-addons-for-wpbakery' ),
                        'paragraph' => esc_html__( 'Paragraph 02', 'modeltheme-addons-for-wpbakery' ),
                        'button' => esc_html__( 'Read More', 'modeltheme-addons-for-wpbakery' ),
                    ],
                    [
                        'title' => esc_html__( 'Title 03', 'modeltheme-addons-for-wpbakery' ),
                        'subtitle' => esc_html__( 'Subtitle 03', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '03', 'modeltheme-addons-for-wpbakery' ),
                        'paragraph' => esc_html__( 'Paragraph 03', 'modeltheme-addons-for-wpbakery' ),
                        'button' => esc_html__( 'Read More', 'modeltheme-addons-for-wpbakery' ),
                    ],
                    [
                        'title' => esc_html__( 'Title 04', 'modeltheme-addons-for-wpbakery' ),
                        'subtitle' => esc_html__( 'Subtitle 04', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '04', 'modeltheme-addons-for-wpbakery' ),
                        'paragraph' => esc_html__( 'Paragraph 04', 'modeltheme-addons-for-wpbakery' ),
                        'button' => esc_html__( 'Read More', 'modeltheme-addons-for-wpbakery' ),
                    ],
                ],
	        ]
	    );
		$this->end_controls_section();

        $this->start_controls_section(
            'section_products',
            [
                'label' => __( 'Product Area', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'subtitle_product',
            [
                'label' => esc_html__('Subtitle', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'number',
            [
                'label' => esc_html__('Number', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'content_img_product',
            [
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control( 
            'products',
            [
                'label' => esc_html__('List of products', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'subtitle_product' => esc_html__( 'Subtitle 01', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '01', 'modeltheme-addons-for-wpbakery' ),
                    ],
                   [
                        'subtitle_product' => esc_html__( 'Subtitle 01', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '02', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'subtitle_product' => esc_html__( 'Subtitle 01', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '03', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'subtitle_product' => esc_html__( 'Subtitle 01', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '04', 'modeltheme-addons-for-wpbakery' ),
                    ],
                ],
            ]
        );
        $this->end_controls_section();

          $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title Area', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title_product',
            [
                'label' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::TEXT,
                ],
        );
        $this->add_control( 
            'titles',
            [
                'label' => esc_html__('Title of products', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title_product' => esc_html__( 'TITLE 01', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'title_product' => esc_html__( 'TITLE 02', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'title_product' => esc_html__( 'TITLE 03', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'title_product' => esc_html__( 'TITLE 03', 'modeltheme-addons-for-wpbakery' ),
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
                'selector' => '{{WRAPPER}} .mt-addons-crossroads-slider-grid__item--title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-crossroads-slider-grid__item--title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'title_style_inner',
            [
                'label' => esc_html__( 'Inner Title Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_inner',
                'selector' => '{{WRAPPER}} .mt-addons-crossroads-slider-content__item-header-title',
            ]
        );
        $this->add_control(
            'title_color_inner',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-crossroads-slider-content__item-header-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_style_bottom',
            [
                'label' => esc_html__( 'Bottom Title Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography_bottom',
                'selector' => '{{WRAPPER}} .mt-addons-crossroads-slider-caption',
            ]
        );
        $this->add_control(
            'title_color_bottom',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-crossroads-slider-caption' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

    }
   protected function render() {
        $settings = $this->get_settings_for_display();
        $list = $settings['list'];
        $products = $settings['products'];
        $titles = $settings['titles'];
        ?>
        <div class="mt-addons-crossroads-slider">
            <div class="mt-addons-crossroads-slider-inner mt-addons-crossroads-slider-loading">
                <div class="mt-addons-crossroads-slider-content">
                    <?php foreach ( $list as $item ) {
                    $title = $item['title'];
                    $subtitle = $item['subtitle'];
                    $paragraph = $item['paragraph'];
                    $button = $item['button'];
                    $content_img = $item['content_img']['url'];
                    ?>   
                    <article class="mt-addons-crossroads-slider-content__item">
                        <div class="mt-addons-crossroads-slider-img-wrap mt-addons-crossroads-slider-img-wrap--content">
                            <img class="mt-addons-crossroads-slider-img mt-addons-crossroads-slider-img--content" src="<?php echo esc_url($content_img); ?>" alt="<?php echo esc_url($content_img); ?>" />
                        </div>
                        <header class="mt-addons-crossroads-slider-content__item-header">
                            <span class="mt-addons-crossroads-slider-content__item-header-meta"><?php echo esc_html($subtitle); ?></span>
                            <h2 class="mt-addons-crossroads-slider-content__item-header-title"><?php echo esc_html($title); ?></h2>
                        </header>
                        <div class="mt-addons-crossroads-slider-content__item-copy">
                            <p class="mt-addons-crossroads-slider-content__item-copy-text">
                             <?php echo esc_html($paragraph); ?>
                            </p>
                            <a href="#" class="mt-addons-crossroads-slider-content__item-copy-more"> <?php echo esc_html($button); ?></a>
                        </div>
                    </article>
                    <?php } ?>
                </div>
                <div class="mt-addons-crossroads-slider-revealer">
                    <div class="mt-addons-crossroads-slider-revealer__inner"></div>
                </div>
                <div class="mt-addons-crossroads-slider-grid mt-addons-crossroads-slider-grid--slideshow">
                    <?php foreach ( $products as $seconditem ) {
                    $number = $seconditem['number'];
                    $subtitle_product = $seconditem['subtitle_product'];
                    $content_img_product = $seconditem['content_img_product']['url'];
                    ?>   
                    <figure class="mt-addons-crossroads-slider-grid__item mt-addons-crossroads-slider-grid__item--slide">
                        <span class="mt-addons-crossroads-slider-number"><?php echo esc_html($number); ?></span>
                        <div class="mt-addons-crossroads-slider-img-wrap">
                            <div class="mt-addons-crossroads-slider-img"><img src="<?php echo esc_url($content_img_product); ?>" alt="<?php echo esc_url($content_img_product); ?>" /></div>
                        </div>
                        <figcaption class="mt-addons-crossroads-slider-caption"><?php echo esc_html($subtitle_product); ?></figcaption>
                    </figure>
                    <?php } ?>
                    <div class="mt-addons-crossroads-slider-titles-wrap">
                        <div class="mt-addons-crossroads-slider-grid mt-addons-crossroads-slider-grid--titles">
                            <?php foreach ( $titles as $thirditem ) {
                            $title_product = $thirditem['title_product'];
                            ?>   
                                <h3 class="mt-addons-crossroads-slider-grid__item mt-addons-crossroads-slider-grid__item--title">
                                    <?php echo esc_html($title_product); ?>
                                </h3>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="mt-addons-crossroads-slider-grid mt-addons-crossroads-slider-grid--interaction">
                        <div class="mt-addons-crossroads-slider-grid__item mt-addons-crossroads-slider-grid__item--cursor mt-addons-crossroads-slider-grid__item--left"></div>
                        <div class="mt-addons-crossroads-slider-grid__item mt-addons-crossroads-slider-grid__item--cursor mt-addons-crossroads-slider-grid__item--center"></div>
                        <div class="mt-addons-crossroads-slider-grid__item mt-addons-crossroads-slider-grid__item--cursor mt-addons-crossroads-slider-grid__item--right"></div>
                    </div>
                </div>
            </div>
        </div>
<?php
}

    protected function content_template() {}
}

   