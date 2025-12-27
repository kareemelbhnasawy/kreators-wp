<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * @author Cristi
 */
function modeltheme_addons_for_wpbakery_row_overlay( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'background'                       => '',
            'inner_column'                     => '',
            'page_builder'                     => '',
            'moving_images_grid'               => '',
            'images_gap'                       => '',
            'image_groups'                     => '',
        ), $params ) );
    
    wp_enqueue_style( 'mt-row-overlay', plugins_url( '../../css/row-overlay.css' , __FILE__ ));
    
    ob_start(); 

    if ($inner_column) {
        $inner_column = 'yes';
    }else{
        $inner_column = ' ';
    }
    ?>

    <div 
        data-inner-column="<?php echo esc_attr($inner_column); ?>"  
        class="modeltheme_addons_for_wpbakery-row-overlay">

        <?php if (array_key_exists('image_groups', $params)) { ?>
             <?php if ($page_builder == 'elementor') { ?>
               <?php $image_groups = unserialize(base64_decode($image_groups)); ?>
            <?php }else{ ?>
               <?php 
                if (function_exists('vc_param_group_parse_atts')) {
                    $image_groups = vc_param_group_parse_atts($params['image_groups']); 
                } 
                ?>
             <?php } ?>
            <?php if ($image_groups) { ?>
                <div class="mafw-row-overlay-moving-gallery">
                    <?php foreach ($image_groups as $gallery) { ?>
                        <div class="mafw-row-overlay-moving-gallery-group">
                             <?php if($gallery){ ?>
                                <?php
                                if ($page_builder == 'elementor') {
                                    $gallery_items = wp_list_pluck( $gallery['images'], 'id' );
                                }else{
                                    $gallery_items = explode(',', $gallery['images']); 
                                }
                                ?>
                                <div class="mafw-row-overlay-moving-gallery-inner-holder">
                                    <div class="mafw-row-overlay-moving-gallery-inner mafw-<?php echo $gallery['animation_type']; ?>">
                                        <?php foreach ($gallery_items as $gallery_item) { ?>
                                            <?php 
                                            $gallery_item_url = wp_get_attachment_image_src( $gallery_item, 'full' ); 
                                            ?>
                                            <?php if($gallery_item_url) { ?>
                                                <div class="mafw-row-overlay-moving-gallery-item" style="background-image: url(<?php echo esc_url($gallery_item_url[0]); ?>); margin: <?php echo esc_attr($images_gap); ?>px;"></div>
                                            <?php } ?>
                                        <?php } ?>

                                        <?php foreach ($gallery_items as $gallery_item) { ?>
                                            <?php 
                                            $gallery_item_url = wp_get_attachment_image_src( $gallery_item, 'full' ); 
                                            ?>
                                            <?php if($gallery_item_url) { ?>
                                                <div class="mafw-row-overlay-moving-gallery-item" style="background-image: url(<?php echo esc_url($gallery_item_url[0]); ?>); margin: <?php echo esc_attr($images_gap); ?>px;"></div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="modeltheme_addons_for_wpbakery-row-overlay-inner" style="background: <?php echo esc_attr($background); ?>"></div>

    </div>



  <?php
  return ob_get_clean();
}
add_shortcode('mt-row-overlay', 'modeltheme_addons_for_wpbakery_row_overlay');


if ( function_exists('vc_map') ) {
    vc_map( 
        array(
            "name" => esc_attr__("MT: Row Overlay", 'modeltheme_addons_for_wpbakery'),
            "base" => "mt-row-overlay",
            "icon" => plugins_url( 'images/separator.svg', __FILE__ ),
            "category" => esc_attr__('MT Addons', 'modeltheme_addons_for_wpbakery'),
            "params" => array(
                array(
                    "heading" => esc_attr__("Background Color", 'modeltheme_addons_for_wpbakery'),
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "param_name" => "background",
                ),
                array(
                    "heading" => __( "Keep in Column?", "modeltheme_addons_for_wpbakery" ),
                    "type" => "checkbox",
                    "class" => "",
                    "param_name" => "inner_column",
                    "description" => __( "If checked, the overlay will be only applied in a column. By default, it will be applied on row.", "modeltheme_addons_for_wpbakery" )
                ),
                array(
                    "heading" => __( "Moving Images Grid?", "modeltheme_addons_for_wpbakery" ),
                    "type" => "checkbox",
                    "class" => "",
                    "param_name" => "moving_images_grid",
                    "description" => __( "If checked, an infinite moving images grid will appear below the overlay." )
                ),
                array(
                    "heading"     =>  esc_html__( 'Images Gap', 'accordion' ),
                    "type"      =>  "vc_number",
                    "suffix"      =>  "px",
                    "param_name"  =>  "images_gap",
                    "value"     =>  "",
                    "description" => __( "Space between images" ),
                    "dependency" => array(
                        'element' => 'moving_images_grid',
                        'value' => "true",
                    ),
                ),
                array(
                    'type' => 'param_group',
                    'value' => '',
                    'param_name' => 'image_groups',
                    "dependency" => array(
                        'element' => 'moving_images_grid',
                        'value' => "true",
                    ),
                    // Note params is mapped inside param-group:
                    'params' => array(
                        array(
                            "heading" => __( "Upload Images for the current column", "modeltheme-addons-for-wpbakery" ),
                            "type" => "attach_images",
                            "class" => "",
                            "param_name" => "images",
                            "description" => __( "Each group will consist in a vertical images row" )
                        ),
                        array(
                            "heading" => esc_attr__("Animation type", "modeltheme-addons-for-wpbakery"),
                            "type" => "dropdown",
                            "param_name" => "animation_type",
                            "value" => array(
                                esc_attr__('Sliding Up', "modeltheme-addons-for-wpbakery")   => 'mt_slide_up',
                                esc_attr__('Sliding Down', "modeltheme-addons-for-wpbakery")   => 'mt_slide_down',
                            ),
                            "std" => 'normal',
                            "holder" => "div",
                            "class" => "",
                            "description" => ""
                        ),
                    ),
                ),

            )
        )
    );  
}
