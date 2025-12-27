<?php
namespace Elementor;

class addons_motion_slider extends Widget_Base {
    public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-motion-slider', plugins_url( '../../../css/motion-slider.css' , __FILE__ ));
        
        return [
            'mt-addons-motion-slider',
        ];
    }

     public function get_script_depends() {
        wp_enqueue_script( 'imagesloaded', plugins_url( '../../../js/plugins/imagesloaded/imagesloaded.js' , __FILE__));
        wp_enqueue_script( 'TweenMax', plugins_url( '../../../js/plugins/TweenMax/TweenMax.js' , __FILE__));
        wp_enqueue_script( 'mt-addons-motion-slider', plugins_url( '../../../js/motion-slider.js' , __FILE__));

        return [ 'jquery', 'elementor-frontend', 'imagesloaded', 'TweenMax', 'motion-slider' ];
    }

    public function get_name()
    {
        return 'motion_slider';
    }

    public function get_title()
    {
        return esc_html__('MT - Motion slider', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-chevron-double-right';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'motion', 'slider', 'animation'];
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
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'content_img',
            [
                'label' => esc_html__( 'Slide Image', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
            'content_img_inner',
            [
                'label' => esc_html__( 'Inner Image', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control( 
            'list',
            [
                'label' => esc_html__('Slides', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                 'default' => [
                    [
                        'title' => esc_html__( 'TITLE 1', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '01', 'modeltheme-addons-for-wpbakery' ),
                        'paragraph' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec arcu arcu, bibendum eu lobortis non, vestibulum in magna. Phasellus nisi tortor, tincidunt vitae gravida non, efficitur quis nisi. Vestibulum fringilla mi nec luctus gravida. Vivamus feugiat orci vitae ullamcorper mollis. Donec eu eros lacinia, ullamcorper enim ut, sodales libero. Nam laoreet dignissim diam. Duis a est odio. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce tempor justo ac lectus ultricies, ut aliquet nisl ullamcorper. Donec eget tortor suscipit lorem posuere congue. Integer ut semper turpis. Donec sit amet dignissim enim. Donec blandit placerat vestibulum.', 'modeltheme-addons-for-wpbakery' ),
                        'subtitle' => esc_html__( 'SUBTITLE 1', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'title' => esc_html__( 'TITLE 2', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '02', 'modeltheme-addons-for-wpbakery' ),
                        'paragraph' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec arcu arcu, bibendum eu lobortis non, vestibulum in magna. Phasellus nisi tortor, tincidunt vitae gravida non, efficitur quis nisi. Vestibulum fringilla mi nec luctus gravida. Vivamus feugiat orci vitae ullamcorper mollis. Donec eu eros lacinia, ullamcorper enim ut, sodales libero. Nam laoreet dignissim diam. Duis a est odio. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce tempor justo ac lectus ultricies, ut aliquet nisl ullamcorper. Donec eget tortor suscipit lorem posuere congue. Integer ut semper turpis. Donec sit amet dignissim enim. Donec blandit placerat vestibulum.', 'modeltheme-addons-for-wpbakery' ),
                        'subtitle' => esc_html__( 'SUBTITLE 2', 'modeltheme-addons-for-wpbakery' ),
                    ],
                     [
                        'title' => esc_html__( 'TITLE 3', 'modeltheme-addons-for-wpbakery' ),
                        'number' => esc_html__( '03', 'modeltheme-addons-for-wpbakery' ),
                        'paragraph' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec arcu arcu, bibendum eu lobortis non, vestibulum in magna. Phasellus nisi tortor, tincidunt vitae gravida non, efficitur quis nisi. Vestibulum fringilla mi nec luctus gravida. Vivamus feugiat orci vitae ullamcorper mollis. Donec eu eros lacinia, ullamcorper enim ut, sodales libero. Nam laoreet dignissim diam. Duis a est odio. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce tempor justo ac lectus ultricies, ut aliquet nisl ullamcorper. Donec eget tortor suscipit lorem posuere congue. Integer ut semper turpis. Donec sit amet dignissim enim. Donec blandit placerat vestibulum.', 'modeltheme-addons-for-wpbakery' ),
                        'subtitle' => esc_html__( 'SUBTITLE 3', 'modeltheme-addons-for-wpbakery' ),
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
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mt-addons-motion-slider-slide__title',
            ]
        );
        $this->add_control(
            'title_color',
                [
                    'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-addons-motion-slider-slide__title' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__( 'Subtitle Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .mt-addons-motion-slider-preview__title',
            ]
        );
        $this->add_control(
            'subtitle_color',
                [
                    'label' => esc_html__( 'Subtitle Color', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-addons-motion-slider-preview__title' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->end_controls_section();
    }
    
   protected function render() {
        $settings = $this->get_settings_for_display();
        $list = $settings['list'];
        ?>
        <div class="mt-addons-motion-slider">
            <div class="mt-addons-motion-slider-loading mt-addons-motion-slider-slideshow">
                <?php if ($list) {
                    foreach ( $list as $item ) {
                        $title = $item['title'];
                        $subtitle = $item['subtitle'];
                        $paragraph = $item['paragraph'];
                        $number = $item['number'];
                        $content_img = $item['content_img']['url'];
                        $content_img_inner = $item['content_img_inner']['url'];
                        ?>   
                        <div class="mt-addons-motion-slider-slide">
                            <div class="mt-addons-motion-slider-preview">
                                <div class="mt-addons-motion-slider-preview__img-wrap">
                                    <img class="mt-addons-motion-slider-preview__img" src="<?php echo esc_url($content_img_inner); ?>" alt="<?php echo esc_attr($subtitle); ?>" />
                                    <div class="mt-addons-motion-slider-preview__img-reveal"></div>
                                </div>
                                <h3 class="mt-addons-motion-slider-preview__title"><?php echo esc_html($subtitle); ?></h3>
                                <div class="mt-addons-motion-slider-preview__content">
                                   <?php echo esc_html($paragraph); ?>
                                </div>
                            </div>
                            <div class="mt-addons-motion-slider-slide__img-wrap">
                                <img class="mt-addons-motion-slider-slide__img" src="<?php echo esc_url($content_img); ?>" alt="<?php echo esc_attr($title); ?>" />
                                <div class="mt-addons-motion-slider-slide__img-reveal"></div>
                            </div>
                            <span class="mt-addons-motion-slider-slide__number"><?php echo esc_html($number); ?></span>
                            <h3 class="mt-addons-motion-slider-slide__title"><?php echo esc_html($title); ?></h3>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <nav class="mt-addons-motion-slider-slidenav">
                    <button class="mt-addons-motion-slider-slidenav__item mt-addons-motion-slider-slidenav__item--prev"><?php echo esc_html__('Previous', 'modeltheme-addons-for-wpbakery'); ?></button>
                    <button class="mt-addons-motion-slider-slidenav__item mt-addons-motion-slider-slidenav__item--next"><?php echo esc_html__('Next', 'modeltheme-addons-for-wpbakery'); ?></button>
                    <button class="mt-addons-motion-slider-slidenav__preview">
                        <svg class="mt-addons-motion-slider-icon mt-addons-motion-slider-icon--caret">
                           <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330">
                                <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393
                                c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"/>
                            </svg>
                        </svg>
                    </button>
                </nav>
            </div>
        </div><?php
    }

    protected function content_template() {}
}
