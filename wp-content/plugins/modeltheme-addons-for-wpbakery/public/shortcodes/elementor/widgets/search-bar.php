<?php
namespace Elementor;

class addons_search_bar extends Widget_Base {
	public function get_style_depends() {
    	wp_enqueue_style( 'search-bar-css', plugins_url( '../../../css/search-bar.css' , __FILE__ ));

        return [
            'search-bar-css',
        ];
    }
	public function get_name() {
		return 'search-bar';
	}
	 
	public function get_title() {
		return 'MT - Search Bar';
	}
	
	public function get_icon() {
		return 'eaicon-post-block';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	
	

	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'style_var', 
			[
				'label' => __( 'Style', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       	 	=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'' 				=> __( 'Products', 'modeltheme-addons-for-wpbakery' ),
					'posts' 		=> __( 'Posts ', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->end_controls_section();

	}
	                 
	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $style_var 					= $settings['style_var'];
     
		$shortcode_content = '';
        $shortcode_content .= do_shortcode('[mt-addons-search-bar page_builder="elementor" style_var="'.$style_var.'"]');
        echo  $shortcode_content;

}
	protected function content_template() {

    }
}