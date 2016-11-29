<?php

$body_class = 'login';
include ("header.php");

?>

	<div id="login">
		<h1><a tabindex="-1">Your Company Name</a></h1>
		<?php wp_login_form(); ?>

		<p id="nav">
			<a href="<?php echo network_home_url(); ?>wp-login.php?action=lostpassword">Lost your password?</a>
		</p>
	</div>

<?php get_footer(); ?>