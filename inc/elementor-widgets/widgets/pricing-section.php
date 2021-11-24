<?php
namespace Brelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;
use Elementor\Plugin;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Br elementor pricing section widget.
 *
 * @since 1.0
 */
class Br_Pricing extends Widget_Base {

	public function get_name() {
		return 'br-pricing';
	}

	public function get_title() {
		return __( 'Pricing', 'br-companion' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return [ 'br-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  pricing content ------------------------------
		$this->start_controls_section(
			'pricing_content',
			[
				'label' => __( 'Pricing content', 'br-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Our Pricing', 'br-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'br-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore', 'br-companion' ),
            ]
        );

        $this->add_control(
            'pricing_settings_seperator',
            [
                'label' => esc_html__( 'Pricing Item', 'br-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

		$this->add_control(
            'pricings', [
                'label' => __( 'Create New', 'br-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ item_title }}}',
                'fields' => [
                    [
                        'name' => 'item_title',
                        'label' => __( 'Title', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Hair Styling', 'br-companion' ),
                    ],
                    [
                        'name' => 'pricing_template',
                        'label' => __( 'Select Pricing Template', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::SELECT,
                        'options' => get_elementor_templates(),
                    ],
                ],
                'default'   => [
                    [      
                        'item_title'    => __( 'Hair Styling', 'br-companion' ),
                    ],
                    [      
                        'item_title'    => __( 'Hair Color', 'br-companion' ),
                    ],
                    [      
                        'item_title'    => __( 'Hair Styling', 'br-companion' ),
                    ],
                    [      
                        'item_title'    => __( 'Hair Color', 'br-companion' ),
                    ],
                ]
            ]
		);
		$this->end_controls_section(); // End facilities content

    /**
     * Style Tab
     * ------------------------------ Style Section Heading ------------------------------
     *
     */

        $this->start_controls_section(
            'style_pricing_section', [
                'label' => __( 'Style Pricing Section', 'br-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Section Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prising_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prising_area .section_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'single_item_styles_seperator',
            [
                'label' => esc_html__( 'Single Item Styles', 'br-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prising_area .prise_title h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prising_area .single_service .hair_style_info .prise span, .prising_area .single_service .hair_style_info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_btn_col', [
                'label' => __( 'Nav Button Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prising_area .owl-carousel .owl-nav div' => 'border-color: {{VALUE}}; color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'nav_btn_hover_col', [
                'label' => __( 'Nav Button Hover Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prising_area .owl-carousel .owl-nav div:hover' => 'border-color: {{VALUE}}; color: #fff !important; background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings   = $this->get_settings();
    $this->load_widget_script();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title  = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $pricings = !empty( $settings['pricings'] ) ? $settings['pricings'] : '';
    ?>

    <div class="prising_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="section_title mb-55">
                        <?php 
                            if ( $sec_title ) { 
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                            if ( $sub_title ) { 
                                echo '<p>'.wp_kses_post( $sub_title ).'</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="prising_slider_active owl-carousel">
                        <div class="prising_active d-flex justify-content-between">
                            <?php 
                            if( is_array( $pricings ) && count( $pricings ) > 0 ) {
                                $count = 0;
                                foreach( $pricings as $item ) {
                                    $count++;
                                    $pricing_template = $item['pricing_template'] ? $item['pricing_template'] : '';
                                    if ( $pricing_template != '' ) { 
                                        echo Plugin::$instance->frontend->get_builder_content( absint($pricing_template), false );
                                    }
                                    if ( ($count % 2) == 0 && $count !== count( $pricings )) {
                                        echo '</div><div class="prising_active d-flex justify-content-between">';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // review-active
            $('.prising_slider_active').owlCarousel({
                loop:true,
                margin:30,
            items:1,
            autoplay:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                nav:true,
            dots:false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
                responsive:{
                    0:{
                        items:1,
                        nav:false,
                    },
                    767:{
                        items:1,
                        nav:true,
                    },
                    992:{
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