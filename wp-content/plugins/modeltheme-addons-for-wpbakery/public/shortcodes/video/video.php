<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_video($params, $content) {
  extract( shortcode_atts( 
    array(
      'source_vimeo'              => '',
      'source_youtube'            => '',
      'video_source'              => '',
      'vimeo_link_id'             => '',
      'youtube_link_id'           => '',
      'button_image'              => '',
      'image_position'            => 'text-center'

    ), $params ) );
   
    wp_enqueue_style( 'video', plugins_url( '../../css/video.css' , __FILE__ ));
    wp_enqueue_style( 'magnific-popup', plugins_url( '../../css/plugins/magnific-popup/magnific-popup.css' , __FILE__ ));
    wp_enqueue_script( 'magnific-popup', plugins_url( '../../js/plugins/magnific-popup/magnific-popup.js' , __FILE__));
    $typed_unique_id = 'mt_addons_typed_text_'.uniqid();

    ob_start(); 

    $img      = wp_get_attachment_image_src($button_image, "full");

    ?>

    <script>
      jQuery(document).ready(function() {
        jQuery(".mt-addons-video-popup-vimeo-video").magnificPopup({
          type:"iframe",
          disableOn: 700,
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
        });
        jQuery(".mt-addons-video-popup-vimeo-youtube").magnificPopup({
          type:"iframe",
          disableOn: 700,
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
        });
      });
    </script>
    <div class="mt-addons-video <?php echo esc_attr($image_position);?>">
      <?php if($video_source == 'source_vimeo') { ?>
        <a class="mt-addons-video-popup-vimeo-video" href="https://vimeo.com/<?php echo esc_attr($vimeo_link_id); ?>"><img class="mt-addons-video-buton-image" src="<?php echo esc_url($img[0]); ?>" data-src="<?php echo esc_url($img[0]); ?>" alt=""></a>
      <?php } elseif($video_source == 'source_youtube'){ ?>

        <a class="mt-addons-video-popup-vimeo-youtube" href="https://www.youtube.com/watch?v=<?php echo esc_attr($youtube_link_id); ?>"><img class="mt-addons-video-buton-image" src="<?php echo esc_url($img[0]); ?>" data-src="<?php echo esc_url($img[0]); ?>" alt="<?php echo esc_html__('Video', 'modeltheme-addons-for-wpbakery'); ?>"></a>
        <?php }?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-video', 'modeltheme_addons_for_wpbakery_video');

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Video", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-video",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/video-popup.svg', __FILE__ ),
      "params" => array(
        array(
          "type" => "attach_image",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Choose image", 'modeltheme-addons-for-wpbakery' ),
          "param_name" => "button_image",
          "value" => "",
          "description" => esc_attr__( "Choose image for play button", 'modeltheme-addons-for-wpbakery' )
        ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Image Position"),
          "param_name" => "image_position",
          "std" => '',
          "value" => array(
          'Select Option' => '',
            'Left'   => 'text-left',
            'Center' => 'text-center',
            'Right'  => 'text-right',
          )
        ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Video source"),
          "param_name" => "video_source",
          "std" => '',
          "value" => array(
          'Select Option' => '',
            'Youtube'   => 'source_youtube',
            'Vimeo'     => 'source_vimeo',
          )
        ),
        array(
          "dependency" => array(
            'element' => 'video_source',
            'value' => array( 'source_vimeo' ),
          ),
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Vimeo id link", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "vimeo_link_id",
          "description" => ""
        ),
        array(
          "dependency" => array(
            'element' => 'video_source',
            'value' => array( 'source_youtube' ),
          ),
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Youtube id link", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "youtube_link_id",
          "description" => ""
        ),
      )
  ));
}