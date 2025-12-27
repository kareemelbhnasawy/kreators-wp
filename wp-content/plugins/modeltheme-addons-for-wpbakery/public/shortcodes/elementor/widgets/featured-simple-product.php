<?php
namespace Elementor;

class addons_featured_simple_product extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'featured-simple-product', plugins_url( '../../../css/featured-simple-product.css' , __FILE__ ));

        return [
            'featured-simple-product',
        ];

    }

    public function get_name()
    {
        return 'featured-simple-product';
    }

    public function get_title()
    {
        return esc_html__('MT - Featured Simple Product', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'featured', 'simple', 'product', 'custom' ];
    }



    protected function register_controls()
    {
        $this->start_controls_section(
            'section_product',
            [
                'label' => esc_html__('Product', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'select-product',
            [
                'label' => __( 'Write Product ID', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '4450',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show-title',
            [
                'label' => esc_html__( 'Show Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'modeltheme-addons-for-wpbakery' ),
                'label_off' => esc_html__( 'Hide', 'modeltheme-addons-for-wpbakery' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'main-title',
            [
                'label' => __( 'Main Title', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Title',
                'condition' => [
                    'show-title' => 'yes',
                ]
            ],
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__('Button', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'button-title',
            [
                'label' => __( 'Button Title', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Button',
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

        $this->end_controls_section();
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Style Section', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border-color',
            [
                'label' => esc_html__( 'Border Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'featured_title_color',
            [
                'label' => esc_html__( 'Featured Title Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured_product_title h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show-title' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'product_title_color',
            [
                'label' => esc_html__( 'Product Title Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured_product_name a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $border_color = $settings['border-color'];
        $select_product = $settings['select-product'];
        $main_title = $settings['main-title'];
        $button_link = $settings['button_link']['url'];
        $button_text = $settings['button-title'];
        $show_title = $settings['show-title'];

        $html = '';
        $html .= '<div style="border:2px solid '.$border_color.'" class="mt-addons-featured_product_shortcode simple col-md-12 wow">';

        global  $product;
        $product = wc_get_product($select_product);
        $content = $product->get_description();
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        if ($button_text) {
            $button_text_value = $button_text;
        }else{
            $button_text_value = esc_html__('Select Options', 'modeltheme');
        }

        if($show_title == 'yes') {
            $html .= '<div class="mt-addons-featured_product_title">';
            $html .= '<h2>'.$main_title.'</h2>';
            $html.='</div>';
        } else {
            $html .= '';
        }

        $html .= '<div class="mt-addons-featured_product_image_holder">';
        if ( has_post_thumbnail( $select_product ) ) {
            $attachment_ids[0] = get_post_thumbnail_id( $select_product );
            $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );
            $html.='<img class="mt-addons-featured_product_image" src="'.$attachment[0].'" alt="'.get_the_title($select_product).'" />';
        }
        $html .= '</div>';
        $html .= '<div class="mt-addons-featured_product_details_holder">';
        $html.='<h3 class="mt-addons-featured_product_name">
                            <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>
                        </h3>';

        $html.='<h3 class="mt-addons-featured_product_price">'.$product->get_price_html().'</h3>';

        $html.='<div class="mt-addons-featured_product_description">'.modeltheme_addons_excerpt_limit($content,15).'</div>';

        $html.='</div>';
        $html .= '</div>';
        $html .= '<div class="mt-addons-featured_product_button col-md-12">';
            $html .= '<a href="'.$button_link.'">'.$button_text_value.'</a>';
        $html .= '</div>';

        echo $html;
    }

    protected function content_template() {}
}

