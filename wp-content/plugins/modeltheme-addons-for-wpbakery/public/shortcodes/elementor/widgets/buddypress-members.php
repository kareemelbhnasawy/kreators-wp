<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlSlider;

class addons_buddypress_members extends Widget_Base {
        public function get_style_depends() {

            wp_enqueue_style( 'buddypress-members', plugins_url( '../../../css/buddypress-members.css' , __FILE__ ));
            wp_enqueue_style( 'swiper-bundle', plugins_url( '../../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));

        return [
            'buddypress-members',
            'swiper-bundle',
        ];

    }
    use ContentControlSlider;

    public function get_script_depends() {
        
        wp_register_script( 'swiper', plugins_url( '../../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
        wp_register_script( 'hero-slider', plugins_url( '../../../js/swiper.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'swiper', 'hero-slider' ];
    }
    
    public function get_name()
    {
        return 'buddypress-members';
    }

    public function get_title() 
    {
        return esc_html__('MT - BuddyPress Members', 'modeltheme-addons-for-wpbakery');
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
            'member_default',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Default members to show:', 'modeltheme-addons-for-wpbakery' ),
                'options' => [
                    'default' => esc_html__( 'Default', 'modeltheme-addons-for-wpbakery' ),
                    'newest' => esc_html__( 'newest', 'modeltheme-addons-for-wpbakery' ),
                    'active' => esc_html__( 'active', 'modeltheme-addons-for-wpbakery' ),
                    'popular' => esc_html__( 'popular', 'modeltheme-addons-for-wpbakery' ),
                ],
                'default' => 'no',
            ]
        );
        $this->add_control(
            'max_members', 
            [
                'label' => esc_html__( "Number of Members", 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings                   = $this->get_settings_for_display();
        $member_default          = $settings['member_default'];
        $max_members             = $settings['max_members'];
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

   $members_args = array(
            'user_id'         => $user_id,
            'object'   => 'members',
            'type'            => $settings['member_default'],
            'per_page'        => $max_members,
            'max'             => $max_members,
            'populate_extras' => true,
            'search_terms'    => false,
        );
   $args= $members_args;
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
    function mt_buddypress_is_user_online( $user_id = null ) {

        $is_online = false;
        // Get User ID.
        $user_id = ! empty( $user_id ) ? $user_id : bp_displayed_user_id();

        // Get User Last Activity.
        $last_user_activity = bp_get_user_last_activity( $user_id );

        // Check if the last activity is exist.
        if ( ! empty( $last_user_activity ) ) {

            // Calculate some times.
            $current_time  = bp_core_current_time( true, 'timestamp' );
            $last_activity = strtotime( $last_user_activity );
            $still_online  = strtotime( '+5 minutes', $last_activity );

            // Has the user been active recently ?
            if ( $current_time <= $still_online ) {
                $is_online = true;
            }

        }

        return apply_filters( 'mt_buddypress_is_user_online', $is_online, $user_id );

    }
    function mt_addons_add_user_online_status_icon( $username = null, $user_id = null ) {
        if ( mt_buddypress_is_user_online( $user_id ) ) {
            $username .= "<span class='mt-addons-buddypress-user-status mt-addons-buddypress-user-online'></span>" ;
        } else {
            $username .= "<span class='mt-addons-buddypress-user-status mt-addons-buddypress-user-offline'></span>" ;
        }

    return $username;

    }

    add_filter( 'modeltheme_addons_user_profile_username', 'mt_addons_add_user_online_status_icon', 999 );
    ?>

    <?php //swiper container start ?>
    <?php echo wp_kses_post($swiper_container_start); ?>
    <div class="mt-swipper-carusel-position" style="position:relative;">
    <div id="<?php echo esc_attr($id); ?>" 
        <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?>
        class="mt-addons-buddypress-members-carusel row <?php echo esc_attr($carousel_holder_class); ?>">
        <?php //swiper wrapped start ?>
        <?php echo wp_kses_post($swiper_wrapped_start); ?>
            <?php if ( function_exists('bp_is_active') ) { ?>
                <?php if ( bp_has_members( $members_args ) ) : ?>
                        <?php while ( bp_members() ) : bp_the_member(); ?>
                            <div class="mt-addons-buddypress-members-vcard <?php echo esc_attr($carousel_item_class); ?>">
                                <div class="mt-addons-buddypress-members-item-vcard">
                                        <div class="mt-addons-buddypress-members-item-avatar">
                                    
                                    <div class="mt-addons-buddypress-members-top-info-holder">
                                        <a href="<?php bp_member_permalink() ?>" class="mt-addons-buddypress-members-avatar">
                                            <span class="mt-addons-buddypress-members-hover"></span>
                                            <?php bp_member_avatar(''); ?>
                                        </a>
                                            <?php echo mt_addons_add_user_online_status_icon( null, $user_id ); ?>
                                        
                                        </div>

                                        <div class="mt-addons-buddypress-members-item">
                                            <div class="mt-addons-buddypress-members-item-meta">
                                                <?php if ( 'newest' == $settings['member_default'] ) : ?>
                                                    <span class="activity"></span>
                                                <?php elseif ( 'active' == $settings['member_default'] ) : ?>
                                                    <span class="activity"></span>
                                                <?php else : ?>
                                                    <span class="activity"><?php bp_member_total_friend_count(); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                         
                                </div>
                            </div>
                        <?php endwhile; ?>

                    <?php wp_nonce_field( 'bp_core_widget_members', '_wpnonce-members', false ); ?>
                    <input type="hidden" name="members_widget_max" id="members_widget_max" value="<?php echo esc_attr( $settings['max_members'] ); ?>" />
                <?php else: ?>
                    <div class="mt-addons-buddypress-members-widget-error">
                        <?php esc_html_e( 'No one has signed up yet!', 'modeltheme-addons-for-wpbakery' ); ?>
                    </div>
                <?php endif; ?>
           <?php } ?>

           <?php //swiper wrapped end ?>
          <?php echo wp_kses_post($swiper_wrapped_end); ?>
        <?php //pagination/navigation ?>
        <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
    </div>
    <?php //swiper container end ?>
    <?php echo wp_kses_post($swiper_container_end); ?>
    <style type="text/css" media="screen">
      .swiper-button-prev:hover,
      .swiper-button-next:hover {
        background: <?php echo esc_attr($navigation_bg_color_hover);?>!important;
        color: <?php echo esc_attr($navigation_color_hover); ?>!important;
        opacity: 1;
      }
      .swiper-pagination-bullet {
        background: <?php echo esc_attr($pagination_color);?>!important;
      }
    </style>
    <?php
    }
    protected function content_template() {}
}