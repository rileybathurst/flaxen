<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg"><!-- not sure about these classes I think they are a left over from foundation -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

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
		<header id="masthead" class="site-header" role="banner"> <!-- start building it up as a sub grid currently on works in firefox -->

			<div class="site-branding-text">
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
			</div>

			<?php if ( has_nav_menu( 'top' ) ) { ?>
				<div class="navigation-top text-right">
					<button onclick="touchMenu()" class="minimenu-toggle hide-for-print">Menu</button><!-- toggle off canvas -->
				</div>

			<?php } elseif(current_user_can('administrator')) { ?>
				<!-- Im not sure if this needs to be a ul? -->
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a>
			<?php } // if admin ?>

		</header>

				<?php
					$date_now = new DateTime(); // current

					$stack = array(); // build an empty array to add event dates to
					$beta = array(); // a secondary array to keep the event ids but I think I can do this better

					$args = [
						'post_type'			=> 'flaxen_event',
						'posts_per_page'	=> 10,
					];

					$loop = new WP_Query($args);
					while ($loop->have_posts()) {
						$loop->the_post();

						// the_content(); we dont currently need the content this is once we decide which event will get run

						$meta = get_post_meta( $post->ID, 'event_date', false );
						$data = $meta[0]; // this step should be able to be removed? but the meta data is deeper in the array so currently needed

						// echo the_id(). ' result<br>';
						// print_r ($meta); // print the start and end dates saved for each result
						// echo '<hr>';

						// echo 'before' . $data['start_date_m'] . 'after'; // echo test a single result

						// variables for the dates
						$mon = $data['start_date_m'];
						$da = $data['start_date_d'];
						$yea = $data['start_date_o'];
			
						$eventdate = new DateTime("$mon/$da/$yea"); // runs month / day / year 13/12/2016 

						$event_id = get_the_id();
						// echo $event_id; // test

						$stack[$event_id] = $eventdate;
						// print_r ($stack); // check the date has been added to the array

						array_push ($beta, $event_id);

				} // while have events
				// echo '<br>all together in accending order<br>'; // break test
				// sort($stack); // this is probably just sorting by the array entry order ie the way they are put in not the date but this will also destroy the keys
				// print_r ($stack); // check the date has been added to the array
				// echo '<hr>';

				// need to loop through each of the array in a smart way
				// echo '<hr>';
				// print_r ($beta);
				// echo '<hr>';
				// echo $beta[0];
				// print_r ($stack[336]); // id need to guess the numbers to do this? well they are in an array? make another array seems overkill but would work

				// write this as a smart little loop
				if (isset ($beta[0])) {
					$current = $beta[0]; // grab the id number to run through the other array
					if ($date_now < $stack[$current] ) { // if today is less than the event day
						// echo $current . ' is future<br>
						// because its date is'; // weve found the first event after today we need to display this in the header
						// print_r ($stack[$current]);

						$number_post = get_post($current);
						$title = $number_post->post_title;
						// echo $title;
						?>
						<p class="header-promo cards text-center"><a href="<?php echo esc_url( home_url( '/' ) ) . $title; ?>"><?php echo $title; ?></a></p>
						<?php
					} // no if as we dont need to deal with events in the past
				} // mellow fail depending on number of events
					else { ?>
						<p class="header-promo cards text-center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>discovery/">Start With a Free Discovery Session</a></p>
		<!-- this should be custom in the backend also im not sure about this being a p but is it a button? -->

					<?php }
				
				/*
				if (isset ($stack[1])) {
					if ($stack[1] < $date_now ) {
						echo '1 is past<br>';
					} else {
						echo '1 is future<br>';

					}
				}
				*/

				?>
	<!-- left open
	#page
body -->