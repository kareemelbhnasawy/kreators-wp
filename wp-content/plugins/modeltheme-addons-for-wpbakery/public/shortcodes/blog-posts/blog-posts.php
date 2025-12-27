<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_blog_posts_carousel($params, $content) {
  extract( shortcode_atts( 
    array(
      'page_builder'       => '',
      'number'                   => '',
      'comments_blog'            => '',
      'category'                 => '',
      'featured_image_size'      => '',
      'title_style'      => '',
      'text_color'               => '',
      'title_size'               => '',
      'title_weight'             => '',
      'title_line'               => '',

      'read_more_btn'            => '',
      'button_background'        => '',
      'button_color'             => '',
      'date_color'               => '',
      'background_color_ov'      => '',

      // carousel
      'autoplay'              => '', 
      'delay'                 => '',
      'items_desktop'         => '',
      'items_mobile'          => '',
      'items_tablet'          => '',
      'space_items'           => '',
      'touch_move'            => '',
      'effect'                => '',
      'grab_cursor'           => '',
      'infinite_loop'         => '',
      'carousel'                 => '',
      'columns'                  => 'col-md-4',
      'layout'                   => 'grid',
      'centered_slides'          => '',
      'select_navigation'          => '',
      'navigation_position'        => '',
      'nav_style'                  => '',
      'navigation_color'           => '',
      'navigation_bg_color'        => '',
      'navigation_bg_color_hover'  => '',
      'navigation_color_hover'     => '',
      'pagination_color'           => '',
      'navigation'           => '',
      'pagination'           => '',
      // end carousel

      'excerpt_blog'             => '',
      'style_var'                => '',
      'excerpt_color'            => '',
      'image_post'               => '',
      'brightness_blog'          => ''

    ), $params ) );


    $args_posts = array(
      'posts_per_page'        => $number,
      'post_type'             => 'post',
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => $category 
        )
      ),
      'post_status'           => 'publish' 
    );

    
    $posts = new WP_Query( $args_posts );

    $overlay_bg_style = '';
    if ($background_color_ov) {
      $overlay_bg_style = 'background:'.$background_color_ov.';';
    }
    if ($read_more_btn) {
        $button_text_value = $read_more_btn;
    }else{
        $button_text_value = esc_html__('Read More', 'modeltheme-addons-for-wpbakery');
    }
    if ($style_var == 'style_2') {
        $style_var_value = 'mt-addons-style-2';
    }else{
        $style_var_value = '';
    }
    $image_post_value = '';
    if ($image_post == 'true') {
        $image_post_value = 'display:none;';
    }else{
        $image_post_value = 'display:block;';
    }
    // custom
    wp_enqueue_style( 'blog-posts-carousel', plugins_url( '../../css/blog-posts.css' , __FILE__ ));

    $id = 'mt-addons-swipper-'.uniqid();

    $carousel_item_class = $columns;
    $carousel_holder_class = '';
    $swiper_wrapped_start = '';
    $swiper_wrapped_end = '';
    $swiper_container_start = '';
    $swiper_container_end = '';
    $html_post_swiper_wrapper = '';

    if ($layout == "carousel" or $layout == "") {
      $carousel_holder_class = 'mt-addons-swipper swiper';
      $carousel_item_class = 'swiper-slide';

      $swiper_wrapped_start = '<div class="swiper-wrapper">';
      $swiper_wrapped_end = '</div>';


        $swiper_container_start = '<div class="mt-addons-swiper-container">';
        $swiper_container_end = '</div>';

      if($page_builder == 'elementor' && $navigation == "yes") { 
        // next/prev
        $html_post_swiper_wrapper .= '
        <i class="fas fa-arrow-left swiper-button-prev '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>
        <i class="fas fa-arrow-right swiper-button-next '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>';
      }else {
        if($navigation == "true") { 
          $html_post_swiper_wrapper .= '
          <i class="fas fa-arrow-left swiper-button-prev '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>
          <i class="fas fa-arrow-right swiper-button-next '.$nav_style.' '.$navigation_position.'" style="color:'.$navigation_color.'; background:'.$navigation_bg_color.';"></i>';
        }
      }
      if($page_builder == 'elementor' && $pagination == "yes") { 
          // next/prev
        $html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
      }else {
        if($pagination == "true") { 
          // next/prev
          $html_post_swiper_wrapper .= '<div class="swiper-pagination"></div>';
        }
      }
      // SWIPER SLIDER
      wp_enqueue_style( 'swiper-bundle', plugins_url( '../../css/plugins/swiperjs/swiper-bundle.min.css' , __FILE__ ));
      wp_enqueue_script( 'swipper-bundle', plugins_url( '../../js/plugins/swiperjs/swiper-bundle.min.js' , __FILE__));
      wp_enqueue_script( 'swipper', plugins_url( '../../js/swiper.js' , __FILE__));

    }

    ob_start(); ?>

      <!-- dir="rtl" -->
      <?php //swiper container start ?>
      <?php echo wp_kses_post($swiper_container_start); ?>
        <div class="mt-swipper-carusel-position" style="position:relative;">

          <div id="<?php echo esc_attr($id); ?>" 
            <?php modeltheme_addons_swiper_attributes($id, $autoplay, $delay, $items_desktop, $items_mobile, $items_tablet, $space_items, $touch_move, $effect, $grab_cursor, $infinite_loop, $centered_slides); ?>
            class="mt-addons-blog-posts-carousel row <?php echo esc_attr($style_var_value); ?>  <?php echo esc_attr($carousel_holder_class); ?>">

            <?php //swiper wrapped start ?>
            <?php echo wp_kses_post($swiper_wrapped_start); ?> 
                     
              <?php if ( $posts->have_posts() ) : ?>
                  <?php /* Start the Loop */ ?>
                  <?php
                  while ( $posts->have_posts() ) : $posts->the_post(); 

                    $image_size = 'full';
                    if ($featured_image_size) {
                      $image_size = $featured_image_size;
                    }

                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
                    $comments_count = wp_count_comments(get_the_ID());
                    $comments = '<a href="'.get_comments_link(get_the_ID()).'">'.sprintf( _n( '%s Comment', '%s Comments', $comments_count->approved, 'modeltheme-addons-for-wpbakery' ), number_format_i18n( $comments_count->approved ) ) .'</a>';
                    $post_content = get_post_field('post_content', get_the_ID());
                    ?>
                    <div class="mt-addons-blog-posts-carousel-single-post <?php echo esc_attr($carousel_item_class); ?>">
                      <div class="mt-addons-blog-posts-carousel-single-post-wrapper" style="<?php echo $overlay_bg_style; ?>">
                        <div class="mt-addons-blog-posts-carousel-custom" style="<?php echo esc_attr($image_post_value);?>"> 

                          <div class="mt-addons-blog-posts-carousel-thumbnail">
                              <?php if($thumbnail_src) { ?>
                                <div class="mt-addons-blog-featured-image" style="filter:brightness(<?php echo $brightness_blog; ?>)">
                                  <img src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="<?php echo esc_attr(get_the_title());?>" />
                                  <div class="mt-addons-blog-posts-carousel-button">
                                    <div class="mt-addons-blog-posts-carousel-content-inside" <?php if($button_background){ ?>style="background-color:<?php echo $button_background; ?>" <?php } ?>>
                                      <a href="<?php echo get_permalink(get_the_ID())?>" class="relative" <?php if($button_color){?> style="color:<?php echo $button_color; ?>" <?php } ?>>
                                        <?php if($style_var == "style_1") { ?>
                                          <?php echo esc_html($button_text_value); ?>
                                        <?php } ?>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              <?php } ?>
                          </div>
                        </div>
                        <div class="mt-addons-blog-posts-carousel-head-content">
                          <div class="mt-addons-blog-posts-carousel-date" style="color:<?php echo $date_color; ?>">
                            <span><?php echo get_the_time('j ',get_the_ID());?></span><?php echo get_the_time('M, Y',get_the_ID());?>
                              <?php if($page_builder == 'elementor' && $comments_blog == "yes") { ?>
                             | <a style="color:<?php echo $date_color; ?>" href="<?php echo get_permalink(get_the_ID());?>" ><span><?php echo $comments; ?></span></a>
                              <?php }else{  ?>
                                <?php if($comments_blog == "true") { ?>
                                | <a style="color:<?php echo $date_color; ?>" href="<?php echo get_permalink(get_the_ID());?>" ><span><?php echo $comments; ?></span></a>
                                <?php } ?>
                              <?php } ?>

                          </div>
                          <h3 class="mt-addons-blog-posts-carousel-post-name <?php echo esc_attr($title_style); ?>"><a href="<?php echo get_permalink(get_the_ID());?>" style="color:<?php echo esc_attr($text_color);?>;font-weight:<?php echo $title_weight; ?>;font-size:<?php echo $title_size; ?>px;line-height: <?php echo $title_line; ?>"><?php echo esc_attr(get_the_title());?></a></h3>
                          <?php if($page_builder == 'elementor' && $excerpt_blog == "yes") { ?>
                             <div class="mt-addons-blog-posts-excerpt"><p style="color:<?php echo esc_attr($excerpt_color);?>"><?php echo strip_tags(modeltheme_addons_excerpt_limit($post_content, 15));?>...</p></div>
                          <?php }else { ?>
                            <?php if ($excerpt_blog == "true") { ?>
                              <div class="mt-addons-blog-posts-excerpt"><p style="color:<?php echo esc_attr($excerpt_color);?>"><?php echo strip_tags(modeltheme_addons_excerpt_limit($post_content, 15));?>...</p></div>
                            <?php } ?>
                          <?php } ?>
                        </div>
                      </div>
                    </div>

                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>
              <?php else : ?>
                  <?php //no posts found ?>
              <?php endif; ?>
            <?php //swiper wrapped end ?>
            <?php echo wp_kses_post($swiper_wrapped_end); ?>
            <?php //pagination/navigation ?>
            <?php echo wp_kses_post($html_post_swiper_wrapper); ?>
          </div>
        </div>
      <?php //swiper container end ?>
      <?php echo wp_kses_post($swiper_container_end); ?>

    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-blog-posts-carousel', 'modeltheme_addons_for_wpbakery_blog_posts_carousel');

