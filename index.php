<?php get_header(); ?>
<!--Left Open
	#page
	#masthead
	.off-canvas-wrapper
	off-canvas-wrapper-inner
	off-canvas-content
-->

<!-- theres some double up of the same things with the 404 that could be cleaner -->

<div class="title-border"><!-- stay gold --></div>
<div class="border-extender"><!-- stay gold --></div>
<div class="main-bg-color cards"><!-- stay gold --></div>

<?php if ( have_posts() ) {
	while ( have_posts() ) { // i think this is normally done a little different in 2019
		the_post(); ?>

		<h1 class="title-bottom split-entry-header-lower"><?php the_title(); ?></h1>

		<div class="title-image">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/screenshot.jpg" alt="" /> <!-- alt is purposley blank as this is unkown and decorative --> 
			<?php } ?>
		</div>

		<main <?php post_class(); ?>>
			<?php the_content(); ?>
		</main>

	<?php } /* end if have post */
} else { ?> <!-- end while have posts -->

	<h1 class="title-bottom split-entry-header-lower">404 Sorry</h1>

	<div class="title-image">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" alt="stay gold header image" />
	</div>

	<!-- these might be able to be removed so they dont have to be repeated they are decorative elements so could just load after the if posts -->


	<div class="main">
		<p>We're a little lost here, how about you head back <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">home</a> and lets start again.<br>
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
