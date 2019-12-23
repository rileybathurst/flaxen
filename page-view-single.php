<?php
/*
 *  Template Name: View Single
 */

get_header();

if(isset($_GET['n'])) {
	//define variable for url bar .php?n=
	$unid = $_GET['n'];
}
?>

<div class="title-border"><!-- stay gold --></div>
<div class="border-extender"><!-- stay gold --></div>
<div class="main-bg-color cards"><!-- stay gold --></div>

<?php if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>

		<h1 class="title-bottom split-entry-header-lower"><?php the_title(); ?></h1>

		<div class="title-image">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/screenshot.jpg" alt="" /> <!-- alt is purposley blank as this is unkown and decorative --> 
			<?php } ?>
		</div>

		<main>
			<!-- the_content(); not currently used -->

			<?php if(current_user_can('administrator')) {

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

					<ul class="single-list">

						<!-- type -->
						<li>TYPE |
							<strong>
								<?php echo $order->type; ?>
							</strong>
						</li>

						<!-- unid -->
						<li>ORDER NUMBER |
							<strong>
								<?php echo $order->unid; ?>
							</strong>
						</li>

						<!-- name -->
						<li>NAME |
							<strong>
								<?php echo $order->name; ?>
							</strong>
						</li>

						<!-- email -->
						<li>EMAIL |
							<strong>
								<?php echo $order->email; ?>
							</strong>
						</li>

						<!-- phone -->
						<li>PHONE |
							<strong>
								<?php echo $order->phone; ?>
							</strong>
						</li>

						<!-- obs1 -->
						<li>OBSTACE 1 |
							<strong>
								<?php echo $order->obs1; ?>
							</strong>
						</li>

						<!-- obs2 -->
						<li>OBSTACE 2 |
							<strong>
								<?php echo $order->obs2; ?>
							</strong>
						</li>

								<!-- obs3 -->
						<li>OBSTACE 3 |
							<strong>
								<?php echo $order->obs3; ?>
							</strong>
						</li>
						<!-- 	significant -->
						<li>SIGNIFICANT |
							<strong>
								<?php echo $order->	significant; ?>
							</strong>
						</li>
						<!-- idol -->
						<li>IDOL |
							<strong>
								<?php echo $order->idol; ?>
							</strong>
						</li>
						<!-- band -->
						<li>BAND |
							<strong>
								<?php echo $order->band; ?>
							</strong>
						</li>
						<!-- find -->
						<li>FIND |
							<strong>
								<?php echo $order->find; ?>
							</strong>
						</li>

						<!-- terms -->
						<li>Terms and Conditions confirm |
							<strong>
								<?php if ($order->terms == 1) {
									echo 'Yes';
								} else {
									echo 'No';
								} ?>
							</strong>
						</li>

						<!-- timenow -->
						<li>DATE SUBMITTED |
							<strong>
								<?php echo $order->timenow; ?>
							</strong>
						</li>

					</ul>

				<?php } ?>

				<!-- back and forward -->
				<div class="no-print">
					<hr>

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

					if ($unid>1) { ?>
						<a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $below; ?>" aria-label="Previous" class="button">Previous Order</a>
					<?php } else { ?>
						<a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $below; ?>" aria-label="Previous" class="button" disabled>Previous Order</a>
					<?php } ;?>

					<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>view-results/?r=" class="button">Back to orders</a></p>
				</div>
				
			<?php } else {
				echo '<li>Sorry your not an admin.</li>';
			} ?>

		</main>

	<?php } // endwhile have posts

} // end if
get_footer(); ?>
