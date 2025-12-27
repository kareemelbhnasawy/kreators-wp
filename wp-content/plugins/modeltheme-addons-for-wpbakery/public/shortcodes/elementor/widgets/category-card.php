<?php
namespace Elementor;

class addons_category_card extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'category-card', plugins_url( '../../../css/category-card.css' , __FILE__ ));

        return [
            'category-card',
        ];

    }

    public function get_name()
    {
        return 'category-card';
    }

    public function get_title()
    {
        return esc_html__('MT - Category Card', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-product-categories';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'category', 'card', 'highlight', 'custom' ];
    }



    protected function register_controls()
    {
        $this->start_controls_section(
            'category_info',
            [
                'label' => esc_html__('Category Info', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'category_name',
            [
                'label' => esc_html__( 'Category', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $this->add_control(
            'products_number',
            [
                'label' => esc_html__( 'No. Of Products', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100000,
                'step' => 1,
                'default' => 10,
            ]
        );
        $this->add_control(
            'card_link',
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
        $this->end_controls_section();
        $this->start_controls_section(
            'section_bg_style',
            [
                'label' => esc_html__('Background Style', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .mt-card-content',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_text_style',
            [
                'label' => esc_html__('Text Color', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'subtitle_color',
                [
                'label' => esc_html__( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cat-count' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_text_content',
            [
                'label' => esc_html__('Text Background', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_background',
            [
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category_overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $card_link = $settings['card_link']['url'];
        $category_name = $settings['category_name'];
        $products_number = $settings['products_number'];

        if ( ! empty( $settings['button_link']['url'] ) ) {
            $this->add_link_attributes( 'button_link', $settings['button_link'] );
        }

        ?>
                <div class="mt-card-content">
                    <a class="mt-product-link" href="<?php echo $card_link; ?>">
                        <span class="category_overlay">
                            <span class="cat-name"><?php echo $category_name; ?></span>
                            <span class="cat-count">
                                <strong>
                                    <?php echo $products_number; ?>
                                </strong>
                                Items Available
                            </span>
                        </span>
                    </a>
                </div>
        <?php
    }

    protected function content_template() {}
}

