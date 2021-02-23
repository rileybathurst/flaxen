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

		<section id="featured-programs">
			<?php
				$args = [
					'post_type'			=> 'flaxen_program',
					'order'				=> 'DSC',
					'posts_per_page' 	=> 2
				];

				// The Query
				$the_query = new WP_Query( $args );
				
				// The Loop
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post(); ?>

						<article>
							<img src="<?php echo esc_attr( get_post_meta( $post->ID, 'i_two', true ) ); ?>" />
							<h2><a href="<?php the_permalink(); ?>" class="a-title"><?php the_title(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
							<a href="<?php the_permalink(); ?>" class="a-learn">Learn More</a>
						</article>

					<!-- while -->
					<?php }
				} else {
					// no posts found
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			?>
	
		</section>

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
