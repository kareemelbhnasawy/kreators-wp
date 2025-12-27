<?php
namespace Elementor;

class addons_contact_card extends Widget_Base {
    
    public function get_style_depends() {
        wp_enqueue_style( 'custom-card', plugins_url( '../../../css/contact-card.css' , __FILE__ ));
        return [
            'contact-card',
        ];
    }

    public function get_name()
    {
        return 'contact-card';
    }

    public function get_title()
    {
        return esc_html__('MT - Contact Card', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-menu-card';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'card', 'service', 'contact', 'custom' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Layout', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Layout', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'left'  => esc_html__( 'Left', 'modeltheme-addons-for-wpbakery' ),
                    'full' => esc_html__( 'Full', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $this->add_control(
            'text_on_line',
            [
                'label' => esc_html__( 'Text On line', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'padded1',
                'options' => [
                    'line'  => esc_html__( 'On Line', 'modeltheme-addons-for-wpbakery' ),
                    'padded1' => esc_html__( 'Padded 1', 'modeltheme-addons-for-wpbakery' ),
                    'padded2' => esc_html__( 'Padded 2', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'image_subtitle_section',
            [
                'label' => esc_html__( 'Image Card', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'full',
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
            'show_title',
            [
                'label' => esc_html__( 'Show Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show'  => esc_html__( 'Show', 'modeltheme-addons-for-wpbakery' ),
                    'hide' => esc_html__( 'Hide', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $repeater->add_control (
            'title', [
                'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control (
            'tag_select',
            [
                'label'=> esc_html__('Tag Select', 'modeltheme-addons-for-wpbakery'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __('Select', 'modeltheme-addons-for-wpbakery'),
                    'h1' => __('h1', 'modeltheme-addons-for-wpbakery'),
                    'h2' => __('h2', 'modeltheme-addons-for-wpbakery'),
                    'h3' => __('h3', 'modeltheme-addons-for-wpbakery'),
                    'h4' => __('h4', 'modeltheme-addons-for-wpbakery'),
                    'h5' => __('h5', 'modeltheme-addons-for-wpbakery'),
                    'h6' => __('h6', 'modeltheme-addons-for-wpbakery'),
                ],
                'default' => 'h1',
            ]
        );
        $repeater->add_control(
            'title_url',
            [
                'label' => esc_html__( 'Link', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'List Subtitle' , 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'subtitle_url',
            [
                'label' => esc_html__( 'Link', 'emodeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .mt-contact-card-list-text',
            ]
        );
        $repeater->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Subtitle Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-contact-card-list-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $repeater->add_control(
            'show_icon',
            [
                'label' => esc_html__( 'Show Icon', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show'  => esc_html__( 'Show', 'modeltheme-addons-for-wpbakery' ),
                    'hide' => esc_html__( 'Hide', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
                'type'  => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-contact-card-list-icon' => 'color: {{VALUE}}',
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
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'card_style',
            [
                'label' => esc_html__( 'Card Style', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'card_color',
            [
                'label' => esc_html__( 'Background', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .card-content',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title Style', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-contact-card-list-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .mt-contact-card-list-title',
            ]
        );
        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $layout = $settings['layout'];
        $list = $settings['list'];
        $text_on_line = $settings['text_on_line'];

        if ( ! empty( $settings['title_url']['url'] ) ) {
            $this->add_link_attributes( 'title_url', $settings['title_url'] );
        }

        if($layout == "left" || $layout == "") {
            $class_img = "col-md-4 col-sm-12";
            $class_txt = "col-md-8 col-sm-12";
        } else if ($layout == "full"){
            $class_img = "col-12";
            $class_txt = "col-12";
        }

        if($text_on_line == "line") {
            $class_padded = "p-0";
        } else if ($text_on_line == "padded1") {
            $class_padded = "p-1";
        } else if ($text_on_line == "padded2") {
            $class_padded = "p-2";
        }
        ?>

        <div class="container">
            <div class="card-content row">
                <div class="<?php echo $class_img; ?> thumb-img">
                    <div class="mt-contact-card-img-wrapper">
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                    </div>
                </div>
                <div class="<?php echo $class_txt; ?> <?php echo $class_padded; ?>">
                    <div class="mt-contact-card-list">
                        <ul class="mt-contact-card-list-group">
                            <?php foreach (  $list as $card ) {
                                $subtitle = $card['subtitle'];
                                $icon = $card['icon']['value'];
                                $icon_color = $card['icon_color'];
                                $subtitle_url = $card['subtitle_url'];
                                $show_title = $card['show_title'];
                                $title = $card['title'];
                                $tag_select = $card['tag_select'];
                                $show_icon = $card['show_icon'];

                                if($show_icon == "show" ||$show_icon == "") {
                                    $icon_visible = "d-inline-block";
                                }else if ($show_icon == "hide"){
                                    $icon_visible = "d-none";
                                }

                                if($show_title == "show" ||$show_title == "") {
                                    $title_visible = "d-block";
                                }else if ($show_icon == "hide"){
                                    $title_visible = "d-none";
                                }

                                if($subtitle_url){
                                    $subtitle_url = "href= '".esc_url($subtitle_url) ."' ";
                                } else {
                                    $subtitle_url = "";
                                }

                                ?>
                                <li class="mt-contact-card-card-list-item">
                                    <a class="<?php echo $title_visible; ?>" <?php echo $this->get_render_attribute_string( 'title_url' ); ?>>
                                        <<?php echo esc_attr($tag_select); ?> class="mt-contact-card-list-title">
                                        <?php echo $title; ?>
                                    </<?php echo esc_attr($tag_select); ?>>
                                    </a>
                                    <a <?php echo  $subtitle_url;?>>
                                        <i class="mt-contact-card-list-icon <?php echo $icon_visible; ?> <?php echo $icon; ?>" style="color: <?php echo $icon_color; ?>"aria-hidden="true"></i>
                                        <span class="mt-contact-card-list-text"><?php echo $subtitle; ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}
}