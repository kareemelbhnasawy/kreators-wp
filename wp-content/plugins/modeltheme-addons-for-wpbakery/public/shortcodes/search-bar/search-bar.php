<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function modeltheme_addons_for_wpbakery_search_bar($params, $content) {
  extract( shortcode_atts( 
    array(
      'post_type'                   =>'',
      'extra_class'                 =>'',
    ), $params ) );
   
    wp_enqueue_style( 'search-bar-css', plugins_url( '../../css/search-bar.css' , __FILE__ ));
    if($post_type == "") {
      $category_select = "product_cat";
    } else {
      $category_select = "post_cat";
    }
    ob_start(); ?>

    <div class="mt-addons-search-bar <?php echo esc_attr($extra_class); ?>">
      <div class="mt-addons-search-bar-wrapper">
        <form name="mt-addons-form" method="GET" class="mt-addons-form" action="<?php echo home_url('/'); ?>">
          <div class="mt-addons-select-categories col-md-3">          
            <select name="<?php echo esc_attr($category_select); ?>" class="mt-addons-select form-control">
              <?php if($post_type == "") {
                  if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
                    $optsetlect=$_REQUEST['product_cat'];
                  } else {
                    $optsetlect=0;  
                  }
                  $terms_c = get_terms( 'product_cat' ); ?>
                  <option value=''><?php echo esc_html__('Categories','modeltheme-addons-for-wpbakery'); ?></option>
                  <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                    <?php foreach ($terms_c as $term) { ?>
                      <option value='<?php echo $term->slug;?>'><?php echo $term->name ?></option>
                    <?php } 
                  }
              } else {
                $cat_args = array(
                    'post_type' => 'post', // your custom post type
                ); 
                $terms_c = get_categories(); ?>
                <option value=''><?php echo esc_html__('Categories','modeltheme-addons-for-wpbakery'); ?></option>
                  <?php foreach ($terms_c as $term) { ?>
                    <option value='<?php echo $term->slug;?>'><?php echo $term->name ?></option>
                  <?php } 
              } ?>
            </select>
          </div>
          <div class="mt-addons-search-post col-md-8">
            <input type="search" class="search-field form-control" placeholder="<?php echo esc_html__( 'Search...','modeltheme-addons-for-wpbakery' );?>" value="<?php echo get_search_query();?>" name="s" id="keyword" onkeyup="fetch_products()" />
          </div>
          <div class="mt-addons-search-submit col-md-1 submit">
            <button type="submit" class="form-control btn"><i class="fa fa-search" aria-hidden="true"></i></button>
          </div>
          <?php if ($post_type == "") { ?>
            <input type="hidden" name="post_type" value="product" />
          <?php } else { ?>
            <input type="hidden" name="post_type" value="post" />
          <?php } ?>
        </form>
        <div id="datafetch"></div>
      </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('mt-addons-search-bar', 'modeltheme_addons_for_wpbakery_search_bar');

/* search */
add_action( 'wp_footer', 'foodhub_search_form_ajax_fetch' );
function foodhub_search_form_ajax_fetch() { ?>

<script type="text/javascript">
 function fetch_products(){
  
     jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'mt_addons_search_form_data_fetch', keyword: jQuery('#keyword').val() },
        success: function(data) {
            jQuery('#datafetch').html( data );
        }
    });

}
</script>
<?php
}
 // the ajax function
add_action('wp_ajax_mt_addons_search_form_data_fetch' , 'mt_addons_search_form_data_fetch');
add_action('wp_ajax_nopriv_mt_addons_search_form_data_fetch', 'mt_addons_search_form_data_fetch');

function mt_addons_search_form_data_fetch(){
if (  esc_attr( $_POST['keyword'] ) == null ) { die(); }
        $the_query = new WP_Query( array( 'post_type'=> 'product', 'post_per_page' => 4, 's' => esc_attr( $_POST['keyword'] ) ) );
        $count_tax = 0;
        if( $the_query->have_posts() ) : ?>
            <ul class="search-result">           
                <?php while( $the_query->have_posts() ): $the_query->the_post();  $post_type = get_post_type_object( get_post_type() ); ?>   
                    <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'foodhub_cat_icon_image' ); ?>             
                    <li>
                        <a href="<?php echo esc_url( post_permalink() ); ?>">
                            <?php if($thumbnail_src) { ?>
                                <?php the_post_thumbnail( 'foodhub_cat_icon_image' ); ?>
                            <?php } ?>
                            <?php the_title(); ?>
                        </a>
                    </li>             
                <?php endwhile; ?>
            </ul>       
            <?php wp_reset_postdata();  
        
        endif;
    die();
}

//VC Map
if (function_exists('vc_map')) {
  vc_map(
    array(
      "name" => esc_attr__("MT: Search Bar", 'modeltheme-addons-for-wpbakery'),
      "base" => "mt-addons-search-bar",
      "category" => esc_attr__('MT Addons', 'modeltheme-addons-for-wpbakery'),
      "icon" => plugins_url( 'images/products_search.svg', __FILE__ ),
      "params" => array(
        array(
           "group" => "Options",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Post Types", "modeltheme-addons-for-wpbakery"),
           "param_name" => "post_type",
           "std" => '',
           "value" => array(
            esc_attr__('Products', 'modeltheme-addons-for-wpbakery') => '',
            esc_attr__('Posts', 'modeltheme-addons-for-wpbakery')    => 'posts',
           )
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "heading" => __("Extra class name", "modeltheme-addons-for-wpbakery"),
          "param_name" => "extra_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme-addons-for-wpbakery")
        )
      )
  ));
}