<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * @author Cristi
 */
function modeltheme_addons_for_wpbakery_posts_az( $params, $content = null ) {
  extract( 
    shortcode_atts(
      array(
        'page_builder'         =>'',
        'post_types'           =>'',
        'excluded_ids'         =>'',
        'az_letters_color'     =>'',
        'title_background'     =>'',
        'title_color'          =>'',
        'alignment'            =>'text-left',
      ), 
      $params
    ) 
  );
 
  wp_enqueue_style( 'mt-posts-a-z', plugins_url( '../../css/posts-a-z.css' , __FILE__ ));

  $post_types = explode(',', $post_types);
  $exclude = explode(',', $excluded_ids);

  $sorted = array();
  $args_listings = array(
    'numberposts' => -1,
    'orderby'          => 'title',
    'order'            => 'ASC',
    'post_type'        => $post_types[0],
    'post_status'      => 'publish',
    'exclude'          => $exclude,
  );

  $posts = get_posts( $args_listings );
  foreach ( $posts as $post ) {
    setup_postdata( $post );
    $name = strtolower( $post->post_title );
    if ($name) {
      $char = $name[0];
      if ( ! isset( $sorted[ $char ] ) ) {
        $sorted[ $char ] = array();
      }
      $sorted[ $char ][$post->ID] = $post->post_title;
    }
  }
  ksort( $sorted );

  ob_start(); ?>
  <div class="modeltheme-addons-posts-a-z-shortcode <?php echo esc_attr($alignment); ?>">
    <?php foreach ( $sorted as $character => $listings ) { ?>
      <span class="modeltheme-addons-posts-a-z-first-letter" style="color: <?php echo esc_html($az_letters_color); ?>"><?php echo $character; ?></span></br>
      <ul class="modeltheme-addons-posts-a-z-listings-list">
        <?php foreach ( $listings as $listing_id => $listing ) { ?>
          <li style="background: <?php echo esc_html($title_background); ?>"><a style="color: <?php echo esc_html($title_color); ?>" href="<?php echo esc_url(get_permalink($listing_id)); ?>" title="<?php echo esc_attr($listing); ?>"><?php echo esc_html($listing); ?></a></li>
        <?php } ?>
      </ul>
    <?php } ?>
    <?php wp_reset_postdata(); ?>
  </div>

  <?php 
  return ob_get_clean();
}
add_shortcode('mt-addons-posts-az', 'modeltheme_addons_for_wpbakery_posts_az');


if ( function_exists('vc_map') ) {
  add_action( 'init', 'mt_addons_posts_az_vc_map');
  function mt_addons_posts_az_vc_map(){

    $all_posts = modeltheme_addons_posts_array('page');

    vc_map( array(
      "name" => esc_attr__("MT: Posts A-Z", "modeltheme-addons-for-wpbakery"),
      "base" => "mt-addons-posts-az",
      "icon" => plugins_url( 'images/blog.svg', __FILE__ ),
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "params" => array(
        array(
          "heading" => __( "Select Post Type", "modeltheme-addons-for-wpbakery" ),
          "type" => "posttypes",
          "class" => "",
          "param_name" => "post_types",
          "description" => __( "Only Choose one. If more than one are selected, the A-Z list will only show posts from the 1st selected type.", "modeltheme-addons-for-wpbakery" ),
        ),
        array(
          "heading" => __( "Exclude Items from the list", "modeltheme-addons-for-wpbakery" ),
          "type" => "multi_select",
          "class" => "",
          "param_name" => "excluded_ids",
          "value" => $all_posts,
        ),
        array(
          "heading" => __( "Aligment", "modeltheme-addons-for-wpbakery" ),
          "type" => "dropdown",
          "class" => "",
          "param_name" => "alignment",
          "value" => array(
              'Select Option' => '',
              'Left'          => 'text-left',
              'Center'        => 'text-center',
              'Right'         => 'text-right',
          ),
        ),
        array(
          "heading" => __("A-Z Letters Color", 'modeltheme-addons-for-wpbakery'),
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "param_name" => "az_letters_color"
        ),
        array(
          "heading" => __("Title Background", 'modeltheme-addons-for-wpbakery'),
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "param_name" => "title_background"
        ),
        array(
          "heading" => __("Title Color", 'modeltheme-addons-for-wpbakery'),
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "param_name" => "title_color"
        ),
      )
    ));
  }
}