<?php get_header(); ?>
<!-- Left Open
	#page
	#masthead
	.off-canvas-wrapper
	off-canvas-wrapper-inner
	off-canvas-content
-->
</header><!-- #masthead -->


<?php
	if ( have_posts() ) { ?>


<!-- these are purposley empty as they are grid only elements -->
<div class="title-border"><!-- stay gold --></div>
<div class="border-extender"><!-- stay gold --></div>

<div class="main-bg-color cards"><!-- stay gold --></div>
<div class="main">

	<div class="col-1 col-end-4 row-1 large-col-5 large-col-end-8">

	<?php while ( have_posts() ) { 
		the_post(); ?>
		<h1><?php echo the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail(); 
		} ?>

		<?php the_content(); ?>
		<hr>
		
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
*	.off-canvas-wrapper
*	off-canvas-wrapper-inner
*	off-canvas-content
*/
get_footer(); ?>
