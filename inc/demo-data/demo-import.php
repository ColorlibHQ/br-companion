<?php 
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Br Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

// demo import file
function br_import_files() {
	
	$demoImg = '<img src="'.plugins_url( 'screen-image.jpg', __FILE__ ) .'" alt="'.esc_attr__( 'Demo Preview Imgae', 'br-companion' ).'" />';
	
  return array(
    array(
      'import_file_name'             => 'Br Demo',
      'local_import_file'            => BR_COMPANION_DEMO_DIR_PATH .'br-demo.xml',
      'local_import_widget_file'     => BR_COMPANION_DEMO_DIR_PATH .'br-widgets-demo.wie',
      'import_customizer_file_url'   => plugins_url( 'br-customizer.dat', __FILE__ ),
      'import_notice' => $demoImg,
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'br_import_files' );


// demo import setup
function br_after_import_setup() {
	// Assign menus to their locations.
	$main_menu    	= get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$information 	= get_term_by( 'name', 'Information', 'nav_menu' );
	$services 		= get_term_by( 'name', 'Services', 'nav_menu' );
	$follow_us 		= get_term_by( 'name', 'Follow Us', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' 	=> $main_menu->term_id,
			'information' 	=> $information->term_id,
			'services' 		=> $services->term_id,
			'follow-us' 	=> $follow_us->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Homepage' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
	update_option( 'posts_per_page', 3 );

	// Update the post to draft after import is done
	br_update_the_followed_post_page_status();

	// Add an option to check after import is done
	update_option( 'br-import-data', true );

}
add_action( 'pt-ocdi/after_import', 'br_after_import_setup' );

//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function br_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'br-companion' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'br-companion' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'br-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'br_import_plugin_page_setup' );

// Enqueue scripts
function br_demo_import_custom_scripts(){
	
	
	if( isset( $_GET['page'] ) && $_GET['page'] == 'br-demo-import' ){
		// style
		wp_enqueue_style( 'br-demo-import', plugins_url( 'css/demo-import.css', __FILE__ ), array(), '1.0', false );
	}
	
	
}
add_action( 'admin_enqueue_scripts', 'br_demo_import_custom_scripts' );
