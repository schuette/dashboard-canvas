<?php

// SETUP
// --------------------------------------------------

// Hide toolbar
add_filter('show_admin_bar', '__return_false');

// Enqueue styles
function dash_scripts() {

	// Load fonts
	wp_enqueue_style( 'dash-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700', array(), null );

	// Theme stylesheet
	wp_enqueue_style( 'dash', get_stylesheet_uri(), '', 1 );

}
add_action( 'wp_enqueue_scripts', 'dash_scripts' );


// LOGIN
// --------------------------------------------------

// Change the redirect URL
function admin_login_redirect($redirect_to, $requested_redirect_to, $user) {

	if (is_a($user, 'WP_User')) {
		if (!is_super_admin($user->ID)) {
			$user_info = get_userdata($user->ID);
			if ($user_info->primary_blog) {
				// redirect users to their blog
				$primary_url = get_blogaddress_by_id($user_info->primary_blog);
			} else {
				// Super admin 
				$primary_url = network_admin_url();
			}
			if ($primary_url) {
				wp_redirect($primary_url);
				exit();
			}
		}
	}
	return $redirect_to;
}
add_filter('login_redirect', 'admin_login_redirect', 100, 3);

// Add styles to the WordPress Login Form
function customize_login() {
	wp_enqueue_style('custom-login', get_stylesheet_uri());
}
add_action('login_enqueue_scripts', 'customize_login');