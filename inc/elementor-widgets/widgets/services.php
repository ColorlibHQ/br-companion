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
 * Br elementor services section widget.
 *
 * @since 1.0
 */
class Br_Services extends Widget_Base {

	public function get_name() {
		return 'br-services';
	}

	public function get_title() {
		return __( 'Services', 'br-companion' );
	}

	public function get_icon() {
		return 'eicon-settings';
	}

	public function get_categories() {
		return [ 'br-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  services content ------------------------------
		$this->start_controls_section(
			'services_content',
			[
				'label' => __( 'Services content', 'br-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Our Services', 'br-companion' ),
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
            'services_settings_seperator',
            [
                'label' => esc_html__( 'Services', 'br-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

		$this->add_control(
            'services', [
                'label' => __( 'Create New', 'br-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ item_title }}}',
                'fields' => [
                    [
                        'name' => 'item_img',
                        'label' => __( 'Upload Image', 'br-companion' ),
                        'description' => __( 'Best size is 360x206', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'item_icon',
                        'label' => __( 'Select Icon', 'br-companion' ),
                        'label_block' => true,
                        'default' => 'flaticon-shave',
                        'type' => Controls_Manager::SELECT,
                        'options' => br_themify_icon(),
                    ],
                    [
                        'name' => 'item_title',
                        'label' => __( 'Title', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Smooth Shave', 'br-companion' ),
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Text', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut', 'br-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'item_icon'     => 'flaticon-shave',
                        'item_title'    => __( 'Planning Stage', 'br-companion' ),
                        'text'          => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'br-companion' ),
                    ],
                    [      
                        'item_icon'    => 'flaticon-barber',
                        'item_title'    => __( 'Beard Trimming', 'br-companion' ),
                        'text'          => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'br-companion' ),
                    ],
                    [      
                        'item_icon'    => 'flaticon-null',
                        'item_title'    => __( 'Haircut Styles', 'br-companion' ),
                        'text'          => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'br-companion' ),
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
                'label' => __( 'Style Facilities Section', 'br-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Section Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_area .section_title p' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}}.service_area .single_service .service_content h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_area .single_service .service_content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heighlighted_col', [
                'label' => __( 'Heighlighted Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_area .single_service .service_content i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .service_area .single_service .service_content' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings   = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title  = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $services = !empty( $settings['services'] ) ? $settings['services'] : '';
    $dynamic_class = ! is_front_page() ? ' facilites_page' : '';
    $dynamic_title_class = is_front_page() ? ' white_title' : '';
    ?>

    <div class="service_area">
        <div class="container">
            <div class="row justify-content-center ">
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
                if( is_array( $services ) && count( $services ) > 0 ) {
                    foreach( $services as $item ) {
                        $item_img = !empty( $item['item_img']['id'] ) ? wp_get_attachment_image( $item['item_img']['id'], 'br_service_thumb_360x206', '' ) : '';
                        $item_icon = $item['item_icon'] ? $item['item_icon'] : '';
                        $item_title = ( !empty( $item['item_title'] ) ) ? $item['item_title'] : '';
                        $text = ( !empty( $item['text'] ) ) ? $item['text'] : '';
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="single_service">
                                <?php 
                                    if ( $item_img ) { 
                                        echo '
                                        <div class="service_thumb">
                                            '.wp_kses_post( $item_img ).'
                                        </div>
                                        ';
                                    }
                                ?>
                                <div class="service_content text-center">
                                    <div class="icon">
                                        <i class="<?php echo esc_attr($item_icon)?>"></i>
                                    </div>
                                    <?php 
                                        if ( $item_title ) { 
                                            echo '<h3>'.esc_html( $item_title ).'</h3>';
                                        }
                                        if ( $text ) { 
                                            echo '<p>'.wp_kses_post( $text ).'</p>';
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