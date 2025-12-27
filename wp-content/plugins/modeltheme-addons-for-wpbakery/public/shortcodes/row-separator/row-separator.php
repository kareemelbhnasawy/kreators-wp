<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * @author Andreea
 */
function modeltheme_addons_for_wpbakery_row_separator( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'css'  => '',
            'bg_color'  => '',
            'clouds_position'  => '',
            'content_svg'      => '',
            'image'           => '',
            'custom_separator' => ''
        ), $params ) );

    
    wp_enqueue_style( 'mt-row-separator', plugins_url( '../../css/row-separator.css' , __FILE__ ));
    
    ob_start(); 
    $image = wp_get_attachment_image_src($image, "full");

    ?>


    <div class="modeltheme-addons-row-separator" style="overflow:hidden;">
        <?php if($clouds_position == 'top-left'){ ?>
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="2116.000000pt" height="133.000000pt" viewBox="0 0 2116.000000 133.000000" preserveAspectRatio="xMidYMid meet">
                <g transform="translate(0.000000,133.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                <path class="st0" style= "fill:<?php echo esc_attr($bg_color); ?>" d="M60 1326 c0 -8 228 -141 355 -207 356 -186 686 -267 968 -239 151 15
                294 48 543 126 400 125 576 161 844 171 456 16 987 -106 1606 -371 71 -31 142 -56 158 -56 15 0 173 16 350 35 850 92 1666 154 2591 197 369 17 1816 17 2150 0 894 -47 1632 -129 2265 -254 133 -26 242 -43 285 -42 39 0 194 14 345 32 609 70 1024 96 1570 96 942 0 1628 -98 2440 -349 443 -136 797 -213 1194 -259 l130 -15 305 203 c852 568 1419 835 1816 853 284 13 430 -79 570 -357 79 -157 120 -194 195 -171 68 20 156 89 289 227 l131 136 0 124 0 124 -10550 0 c-5802 0 -10550 -2 -10550 -4z"/>
                </g>
            </svg>
        <?php } else if($clouds_position == 'top-right') { ?>
            <svg version="1.1" id="mt_svg_cloud" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 417.9 78.2" style="enable-background:new 0 0 417.9 78.2;" xml:space="preserve">
                <path class="st0" style= "fill:<?php echo esc_attr($bg_color); ?>" d="M0,27.9V0h417.9v27.5c-1.2,0.4-2.6,0.6-3.9,0.8c-5,7.4-13.5,12.2-23.1,12.2c-6,0-11.6-1.9-16.2-5.2
                    c-3.8,2.8-8.4,4.4-13.4,4.4c-1.5,0-3-0.1-4.5-0.4c-4.8,8.3-13.8,13.9-24,13.9c-10.2,0-19.1-5.5-23.9-13.6c-2.1,0.6-4.3,1-6.7,1
                    c-5.2,0-10-1.7-13.9-4.6c-3.4,2.4-7.5,3.9-12,4.2c-3.8,9.2-12.9,15.7-23.5,15.7c-2.6,0-5.2-0.4-7.6-1.2c-4.8,4.1-11,6.5-17.8,6.5
                    c-3.5,0-6.8-0.7-9.9-1.8c-4.9,11.1-16.1,18.9-29,18.9c-9,0-17.2-3.8-22.9-9.8c-1.4,0.2-2.9,0.3-4.4,0.3c-9.4,0-17.8-4.2-23.5-10.9
                    c-3.4,1.9-7.4,2.9-11.5,2.9c-1.5,0-2.9-0.1-4.3-0.4c-7.4,8.5-18.4,13.9-30.6,13.9c-15.6,0-29.2-8.9-36-21.8c-1.5,0.2-3,0.4-4.6,0.4
                    c-11.4,0-21.2-6.9-25.5-16.7c-1.4,0.3-2.9,0.5-4.4,0.5c-6.9,0-12.9-3.6-16.4-9c-1,0.1-2,0.3-3.1,0.3C0.9,27.9,0.4,27.9,0,27.9z"/>
            </svg>
        <?php } elseif($clouds_position == 'bottom-left') { ?>
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="2216.000000pt" height="140.000000pt" viewBox="0 0 2216.000000 140.000000" preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,140.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                <path class="st0" style="fill: <?php echo esc_attr($bg_color); ?>" d="M3247 1052 c-764 -518 -1341 -820 -1772 -928 -122 -31 -338 -43 -428
                    -25 -81 17 -185 72 -242 128 -57 57 -101 122 -174 261 -61 116 -105 162 -154
                    162 -79 0 -212 -99 -379 -283 l-98 -107 0 -130 0 -130 11052 0 c7293 0 11049
                    3 11042 10 -26 26 -295 180 -429 245 -464 227 -821 277 -1227 175 -46 -12
                    -191 -55 -323 -95 -402 -124 -585 -161 -855 -172 -339 -13 -735 53 -1179 199
                    -148 48 -485 178 -597 230 l-52 24 -163 -18 c-1259 -136 -2196 -205 -3249
                    -239 -401 -13 -1662 -6 -1960 10 -719 40 -1197 84 -1735 162 -268 38 -696 112
                    -831 144 -50 11 -80 13 -132 5 -37 -5 -188 -23 -337 -39 -1095 -122 -2005
                    -132 -2805 -31 -512 65 -896 152 -1505 340 -354 109 -843 207 -1218 243 -35 3
                    -56 -9 -250 -141z"/></g>
            </svg>
        <?php } elseif($clouds_position == 'bottom-right') { ?>
            <svg version="1.1" id="mt_svg_cloud" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 417.9 78.2" style="enable-background:new 0 0 417.9 78.2;" xml:space="preserve">
                <path class="st0" style="fill: <?php echo esc_attr($bg_color); ?>" d="M0,27.9V0h417.9v27.5c-1.2,0.4-2.6,0.6-3.9,0.8c-5,7.4-13.5,12.2-23.1,12.2c-6,0-11.6-1.9-16.2-5.2
                    c-3.8,2.8-8.4,4.4-13.4,4.4c-1.5,0-3-0.1-4.5-0.4c-4.8,8.3-13.8,13.9-24,13.9c-10.2,0-19.1-5.5-23.9-13.6c-2.1,0.6-4.3,1-6.7,1
                    c-5.2,0-10-1.7-13.9-4.6c-3.4,2.4-7.5,3.9-12,4.2c-3.8,9.2-12.9,15.7-23.5,15.7c-2.6,0-5.2-0.4-7.6-1.2c-4.8,4.1-11,6.5-17.8,6.5
                    c-3.5,0-6.8-0.7-9.9-1.8c-4.9,11.1-16.1,18.9-29,18.9c-9,0-17.2-3.8-22.9-9.8c-1.4,0.2-2.9,0.3-4.4,0.3c-9.4,0-17.8-4.2-23.5-10.9
                    c-3.4,1.9-7.4,2.9-11.5,2.9c-1.5,0-2.9-0.1-4.3-0.4c-7.4,8.5-18.4,13.9-30.6,13.9c-15.6,0-29.2-8.9-36-21.8c-1.5,0.2-3,0.4-4.6,0.4
                    c-11.4,0-21.2-6.9-25.5-16.7c-1.4,0.3-2.9,0.5-4.4,0.5c-6.9,0-12.9-3.6-16.4-9c-1,0.1-2,0.3-3.1,0.3C0.9,27.9,0.4,27.9,0,27.9z"/>
            </svg>
        <?php } elseif($custom_separator == 'svg') { ?>
            <?php if(!empty($content_svg)) { ?>
              <div class="mt-addons-row-separator-svg">
                <svg  class="mt-addons-row-separator-svg-icon"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 417.9 78.2" style="enable-background:new 0 0 417.9 78.2;" xml:space="preserve"><?php echo rawurldecode( base64_decode( $content_svg ) );?></svg>
            </div>
          <?php } ?>

        <?php } elseif($custom_separator == 'img') { ?>
          <div class="mt-addons-row-separator-img" style="background: url(<?php echo esc_attr($image[0]); ?>)no-repeat center center ; ;"></div>
        <?php } else { ?>

        <?php } ?>
    </div>

  <?php
  return ob_get_clean();
}
add_shortcode('mt-addons-row-separator', 'modeltheme_addons_for_wpbakery_row_separator');


