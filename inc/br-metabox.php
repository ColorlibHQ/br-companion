<?php
function br_page_metabox( $meta_boxes ) {

	$br_prefix = '_br_';
	$meta_boxes[] = array(
		'id'        => 'listing_metaboxes',
		'title'     => esc_html__( 'Other Options', 'br-companion' ),
		'post_types'=> array( 'listing' ),
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'    => $br_prefix . 'listing_address',
				'type'  => 'text',
				'required'  => true,
				'name'  => esc_html__( 'Address', 'br-companion' ),
				'placeholder' => esc_html__( 'Detail Address for the Listing.', 'br-companion' ),
			),
			// array(
			// 	'id'    => $br_prefix . 'listing_country',
			// 	'type'  => 'text',
			// 	'required'  => true,
			// 	'name'  => esc_html__( 'Country', 'br-companion' ),
			// 	'placeholder' => esc_html__( 'Country for the Listing.', 'br-companion' ),
			// ),
			array(
				'id'            => $br_prefix . 'listing_map',
				'type'          => 'osm',
				'required'  => true,
				'name'          => esc_html__( 'Location', 'br-companion' ),
				'std'           => '-6.233406,-35.049906,15',
				'address_field' => $br_prefix . 'listing_address',
			),
			array(
				'id'    => $br_prefix . 'listing_price',
				'type'  => 'text',
				'required'  => true,
				'name'  => esc_html__( 'Price', 'br-companion' ),
				'placeholder' => esc_html__( 'Ex: 1000000', 'br-companion' ),
			),
			array(
				'id'    => $br_prefix . 'phone_number',
				'type'  => 'text',
				'name'  => esc_html__( 'Phone', 'br-companion' ),
				'placeholder' => esc_html__( 'Ex: 012 345 678', 'br-companion' ),
			),
			array(
				'id'    => $br_prefix . 'listing_email',
				'type'  => 'text',
				'name'  => esc_html__( 'Listing Email', 'br-companion' ),
			),
			array(
				'id'    => $br_prefix . 'listing_area',
				'type'  => 'text',
				'name'  => esc_html__( 'Area (Square Feet)', 'br-companion' ),
				'placeholder' => esc_html__( 'Ex: 1500', 'br-companion' ),
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'br_page_metabox' );
