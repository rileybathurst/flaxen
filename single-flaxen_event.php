<?php
// flaxen events template
get_header();

if ( have_posts() ) { ?>

<!-- these are purposley empty as they are grid only elements -->
<div class="title-border"><!-- stay gold --></div>
<div class="border-extender"><!-- stay gold --></div>

<div class="main-bg-color cards"><!-- stay gold --></div>
<div class="main">

	<div>

	<?php while ( have_posts() ) { 
		the_post(); ?>
		<h1><?php echo the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail(); 
		}
		
		the_content(); ?>

		<?php

			$meta = get_post_meta( $post->ID, 'event_date', false );
			$data = $meta[0]; // this step should be able to be removed?

			print_r ($meta);

			// view and check
			echo $data['start_date_m'] . '/';
			echo $data['start_date_d'] . '/';
			echo $data['start_date_o'];

			// variables for new DateTime
			$mon = $data['start_date_m'];
			$da = $data['start_date_d'];
			$yea = $data['start_date_o'];

			$date_now = new DateTime();
			$date3 = new DateTime("$mon/$da/$yea"); // needs to come from query this runs month / day / year 13/12/2016 will kill it

			// checks the new date
			print_r ($date3);

			// is it future or past
			if ($date3 < $date_now ) {
				echo 'smaller';
			} else {
				echo 'bigger';
			}
		?>
		
		<?php } ?>
	</div>

	
</div><!-- .main -->


<?php } else { /* end while have posts */ ?>
	<h1 class="title-top split-entry-title-top text-right">404</h1>
</header><!-- #masthead -->

<h1 class="title-bottom split-entry-header-lower">Sorry</h1>

<div class="title-image">
	<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" alt="stay gold header image" />
</div>

<!-- these are purposley empty as they are grid only elements -->
<div class="title-border"><!-- stay gold --></div>
<div class="border-extender"><!-- stay gold --></div>

<div class="main-bg-color cards"><!-- stay gold --></div>
<div class="main">
	<p class="col-1 col-end-4 row-1 large-col-5 large-col-end-8">We're a little lost here, how about you head back <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">home</a> and lets start again.<br>
		Thanks</p>
</div>
<?php }

/* Left Open
*	#page
*/
get_footer(); ?>