if ( function_exists('vc_map') ) {
    vc_map( 
        array(
            "name" => esc_attr__("MT: Row Separator", 'modeltheme_addons_for_wpbakery'),
            "base" => "mt-addons-row-separator",
            "icon" => plugins_url( 'images/separator.svg', __FILE__ ),
            "category" => esc_attr__('MT Addons', 'modeltheme_addons_for_wpbakery'),
            "params" => array(
                array(
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Row Separator Background", 'modeltheme-addons-for-wpbakery' ),
                  "param_name" => "bg_color",
                  "value" => '#FFBA41', 
                  "description" => esc_attr__( "Set the background color of the Row Separator", 'modeltheme-addons-for-wpbakery' )
               ),
                array(
                  "type"         => "dropdown",
                  "holder"       => "div",
                  "class"        => "",
                  "param_name"   => "clouds_position",
                  "heading"      => esc_attr__("Clouds Position", 'modeltheme-addons-for-wpbakery'),
                  "value"        => array(
                    esc_attr__('Choose an Option', 'modeltheme-addons-for-wpbakery')    => '',
                    esc_attr__('Style 1', 'modeltheme-addons-for-wpbakery')    => 'top-left',
                    esc_attr__('Style 2', 'modeltheme-addons-for-wpbakery') => 'top-right',
                    esc_attr__('Style 3', 'modeltheme-addons-for-wpbakery')    => 'bottom-left',
                    esc_attr__('Style 4', 'modeltheme-addons-for-wpbakery') => 'bottom-right',
                    esc_attr__('Custom', 'modeltheme-addons-for-wpbakery') => 'custom_separator',
                )
              ),
              array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__('Custom Separator', 'modeltheme-addons-for-wpbakery'),
                "param_name" => "custom_separator",
                "value"        => array(
                  esc_attr__('Choose an Option', 'modeltheme-addons-for-wpbakery')    => '',
                  esc_attr__('IMG', 'modeltheme-addons-for-wpbakery')    => 'img',
                  esc_attr__('SVG', 'modeltheme-addons-for-wpbakery') => 'svg',
                ),
                "dependency" => array(
                  'element' => 'clouds_position',
                  'value' => 'custom_separator',
                ),
              ),
              array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__("Image", "modeltheme_addons_for_wpbakery"),
                "param_name" => "image",
                "dependency" => array(
                  'element' => 'custom_separator',
                  'value' => 'img',
                ),
              ),
              array(
                "type" => "textarea_raw_html",
                "class" => "",
                "holder" => "div",
                "heading" => esc_attr__( "HTML SVG", 'modeltheme-addons-for-wpbakery' ),
                "param_name" => "content_svg",
                "dependency" => array(
                  'element' => 'custom_separator',
                  'value' => 'svg',
                ),
              ),
            )
        )
    );  
}
