<div class="footer-border show-for-large"><!-- stay gold --></div>
<div class="footer-border-extender show-for-large"><!-- stay gold --></div>

<div class="footer-navigation-top">
	<?php wp_nav_menu(
		array(
			'theme_location' => 'top',
			'menu_id'        => 'top-menu',
			'menu_class'     => 'vertical menu align-left',
		)
	); ?>
	<?php if(current_user_can('administrator')) { ?>	
		<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>/view-results">View Form Submissions - Admin only</a></p>
	<?php } ?>
</div>

<ul class="footer-contact vertical menu">
	<h4>Email:</h4>
	<!-- extra alignment needed as nothing as has links -->
	<li><a href="mailto:authenticalignmentwellness@gmail.com" class="no-padding-left">authenticalignmentwellness@gmail.com</a></li> <!-- change this to the default -->

	<?php if ( has_nav_menu( 'social' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'social',
				'walker'  => new Walker_Quickstart_Menu() //use our custom walker
			)
		);
	} ?>

	<!-- add these to the backend -->
	<h4>Office Hours:</h4>

	<li>Tuesday - Friday: 9am-6pm</li>
	<li>Sunday - Monday: Closed</li>
</ul>

</div><!-- #page opened in header.php-->

<?php wp_footer(); ?>

</body>
</html>
