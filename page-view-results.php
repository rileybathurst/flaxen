<?php
	// Template Name: View Results

	get_header();

	// all variables have to be shown .php?n=''&r=''

if(isset($_GET['n'])) {
	//define variable for url bar .php?n=
	$off = $_GET['n'];
} else {
	// start with default variable
	$off = 1;
}

if(isset($_GET['r'])) {
	//define variable for url bar .php?n=
	$result = $_GET['r'];
} else {
	// start with default variable
	$result = '';
} ?>

	<?php if (have_posts()) {
		while (have_posts()) { the_post();

			if(get_post_meta($id, "split-entry-title-top", true) !== '') { ?>

				<h1 class="title-top split-entry-title-top text-right"><?php echo get_post_meta($post->ID, "split-entry-title-top", true); ?></h1>
				<?php } else { ?>
					<h1 class="title-top split-entry-title-top text-right"><?php the_title(); ?></h1>
				<?php } ?>

</header><!-- #masthead -->

		<?php if(get_post_meta($id, "split-entry-header-lower", true) !== '') { ?>
			<h1 class="title-bottom split-entry-header-lower"><?php echo get_post_meta($post->ID, "split-entry-header-lower", true); ?></h1>
		<?php }

		if ( has_post_thumbnail() ) {
		/* is there a way to add a style to this without wrapping it in a div? class="title-image" */ ?>
			<div class="title-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php } else { ?>
			<div class="title-image">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" alt="stay gold header image" />
			</div>
		<?php } ?>

<!-- these are purposley empty as they are grid only elements -->
<div class="title-border"><!-- stay gold --></div>
<div class="border-extender"><!-- stay gold --></div>

<div class="main-bg-color cards"><!-- stay gold --></div>
<div class="main">

	<div class="col-1 col-end-4 row-1 large-col-5 large-col-end-8">

		 <!-- search form -->
		 <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">

			<div data-abide-error class="alert callout" style="display: none;">
				<p><i class="fi-alert"></i> There are some errors in your form.</p>
			</div>

			<input type="hidden" name="action" value="viewresults">
			<input type="hidden" name="data" value="viewresultsid"><!-- slightly different value to differentiate, not used -->

			<label for="search" class="middle">Search:</label>
			<input name="name" type="text" required id="name" placeholder="Joe Smith" />
			<!-- error -->
			<small class="form-error">A name is required.</small>

			<button type="submit" value="input" class="button">Search</button>

		</form>

		<h2>Results for <?php echo $result; ?></h2>

			<ul class="no-bullet">

			<!-- multiple options due to not being logged in would see all guest orders -->
			<?php
				$current_user = wp_get_current_user();
				$current_id = $current_user->ID;
				$user_info = get_userdata( $current_id );

				if (is_user_logged_in ()) {
					$user_role = implode(', ', $user_info->roles);
				}

				if ($user_role == 'administrator') {

				// first extract the current user email as the variable
				$current_user = wp_get_current_user();
				$current_email = $current_user->user_email;

				// set the number of items to display per page
				$items_per_page = 10;

				// set the offset the page number with a zero after
				$offset = $off . 0;

				// then search for orders -->
				$orders = $wpdb->get_results(
						"
						SELECT *
						FROM flaxen_inquiry
						WHERE ( name LIKE '$result%' OR name LIKE '%$result' OR email LIKE '$result%' OR email LIKE '%$result' )
						ORDER by unid desc
						;"
					// limit currently isnt working and needs a fix but
					// LIMIT $offset , $items_per_page
					);

					foreach ( $orders as $order )
					{ ?>
						<li>
							<hr>
							<a href=" <?php echo home_url(); ?>/view-single?n=<?php echo $order->unid; ?>">
								<?php echo $order->type .
								'&nbsp; - ' .
								$order->unid .
								'&nbsp; - ' .
								$order->name .
								'&nbsp; - ' .
								$order->email .
								'&nbsp; - ' .
								$order->timenow; ?>
							</a>
						</li>
					<?php }
					


					// create pagination variables
					// a bit of wierd math as pages start on zero rather than one
					$next = $off + 1;
					$prev = $off - 1;

					// page variable
						if ($off>0) {
							$page = $next;
						} else {
							$page = '1';
						}

					// one plus one
					// the next and prev are correct for links but display incorrect numbers due to the offset being one below
						$display_next = $next + 1;

					// number of rows
					$number = $wpdb->get_var(
						"SELECT COUNT(*) FROM flaxen_inquiry WHERE ( name LIKE '$result%' OR name LIKE '%$result' OR email LIKE '$result%' OR email LIKE '%$result' AND confirm = 1 );"
					);

					// number of pages
					// ceil rounds up // floor rounds down
					$pages = floor($number/10); ?>

					<?php if ($number == 0) { ?>
						<p>Sorry, there are no results to display.</p>
						<p><a href="<?php echo esc_url( home_url( '/view-results' ) ); ?>">View all results</a></p>
					<?php } ?>
				
				
					<div class="button-group">

					<?php // previous
						if ($page > 1){ ?>
							<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $prev; ?>" class="button">Previous<span class="show-for-sr"> page</span></a>
						<?php } else { ?>
							<a class="button" href="#" disabled>previous</a>
						<?php }

					// page 1 & spacer
					if ($page > 4){ ?>
							<a href="<?php echo home_url(); ?>/view/" aria-label="Previous" class="button">1</a>
							<a href="#" class="clear button">...</a>
						<?php }

					//numbers
					// setup the variables as previous is in the opposite order of use all have to be done before
					$one_below = $page - 1;
					$two_below = $one_below - 1;
					$three_below = $two_below - 1;
					$four_below = $three_below - 1;

					// display one higher than linking due to offset starting at 0
					// third number below
						if ($page > 3){ ?>
							<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $four_below; ?>" class="button"><?php echo $three_below; ?></a>
						<?php }

					// second number below
						if ($page > 2){ ?>
							<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $three_below; ?>" class="button"><?php echo $two_below; ?></a>
						<?php }

					// first number below
						if ($page > 1){ ?>
							<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $two_below; ?>" class="button"><?php echo $one_below; ?></a>
						<?php }

					// current
						?>
							<a href="#" class="button secondary"><?php echo $page; ?></a>
						<?php

					// setup the variables as due to the 0 offset starting number we show one above what we link to
						$pages_m1 = $pages -1;
						$pages_m2 = $pages_m1 -1;

						$two_above = $next + 1;
						$three_above = $two_above + 1;
						$four_above = $three_above + 1;
						$last_page = $pages + 1;

					// next
						if ($page < $last_page){ ?>
							<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $next; ?>" class="button"><?php echo $two_above; ?></a>
						<?php }

					// 2 above
						if ($page < $pages){ ?>
								<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $two_above; ?>" class="button"><?php echo $three_above; ?></a>
							<?php }

					// 3 above
						if ($page < $pages_m1){ ?>
								<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $three_above; ?>" class="button"><?php echo $four_above; ?></a>
							<?php }

					// spacer & last page
						if ($page < $pages_m2){ ?>
								<a href="#" class="clear button">...</a>
								<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $pages; ?>" class="button"><?php echo $last_page; ?></a>
							<?php }

					 // Next
						if ($page < $last_page){ ?>
							<a href="<?php echo home_url(); ?>/view/?offset=<?php echo $next; ?>" class="button">Next<span class="show-for-sr"> page</span></a>
						<?php } else { ?>
							<a class="button" href="#" disabled>next</a>
						<?php } ?>

					</div> <!-- .button-group -->

					<?php } else {
						echo '<li>Sorry your not an admin.</li>';
					} ?>
				</ul>
		
			</div> <!-- .row -->
</div> <!-- .main -->

		<?php } // endwhile have posts

   } // end if
get_footer(); ?>
