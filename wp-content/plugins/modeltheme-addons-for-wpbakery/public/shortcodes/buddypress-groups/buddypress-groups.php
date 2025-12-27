<?php	


if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_buddypress_groups($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'       => '',
      'group_default'                   => '',
      'max_groups'            => '',
      // carousel
      'autoplay'              => '', 
      'delay'                 => '',
      'items_desktop'         => '',
      'items_mobile'          => '',
      'items_tablet'          => '',
      'space_items'           => '',
      'touch_move'            => '',
      'effect'                => '',
      'grab_cursor'           => '',
      'infinite_loop'         => '',
      'carousel'                 => '',
      'columns'                  => 'col-md-4',
      'layout'                   => 'grid',
      'centered_slides'          => '',
      'select_navigation'          => '',
      'navigation_position'        => '',
      'nav_style'                  => '',
      'navigation_color'           => '',
      'navigation_bg_color'        => '',
      'navigation_bg_color_hover'  => '',
      'navigation_color_hover'     => '',
      'pagination_color'           => '',
      'navigation'           => '',
      'pagination'           => '',
      'background_color_hover' => ''
      // end carousel

    ), $params ) );


    $group_args = array(
        // 'group_id'         => $group_id,
        'type'            => $settings['group_default'],
        'per_page'        => $max_groups,
        'max'             => $max_groups,
    );
    // custom
    wp_enqueue_style( 'blog-posts-carousel', plugins_url( '../../css/buddypress-groups.css' , __FILE__ ));

    $id = 'mt-addons-swipper-'.uniqid();

    $carousel_item_class = $columns;
    $carousel_holder_class = '';
    $swiper_wrapped_start = '';
    $swiper_wrapped_end = '';
    $swiper_container_start = '';
    $swiper_container_end = '';
    $html_post_swiper_wrapper = '';

    if ($layout == "carousel" or $layout == "") {
      $carousel_holder_class = 'mt-addons-swipper swiper';
      $carousel_item_class = 'swiper-slide';

      $swiper_wrapped_start = '<div class="swiper-wrapper">';
      $swiper_wrapped_end = '</div>';


        $swiper_container_start = '<div class="mt-addons-swiper-container">';
        $swiper_container_end = '</div>';

      if($page_builder == 'elementor' && $navigation == "yes") { 
        // next/prev
        $html_post_swiper_wrapper .= '
        <i class="fas fa-arrow-left swiper-button-prev '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>
        <i class="fas fa-arrow-right swiper-button-next '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>';
      }else {
        if($navigation == "true") { 
          $html_post_swiper_wrapper .= '
          <i class="fas fa-arrow-left swiper-button-prev '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>
          <i class="fas fa-arrow-right swiper-button-next '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>';
        }
      }
      if($page_builder == 'elementor' && $pagination == "yes") { 
          // next/prev
        $html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
      }else {
        if($pagination == "true") { 
          // next/prev
          $html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
        }
      }
      // SWIPER SLIDER
      wp_enqueue_style( 'swiper-bundle', plugins_url( '../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));
      wp_enqueue_script( 'swipper-bundle', plugins_url( '../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
      wp_enqueue_script( 'swipper', plugins_url( '../../js/swiper.js' , __FILE__));

    }

    ob_start(); ?>

      <!-- dir="rtl" -->
      <?php //swiper container start ?>
      <?php echo wp_kses_post($swiper_container_start); ?>
        <div class="mt-swipper-carusel-position" style="position:relative;">

          <div id="<?php echo esc_attr($id); ?>" 
            <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?>
            class="mt-addons-groups-carusel row <?php echo esc_attr($carousel_holder_class); ?>">

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
                            <img src="<?php echo $group_cover_image_url; ?>">
                            <div class="mt-addons-buddypress-groups-item">
                                 <div class="mt-addons-buddypress-groups-item-avatar">
                                    <a class="mt-addons-buddypress-groups-item-img" href="<?php bp_group_permalink() ?>"><?php bp_group_avatar() ?></a>
                                </div> 
                                <h4 class="mt-addons-buddypress-groups-item-title"><?php bp_group_link(); ?></h4>
                                
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
                <?php endif; ?>
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
      <style type="text/css" media="screen">
      <?php echo esc_attr('#'.$uniqid); ?>.swiper-button-prev:hover,
      <?php echo esc_attr('#'.$uniqid); ?>.swiper-button-next:hover {
        background: <?php echo esc_attr($navigation_bg_color_hover);?>!important;
        color: <?php echo esc_attr($navigation_color_hover); ?>!important;
        opacity: 1;
      }
      <?php echo esc_attr('#'.$uniqid); ?>.swiper-pagination-bullet {
        background: <?php echo esc_attr($pagination_color);?>!important;
      }
     .mt-addons-buddypress-groups-button a:hover{
        background: <?php echo esc_attr($background_color_hover);?>!important; 
     }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-buddypress-groups', 'modeltheme_addons_for_buddypress_groups');

add_action('init', 'mt_addons_buddypress_groups_vc_map');
function mt_addons_buddypress_groups_vc_map(){
  //VC Map
  if (function_exists('vc_map')) {
    $params = array(
      array(
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( "Number", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "max_groups"
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Default members to show:", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "group_default",
        "std" => 'Default value',
        "value" => array(
          esc_attr__('Select', "modeltheme-addons-for-wpbakery")   => '',
          esc_attr__('newest', "modeltheme-addons-for-wpbakery")  => 'newest',
          esc_attr__('active', "modeltheme-addons-for-wpbakery")  => 'active',
          esc_attr__('popular', "modeltheme-addons-for-wpbakery")  => 'popular',
          esc_attr__('alphabetical', "modeltheme-addons-for-wpbakery")  => 'alphabetical',
        ),
      ),
      array(
        "group" => "Styling",
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Button Background color - Hover", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "background_color_hover"
      ),
    );
    
    $swiper_fields_array = modeltheme_addons_swiper_vc_fields();
    if ($swiper_fields_array) {
      foreach ($swiper_fields_array as $swiper_fields) {
        $params[] = $swiper_fields;
      }
    }

    $extras_vc_fields = modeltheme_addons_extras_vc_fields();
    if ($extras_vc_fields) {
      foreach ($extras_vc_fields as $extra_param) {
        $params[] = $extra_param;
      }
    }

    vc_map(
      array(
        "name" => esc_attr__("MT: Buddypress Groups", 'modeltheme-addons-for-wpbakery'),
        "base" => "mt-addons-buddypress-groups",
        "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
        "icon" => plugins_url( 'images/blog.svg', __FILE__ ),
        "params" => $params,
    ));
  }
}