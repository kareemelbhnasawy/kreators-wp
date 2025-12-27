<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_contact_form($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'                =>  '',
      'contact_forms'               =>  '',
      'extra_class'                 =>  '',
      'form_theme_default'          =>  '',
      'styling'                     =>  '',
      'background_label'            =>  '',
      'placeholder_color'           =>  '',
      'btn_padding'                 =>  '',
      'styling_fields'              =>  '',
      'button_background_color'     =>  '',
      'button_background_text'      =>  '',
      'btn_submit_padding'          =>  '',
      'label_width'                 =>  '',
      'nav_top_bottom_pos'          =>  '',

    ), $params ) );
   
    wp_enqueue_style( 'contact-form', plugins_url( '../../css/contact-form.css' , __FILE__ ));
    $uniqid = 'mt-addons-uniqid-'.uniqid();
    ob_start();

  $form_theme_default_class = '';
  if($form_theme_default){
    $form_theme_default_class = 'mt-addons_contact-form--theme_default';
  }?>

    <div class="mt-addons-contact-form <?php echo esc_attr($extra_class.' '.$styling.' '.$placeholder_color.' '.$background_label.' '.$styling_fields.' '.$form_theme_default_class); ?>" id="<?php  echo esc_attr($uniqid); ?>">
      <?php if (!empty($contact_forms)) {
      echo do_shortcode( '[contact-form-7 id="'.$contact_forms.'" title="Contact Form"]' ); 
      } ?>
    </div>

    <?php if (function_exists('vc_map')) { ?>
    <style  id="<?php  echo esc_attr($uniqid); ?>" type="text/css" media="screen">

        .mt-addons-contact-form ::placeholder {
          color: <?php echo esc_attr($placeholder_color); ?>!important;
        }
        .mt-addons-contact-form input, 
        .mt-addons-contact-form textarea,
        .mt-addons-contact-form select, 
        .mt-addons-contact-form button {
          padding: <?php echo esc_attr($btn_padding); ?>!important;
        }
        .mt-addons-contact-form .wpcf7-form input, 
        .mt-addons-contact-form .wpcf7-form textarea{
          width: <?php echo esc_attr($label_width.'px'); ?>!important;
        }
        .mt-addons-contact-form button {
          color: <?php echo esc_attr($button_background_text); ?>!important;
          padding: <?php echo esc_attr($btn_submit_padding); ?>!important;
        }
        .mt-addons-contact-form .wpcf7-form button{
            transform: translateY(<?php echo esc_attr($nav_top_bottom_pos.'%'); ?>);

        }
      </style>
    <?php } ?>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-contact-form', 'modeltheme_addons_for_wpbakery_contact_form');

//VC Map
add_action('init','mt_addons_ccontact_form');
function mt_addons_ccontact_form(){

if (function_exists('vc_map')) {
  $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
  $contact_forms = array();
  if ( $cf7 ) {
  foreach ( $cf7 as $cform ) {
    $contact_forms[ $cform->post_title ] = $cform->ID;
  }
  } else {
  $contact_forms[ esc_html__( 'No contact forms found', 'modeltheme-addons-for-wpbakery' ) ] = 0;
}

  vc_map(
  array(
    "name" => esc_attr__("MT: Contact Form", 'modeltheme-addons-for-wpbakery'),
    "base" => "mt-addons-contact-form",
    "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
    "icon" => plugins_url( 'images/form.svg', __FILE__ ),
    "params" => array(
    array(
    "type" => "dropdown",
    "holder" => "div",
    "class" => "",
    "heading" => esc_attr__("Contact Forms", 'modeltheme-addons-for-wpbakery'),
    "param_name" => "contact_forms",
    "std" => 'Select',
    "value" => $contact_forms
    ),
    array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_attr__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "styling",
        "value" => array(
          'Select Option'   => '',
          'Style 1'         => 'style-1',
          'Style 2'         => 'style-2'

        ),
        "default" => 'style_1'
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => esc_attr__( 'Fields Shape', 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "styling_fields",
        "value" => array(
          'Select Option'   => '',
            esc_attr__('Square (Default)', "modeltheme-addons-for-wpbakery")       => 'border-radius-square-parent',
            esc_attr__('Rounded (5px Radius)', "modeltheme-addons-for-wpbakery")   => 'border-radius-rounded-parent',
            esc_attr__('Round (30px Radius)', "modeltheme-addons-for-wpbakery")    => 'border-radius-round-parent',
          ),
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( "Padding Fields", "modeltheme-addons-for-wpbakery" ),
        "param_name" => "btn_padding",
        "value" => "",
        "description" => esc_attr__("Example: 25px 50px 75px 100px (top padding is 25px; right padding is 50px;
        bottom padding is 75px;left padding is 100px).", "modeltheme-addons-for-wpbakery" ),
      ),
      array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => esc_attr__( "Placeholder Color", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "placeholder_color",
      ),
      array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => esc_attr__( "Background", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "background_label",
      ),
      array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => esc_attr__( "Button text color", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "button_background_text",
      ),
      array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => esc_attr__( "Button background color", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "button_background_color",
      ),
      array(
        "type" => "textfield",
        "class" => "",
        "heading" => esc_attr__( "Button Padding", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "btn_submit_padding",
        "description" => esc_attr__("Example: 25px 50px 75px 100px (top padding is 25px; right padding is 50px; bottom padding is 75px;left padding is 100px).", "modeltheme-addons-for-wpbakery" ),
      ),
      array(
        "type" => "vc_number",
        "class" => "",
        "heading" => esc_attr__( "Label Width", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "label_width",
        "description" => esc_attr__("px", "modeltheme-addons-for-wpbakery" ),
      ),
      array(
        "type" => "vc_number",
        "class" => "",
        "heading" => esc_attr__( "Top Bottom Position", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "nav_top_bottom_pos",
        "description" => esc_attr__("px", "modeltheme-addons-for-wpbakery" ),
      ),
      array(
        "heading" => esc_attr__( "Theme Default Form?", "modeltheme-addons-for-wpbakery" ),
        "type" => "checkbox",
        "class" => "",
        "param_name" => "form_theme_default",
        "description" => esc_attr__( "If checked, the form will inherit styling from the theme (input/textarea/button). By selecting a style from the option above, the default options will be overridden.", "modeltheme-addons-for-wpbakery" )
      ),
    array(
    "type" => "textfield",
    "heading" => esc_attr__("Extra class name", "modeltheme-addons-for-wpbakery"),
    "param_name" => "extra_class",
    "description" => esc_attr__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme-addons-for-wpbakery")
    )
  )
  ));
}}