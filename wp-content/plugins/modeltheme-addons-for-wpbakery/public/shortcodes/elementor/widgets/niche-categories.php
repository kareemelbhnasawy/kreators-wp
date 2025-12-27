<?php
namespace Elementor;

class addons_niche_categories extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'niche_categories', plugins_url( '../../../css/niche-categories.css' , __FILE__ ));

        return [
            'niche_categories',
        ];

    }

    public function get_name()
    {
        return 'niche_categories';
    }

    public function get_title()
    {
        return esc_html__('MT - Niche categories', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-circle';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'niche', 'categories', 'category', 'spotify' ];
    }


    protected function register_controls()
        {
            $this->start_controls_section(
                'columns_section',
                [
                    'label' => esc_html__( 'Layout of cards', 'modeltheme-addons-for-wpbakery' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'columns',
                [
                    'label' => esc_html__( 'Nr. Of Columns', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '' => esc_html__( 'Default', 'modeltheme-addons-for-wpbakery' ),
                        'col-12 col-sm-12 col-md-12 col-lg-12' => esc_html__( '1', 'modeltheme-addons-for-wpbakery' ),
                        'col-6 col-sm-6 col-md-6 col-lg-6'  => esc_html__( '2', 'modeltheme-addons-for-wpbakery' ),
                        'col-4 col-sm-4 col-md-4 col-lg-4' => esc_html__( '3', 'modeltheme-addons-for-wpbakery' ),
                        'col-3 col-sm-3 col-md-3 col-lg-3' => esc_html__( '4', 'modeltheme-addons-for-wpbakery' ),
                        'col-2 col-sm-2 col-md-2 col-lg-2' => esc_html__( '6', 'modeltheme-addons-for-wpbakery' )
                    ],
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'repeater_section',
                [
                    'label' => esc_html__( 'List', 'modeltheme-addons-for-wpbakery' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'image_section',
                [
                    'label' => esc_html__( 'Choose Image', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $repeater->add_control(
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
            $repeater->add_control(
                'main_title',
                [
                    'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                ]
            );

            $repeater->add_control(
                'card_color',
                [
                    'label' => esc_html__( 'Background Card', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                ]
            );

            $repeater->add_control(
                'card_color_hover',
                [
                    'label' => esc_html__( 'Background Card (Hover)', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                ]
            );

            $repeater->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .mt-addons-niche-categories-card-title',
                ]
            );
            $repeater->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-addons-niche-categories-card-title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'list',
                [
                    'label' => __( 'List Items', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [],
                    'title_field' => '',
                    'default' => [
                    [
                        'main_title' => esc_html__( 'Podcasts', 'modeltheme-addons-for-wpbakery' ),
                        'card_color' => esc_html__( '#1FDF64', 'modeltheme-addons-for-wpbakery' ),
                    ],
                ],
                ]
            );
            $this->end_controls_section();

            $this->start_controls_section(
                'section_image',
                [
                    'label' => esc_html__( 'Image options', 'modeltheme-addons-for-wpbakery' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'image_size',
                [
                    'label' => esc_html__( 'Image size', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( '80', 'modeltheme-addons-for-wpbakery' ),
                ]
            );
            $this->add_control(
                'image_bottom',
                [
                    'label' => esc_html__( 'Image bottom', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( '-20', 'modeltheme-addons-for-wpbakery' ),
                ]
            );
            $this->add_control(
                'image_right',
                [
                    'label' => esc_html__( 'Image right', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( '-5', 'modeltheme-addons-for-wpbakery' ),
                ]
            );
            $this->end_controls_section();

            $this->start_controls_section(
                'section_card',
                [
                    'label' => esc_html__( 'Card styling', 'modeltheme-addons-for-wpbakery' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_control(
                'padding_card',
                [
                    'label' => esc_html__( 'Padding card', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-addons-niche-categories-card-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'border-radius',
                [
                    'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-addons-niche-categories-card-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'padding_title',
                [
                    'label' => esc_html__( 'Padding Title', 'modeltheme-addons-for-wpbakery' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-addons-niche-categories-card-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section();
        }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $list = $settings['list'];
        $image_size = $settings['image_size'];
        $image_bottom = $settings['image_bottom'];
        $image_right = $settings['image_right'];
        $columns = $settings['columns'];


        ?>

        <div class="mt-addons-niche-categories-gallery_columns row">
            <?php foreach (  $list as $item ) {
                $main_title = $item['main_title'];
                $card_link = $item['card_link']['url'];
                $card_color = $item['card_color'];
                $card_color_hover = $item['card_color_hover'];
                $attachment_id = $item['image_section']['id']; 
                $img_atts = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
                $id = uniqid('mt-addons-niche-categories-');
                if( is_array($img_atts) ) {
                    $image_url = $img_atts[0];
                }
                 if ( ! empty( $item['card_link']['url'] ) ) {
                    $this->add_link_attributes( 'card_link', $item['card_link'] );
                }
                ?>

                <?php if($card_color_hover){ ?>
                    <style type="text/css">
                        <?php echo esc_html('#'.$id); ?>:hover > div{
                            background: <?php echo esc_attr($card_color_hover); ?> !important;
                        }
                    </style>
                <?php } ?>

                <a id="<?php echo esc_attr($id); ?>" href="<?php echo esc_url($card_link); ?>" class="<?php echo esc_attr($columns); ?>">
                    <div class="mt-addons-niche-categories-card-container"  style="background: <?php echo esc_attr($card_color); ?> ">
                        <div class="mt-addons-niche-categories-card-title">
                            <?php echo esc_html($main_title); ?>
                        </div>
                        <div class="mt-addons-niche-categories-image-section"
                            style="width: <?php echo esc_attr($image_size); ?>px; bottom: <?php echo esc_attr($image_bottom); ?>%; right: <?php echo esc_attr($image_right); ?>%">
                            <div class="mt-addons-niche-categories-card-img-wrapper">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($main_title); ?>" />
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <?php
    }

    protected function content_template() {}
}