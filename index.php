<?php get_header();
if ( have_posts() ) { ?>
		<main>
			<?php while ( have_posts() ) { 
				the_post(); ?>
				<h1><?php echo the_title(); ?></h1>

				<!-- allows for a max-height to crop the image -->
				<div class="main-thumbnail">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail(); 
					} ?>
				</div>

				<div class="title-border"><!-- stay gold --></div>
				
				<article> <!-- should this be a section? -->
					<?php the_content(); ?>
				</article>
				
			<?php } ?>
		</main>

	<?php } else { /* end while have posts */ ?>
		<main>
			<h1 class="title-top split-entry-title-top text-right">404, Sorry</h1>

			<div class="attachment-post-thumbnail">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" alt="stay gold header image" />
			</div>
		
			<div class="title-border"><!-- stay gold --></div>

			<article>
				<p>
					We're a little lost here, how about you head back <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">home</a> and lets start again.<br>
					Thanks
				</p>
			</article>
		</main>
	<?php }
get_footer(); ?>
