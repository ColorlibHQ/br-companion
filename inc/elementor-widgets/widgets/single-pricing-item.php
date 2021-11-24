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
 * Br elementor single pricing section widget.
 *
 * @since 1.0
 */
class Br_Single_Pricing extends Widget_Base {

	public function get_name() {
		return 'br-single-pricing';
	}

	public function get_title() {
		return __( 'Single Pricing', 'br-companion' );
	}

	public function get_icon() {
		return 'eicon-price-list';
	}

	public function get_categories() {
		return [ 'br-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  single pricing content ------------------------------
		$this->start_controls_section(
			'single_pricing_content',
			[
				'label' => __( 'Single Pricing content', 'br-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'br-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Hair Styling', 'br-companion' ),
            ]
        );

        $this->add_control(
            'pricing_settings_seperator',
            [
                'label' => esc_html__( 'Pricing Items', 'br-companion' ),
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
                        'name' => 'item_img',
                        'label' => __( 'Pricing Image', 'br-companion' ),
                        'description' => __( 'Image size should be 60x60', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'item_title',
                        'label' => __( 'Title', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Hair Cut', 'br-companion' ),
                    ],
                    [
                        'name' => 'item_text',
                        'label' => __( 'Text', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Lorem ipsum dolor sitamet, consectetur', 'br-companion' ),
                    ],
                    [
                        'name' => 'item_price',
                        'label' => __( 'Text', 'br-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => 8,
                    ],
                ],
                'default'   => [
                    [      
                        'item_title'     => __( 'Hair Cut', 'br-companion' ),
                        'item_text'    => __( 'Lorem ipsum dolor sitamet, consectetur', 'br-companion' ),
                        'item_price'          => 8,
                    ],
                    [      
                        'item_title'     => __( 'Hair Style', 'br-companion' ),
                        'item_text'    => __( 'Lorem ipsum dolor sitamet, consectetur', 'br-companion' ),
                        'item_price'          => 6,
                    ],
                    [      
                        'item_title'     => __( 'Hair Trimming', 'br-companion' ),
                        'item_text'    => __( 'Lorem ipsum dolor sitamet, consectetur', 'br-companion' ),
                        'item_price'          => 5,
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
                    '{{WRAPPER}} .our_facilitics_area .section_title h3' => 'color: {{VALUE}};',
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
            'icon_col', [
                'label' => __( 'Icon Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature .icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hover_icon_col', [
                'label' => __( 'On Hover Item Icon Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature:hover .icon i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'anchor_txt_color', [
                'label' => __( 'Anchor Text Color', 'br-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings   = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $pricings  = !empty( $settings['pricings'] ) ? $settings['pricings'] : '';
    ?>

    <div class="single_prising">
        <?php 
            if ( $sec_title ) { 
                echo '
                <div class="prise_title">
                    <h4>'.esc_html( $sec_title ).'</h4>
                </div>
                ';
            }

            if( is_array( $pricings ) && count( $pricings ) > 0 ) {
                foreach( $pricings as $item ) {
                    $item_img = !empty( $item['item_img']['id'] ) ? wp_get_attachment_image( $item['item_img']['id'], 'br_np_thumb', '' ) : '';
                    $item_title = ( !empty( $item['item_title'] ) ) ? $item['item_title'] : '';
                    $item_text = ( !empty( $item['item_text'] ) ) ? $item['item_text'] : '';
                    $item_price = ( !empty( $item['item_price'] ) ) ? $item['item_price'] : '';
                    ?>
                    <div class="single_service">
                        <div class="service_inner">
                            <?php 
                                if ( $item_img ) { 
                                    echo '
                                    <div class="thumb">
                                        '.wp_kses_post( $item_img ).'
                                    </div>
                                    ';
                                }
                            ?>
                        </div>
                        <div class="hair_style_info">
                            <div class="prise d-flex justify-content-between">
                                <?php 
                                    if ( $item_title ) { 
                                        echo '<span>'.esc_html( $item_title ).'</span>';
                                    }
                                    if ( $item_price ) { 
                                        echo '<span>$'.esc_html( $item_price ).'</span>';
                                    }
                                ?>
                            </div>
                            <?php 
                                if ( $item_text ) { 
                                    echo '<p>'.wp_kses_post( $item_text ).'</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
        ?>
    </div>
    <?php
    }
}