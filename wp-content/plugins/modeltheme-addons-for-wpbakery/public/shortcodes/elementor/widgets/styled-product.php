<?php
namespace Elementor;

class addons_styled_product extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'styled-product', plugins_url( '../../../css/styled-product.css' , __FILE__ ));

        return [
            'styled-product',
        ];

    }

    public function get_name()
    {
        return 'styled-product';
    }

    public function get_title()
    {
        return esc_html__('MT - Styled Product', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'styled', 'product', 'shop', 'custom' ];
    }



    protected function register_controls()
    {
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Content', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => esc_html__( '2', 'modeltheme-addons-for-wpbakery' ),
                    '3' => esc_html__( '3', 'modeltheme-addons-for-wpbakery' ),
                    '4' => esc_html__( '4', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Layout', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__( 'Horizontal', 'modeltheme-addons-for-wpbakery' ),
                    'vertical' => esc_html__( 'Vertical', 'modeltheme-addons-for-wpbakery' ),
                    'simple' => esc_html__( 'Vertical Simple', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );



        $product_categories = array();
        if ( class_exists( 'WooCommerce' ) ) {
            $product_categories_tax = get_terms( 'product_cat', array(
                'parent'      => '0'
            ));
            if ($product_categories_tax) {
                foreach ( $product_categories_tax as $term ) {
                    $product_categories[$term->name] = $term->slug;
                }
            }
        }
        $this->add_control(
            'category',
            [
                'label' => __( 'Category', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'options' => $product_categories,
            ]
        );

        $this->add_control(
            'product_number',
            [
                'label' => esc_html__( 'Product Number', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'color_1',
            [
                'label' => esc_html__( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'color_2',
            [
                'label' => esc_html__( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'color_3',
            [
                'label' => esc_html__( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'color_4',
            [
                'label' => esc_html__( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $category = $settings['category'];
        $product_1 = $settings['color_1'];
        $product_2 = $settings['color_2'];
        $product_3 = $settings['color_3'];
        $product_4 = $settings['color_4'];
        $number_of_columns = $settings['columns'];
        $number_of_products_by_category = $settings['product_number'];
        $layout = $settings['layout'];

        $cat = get_term_by('slug', $category, 'product_cat');

        if (isset($number_of_columns)) {
            if ($number_of_columns == '' || $number_of_columns == '3') {
                $column_type = 'col-md-4';
            }elseif($number_of_columns == '4'){
                $column_type = 'col-md-3';
            }
        }else{
            $column_type = 'col-md-3';
        }

        if (isset($layout)) {
            if ($layout == '' || $layout == 'horizontal') {
                $block_type = 'products_category';
            }elseif($layout == 'vertical'){
                $block_type = 'products_category_vertical';
            }elseif($layout == 'simple'){
                $block_type = 'products_category_simple';
            }
        }else{
            $block_type = 'products_category';
        }

        $shortcode_content = '';
        $shortcode_content .= '<style>
                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(1) .products-wrapper{
                                background: '.$product_1.';
                            }
                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(2) .products-wrapper{
                                background: '.$product_2.';
                            }
                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(3) .products-wrapper{
                                background: '.$product_3.';
                            }
                            .woocommerce_simple_styled #categoryid_'.$cat->term_id.' .product:nth-child(4) .products-wrapper{
                                background: '.$product_4.';
                            }
                            </style>';
        $shortcode_content .= '<div class="woocommerce_simple_styled">';

        $shortcode_content .= '<div class="'.$block_type.'">';
        $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 mt-addons-products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';


        $shortcode_content .= '</div>';


        wp_reset_postdata();

        echo $shortcode_content;
    }

    protected function content_template() {}
}

