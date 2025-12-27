<?php
/*
 Project author:     ModelTheme
 File name:          Custom Popup
*/

defined( 'ABSPATH' ) || exit;

if ( !function_exists( 'faimos_popup_modal' ) ) {
    function faimos_popup_modal() { 
        // REDUX VARIABLE
        global $faimos_redux;
        $user_url = get_permalink( get_option('woocommerce_myaccount_page_id') );
        echo'<div class="popup modeltheme-modal" id="modal-log-in" data-expire="'.esc_attr($faimos_redux['faimos-enable-popup-expire-date']).'" show="'.esc_attr($faimos_redux['faimos-enable-popup-show-time']).'">
            
            <div class="mt-popup-wrapper col-md-12" id="popup-modal-wrapper">
                <div class="dismiss">
                <a id="exit-popup"></a>
            </div>
                <div class="mt-popup-image col-md-4">
                    <img src="'.esc_url($faimos_redux['faimos-enable-popup-img']['url']).'" alt="'.esc_attr(get_bloginfo()).'" />
                </div>
                <div class="mt-popup-content col-md-8 text-center">
                    <img src="'.esc_url($faimos_redux['faimos-enable-popup-company']['url']).'" alt="'.esc_attr(get_bloginfo()).'" />';
                    if($faimos_redux['faimos-enable-popup-desc']) {
                        echo '<p class="mt-popup-desc">'.esc_attr($faimos_redux['faimos-enable-popup-desc']).'</p>';
                    }
                    echo '<p class="mt-popup-desc">'.do_shortcode(''.$faimos_redux["faimos-enable-popup-form"].'').'</p>';
                    if($faimos_redux['faimos-enable-popup-additional'] == false) {

                        echo '<p class="mt-additional">'.esc_html__('Already a member?','faimos').' <a href="'.$user_url.'">'.esc_html__('Log In.','faimos').'</a></p>';
                    }
                echo '</div>          
            </div>
        </div>';
    }
}
?>