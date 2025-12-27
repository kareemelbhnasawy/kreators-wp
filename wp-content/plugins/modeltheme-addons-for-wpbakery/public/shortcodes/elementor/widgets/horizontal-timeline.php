<?php
namespace Elementor;

class addons_horizontal_timeline extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'horizontal-timeline', plugins_url( '../../../css/horizontal-timeline.css' , __FILE__ ));
        wp_enqueue_style( 'fontawesome', plugins_url( '../../../css/plugins/font-awesome/all.min.css' , __FILE__ ));

        return [
            'horizontal-timeline',
            'fontawesome',
        ];
    }

    public function get_script_depends() {

        wp_enqueue_script( 'util', plugins_url( '../../../js/plugins/horizontal-timeline/util.js' , __FILE__));
        wp_enqueue_script( 'swipe-content', plugins_url( '../../../js/plugins/horizontal-timeline/swipe-content.js' , __FILE__));
        wp_enqueue_script( 'horizontal-timeline', plugins_url( '../../../js/plugins/horizontal-timeline/horizontal-timeline.js' , __FILE__));

        return [
            'util',
            'swipe-content',
            'horizontal-timeline',
        ];
    }


    public function get_name()
    {
        return 'horizontal-timeline';
    }

    public function get_title()
    {
        return esc_html__('MT - Horizontal Timeline', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'timeline', 'horizontal', 'custom' ];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Text Section', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater1 = new \Elementor\Repeater();
        $repeater2 = new \Elementor\Repeater();

        $repeater1->add_control(
            'first_date',
            [
                'label' => esc_html__( 'First Date', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'modeltheme-addons-for-wpbakery' ),
                'label_off' => esc_html__( 'No', 'modeltheme-addons-for-wpbakery' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater1->add_control(
            'date', [
                'label' => esc_html__( 'Date', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '14/08/2022' , 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'dd/mm/yyyy', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        );
        $repeater1->add_control(
            'date_title', [
                'label' => esc_html__( 'Date Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Date Title' , 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list1',
            [
                'label' => __( 'Date Items', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater1->get_controls(),
                'default' => [],
                'title_field' => '',
            ]
        );
        $repeater2->add_control(
            'timeline_title',
            [
                'label' => esc_html__( 'Title', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Default title', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your title here', 'modeltheme-addons-for-wpbakery' ),
            ]
        );

        $repeater2->add_control(
            'timeline_description',
            [
                'label' => esc_html__( 'Description', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => esc_html__( 'Default description', 'modeltheme-addons-for-wpbakery' ),
                'placeholder' => esc_html__( 'Type your description here', 'modeltheme-addons-for-wpbakery' ),
            ]
        );

        $this->add_control(
            'list2',
            [
                'label' => __( 'Description Items', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater2->get_controls(),
                'default' => [],
                'title_field' => '',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Timeline Style', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_align',
            [
                'label' => esc_html__( 'Title Aligment', 'modeltheme-addons-for-wpbakery' ),
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .your-class' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'description_align',
            [
                'label' => esc_html__( 'Subtitle Aligment', 'modeltheme-addons-for-wpbakery' ),
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .your-class' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-timeline__event-description',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__( 'Description Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-timeline__event-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Date Title Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'date_title_typography',
                'selector' => '{{WRAPPER}} .mt-timeline__date',
            ]
        );
        $this->add_control(
            'timeline_color',
            [
                'label' => esc_html__( 'Timeline Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-timeline__date::after' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}}  .mt-timeline__date--selected::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}}  .mt-timeline__filling-line' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}}  .mt-timeline__date:hover::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}}  .mt-timeline__date--selected' => 'color: {{VALUE}}',
                    '{{WRAPPER}}  .mt-timeline__navigation:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .text-replace' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-timeline__event-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-timeline__event-description' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $title_align = $settings['title_align'];
        $description_align = $settings['description_align'];
        $list1 = $settings['list1'];
        $list2 = $settings['list2'];
        ?>
        <section class="mt-timeline js-mt-timeline margin-bottom-md">
            <div class="mt-timeline__container container">
                <ul>
                    <li><a href="#0" class="text-replace mt-timeline__navigation mt-timeline__navigation--prev mt-timeline__navigation--inactive"><i class="fas fa-arrow-right"></i></a></li>
                    <li><a href="#0" class="text-replace mt-timeline__navigation mt-timeline__navigation--next"><i class="fas fa-arrow-right"></i></a></li>
                </ul>
                <div class="mt-timeline__dates">
                    <div class="mt-timeline__line">
                        <ol>
                            <?php foreach ($list1 as $newdate) {
                                $date = $newdate['date'];
                                $date_title = $newdate['date_title'];
                                $first_date = $newdate['first_date'];

                                if($first_date) {
                                    $date_selected = 'mt-timeline__date--selected';
                                } else {
                                    $date_selected = '';
                                }
                                ?>
                                <li>
                                    <a href="#0" data-date="<?php echo $date; ?>" class="mt-timeline__date <?php echo $date_selected;?>"><?php echo $date_title; ?></a>
                                </li>
                            <?php } ?>
                        </ol>
                        <span class="mt-timeline__filling-line" aria-hidden="true"></span>
                    </div> <!-- .mt-timeline__line -->
                </div> <!-- .mt-timeline__dates -->
            </div> <!-- .mt-timeline__container -->

            <div class="mt-timeline__events">
                <ol>
                    <?php foreach ($list2 as $newdescription) {
                        $title = $newdescription['timeline_title'];
                        $description = $newdescription['timeline_description'];
                        ?>
                        <li class="mt-timeline__event text-component">
                            <div class="mt-timeline__event-content container">
                                <h2 class="mt-timeline__event-title" style="text-align: <?php echo $title_align?>"><?php echo $title; ?></h2>
                                <p class="mt-timeline__event-description color-contrast-medium" style="text-align: <?php echo $description_align?>">
                                    <?php echo $description; ?>
                                </p>
                            </div>
                        </li>
                    <?php } ?>
                </ol>
            </div> <!-- .mt-timeline__events -->
        </section>

        <?php
    }

    protected function content_template() {}
}