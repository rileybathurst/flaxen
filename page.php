<?php get_header(); ?>
<!-- Left Open
	#page
	#masthead
	.off-canvas-wrapper
	off-canvas-wrapper-inner
	off-canvas-content
-->

<?php
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

	<?php the_content(); ?>
	
</div><!-- .main -->

<?php } /* end if have post */
} /* end while have posts */

/* Left Open
*	#page
*	.off-canvas-wrapper
*	off-canvas-wrapper-inner
*	off-canvas-content
*/
get_footer(); ?>
