<?php get_header(); ?>
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
<?php get_footer(); ?>