<?php
namespace Elementor;

class addons_mt_video extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'video', plugins_url( '../../../css/video.css' , __FILE__ ));
    	wp_enqueue_style( 'magnific-popup', plugins_url( '../../../css/plugins/magnific-popup/magnific-popup.css' , __FILE__ ));

        return [
            'video',
            'magnific-popup',
        ];
    }
    
    public function get_script_depends() {
   		wp_enqueue_script( 'magnific-popup', plugins_url( '../../../js/plugins/magnific-popup/magnific-popup.js' , __FILE__));
        return [ 'jquery', 'elementor-frontend', 'magnific-popup'];
    }

	public function get_name() {
		return 'mt-video';
	}
	
	public function get_title() {
		return 'MT - Video';
	}
	
	public function get_icon() {
		return 'eicon-video-playlist';
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
			'button_image',
			[
				'label' => esc_html__( 'Choose image', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'text-left' 		=> __( 'Left', 'modeltheme-addons-for-wpbakery' ),
					'text-center'		=> __( 'Center', 'modeltheme-addons-for-wpbakery' ),
					'text-right' 		=> __( 'Right', 'modeltheme-addons-for-wpbakery' ),
				]
			] 
		);
		$this->add_control(
			'video_source',
			[
				'label' => __( 'Video source', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'source_youtube' 	=> __( 'Youtube', 'modeltheme-addons-for-wpbakery' ),
					'source_vimeo'		=> __( 'Vimeo', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		);
		$this->add_control(
	    	'vimeo_link_id',
	        [
	            'label' => esc_html__('Vimeo id link', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	            'condition' => [
					'video_source' => 'source_vimeo',
				],
	        ]
	    );
	    $this->add_control(
	    	'youtube_link_id',
	        [
	            'label' => esc_html__('Youtube id link', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	            'condition' => [
					'video_source' => 'source_youtube',
				],
	        ]
	    );

		$this->end_controls_section();

	}
	protected function render() {
        $settings 				= $this->get_settings_for_display();
        $button_image 			= $settings['button_image'];
        $image_position 		= $settings['image_position'];
        $video_source 			= $settings['video_source'];
        $vimeo_link_id 			= $settings['vimeo_link_id'];
        $youtube_link_id 		= $settings['youtube_link_id'];

        $shortcode_content = '';

     	$btn_atts = '';
		$btn_atts .= $button_image['id'].',';
	 

        $shortcode_content .= do_shortcode('[mt-addons-video page_builder="elementor" button_image="'.$btn_atts.'" image_position="'.$image_position.'" video_source="'.$video_source.'" vimeo_link_id="'.$vimeo_link_id.'" youtube_link_id="'.$youtube_link_id.'"]');

        echo  $shortcode_content;
	}
	protected function content_template() {

    }
}