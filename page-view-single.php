<?php
/*
 *  Template Name: View Single
 */

get_header();

	//define variable for url bar .php?n=
	$unid = $_GET['n'];

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

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
		<?php the_content(); ?>

		<!-- Im pretty syre there is a faster cleaner way of doing this -->
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

		// then search for orders -->
		$orders = $wpdb->get_results(
				"
					SELECT *
					FROM flaxen_inquiry
					WHERE unid = '$unid';
				"
			);
			foreach ( $orders as $order )
			{ ?>

				<ul class="no-bullet second-rows grid-x grid-padding-x">

<!-- type -->
		<li class="cell">TYPE |
				<strong>
					<?php echo $order->type; ?>
				</strong>
			</li>

<!-- unid -->
		<li class="cell">ORDER NUMBER |
				<strong>
					<?php echo $order->unid; ?>
				</strong>
			</li>

<!-- name -->

			<li class="cell">NAME |
				<strong>
					<?php echo $order->name; ?>
				</strong>
			</li>

<!-- email -->
			<li class="cell">EMAIL |
				<strong>
					<?php echo $order->email; ?>
				</strong>
			</li>

<!-- phone -->
			<li class="cell">PHONE |
				<strong>
					<?php echo $order->phone; ?>
				</strong>
			</li>

<!-- obs1 -->
			<li class="cell">OBSTACE 1 |
				<strong>
					<?php echo $order->obs1; ?>
				</strong>
			</li>

<!-- obs2 -->
			<li class="cell">OBSTACE 2 |
				<strong>
					<?php echo $order->obs2; ?>
				</strong>
			</li>

					<!-- obs3 -->
			<li class="cell">OBSTACE 3 |
				<strong>
					<?php echo $order->obs3; ?>
				</strong>
			</li>
<!-- 	significant -->
			<li class="cell">SIGNIFICANT |
				<strong>
					<?php echo $order->	significant; ?>
				</strong>
			</li>
<!-- idol -->
			<li class="cell">IDOL |
				<strong>
					<?php echo $order->idol; ?>
				</strong>
			</li>
<!-- band -->
			<li class="cell">BAND |
				<strong>
					<?php echo $order->band; ?>
				</strong>
			</li>
<!-- find -->
			<li class="cell">FIND |
				<strong>
					<?php echo $order->find; ?>
				</strong>
			</li>

<!-- terms -->
		<li class="cell">Terms and Conditions confirm |
				<strong>
					<?php if ($order->terms == 1) {
						echo 'Yes';
					} else {
						echo 'No';
					} ?>
				</strong>
			</li>

 <!-- timenow -->
			<li class="cell">DATE SUBMITTED |
				<strong>
					<?php echo $order->timenow; ?>
				</strong>
			</li>

		</ul>

			<?php } ?>

			<!-- back and forward -->

			<hr class="no-print">

			<?php
				// pagination

				// number of rows
				$number = $wpdb->get_var(
					"SELECT COUNT(*) FROM flaxen_inquiry;"
				);

				// next & previous
				$above = $unid + 1;
				$below = $unid - 1;

			// Next
				if ($number > $unid) { ?>
					<a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $above; ?>" aria-label="Next" class="button">Next Order</a>
				<?php } else { ?>
					<a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $above; ?>" aria-label="Next" class="button" disabled>Next Order</a>
				<?php }

				if ($unid>1)  { ?>
					<a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $below; ?>" aria-label="Previous" class="button">Previous Order</a>
				<?php } else { ?>
					<a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $below; ?>" aria-label="Previous" class="button" disabled>Previous Order</a>
				<?php } ;?>

			<div class="no-print">
				<div class="cell">
					<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>view-results/?r=" class="button">Back to orders</a></p>
				</div>
			</div>

		<?php } else {
		echo '<li>Sorry your not an admin.</li>';
		}
		?>

	</div> <!-- .row -->
</div> <!-- .main -->

		<?php } // endwhile have posts

   } // end if
get_footer(); ?>
