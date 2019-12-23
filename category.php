<?php get_header(); ?>

<!-- these are purposley empty as they are grid only elements -->
<div class="title-border"><!-- stay gold --></div>
<div class="border-extender"><!-- stay gold --></div>
<div class="main-bg-color cards"><!-- stay gold --></div>

<?php if ( have_posts() ) { ?>

	<div class="main">
		<?php while ( have_posts() ) { 
			the_post(); ?>
			<h1><?php echo the_title(); ?></h1>

			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail(); 
			} ?>

			<?php the_content(); ?>
			<hr>
			
		<?php } ?>
	</div><!-- .main -->

<?php } else { /* end while have posts */ ?>
	<h1 class="title-bottom">404, Sorry</h1>

	<div class="title-image">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" alt="stay gold header image" />
	</div>

	<div class="main">
		<p>We're a little lost here, how about you head back <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">home</a> and lets start again.<br>
			Thanks</p>
	</div>
<?php }

get_footer(); ?>
