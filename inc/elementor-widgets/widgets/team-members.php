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
 * Br elementor members section widget.
 *
 * @since 1.0
 */
class Br_Members extends Widget_Base {

	public function get_name() {
		return 'br-team-members';
	}

	public function get_title() {
		return __( 'Team Members', 'br-companion' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'br-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  members content ------------------------------
		$this->start_controls_section(
			'members_content',
			[
				'label' => __( 'Team content', 'br-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Barber', 'br-companion' ),
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
            'members_settings_seperator',
            [
                'label' => esc_html__( 'Members', 'br-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

		$this->add_control(
            'members', [
                'label' => __( 'Create New', 'br-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ item_title }}}',
                'fields' => [
                    [
                        'name' => 'item_img',
                        'label' => __( 'Upload Image', 'br-companion' ),
                        'description' => __( 'Best size is 360x378', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'item_title',
                        'label' => __( 'Name', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'John Smith', 'br-companion' ),
                    ],
                    [
                        'name' => 'item_designation',
                        'label' => __( 'Designation', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Junior Barber', 'br-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'item_title'        => __( 'John Smith', 'br-companion' ),
                        'item_designation'  => __( 'Junior Barber', 'br-companion' ),
                    ],
                    [      
                        'item_title'        => __( 'Jems Smith', 'br-companion' ),
                        'item_designation'  => __( 'Senior Barber', 'br-companion' ),
                    ],
                    [      
                        'item_title'        => __( 'Thomas J Watson', 'br-companion' ),
                        'item_designation'  => __( 'Expert Barber', 'br-companion' ),
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
            'style_room_section', [
                'label' => __( 'Style Team Section', 'br-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Section Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .section_title p' => 'color: {{VALUE}};',
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
                'label' => __( 'Name Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .single_team_member .member_info h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Designation Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team_area .single_team_member .member_info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings   = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title  = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $members = !empty( $settings['members'] ) ? $settings['members'] : '';
    ?>
    
    <!-- team_area_start  -->
    <div class="team_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section_title text-center mb-55">
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
            <div class="row justify-content-center">
                <?php 
                if( is_array( $members ) && count( $members ) > 0 ) {
                    foreach( $members as $item ) {
                        $item_img = !empty( $item['item_img']['id'] ) ? wp_get_attachment_image( $item['item_img']['id'], 'br_member_thumb_360x378', '' ) : '';
                        $item_designation = $item['item_designation'] ? $item['item_designation'] : '';
                        $item_title = ( !empty( $item['item_title'] ) ) ? $item['item_title'] : '';
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_team_member">
                                <?php 
                                    if ( $item_img ) { 
                                        echo '
                                        <div class="team_thumb">
                                            '.wp_kses_post( $item_img ).'
                                        </div>
                                        ';
                                    }
                                ?>
                                <div class="member_info text-center">
                                    <?php 
                                        if ( $item_title ) { 
                                            echo '<h3>'.esc_html( $item_title ).'</h3>';
                                        }
                                        if ( $item_designation ) { 
                                            echo '<p>'.esc_html( $item_designation ).'</p>';
                                        }
                                    ?>
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
    <?php
    }
}