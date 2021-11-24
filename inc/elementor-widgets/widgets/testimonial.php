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
 * Br elementor testimonial section widget.
 *
 * @since 1.0
 */
class Br_Testimonial extends Widget_Base {

	public function get_name() {
		return 'br-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial Section', 'br-companion' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'br-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  testimonial content ------------------------------
		$this->start_controls_section(
			'testimonial_content',
			[
				'label' => __( 'Testimonial contents', 'br-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Testimonial', 'br-companion' ),
            ]
        );
		$this->add_control(
            'sliders', [
                'label' => __( 'Create New Slider', 'br-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ client_name }}}',
                'fields' => [
                    [
                        'name' => 'client_img',
                        'label' => __( 'Client Image', 'br-companion' ),
                        'description' => __( 'Best size is 60x60', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'client_name',
                        'label' => __( 'Client Name', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Watson', 'br-companion' ),
                    ],
                    [
                        'name' => 'client_designation',
                        'label' => __( 'Client Designation', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Creative Director', 'br-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Review', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'br-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'client_name'           => __( 'Watson', 'br-companion' ),
                        'client_designation'    => __( 'Creative Director', 'br-companion' ),
                        'text'                => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'br-companion' ),
                    ],
                    [      
                        'client_name'           => __( 'Watson', 'br-companion' ),
                        'client_designation'    => __( 'Creative Director', 'br-companion' ),
                        'text'                => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'br-companion' ),
                    ],
                    [      
                        'client_name'           => __( 'Watson', 'br-companion' ),
                        'client_designation'    => __( 'Creative Director', 'br-companion' ),
                        'text'                => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'br-companion' ),
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
			'sec_title_col', [
				'label' => __( 'Sec Title Color', 'br-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial_area .section_title h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_col', [
				'label' => __( 'Text Color', 'br-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial_area .single_testmonial p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'reviewer_text_col', [
				'label' => __( 'Reviewer Text Color', 'br-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial_area .single_testmonial .testmonial_author h3' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_control(
            'nav_btn_col', [
                'label' => __( 'Nav Button Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial_area .owl-carousel .owl-nav div' => 'border-color: {{VALUE}}; color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'nav_btn_hover_col', [
                'label' => __( 'Nav Button Hover Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial_area .owl-carousel .owl-nav div:hover' => 'border-color: {{VALUE}}; color: #fff !important; background: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();
	}
    
	protected function render() {
    $this->load_widget_script();
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sliders = !empty( $settings['sliders'] ) ? $settings['sliders'] : '';
    ?>
    
    <!-- testimonial_area  -->
    <div class="testimonial_area  ">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <?php
                            if ( $sec_title ) {
                                echo '<h3>'.esc_html($sec_title).'</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="testmonial_active owl-carousel">
                        <?php 
                        if( is_array( $sliders ) && count( $sliders ) > 0 ) {
                            foreach( $sliders as $item ) {
                                $client_name = !empty( $item['client_name'] ) ? $item['client_name'] : '';
                                $client_img   = !empty( $item['client_img']['id'] ) ? wp_get_attachment_image( $item['client_img']['id'], 'br_np_thumb', '', array( 'alt' => $client_name ) ) : '';
                                $client_designation = !empty( $item['client_designation'] ) ? ', ' . $item['client_designation'] : '';
                                $text = !empty( $item['text'] ) ? $item['text'] : '';
                                ?>
                                <div class="single_carousel">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7 col-md-10">
                                            <div class="single_testmonial text-center">
                                                <?php
                                                    if ( $text ) {
                                                        echo '<p>'.wp_kses_post($text).'</p>';
                                                    }
                                                ?>
                                                <div class="testmonial_author">
                                                    <?php
                                                        if ( $client_img ) {
                                                            echo '
                                                            <div class="thumb">
                                                                '.$client_img.'
                                                            </div>
                                                            ';
                                                        }
                                                        if ( $client_name ) {
                                                            echo '
                                                            <h3>
                                                                '.esc_html($client_name).esc_html($client_designation).'
                                                            </h3>
                                                            ';
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
            </div>
        </div>
    </div>
    <!-- testimonial_end -->
    <?php
    } 

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // review-active
            $('.testmonial_active').owlCarousel({
            loop:true,
            margin:0,
            items:1,
            autoplay:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            nav:true,
            dots:true,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive:{
                0:{
                    items:1,
                },
                767:{
                    items:1,
                },
                992:{
                    items:1,
                },
                1200:{
                    items:1,
                },
                1500:{
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