    </div><!-- #content -->

    <!-- Footer -->
    <footer class="kr-footer" role="contentinfo">
        <!-- Footer Top -->
        <div class="kr-footer-top">
            <div class="kr-container">
                <div class="kr-footer-grid">
                    <!-- Brand Column -->
                    <div class="kr-footer-col">
                        <div class="kr-footer-brand">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php bloginfo('name'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <p class="kr-footer-desc">
                            <?php 
                            $tagline = get_bloginfo('description');
                            if ($tagline) {
                                echo esc_html($tagline);
                            } else {
                                esc_html_e('Your premier destination for discovering amazing creators and unique products. Join our community today!', 'kreators');
                            }
                            ?>
                        </p>
                        <div class="kr-footer-social">
                            <a href="#" aria-label="<?php esc_attr_e('Facebook', 'kreators'); ?>">
                                <?php kreators_icon('facebook'); ?>
                            </a>
                            <a href="#" aria-label="<?php esc_attr_e('Twitter', 'kreators'); ?>">
                                <?php kreators_icon('twitter'); ?>
                            </a>
                            <a href="#" aria-label="<?php esc_attr_e('Instagram', 'kreators'); ?>">
                                <?php kreators_icon('instagram'); ?>
                            </a>
                            <a href="#" aria-label="<?php esc_attr_e('LinkedIn', 'kreators'); ?>">
                                <?php kreators_icon('linkedin'); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="kr-footer-col">
                        <h4 class="kr-footer-title"><?php esc_html_e('Quick Links', 'kreators'); ?></h4>
                        <?php
                        if (has_nav_menu('footer')) {
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'menu_class'     => 'kr-footer-links',
                                'container'      => false,
                                'depth'          => 1,
                                'fallback_cb'    => false,
                            ));
                        } else {
                            ?>
                            <ul class="kr-footer-links">
                                <li><a href="<?php echo esc_url(home_url('/about/')); ?>"><?php esc_html_e('About Us', 'kreators'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/shop/')); ?>"><?php esc_html_e('Shop', 'kreators'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/blog/')); ?>"><?php esc_html_e('Blog', 'kreators'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact', 'kreators'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/faq/')); ?>"><?php esc_html_e('FAQs', 'kreators'); ?></a></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Customer Service -->
                    <div class="kr-footer-col">
                        <h4 class="kr-footer-title"><?php esc_html_e('Customer Service', 'kreators'); ?></h4>
                        <ul class="kr-footer-links">
                            <?php if (class_exists('WooCommerce')) : ?>
                                <li><a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('My Account', 'kreators'); ?></a></li>
                                <li><a href="<?php echo esc_url(wc_get_cart_url()); ?>"><?php esc_html_e('Cart', 'kreators'); ?></a></li>
                            <?php endif; ?>
                            <li><a href="#"><?php esc_html_e('Track Order', 'kreators'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Shipping Info', 'kreators'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Returns', 'kreators'); ?></a></li>
                            <li><a href="#"><?php esc_html_e('Help Center', 'kreators'); ?></a></li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="kr-footer-col">
                        <h4 class="kr-footer-title"><?php esc_html_e('Newsletter', 'kreators'); ?></h4>
                        <p><?php esc_html_e('Subscribe to our newsletter for the latest updates and exclusive offers.', 'kreators'); ?></p>
                        <div class="kr-footer-newsletter">
                            <form class="kr-footer-newsletter-form" action="#" method="post">
                                <input type="email" class="kr-footer-newsletter-input" placeholder="<?php esc_attr_e('Your email address', 'kreators'); ?>" required>
                                <button type="submit" class="kr-footer-newsletter-btn"><?php esc_html_e('Subscribe', 'kreators'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="kr-footer-bottom">
            <div class="kr-container">
                <div class="kr-footer-bottom-inner">
                    <div class="kr-footer-copyright">
                        <?php
                        printf(
                            esc_html__('© %1$s %2$s. All rights reserved.', 'kreators'),
                            date('Y'),
                            get_bloginfo('name')
                        );
                        ?>
                    </div>
                    <div class="kr-footer-legal">
                        <a href="#"><?php esc_html_e('Privacy Policy', 'kreators'); ?></a>
                        <a href="#"><?php esc_html_e('Terms of Service', 'kreators'); ?></a>
                        <a href="#"><?php esc_html_e('Cookie Policy', 'kreators'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="kr-back-to-top" aria-label="<?php esc_attr_e('Back to top', 'kreators'); ?>">
        <?php kreators_icon('arrow-up'); ?>
    </button>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
