<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

if (!function_exists('modeltheme_addons_icons_vc_fields')) {
  function modeltheme_addons_icons_vc_fields($group_name = ''){
    $icons_vc_fields = array(
      array(
        "group" => $group_name,
        'type' => 'dropdown',
        "class" => "",
        'heading' => esc_html__( 'Type', 'modeltheme-addons-for-wpbakery' ),
        'value' => array(
          'Select Option' => '',
          'Font Icon'  => 'font_icon',
          'SVG'  => 'svg',
          'Image'  => 'image',
        ),
        'param_name' => 'icon_type',
        'description' => esc_html__( 'Select if you wish to add a font icon, svg code or image icon (png or jpg).', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "group" => $group_name,
        'type' => 'dropdown',
        "class" => "",
        'heading' => esc_html__( 'Icon library', 'modeltheme-addons-for-wpbakery' ),
        'value' => array(
          'Select Option' => '',
          'Font Awesome 5'  => 'fontawesome',
          'Open Iconic'     => 'openiconic',
          'Typicons'        => 'typicons',
          'Entypo'          => 'entypo',
          'Linecons'        => 'linecons',
          'Material'        => 'material',
        ),
        'param_name' => 'icon_dropdown',
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'font_icon',
        ),
        'description' => esc_html__( 'Select icon library.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "group" => $group_name,
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'icon_fontawesome',
        'value' => 'fas fa-adjust',
        'settings' => array(
            'emptyIcon' => false,
            'iconsPerPage' => 100,
        ),
        'dependency' => array(
            'element' => 'icon_dropdown',
            'value' => 'fontawesome',
        ),
        'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "group" => $group_name,
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'icon_typicons',
        'settings' => array(
            'emptyIcon' => false,
            'type' => 'typicons',
            'iconsPerPage' => 100,
        ),
        'dependency' => array(
            'element' => 'icon_dropdown',
            'value' => 'typicons',
        ),
        'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "group" => $group_name,
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'icon_openiconic',
        'settings' => array(
            'emptyIcon' => false,
            'type' => 'openiconic',
            'iconsPerPage' => 100,
        ),
        'dependency' => array(
            'element' => 'icon_dropdown',
            'value' => 'openiconic',
        ),
        'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "group" => $group_name,
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'icon_entypo',
        'settings' => array(
            'emptyIcon' => false,
            'type' => 'entypo', 
            'iconsPerPage' => 100,
        ),
        'dependency' => array(
            'element' => 'icon_dropdown',
            'value' => 'entypo',
        ),
        'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "group" => $group_name,
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'icon_material',
        'settings' => array(
            'emptyIcon' => false,
            'type' => 'material',
            'iconsPerPage' => 100,
        ),
        'dependency' => array(
            'element' => 'icon_dropdown',
            'value' => 'material',
        ),
        'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "group" => $group_name,
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
        'param_name' => 'icon_linecons',
        'value' => 'vc_li vc_li-heart',
        'settings' => array(
            'emptyIcon' => false,
            'type' => 'linecons',
            'iconsPerPage' => 1000,
        ),
        'dependency' => array(
            'element' => 'icon_dropdown',
            'value' => 'linecons',
            
        ),
        'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
      ),
      array(
        "group" => $group_name,
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Icon Size', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "icon_size",
        "suffix" => "px",
        "value" => "",
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'font_icon',
        ),
        "description" => "Default: 18(px)"
      ),
      array(
        "group" => $group_name,
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Icon Color', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "icon_color",
        "value" => "",
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'font_icon',
        ),
        "description" => ""
      ),
      array(
        "group" => $group_name,
        "type" => "attach_image",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( 'Choose an image', 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "image",
        "value" => "",
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'image',
        ),
        "description" => esc_attr__( 'Upload a PNG or JPG icon or image.', 'modeltheme-addons-for-wpbakery' )
      ),
      array(
        "group" => $group_name,
        "type" => "vc_number",
        "holder" => "div",
        "suffix" => "px",
        "class" => "",
        "heading" => esc_attr__('Image Max Width', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "image_max_width",
        "value" => "",
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'image',
        ),
        "description" => esc_attr__( 'Default: 50 (px). Leave empty for auto width.', 'modeltheme-addons-for-wpbakery' )
      ),
      array(
        "group" => $group_name,
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('Image Margin right', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "image_margin",
        "suffix" => "px",
        "value" => "",
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'image',
        ),
        "description" => esc_attr__( 'Leave empty for auto width.', 'modeltheme-addons-for-wpbakery' )
      ),
      array(
        "group" => $group_name,
        "type" => "textarea_raw_html",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__('SVG Code', 'modeltheme-addons-for-wpbakery'),
        "param_name" => "use_svg",
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'svg',
        ),
      ),
      array(
        "group" => $group_name,
        "type" => "vc_link",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( 'Link', 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "icon_url",
        "description" => "",
      ),
    );

    return $icons_vc_fields;
  }
}