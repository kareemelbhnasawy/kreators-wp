<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_category_tabs($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'              => '',
      'category_tabs'             => '',
      'category'                  => '',
      'image'                     => '',
      'title'                     => '',
      'background_color'          => ''
    ), $params ) );
   
    wp_enqueue_style( 'category-tabs', plugins_url( '../../css/category-tabs.css' , __FILE__ ));
    wp_enqueue_script( 'category-tabs-js', plugins_url( '../../js/category-tabs.js' , __FILE__));

    if ($page_builder == 'elementor') {
      $category_tabs = unserialize(base64_decode($category_tabs));
    }else{
      if (function_exists('vc_param_group_parse_atts')) {
        $category_tabs = vc_param_group_parse_atts($params['category_tabs']);
      }
    }
    ob_start(); ?>
    <div class="mt-addons-category-tabs">
      <nav>
        <ul class="mt-addons-category-nav" style="background:<?php echo esc_attr($background_color);?>"> 
          <?php $tab_id = 1; ?>
          <?php if ($category_tabs) { ?>
            <?php foreach ($category_tabs as $tab) {

              if (!array_key_exists('title', $tab)) {
                $title = $tab['category'];
              }else{
                $title = $tab['title'];
              }
              if ($page_builder == 'elementor') {
                  $image = $tab['image']['id'];
                }else{
                  $image = $tab['image'];
                }
              $category_image = wp_get_attachment_image_src( $image, 'full' );
              ?>

              <li><a href="#mt-addons-section-<?php echo $tab_id;?>"> 
                <img class="mt-addons-icon" src="<?php echo esc_url($category_image[0]); ?>" alt="mt-addons-icon">
                <h5 class="mt-addons-title"><?php echo $title;?></h5>
              </a></li> 
              <?php $tab_id++; ?>
            <?php }
          }?>
        </ul>
      </nav>
      <div class="mt-addons-products-wrap">
        <?php $content_id = 1; ?>
        <?php if ($category_tabs) { ?>
          <?php foreach ($category_tabs as $tab) { ?>
            <?php $category = $tab['category']; ?>
            <section id="mt-addons-section-<?php echo $content_id;?>">
              <div class="row">
                <div class="col-md-12">
                  <?php echo do_shortcode('[product_category category="'.$category.'" columns="3" number_of_products_by_category="9"]') ?>
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
add_shortcode('mt-addons-category_tabs', 'modeltheme_addons_for_wpbakery_category_tabs');

add_action('init','mt_addons_category_tabs');
function mt_addons_category_tabs(){

if (function_exists('vc_map')) {

  $product_category = array();
   if ( class_exists( 'WooCommerce' ) ) {
    $product_category_tax = get_terms( 'product_cat', array(
      'parent'      => '0'
    ));
    if ($product_category_tax) {
      foreach ( $product_category_tax as $term ) {
        if ($term) {
          $product_category[$term->name] = $term->slug;
        }
      }
    }
  }

  $params = array(
    array(
      'type' => 'param_group',
      'value' => '',
      'param_name' => 'category_tabs',
      'params' => array(
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Category", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "category",
          "description" => esc_attr__("Select Category", 'modeltheme-addons-for-wpbakery'),
          "std" => 'Select',
          "value" => $product_category
        ),
        array(
          "type"         => "attach_image",
          "holder"       => "div",
          "class"        => "",
          "heading"      => esc_attr__( "Image", 'modeltheme-addons-for-wpbakery' ),
          "param_name"   => "image",
          "value"        => ""
        ),
        array(
          "type"         => "textfield",
          "holder"       => "div",
          "class"        => "",
          "param_name"   => "title",
          "heading"      => esc_attr__("Title", 'modeltheme-addons-for-wpbakery')
        ),
      ),
    ),
    array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => esc_attr__("Tab Backgroung (active)", 'modeltheme-addons-for-wpbakery'),
      "param_name" => "background_color"
    ),
  );

  vc_map(
    array(
      "name" => esc_attr__("MT: Category Tabs", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-category_tabs",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/category-tabs.svg', __FILE__ ),
      "params" => $params,
  ));
}}