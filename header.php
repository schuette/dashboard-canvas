<?php 

$blog_id = get_current_blog_id();

if (is_user_logged_in()) {

	// setup user data
	$user = wp_get_current_user();
	$user_login = $current_user->user_login;
	$user_email = $current_user->user_email;
	$user_firstname = $current_user->user_firstname;
	$user_lastname = $current_user->user_lastname;
	$display_name = $current_user->display_name;
	$user_id = $current_user->ID;
	$primary_blog = get_active_blog_for_user($user_id);
	$primary_blog_id = $primary_blog->blog_id;
	$primary_blog_name = $primary_blog->blogname;
	$primary_blog_url = $primary_blog->home;
	$current_site_url = get_bloginfo('url').'/';

	if (is_super_admin($user_id)) {

		// don't show login page id logged in
		if ($blog_id === 1 && is_page('login')) {
			wp_redirect(network_admin_url());
		}

	} else {

		$user_blogs = get_blogs_of_user($user_id);

		// prevent user from accessing other blogs. 
		if (!array_key_exists($blog_id, $user_blogs)) {
			wp_redirect($primary_blog_url);
		}
	}


} else {
	if ($blog_id === 1 && is_page('login')) {
		// prevent redirect loop on login page

	} else {
		wp_redirect(network_site_url('/'));
	}
}


?><!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php 

wp_head(); 

if (!isset($body_class))
	$body_class = null;

?>

</head>
<body<?php if (!is_null($body_class)) echo ' class="'.$body_class.'"'; ?>>
<?php if (is_user_logged_in()): ?>
<nav class="main-nav">
	<div class="container">
		<ul>
			<li><a href="<?php echo $current_site_url; ?>">Dashboard</a></li>
		</ul>
		<div class="utility">
			<a role="menuitem" href="<?php echo get_edit_user_link(); ?>">My Profile</a>
			<a role="menuitem" href="<?php echo wp_logout_url( network_home_url('/') ); ?>">Sign Out</a>
		</div>
	</div>
</nav>
<?php endif; ?>