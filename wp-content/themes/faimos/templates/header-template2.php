<?php
  #Redux global variable
  global $faimos_redux;
  #WooCommerce global variable
  global $woocommerce;
  $cart_url = "#";
  if ( class_exists( 'WooCommerce' ) ) {
    $cart_url = wc_get_cart_url();
  }
  #YITH Wishlist rul
  if( function_exists( 'YITH_WCWL' ) ){
      $wishlist_url = YITH_WCWL()->get_wishlist_url();
  }else{
      $wishlist_url = '#';
  }
?>
<?php  
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
  if ( faimos_redux('faimos_top_header_info_switcher') == true) {
      echo faimos_my_banner_header();
  }
} ?>
<header class="header-v2">
  <div class="navbar navbar-default" id="faimos-main-head">
      <div class="container">
        <div class="row header-shadow">
          <div class="navbar-header col-md-2 col-sm-12">

            <?php if ( !class_exists( 'mega_main_init' ) ) { ?> 
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
            <?php } ?>

            <?php do_action('faimos_before_mobile_navigation_burger'); ?>

            <?php echo faimos_logo(); ?>
          </div>
              

        <nav class="col-md-6 navbar bottom-navbar-default" id="modeltheme-main-head">
          <div class="row row-0">
            <!-- NAV MENU -->
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="menu nav navbar-nav nav-effect nav-menu">
                <?php
                  if ( has_nav_menu( 'primary' ) ) {
                    $defaults = array(
                      'menu'            => '',
                      'container'       => false,
                      'container_class' => '',
                      'container_id'    => '',
                      'menu_class'      => 'menu',
                      'menu_id'         => '',
                      'echo'            => true,
                      'fallback_cb'     => false,
                      'before'          => '',
                      'after'           => '',
                      'link_before'     => '',
                      'link_after'      => '',
                      'items_wrap'      => '%3$s',
                      'depth'           => 0,
                      'walker'          => ''
                    );
                    $defaults['theme_location'] = 'primary';
                    wp_nav_menu( $defaults );
                  }else{
                    echo '<p class="no-menu text-left">';
                      echo esc_html__('Primary navigation menu is missing.', 'faimos');
                    echo '</p>';
                  }
                ?>
              </ul>
            </div>

          </div>
    </nav>
    <nav class="navbar bottom-menu-wrapper"></nav>
           <?php if (class_exists('WooCommerce')) { ?>
              <div class="col-md-4 menu-products">
            <?php } else { ?>
              <div class="col-md-4 menu-products">
              <?php } ?>
              <?php if ( class_exists('woocommerce')) { ?>
                  <?php if (!is_user_logged_in()) { ?> 
                    <a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>"><i class="fas fa-sign-in-alt"></i></a>
                  <?php } ?>
                <?php } ?>
                <div class="my-account-navbar header-button">
                  <ul>
                  <?php if ( class_exists('woocommerce')) { ?>
                    <?php if (is_user_logged_in()) { ?> 
                      <div id="dropdown-user-profile" class="ddmenu">
                        
                        <li id="nav-menu-register" class="nav-menu-account">
                          <span class="top-register"><?php echo esc_html__('My Account','faimos'); ?></span>
                        </li>
                        <ul>
                          <li><a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>"><i class="icon-layers icons"></i> <?php echo esc_html__('My Dashboard','faimos'); ?></a></li>
                          
                          <?php if (class_exists('WCFM')) { ?>
                            <li><a href="<?php echo apply_filters( 'wcfm_dashboard_home', get_wcfm_page() ); ?>"><i class="icon-trophy icons"></i> <?php echo esc_html__('Creator Dashboard','faimos'); ?></a></li>
                          <?php } ?>
                          
                          <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')).'orders'); ?>"><i class="icon-bag icons"></i> <?php echo esc_html__('My Orders','faimos'); ?></a></li>
                          <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')).'edit-account'); ?>"><i class="icon-user icons"></i> <?php echo esc_html__('Account Details','faimos'); ?></a></li>
                          <div class="dropdown-divider"></div>
                          <li><a href="<?php echo esc_url(wp_logout_url( home_url() )); ?>"><i class="icon-logout icons"></i> <?php echo esc_html__('Log Out','faimos'); ?></a></li>
                        </ul>
                      </div>
                    <?php } else { ?> <!-- logged out -->
                      <li id="nav-menu-login" class="faimos-logoin">               
                        <a href ="<?php echo esc_html($faimos_redux['faimos_second_header_button']); ?>" >
                          <span class="top-register"><?php echo esc_html__('Join as Creator','faimos'); ?></span>
                        </a>
                      </li>
                    <?php } ?>
                  <?php } ?>
                  </ul>
                </div>
                <?php if ( class_exists('woocommerce')) { ?>
                    <?php if (!is_user_logged_in()) { ?> 
                      <?php 
                        $user = wp_get_current_user();
                        if ( in_array( 'author', (array) $user->roles ) ) {?>
                          <div class="header-button"><a href="<?php echo apply_filters( 'wcfm_dashboard_home', get_wcfm_page() ); ?>"><?php echo esc_html__('My Account','faimos'); ?></a></div>
                      <?php } else { ?> 
                         <div class="header-button"><a href="<?php echo esc_html($faimos_redux['faimos_second_header_button1']); ?>"><?php echo esc_html__('Join As Brand','faimos'); ?></a></div>
                      <?php } ?> 
                <?php } } ?>
            </div>
        </div>
   
  </div>

  <!-- BOTTOM BAR -->
    
  </div>
</header>