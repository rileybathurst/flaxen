<?php
/*  
 *  Template Name: Discovery
 */ 
?>

<?php get_header(); ?>

<!-- Start the main container -->
<div class="container" role="document">

    <?php if (have_posts()) { ?>
        <?php while (have_posts()) {
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

				<div class="class=col-1 col-end-4 row-1 large-col-5 large-col-end-8">
					<?php the_content(); ?>
				</div>
                 
				<!-- enctype='multipart/form-data' is key to submitting documents -->
				<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" enctype='multipart/form-data' method="post" data-abide novalidate class="col-1 col-end-4 row-2 large-col-5 large-col-end-8">

					<input type="hidden" name="action" value="discovery">
					<input type="hidden" name="data" value="discoveryid"><!-- slightly different value to differentiate, not used -->

					<label for="name" class="right-medium-up">Full Name:*</label>
					<input name="name" type="text" required id="name"
					   <?php if ( is_user_logged_in() ) { ?>
							value="<?php echo $current_user->display_name; ?>"
						<?php } else { ?>
							placeholder="Jane Smith"
						<?php } ?>
					/>
					<!-- error -->
					<small class="form-error">A full name is required.</small>

					<label for="email" class="right-medium-up">email:*</label>
					<input name="email" type="text" required pattern="email" id="email"  
						<?php if ( is_user_logged_in() ) { ?>
							value="<?php echo $current_user->user_email; ?>"
						<?php } else { ?>
							placeholder="jane at php the_url"
						<?php } ?>       
					/><small class="form-error">An email address is required.</small>

					<label for="phone" class="right-medium-up">Phone:</label>
					<input name="phone" type="text" required id="phone" placeholder="&#40;775&#41;">


					<p>Can you describe three activities in your daily life that cause your symptoms to be irritated?  How long does this take - seconds, minutes, or hours?  And finally, how long does it take to resolve back to the baseline level - seconds, minutes, or hours?</p>

					<label for="act1" class="right-medium-up">1:</label>
					<input name="act1" type="text" id="act1" placeholder="walking, 1 hour to hurt, 1 hour to relieve">

					<label for="act2" class="right-medium-up">2:</label>
					<input name="act2" type="text" id="act2" placeholder="stairs, 3 flights to hurt, 30 minutes to relieve">

					<label for="act3" class="right-medium-up">3:</label>
					<input name="act3" type="text" id="act3" placeholder="cycling, 1 mile, next day to relieve">
                                
					
					<label for="start">When and how did the symptoms start?</label>
					<textarea name="start" id="start" placeholder="Last tuesday while at work"></textarea>
					
					
					<label for="act1" class="right-medium-up">1:</label>
					<input name="act1" type="text" id="act1" placeholder="walking, 1 hour to hurt, 1 hour to relieve">
					
					
					<label for="act1" class="right-medium-up">1:</label>
					<input name="act1" type="text" id="act1" placeholder="walking, 1 hour to hurt, 1 hour to relieve">
					
					
					<label for="start">When and how did the symptoms start?</label>
					<textarea name="start" id="start" placeholder="Last tuesday while at work"></textarea>
								
					<div data-abide-error class="alert callout" style="display: none;">
						<p><i class="fi-alert"></i> There are some errors in your form.</p>
					</div>

					<button type="submit" class="button">Submit</button>

				</form>
					
			</div> <!-- .main -->
                       
       <?php } /* end if have post */
} else { /* end while have posts */ ?>
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