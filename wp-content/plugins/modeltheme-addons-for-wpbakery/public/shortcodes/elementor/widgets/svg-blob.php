<?php
namespace Elementor;

class addons_svg_blob extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'svg-blob-css', plugins_url( '../../../css/svg-blob.css' , __FILE__ ));
        return [
            'svg-blob-css',
        ];
    }
	public function get_name() {
		return 'mt-svg-blob';
	}
	
	public function get_title() {
		return 'MT - SVG Blob';
	}
	
	public function get_icon() {
		return 'eicon-image-bold';
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
			'color_or_image',
			[
				'label' => __( 'Background Type', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'choosed_image' 	=> __( 'Use an image', 'modeltheme-addons-for-wpbakery' ),
					'choosed_color'		=> __( 'Use a color', 'modeltheme-addons-for-wpbakery' ),
				]
			]
		); 
		$this->add_control(
			'back_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Background color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'condition' => [
					'color_or_image' => 'choosed_color',
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
          		'description' => esc_attr__( "Choose background image", 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'color_or_image' => 'choosed_image',
				],
			]
		);
		$this->add_control(
	    	'clip_path',
	        [
	            'label' => esc_html__('Clip Path', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
          		'description' => esc_attr__("Create the blob shape at https://10015.io/tools/svg-blob-generator",'modeltheme-addons-for-wpbakery')
	        ]
	    );
	    $this->add_control(
	    	'blob_width',
	        [
	            'label' => esc_html__('Blob Width', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
         	 	'description' => esc_attr__("Set with by px or %.",'modeltheme-addons-for-wpbakery')
	        ]
	    );
	    $this->add_control(
	    	'extra_class',
	        [
	            'label' => esc_html__('Extra Class', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	        ]
	    );

	$this->end_controls_section();

	}
	         
	protected function render() {
        $settings 			= $this->get_settings_for_display();
        $color_or_image 	= $settings['color_or_image'];
        $back_color 		= $settings['back_color'];
        $image 				= $settings['image'];
        $clip_path 			= $settings['clip_path'];
        $blob_width 		= $settings['blob_width'];
        $extra_class 		= $settings['extra_class'];

		$image_id = '';
		if ($image['source'] == 'library') {
			$image_id .= $image['id'].',';
        }

        $shortcode_content = '';
        $shortcode_content .= do_shortcode('[mt-addons-svg-blob page_builder="elementor" color_or_image="'.$color_or_image.'" back_color="'.$back_color.'" image="'.$image_id.'"  clip_path="'.$clip_path.'" blob_width="'.$blob_width.'"   extra_class="'.$extra_class.'"]');

        echo  $shortcode_content;

	}
	protected function content_template() {

    }
}