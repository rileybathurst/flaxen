<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg"><!-- not sure about these classes I think they are a left over from foundation -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<!-- recaptcha -->
	<?php if (is_page ('discovery', 'discovery-form', 'contact')) { ?>
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
							'theme_location'	=> 'top',
							'items_wrap'		=> '<ul class="menu text-center">%3$s</ul>' // %3$s is the code for the menu item
						) );
					?>
				</nav><!-- .main-navigation -->
				<hr>
		<?php } else {

			if(current_user_can('administrator')) { ?>
				<!-- Im not sure if this needs to be a ul? -->
				<ul class="inline-list right main-navigation"><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a></li></ul>
			<?php } // if admin
		} // if has menu top

		if ( has_nav_menu( 'social' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'social',
					'walker'  => new Walker_Quickstart_Menu(), // needed 
					'menu_id' => 'header-social'
				)
			);
		} elseif(current_user_can('administrator')) { ?>
			<!-- Im not sure if this needs to be a ul? -->
			<ul class="inline-list right main-navigation"><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a></li></ul>
		<?php } // if admin ?>
	</div> <!-- end of the off canvas -->

	<!--  this is the in canvas -->
	<div id="page" class="site">
		<div class="header-background-color">
			<header id="masthead" class="site-header" role="banner"> <!-- start building it up as a sub grid currently on works in firefox -->

				<h1 class="site-branding-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>

				<?php if ( has_nav_menu( 'top' ) ) { ?>
					<div class="navigation-top text-right">
						<button onclick="touchMenu()" class="minimenu-toggle hide-for-print">Menu</button><!-- toggle off canvas -->
					</div>

				
				<?php } elseif(current_user_can('administrator')) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a>
				<?php } // if admin ?>

				<?php
					$date_now = new DateTime(); // current time date, note this cant be used with an echo $date_now needs print_r($date_now);
					$stack = array(); // build an empty array to add event dates to

					// query for events
					$args = [
						'post_type'			=> 'flaxen_event',
						'posts_per_page'	=> 10,
					];

					// run the events in a loop this doesnt print anything just builds an array
					$loop = new WP_Query($args);
					while ($loop->have_posts()) {
						$loop->the_post();

						// the_content(); we dont currently need the content this is once we decide which event will get run
						$meta = get_post_meta( $post->ID, 'event_date', false ); // grab the dates meta
						$data = $meta[0]; // this ends up as an array in an array it might be possible to remove this step but for now its needed

						// create variables for the date portions
						$mon = $data['start_date_m'];
						$da = $data['start_date_d'];
						$yea = $data['start_date_o'];
			
						// create a date with the variables as one
						$eventdate = new DateTime("$mon/$da/$yea"); // runs month / day / year 13/12/2016 
						$event_id = get_the_id();
						$stack[$event_id] = $eventdate; // add the dates as a value to the array with the ID as the key
				} // while have events

				asort($stack); // ascending sort is oldest to newest and doesnt alter the keys

				foreach ( $stack as $key => $value ) {
					if ($date_now < $value) {
						// echo ' future<br>'; check for correct entries
						$title = get_post($key)->post_title; // the events title
						// echo $title; // check the title
						?>
						<p class="header-promo cards text-center forward-banner"><a href="<?php echo esc_url( home_url( '/?p=' ) ). $key; ?>">
							<?php echo $title; ?>
						</a></p>
						<?php break; // stop looping once we find something in the future
					} // if the events in the future
				} // loop of all events

				?>
			<button class="header-promo">
				<a href="mailto:authenticalignmentwellness@gmail.com&subject=Authentic Alignment Wellness Lets Work Together">LET&#39;S WORK TOGETHER</a>
			</button>

			</header>
		</div><!-- .header-background-color -->

	<!-- left open
	#page
body -->