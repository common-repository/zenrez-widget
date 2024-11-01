<?php

/*
Plugin Name: Zenrez Widget
Description: Zenrez plugin is a widget which displays a contact form for users to subscribe to the mailing list.
Plugin URI:   https://wordpress.org/plugins/zenrez-widget
Author:      Zenrez
Version:     1.0
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/

defined( 'ABSPATH' ) or die;

// example widget class
class Zenrez_Widget extends WP_Widget {

	// set up widget
	public function __construct() {
		
		$id = 'zenrez_widget';

		$title = esc_html__('Zenrez Contact Form', 'zenrez-widget');

		$options = array( 
			'classname' => 'zenrez_widget',
			'description' => esc_html__('Zenrez Widget contact form','zenrez-widget')

		);
		
		parent::__construct( $id, $title, $options );
		
	}
	
	// output widget content
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		require_once plugin_dir_path(__FILE__).'/admin/settings-callbacks.php';
		$credentials = get_credentials([ 'zenrez_api_key', 'mbo_site_id']);

		if( empty($credentials['zenrez_api_key']) || empty($credentials['mbo_site_id']) ){
			echo '<h3>Error</h3>';
			echo '<p>Go to settings and set your credentials</p>';
			return ;
		}
		if ( isset( $instance['button'] ) ) {
			$buttonText = $instance['button'];
		}
		if ( isset( $instance['buttonColor'] ) ) {
			$buttonColor = $instance['buttonColor'];
		}
		if ( isset( $instance['titleSize'] ) ) {
			$titleSize = $instance['titleSize'];
			if($titleSize == 5) {
				$titleSize = 1;
			}
			if($titleSize == 4) {
				$titleSize = 2;
			}
			if($titleSize == 2) {
				$titleSize = 4;
			}
			if($titleSize == 1) {
				$titleSize = 5;
			}
		}
		if ( isset( $instance['color'] ) ) {
			$titleColor= $instance['color'];
		}
		if ( isset( $instance['descriptionSize'] ) ) {
			$descriptionSize = $instance['descriptionSize'];
		}
		if ( isset( $instance['color2'] ) ) {
			$descriptionColor = $instance['color2'];
		}
		if ( isset( $instance['buttonBackgroundColor'] ) ) {
			$backgroundColor = $instance['buttonBackgroundColor'];
		}
		echo '<section class="size-box widget">';
		echo '<div id="zenrez-title-form">';
		echo '<h'.$titleSize.' class="widget-title" style="color: '.$titleColor.';">';
			if ( isset( $instance['text'] ) ) {

				echo wp_kses_post( $instance['text'] );

			}else {
				echo '';
			}
		echo '</h'.$titleSize.'>';
		echo '</div>';
		echo '<div id="zenrez-description-form">';
		echo '<p style="color: '.$descriptionColor.'; font-size: '.$descriptionSize.'em;" >';
			if ( isset( $instance['text2'] ) ) {

				echo wp_kses_post( $instance['text2'] );

			}else {
				echo '';
			}
		echo '</p>';
		
		echo '</div>';
		
		echo '<div>';
		echo '<form id="zenrez-form-subscription" action="" method="post">';
		echo '<p>';
		echo '<p>';
		echo 'First Name <br />';
		echo '<input id="zenrez-first-name-form" type="text" name="cf-name" required value="' . ( isset( $_POST["cf-name"] ) ? sanitize_text_field( $_POST["cf-name"] ) : '' ) . '" style= "width: 100%" />';
		echo '</p>';
		echo '<p>';
		echo 'Last Name <br />';
		echo '<input id="zenrez-last-name-form" type="text" name="cf-last-name" required value="' . ( isset( $_POST["cf-last-name"] ) ? sanitize_text_field( $_POST["cf-last-name"] ) : '' ) . '" style= "width: 100%" />';
		echo '</p>';
		echo '<p>';
		echo 'Email <br />';
		echo '<input id="zenrez-email-form" type="email"  name="cf-email" required value="' . ( isset( $_POST["cf-email"] ) ? sanitize_email( $_POST["cf-email"] ) : '' ) . '" style= "width: 100%" />';
		echo '</p>';
		echo '<p>';
		echo '<input id="zenrez-button-form" type="submit" style="color: '.$buttonColor.'; background: '.$backgroundColor.';" name="cf-submitted" value="'.$buttonText.'"/>';
		echo '</form>';
		echo '</div>';

		if(isset($_POST['cf-submitted'])){
			// sanitize form values
			$name = sanitize_text_field( $_POST["cf-name"] );
			$last_name = sanitize_text_field( $_POST["cf-last-name"] );
			$email = sanitize_email( $_POST["cf-email"] );
			$body = array("firstName" => "$name", "lastName" => "$last_name", "email" => "$email");
			require_once plugin_dir_path(__FILE__).'/admin/requests.php';
			$response = http_get_response($body);
			$code = wp_remote_retrieve_response_code( $response );
			if ($code===200) {
				echo '<div>';
				echo '<p>Thanks for subscribing</p>';
				echo '</div>';
			} else if($code===400) {
				$responseBody = wp_remote_retrieve_body( $response );
				$responseMessage = json_decode($responseBody);
				echo '<p>' .$responseMessage->message .'</p>';
			} else {
				echo '<p> An unexpected error occurred </p>';
			}
			
		}
		echo '</section>';
		
	}
	
	// output widget form fields
	public function form( $instance ) {
		
		// outputs the widget form fields in the Admin Area

		$id = $this->get_field_id( 'text' );

		$for = $this->get_field_id( 'text' );

		$name = $this->get_field_name( 'text' );

		$label = __( 'Title options:', 'zenrez-widget' );

		$idColor = $this->get_field_id( 'color' );

		$forColor = $this->get_field_id( 'color' );

		$nameColor = $this->get_field_name( 'color' );

		$titleColor = __( 'Set title color here.', 'zenrez-widget' );

		$titleSize = __(2, 'zenrez-widget');
		
		$descriptionSize = __(1, 'zenrez-widget');

		$nameIncreaseSize = $this->get_field_name( 'increaseSize' );

		$nameDecreaseSize = $this->get_field_name( 'decreaseSize' );

		$idTitleSize = $this->get_field_id( 'titleSize' );

		$forTitleSize = $this->get_field_id( 'titleSize' );

		$nameTitleSize = $this->get_field_name( 'titleSize' );

		$id2 = $this->get_field_id( 'text2' );

		$for2 = $this->get_field_id( 'text2' );

		$name2 = $this->get_field_name( 'text2' );

		$label2 = __( 'Description options:', 'zenrez-widget' );

		$idColor2 = $this->get_field_id( 'color2' );

		$forColor2 = $this->get_field_id( 'color2' );

		$nameColor2 = $this->get_field_name( 'color2' );

		$descriptionColor = __( 'Set description text color here.', 'zenrez-widget' );

		$idDescriptionSize = $this->get_field_id( 'descriptionSize' );

		$forDescriptionSize = $this->get_field_id( 'descriptionSize' );

		$nameDescriptionSize = $this->get_field_name( 'descriptionSize' );

		$idButton = $this->get_field_id( 'button' );

		$forButton = $this->get_field_id( 'button' );

		$nameButton = $this->get_field_name( 'button' );

		$labelButton = __( 'Button options:', 'zenrez-widget' );

		$idButtonColor = $this->get_field_id( 'buttonColor' );

		$forButtonColor = $this->get_field_id( 'buttonColor' );

		$nameButtonColor = $this->get_field_name( 'buttonColor' );
		
		$textButtonColor = __( 'Set button text color here.', 'zenrez-widget' );

		$idButtonBackgroundColor = $this->get_field_id( 'buttonBackgroundColor' );

		$forButtonBackgroundColor = $this->get_field_id( 'buttonBackgroundColor' );

		$nameButtonBackgroundColor = $this->get_field_name( 'buttonBackgroundColor' );

		$textButtonBackgroundColor = __( 'Set button background color here.', 'zenrez-widget' );


		if ( isset( $instance['text'] ) ) {

			$text = $instance['text'];

		}else {
			$text = '';
		}
	
		if ( isset( $instance['color'] ) && ! empty( $instance['color'] ) ) {
	
			$titleColor  = $instance['color'];

		}

		if ( isset( $instance['titleSize'] ) && ! empty( $instance['titleSize'] ) ) {
	
			$titleSize  = $instance['titleSize'];

		}

		if ( isset( $instance['text2'] ) ) {

			$text2 = $instance['text2'];

		}else{
			$text2 = '';
		}

		if ( isset( $instance['color2'] ) && ! empty( $instance['color2'] ) ) {

			$descriptionColor = $instance['color2'];

		}

		if ( isset( $instance['descriptionSize'] ) && ! empty( $instance['descriptionSize'] ) ) {

			$descriptionSize = $instance['descriptionSize'];

		}

		if ( isset( $instance['button'] ) ) {

			$textButton = $instance['button'];

		}else {
			$textButton = 'Sign up';
		}

		if ( isset( $instance['buttonColor'] ) && ! empty( $instance['buttonColor'] ) ) {

			$textButtonColor = $instance['buttonColor'];

		}
		
		if ( isset( $instance['buttonBackgroundColor'] ) && ! empty( $instance['buttonBackgroundColor'] ) ) {

			$textButtonBackgroundColor = $instance['buttonBackgroundColor'];

		}

		?>

		<div>
			<label id="zenrez-title-options"><?php echo esc_html( $label ); ?></label>
		</div>
		<div id= "zenrez-title-section" class= "zenrez-div-dropdown">
			<textarea placeholder = "Set title here" class="widefat" maxLength ="50" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
			<i> Text color: </i>
			<label class="dashicons dashicons-art" id="zenrez-input-title-color-dropdown" style= "color: <?php echo esc_textarea( $titleColor ); ?> ;"></label>
			<i> Text size: </i>
			<input class="tiny-text"type="number" size="3" step="1" min="1" max="5" value="<?php echo esc_attr($titleSize)?>" id="<?php echo esc_attr( $idTitleSize ); ?>" name="<?php echo esc_attr( $nameTitleSize); ?>" for="<?php echo esc_attr( $forTitleSize ); ?>"></input>
			<div class="zenrez-dropdown" id="zenrez-title-color-picker">
				<textarea class="widefat" for="<?php echo esc_attr( $forColor ); ?>" id="<?php echo esc_attr( $idColor ); ?>" name="<?php echo esc_attr( $nameColor ); ?>" ><?php echo esc_textarea( $titleColor ); ?></textarea>
			</div>
		</div>
		<div>
			<label id="zenrez-description-options" for="<?php echo esc_attr( $for2 ); ?>"><?php echo esc_html( $label2 ); ?></label>
		</div>
		<div id= "zenrez-description-section" for="zenrez-description-section" name="zenrez-description-section-toggle">
			<textarea placeholder = "Set description here" class="widefat" maxLength ="150" id="<?php echo esc_attr( $id2 ); ?>" name="<?php echo esc_attr( $name2 ); ?>"><?php echo esc_textarea( $text2 ); ?></textarea>
			<i> Text color: </i>
			<label class="dashicons dashicons-art" style= "color: <?php echo esc_textarea( $descriptionColor ); ?> ;"  id="zenrez-input-description-color-dropdown"></label>
			<i> Text size: </i>
			<input type="number" size="3" step=".25" min=".5" max="2" value="<?php echo esc_attr($descriptionSize)?>" id="<?php echo esc_attr( $idDescriptionSize ); ?>" name="<?php echo esc_attr( $nameDescriptionSize); ?>" for="<?php echo esc_attr( $forDescriptionSize ); ?>"></input>
			<div class="zenrez-dropdown" id="zenrez-description-color-picker">
				<textarea class="widefat" for="<?php echo esc_attr( $forColor2 ); ?>" id="<?php echo esc_attr( $idColor2 ); ?>" name="<?php echo esc_attr( $nameColor2 ); ?>" ><?php echo esc_textarea( $descriptionColor ); ?></textarea>
			</div>
		</div>
		<div>
			<label id="zenrez-button-options" for="<?php echo esc_attr( $forButton ); ?>"><?php echo esc_html( $labelButton ); ?></label>
		</div>
		<div>
			<textarea placeholder = "Set button text here" class="widefat" maxLength ="15" id="<?php echo esc_attr( $idButton ); ?>" name="<?php echo esc_attr( $nameButton ); ?>"><?php echo esc_textarea( $textButton ); ?></textarea>
			<i> Text color: </i>
			<label class="dashicons dashicons-art" id="zenrez-input-color-dropdown" style= "color: <?php echo esc_textarea( $textButtonColor ); ?> ;"></label>
			<i> Background color: </i>
			<label class="dashicons dashicons-admin-appearance" id="zenrez-input-background-color-dropdown" style= "color: <?php echo esc_textarea( $textButtonBackgroundColor ); ?> ;"></label>
			<div class="zenrez-dropdown" id="zenrez-button-color-picker">
				<textarea class="widefat" for="<?php echo esc_attr( $forButtonColor ); ?>" id="<?php echo esc_attr( $idButtonColor ); ?>" name="<?php echo esc_attr( $nameButtonColor ); ?>" ><?php echo esc_textarea( $textButtonColor ); ?></textarea>
			</div>
			<div class="zenrez-dropdown" id="zenrez-button-background-color-picker">
				<textarea class="widefat" for="<?php echo esc_attr( $forButtonBackgroundColor ); ?>" id="<?php echo esc_attr( $idButtonBackgroundColor ); ?>" name="<?php echo esc_attr( $nameButtonBackgroundColor ); ?>" ><?php echo esc_textarea( $textButtonBackgroundColor ); ?></textarea>
			</div>
		</div>	
		
<?php 
		
	}
	
	// process widget options
	public function update( $new_instance, $old_instance ) {
		
		// processes the widget options

		$instance = array();

		if ( isset( $new_instance['text'] ) ) {

			$instance['text'] = $new_instance['text'];

		}else if (empty($new_instance['text'])) {
			$instance['text'] = "";
		}

		if ( isset( $new_instance['titleSize'] ) && ! empty( $new_instance['titleSize'] ) ) {

			$instance['titleSize'] = $new_instance['titleSize'];

		}

		if ( isset( $new_instance['color'] ) && ! empty( $new_instance['color'] ) ) {

			$instance['color'] = $new_instance['color'];

		}

		if ( isset( $new_instance['text2'] ) ) {

			$instance['text2'] = $new_instance['text2'];

		} else if (empty($new_instance['text2'])) {
			$instance['text2'] = "";
		}

		if ( isset( $new_instance['descriptionSize'] ) && ! empty( $new_instance['descriptionSize'] ) ) {

			$instance['descriptionSize'] = $new_instance['descriptionSize'];

		}

		if ( isset( $new_instance['color2'] ) && ! empty( $new_instance['color2'] ) ) {

			$instance['color2'] = $new_instance['color2'];

		}

		if ( isset( $new_instance['button'] )  ) {

			$instance['button'] = $new_instance['button'];

		} else if (empty($new_instance['button'])) {
			$instance['button'] = "";
		}

		if ( isset( $new_instance['buttonColor'] ) && ! empty( $new_instance['buttonColor'] ) ) {

			$instance['buttonColor'] = $new_instance['buttonColor'];

		}

		if ( isset( $new_instance['buttonBackgroundColor'] ) && ! empty( $new_instance['buttonBackgroundColor'] ) ) {

			$instance['buttonBackgroundColor'] = $new_instance['buttonBackgroundColor'];

		}


		return $instance;
		
	}
	
}

// register widget
function zenrez_register_widget() {
	
	register_widget( 'Zenrez_Widget' );
	
}
add_action( 'widgets_init', 'zenrez_register_widget' );

if( is_admin()){
    //include dependencies
    require_once plugin_dir_path(__FILE__).'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__).'admin/settings-page.php';
    require_once plugin_dir_path(__FILE__).'admin/settings-register.php';
    require_once plugin_dir_path(__FILE__).'admin/settings-callbacks.php';
    require_once plugin_dir_path(__FILE__).'admin/settings-validate.php';
	
}

function zenrez_enqueue_style_admin(){
	$src = plugin_dir_url(__FILE__).'admin/css/admin-style.css';
	wp_enqueue_style('zenrez-admin',$src,array(),null,'all');
}
add_action('admin_enqueue_scripts', 'zenrez_enqueue_style_admin');

function zenrez_enqueue_script_admin(){
	$src = plugin_dir_url(__FILE__).'admin/js/admin.js';
	wp_enqueue_script('zenrez-admin',$src,array(),null,true);
}
add_action('admin_enqueue_scripts', 'zenrez_enqueue_script_admin');

function zenrez_enqueue_script_public() {
	$src = plugin_dir_url(__FILE__). 'public/js/public.js';
	wp_enqueue_script('zenrez-public', $src, array('jquery'), null, false);

}
add_action('wp_enqueue_scripts', 'zenrez_enqueue_script_public');

function zenrez_contact_form(){
	ob_start();
	require_once plugin_dir_path(__FILE__).'/admin/settings-callbacks.php';
	$credentials = get_credentials([ 'zenrez_api_key', 'mbo_site_id']);

	if( empty($credentials['zenrez_api_key']) || empty($credentials['mbo_site_id']) ){
		echo '<h3>Error</h3>';
		echo '<p>Go to settings and set your credentials</p>';
		return ;
	}

	$options = get_credentials([
		'zenrez_form_title', 'zenrez_form_title_color', 'zenrez_form_title_size', 
		'zenrez_form_description','zenrez_form_description_color', 'zenrez_form_description_size',
		'zenrez_form_button', 'zenrez_form_button_color', 'zenrez_form_button_background_color'
	]);

	$titleSize = ( isset( $options["zenrez_form_title_size"] ) ? $options["zenrez_form_title_size"] : 1 );
	if($titleSize == 5) {
		$titleSize = 1;
	}
	if($titleSize == 4) {
		$titleSize = 2;
	}
	if($titleSize == 2) {
		$titleSize = 4;
	}
	if($titleSize == 1) {
		$titleSize = 5;
	}
	
	echo '<div id="zenrez-title-form">';
	echo '<h'.$titleSize.' style= "color: '.( isset( $options["zenrez_form_title_color"] ) ? $options["zenrez_form_title_color"] : '' ).';" >'
	. ( isset( $options["zenrez_form_title"] ) ? $options["zenrez_form_title"] : '' );
	echo '</h'.$titleSize.'>';
	echo '</div>';
	echo '<div id="zenrez-description-form">';
	echo '<p style="color: '.( isset( $options["zenrez_form_description_color"] ) ? $options["zenrez_form_description_color"] : '' ).'; 
		font-size: ' .( isset( $options["zenrez_form_description_size"] ) ? $options["zenrez_form_description_size"] : 1). 'em;" >'
		. ( isset( $options["zenrez_form_description"] ) ? $options["zenrez_form_description"] : '' );
	echo '</p>';
	
	echo '</div>';
	
	echo '<div>';
	echo '<form id="zenrez-form-subscription" action="" method="post">';
	echo '<p>';
	echo '<p>';
	echo 'First Name <br />';
	echo '<input id="zenrez-first-name-form" type="text" name="cf-name" required value="' . ( isset( $_POST["cf-name"] ) ? sanitize_text_field( $_POST["cf-name"] ) : '' ) . '" style= "width: 100%" />';
	echo '</p>';
	echo '<p>';
	echo 'Last Name <br />';
	echo '<input id="zenrez-last-name-form" type="text" name="cf-last-name" required value="' . ( isset( $_POST["cf-last-name"] ) ? sanitize_text_field( $_POST["cf-last-name"] ) : '' ) . '" style= "width: 100%" />';
	echo '</p>';
	echo '<p>';
	echo 'Email <br />';
	echo '<input id="zenrez-email-form" type="email"  name="cf-email" required value="' . ( isset( $_POST["cf-email"] ) ? sanitize_email( $_POST["cf-email"] ) : '' ) . '" style= "width: 100%" />';
	echo '</p>';
	echo '<p>';
	echo '<input id="zenrez-button-form" type="submit" style="color: '.( isset( $options["zenrez_form_button_color"] ) ? $options["zenrez_form_button_color"] : '' ).'; 
		background: '.( isset( $options["zenrez_form_button_background_color"] ) ? $options["zenrez_form_button_background_color"] : '' ).'; " name="cf-submitted" value=" '. ( isset( $options["zenrez_form_button"] ) ? $options["zenrez_form_button"] : 'Subscribe' ).'" />';
	echo '</form>';
	echo '</div>';

	if(isset($_POST['cf-submitted'])){
		// sanitize form values
		$name = sanitize_text_field( $_POST["cf-name"] );
		$last_name = sanitize_text_field( $_POST["cf-last-name"] );
		$email = sanitize_email( $_POST["cf-email"] );
		$body = array("firstName" => "$name", "lastName" => "$last_name", "email" => "$email");
		require_once plugin_dir_path(__FILE__).'/admin/requests.php';
		$response = http_get_response($body);
		$code = wp_remote_retrieve_response_code( $response );
		if ($code===200) {
			echo '<div>';
			echo '<p>Thanks for subscribing</p>';
			echo '</div>';
		} else if($code===400) {
			$responseBody = wp_remote_retrieve_body( $response );
			$responseMessage = json_decode($responseBody);
			echo '<p>' .$responseMessage->message .'</p>';
		} else {
			echo '<p> An unexpected error occurred </p>';
		}
		
	}

	return ob_get_clean();
}

add_shortcode('zenrez_form','zenrez_contact_form');
