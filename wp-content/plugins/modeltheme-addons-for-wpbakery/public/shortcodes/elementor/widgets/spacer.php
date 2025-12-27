<?php
namespace Elementor;

class addons_mt_spacer extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'mt-spacer', plugins_url( '../../../css/spacer.css' , __FILE__ ));
        return [
            'mt-spacer',
        ];
    }

	public function get_name() {
		return 'mt-spacer';
	}
	
	public function get_title() {
		return 'MT - Spacer';
	}
	
	
	public function get_icon() {
	    return 'eicon-spacer'; 
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
			'desktop_height',
			[
				'label' => esc_html__( 'Desktop Height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'mobile_height',
			[
				'label' => esc_html__( 'Mobile Height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			'tablet_height',
			[
				'label' => esc_html__( 'Tablet Height', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$this->end_controls_section();

	}
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $desktop_height 		= $settings['desktop_height'];
        $mobile_height 			= $settings['mobile_height'];
        $tablet_height 			= $settings['tablet_height'];

        $shortcode_content = '';

        $shortcode_content .= do_shortcode('[mt-addons-spacer page_builder="elementor" desktop_height="'.$desktop_height.'" mobile_height="'.$mobile_height.'" tablet_height="'.$tablet_height.'" ]');

        echo  $shortcode_content;
	}
	protected function content_template() {

    }
}