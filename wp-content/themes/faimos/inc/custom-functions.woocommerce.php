<?php 
defined( 'ABSPATH' ) || exit;

/**
 * Check if WooCommerce is active
 **/
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


		/**
		 * faimos_WC_List_Grid class
		 **/
		if ( ! class_exists( 'faimos_WC_List_Grid' ) ) {

			class faimos_WC_List_Grid {

				public function __construct() {
					// Hooks
	  				add_action( 'wp' , array( $this, 'faimos_setup_gridlist' ) , 20);
				}

				/*-----------------------------------------------------------------------------------*/
				/* Class Functions */
				/*-----------------------------------------------------------------------------------*/

				// Setup
				function faimos_setup_gridlist() {
					if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
						add_action( 'wp_enqueue_scripts', array( $this, 'faimos_setup_scripts_script' ), 20);
						add_action( 'woocommerce_before_shop_loop', array( $this, 'faimos_gridlist_toggle_button' ), 30);
						add_action( 'woocommerce_after_shop_loop_item', array( $this, 'faimos_gridlist_buttonwrap_open' ), 9);
						add_action( 'woocommerce_after_shop_loop_item', array( $this, 'faimos_gridlist_buttonwrap_close' ), 11);
						add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
						add_action( 'woocommerce_after_subcategory', array( $this, 'faimos_gridlist_cat_desc' ) );
					}
				}

				function faimos_setup_scripts_script() {
					add_action( 'wp_footer', array( $this, 'faimos_gridlist_set_default_view' ) );
				}

				// Toggle button
				function faimos_gridlist_toggle_button() {

					$grid_view = __( 'Grid view', 'faimos' );
					$list_view = __( 'List view', 'faimos' );

					$output = sprintf( '<nav class="gridlist-toggle"><a href="#" id="grid" title="%1$s"><span class="dashicons dashicons-grid-view"></span> <em>%1$s</em></a><a href="#" id="list" title="%2$s"><span class="dashicons dashicons-exerpt-view"></span> <em>%2$s</em></a></nav>', $grid_view, $list_view );

					echo apply_filters( 'faimos_gridlist_toggle_button_output', $output, $grid_view, $list_view );
				}

				// Button wrap
				function faimos_gridlist_buttonwrap_open() {
					echo apply_filters( 'gridlist_button_wrap_start', '<div class="gridlist-buttonwrap">' );
				}
				function faimos_gridlist_buttonwrap_close() {
					echo apply_filters( 'gridlist_button_wrap_end', '</div>' );
				}

				function faimos_gridlist_set_default_view() {
					global $faimos_redux;
					$default = 'grid';
					if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
						if ($faimos_redux['faimos_shop_grid_list_switcher'] && !empty($faimos_redux['faimos_shop_grid_list_switcher'])) {
							$default = $faimos_redux['faimos_shop_grid_list_switcher'];
						}
					}
					?>
						<script>
						if ( 'function' == typeof(jQuery) ) {
							jQuery(document).ready(function($) {
								if ($.cookie( 'gridcookie' ) == null) {
									$( 'ul.products' ).addClass( '<?php echo esc_html($default); ?>' );
									$( '.gridlist-toggle #<?php echo esc_html($default); ?>' ).addClass( 'active' );
								}
							});
						}
						</script>
					<?php
				}

				function faimos_gridlist_cat_desc( $category ) {
					global $woocommerce;
					echo apply_filters( 'faimos_gridlist_cat_desc_wrap_start', '<div itemprop="description">' );
						echo esc_html($category->description);
					echo apply_filters( 'faimos_gridlist_cat_desc_wrap_end', '</div>' );

				}
			}

			$faimos_WC_List_Grid = new faimos_WC_List_Grid();
		}
	}


	if (!function_exists('faimos_custom_search_form')) {
		add_action('faimos_products_search_form','faimos_custom_search_form');
		function faimos_custom_search_form(){ ?>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

			        <input type="hidden" name="post_type" value="product" />
					<input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search...', 'faimos' ); ?>" value="" name="s">
					<input type="submit" class="search-submit" value="&#xf002;">

			</form>
		<?php }
	}

	//vAdd Social stats to single product
	if (!function_exists('faimos_social_stats')) {
		add_action( 'woocommerce_after_product_summary', 'faimos_social_stats' );
		function faimos_social_stats($product_id) {
			$vendor_id 		= wcfm_get_vendor_id_by_post( get_the_id() );
		  if( $vendor_id ) {
			$store_name 	= wcfm_get_vendor_store( absint($vendor_id) );
			$store_user 	= wcfmmp_get_store( $vendor_id );
			$store_info 	= $store_user->get_shop_info();
			$gravatar 		= $store_user->get_avatar(); 
			$description 	= $store_user->get_shop_description();
			echo '<div class="profile-wrapper">';
				echo '<div class="profile-links">';
					echo '<div class="logo_area lft"><img src="'.esc_url($gravatar).'" alt="Logo"/></div>';
					echo '<div class="wcfmmp_sold_by_store">'.wp_kses_post($store_name).'</div> ';
				echo '</div>';
				if(strlen(trim($description)) > 13) {
					echo _e($description);
				}
				
				if( isset( $store_info['social']['instagram'] ) || isset( $store_info['social']['instagram'] )) {
						echo '<ul class="wcfm-profile-stats">';

							if( get_user_meta($vendor_id, 'wcfm_instagram_count', true) ) {
							    echo '<li class="insta-panel">';
							    	echo '<i class="fab fa-instagram" aria-hidden="true" target="_blank"></i>';
							    	echo '<div class="panel-info">';
								    		echo'<span><a href="'.wcfmmp_generate_social_url( $store_info['social']['instagram'], 'instagram' ).'" target="_blank">'.get_user_meta($vendor_id, 'wcfm_instagram_count', true).' '.esc_html__('followers','faimos').'</a></span>';
								    echo '</div>';
							    echo '</li>';
							}

							if( get_user_meta($vendor_id, 'wcfm_twitter_count', true) ) {
							    echo '<li class="twitter-panel">';
							    	echo '<i class="fab fa-twitter" aria-hidden="true" target="_blank"></i>';
							    	echo '<div class="panel-info">';
								    		echo '<span><a href="'.wcfmmp_generate_social_url( $store_info['social']['twitter'], 'twitter' ).'" target="_blank">'.get_user_meta($vendor_id, 'wcfm_twitter_count', true).' '.esc_html__('followers','faimos').'</a></span>';
								    echo '</div>';
							    echo '</li>';
							}

							if( get_user_meta($vendor_id, 'wcfm_youtube_count', true) ) {
							    echo '<li class="youtube-panel">';
							    	echo '<i class="fab fa-youtube" aria-hidden="true" target="_blank"></i>';
							    	echo '<div class="panel-info">';
								    	echo '<span><a href="'.wcfmmp_generate_social_url( $store_info['social']['youtube'], 'youtube' ).'" target="_blank">'.get_user_meta($vendor_id, 'wcfm_youtube_count', true).' '.esc_html__('subscribers','faimos').'</a></span>';
								    echo '</div>';
							    echo '</li>';
							}

					echo '</ul>';
			echo '</div>';
			}
		}
	  }
	}
}



