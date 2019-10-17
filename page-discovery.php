<?php
/*  
 *  Template Name: Discovery
 */ 
get_header(); ?>

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

				<!-- <div class="col-1 col-end-4 row-1 large-col-5 large-col-end-8"> --> <!-- I think the <p> tag is controlling this now-->
					<?php the_content(); ?>
				<!-- </div> -->
				
				<script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
				  <script>
				  grecaptcha.ready(function() {
					  grecaptcha.execute('6LdiC4YUAAAAANuw48UrjkBkcDkhQvUxZO5N752o', {action: 'discovery'}).then(function(token) {
						// add token value to form
							document.getElementById('g-recaptcha-response').value = token;
					  });
				  });
				  </script>
                 
				<!-- enctype='multipart/form-data' is key to submitting documents -->
				<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" enctype='multipart/form-data' method="post" data-abide novalidate class="col-1 col-end-5 row-2 large-col-5 large-col-end-8">

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
							placeholder="amanda at authentic alignment wellness"
						<?php } ?>
					/>

					<label for="phone" class="right-medium-up">Phone:</label>
					<input name="phone" type="text" required id="phone" placeholder="&#40;775&#41;">

					<p>What are your 3 biggest obstacles to being in your peak health?</p>

					<label for="obs1" class="right-medium-up">1:</label>
					<input name="obs1" type="text" id="obs1" placeholder="commitments to family, friends and work">

					<label for="act2" class="right-medium-up">2:</label>
					<input name="obs2" type="text" id="obs2" placeholder="previous injury or ailment">

					<label for="act3" class="right-medium-up">3:</label>
					<input name="obs3" type="text" id="obs3" placeholder="candy just tastes too good">

					<label for="significant">What is one thing that you could be doing for yourself that you know would have a significant impact on your health and well-being?</label>
					<textarea name="significant" id="significant" placeholder="Having someone to check I'm getting up and off the couch"></textarea>

					<label for="idol" class="right-medium-up">Who is your biggest idol and why?</label>
					<input name="idol" type="text" id="idol" placeholder="my sister">
					
					
					<label for="band" class="right-medium-up">What's your favorite band?</label>
					<input name="band" type="text" id="band" placeholder="Florence and the Machine">
					
					
					<label for="find">How did you find Authentic Alignment Wellness?</label>
					<textarea name="find" id="find" placeholder="friends told me about it"></textarea>
								
					<!-- recaptcha -->
					<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

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