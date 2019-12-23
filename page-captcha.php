<?php
/*  
 *  Template Name: Captcha
 */ 
get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
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

				<input type="hidden" name="action" value="captcha">
				<input type="hidden" name="data" value="captchaid"><!-- slightly different value to differentiate, not used -->
				
				<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

				<input name="name" type="text" required id="name" placeholder="Jane Smith"/>
				
				<button type="submit" class="button">Submit</button>
			</form>
		</div><!-- .main -->
<?php } /* end if have post */
} /* end while have posts */
get_footer(); ?>