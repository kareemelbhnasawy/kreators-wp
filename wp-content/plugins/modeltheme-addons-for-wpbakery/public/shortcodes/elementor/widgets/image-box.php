<?php
namespace Elementor;
class addons_image_box extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'image-box', plugins_url( '../../../css/image-box.css' , __FILE__ ));

	        return [
	            'image-box',
	        ];
    }
	
	public function get_name() { 
		return 'image-box';
	}
	
	public function get_title() {
		return 'MT - image Box  ';
	}
	
	public function get_icon() {
		return 'eicon-nerd';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'title_tab',
			[
				'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title Label', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
          'bg_image',
          [
            'label' => esc_html__( 'First Image', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
              'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
          ]
        );
       	$this->add_control(
          'second_image',
          [
            'label' => esc_html__( 'Second Image', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
              'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
          ]
        );
       	$this->add_control(
            'left_percent',
            [
                'label' => esc_html__( "Left (%) - Do not write the '%'", 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
            ]
        );
       	$this->add_control(
            'top_percent',
            [
                'label' => esc_html__("Top (%) - Do not write the '%'", 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
            ]
        );
        $this->add_control(
			'link_image',
			[
				'label' => esc_html__( 'Link', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();
	}
	   protected function render() {
        $settings = $this->get_settings_for_display();
        $title 					= $settings['title'];
        $bg_image 				= $settings['bg_image']['url'];
        $second_image 			= $settings['second_image']['url'];
        $link_image 			= $settings['link_image']['url'];
        $top_percent 			= $settings['top_percent'];
        $left_percent 			= $settings['left_percent'];


		if($bg_image) {
		    $thumb      = wp_get_attachment_image_src($bg_image, "full");
		    if ($thumb) {
		      $thumb_src  = $thumb[0];
		    }
		  }
        ?>
	        <a class="mt-addons-image-box" href="<?php echo esc_url($link_image); ?>">
		        <div class="mt-addons-bg-image-box">
		        	<?php if(!empty($bg_image)){ ?>
		        		<img src="<?php echo esc_url($bg_image); ?>"  />
	    			<?php } ?>
		            <div class="mt-addons-absolute-image">
	          			<?php if(!empty($second_image)){ ?>
		        			<img src="<?php echo esc_url($second_image); ?>"  style="left:<?php echo esc_attr($left_percent);?>%;top:<?php echo esc_attr($top_percent);?>px;"/>
	    				<?php } ?>
		            </div>
		        </div>
		        <div class="mt-addons-title-image-box">
		        	<?php echo esc_html($title); ?>
	        	</div>
	        </a>
	       
    <?php } 
    protected function content_template() {}

}