<?php
namespace Brelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Br elementor about section widget.
 *
 * @since 1.0
 */
class Br_About_Section extends Widget_Base {

	public function get_name() {
		return 'br-about-us';
	}

	public function get_title() {
		return __( 'About Section', 'br-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'br-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  About Us content ------------------------------
        $this->start_controls_section(
            'left_content',
            [
                'label' => __( 'Left Section Settings', 'br-companion' ),
            ]
        );

        $this->add_control(
            'left_big_img',
            [
                'label' => esc_html__( 'Left Big Image', 'br-companion' ),
                'description' => esc_html__( 'Best size is 427x501', 'br-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'left_small_img',
            [
                'label' => esc_html__( 'Left Small Image', 'br-companion' ),
                'description' => esc_html__( 'Best size is 206x401', 'br-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->end_controls_section(); // End left content

        // Right section
        $this->start_controls_section(
            'right_content',
            [
                'label' => __( 'Right Section Settings', 'br-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'About Us', 'br-companion' ),
            ]
        );
        $this->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'br-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing eliteiusmod tempor incididunt ut labore et dolore magna aliqua. Qpsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Quis ipsum suspendisse ultr.', 'br-companion' ),
            ]
        );
        $this->add_control(
            'time_label',
            [
                'label' => esc_html__( 'Time Label', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Opening Hour', 'br-companion' ),
            ]
        );
        $this->add_control(
            'active_hours',
            [
                'label' => esc_html__( 'Active Hours', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( '10:00 am - 10:00 pm', 'br-companion' ),
            ]
        );
        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'About Us', 'br-companion' ),
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'br-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End left content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'about_sec_style', [
                'label' => __( 'About Section Styles', 'br-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_area .about_info .section_title h3, .about_area .about_info .opening_hour' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_area .about_info .section_title p, .about_area .about_info .opening_hour span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_col', [
                'label' => __( 'Button Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_area .about_info .boxed-btn3' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_hover_col', [
                'label' => __( 'Button Hover Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_area .about_info .boxed-btn3:hover' => 'background: transparent; color: {{VALUE}}; border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
    $settings   = $this->get_settings();  
    $left_big_img    = !empty( $settings['left_big_img']['id'] ) ? wp_get_attachment_image( $settings['left_big_img']['id'], 'br_about_thumb_427x501', '' ) : '';
    $left_small_img    = !empty( $settings['left_small_img']['id'] ) ? wp_get_attachment_image( $settings['left_small_img']['id'], 'br_about_thumb_206x401', '' ) : '';
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $text   = !empty( $settings['text'] ) ? $settings['text'] : '';

    $time_label  = !empty( $settings['time_label'] ) ? $settings['time_label'] : '';
    $active_hours  = !empty( $settings['active_hours'] ) ? $settings['active_hours'] : '';
    $btn_title  = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url  = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>

    <!-- about_area_start -->
    <div class="about_area ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="about_thumbs">
                        <?php 
                            if ( $left_big_img ) { 
                                echo '
                                <div class="large_img_1">
                                    '.$left_big_img.'
                                </div>
                                ';
                            }
                            if ( $left_small_img ) { 
                                echo '
                                <div class="small_img_1">
                                    '.$left_small_img.'
                                </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="about_info">
                        <div class="section_title mb-20px">
                            <?php 
                                if ( $sec_title ) { 
                                    echo '<h3>'.esc_html($sec_title).'</h3>';
                                }
                                if ( $text ) { 
                                    echo '<p>'.wp_kses_post($text).'</p>';
                                }
                            ?>
                        </div>
                        <?php 
                            if ( $time_label && $active_hours ) { 
                                echo '
                                <p class="opening_hour">
                                    '.esc_html($time_label).'
                                    <span>'.esc_html($active_hours).'</span>
                                </p>';
                            }
                            if ( $btn_title ) { 
                                echo '<a href="'.esc_url($btn_url).'" class="boxed-btn3">'.esc_html($btn_title).'</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about_area_end -->
    <?php
    }
}