<?php

add_action( 'end_wcfm_vendor_settings', function( $vendor_id ) {
	global $WCFM;
	$wcfm_twitter_count = get_user_meta( $vendor_id, 'wcfm_twitter_count', true );	
	$wcfm_instagram_count = get_user_meta( $vendor_id, 'wcfm_instagram_count', true );
	$wcfm_youtube_count = get_user_meta( $vendor_id, 'wcfm_youtube_count', true );
	?>                                
	<!-- collapsible -->
	<div class="page_collapsible" id="wcfm_settings_form_additional_head">
		<label class="fa fa-certificate"></label>
		<?php esc_html_e('Social Stats', 'faimos'); ?><span></span>
	</div>
	<div class="wcfm-container">
		<div id="wcfm_settings_form_additional_expander" class="wcfm-content">
			<h2><?php esc_html_e('Social Stats', 'faimos'); ?></h2>
			<div class="wcfm_clearfix"></div>
			
			<?php
				$WCFM->wcfm_fields->wcfm_generate_form_field( array(
					"wcfm_twitter_count" => array( 'label' => esc_html__( 'Twitter Count', 'faimos'), 'name' => 'wcfm_twitter_count', 'type' => 'text', 'class' => 'wcfm-text wcfm_ele', 'label_class' => 'wcfm_title wcfm_ele', 'value' => $wcfm_twitter_count ),
					) );
				$WCFM->wcfm_fields->wcfm_generate_form_field( array(
					"wcfm_instagram_count" => array( 'label' => esc_html__( 'Instagram Count', 'faimos'), 'name' => 'wcfm_instagram_count', 'type' => 'text', 'class' => 'wcfm-text wcfm_ele', 'label_class' => 'wcfm_title wcfm_ele', 'value' => $wcfm_instagram_count ),
					) );
				$WCFM->wcfm_fields->wcfm_generate_form_field( array(
					"wcfm_youtube_count" => array( 'label' => esc_html__( 'Youtube Count', 'faimos'), 'name' => 'wcfm_youtube_count', 'type' => 'text', 'class' => 'wcfm-text wcfm_ele', 'label_class' => 'wcfm_title wcfm_ele', 'value' => $wcfm_youtube_count ),
					) );
			?>
		</div>
	</div>
	<?php
}, 50, 1 );

add_action( 'wcfm_vendor_settings_update', function( $vendor_id, $wcfm_settings_form ) {
	global $WCFM, $_POST;
	if( isset( $wcfm_settings_form['wcfm_twitter_count'] ) ) {
		update_user_meta( $vendor_id, 'wcfm_twitter_count', $wcfm_settings_form['wcfm_twitter_count'] );
	}
	if( isset( $wcfm_settings_form['wcfm_instagram_count'] ) ) {
		update_user_meta( $vendor_id, 'wcfm_instagram_count', $wcfm_settings_form['wcfm_instagram_count'] );
	}
	if( isset( $wcfm_settings_form['wcfm_youtube_count'] ) ) {
		update_user_meta( $vendor_id, 'wcfm_youtube_count', $wcfm_settings_form['wcfm_youtube_count'] );
	}
}, 50, 2 );