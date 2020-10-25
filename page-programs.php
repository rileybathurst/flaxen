<?php
/*  
 *  Template Name: Programs
 */ 
get_header(); ?>

<?php if (have_posts()) { ?>
	<?php while (have_posts()) {
		the_post(); ?>

			<h1 class="title-bottom"><?php the_title(); ?></h1>

			<?php if ( has_post_thumbnail() ) {
			/* is there a way to add a style to this without wrapping it in a div? class="title-image" */ ?>
				<div class="title-image">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php } else { ?>
				<div class="title-image">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/header.jpg" alt="stay gold header image" />
				</div>
			<?php } ?>

			<div class="title-border"><!-- stay gold --></div>
			<div class="border-extender"><!-- stay gold --></div>
			<div class="main-bg-color cards"><!-- stay gold --></div>

			<div class="main">
				<?php the_content(); ?>

				<div class="main-extra">
					<ul class="programs-list">

					<?php
						$args = [
							'post_type'			=> 'flaxen_program',
							'order'				=> 'ASC',
						];

						// The Query
						$the_query = new WP_Query( $args );
						
						// The Loop
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post(); ?>
								<li>
									<hr>
									<h3>
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
									<a href="<?php the_permalink(); ?>" class="price-click">
										$<?php echo esc_attr( get_post_meta( $post->ID, 'p_cost', true ) ); ?>
									</a>
									<?php the_excerpt(); ?>
								</li>
							<?php }
						} else {
							// no posts found
						}
						/* Restore original Post Data */
						wp_reset_postdata();

					?>
					</ul>
				</div>
			</div> <!-- .main -->



	<?php } /* end if have post */
}

get_footer(); ?>