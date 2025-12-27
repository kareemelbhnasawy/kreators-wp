<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_timeline($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'              => '',
      'title'                     => '',
      'description'               => '',
      'item_date'                 => '',
      'accordion_groups'          => '',
      'block_bg'                  => '#fff',
      'item_date_image'           => '',

      'title_color'               => '#222',
      'title_size'                => '34',
      'title_weight'              => '600',
      'title_line'                => '1.4',

      'desc_color'                => '',

      'line_status'               => ''
    ), $params ) );
    
   
    wp_enqueue_style( 'timeline', plugins_url( '../../css/timeline.css' , __FILE__ ));
    wp_enqueue_script( 'timeline', plugins_url( '../../js/timeline.js' , __FILE__));
    if ($page_builder == 'elementor') {
      $accordion_groups = unserialize(base64_decode($accordion_groups));
    }else{
        $accordion_groups = vc_param_group_parse_atts($params['accordion_groups']);
    }
    $line = '';
    if ($line_status == 'true') {
      $line = 'mt-addons-no-line';
    } else if ($line_status == 'false') {
      $line = '';
    }
    ob_start(); ?>
    <div class="mt-addons-timeline relative <?php echo esc_attr($line); ?>">
        <?php if ($accordion_groups) { ?>
          <?php foreach ($accordion_groups as $accordion) {
            if (!array_key_exists('title', $accordion)) {
              $title = '';
            }else{
              $title = $accordion['title'];
            }
            if (!array_key_exists('item_date', $accordion)) {
              $item_date = '';
            }else{
              $item_date = $accordion['item_date'];
            }
            // $item_date_image = '';
            // if (array_key_exists('item_date_image', $accordion)) {
            //   $item_date_image      = wp_get_attachment_image_src($accordion['item_date_image'], "full");
            // }
            $item_date_image = wp_get_attachment_image_src( $item_date_image, 'full' ); 
            
            if ($page_builder == 'elementor') {
              $item_date_image = $accordion['item_date_image']['id'];
            }else{
              if (!array_key_exists('item_date_image', $accordion)) {
                $item_date_image = '';
              }else{
                $item_date_image = $accordion['item_date_image'];
              }
            }
            $item_date_image = wp_get_attachment_image_src( $item_date_image, 'full' ); 

            ?>
          
            <div class="mt-addons-timeline-item">
              <?php if ($item_date_image) { ?>
                <div class="mt-addons-timeline-img">
                  <img src="<?php echo esc_url($item_date_image[0]); ?>" data-src="<?php echo esc_url($item_date_image[0]); ?>" alt="">
                </div>
              <?php } ?>
              <div class="mt-addons-timeline-content" style="background:<?php echo esc_attr($block_bg); ?>">
                <h3 class="mt-addons-timeline-title" style="color:<?php echo esc_attr($title_color); ?>;font-weight:<?php echo $title_weight; ?>;font-size:<?php echo $title_size; ?>px;line-height: <?php echo $title_line; ?>"><?php echo esc_attr($title); ?></h3>
                <p class="mt-addons-timeline-desc" style="color:<?php echo esc_attr($desc_color); ?>"><?php echo $accordion['description']; ?></p>
                <p class="mt-addons-timeline-date"><?php echo esc_attr($item_date); ?></p>
              </div>         
            </div>
          <?php } ?>
        <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-timeline', 'modeltheme_addons_for_wpbakery_timeline');

//VC Map
if (function_exists('vc_map')) {
      
  $params = array(
    array(
      "type" => "checkbox",
      "class" => "",
      "heading" => __( "Disable Vertical Line", "modeltheme-addons-for-wpbakery" ),
      "param_name" => "line_status"
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Block Background", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "block_bg"
    ),
    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'accordion_groups',
      'params' => array(
        array(
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Image", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "item_date_image",
          "value" => "",
          "description" => esc_attr__( "Choose image for timeline pin.", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Title", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "title",
        ),
        array(
          "type" => "textarea",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Description", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "description",
        ),
        array(
          "type"         => "textfield",
          "holder"       => "div",
          "class"        => "",
          "param_name"   => "item_date",
          "heading"      => esc_attr__("Item Date", 'modeltheme-addons-for-wpbakery'),
          "description"  => esc_attr__("Enter the date for current timeline item. Format example: 2017 November 15th", 'modeltheme-addons-for-wpbakery'),
        ),
      ),
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Title Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "title_color"
    ),
    array(
      "type" => "vc_number",
      "suffix" => "px",
      "group" => "Styling",
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
      "group" => "Styling",
      "class" => "",
      "heading" => esc_attr__( "Line height", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_line"
    ),
    array(
      "type" => "vc_number",
      "suffix" => "E.g.: 500",
      "group" => "Styling",
      "class" => "",
      "heading" => esc_attr__( "Font weight", 'modeltheme-addons-for-wpbakery' ),
      "param_name" => "title_weight"
    ),
    array(
      "group" => "Styling",
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Description Color", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "desc_color"
    ),
  );
  vc_map(
    array(
      "name" => esc_attr__("MT: Timeline", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-timeline",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/accordion.svg', __FILE__ ),
      "params" => $params,
  ));
}