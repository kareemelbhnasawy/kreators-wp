<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

if (!function_exists('modeltheme_addons_swiper_vc_fields')) {
  function modeltheme_addons_swiper_vc_fields(){
    $swiper_vc_fields = array(
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Layout', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "layout",
        "value" => array(
         'Select Layout'   => '',
          'Carousel'       => 'carousel',
          'Grid'           => 'grid'
         ),
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Visible Items (Desktop)', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "items_desktop",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Visible Items (Mobiles)', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "items_mobile",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Visible Items (Tablets)', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "items_tablet",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
      ),
      array(
        "type" => "checkbox",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('AutoPlay', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "autoplay",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "min" => '500',
        "max" => '10000',
        "step" => '100',
        "value" => "600", 
        "heading" => esc_attr__('Slide Speed (in ms)', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "delay",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
      ),
      array(
        "type" => "checkbox",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Navigation', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "navigation",
         "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Navigation Position', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "navigation_position",
        "value" => array(
          'Select Option'     => '',
          'Above Slider Left'      => 'nav_above_left',
          'Above Slider Center'    => 'nav_above_center',
          'Above Slider Right'     => 'nav_above_right',
          'Top Left (In Slider)'      => 'nav_top_left',
          'Top Center (In Slider)'    => 'nav_top_center',
          'Top Right (In Slider)'     => 'nav_top_right',
          'Middle (Left/Right)'       => 'nav_middle',
          'Half Middle (Left/Right)' => 'half_nav_middle',
          'Bottom Left (In Slider)'   => 'nav_bottom_left',
          'Bottom Center (In Slider)' => 'nav_bottom_center',
          'Bottom Right (In Slider)' => 'nav_bottom_right',
          'Below Slider Left'   => 'nav_below_left',
          'Below Slider Center' => 'nav_below_center',
          'Below Slider Right' => 'nav_below_right',
        ),
        "dependency" => array(
          'element' => 'navigation',
          'value' => 'true',
        ),
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_attr__("Navigation Shape", "modeltheme-addons-for-wpbakery"),
        "param_name" => "nav_style",
        "value" => array(
          'Select Option'     => '',
          esc_attr__('Square', 'modeltheme-addons-for-wpbakery')   => 'nav-square',
          esc_attr__('Rounded (5px Radius)', 'modeltheme-addons-for-wpbakery')   => 'nav-rounded',
          esc_attr__('Round (50px Radius)', 'modeltheme-addons-for-wpbakery')   => 'nav-round',
        ),
        "dependency" => array(
          'element' => 'navigation',
          'value' => 'true',
        ),
        "std" => 'normal',
        "holder" => "div",
      ),
      array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Navigation color', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'navigation_color',
        "dependency" => array(
          'element' => 'navigation',
          'value' => 'true',
        ),
        'description' => esc_html__( 'Select Navigation Color.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Navigation Background color', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'navigation_bg_color',
        "dependency" => array(
          'element' => 'navigation',
          'value' => 'true',
        ),
        'description' => esc_html__( 'Select Background Navigation Color.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Navigation Color Hover', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'navigation_color_hover',
        "dependency" => array(
          'element' => 'navigation',
          'value' => 'true',
        ),
        'description' => esc_html__( 'Select Color Navigation Color - Hover.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Navigation Background color - Hover', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'navigation_bg_color_hover',
        "dependency" => array(
          'element' => 'navigation',
          'value' => 'true',
        ),
        'description' => esc_html__( 'Select Background Navigation Color - Hover.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "type" => "checkbox",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Pagination', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "pagination",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_attr__("Pagination Type", "modeltheme-addons-for-wpbakery"),
        "param_name" => "pagination_type",
        "value" => array(
          'Select Option'     => '',
          esc_attr__('Pagination (Dots)', 'modeltheme-addons-for-wpbakery')   => 'pagination-dots',
          esc_attr__('Pagination (Clickable)', 'modeltheme-addons-for-wpbakery')   => 'pagination-clickable',
        ),
        "dependency" => array(
          'element' => 'pagination',
          'value' => 'true',
        ),
        "std" => 'normal',
        "holder" => "div",
      ),
      array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Pagination color active', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'pagination_color',
        "dependency" => array(
          'element' => 'pagination',
          'value' => 'true',
        ),
        'description' => esc_html__( 'Select Pagination Color.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Pagination color next', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'pagination_color_next',
        "dependency" => array(
          'element' => 'pagination',
          'value' => 'true',
        ),
        'description' => esc_html__( 'Select Pagination Color next.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Space Between Items', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "space_items",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
      ),
      array(
        "type" => "checkbox",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Allow Touch Move', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "touch_move",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
        "description" => __( 'If checked, the touch move event will be triggered once for each movement and will continue to be triggered until the finger is released.', 'modeltheme-addons-for-wpbakery'),
      ),
      array(
        "type" => "checkbox",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Grab Cursor', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "grab_cursor",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
        "description" => __( 'If checked, will show the mouse pointer over the carousel.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Carousel Effect', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "effect",
        "value" => array(
         'Select Effect'   => '',
          'Creative'   => 'creative',
          'Cards'      => 'cards',
          'Coverflow'  => 'coverflow',
          'Cube'       => 'cube',
          'Fade'       => 'fade',
          'Flip'       => 'flip',
         ),
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
        "description" => __( "See all availavble effects on <a target='_blank' href='https://swiperjs.com/demos#effect-fade'>swiperjs.com</a>", "modeltheme-addons-for-wpbakery"),
      ),
      array(
        "type" => "checkbox",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Infinite Loop', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "infinite_loop",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
        "description" => __( 'If checked, will show the numerical value of infinite loop.'),
      ),
      array(
        "type" => "checkbox",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Centered Slides', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "centered_slides",
        "dependency" => array(
          'element' => 'layout',
          'value' => 'carousel',
        ),
        "description" => __( "If checked, the left side and the right side will have a partial slide visible."),
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Columns', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "columns",
        "value" => array(
          'Select Option'     => '',
          '1 Column'      => 'col-md-12',
          '2 Columns'     => 'col-md-6',
          '3 Columns'     => 'col-md-4',
          '4 Columns'     => 'col-md-3',
          '6 Columns'     => 'col-md-2'
        ),
        "dependency" => array(
          'element' => 'layout',
          'value' => 'grid',
        ),
      ),
    );

    return $swiper_vc_fields;
  }
}

if (!function_exists('modeltheme_addons_swiper_attributes')) {
  function modeltheme_addons_swiper_attributes($id = '', $autoplay = '', $delay = '', $items_desktop = '', $items_mobile = '', $items_tablet = '', $space_items = '', $touch_move = '', $effect = '', $grab_cursor = '', $infinite_loop = '', $centered_slides = '' , $navigation = '', $pagination = ''){
    ?>
        data-swiper-id="<?php echo esc_attr($id); ?>"  
        data-swiper-autoplay="<?php echo esc_attr($autoplay); ?>"
        data-swiper-delay="<?php echo esc_attr($delay); ?>" 
        data-swiper-desktop-items="<?php echo esc_attr($items_desktop); ?>" 
        data-swiper-mobile-items="<?php echo esc_attr($items_mobile); ?>" 
        data-swiper-tablet-items="<?php echo esc_attr($items_tablet); ?>" 
        data-swiper-space-between-items="<?php echo esc_attr($space_items); ?>" 
        data-swiper-allow-touch-move="<?php echo esc_attr($touch_move); ?>" 
        data-swiper-effect="<?php echo esc_attr($effect); ?>"
        data-swiper-grab-cursor ="<?php echo esc_attr($grab_cursor); ?>"
        data-swiper-infinite-loop ="<?php echo esc_attr($infinite_loop); ?>"
        data-swiper-centered-slides ="<?php echo esc_attr($centered_slides); ?>"
        data-swiper-navigation ="<?php echo esc_attr($navigation); ?>"
        data-swiper-pagination ="<?php echo esc_attr($pagination); ?>"


    <?php 
  }
}