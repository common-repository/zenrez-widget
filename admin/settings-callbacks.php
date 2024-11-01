<?php // Zenrez - Settings Callbacks

defined( 'ABSPATH' ) or die;

//callback: admin section

function zenrez_callback_section_admin(){
    echo '<p> These settings are required to register a new customer. </p>';
}

function zenrez_callback_section_form(){
    echo '<p> These settings edit the form on the Front End. </p>';
}

// callback: text field

function zenrez_callback_field_text( $args ) {
	
	$options = get_option( 'zenrez_options', $default=false );
	
	$id = isset( $args['id'] ) ? $args['id'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="zenrez_options_'. $id .'" name="zenrez_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	
}

function zenrez_callback_field_int( $args ) {
	
	$options = get_option( 'zenrez_options', $default=false );
	
	$id = isset( $args['id'] ) ? $args['id'] : '';
	
	$value = isset( $options[$id] ) ? $options[$id]  : 1;
	
	echo '<input id="zenrez_options_'. $id .'" name="zenrez_options['. $id .']" type="number" step="1" min="1" max="5" size="40" value="'. $value .'"><br />';
	
}

function zenrez_callback_field_float( $args ) {
	
	$options = get_option( 'zenrez_options', $default=false );
	
	$id = isset( $args['id'] ) ? $args['id'] : '';
	
	$value = isset( $options[$id] ) ?  $options[$id]  : 1;
	
	echo '<input id="zenrez_options_'. $id .'" name="zenrez_options['. $id .']" type="number" step=".25" min=".5" max="2" size="40" value="'. $value .'"><br />';
	
}

function zenrez_callback_field_text_area( $args ) {
	
	$options = get_option( 'zenrez_options', $default=false );
	
	$id = isset( $args['id'] ) ? $args['id'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_textarea_field( $options[$id] ) : '';
	
	echo '<textarea id="zenrez_options_'. $id .'" name="zenrez_options['. $id .']" size="40" maxLength ="150" > '.$value.'</textarea> ';
	
}

function get_credentials( $args ) {
	$options = get_option( 'zenrez_options', $default=false );
	$ids = array();
	foreach($args as $arg){
		array_push($ids, $arg);
	}
	$values = array();
	foreach($ids as $id){
		$values[$id] = $options[$id];
	}
	return $values;
}
