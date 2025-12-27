<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_tabs($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'              => '',
      'category_tabs'             => '',
      'category'                  => '',
      'image'                     => '',
      'title'                     => '',
      'background_color'          => '',
      'tab_text'                  => '#222',
      'desc_title'                => '',
      'desc_content'              => '',
      'button_bg_color'           => '',
      'button_color'              => '',
      'button_url'                => ''
    ), $params ) );
   
    wp_enqueue_style( 'tabs-css', plugins_url( '../../css/tabs.css' , __FILE__ ));
    wp_enqueue_script( 'tabs-js', plugins_url( '../../js/tabs.js' , __FILE__));
    if ($page_builder == 'elementor') {
      $category_tabs = unserialize(base64_decode($category_tabs));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $category_tabs = vc_param_group_parse_atts($params['category_tabs']);
      }
    }
    
    ob_start(); ?>
    <div class="mt-addons-tabs">
      <nav>
        <ul class="mt-addons-tabs-nav" style="background:<?php echo esc_attr($background_color);?>"> 
          <?php $tab_id = 1; ?>
          <?php if ($category_tabs) { ?>
            <?php foreach ($category_tabs as $tab) {

              if (!array_key_exists('title', $tab)) {
                $title = '';
              }else{
                $title = $tab['title'];
              }
              if ($page_builder == 'elementor') {
                $image = $tab['image']['id'];
                $url_link = $tab['title'];
              }else{
                if (!array_key_exists('image', $tab)) {
                  $image = '';
                }else{
                  $image = $tab['image'];
                }
                // if (!array_key_exists('image', $tab)) {
                //   $image = '';
                // }else{
                //   $image = $tab['image'];
                // }

               
             
              }
              
              $category_image = wp_get_attachment_image_src($image, 'full' );
              ?>  
              <li><a href="#section-iconbox-<?php echo $tab_id;?>"> 
                <img class="mt-addons-tabs-nav-icon" src="<?php echo esc_url($category_image[0]); ?>" alt="mt-addons-icon">
                <h5 class="mt-addons-tabs-nav-title" style="color:<?php echo esc_attr($tab_text); ?>;"><?php echo $title;?></h5>
              </a></li> 
              <?php $tab_id++; ?>
            <?php }
          }?>
        </ul>
      </nav>
      <div class="mt-addons-tab-content">
        <?php $content_id = 1; ?>
        <?php if ($category_tabs) { ?>
          <?php foreach ($category_tabs as $tab) { 

            if (!array_key_exists('desc_title', $tab)) {
                $desc_title = '';
            }else{
                $desc_title = $tab['desc_title'];
            }
            if (!array_key_exists('desc_content', $tab)) {
                $desc_content = '';
            }else{
                $desc_content = $tab['desc_content'];
            }
            if (!array_key_exists('button_bg_color', $tab)) {
                $button_bg_color = '#222';
            }else{
                $button_bg_color = $tab['button_bg_color'];
            }
            if (!array_key_exists('button_color', $tab)) {
                $button_color = '#fff';
            }else{
                $button_color = $tab['button_color'];
            }
            if ($page_builder == 'elementor') {
              $desc_image = $tab['desc_image']['id'];
              $url_link = $tab['button_url'];

            }else{
              if (!array_key_exists('image', $tab)) {
                $image_id = '';
              }else{
                $image_id = $tab['image'];
              }
              if (!array_key_exists('image', $tab)) {
                $desc_image = '';
              }else{
                $desc_image = $tab['image'];
              }

              
              if (!array_key_exists('button_url', $tab)) {
                $url_link = '';
              }else{
                $link = vc_build_link($tab['button_url']);
                $url_link = $link['url'];
              }

            }

            // if(!empty($tab['desc_image'])) {
            //   $description_image = wp_get_attachment_image_src( $tab['desc_image'], 'full' );
            // } else {
            //   $description_image = ' ';
            // }
              // $description_image = wp_get_attachment_image_src( $tab['desc_image'], 'full' );
              $description_image = wp_get_attachment_image_src($desc_image, 'full' );

            ?>
            <section id="section-iconbox-<?php echo $content_id;?>">
              <div class="row">
                <div class="col-md-6 text-center">
                    <img class="mt-addons-tab-content-image" src="<?php echo esc_url($description_image[0]); ?>" alt="tabs-image">
                </div>
                <div class="col-md-6 text-left">
                    <h3 class="mt-addons-tab-content-title"><?php echo $desc_title; ?></h3>
                    <p class="mt-addons-tab-content"><?php echo $desc_content; ?></p>
                     <?php if($url_link != ''){ ?>
                      <?php if ($page_builder == 'elementor') { ?>

                      <a class="mt-addons-tab-content-button"style="        
                      background-color: <?php echo esc_attr($button_bg_color); ?>; color: <?php echo esc_attr($button_color); ?>;"
                      href="<?php echo esc_url($url_link); ?>" >
                         <?php echo esc_html($tab['button_text']); ?>
                      </a>
                    <?php }else{ ?>

                      <a class="mt-addons-tab-content-button"style="        
                      background-color: <?php echo esc_attr($button_bg_color); ?>; color: <?php echo esc_attr($button_color); ?>;"
                      href="<?php echo esc_url($url_link['url']); ?>" >
                         <?php echo esc_html($tab['title']); ?>
                      </a>
                     <?php } ?>
                     <?php } ?>



                </div>
              </div>                     
            </section>
            <?php $content_id++; ?>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-tabs', 'modeltheme_addons_for_wpbakery_tabs');

if (function_exists('vc_map')) {
  $params = array(
    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'category_tabs',
      // Note params is mapped inside param-group:
      'params' => array(
        array(
          "type"         => "attach_image",
          "holder"       => "div",
          "class"        => "",
          "heading"      => esc_attr__( "Tab Icon", 'modeltheme-addons-for-wpbakery' ),
          "param_name"   => "image",
          "value"        => ""
        ),
        array(
          "type"         => "textfield",
          "holder"       => "div",
          "class"        => "",
          "param_name"   => "title",
          "heading"      => esc_attr__("Tab Title", 'modeltheme-addons-for-wpbakery')
        ),
        array(
          "type"         => "attach_image",
          "holder"       => "div",
          "class"        => "",
          "heading"      => esc_attr__( "Description Image", 'modeltheme-addons-for-wpbakery' ),
          "param_name"   => "desc_image",
          "value"        => ""
        ),
        array(
          "type"         => "textfield",
          "holder"       => "div",
          "class"        => "",
          "heading"      => esc_attr__( "Description Title", 'modeltheme-addons-for-wpbakery' ),
          "param_name"   => "desc_title",
          "value"        => ""
        ),
        array(
          "type"         => "textarea",
          "holder"       => "div",
          "class"        => "",
          "heading"      => esc_attr__( "Description Content", 'modeltheme-addons-for-wpbakery' ),
          "param_name"   => "desc_content",
          "value"        => ""
        ),
        array(
          "type" => "vc_link",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Button URL", "modeltheme-addons-for-wpbakery"),
          "param_name" => "button_url",
          "value" => esc_attr__("#", "modeltheme-addons-for-wpbakery")
        ),
        array(
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Button Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Button Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "button_color"
        ),
        array(
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Background Color", "modeltheme-addons-for-wpbakery"),
          'description' => __( 'Select Background Color.', "modeltheme-addons-for-wpbakery" ),
          "param_name" => "button_bg_color"
        ),
      ),
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Tab Background (active)", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "background_color"
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Tab Text Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "tab_text"
    ),
  );

  vc_map(
    array(
      "name" => esc_attr__("MT: Tabs", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-tabs",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/tabs.svg', __FILE__ ),
      "params" => $params,
  ));
}