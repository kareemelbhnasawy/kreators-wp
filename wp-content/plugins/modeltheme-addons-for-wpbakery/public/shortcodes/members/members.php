<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_members($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'              => '',
      'image_shape'               => '',
      'list_image'                => '',
      'featured_image_size'       => '',
      'member_groups'             => '',
      'member_name'               => '',
      'member_position'           => '',
      'image_members'             => '',
      'member_description'        => '',
      'facebook'                  => '',
      'twitter'                   => '',
      'pinterest'                 => '',
      'instagram'                 => '',
      'youtube'                   => '',
      'dribbble'                  => '',
      'linkedin'                  => '',
      'deviantart'                => '',
      'digg'                      => '',
      'flickr'                    => '',
      'stumbleupon'               => '',
      'tumblr'                    => '',
      'email'                     => '',
      'overlay_bg'                => '',
      'icons_color'               => '',
      'links_target'              => '',
      'title_color'               => '',
      'position_color'            => '',
      'description_color'         => '',
      'member_url'                => '',
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
      'columns'                  => '',
      'layout'                   => '',
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
      // end carousel
      'name_size'           =>'',

    ), $params ) );
    
    $overlay_bg_style = '';
    if ($overlay_bg) {
      $overlay_bg_style = 'background:'.$overlay_bg.';';
    }

    $icons_color_style = '';
    if ($icons_color) {
      $icons_color_style = 'color:'.$icons_color.';';
    }
    $title_color_style = '';
    if ($title_color) {
      $title_color_style = 'color:'.$title_color.';';
    }
    $position_color_style = '';
    if ($position_color) {
      $position_color_style = 'color:'.$position_color.';';
    }
    $description_color_style = '';
    if ($description_color) {
      $description_color_style = 'color:'.$description_color.';';
    }
    $links_target_attr = '';
    if ($links_target) {
      $links_target_attr = 'target="'.$links_target.'"';
    }
   
    wp_enqueue_style( 'mt-members', plugins_url( '../../css/members.css' , __FILE__ ));
    if ($page_builder == 'elementor') {
      // $member_groups = modeltheme_addons_for_wpbakery_param_group_img_parse_atts($member_groups);
      $member_groups = unserialize(base64_decode($member_groups));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $member_groups = vc_param_group_parse_atts($params['member_groups']);
      }
    }
    // echo '<pre>' . var_export($member_groups, true) . '</pre>';
    $id = 'mt-addons-carousel-'.uniqid();

    $carousel_item_class = $columns;
    $carousel_holder_class = '';
    $swiper_wrapped_start = '';
    $swiper_wrapped_end = '';
    $html_post_swiper_wrapper = '';

    if ($layout == "carousel") {
      $carousel_holder_class = 'mt-addons-swipper swiper';
      $carousel_item_class = 'swiper-slide';

      $swiper_wrapped_start = '<div class="swiper-wrapper">';
      $swiper_wrapped_end = '</div>';

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
          <?php // echo '<pre>' . var_export($member_groups, true) . '</pre>'; ?>
    <div class="mt-swipper-carusel-position" style="position:relative;">
       <?php if ($layout == "carousel") { ?>
        <div id="<?php echo esc_attr($id); ?>" 
            <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?> 
          class="mt-addons-members <?php echo esc_attr($carousel_holder_class); ?>">
       <?php } else {  ?>
          <div id="<?php echo esc_attr($id); ?>" 
            <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?> 
            class="mt-addons-members row <?php echo esc_attr($carousel_holder_class); ?>">
        <?php } ?>

          <?php //swiper wrapped start ?>
          <?php echo wp_kses_post($swiper_wrapped_start); ?>

            <?php //items ?>
            <?php if ($member_groups) { ?>
              <?php foreach ($member_groups as $param) {

                if ($page_builder == 'elementor') {
                  $image_id = $param['list_image']['id'];
                }else{
                  $image_id = $param['list_image'];
                }

                if (!array_key_exists('name_size', $param)) {
                  $name_size = '';
                }else{
                  $name_size = $param['name_size'];
                }

                if (!array_key_exists('member_name', $param)) {
                  $member_name = 'John Doe';
                }else{
                  $member_name = $param['member_name'];
                }
               $image_size = 'full';
                if ($featured_image_size) {
                  $image_size = $featured_image_size;
                }

                $image_members = wp_get_attachment_image_src( $image_id, $image_size ); ?>
                
                <div class="mt-addons-member-columns <?php echo esc_attr($carousel_item_class); ?>">
                  
                  <?php if ($image_members) { ?>
                    <div class="mt-addons-member-image">
                      <img src="<?php echo esc_url($image_members[0]); ?>" alt="<?php echo esc_html__($member_name); ?>" class="<?php echo $image_shape; ?>" />
                      <div class="mt-addons-member-image-flex-zone <?php echo $image_shape; ?>" style="<?php echo $overlay_bg_style; ?>">
                        <div class="mt-addons-member-image-flex-zone-inside member_social social-icons">
                          <?php if (isset($param['facebook']) && !empty($param['facebook'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['facebook']); ?>"><i class="fab fa-facebook-f"></i></a>
                          <?php } ?>
                          <?php if (isset($param['twitter']) && !empty($param['twitter'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['twitter']); ?>"><i class="fab fa-twitter"></i></a>
                          <?php } ?>
                          <?php if (isset($param['pinterest']) && !empty($param['pinterest'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['pinterest']); ?>"><i class="fab fa-pinterest"></i></a>
                          <?php } ?>
                          <?php if (isset($param['instagram']) && !empty($param['instagram'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['instagram']); ?>"><i class="fab fa-instagram"></i></a>
                          <?php } ?>
                          <?php if (isset($param['youtube']) && !empty($param['youtube'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['youtube']); ?>"><i class="fab fa-youtube"></i></a>
                          <?php } ?>
                          <?php if (isset($param['dribbble']) && !empty($param['dribbble'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['dribbble']); ?>"><i class="fab fa-dribbble"></i></a>
                          <?php } ?>
                          <?php if (isset($param['linkedin']) && !empty($param['linkedin'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['linkedin']); ?>"><i class="fab fa-linkedin"></i></a>
                          <?php } ?>
                          <?php if (isset($param['deviantart']) && !empty($param['deviantart'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['deviantart']); ?>"><i class="fab fa-deviantart"></i></a>
                          <?php } ?>
                          <?php if (isset($param['digg']) && !empty($param['digg'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['digg']); ?>"><i class="fab fa-digg"></i></a>
                          <?php } ?>
                          <?php if (isset($param['flickr']) && !empty($param['flickr'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['flickr']); ?>"><i class="fab fa-flickr"></i></a>
                          <?php } ?>
                          <?php if (isset($param['tumblr']) && !empty($param['tumblr'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['tumblr']); ?>"><i class="fab fa-tumblr"></i></a>
                          <?php } ?>
                          <?php if (isset($param['stumbleupon']) && !empty($param['stumbleupon'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['stumbleupon']); ?>"><i class="fab fa-stumbleupon"></i></a>
                          <?php } ?>
                          <?php if (isset($param['email']) && !empty($param['email'])) { ?>
                            <a <?php echo $links_target_attr; ?> style="<?php echo $icons_color_style; ?>" href="<?php echo esc_url($param['email']); ?>"><i class="fab fa-envelope"></i></a>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="mt-addons-member-section"> 
                    <?php if(!empty($param['member_name'])){ ?>
                      <h3 class="mt-addons-member-name" style="font-size:<?php echo esc_attr($name_size);?>px;">
                        <a href="<?php echo esc_url($param['member_url']); ?>" class="mt-addons-member-url" style="<?php echo $title_color_style; ?>">
                          <?php echo esc_html__($param['member_name']); ?>
                        </a>
                      </h3>
                    <?php } ?>
                     
                    <?php if(!empty($param['member_position'])){ ?>
                      <div class="mt-addons-member-position" style="<?php echo $position_color_style; ?>"><?php echo esc_html__($param['member_position']);?></div>
                    <?php } ?>

                    <?php if(!empty($param['member_description'])){ ?>
                      <div class="mt-addons-member-description" style="<?php echo $description_color_style; ?>"><?php echo esc_html__($param['member_description']);?></div>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>


          <?php //swiper wrapped end ?>
          <?php echo wp_kses_post($swiper_wrapped_end); ?>

          <?php //pagination/navigation ?>
          <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
      </div>
    </div>
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
    return ob_get_clean();
}
add_shortcode('mt-addons-members', 'modeltheme_addons_for_wpbakery_members');

//VC Map
if (function_exists('vc_map')) {
  $params = array(
    array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Image Shape", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "image_shape",
      "value" => array(
        'Select Option'     => '',
        'Rounded'     => 'img-rounded',
        'Circle'     => 'img-circle',
        'Square'     => 'img-square',
      )
    ),
    array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Featured Image size", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "featured_image_size",
      "std" => 'full',
      "value" => modeltheme_addons_image_sizes_array()
    ),
    array(
      "type" => "checkbox",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Open Link In New Tab", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "links_target",
    ),
    array( 
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Overlay Backgroud", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "overlay_bg",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Icons Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "icons_color",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Title Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_color",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Position Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "position_color",
      "value" => "",
      "description" => ""
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Short Description Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "description_color",
      "value" => "",
      "description" => ""
    ),
    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'member_groups',
      // Note params is mapped inside param-group:
      'params' => array(
        array(
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Image", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "list_image",
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Name", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "member_name",
        ),
        array(
          "type" => "vc_number",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Name Font Size", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "name_size"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Position", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "member_position",
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Short description", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "member_description",
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Website", 'modeltheme'),
          "param_name" => "member_url",
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Email", 'modeltheme'),
          "param_name" => "email",
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Facebook URL", 'modeltheme' ),
          "param_name" => "facebook",
          "value" => "",
          "description" => esc_attr__( "Enter your facebook link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Twitter URL", 'modeltheme' ),
          "param_name" => "twitter",
          "value" => "",
          "description" => esc_attr__( "Enter your twitter link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Pinterest URL", 'modeltheme' ),
          "param_name" => "pinterest",
          "value" => "",
          "description" => esc_attr__( "Enter your pinterest link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Instagram URL", 'modeltheme' ),
          "param_name" => "instagram",
          "value" => "",
          "description" => esc_attr__( "Enter your instagram link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "YouTube URL", 'modeltheme' ),
          "param_name" => "youtube",
          "value" => "",
          "description" => esc_attr__( "Enter your YouTube link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "LinkedIn URL", 'modeltheme' ),
          "param_name" => "linkedin",
          "value" => "",
          "description" => esc_attr__( "Enter your linkedin link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Dribbble URL", 'modeltheme' ),
          "param_name" => "dribbble",
          "value" => "",
          "description" => esc_attr__( "Enter your dribbble link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Deviantart URL", 'modeltheme' ),
          "param_name" => "deviantart",
          "value" => "",
          "description" => esc_attr__( "Enter your deviantart link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Digg URL", 'modeltheme' ),
          "param_name" => "digg",
          "value" => "",
          "description" => esc_attr__( "Enter your digg link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Flickr URL", 'modeltheme' ),
          "param_name" => "flickr",
          "value" => "",
          "description" => esc_attr__( "Enter your flickr link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Stumbleupon URL", 'modeltheme' ),
          "param_name" => "stumbleupon",
          "value" => "",
          "description" => esc_attr__( "Enter your stumbleupon link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Tumblr URL", 'modeltheme' ),
          "param_name" => "tumblr",
          "value" => "",
          "description" => esc_attr__( "Enter your tumblr link.", 'modeltheme' ),
          "group" => "Icons Links"
        ),
      ),
    ),
  );

  $swiper_fields_array = modeltheme_addons_swiper_vc_fields();
  if ($swiper_fields_array) {
    foreach ($swiper_fields_array as $swiper_fields) {
      $params[] = $swiper_fields;
    }
  }
  vc_map(
    array(
      "name" => esc_attr__("MT: Members", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-members",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/members-slider.svg', __FILE__ ),
      "params" => $params,
  ));
}