<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_buddypress_groups extends Widget_Base {
   public function get_style_depends() {

         wp_enqueue_style( 'buddypress-groups', plugins_url( '../../../css/buddypress-groups.css' , __FILE__ ));
         wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));

    return [
        'buddypress-groups',
        'swiper-bundle',
    ];

    }
    use ContentControlSlider;

    public function get_script_depends() {
        
        wp_register_script( 'swiper', plugins_url( '../../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
        wp_register_script( 'hero-slider', plugins_url( '../../../js/swiper.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'swiper', 'hero-slider'];
    }
    
    public function get_name()
    {
        return 'buddypress-groups';
    }

    public function get_title()
    {
        return esc_html__('MT - BuddyPress Groups', 'modeltheme-addons-for-wpbakery');
    }
   
    public function get_icon() {
        return 'eicon-menu-card';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'BuddyPress', 'custom' ];
    }

    protected function register_controls() {
        $this->content_section();
        $this->section_slider_hero_settings();
    }

    private function content_section() {


        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'group_default',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Default members to show:', 'modeltheme-addons-for-wpbakery' ),
                'options' => [
                    'default' => esc_html__( 'Default', 'modeltheme-addons-for-wpbakery' ),
                    'newest' => esc_html__( 'newest', 'modeltheme-addons-for-wpbakery' ),
                    'active' => esc_html__( 'active', 'modeltheme-addons-for-wpbakery' ),
                    'popular' => esc_html__( 'popular', 'modeltheme-addons-for-wpbakery' ),
                    'alphabetical' => esc_html__( 'alphabetical', 'modeltheme-addons-for-wpbakery' ),
                ],
                'default' => 'no',
            ]
        );
        $this->add_control(
            'max_groups', 
            [
                'label' => esc_html__( "Number of Groups", 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__( 'Style Title', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mt-addons-buddypress-groups-item-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-addons-buddypress-groups-item-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_hover',
            [
                'label' => esc_html__( 'Hover - Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-addons-buddypress-groups-item-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
         $this->start_controls_section(
            'style_button',
            [
                'label' => esc_html__( 'Style Button', 'modeltheme-addons-for-wpbakery' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_padding_border',
                'label'    => esc_html__( 'Border', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-buddypress-groups-button a',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_padding_box_shadow',
                'selector' => '{{WRAPPER}} .mt-addons-buddypress-groups-button a',
            ]
        );
        $this->add_responsive_control(
            'button_border',
            [
                'label'      => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mt-addons-buddypress-groups-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Button Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-addons-buddypress-groups-button a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Button Color - Hover', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-addons-buddypress-groups-button a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__( 'Background Button Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-addons-buddypress-groups-button a' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_bg_hover_color',
            [
                'label' => esc_html__( 'Background Button Color - Hover', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .mt-addons-buddypress-groups-button a:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label'      => esc_html__( 'Button Padding', 'modeltheme-addons-for-wpbakery' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .mt-addons-buddypress-groups-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings                   = $this->get_settings_for_display();
        $group_default          = $settings['group_default'];
        $max_groups             = $settings['max_groups'];
        //carousel
        $autoplay                   = $settings['autoplay'];
        $delay                      = $settings['delay'];
        $items_desktop              = $settings['items_desktop'];
        $items_mobile               = $settings['items_mobile'];
        $items_tablet               = $settings['items_tablet'];
        $space_items                = $settings['space_items'];
        $touch_move                 = $settings['touch_move'];
        $effect                     = $settings['effect'];
        $grab_cursor                = $settings['grab_cursor'];
        $infinite_loop              = $settings['infinite_loop'];
        $columns                    = $settings['columns'];
        $layout                     = $settings['layout'];
        $centered_slides            = $settings['centered_slides'];
        $navigation_position        = $settings['navigation_position'];
        $nav_style                  = $settings['nav_style'];
        $navigation_color           = $settings['navigation_color'];
        $navigation_bg_color        = $settings['navigation_bg_color'];
        $navigation_bg_color_hover  = $settings['navigation_bg_color_hover'];
        $navigation_color_hover     = $settings['navigation_color_hover'];
        $pagination_color           = $settings['pagination_color'];
        $navigation                 = $settings['navigation'];
        $pagination                 = $settings['pagination'];
        // end carousel

        $group_args = array(
            // 'group_id'         => $group_id,
            'type'            => $settings['group_default'],
            'per_page'        => $max_groups,
            'max'             => $max_groups,
        );

       $id = 'mt-addons-swiper-'.uniqid();
        $carousel_item_class = $columns;
        $carousel_holder_class = '';
        $swiper_wrapped_start = '';
        $swiper_wrapped_end = '';
        $swiper_container_start = '';
        $swiper_container_end = '';
        $html_post_swiper_wrapper = '';

        if ($layout == "carousel" or $layout == ""){

            $carousel_holder_class = 'mt-addons-swipper swiper';
            $carousel_item_class = 'swiper-slide';

            $swiper_wrapped_start = '<div class="swiper-wrapper">';
            $swiper_wrapped_end = '</div>';

            $swiper_container_start = '<div class="mt-addons-swiper-container">';
            $swiper_container_end = '</div>';
            if($navigation == "yes") {
              // next/prev
              $html_post_swiper_wrapper .= '
              <i class="fas fa-arrow-left swiper-button-prev '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>
              <i class="fas fa-arrow-right swiper-button-next '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>';
            }
            if ($pagination == "yes") {
              // next/prev
              $html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
            }
        } 
        ?>

    <?php //swiper container start ?>
    <?php echo wp_kses_post($swiper_container_start); ?>
    <div class="mt-swipper-carusel-position" style="position:relative;">
        <div id="<?php echo esc_attr($id); ?>" 
            <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?>
            class="mt-addons-buddypress-groups-carusel row <?php echo esc_attr($carousel_holder_class); ?>">
            <?php //swiper wrapped start ?>
            <?php echo wp_kses_post($swiper_wrapped_start); ?>
                <?php if ( function_exists('bp_is_active') ) { ?>
                    <?php if( bp_is_active('groups') )  { ?>
                        <?php if ( bp_has_groups( $group_args ) ) : ?>
                                <?php while ( bp_groups() ) : bp_the_group(); ?>

                                <div class="mt-addons-buddypress-groups-vcard <?php echo esc_attr($carousel_item_class); ?>">
                                    <?php // Get the Cover Image
                                        $group_cover_image_url = bp_attachments_get_attachment('url', array(
                                          'object_dir' => 'groups',
                                          'item_id' => bp_get_group_id(),
                                        ));
                                    ?>
                                    <img src="<?php echo $group_cover_image_url; ?> " alt='mt-addons-buddypress-groups-img'>
                                    <div class="mt-addons-buddypress-groups-item">
                                         <div class="mt-addons-buddypress-groups-item-avatar">
                                            <a class="mt-addons-buddypress-groups-item-img" href="<?php bp_group_permalink() ?>"><?php bp_group_avatar() ?></a>
                                        </div> 
                                        <div class="mt-addons-buddypress-groups-item-title"><?php bp_group_link(); ?></div>
                                        
                                        <div class="mt-addons-buddypress-groups-item-meta">
                                        <div class="mt-addons-buddypress-groups-activity"> <?php echo esc_html__('Activity','modeltheme-addons-for-wpbakery'); ?><span class="mt-addons-buddypress-groups-activity">
                                            <?php
                                                if ($settings['group_default'] = "newest") {
                                                    printf( bp_get_group_last_active() );
                                                } elseif ( $settings['group_default'] = "popular"  ) {
                                                    bp_group_member_count();
                                                } else {
                                                    printf( bp_get_group_last_active() );
                                                }
                                            ?>
                                            </span></div>
                                            <?php 
                                            // $group_id ='';
                                            $members_count = groups_get_total_member_count( $group_id ); ?>
                                            <div class="mt-addons-buddypress-groups-separator"></div>

                                            <div class="mt-addons-buddypress-groups-count">
                                                <?php echo esc_html__('Members','modeltheme-addons-for-wpbakery'); ?>
                                                <span class="mt-addons-buddypress-groups-data-item mt-addons-buddypress-groups-data-members"><?php echo sprintf( _n( '%s Member', '%s Members', $members_count, 'modeltheme-addons-for-wpbakery' ), bp_core_number_format( $members_count ) ); ?>
                                                </span>
                                            </div>
                                            <div class="mt-addons-buddypress-groups-button">
                                                <a href="<?php bp_group_permalink(); ?>"><?php echo esc_html__('View More','modeltheme-addons-for-wpbakery'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="mt-addons-buddypress-groups-widget-error">
                                <?php _e('There are no groups to display.', 'modeltheme-addons-for-wpbakery') ?>
                            </div>
                        <?php endif; 
                        ?>
                    <?php } ?>
               <?php } ?>

               <?php //swiper wrapped end ?>
              <?php echo wp_kses_post($swiper_wrapped_end); ?>
            <?php //pagination/navigation ?>
            <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
        </div>
    </div>
    <?php //swiper container end ?>
    <?php echo wp_kses_post($swiper_container_end); ?>

<!--     <style type="text/css" media="screen">
      .swiper-button-prev:hover,
      .swiper-button-next:hover {
        background: <?php echo esc_attr($navigation_bg_color_hover);?>!important;
        color: <?php echo esc_attr($navigation_color_hover); ?>!important;
        opacity: 1;
      }
      .swiper-pagination-bullet {
        background: <?php echo esc_attr($pagination_color);?>!important;
      }
    </style> -->


    <?php
    }

    protected function content_template() {}

}
