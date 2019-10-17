<?php get_header(); ?>
<!--Left Open
	#page
	#masthead
	.off-canvas-wrapper
	off-canvas-wrapper-inner
	off-canvas-content
-->

<!-- theres some double up of the same things with the 404 that could be cleaner -->

<?php if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			if(get_post_meta($id, "split-entry-title-top", true) !== '') { ?>
				<h1 class="title-top split-entry-title-top text-right"><?php echo get_post_meta($post->ID, "split-entry-title-top", true); ?></h1>
			<?php } else { ?>
				<h1 class="title-top split-entry-title-top text-right"><?php the_title(); ?></h1>
			<?php } ?>

</header><!-- #masthead this was opened in header.php so allowed to be a little messy due to how the grid works-->

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
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.jpg" alt="stay gold header image" />
				</div>
			<?php } ?>

			<!-- these are purposley empty as they are grid only elements -->
			<div class="title-border"><!-- stay gold --></div>
			<div class="border-extender"><!-- stay gold --></div>

			<div class="main-bg-color cards"><!-- stay gold --></div>
			<div class="main">
				<div class="col-1 col-end-4 row-1 large-col-5 large-col-end-8">
					<?php the_content(); ?>
				</div>
			</div><!-- .main -->

		<?php } /* end if have post */
	} else { ?> <!-- end while have posts -->
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
*	.off-canvas-wrapper
*	off-canvas-wrapper-inner
*	off-canvas-content
*/
get_footer(); ?>
