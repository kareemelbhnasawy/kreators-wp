<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

// Usage: font-awesome
// array(
//     "heading" => esc_attr__("Alignment", "modeltheme-addons-for-wpbakery"),
//     "type" => "mt_radio",
//     "group" => "Options",
//     "radio-type" => "fa-icon",
//     "param_name" => "alignment",
//     "value" => array(
//         '<i class="fas fa-align-left"></i>'  => 'text-left',
//         '<i class="fas fa-align-center"></i>'  => 'text-center',
//         '<i class="fas fa-align-right"></i>'  => 'text-right',
//     ),
// ),

// Usage: image/svg
// array(
//     "heading" => esc_attr__("Alignment", "modeltheme-addons-for-wpbakery"),
//     "type" => "mt_radio",
//     "radio-type" => "image",
//     "group" => "Options",
//     "param_name" => "alignment",
//     "value" => array(
//         'https://picsum.photos/id/237/200/300'  => 'text-left',
//         'https://picsum.photos/seed/picsum/200/300'  => 'text-center',
//         'https://picsum.photos/200/300?grayscale'  => 'text-right',
//     ),
// ),

// Usage: text
// array(
//     "heading" => esc_attr__("Alignment", "modeltheme-addons-for-wpbakery"),
//     "type" => "mt_radio",
//     "radio-type" => "text",
//     "group" => "Options",
//     "param_name" => "alignment",
//     "value" => array(
//         'Text left'  => 'text-left',
//         'Text center'  => 'text-center',
//         'Text right'  => 'text-right',
//     ),
// ),


if (!class_exists('Modeltheme_Addons_For_Wpbakery_Radio')) {
    class Modeltheme_Addons_For_Wpbakery_Radio {
        function __construct() {
            if (defined('WPB_VC_VERSION') && version_compare(WPB_VC_VERSION, 4.8) >= 0) {
                if (function_exists('vc_add_shortcode_param')) {
                    vc_add_shortcode_param('mt_radio', array(&$this, 'radio_field'));
                }
            }
            else {
                if (function_exists('add_shortcode_param')) {
                    add_shortcode_param('mt_radio', array(&$this, 'radio_field'));
                }
            }
        }

        function radio_field($settings, $value) {

            $defaults = array(
                'param_name' => '',
                'radio-type' => 'text', //(image, text, fa-icon)
                'type' => '',
                'max-width' => 'none',
                'value' => 0,
            );
            $settings = wp_parse_args($settings, $defaults);

            if(!empty($value)){
                $hval = $value;
            }else{
                $hval = '';
            }

            // output
            $output = '';
            $output .= '<div class="mt-addons-image-radio-param-holder">';
                $output .= '<input type="hidden" value="'.$hval.'" id="mt_addons'.$settings['param_name'].'" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input">';
                foreach($settings['value'] as $key => $p){
                    if($value==$p){
                        $checked = ' checked="checked"';
                    }else{
                        $checked = '';
                    }
                    $output .= '<div class="mt-addons-image-radio-item">';
                        $output .= '<label for="'.$settings['param_name'].$p.'">';
                            $output .= '<input type="radio" name="mt_addons'.$settings['param_name'].'" id="'.$settings['param_name'].$p.'" value="'.$p.'" class="mt-addons-radio'.$settings['param_name'].'" '.$checked.' />';
                            
                            if ($settings['radio-type'] == 'text') {
                                $output .= '<span>'.$key.'</span>';
                            }elseif ($settings['radio-type'] == 'image') {
                                $output .= '<img width="'.$settings['max-width'].'" src="'.$key.'" alt="'.$settings['param_name'].'" />';
                            }elseif ($settings['radio-type'] == 'fa-icon') {
                                $output .= $key;
                            }
                        $output .= '</label>';
                    $output .= '</div>';
                }
            $output .= '</div>';

            // js
            $output .= '<script>
                        jQuery(".mt-addons-radio'.$settings['param_name'].'").change(function(){
                            var s = jQuery(this).val();
                            jQuery("#mt_addons'.$settings['param_name'].'").val(s);
                        });
                    </script>';

            return $output;
        }

    }
}


// Initialize Number Paramater Class
if (class_exists('Modeltheme_Addons_For_Wpbakery_Radio')) {
    new Modeltheme_Addons_For_Wpbakery_Radio();
}
