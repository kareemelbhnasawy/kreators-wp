<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_products_banner($params, $content) {
    extract( shortcode_atts( 
        array(
            'page_builder'                         => '',
            'number'                               => '',
            'number_of_products_by_category'       => '4',
            'number_of_columns'                    => '2',
            'button_text'                          => '',
            'products_label_text'                  => '',
            'category'                             => '',
            'overlay_color1'                       => '#000',
            'overlay_color2'                       => '#888',
            'bg_image'                             => '',
            'products_layout'                      => '',
            'styles'                               => '',
            'button_style'                         => 'rounded',
            'banner_pos'                           => ''
        ), $params ) );
    wp_enqueue_style( 'products-category-banner-css', plugins_url( '../../css/products-category-banner.css' , __FILE__ ));
    if (isset($bg_image) && !empty($bg_image)) {
        $bg_image = wp_get_attachment_image_src($bg_image, "full");
    }

    $category_style_bg = '';
    if (isset($bg_image) && !empty($bg_image)) {
        $category_style_bg .= 'background: url('.$bg_image[0].') no-repeat center center;';
    }else{
        $category_style_bg .= 'background: radial-gradient('.$overlay_color1.','.$overlay_color2.');';
    }

    if ($button_text) {
        $button_text_value = $button_text;
    }else{
        $button_text_value = __('View All Items', 'modeltheme-addons-for-wpbakery');
    }

    if ($products_label_text) {
        $products_label_text_value = $products_label_text;
    }else{
        $products_label_text_value = __('Products', 'modeltheme-addons-for-wpbakery');
    }


    $cat = get_term_by('slug', $category, 'product_cat');

    if (isset($products_layout)) {
        if ($products_layout == '' || $products_layout == 'image_left') {
            if( $styles == '' || $styles == "style_1") {
                $block_type = 'mt-addons-banner-simple';
            }elseif($styles == "style_2") {
                $block_type = 'mt-addons-banner-styled';
            }
        }elseif($products_layout == 'image_top'){
            $block_type = 'mt-addons-banner-simple-top';
        }
    }else{
        $block_type = 'mt-addons-banner-simple';
    }


    if ($cat) {
    ob_start(); ?>
      <div class="<?php echo esc_attr($block_type);?>">
        <div class="mt-addons-product-category">
          <div class="mt-addons-banner col-md-3 <?php echo esc_attr($banner_pos);?>">
            <div style="<?php echo esc_attr($category_style_bg);?>" class="mt-addons-banner-wrapper">
              <a class="#categoryid_<?php echo esc_attr($cat->term_id);?>"><span class="mt-addons-banner-title"><?php echo esc_attr($cat->name);?></span></a><br>
              <span class="mt-addons-banner-subtitle"><strong><?php echo esc_attr($cat->count);?></strong><?php echo esc_html($products_label_text_value);?></span><br>
              <div class="mt-addons-banner-button <?php echo esc_attr($button_style);?>">
                <a href="<?php echo esc_attr(get_term_link($cat->slug, 'product_cat'));?>" class="button" title="<?php echo esc_html__('View more', 'modeltheme-addons-for-wpbakery');?>" ><span><?php echo esc_attr($button_text_value);?></span></a>
              </div>
            </div>    
          </div>
          <div id="categoryid_<?php echo esc_attr($cat->term_id);?>" class="col-md-9 mt-addons-products <?php echo esc_attr($cat->name);?>"><?php echo do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]');?></div>
        </div>
      </div>
      <div class="clearfix"></div>
    <?php }
    return ob_get_clean();
}
add_shortcode('mt-addons-products-category-banner', 'modeltheme_addons_for_wpbakery_products_banner');

add_action('init','mt_addons_category_banner');
function mt_addons_category_banner(){

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

      vc_map(
        array(
          "name" => esc_attr__("MT: Products with Category Banner", 'modeltheme-addons-for-wpbakery'),
          "base" => "mt-addons-products-category-banner",
          "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
          "icon" => plugins_url( 'images/Products_Category_Image.svg', __FILE__ ),
          "params" => array(
            array(
              "group" => "Products",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Category", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "category",
              "description" => esc_attr__("Select WooCommerce Category", 'modeltheme-addons-for-wpbakery'),
              "std" => 'Select',
              "value" => $product_category
            ),
            array(
              "group" => "Products",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Styles", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "styles",
              "std" => 'rounded',
              "value" => array(
                'Select '        => '',
                'Style 1'        => 'style_1',
                'Style 2'        => 'style_2'
              ),
            ),
            array(
              "group" => "Products",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Layout", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "products_layout",
              "value" => array(
                'Select Layout'        => '',
                'Image Left'           => 'image_left',
                'Image Top'            => 'image_top'
              ),
            ),
            array(
              "group" => "Products",
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Number", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "number_of_products_by_category"
            ),
            array(
              "group" => "Products",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Per column", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "number_of_columns",
              "std" => '2',
              "value" => array(
                'Select'   => '',
                '1'        => '1',
                '2'        => '2',
                '3'        => '3',
                '4'        => '4'
              ),
            ),
            array(
              "group" => "Banner",
              "type" => "colorpicker",
              "class" => "",
              "heading" => esc_attr__( "Background Color 1", 'modeltheme-addons-for-wpbakery' ),
              "param_name" => "overlay_color1"
            ),
            array(
              "group" => "Banner",
              "type" => "colorpicker",
              "class" => "",
              "heading" => esc_attr__( "Background Color 2", 'modeltheme-addons-for-wpbakery' ),
              "param_name" => "overlay_color2"
            ),
            array(
              "type" => "attach_image",
              "group" => "Banner",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__( "Background Image (Optional)", 'modeltheme-addons-for-wpbakery' ),
              "description" => esc_attr__("If this option is empty, the colors from colorpickers will be applied.", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "bg_image",
            ),
            array(
              "group" => "Banner",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Position", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "banner_pos",
              "std" => '',
              "value" => array(
                'Select '     => '',
                'Left'        => '',
                'Right'       => 'float-right'
              ),
            ),
            array(
              "group" => "Banner",
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Replace 'Products' label", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "products_label_text"
            ),
            array(
              "group" => "Button",
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Text", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "button_text"
            ),   
            array(
              "group" => "Button",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Style", 'modeltheme-addons-for-wpbakery'),
              "param_name" => "button_style",
              "std" => 'rounded',
              "value" => array(
                'Select Layout'     => '',
                'Rounded'           => 'rounded',
                'Rectangle'         => 'boxed'
              )
            )     
          )
      ));
  }
}