<?php

function make_request($jsonBody, $url) {
	$args = array( 'headers' => array("Content-Type: application/json", "Accept: application/json"), 'body' => $jsonBody);
	return wp_safe_remote_post($url, $args);
	//return wp_safe_remote_get('https://api.mindbodyonline.com/public/v6/client/clients?ClientIds=1785033', $args); 
}

function http_get_response($body) {

	require_once plugin_dir_path(__FILE__).'/settings-callbacks.php';
	$credentials = get_credentials([ 'zenrez_api_key', 'mbo_site_id']);
	$key = $credentials['zenrez_api_key'];
	$site_id = $credentials['mbo_site_id'];
	$body['apiKey'] = $key;
	$body['mboSiteId'] = $site_id;

	$url = 'https://www.zenrez.com/api/v1.2/businesses/'.$site_id.'/mailing-list';
	$response = make_request($body, $url);

	return $response;

}