<?php
/**
 * The Template for displaying store.
 *
 * @package WCfM Markeplace Views Store
 *
 * For edit coping this to yourtheme/wcfm/store 
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $WCFM, $WCFMmp;

$wcfm_store_url    = wcfm_get_option( 'wcfm_store_url', 'store' );
$wcfm_store_name   = apply_filters( 'wcfmmp_store_query_var', get_query_var( $wcfm_store_url ) );
if ( empty( $wcfm_store_name ) ) return;
$seller_info       = get_user_by( 'slug', $wcfm_store_name );
if( !$seller_info ) return;

$store_user        = wcfmmp_get_store( $seller_info->ID );
$store_info        = $store_user->get_shop_info();
$gravatar = $store_user->get_avatar();
$email    = $store_user->get_email();
$phone    = $store_user->get_phone(); 
$address  = $store_user->get_address_string(); 
$store_sidebar_pos = isset( $WCFMmp->wcfmmp_marketplace_options['store_sidebar_pos'] ) ? $WCFMmp->wcfmmp_marketplace_options['store_sidebar_pos'] : 'left';

$wcfm_store_wrapper_class = apply_filters( 'wcfm_store_wrapper_class', '' );

$wcfm_store_color_settings = get_option( 'wcfm_store_color_settings', array() );
$mob_wcfmmp_header_background_color = ( isset($wcfm_store_color_settings['header_background']) ) ? $wcfm_store_color_settings['header_background'] : '#3e3e3e';

get_header( 'shop' );
?>

<?php if( $WCFMmp->wcfmmp_vendor->is_store_sidebar() && ($store_sidebar_pos != 'left' ) ) { ?>
	<style>
		#wcfmmp-store .right_side{float:left !important;}
		#wcfmmp-store .left_sidebar{float:right !important;}
	</style>
<?php } ?>
<style>
@media screen and (max-width: 480px) {
	#wcfmmp-store .header_right {
		background: <?php echo esc_attr($mob_wcfmmp_header_background_color); ?>;
	}
}
</style>		
<?php //do_action( 'woocommerce_before_main_content' ); ?>
<?php echo '<div id="primary" class="content-area"><main id="main" class="site-main" role="main">'; ?>
<?php do_action( 'wcfmmp_before_store', $store_user->data, $store_info ); ?>

<div id="wcfmmp-store" class="wcfmmp-single-store-holder <?php echo esc_attr($wcfm_store_wrapper_class); ?>">
	<div id="wcfmmp-store-content" class="wcfmmp-store-page-wrap woocommerce" role="main">
			
		<?php $WCFMmp->template->get_template( 'store/wcfmmp-view-store-banner.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) ); ?>
		
		<?php do_action( 'wcfmmp_after_store_header', $store_user->data, $store_info ); ?>
            
    <div class="body_area container">
    
      <?php 
			if( !apply_filters( 'wcfmmp_is_allow_mobile_sidebar_at_bottom', true ) ) {
				$WCFMmp->template->get_template( 'store/wcfmmp-view-store-sidebar.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
			}
			?>
			
			
			<div class="wcfm-socials-wrap col-md-4">
				 	<div class="lft header_left">
			
						<?php do_action( 'wcfmmp_store_before_avatar', $store_user->get_id() ); ?>
						
						<div class="logo_area lft"><a href="#"><img src="<?php echo esc_url($gravatar); ?>" alt="Logo"/></a></div>
						
						<div class="logo_area_after">
							<?php do_action( 'wcfmmp_store_after_avatar', $store_user->get_id() ); ?>
							
							
							<?php if( !apply_filters( 'wcfm_is_allow_badges_with_store_name', false ) ) { ?>
								<div class="wcfmmp_store_mobile_badges">
									<?php do_action( 'wcfmmp_store_mobile_badges', $store_user->get_id() ); ?>
									<div class="spacer"></div> 
								</div>
							<?php } ?>
							<h3><?php echo apply_filters( 'wcfmmp_store_title', $store_info['store_name'], $store_user->get_id() ); ?></h3>
							<div class="spacer"></div>  
						</div>
						
						<div class="address rgt">
						  <?php if( ( $WCFMmp->wcfmmp_vendor->get_vendor_name_position( $store_user->get_id() ) == 'on_header' ) || apply_filters( 'wcfm_is_allow_store_name_on_header', false ) ) { ?>
						  	<h1 class="wcfm_store_title">
						  	  <?php echo apply_filters( 'wcfmmp_store_title', esc_html( $store_info['store_name'] ), $store_user->get_id() ); ?>
						  	  <?php if( apply_filters( 'wcfm_is_allow_badges_with_store_name', false ) ) { ?>
										<div class="wcfmmp_store_mobile_badges wcfmmp_store_mobile_badges_with_store_name">
											<?php do_action( 'wcfmmp_store_mobile_badges', $store_user->get_id() ); ?>
											<div class="spacer"></div> 
										</div>
									<?php } ?>
						  	</h1>
						  <?php $store_address_info_class = 'header_store_name'; } ?>
						  
						  <?php do_action( 'before_wcfmmp_store_header_info', $store_user->get_id() ); ?>
							<?php do_action( 'wcfmmp_store_before_address', $store_user->get_id() ); ?>
							
							<?php if( $address && ( $store_info['store_hide_address'] == 'no' ) && wcfm_vendor_has_capability( $store_user->get_id(), 'vendor_address' ) ) { ?>
								<p class="<?php echo esc_attr($store_address_info_class); ?> wcfmmp_store_header_address">
								  <i class="wcfmfa fa-map-marker" aria-hidden="true"></i>
								  <?php if( apply_filters( 'wcfmmp_is_allow_address_map_linked', true ) ) { 
								  	$map_search_link = 'https://google.com/maps/place/' . rawurlencode( $address ) . '/@' . $store_lat . ',' . $store_lng . '&z=16';
								  	if( wcfm_is_mobile() || wcfm_is_tablet() ) {
								  		$map_search_link = 'https://maps.google.com/?q=' . rawurlencode( $address ) . '&z=16';
								  	}
								  	?>
								    <a href="<?php echo esc_url($map_search_link); ?>" target="_blank"><span><?php echo esc_attr($address); ?></span></a>
								  <?php } else { ?>
										<?php echo esc_attr($address); ?>
									<?php } ?>
								</p>
							<?php } ?>
							
							<?php do_action( 'wcfmmp_store_after_address', $store_user->get_id() ); ?>
							
							<div class="<?php echo esc_attr($store_address_info_class); ?>">
								
							  <?php do_action( 'wcfmmp_store_before_phone', $store_user->get_id() ); ?>
								
							  <?php if( $phone && ( $store_info['store_hide_phone'] == 'no' ) && wcfm_vendor_has_capability( $store_user->get_id(), 'vendor_phone' ) ) { ?>
									<div class="store_info_parallal wcfmmp_store_header_phone" style="margin-right: 10px;">
									  <i class="wcfmfa fa-phone" aria-hidden="true"></i>
									  <span>
									    <?php if( apply_filters( 'wcfmmp_is_allow_tel_linked', true ) ) { ?>
									      <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_attr($phone); ?></a>
									    <?php } else { ?>
									    	<?php echo esc_attr($phone); ?>
									   <?php } ?>
									  </span>
									</div>
								<?php } ?>
								
								<?php do_action( 'wcfmmp_store_after_phone', $store_user->get_id() ); ?>
								<?php do_action( 'wcfmmp_store_before_email', $store_user->get_id() ); ?>
								
								<?php if( $email && ( $store_info['store_hide_email'] == 'no' ) && wcfm_vendor_has_capability( $store_user->get_id(), 'vendor_email' ) ) { ?>
									<div class="store_info_parallal wcfmmp_store_header_email">
									  <i class="wcfmfa fa-envelope" aria-hidden="true"></i>
									  <span>
									    <?php if( apply_filters( 'wcfmmp_is_allow_mailto_linked', true ) ) { ?>
									      <a href="mailto:<?php echo apply_filters( 'wcfmmp_mailto_email', $email, $store_user->get_id() ); ?>"><?php echo esc_attr($email); ?></a>
									    <?php } else { ?>
									    	<?php echo esc_attr($email); ?>
									    <?php } ?>
									  </span>
									</div>
								<?php } ?>
								
								<?php do_action( 'wcfmmp_store_after_email', $store_user->get_id() ); ?>
								
								<div class="spacer"></div>  
							</div>
							
							<?php do_action( 'after_wcfmmp_store_header_info', $store_user->get_id() ); ?>
						</div> 
					</div>
					<?php if( isset( $store_info['social']['instagram'] ) || isset( $store_info['social']['twitter'] )) { ?>
		    	<div class="rgt right_side ">
			    	<h4><?php echo esc_html__('Social Stats'); ?></h4>
			    	<ul class="wcfm-social-panels">

							<?php if( isset( $store_info['social']['instagram'] ) && !empty( $store_info['social']['instagram'] ) ) { ?>
				    		<li class="insta-panel">
				    			<i class="fab fa-instagram" aria-hidden="true" target="_blank"></i>
				    			<div class="panel-info">
					    			<p><a href="<?php echo wcfmmp_generate_social_url( $store_info['social']['instagram'], 'instagram' ); ?>" target="_blank"><?php echo $store_info['social']['instagram'];?></a></p>
					    			<span><?php echo get_user_meta($seller_info->ID, 'wcfm_instagram_count', true); ?> <?php echo esc_html__('followers','faimos'); ?></span>
					    		</div>
				    		</li>
				    	<?php } ?>

				    	<?php if( get_user_meta($seller_info->ID, 'wcfm_twitter_count', true) ) { ?>
				    		<li class="twitter-panel">
				    			<i class="fab fa-twitter" aria-hidden="true" target="_blank"></i>
				    			<div class="panel-info">
					    			<p><a href="<?php echo wcfmmp_generate_social_url( $store_info['social']['twitter'], 'twitter' ); ?>" target="_blank"><?php echo $store_info['social']['twitter'];?></a></p>
					    			<span><?php echo get_user_meta($seller_info->ID, 'wcfm_twitter_count', true); ?> <?php echo esc_html__('followers','faimos'); ?></span>
					    		</div>
				    		</li>
				    	<?php } ?>

				    	<?php if( get_user_meta($seller_info->ID, 'wcfm_youtube_count', true ) ) { ?>
				    		<li class="youtube-panel">
				    			<i class="fab fa-youtube" aria-hidden="true" target="_blank"></i>
				    			<div class="panel-info">
					    			<p><a href="<?php echo wcfmmp_generate_social_url( $store_info['social']['youtube'], 'youtube' ); ?>" target="_blank"><?php echo $store_info['social']['youtube'];?></a></p>
					    			<span><?php echo get_user_meta($seller_info->ID, 'wcfm_youtube_count', true); ?> <?php echo esc_html__('subscribers','faimos'); ?></span>
					    		</div>
				    		</li>
				    	<?php } ?>

			    	</ul>
			    </div>
			  <?php } ?>
		    </div>
	   


			<div class="rgt right_side <?php if( !$WCFMmp->wcfmmp_vendor->is_store_sidebar() ) echo 'right_side_full'; ?>">
				<div id="tabsWithStyle" class="tab_area">
					
					<?php do_action( 'wcfmmp_before_store_tabs', $store_user->data, $store_info ); ?>
					
					<?php $WCFMmp->template->get_template( 'store/wcfmmp-view-store-tabs.php', array( 'store_user' => $store_user, 'store_info' => $store_info, 'store_tab' => $store_tab ) ); ?>
					
					<?php do_action( 'wcfmmp_after_store_tabs', $store_user->data, $store_info ); ?>
					<h3><?php echo esc_html__('Listings','faimos'); ?></h3>
					<?php 
						switch( $store_tab ) {
							case 'about':
								$WCFMmp->template->get_template( 'store/wcfmmp-view-store-about.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
								break;
								
							case 'policies':
								$WCFMmp->template->get_template( 'store/wcfmmp-view-store-policies.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
								break;
								
							case 'reviews':
								$WCFMmp->template->get_template( 'store/wcfmmp-view-store-reviews.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
								break;
								
							case 'followers':
								$WCFMmp->template->get_template( 'store/wcfmmp-view-store-followers.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
								break;
								
							case 'followings':
								$WCFMmp->template->get_template( 'store/wcfmmp-view-store-followings.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
								break;
								
						  case 'articles':
								$WCFMmp->template->get_template( 'store/wcfmmp-view-store-articles.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
								break;
								
							default:
								$WCFMmp->template->get_template( apply_filters( 'wcfmmp_store_default_template', apply_filters( 'wcfmp_store_default_template', 'store/wcfmmp-view-store-products.php', $store_tab ), $store_tab ), array( 'store_user' => $store_user, 'store_info' => $store_info ), '', apply_filters( 'wcfmp_store_default_template_path', '', $store_tab ) );
								break;
						}	
					?>
					
				</div><!-- .tab_area -->
			</div><!-- .right_side -->


			<?php 
			if( apply_filters( 'wcfmmp_is_allow_mobile_sidebar_at_bottom', true ) ) {
				$WCFMmp->template->get_template( 'store/wcfmmp-view-store-sidebar.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
			}
			?>
			 
			<div class="spacer"></div>
    </div><!-- .body_area -->

   
    <div class="wcfm-clearfix"></div>
	</div><!-- .wcfmmp-store-page-wrap -->
	<div class="wcfm-clearfix"></div>
</div><!-- .wcfmmp-single-store-holder -->

<div class="wcfm-clearfix"></div>

<?php do_action( 'wcfmmp_after_store', $store_user->data, $store_info ); ?>
<?php //do_action( 'woocommerce_after_main_content' ); ?>
<?php echo '</main></div>'; ?>
<script>
jQuery(document).ready(function($) {
	$('#tab_links_area').find('a').each(function() {
		$(this).off('click').on('click', function() {
			window.location.href = $(this).attr('href');
		});
	});
});
</script>
<?php get_footer( 'shop' ); ?>