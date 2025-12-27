<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_title_subtitle($params, $content) {
    extract( shortcode_atts( 
      array(
        'section_align'     => 'text-center',
        'title'             => 'My Title',
        'title_underline'   => '',
        'title_2'           => '',
        'title_size'        => '',
        'title_weight'      => '',
        'title_line'        => '',
        'title_tag'         => 'h2',
        'title_color'       => '',
        'underline_style'   => '',

        'separator'         => '',
        'delimitator_color' => '',
        'separator_status'  => '',
        'separator_type'    => 'svg',
        'content_svg'       => '',

        'subtitle'          => '',
        'subtitle_position'          => '',
        'subtitle_color'    => '',
        'subtitle_size'     => '',
        'subtitle_line'     => '',
        'subtitle_weight'   => '',

        'el_class'                         => '',
        'el_custom_id'                         => '',
      ), $params ) );

    $separator = wp_get_attachment_image_src($separator, "full");
    wp_enqueue_style( 'title-subtitle-css', plugins_url( '../../css/title-subtitle.css' , __FILE__ ));
    ob_start(); ?>
    <div <?php if($el_custom_id) {?> id="<?php echo $el_custom_id; ?>" <?php } ?> class="mt-addons-title-subtile <?php echo $el_class; ?>">
      
      <?php if ($subtitle != '' && $subtitle_position == 'up') { ?>
        <div class="mt-addons-subtitle-section <?php echo esc_attr($section_align);?>" style="color:<?php echo $subtitle_color; ?>;font-size:<?php echo $subtitle_size?>px;line-height:<?php echo $subtitle_line; ?>;font-weight:<?php echo $subtitle_weight?>;" ><?php echo esc_html__($subtitle); ?></div>
      <?php } ?>

      <?php if (($separator_status && $subtitle_position == 'up')) { ?>
        <?php if ($separator_type == "image") { ?>
          <div class="mt-addons-title-border <?php echo esc_attr($section_align);?>" style="background: url(<?php echo $separator[0]; ?>) no-repeat center center;"></div>
        <?php } else if ($separator_type == "svg") {?>
          <?php if($content_svg) { ?>
            <div class="mt-addons-title-svg-border <?php echo esc_attr($section_align);?>"><?php echo esc_attr($content_svg);?></div>
          <?php } else { ?>
            <div class="mt-addons-title-svg-border <?php echo esc_attr($section_align);?>"><svg width="515" height="25" viewBox="0 0 275 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect y="7" width="120" height="1" fill="#CCCCCC"/>
            <rect x="155" y="7" width="120" height="1" fill="#CCCCCC"/>
            <path d="M144.443 14.6458C144.207 14.8818 143.897 15 143.588 15C143.278 15 142.968 14.8818 142.732 14.6454L137.874 9.78689C137.517 9.43023 137.43 8.90654 137.612 8.46798L136.617 7.47264L135.242 8.84723C135.517 9.2862 135.458 9.8809 135.066 10.2714C134.614 10.7245 133.888 10.7342 133.448 10.2936L130.324 7.17126C129.883 6.73028 129.893 6.00566 130.347 5.55298C130.738 5.16122 131.332 5.10231 131.771 5.37788L135.378 1.77014C135.102 1.33158 135.161 0.737682 135.553 0.346326C136.006 -0.10676 136.73 -0.116443 137.171 0.324136L140.295 3.44732C140.736 3.8879 140.726 4.61251 140.272 5.0656C139.88 5.45736 139.287 5.51586 138.849 5.2407L137.472 6.6169L138.59 7.73449C138.945 7.69334 139.314 7.80348 139.586 8.07622L144.444 12.9347C144.916 13.4071 144.916 14.1729 144.443 14.6458Z" fill="<?php echo esc_attr($delimitator_color); ?>"/>
            </svg></div>
          <?php } ?>
        <?php } ?>
      <?php } ?>

        <?php if ($underline_style == 'curved') { ?>
            <?php
                $underline = 'curved';
            ?>
       <?php } elseif ($underline_style == 'straight')  { ?>
            <?php
                $underline = 'straight';
            ?>
        <?php } ?>

      <<?php echo $title_tag; ?> class="mt-addons-title-section <?php echo $section_align;?>" style="color:<?php echo $title_color; ?>;font-weight:<?php echo $title_weight; ?>;font-size:<?php echo $title_size; ?>px;<?php if($title_line){?> line-height: <?php echo $title_line; }?>"><?php echo esc_html__($title); ?> <span class="mt-underline-text <?php echo $underline; ?>" style="color:<?php echo $title_color; ?>;<?php if($title_line){?> line-height: <?php echo $title_line; }?>"><?php echo esc_html__($title_underline); ?></span> <?php echo esc_html__($title_2); ?></<?php echo $title_tag;?>>

      <?php if (($separator_status && $subtitle_position == 'down') || ($separator_status && $subtitle_position == '')) { ?>
        <?php if ($separator_type == "image") { ?>
          <div class="mt-addons-title-border <?php echo esc_attr($section_align);?>" style="background: url(<?php echo $separator[0]; ?>) no-repeat center center;"></div>
        <?php } else if ($separator_type == "svg") {?>
          <?php if($content_svg) { ?>
            <div class="mt-addons-title-svg-border <?php echo esc_attr($section_align);?>"><?php echo esc_attr($content_svg);?></div>
          <?php } else { ?>
            <div class="mt-addons-title-svg-border <?php echo esc_attr($section_align);?>"><svg width="515" height="25" viewBox="0 0 275 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect y="7" width="120" height="1" fill="#CCCCCC"/>
            <rect x="155" y="7" width="120" height="1" fill="#CCCCCC"/>
            <path d="M144.443 14.6458C144.207 14.8818 143.897 15 143.588 15C143.278 15 142.968 14.8818 142.732 14.6454L137.874 9.78689C137.517 9.43023 137.43 8.90654 137.612 8.46798L136.617 7.47264L135.242 8.84723C135.517 9.2862 135.458 9.8809 135.066 10.2714C134.614 10.7245 133.888 10.7342 133.448 10.2936L130.324 7.17126C129.883 6.73028 129.893 6.00566 130.347 5.55298C130.738 5.16122 131.332 5.10231 131.771 5.37788L135.378 1.77014C135.102 1.33158 135.161 0.737682 135.553 0.346326C136.006 -0.10676 136.73 -0.116443 137.171 0.324136L140.295 3.44732C140.736 3.8879 140.726 4.61251 140.272 5.0656C139.88 5.45736 139.287 5.51586 138.849 5.2407L137.472 6.6169L138.59 7.73449C138.945 7.69334 139.314 7.80348 139.586 8.07622L144.444 12.9347C144.916 13.4071 144.916 14.1729 144.443 14.6458Z" fill="<?php echo esc_attr($delimitator_color); ?>"/>
            </svg></div>
          <?php } ?>
        <?php } ?>
      <?php } ?>

      <?php if (($subtitle != '' && $subtitle_position == 'down') || ($subtitle != '' && $subtitle_position == '')) { ?>
        <div class="mt-addons-subtitle-section <?php echo esc_attr($section_align);?>" style="color:<?php echo $subtitle_color; ?>;<?php if($subtitle_size){?> font-size:<?php echo $subtitle_size?>px;<?php } ?><?php if($subtitle_line){?>line-height:<?php echo $subtitle_line; ?>;<?php } ?><?php if($subtitle_weight){?>font-weight:<?php echo $subtitle_weight?>;<?php } ?>" ><?php echo esc_html__($subtitle); ?></div>
      <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-title-subtitle', 'modeltheme_addons_for_wpbakery_title_subtitle');

//VC Map
if (function_exists('vc_map')) {

  $params = array();

  $params_shortcode = array(
    array(
      "type" => "dropdown",
      "group" => "Title",
      "class" => "",
      "heading" => esc_attr__( "Aligment", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "section_align",
      "value" => array(
          'Select Option' => '',
          'Left'          => 'text-left',
          'Center'        => 'text-center',
          'Right'         => 'text-right',
      ),
      "default" => 'text-center'
    ),
    array(
      "type" => "textfield",
      "group" => "Title",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__( "Title", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title",
      "value" => "My Title",
    ),
    array(
        "type" => "textfield",
        "group" => "Title",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( "Title", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "title_line",
        "value" => "My Title Line",
    ),
      array(
          "type" => "textfield",
          "group" => "Title 2",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Title", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "title_2",
          "value" => "My Title 2",
      ),
    array(
      "type" => "dropdown",
      "group" => "Title",
      "class" => "",
      "heading" => esc_attr__( "Element tag", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_tag",
      "value" => array(
          'Select Option' => '',
          'h1'      => 'h1',
          'h2'      => 'h2',
          'h3'      => 'h3',
          'h4'      => 'h4',
          'h5'      => 'h5',
          'h6'      => 'h6',
          'p'       => 'p',
      )
    ),
    array(
      "group" => "Title",
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_color"
    ),
    array(
      "type" => "vc_number",
      "suffix" => "px",
      "group" => "Title",
      "class" => "",
      "heading" => esc_attr__( "Font size", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_size"
    ),
    array(
      "type" => "vc_number",
      "suffix" => "E.g.: 1.5 (Min: 0.1 - Max 3)",
      'min' => 0.1,
      'max' => 3,
      'step' => 0.1,
      "group" => "Title",
      "class" => "",
      "heading" => esc_attr__( "Line height", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_line"
    ),
    array(
      "type" => "vc_number",
      "suffix" => "E.g.: 500",
      "group" => "Title",
      "class" => "",
      "heading" => esc_attr__( "Font weight", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_weight"
    ),
    array(
      "group" => "Subtitle",
      "heading" => esc_attr__( "Subtitle", 'modeltheme-addons-for-wpbakery' ),
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "param_name" => "subtitle",
      "description" => esc_attr__("Leave empty to disable", 'modeltheme-addons-for-wpbakery'),
      "value" => "",
    ),
    array(
      "group" => "Subtitle",
      "heading" => esc_attr__( "Subtitle placement", 'modeltheme-addons-for-wpbakery' ),
      "type" => "dropdown",
      "class" => "",
      "param_name" => "subtitle_position",
      "value" => array(
        'Select Option' => '',
        'Above Heading'      => 'up',
        'Below Heading'      => 'down',
      )
    ),
    array(
      "group" => "Subtitle",
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "subtitle_color",
    ),
    array(
      "type" => "vc_number",
      "suffix" => "px",
      "group" => "Subtitle",
      "class" => "",
      "heading" => esc_attr__( "Font size", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "subtitle_size",
    ),
    array(
      "type" => "vc_number",
      "suffix" => "E.g.: 1.5 (Min: 0.1 - Max 3)",
      'min' => 0.1,
      'max' => 3,
      'step' => 0.1,
      "group" => "Subtitle",
      "class" => "",
      "heading" => esc_attr__( "Line height", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "subtitle_line",
    ),
    array(
      "type" => "vc_number",
      "suffix" => "E.g.: 300",
      "group" => "Subtitle",
      "class" => "",
      "heading" => esc_attr__( "Font weight", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "subtitle_weight",
    ),
    array(
      "group" => "Separator",
      "type" => "checkbox",
      "class" => "",
      "heading" => esc_attr__("Status", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "separator_status",
      "value"       => array(
        "Enabled" => "true",
      ),
    ),
    array(
      "group" => "Separator",
      "type" => "dropdown",
      "class" => "",
      "heading" => esc_attr__("Type", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "separator_type",
      "dependency" => array(
        'element' => 'separator_status',
        'value' => "true",
      ),
      "value"       => array(
        "SVG"   => "svg",
        "Image" => "image", 
      ),
    ),
    array(
      "group" => "Separator",
      "type" => "attach_image",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__( "Separator", 'modeltheme-addons-for-wpbakery' ),
      "description" => esc_attr__("If this option is empty, the default separator will be applied.", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "separator",
      "dependency" => array(
        'element' => 'separator_type',
        'value' => "image",
      ),
    ),          
    array(
      "group" => "Separator",
      "type" => "colorpicker",
      "class" => "",
      "heading" => esc_attr__("Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "delimitator_color",
      "dependency" => array(
        'element' => 'separator_type',
        'value' => "svg",
      ),
    ),
    array(
      "type" => "textfield",
      "group" => "Separator",
      "class" => "",
      "holder" => "div",
      "heading" => esc_attr__( "HTML SVG", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "content_svg",
      "dependency" => array(
        'element' => 'separator_type',
        'value' => "svg",
      ),
    ),
  );

  if ($params_shortcode) {
    foreach ($params_shortcode as $param) {
      $params[] = $param;
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
      "name" => esc_attr__("MT: Title & Subtitle", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-title-subtitle",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/section-title-heading.svg', __FILE__ ),
      "params" => $params
    )
  );
}