<?php
include ("header.php");
the_post();
?>

<div class="container">
	<div class="post-content">
		<h1>Welcome, <strong><?php echo $user_firstname; ?></strong></h1>
		<?php the_content(); ?>

	</div>
</div>
<?php get_footer(); ?>