add_action('init', 'mt_addons_blog_posts_vc_map');
function mt_addons_blog_posts_vc_map(){
  //VC Map
  if (function_exists('vc_map')) {
    $post_category_tax = get_terms('category');
    $post_category = array();
    if ($post_category_tax) {
      foreach ( $post_category_tax as $term ) {
        $post_category[$term->name] = $term->slug;
      }
    }

    $params = array(
      array(
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( "Number", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "number"
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Category", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "category",
        "std" => 'Default value',
        "value" => $post_category
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Featured Image size", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "featured_image_size",
        "std" => 'full',
        "value" => modeltheme_addons_image_sizes_array()
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( "Read More Text", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "read_more_btn"
      ),
      array(
        "type" => "checkbox",
        "class" => "",
        "heading" => esc_attr__("Comments", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "comments_blog",
        "value"       => array(
          "Enabled" => "true",
        ),
      ),
      array(
        "type" => "checkbox",
        "class" => "",
        "heading" => esc_attr__("Excerpt", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "excerpt_blog",
        "value"       => array(
          "Enabled" => "true",
        ),
      ),
      array(
        "type" => "vc_number",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__( "Brightness", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "brightness_blog"
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_attr__("Style", "modeltheme-addons-for-wpbakery"),
        "param_name" => "style_var",
        "value" => array(
          esc_attr__('Select', "modeltheme-addons-for-wpbakery")   => '',
          esc_attr__('Style 1', "modeltheme-addons-for-wpbakery")  => 'style_1',
          esc_attr__('Style 2', "modeltheme-addons-for-wpbakery")  => 'style_2'
        ),
        "holder" => "div",
        "class" => ""
      ),
      array(
        "type" => "checkbox",
        "class" => "",
        "heading" => esc_attr__( "Image", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "image_post",
        "dependency" => array(
          'element' => 'style_var',
          'value' => "style_1",
        ),
        "value"       => array(
          "Hide Image Post" => "true",
        ),
      ),
      array(
        "type" => "dropdown",
        "heading" => esc_attr__("Title position", "modeltheme-addons-for-wpbakery"),
        "param_name" => "title_style",
        "value" => array(
          esc_attr__('Select', "modeltheme-addons-for-wpbakery")   => '',
          esc_attr__('Title top', "modeltheme-addons-for-wpbakery")  => 'mt_addons_title_top',
          esc_attr__('Title down', "modeltheme-addons-for-wpbakery")  => 'mt_addons_title_down'
        ),
        "dependency" => array(
          'element' => 'style_var',
          'value' => "style_2",
        ),
        "holder" => "div",
        "class" => ""
      ),
      array(
        "group" => "Styling",
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Title color", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "text_color"
      ),
      array(
        "type" => "vc_number",
        "suffix" => "px",
        "group" => "Styling",
        "class" => "",
        "heading" => esc_attr__( "Title Font size", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "title_size"
      ),
      array(
        "type" => "vc_number",
        "suffix" => "E.g.: 1.5 (Min: 0.1 - Max 3)",
        'min' => 0.1,
        'max' => 3,
        'step' => 0.1,
        "group" => "Styling",
        "class" => "",
        "heading" => esc_attr__( "Title Line height", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "title_line"
      ),
      array(
        "type" => "vc_number",
        "suffix" => "E.g.: 500",
        "group" => "Styling",
        "class" => "",
        "heading" => esc_attr__( "Title Font weight", 'modeltheme-addons-for-wpbakery' ),
        "param_name" => "title_weight"
      ),
      array(
        "group" => "Styling",
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Box Background color", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "background_color_ov"
      ),
      array(
        "group" => "Styling",
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Button Background", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "button_background"
      ),
      array(
        "group" => "Styling",
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Button text Color", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "button_color"
      ),
      array(
        "group" => "Styling",
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Date text Color", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "date_color"
      ),
      array(
        "group" => "Styling",
        "type" => "colorpicker",
        "holder" => "div",
        "class" => "",
        "heading" => esc_attr__("Excerpt text Color", 'modeltheme-addons-for-wpbakery'),
        "param_name" => "excerpt_color"
      ),
    );
    
    $swiper_fields_array = modeltheme_addons_swiper_vc_fields();
    if ($swiper_fields_array) {
      foreach ($swiper_fields_array as $swiper_fields) {
        $params[] = $swiper_fields;
      }
    }

    $extras_vc_fields = modeltheme_addons_extras_vc_fields();
    if ($extras_vc_fields) {
      foreach ($extras_vc_fields as $extra_param) {
        $params[] = $extra_param;
      }
    }

    vc_map(
      array(
        "name" => esc_attr__("MT: Blog Posts (Grid / Carousel)", 'modeltheme-addons-for-wpbakery'),
        "base" => "mt-addons-blog-posts-carousel",
        "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
        "icon" => plugins_url( 'images/blog.svg', __FILE__ ),
        "params" => $params,
    ));
  }
}
