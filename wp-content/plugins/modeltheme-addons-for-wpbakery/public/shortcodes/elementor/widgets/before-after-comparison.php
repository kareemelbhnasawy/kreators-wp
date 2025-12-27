<?php
namespace Elementor;

class addons_before_after_comparison extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'twentytwenty-no-compass', plugins_url( '../../../css/plugins/twentytwenty/twentytwenty-no-compass.css' , __FILE__ ));
  		wp_enqueue_style( 'mt-before-after-comparison', plugins_url( '../../../css/before-after-comparison.css' , __FILE__ ));

        return [
            'twentytwenty-no-compass',
            'mt-before-after-comparison',
        ];
    }
    public function get_script_depends() {
        
        wp_register_script( 'jquery-event-move', plugins_url( '../../../js/plugins/twentytwenty/jquery.event.move.js' , __FILE__));
        wp_register_script( 'jquery-twentytwenty', plugins_url( '../../../js/plugins/twentytwenty/jquery.twentytwenty.js' , __FILE__));
        
        return [ 'jquery', 'elementor-frontend', 'jquery-twentytwenty', 'jquery-event-move' ];
    }
    
	public function get_name() {
		return 'before-after-comparison';
	}
	
	public function get_title() {
		return 'MT - Before After Comparison';
	}
	 
	public function get_icon() {
		return 'eicon-image-before-after';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	
	

	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'image_before',
			[
				'label' => __( 'Image (Before)', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		); 
		$this->add_control( 
			'image_after',
			[
				'label' => __( 'Image (After)', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		); 
		$this->add_control(
			'orientation',
			[
				'label' => __( 'Alignment', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 				=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'horizontal' 	=> __( 'Horizontal', 'modeltheme-addons-for-wpbakery' ),
					'vertical'		=> __( 'Vertical', 'modeltheme-addons-for-wpbakery' ),

				],
			]
		);
		$this->end_controls_section();
	}
	      
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $image_before 			= $settings['image_before'];
        $image_after 			= $settings['image_after'];
        $orientation 			= $settings['orientation'];

		$image_id = '';
		if ($image_before['source'] == 'library') {
			$image_id .= $image_before['id'].',';
        }
        $image_id_after = '';
		if ($image_after['source'] == 'library') {
			$image_id_after .= $image_after['id'].',';
        }
        $shortcode_content = '';

		// $serialized_accordion_groups = base64_encode(serialize($accordion_groups));

        $shortcode_content .= do_shortcode('[mt-addons-before-after-comparison page_builder="elementor" image_before="'.$image_id.'" image_after="'.$image_id_after.'" orientation="'.$orientation.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}