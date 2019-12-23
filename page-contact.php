<?php
/*
 * Template Name: Contact
 */

get_header();

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>

			<h1 class="title-bottom"><?php the_title(); ?></h1>

			<?php if ( has_post_thumbnail() ) {
			/* is there a way to add a style to this without wrapping it in a div? class="title-image" */ ?>
				<div class="title-image">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php } else { ?>
				<div class="title-image">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" alt="" /> <!-- no alt as its onl decoration -->
				</div>
			<?php } ?>

			<!-- these are purposley empty as they are grid only elements -->
			<div class="title-border"><!-- stay gold --></div>
			<div class="border-extender"><!-- stay gold --></div>

			<div class="main-bg-color cards"><!-- stay gold --></div>
			<div class="main">

				<?php the_content(); ?>

				<hr>
				
				<!-- enctype='multipart/form-data' is key to submitting documents -->
				<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" enctype='multipart/form-data' method="post" data-abide novalidate>

					<fieldset>
						<input type="hidden" name="action" value="contact">
						<input type="hidden" name="data" value="contactid"><!-- slightly different value to differentiate, not used -->


						<label for="name" class="right-medium-up">Full Name:*</label>

						<input name="name" type="text" required id="name"
							<?php if ( is_user_logged_in() ) { ?>
								value="<?php echo $current_user->display_name; ?>"
							<?php } else { ?>
								placeholder="Jane Smith"
							<?php } ?>
						/>

						<label for="add1" class="right-medium-up">Address:*</label>
						<input name="add1" type="text" id="add1" placeholder="Street Address">

						<input name="add2" type="text" id="add2" placeholder="City">
						<input name="add3" type="text" id="add3" placeholder="State">
						<input name="add4" type="number" id="add4" placeholder="Zip Code">

						<label for="email" class="right-medium-up">email:*</label>
						<input name="email" type="text" required id="email"  
							<?php if ( is_user_logged_in() ) { ?>
								value="<?php echo $current_user->user_email; ?>"
							<?php } else { ?>
								placeholder="jane at <?php bloginfo( 'name' ); ?>.com"
							<?php } ?>
						/>
						
						<label for="phone" class="right-medium-up">Phone:*</label>
						<input name="phone" type="text" required id="phone" placeholder="&#40;775&#41;">

						<hr>

						<label for="add_notes" class="right-medium-up">Notes</label>
						<input type="text" name="add_notes">

						<button type="submit" class="button">Submit</button>
					</fieldset>
				</form>
			</div><!-- .main -->

		<?php } /* end if have post */
	} /* end while have posts */
get_footer(); ?>