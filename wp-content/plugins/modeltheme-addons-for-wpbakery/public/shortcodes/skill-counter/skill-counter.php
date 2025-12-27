<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_skill_counter($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'           => '',
      'tabs_item_service_icon_fa'           => '',
      'tabs_item_service_icon__lineicons'   => '',
      'title'                               => '',
      'skill_value'                         => '',
      'skill_size'                          => '30',
      'use_img'                             => '',
      'list_icon_size'                      => '',
      'list_icon_color'                     => '',
      'title_color'                         => '#222',
      'skill_color'                         => '',
      'columns'                             => '',
      'extra_class'                         => '',
      'suffix'                              => '',
      'icon_pos'                            => '',
      'aligment'                            => '',
      'skillcounter_groups'                 => '',
      'border_left'                         => ''

    ), $params ) );
    
    
   
    wp_enqueue_style( 'skill-counter-css', plugins_url( '../../css/skill-counter.css' , __FILE__ ));

    if ($page_builder == 'elementor') {
      $skillcounter_groups = unserialize(base64_decode($skillcounter_groups));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $skillcounter_groups = vc_param_group_parse_atts($params['skillcounter_groups']);
      }
    }

    $icon_position_style = 'before_content';
    if($icon_pos == "before_content") {
      $icon_position_style = 'before_content';
    } else if ($icon_pos == "top_content") {
      $icon_position_style = 'top_content';
    }
    ob_start(); ?>

      <div class="mt-addons-skill-counter row">
        <?php if ($skillcounter_groups) { ?>
          <?php foreach ($skillcounter_groups as $param) {

            if ($page_builder == 'elementor' ) {
              if(!empty($param['use_img'])){ 
                $use_img = $param['use_img']['id'];
              }else{
                $use_img = $param['use_img'];
              }
            }
            if (!array_key_exists('tabs_item_service_icon_fa', $param)) {
              $tabs_item_service_icon_fa = '';
            }else{
              $tabs_item_service_icon_fa = $param['tabs_item_service_icon_fa'];
            }
            if ($page_builder == 'elementor') {
              if(!empty($tabs_item_service_icon_fa)){ 
                $icon = $tabs_item_service_icon_fa['value'];
              }
            }
            if ($page_builder == 'elementor') {
                $image_skillcounter = wp_get_attachment_image_src( $use_img, 'full' ); 
            }else{
                $image_skillcounter = wp_get_attachment_image_src( $param['use_img'], 'full' );
            }?>
          <div class="mt-addons-skill-counter-stats-block statistics <?php echo esc_attr($columns.' '.$extra_class.' '.$icon_position_style.' '.$border_left); ?> col-xs-6 ">
            <div class="mt-addons-skill-counter-stats-heading-img">
              <div class="mt-addons-skill-counter-choose-icon">
                <?php if($param['tabs_item_service_icon_dropdown'] == 'choosed_img'){ ?>
                  <img src="<?php echo esc_url($image_skillcounter[0]); ?>" alt="<?php echo esc_html__($param['title']); ?>"  />
                <?php } elseif($param['tabs_item_service_icon_dropdown'] == 'linecons'){
                    wp_enqueue_style( 'vc_linecons' );?>
                  <i style="font-size:<?php echo esc_attr($param['list_icon_size']); ?>px;color:<?php echo esc_attr($param['list_icon_color']); ?>" class="<?php echo esc_attr($param['tabs_item_service_icon__lineicons']); ?>"></i>
                <?php } elseif($param['tabs_item_service_icon_dropdown'] == 'choosed_fontawesome'){
                        wp_enqueue_style( 'vc_font_awesome_5' );?>
                  <?php if ($page_builder == 'elementor') { ?>
                    <i style="font-size:<?php echo esc_attr($param['list_icon_size']); ?>px;color:<?php echo esc_attr($param['list_icon_color']); ?>"class="<?php echo esc_attr($icon); ?>"></i>
                  <?php  } else{ ?>
                    <i style="font-size:<?php echo esc_attr($param['list_icon_size']); ?>px;color:<?php echo esc_attr($param['list_icon_color']); ?>"class="<?php echo esc_attr($param['tabs_item_service_icon_fa']); ?>"></i>

                  <?php } ?>
                <?php } ?>
              </div>
            </div>
            <div class="mt-addons-skill-counter-stats-content percentage <?php echo esc_attr($aligment);?>" data-perc="<?php echo esc_html__($param['skill_value']); ?>">
              <span class="mt-addons-skill-counter-value" style="font-size:<?php echo esc_attr($param['skill_size']); ?>px;color:<?php echo esc_attr($param['skill_color']); ?>"><?php echo esc_html__($param['skill_value']); ?>
              </span>
              <?php if(!empty($param['suffix'])){ ?>
              <span class="mt-addons-skill-counter-suffix"style="color:<?php echo esc_attr($param['skill_color']); ?>"><?php echo $param['suffix']; ?></span>
              <?php } ?>
              <?php if(!empty($param['title'])){ ?>
                <p class="mt-addons-skill-counter-title" style="color:<?php echo esc_attr($param['title_color']); ?>"><?php echo esc_html__($param['title']); ?>
                </p>
              <?php } ?>
            </div>
          </div>
        <?php  } ?>
        <?php } ?>
      </div>


    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-skill-counter', 'modeltheme_addons_for_wpbakery_skill_counter');

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Skill Counter", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-skill-counter",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/skill-counter.svg', __FILE__ ),
      "params" => array(
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Columns", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "columns",
          "value" => array(
            'Select Option'     => '',
            '1 Column'      => 'col-md-12',
            '2 Columns'     => 'col-md-6',
            '3 Columns'     => 'col-md-4',
            '4 Columns'     => 'col-md-3',
            '6 Columns'     => 'col-md-2'
          )
        ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Position", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "icon_pos",
          "value" => array(
            'Select'          => '',
            'Before Content'  => 'before-content',
            'Top Content'     => 'top-content'
          )
        ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Border", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "border_left",
          "value" => array(
            'Select'          => '',
            'Border left'  => 'mt-addons-border',
            'No border'     => ''
          )
        ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Aligment", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "aligment",
          "value" => array(
            'Select '    => '',
            'Left'       => 'text-left',
            'Center'     => 'text-center',
            'Right'      => 'text-right'
          )
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Extra Class", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "extra_class"
        ),
        array(
          'type' => 'param_group',
          'value' => '',
          'param_name' => 'skillcounter_groups',
          'params' => array(
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Icon library', 'modeltheme-addons-for-wpbakery' ),
              'value' => array(
                  'Font Awesome 5'  => 'choosed_fontawesome',
                  'Image' => 'choosed_img',
                  'Linecons' => 'linecons',
                  'No Icon'  => 'no_icon',
              ),
              'admin_label' => true,
              'param_name' => 'tabs_item_service_icon_dropdown',
              'description' => esc_html__( 'Select icon library.', 'modeltheme-addons-for-wpbakery' ),
            ),
            array(
              'type' => 'iconpicker',
              'heading' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
              'param_name' => 'tabs_item_service_icon_fa',
              'value' => 'fas fa-adjust',
              // default value to backend editor admin_label
              'settings' => array(
                  'emptyIcon' => false,
                  // default true, display an "EMPTY" icon?
                  'iconsPerPage' => 100,
                  // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
              ),
              'dependency' => array(
                  'element' => 'tabs_item_service_icon_dropdown',
                  'value' => 'choosed_fontawesome',
              ),
              'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'modeltheme' ),
                'param_name' => 'tabs_item_service_icon__lineicons',
                'value' => 'vc_li vc_li-heart',
                // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 1000,
                    // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'tabs_item_service_icon_dropdown',
                    'value' => 'linecons',
                    
                ),
                'description' => esc_html__( 'Select icon from library.', 'modeltheme-addons-for-wpbakery' ),
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__("Image", 'modeltheme-addons-for-wpbakery'),
                "param_name" => "use_img",
                'dependency' => array(
                  'element' => 'tabs_item_service_icon_dropdown',
                  'value' => 'choosed_img',
                ),
                "value" => esc_attr__("#", 'modeltheme-addons-for-wpbakery')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__("Icon Color", 'modeltheme-addons-for-wpbakery'),
                "param_name" => "list_icon_color"
            ),
            array(
              "type" => "vc_number",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Icon Size (px)", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "list_icon_size",
              "value" => "",
            ),
            array(
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Title", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "title",
            ),
            array(
              "type" => "colorpicker",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Title Color", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "title_color"
            ),
            array(
              "type" => "vc_number",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Skill value", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "skill_value",
            ),
            array(
              "type" => "colorpicker",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Skill Color", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "skill_color"
            ),
            array(
              "type" => "vc_number",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Skill Font Size", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "skill_size"
            ),
            array(
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Suffix", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "suffix"
            ),
            array(
              "type"      =>  "vc_number",
              "heading"     =>  esc_html__( 'Suffix Font Size', 'accordion' ),
              "param_name"  =>  "font_size",
              "description"   =>  esc_html__( 'in pixels', 'accordion' ),
              "value"     =>  "",
              "group"     =>  'Options',
            ),
          ),
        )
      )
  ));
}