<?php // Zenrez - Register Settings

defined( 'ABSPATH' ) or die;

function zenrez_register_settings(){
    /*
	register_setting( 
		string   $option_group, 
		string   $option_name, 
		callable $sanitize_callback
	);
	*/
	
	register_setting( 
		'zenrez_options', 
		'zenrez_options', 
		'zenrez_callback_validate_options' 
    ); 

    /*
	add_settings_section( 
		string   $id, 
		string   $title, 
		callable $callback, 
		string   $page
	);
	*/

    add_settings_section(
        'zenrez_section_admin',
        'API Credentials',
        'zenrez_callback_section_admin',
        'zenrez'
	);
	
	add_settings_section(
        'zenrez_section_form',
        'Form settings',
        'zenrez_callback_section_form',
        'zenrez'
    );

    	/*

	add_settings_field(
    	string   $id,
		string   $title,
		callable $callback,
		string   $page,
		string   $section = 'default',
		array    $args = []
	);

	*/

//------------------------- Zenrez credentials
    add_settings_field(
		'zenrez_api_key',
		'Zenrez API Key',
		'zenrez_callback_field_text',
		'zenrez',
		'zenrez_section_admin',
		[ 'id' => 'zenrez_api_key' ]
    );
    
    add_settings_field(
		'mbo_site_id',
		'Site ID',
		'zenrez_callback_field_text',
		'zenrez',
		'zenrez_section_admin',
		[ 'id' => 'mbo_site_id' ]
	);

	add_settings_field(
		'zenrez_form_title',
		'Zenrez form title',
		'zenrez_callback_field_text_area',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_title' ]
	);
	add_settings_field(
		'zenrez_form_title_color',
		'Zenrez form title hex color',
		'zenrez_callback_field_text',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_title_color' ]
	);
	add_settings_field(
		'zenrez_form_title_size',
		'Zenrez form title size',
		'zenrez_callback_field_int',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_title_size' ]
	);
	add_settings_field(
		'zenrez_form_description',
		'Zenrez form description',
		'zenrez_callback_field_text_area',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_description' ]
    );
	add_settings_field(
		'zenrez_form_description_color',
		'Zenrez form description hex color',
		'zenrez_callback_field_text',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_description_color' ]
    );
	add_settings_field(
		'zenrez_form_description_size',
		'Zenrez form description size',
		'zenrez_callback_field_float',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_description_size' ]
	);
	add_settings_field(
		'zenrez_form_button',
		'Zenrez form button',
		'zenrez_callback_field_text',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_button' ]
	);
	add_settings_field(
		'zenrez_form_button_color',
		'Zenrez form button hex color',
		'zenrez_callback_field_text',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_button_color' ]
	);
	add_settings_field(
		'zenrez_form_button_background_color',
		'Zenrez form button background hex color',
		'zenrez_callback_field_text',
		'zenrez',
		'zenrez_section_form',
		[ 'id' => 'zenrez_form_button_background_color' ]
    );
    
 
}

add_action( 'admin_init', 'zenrez_register_settings' );