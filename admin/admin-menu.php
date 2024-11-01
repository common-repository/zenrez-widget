<?php // Zenrez admin-menu 

defined( 'ABSPATH' ) or die;

function zenrez_add_sublevel_menu(){

    /*
	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug,
		callable $function = ''
	);	
	*/

    add_submenu_page(
        'options-general.php',
        'Zenrez settings',
        'Zenrez',
        'manage_options',
        'zenrez',
        'zenrez_display_settings_page'
    );
}

add_action( 'admin_menu', 'zenrez_add_sublevel_menu' );

