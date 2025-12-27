<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package faimos
 */
?>
<?php
global $faimos_redux;
?>

    <?php if ( !class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
        <!-- BACK TO TOP BUTTON -->
        <a class="back-to-top modeltheme-is-visible modeltheme-fade-out" href="<?php echo esc_url('#0'); ?>">
            <span></span>
        </a>
    <?php }else{ ?>
        <?php if (faimos_redux('faimos_backtotop_status') == true) { ?>
            <!-- BACK TO TOP BUTTON -->
           <a class="back-to-top modeltheme-is-visible modeltheme-fade-out" href="<?php echo esc_url('#0'); ?>">
                <span></span>
            </a>
        <?php } ?>
    <?php } ?>

    <?php
        $footer_widgets = 'no-footer-widgets';
        if ( is_active_sidebar( 'footer_column_1' ) || is_active_sidebar( 'footer_column_2' ) || is_active_sidebar( 'footer_column_3' ) || is_active_sidebar( 'footer_column_4' ) || is_active_sidebar( 'footer_column_5' ) ) {
            $footer_widgets = 'has-footer-widgets';
        }
    ?>
    <!-- MAIN FOOTER -->
    <footer class="<?php echo esc_attr($footer_widgets); ?>">
        <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
            <?php if ( $faimos_redux['faimos-enable-footer-widgets'] == true  || $faimos_redux['faimos-enable-footer-widgets-row2'] == true || $faimos_redux['faimos-enable-footer-widgets-row3'] == true) { ?>
                <div class="container footer-top">
                    <?php 
                    if ( $faimos_redux['faimos-enable-footer-widgets'] == true ) { ?>
                        <div class="row footer-row-1">
                            <?php
                            $columns    = 12/intval($faimos_redux['faimos_number_of_footer_columns']);
                            $nr         = array("1", "2", "3", "5", "6");

                            if (in_array($faimos_redux['faimos_number_of_footer_columns'], $nr)) {
                                $class = 'col-md-'.esc_html($columns);
                                for ( $i=1; $i <= intval( $faimos_redux['faimos_number_of_footer_columns'] ) ; $i++ ) { 

                                    echo '<div class="'.esc_attr($class).' widget widget_text">';
                                        dynamic_sidebar( 'footer_column_'.esc_html($i) );
                                    echo '</div>';

                                }
                            }elseif($faimos_redux['faimos_number_of_footer_columns'] == 4){
                                #First
                                if ( is_active_sidebar( 'footer_column_1' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_1' );
                                    echo '</div>';
                                }
                                #Second
                                if ( is_active_sidebar( 'footer_column_2' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_2' );
                                    echo '</div>';
                                }
                                #Third
                                if ( is_active_sidebar( 'footer_column_3' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_3' );
                                    echo '</div>';
                                }
                                #Fourth
                                if ( is_active_sidebar( 'footer_column_4' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_4' );
                                    echo '</div>';
                                }
                                
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <?php if ($faimos_redux['faimos-enable-footer-widgets-row2'] == true) { ?>
                        <div class="row footer-row-2">
                            <?php
                            $columns    = 12/intval($faimos_redux['faimos_number_of_footer_columns_row2']);
                            $nr         = array("1", "2", "3", "4", "6");

                            if (in_array($faimos_redux['faimos_number_of_footer_columns_row2'], $nr)) {
                                $class = 'col-md-'.esc_html($columns);
                                for ( $i=1; $i <= intval( $faimos_redux['faimos_number_of_footer_columns_row2'] ) ; $i++ ) { 

                                    echo '<div class="'.esc_attr($class).' widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row2'.esc_html($i) );
                                    echo '</div>';

                                }
                            }elseif($faimos_redux['faimos_number_of_footer_columns_row2'] == 5){
                                #First
                                if ( is_active_sidebar( 'footer_column_row21' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row21' );
                                    echo '</div>';
                                }
                                #Second
                                if ( is_active_sidebar( 'footer_column_row22' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row22' );
                                    echo '</div>';
                                }
                                #Third
                                if ( is_active_sidebar( 'footer_column_row23' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row23' );
                                    echo '</div>';
                                }
                                #Fourth
                                if ( is_active_sidebar( 'footer_column_row24' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row24' );
                                    echo '</div>';
                                }
                                #Fifth
                                if ( is_active_sidebar( 'footer_column_row25' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row25' );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <?php if ($faimos_redux['faimos-enable-footer-widgets-row3'] == true) { ?>
                        <div class="row footer-row-3">
                            <?php
                            $columns    = 12/intval($faimos_redux['faimos_number_of_footer_columns_row3']);
                            $nr         = array("1", "2", "3", "4", "6");

                            if (in_array($faimos_redux['faimos_number_of_footer_columns_row3'], $nr)) {
                                $class = 'col-md-'.esc_html($columns);
                                for ( $i=1; $i <= intval( $faimos_redux['faimos_number_of_footer_columns_row3'] ) ; $i++ ) { 

                                    echo '<div class="'.esc_attr($class).' widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row3'.esc_html($i) );
                                    echo '</div>';

                                }
                            }elseif($faimos_redux['faimos_number_of_footer_columns_row3'] == 5){
                                #First
                                if ( is_active_sidebar( 'footer_column_row31' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row31' );
                                    echo '</div>';
                                }
                                #Second
                                if ( is_active_sidebar( 'footer_column_row32' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row32' );
                                    echo '</div>';
                                }
                                #Third
                                if ( is_active_sidebar( 'footer_column_row33' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row33' );
                                    echo '</div>';
                                }
                                #Fourth
                                if ( is_active_sidebar( 'footer_column_row34' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row34' );
                                    echo '</div>';
                                }
                                #Fifth
                                if ( is_active_sidebar( 'footer_column_row35' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row35' );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } ?>

        <?php do_action('faimos_before_footer_mobile_navigation'); ?>

        <div class="footer footer-copyright">
            <div class="container">
                <div class="row">
                    <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                        <div class="col-md-6">
                            <p class="copyright"><?php echo wp_kses($faimos_redux['faimos_footer_text_left'], 'link'); ?></p>
                        </div>
                        <div class="col-md-6 payment-methods">
                            <img src="<?php echo esc_url(get_template_directory_uri().'/images/payments.png'); ?>" alt="<?php echo esc_attr("Payment Methods", "faimos"); ?>" width="300" />
                        </div>
                    <?php }else { ?>
                        <div class="col-md-12">
                            <p class="copyright"><?php esc_html_e( 'Copyright by ModelTheme. All Rights Reserved.', 'faimos' ); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>