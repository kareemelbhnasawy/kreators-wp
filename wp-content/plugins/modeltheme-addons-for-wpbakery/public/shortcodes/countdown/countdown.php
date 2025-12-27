<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_countdown($params, $content) {
  extract( shortcode_atts( 
    array(
      'insert_date'                => '',
      'digit_color'                => '',
      'text_color'                 => '',
      'dots_color'                 => '',
      'background_color_count'     => ''
    ), $params ) );
   
    wp_enqueue_style( 'mt-countdown', plugins_url( '../../css/countdown.css' , __FILE__ ));
    wp_enqueue_script( 'mt-countdown', plugins_url( '../../js/plugins/countdown/jquery.countdown.js' , __FILE__));

    ob_start(); ?>
    <div >
      <div class="mt-addons-countdown"style="background-color:<?php echo esc_attr($background_color_count); ?>" >
      </div>
    </div>
    <script type="text/javascript">
      jQuery( document ).ready(function() {
        jQuery(".mt-addons-countdown").countdown("<?php echo esc_attr($insert_date); ?>", function(event) {
          jQuery(this).html(
            event.strftime("<div class=\'days\'><div class=\'days-digit\' style=\'color:<?php echo $digit_color; ?>\'>%D</div><div class=\'clearfix\'></div><div class=\'days-name\' style=\'color:<?php echo $text_color;?>\'>days</div></div><span style=\'color:<?php echo $dots_color; ?>\'>&middot;</span><div class=\'hours\'><div class=\'hours-digit\'  style=\'color:<?php echo $digit_color; ?>\'>%H</div><div class=\'clearfix\'></div><div class=\'hours-name\'style=\'color:<?php echo $text_color;?>\'>hours</div></div><span style=\'color:<?php echo $dots_color; ?>\'>&middot;</span><div class=\'minutes\'><div class=\'minutes-digit\' style=\'color:<?php echo $digit_color; ?>\'>%M</div><div class=\'clearfix\'></div><div class=\'minutes-name\' style=\'color:<?php echo $text_color; ?>\'>minutes</div></div><span style=\'color:<?php echo $dots_color; ?>\'>&middot;</span><div class=\'seconds\'><div class=\'seconds-digit\' style=\'color:<?php echo $digit_color; ?>\'>%S</div><div class=\'clearfix\'></div><div class=\'seconds-name\' style=\'color:<?php echo $text_color; ?>\'>seconds</div></div>")
          ); 
        });
      });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-countdown', 'modeltheme_addons_for_wpbakery_countdown');

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Countdown", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-countdown",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/countdown.svg', __FILE__ ),
      "params" => array(
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Date", 'modeltheme-addons-for-wpbakery'),
          "param_name" => "insert_date",
          "value" => esc_attr__("", 'modeltheme-addons-for-wpbakery'),
          "description" => "Insert date. Format:YYYY-MM-DD"
        ),
        array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Background color", 'modeltheme-addons-for-wpbakery'),
           "param_name" => "background_color_count",
           "value" => "#FBFBFB"
        ),
        array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Color of the digits", 'modeltheme-addons-for-wpbakery'),
           "param_name" => "digit_color",
           "value" => "#495153"
        ),
        array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Color of the text", 'modeltheme-addons-for-wpbakery'),
           "param_name" => "text_color",
           "value" => "#848685"
        ),
        array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Color of the dots", 'modeltheme-addons-for-wpbakery'),
           "param_name" => "dots_color",
           "value" => "#48A8A7"
        ),
      )
  ));
}