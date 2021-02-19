<!-- <div class="footer-border show-for-large"> stay gold </div>
<div class="footer-border-extender show-for-large"> stay gold </div> -->

<footer>
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
	</div> <!-- .footer-navigation-top -->

	<hr ><!-- goes 90 when large -->
	<div class="footer-border"><!-- stay gold --></div><!-- goes 90 when large -->
	
	<div class="footer-navigation-bottom"><!-- lock in the grid -->
		<h4>Email:</h4>
		<!-- extra alignment needed as nothing as has links -->
		<a href="mailto:authenticalignmentwellness@gmail.com" class="no-padding-left">authenticalignmentwellness@gmail.com</a>
		<?php if ( has_nav_menu( 'social' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'social',
					// pulled from automattic theme
					'walker'  => new Walker_Quickstart_Menu() //use our custom walker
				)
			);
		} ?>
		<!-- add these to the backend -->
		<h4>Office Hours:</h4>
		<h5>Tuesday - Friday: 9am-6pm</h5>
		<h5>Sunday - Monday: Closed</h5>
	</div>
</footer>

</div><!-- #page opened in header.php-->

<?php wp_footer(); ?>

</body>
</html>
