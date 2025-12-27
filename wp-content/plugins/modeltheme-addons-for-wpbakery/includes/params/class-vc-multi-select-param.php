<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

if (!class_exists('Modeltheme_Addons_For_Wpbakery_Multi_Select_Param')) {
    class Modeltheme_Addons_For_Wpbakery_Multi_Select_Param {
        function __construct() {
            if (defined('WPB_VC_VERSION') && version_compare(WPB_VC_VERSION, 4.8) >= 0) {
                if (function_exists('vc_add_shortcode_param')) {
                    vc_add_shortcode_param('multi_select', array(&$this, 'multi_select'));
                }
            }
            else {
                if (function_exists('add_shortcode_param')) {
                    add_shortcode_param('multi_select', array(&$this, 'multi_select'));
                }
            }
        }

        function multi_select($param, $value) {

            $param_line = '';
            $param_line .= '<select multiple name="'. esc_attr( $param['param_name'] ).'" class="wpb_vc_param_value wpb-input wpb-select '. esc_attr( $param['param_name'] ).' '. esc_attr($param['type']).'">';
            foreach ( $param['value'] as $text_val => $val ) {
               if ( is_numeric($text_val) && (is_string($val) || is_numeric($val)) ) {
                            $text_val = $val;
                        }
                        $text_val = __($text_val, "modeltheme-addons-for-wpbakery");
                        $selected = '';

                        if(!is_array($value)) {
                            $param_value_arr = explode(',',$value);
                        } else {
                            $param_value_arr = $value;
                        }

                        if ($value!=='' && in_array($val, $param_value_arr)) {
                            $selected = ' selected="selected"';
                        }
                        $param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
                    }
            $param_line .= '</select>';
            return $param_line;
        }

    }
}


// Initialize Number Paramater Class
if (class_exists('Modeltheme_Addons_For_Wpbakery_Multi_Select_Param')) {
    new Modeltheme_Addons_For_Wpbakery_Multi_Select_Param();
}
