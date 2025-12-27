<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

// Class & ID vc_map fields
if (!function_exists('modeltheme_addons_extras_vc_fields')) {
  function modeltheme_addons_extras_vc_fields(){
    $extras_vc_fields = array(
      array(
        "group" => "Extras",
        "type" => "textfield",
        "heading" => __("Extra Class", "modeltheme-addons-for-wpbakery"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme-addons-for-wpbakery")
      ),
      array(
        "group" => "Extras",
        "type" => "textfield",
        "heading" => __("Extra ID", "modeltheme-addons-for-wpbakery"),
        "param_name" => "el_custom_id",
        "description" => __("If you wish to style particular content element differently, then use this field to add an ID and then refer to it in your css file.", "modeltheme-addons-for-wpbakery")
      ) 
    );

    return $extras_vc_fields;
  }
}

/**
 * Get array of all pages from the site sort asc by name
 * Use for any CPT -> modeltheme_addons_posts_array('page') modeltheme_addons_posts_array('product') etc
 * @param $post_type string (CTP - page, post, cpt name...etc)
 * @return array of posts titles and ids
 */ 
function modeltheme_addons_posts_array($post_type = ''){

  $items_array = array();

    $args = array(
      'numberposts' => -1,
      'sort_order' => 'asc',
      'post_status'   => 'publish',
      'post_type'   => $post_type
    );
     
    $all_posts = get_posts( $args );
    if ($all_posts) {
      foreach($all_posts as $post){
        $title = esc_html(get_the_title($post->ID));
        $items_array[$title] = $post->ID;
      }
    }

  // Sort alphabetically
  ksort($items_array);

  return $items_array;
}


/**
 * Get array of all pages from the site sort asc by name
 * Use for any CPT -> modeltheme_addons_posts_array('page') modeltheme_addons_posts_array('product') etc
 * @param $post_type string (CTP - page, post, cpt name...etc)
 * @return array of posts titles and ids
 */ 
function modeltheme_addons_image_sizes_array(){

  $items_array = array();

    $all_image_sizes = get_intermediate_image_sizes();

    if ($all_image_sizes) {
      foreach($all_image_sizes as $image_size){
        $items_array[$image_size] = $image_size;
      }
    }

  // Sort alphabetically
  // ksort($items_array);

  return $items_array;
}
