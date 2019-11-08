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
</div>

<ul class="footer-contact vertical menu">
	<h4>Email:</h4>
	<!-- extra alignment needed as nothing as has links -->
	<li><a href="mailto:authenticalignmentwellness@gmail.com" class="no-padding-left">authenticalignmentwellness@gmail.com</a></li> <!-- change this to the default -->

	<?php if ( has_nav_menu( 'social' ) ) { ?>
		<nav class="footer-social" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
					)
				);
			?> <!-- need to update the 2017 svg -->
		</nav><!-- .social-navigation -->
	<?php } /*end if has_nav_menu */ else {
		if ($user_role == 'administrator') { ?>
			<!-- Im not sure if this needs to be a ul? -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a>
		<?php } // if admin
	} /*end else has_nav_menu*/ ?>

	<!-- add these to the backend -->
	<h4>Office Hours:</h4>

	<li>Wednesday: 9am-6pm</li>
	<li>Thursday: 9am-6pm</li>
	<li>Friday: 9am-6pm</li>
	<li>Saturday-Tuesday: Closed</li>
</ul>

</div><!-- #page opened in header.php-->

<?php wp_footer(); ?>

</body>
</html>
