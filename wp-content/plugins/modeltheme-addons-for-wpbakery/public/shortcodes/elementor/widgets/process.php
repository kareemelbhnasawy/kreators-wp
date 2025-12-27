<?php
namespace Elementor;

class addons_process extends Widget_Base {
	public function get_style_depends() {
    	wp_enqueue_style( 'process', plugins_url( '../../../css/process.css' , __FILE__ ));

        return [
            'process',
        ];
    }
	public function get_name() {
		return 'mt-addons-process';
	}
	
	public function get_title() {
		return 'MT - Process';
	}
	 
	public function get_icon() {
		return 'eicon-editor-list-ol';
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
    	$repeater = new Repeater();
	    $repeater->add_control(
	    	'step_title',
	        [
	            'label' => esc_html__('Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT
	        ]
	    );
	    $repeater->add_control(
	    	'step_description',
	        [
	            'label' => esc_html__('Description', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXTAREA
	        ]
	    );
		$this->add_control(
	        'process_groups',
	        [
	            'label' => esc_html__('Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls()
	        ]
	    ); 
		$this->end_controls_section();

	    $this->start_controls_section(
            'style_sub_heading',
            [
                'label' => esc_html__( 'Styling', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'fileds_typography',
                'label'    => esc_html__( 'Title Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-steps h3',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'fileds_typography_description',
                'label'    => esc_html__( 'Description Typography', 'modeltheme-addons-for-wpbakery' ),
                'selector' => '{{WRAPPER}} .mt-addons-steps p',
            ]
        );
    $this->end_controls_tab();
	$this->end_controls_section();


	}

	protected function render() {
        $settings 					= $this->get_settings_for_display();
        $process_groups 			= $settings['process_groups'];
      
        $shortcode_content = ''; 

		//end carousel

        $shortcode_content = ''; 
		$serialized_process_groups = base64_encode(serialize($process_groups));
        $shortcode_content .= do_shortcode('[mt-addons-process page_builder="elementor" process_groups="'.$serialized_process_groups.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}