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

				<?php the_content(); ?>

				
				
				
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
				<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" enctype='multipart/form-data' method="post" >

					<input type="hidden" name="action" value="email">
					<input type="hidden" name="data" value="emailid"><!-- slightly different value to differentiate, not used -->
					
					<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

					<input name="email" type="email" required id="email" placeholder="me@example.com"/>
					
					<button type="submit" class="button">Submit</button>
				</form>
				
			</div> <!-- .main -->
                       
       <?php } /* end if have post */
} // dont need an else for a specific page

/* Left Open
*	#page
*	.off-canvas-wrapper
*	off-canvas-wrapper-inner
*	off-canvas-content
*/
	
get_footer(); ?>