<?php

// fancy slider
require_once('widgets/slider-for-elementor/slider-for-elementor.php');

class MT_Addons_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {
		require_once('widgets/products-category-group.php');
		require_once('widgets/title-subtitle.php');
		require_once('widgets/button-widget.php');
		require_once('widgets/products-category-list.php');
		require_once('widgets/icon-with-text.php');
		require_once('widgets/blog-posts.php');
		require_once('widgets/members.php');
		require_once('widgets/clients.php');
		require_once('widgets/testimonials.php');
		require_once('widgets/contact-form.php');
		require_once('widgets/video.php');
		require_once('widgets/social-icon-box.php');
		require_once('widgets/circle-text.php');
		require_once('widgets/absolute-element.php');
		require_once('widgets/spacer.php');
		require_once('widgets/hero-slider.php');
		require_once('widgets/product-category.php');
		require_once('widgets/products-carousel.php');
		require_once('widgets/process.php');
		require_once('widgets/skill-counter.php');
		require_once('widgets/tabs.php');
		require_once('widgets/featured-product.php');
		require_once('widgets/pricing-table.php');
		require_once('widgets/search-bar.php');
		require_once('widgets/accordion.php');
		require_once('widgets/highlighted-text.php');
		require_once('widgets/row-overlay.php');
		require_once('widgets/map-pins.php');
		require_once('widgets/before-after-comparison.php');
		require_once('widgets/marquee-texts-hero.php');
		require_once('widgets/parallax-image.php');
		require_once('widgets/posts-a-z.php');
		require_once('widgets/products-category-banner.php');
		require_once('widgets/timeline.php');
		require_once('widgets/svg-blob.php');
		require_once('widgets/stylized-numbers.php');
		require_once('widgets/typed-text.php');
		require_once('widgets/row-separator.php');
		require_once('widgets/products-list.php');
		require_once('widgets/products-filters.php');
		require_once('widgets/category-tabs.php');
		require_once('widgets/masonry-banners.php');
		require_once('widgets/contact-card.php');
        require_once('widgets/pricing-services.php');
        require_once('widgets/pricing-table-v2.php');
        require_once('widgets/category-card.php');
        require_once('widgets/sale-banner.php');
        require_once('widgets/horizontal-timeline.php');
		require_once('widgets/niche-categories.php');
		require_once('widgets/trail-slider.php');
		require_once('widgets/crossroads-slider.php');
		require_once('widgets/motion-slider.php');
        require_once('widgets/mt-flaticon-featured-product.php');
		require_once('widgets/week-days.php');
        if ( class_exists( 'buddypress' ) ) { 
			require_once('widgets/buddypress-members.php');
			require_once('widgets/buddypress-groups.php');
		}
		require_once('widgets/cta-banner.php');
		require_once('widgets/icon-box-grid-item.php');
		require_once('widgets/tabs-style-v2.php');
		require_once('widgets/ticker.php');
		require_once('widgets/portfolio-grid-images.php');
		require_once('widgets/image-box.php');
        require_once('widgets/featured-simple-product.php');
        require_once('widgets/styled-product.php');
        require_once('widgets/sale-banner-v2.php');
        require_once('widgets/styled-blog.php');


		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_products_category_group() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_title_subtitle() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_button_widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_products_category_list() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_icon_with_text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_blog_posts() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_members() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_clients() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_contact_form() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_mt_video() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_mt_social_icon_box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_circle_text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_absolute_element() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_mt_spacer() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_hero_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_products_category() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_products_carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_process() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_skill_counter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_featured_product() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_pricing_table() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_search_bar() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_highlighted_text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_row_overlay() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_map_pins() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_before_after_comparison() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_marquee_texts_hero() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_parallax_image() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_posts_a_z() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_products_category_banner() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_svg_blob() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_stylized_numbers() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_typed_text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_row_separator() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_products_list() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_products_filters() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_category_tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_masonry_banners() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_contact_card() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_pricing_services() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_pricing_table_v2() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_category_card() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_sale_banner() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_horizontal_timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_niche_categories() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_trail_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_crossroads_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_motion_slider() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_mt_flaticon_featured_product() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_week_days() );
        if ( class_exists( 'buddypress' ) ) { 
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_buddypress_members() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_buddypress_groups() );
		}
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_cta_banner() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_icon_box_grid_item() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_tabs_style_v2() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_ticker() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_portfolio_images() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_image_box() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_featured_simple_product() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_styled_product() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_sale_banner_v2() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\addons_styled_blog() );

	}

}

add_action( 'init', 'my_elementor_init' );
function my_elementor_init() {
	MT_Addons_Widgets::get_instance();
}

function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'addons-widgets',
		[
			'title' => __( 'Addons', 'modeltheme-addons-for-wpbakery' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );