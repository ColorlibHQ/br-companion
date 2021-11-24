<?php
namespace Brelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Br elementor appointment section widget.
 *
 * @since 1.0
 */
class Br_Appointment extends Widget_Base {

	public function get_name() {
		return 'br-appointment';
	}

	public function get_title() {
		return __( 'Home Appointment', 'br-companion' );
	}

	public function get_icon() {
		return 'eicon-calendar';
	}

	public function get_categories() {
		return [ 'br-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  appointment content ------------------------------
		$this->start_controls_section(
			'appointment_content',
			[
				'label' => __( 'Appointment content', 'br-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Make an Appointment', 'br-companion' ),
            ]
        );
        $this->add_control(
            'form_shortcode',
            [
                'label' => esc_html__( 'Contact Form7 Shortcode', 'br-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_details_settings_seperator',
            [
                'label' => esc_html__( 'Contact Details', 'br-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'address1',
            [
                'label' => esc_html__( 'Address 1', 'br-companion' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => '<h4>Visit our studio at</h4><p>221B Baker Street, P. O Box 3 Park Road, USA - 215852</p>',
            ]
        );
        $this->add_control(
            'address2',
            [
                'label' => esc_html__( 'Address 2', 'br-companion' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => '<h4>Message us</h4><p>Support@colorlib.net <br>(+68) 120034509</p>',
            ]
        );
        $this->add_control(
            'working_hour_label',
            [
                'label' => esc_html__( 'Working Hour Label', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Working Hours', 'br-companion' ),
            ]
        );
        $this->add_control(
            'working_days',
            [
                'label' => esc_html__( 'Working Days', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Monday - Friday', 'br-companion' ),
            ]
        );
        $this->add_control(
            'working_days_time',
            [
                'label' => esc_html__( 'Working Days Time', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( '09.00 - 23.00', 'br-companion' ),
            ]
        );
        $this->add_control(
            'weekend_days',
            [
                'label' => esc_html__( 'Weekend Days', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Sunday', 'br-companion' ),
            ]
        );
        $this->add_control(
            'weekend_days_time',
            [
                'label' => esc_html__( 'Weekend Days Time', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( '09.00 - 16.00', 'br-companion' ),
            ]
        );
		$this->end_controls_section(); // End facilities content

    /**
     * Style Tab
     * ------------------------------ Style Section Heading ------------------------------
     *
     */

        $this->start_controls_section(
            'style_room_section', [
                'label' => __( 'Style Facilities Section', 'br-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Section Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .make_apppointment_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'single_item_styles_seperator',
            [
                'label' => esc_html__( 'Inner Item Styles', 'br-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        
        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .make_apppointment_area .appointMent_info .single_appontment h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .make_apppointment_area .appoint_ment_form form p, .make_apppointment_area .appointMent_info .single_appontment p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_col', [
                'label' => __( 'Button Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .make_apppointment_area .appoint_ment_form form .boxed-btn3' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_hover_col', [
                'label' => __( 'Button Hover Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .make_apppointment_area .appoint_ment_form form .boxed-btn3:hover' => 'background: transparent; color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings   = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $form_shortcode  = !empty( $settings['form_shortcode'] ) ? $settings['form_shortcode'] : '';
    $address1  = !empty( $settings['address1'] ) ? $settings['address1'] : '';
    $address2  = !empty( $settings['address2'] ) ? $settings['address2'] : '';
    $working_hour_label  = !empty( $settings['working_hour_label'] ) ? $settings['working_hour_label'] : '';
    $working_days  = !empty( $settings['working_days'] ) ? $settings['working_days'] : '';
    $working_days_time  = !empty( $settings['working_days_time'] ) ? $settings['working_days_time'] : '';
    $weekend_days  = !empty( $settings['weekend_days'] ) ? $settings['weekend_days'] : '';
    $weekend_days_time  = !empty( $settings['weekend_days_time'] ) ? $settings['weekend_days_time'] : '';
    ?>

    <div class="make_apppointment_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title pl-68">
                        <?php 
                            if ( $sec_title ) { 
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="appoint_ment_form pl-68">
                        <?php 
                            if ( $form_shortcode ) { 
                                echo do_shortcode($form_shortcode);
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="appointMent_info">
                        <div class="single_appontment">
                            <?php 
                                if ( $address1 ) { 
                                    echo wpautop($address1);
                                }
                            ?>
                        </div>
                        <div class="single_appontment">
                            <?php 
                                if ( $address2 ) { 
                                    echo wpautop($address2);
                                }
                            ?>
                        </div>
                        <div class="single_appontment">
                            <?php 
                                if ( $working_hour_label ) { 
                                    echo '<h4>'.esc_html( $working_hour_label ).'</h4>';
                                }
                                if ( $working_days || $working_days_time ) { 
                                    echo 
                                    '<p class="d-flex justify-content-between">
                                        <span>'.esc_html( $working_days ).'</span>
                                        <span>'.esc_html( $working_days_time ).'</span>
                                    </p>';
                                }
                                if ( $weekend_days || $weekend_days_time ) { 
                                    echo 
                                    '<p class="d-flex justify-content-between">
                                        <span>'.esc_html( $weekend_days ).'</span>
                                        <span>'.esc_html( $weekend_days_time ).'</span>
                                    </p>';
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
}