<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<?php if (is_page ('discovery', 'discovery-form')) { ?>
		<script src='https://www.google.com/recaptcha/api.js?render=6LdiC4YUAAAAANuw48UrjkBkcDkhQvUxZO5N752o'></script>
		<script>
			grecaptcha.ready(function () {
				grecaptcha.execute('6LdiC4YUAAAAANuw48UrjkBkcDkhQvUxZO5N752o', { action: 'contact' }).then(function (token) {
					var recaptchaResponse = document.getElementById('recaptchaResponse');
					recaptchaResponse.value = token;
				});
			});
		</script>
	<?php } ?>
	
	<!-- analytics should be done from the back end to have an updateable code per site -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-12917302-18"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-12917302-18');
	</script>

	<!-- if page-discovery.php -->
	<script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
	<script>
		grecaptcha.ready(function() {
			grecaptcha.execute('6LdiC4YUAAAAANuw48UrjkBkcDkhQvUxZO5N752o', {action: 'discovery'}).then(function(token) {
				// add token value to form
				document.getElementById('g-recaptcha-response').value = token;
			});
		});
	</script>

</head>

<body <?php body_class(); ?>>

	<!-- this is the off canvas aka hidden menu -->
	<div id="minimenu" class="hidden-menu"> <!-- should this be an html 5 elemnt -->
		<h2 class="text-center breathe-before"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo bloginfo( 'name' ); ?></a></h2>
		<hr>

		<?php if ( has_nav_menu( 'top' ) ) { ?>
				<nav>
					<?php // Primary navigation menu.
						wp_nav_menu( array(
							// needs to run a grid to evenly distribute from the center when above medium size
							'theme_location'    => 'top',
							'items_wrap'        => '<ul class="menu text-center">%3$s</ul>' // %3$s is the code for the menu item
						) );
					?>
				</nav><!-- .main-navigation -->
				<hr>
		<?php } else {

			if ( is_user_logged_in() ) {
				// I think there is a faster way of getting to this
				$current_user = wp_get_current_user();
				$current_id = $current_user->ID;
				$user_info = get_userdata( $current_id );
				$user_role = implode(', ', $user_info->roles);
			}

			if ($user_role == 'administrator') { ?>
				<!-- Im not sure if this needs to be a ul? -->
				<ul class="inline-list right main-navigation"><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a></li></ul>
			<?php } // if admin
		} // if has menu top

		if ( has_nav_menu( 'social' ) ) { ?>
			<nav class="footer-social" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu text-center',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
						)
					);
				?>
			</nav><!-- .social-navigation -->
		<?php } else {

			if ($user_role == 'administrator') { ?>
				<!-- Im not sure if this needs to be a ul? -->
				<ul class="inline-list right main-navigation"><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a></li></ul>
			<?php } // if admin
		} ?> <!-- if has menu social -->
	</div> <!-- end of the off canvas -->

	<!--  this is the in canvas -->
	<div id="page" class="site">
		<header id="masthead" class="site-header" role="banner"> <!-- start building it up as a sub grid currently on works in firefox -->

			<div class="site-branding-text">
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
			</div>

			<?php if ( has_nav_menu( 'top' ) ) { ?>
				<div class="navigation-top text-right">
					<button onclick="touchMenu()" class="minimenu-toggle hide-for-print">Menu</button><!-- toggle off canvas -->
				</div>

			<?php } else {
				if ($user_role == 'administrator') { ?>
					<!-- Im not sure if this needs to be a ul? -->
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a>
				<?php } // if admin
			} ?>

		</header>

		<p class="header-promo cards text-center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>discovery/">Start With a Free Discovery Session</a></p> <!-- this should be custom in the backend also im not sure about this being a p but is it a button? -->
