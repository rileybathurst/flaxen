<!-- Left Open
	#page
	.off-canvas-wrapper
	off-canvas-wrapper-inner
	off-canvas-content
-->
<div class="footer-border show-for-large"><!-- stay gold --></div>
<div class="footer-border-extender show-for-large"><!-- stay gold --></div>

 <div class="flaxen-footer cards">
	<div class="footer-bg-color cards"><!-- stay gold --></div>
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
		<li><a href="mailto:authenticalignmentwellness@gmail.com" class="no-padding-left">authenticalignmentwellness@gmail.com</a></li>

		<h4>Winter Office Hours:</h4>

			<li>Wednesday: 9am-6pm</li>
			<li>Thursday: 9am-6pm</li>
			<li>Friday: 9am-6pm</li>
			<li>Saturday-Tuesday: Closed</li>
	</ul>
</div>

<img src="http://authenticalignmentwellness.com/wp-content/uploads/2018/12/Amanda_Lifestyles_0223.jpg" alt="authentic alignment wellness can help with your outlook on life" class="footer-image">

<?php if ( has_nav_menu( 'social' ) ) { ?>
	<nav class="footer-social" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'social',
					'menu_class'     => 'social-links-menu text-center margin-0',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
				)
			);
		?>
	</nav><!-- .social-navigation -->
<?php } /*end if has_nav_menu */ else { ?>
	<p class="footer-social">If your an admin you can put the menu in</p>
<?php } /*end else has_nav_menu*/ ?>

</div><!-- #page opened in header.php-->

</div> <!-- .off-canvas-wrapper -->
</div> <!-- .off-canvas-wrapper-inner -->
</div> <!-- .off-canvas-content -->


<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/node_modules/what-input/dist/what-input.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/node_modules/foundation-sites/dist/js/foundation.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>

</body>
</html>
