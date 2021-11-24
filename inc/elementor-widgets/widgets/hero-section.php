<?php
namespace Brelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Br elementor hero section widget.
 *
 * @since 1.0
 */
class Br_Hero extends Widget_Base {

	public function get_name() {
		return 'br-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'br-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'br-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'br-companion' ),
			]
        );
        
		$this->add_control(
            'sliders', [
                'label' => __( 'Create New Slider', 'br-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ sec_title }}}',
                'fields' => [
                    [
                        'name' => 'item_img',
                        'label' => __( 'Item Image', 'br-companion' ),
                        'description' => __( 'Best size is 1920x900', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default'     => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'sec_title',
                        'label' => __( 'Title', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Modern barber shop in center of the city', 'br-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Text', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'br-companion' ),
                    ],
                    [
                        'name' => 'btn_title',
                        'label' => __( 'Button Title', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Appointment', 'br-companion' ),
                    ],
                    [
                        'name' => 'btn_url',
                        'label' => __( 'Button URL', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::URL,
                    ],
                ],
                'default'   => [
                    [      
                        'sec_title'    => __( 'Modern barber shop in center of the city', 'br-companion' ),
                        'text'    => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'br-companion' ),
                        'btn_title'    => __( 'Appointment', 'br-companion' ),
                    ],
                    [      
                        'sec_title'    => __( 'Modern barber shop in center of the city', 'br-companion' ),
                        'text'    => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'br-companion' ),
                        'btn_title'    => __( 'Appointment', 'br-companion' ),
                    ],
                    [      
                        'sec_title'    => __( 'Modern barber shop in center of the city', 'br-companion' ),
                        'text'    => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'br-companion' ),
                        'btn_title'    => __( 'Appointment', 'br-companion' ),
                    ],
                ]
            ]
        );
        $this->end_controls_section(); // End Hero content


    /**
     * Style Tab
     * ------------------------------ Style Title ------------------------------
     *
     */
        $this->start_controls_section(
			'style_title', [
				'label' => __( 'Style Hero Section', 'br-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_col', [
				'label' => __( 'Title Color', 'br-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_col', [
				'label' => __( 'Text Color', 'br-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_col', [
				'label' => __( 'Button Color', 'br-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_hover_col', [
				'label' => __( 'Button Hover Color', 'br-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3:hover' => 'border-color: {{VALUE}}; color: {{VALUE}}; background-color: transparent;',
				],
			]
		);
		$this->end_controls_section();
	}
    
	protected function render() {
    $this->load_widget_script();
    $settings  = $this->get_settings();
    $sliders = !empty( $settings['sliders'] ) ? $settings['sliders'] : '';
    ?>
    
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="slider_active owl-carousel">
            <?php 
            if( is_array( $sliders ) && count( $sliders ) > 0 ) {
                foreach( $sliders as $item ) {
                    $sec_img   = !empty( $item['item_img']['url'] ) ? $item['item_img']['url'] : '';
                    $sec_title = !empty( $item['sec_title'] ) ? $item['sec_title'] : '';
                    $text = !empty( $item['text'] ) ? $item['text'] : '';
                    $btn_title = !empty( $item['btn_title'] ) ? $item['btn_title'] : '';
                    $btn_url = !empty( $item['btn_url']['url'] ) ? $item['btn_url']['url'] : '';
                    ?>
                    <div class="single_slider d-flex align-items-center justify-content-center overlay" <?php echo br_inline_bg_img(esc_url($sec_img))?>>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-8">
                                    <div class="slider_text">
                                        <?php 
                                            if ( $sec_title ) { 
                                                echo '<h3>'.esc_html($sec_title).'</h3>';
                                            }
                                            if ( $text ) { 
                                                echo '<p>'.wp_kses_post( nl2br($text) ).'</p>';
                                            }
                                            if ( $btn_title ) { 
                                                echo '<a class="boxed-btn3" href="'.esc_url( $btn_url ).'">'.esc_html( $btn_title ).'</a>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <!-- slider_area_end -->
    <?php
    } 

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // slider-active
            $('.slider_active').owlCarousel({
            loop:true,
            margin:0,
            items:1,
            autoplay:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            nav:false,
            dots:false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            responsive:{
                0:{
                    items:1,
                    nav:false,
                },
                767:{
                    items:1
                },
                992:{
                    items:1
                },
                1200:{
                    items:1
                },
                1600:{
                    items:1
                }
            }
            });         
        })(jQuery);
        </script>
        <?php 
        }
    }	
}