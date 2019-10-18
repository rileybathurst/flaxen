<?php
function flaxen_setup() {
	load_theme_textdomain( 'flaxen' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'flaxen-featured-image', 2000, 1200, true );

	add_image_size( 'flaxen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'flaxen' ),
		'social' => __( 'Social Links Menu', 'flaxen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( // these can now be removed with gutenberg
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );
}
add_action( 'after_setup_theme', 'flaxen_setup' );

/**
 * Enqueue scripts and styles.
 */
function flaxen_scripts() {

	// Theme stylesheet.
	wp_enqueue_style( 'flaxen-style', get_stylesheet_uri() );
	
   // Foundation style.
    wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/app.css' );

   // Google Font style.
    wp_enqueue_style( 'font', 'https://fonts.googleapis.com/css?family=Playfair+Display' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	/* this is from 2017 I should think about it but its out until I do
*	wp_enqueue_script( 'flaxen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );
*/
	
	/**
	 * SVG icons functions and filters.
	 */
	require get_parent_theme_file_path( '/inc/icon-functions.php' );
	// backend options
	// require get_parent_theme_file_path( '/inc/admin-pages.php' );
}
add_action( 'wp_enqueue_scripts', 'flaxen_scripts' );

/**
 * Register custom fonts.
 */
function flaxen_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'flaxen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}








































// Stay Gold additional setting
/*WordPress Menus API.*/
function add_new_menu_items()
{
    //add a new menu item. This is a top level menu item i.e., this menu item can have sub menus
    add_menu_page(
        "Flaxen Theme Options", //Required. Text in browser title bar when the page associated with this menu item is displayed.
        "Flaxen", //Required. Text to be displayed in the menu.
        "manage_options", //Required. The required capability of users to access this menu item.
        "theme-options", //Required. A unique identifier to identify this menu item.
        "theme_options_page", //Optional. This callback outputs the content of the page associated with this menu item.
        "", //Optional. The URL to the menu item icon.
        100 //Optional. Position of the menu item in the menu.
    );
}

function theme_options_page() 
{ ?>
<div class="wrap">
	<form method="post" action="options.php">
		<?php

			//add_settings_section callback is displayed here. For every new section we need to call settings_fields.
			settings_fields("header_section");

			// all the add_settings_field callbacks is displayed here
			do_settings_sections("theme-options");

			// Add the submit button to serialize the options
			submit_button(); ?>
	</form>
</div>
<?php }

//this action callback is triggered when wordpress is ready to add new items to menu.
add_action("admin_menu", "add_new_menu_items");

/*WordPress Settings API Stay Gold*/

function display_options()
{
    //section name, display name, callback to print description of section, page to which section is attached.
    add_settings_section("header_section", "Flaxen Theme Options", "display_header_options_content", "theme-options");
    
    //setting name, display name, callback to print form element, page in which field is displayed, section to which it belongs.
    //last field section is optional.
    add_settings_field("established", "Established", "display_established_element", "theme-options", "header_section");
    add_settings_field("copyright", "Copyright", "display_copyright_element", "theme-options", "header_section");
    add_settings_field("contact_phone", "Contact Phone", "display_contact_phone_element", "theme-options", "header_section");
    add_settings_field("logo_letter", "Logo Letter", "display_logo_letter_element", "theme-options", "header_section");

    //section name, form element name, callback for sanitization
    register_setting("header_section", "established");
    register_setting("header_section", "copyright");
    register_setting("header_section", "contact_phone");
    register_setting("header_section", "logo_letter");
}

function display_header_options_content(){echo "Details can be added or changed here in various parts of the site.";}

function display_established_element()
{
    //id and name of form element should be same as the setting name.
    ?>
        <input type="text" name="established" id="established" value="<?php echo get_option('established'); ?>" />
    <?php
}
function display_copyright_element()
{
    //id and name of form element should be same as the setting name.
    ?>
        <input type="checkbox" name="copyright" id="copyright" <?php if(get_option('copyright') == 'on'){ ?> checked <?php } ?> />
    <?php
}
 function display_contact_phone_element()
{
    //id and name of form element should be same as the setting name.
    ?>
        <input type="text" name="contact_phone" id="contact_phone" value="<?php echo get_option('contact_phone'); ?>" />
    <?php
}
function display_logo_letter_element()
{
    //id and name of form element should be same as the setting name.
    ?>
        <input type="text" name="logo_letter" id="logo_letter" value="<?php echo get_option('logo_letter'); ?>" />
    <?php
}

//this action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
add_action("admin_init", "display_options");

// sub menu pages
function theme_options_panel(){
  add_submenu_page(
      'theme-options', //parent_slug
      'Flaxen Options', //page_title
      'Flaxen Options', // menu_title
      'manage_options', // capability
      'home-settings', // menu_slug
      'home_options_page' // function
  );
	add_submenu_page( 'theme-options', 'Results', 'Results', 'manage_options', 'stay_gold-results', 'stay_gold_results_page');
	add_submenu_page( 'theme-options', 'FAQ', 'FAQ', 'manage_options', 'stay_gold-faq', 'stay_gold_faq_page');
}
// then hook them up
add_action('admin_menu', 'theme_options_panel');

// content for the sub pages
function home_options_page()
{
    ?>
        <div class="wrap">
        <h1>Home Options</h1>
            <form method="post" action="options.php">
                <?php
    
                //add_settings_section callback is displayed here. For every new section we need to call settings_fields.
                settings_fields("home_1_section");

                // all the add_settings_field callbacks is displayed here
                do_settings_sections("home_1-options");

                // Add the submit button to serialize the options
                submit_button();
            ?>
        </form>
    </div>
<?php }

// build the settings
function home_options()
{
    add_settings_section(
        "home_1_section", //section name
        "Home Options", // display name
        "home_1_content", // callback to print description of section
        "home-settings" // page to which section is attached.
    );
    
    add_settings_field(
        "home_1", //setting name
        "Home 1", // display name
        "display_home_1_element", //callback to print form element
        "home-settings", // page in which field is displayed
        "home_1_section" // section to which it belongs
    );

    register_setting(
        "home_1_section", //section name
        "home_1" // form element name, callback for sanitization
    );
}

function home_1_content(){echo "Add some details";}
function display_home_1_element()
{
    //id and name of form element should be same as the setting name.
    ?>
        <input type="text" name="home_1" id="home_1" value="<?php echo get_option('home_1'); ?>" />
    <?php
}

//this action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
add_action("admin_init", "home_options");

// content for the sub pages
function stay_gold_results_page()
{
    ?>
        <div class="wrap">
        <h1>Results</h1>
			<p>Click the link to find all the contact emails you have been sent</p>
			<p><a href="<?php echo esc_url( home_url( '/view-results/?r=' ) ); ?>">Results</a></p>
    </div>
    <?php
}

// content for the sub pages
function stay_gold_faq_page()
{ ?>
	<div class="wrap">
		<h1>FAQ</h1>
		<p>Theme development by Stay Gold Design Club.</p>
	</div>
<?php }



































/**
 * Create a metabox with multiple fields.
	 * Create the metabox
	 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
	 */
	function flaxen_create_metabox() {
		// Can only be used on a single post type (ie. page or post or a custom post type).
		// Must be repeated for each post type you want the metabox to appear on.
		add_meta_box(
			'flaxen_metabox', // Metabox ID
			'Split Title', // Title to display
			'flaxen_render_metabox', // Function to call that contains the metabox content
			'post', // Post type to display metabox on
			'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
			'default' // Priority relative to other metaboxes
		);
	}
	add_action( 'add_meta_boxes', 'flaxen_create_metabox' );

    /**
	 * Create the metabox default values
	 * This allows us to save multiple values in an array, reducing the size of our database.
	 * Setting defaults helps avoid "array key doesn't exit" issues.
	 * @todo
	 */
	function flaxen_metabox_defaults() {
		return array(
			'split_left'     => 'default',
			'split_right'    => 'default',
		);
	}

	/**
	 * Render the metabox markup
	 * This is the function called in `flaxen_create_metabox()`
	 */
	function flaxen_render_metabox() {

		// Variables
		global $post; // Get the current post data
        $saved = get_post_meta( $post->ID, 'flaxen', true ); // Get the saved values
		$defaults = flaxen_metabox_defaults(); // Get the default values
		$flaxen = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
		
		?>

			<fieldset>
                
                <!-- Split Left ----------------------------------------------------------------------------------------------- -->
				<div class="wrap">
					<label for="flaxen_custom_metabox_split_left" class="subtitle">
						<?php _e( 'Split Left', 'flaxen' ); ?>
					</label>
					
					<input
						type="text"
						name="flaxen_custom_metabox[split_left]"
						id="flaxen_custom_metabox_split_left"
						value="<?php echo esc_attr( $flaxen['split_left'] ); ?>"
					>
				</div>
                
                <!-- Split Right ----------------------------------------------------------------------------------------------- -->
				<div class="wrap">
					<label for="flaxen_custom_metabox_split_right" class="subtitle">
						<?php _e( 'Split Right', 'flaxen' ); ?>
					</label>
					
					<input
						type="text"
						name="flaxen_custom_metabox[split_right]"
						id="flaxen_custom_metabox_split_right"
						value="<?php echo esc_attr( $flaxen['split_right'] ); ?>"
					>
				</div>
            </fieldset>

        <?php
		// Security field
		// This validates that submission came from the
		// actual dashboard and not the front end or
		// a remote server.
		wp_nonce_field( 'flaxen_form_metabox_nonce', 'flaxen_form_metabox_process' );
		}
	//
	// Save our data
	//
	/**
	 * Save the metabox
	 * @param  Number $post_id The post ID
	 * @param  Array  $post    The post data
	 */
	function flaxen_save_metabox( $post_id, $post ) {
		// Verify that our security field exists. If not, bail.
		if ( !isset( $_POST['flaxen_form_metabox_process'] ) ) return;
		// Verify data came from edit/dashboard screen
		if ( !wp_verify_nonce( $_POST['flaxen_form_metabox_process'], 'flaxen_form_metabox_nonce' ) ) {
			return $post->ID;
		}
		// Verify user has permission to edit post
		if ( !current_user_can( 'edit_post', $post->ID )) {
			return $post->ID;
		}
		// Check that our custom fields are being passed along
		// This is the `name` value array. We can grab all
		// of the fields and their values at once.
		if ( !isset( $_POST['flaxen_custom_metabox'] ) ) {
			return $post->ID;
		}
		/**
		 * Sanitize all data
		 * This keeps malicious code out of our database.
		 */
		// Set up an empty array
		$sanitized = array();
		// Loop through each of our fields
		foreach ( $_POST['flaxen_custom_metabox'] as $key => $realestate ) {
			// Sanitize the data and push it to our new array
			// `wp_filter_post_kses` strips our dangerous server values
			// and allows through anything you can include a post.
			$sanitized[$key] = wp_filter_post_kses( $realestate );
		}
		// Save our submissions to the database
		update_post_meta( $post->ID, 'flaxen', $sanitized );
	}
	add_action( 'save_post', 'flaxen_save_metabox', 1, 2 );
	//
	// Save a copy to our revision history
	// This is optional, and potentially undesireable for certain data types.
	// Restoring a a post to an old version will also update the metabox.
	/**
	 * Save events data to revisions
	 * @param  Number $post_id The post ID
	 */
	function flaxen_save_revisions( $post_id ) {
		// Check if it's a revision
		$parent_id = wp_is_post_revision( $post_id );
		// If is revision
		if ( $parent_id ) {
			// Get the saved data
			$parent = get_post( $parent_id );
			$flaxen = get_post_meta( $parent->ID, 'flaxen', true );
			// If data exists and is an array, add to revision
			if ( !empty( $flaxen ) && is_array( $flaxen ) ) {
				// Get the defaults
				$defaults = flaxen_metabox_defaults();
				// For each default item
				foreach ( $defaults as $key => $value ) {
					// If there's a saved value for the field, save it to the version history
					if ( array_key_exists( $key, $flaxen ) ) {
						add_metadata( 'post', $post_id, 'flaxen_' . $key, $flaxen[$key] );
					}
				}
			}
		}
	}
	add_action( 'save_post', 'flaxen_save_revisions' );
	/**
	 * Restore events data with post revisions
	 * @param  Number $post_id     The post ID
	 * @param  Number $revision_id The revision ID
	 */
	function flaxen_restore_revisions( $post_id, $revision_id ) {
		// Variables
		$post = get_post( $post_id ); // The post
		$revision = get_post( $revision_id ); // The revision
		$defaults = flaxen_metabox_defaults(); // The default values
		$flaxen = array(); // An empty array for our new metadata values
		// Update content
		// For each field
		foreach ( $defaults as $key => $value ) {
			// Get the revision history version
			$realestate_revision = get_metadata( 'post', $revision->ID, 'flaxen_' . $key, true );
			// If a historic version exists, add it to our new data
			if ( isset( $realestate_revision ) ) {
				$flaxen[$key] = $realestate_revision;
			}
		}
		// Replace our saved data with the old version
		update_post_meta( $post_id, 'flaxen', $flaxen );
	}
	add_action( 'wp_restore_post_revision', 'flaxen_restore_revisions', 10, 2 );
	/**
	 * Get the data to display on the revisions page
	 * @param  Array $fields The fields
	 * @return Array The fields
	 */
	function flaxen_get_revisions_fields( $fields ) {
		// Get our default values
		$defaults = flaxen_metabox_defaults();
		// For each field, use the key as the title
		foreach ( $defaults as $key => $value ) {
			$fields['flaxen_' . $key] = ucfirst( $key );
		}
		return $fields;
	}
	add_filter( '_wp_post_revision_fields', 'flaxen_get_revisions_fields' );
	/**
	 * Display the data on the revisions page
	 * @param  String|Array $value The field value
	 * @param  Array        $field The field
	 */
	function flaxen_display_revisions_fields( $value, $field ) {
		global $revision;
		return get_metadata( 'post', $revision->ID, $field, true );
	}
	add_filter( '_wp_post_revision_field_my_meta', 'flaxen_display_revisions_fields', 10, 2 );

/*----------------------------------------------------------------------------------------------------*/









/*FIX A FEW THINGS WITH AUTOUPDATING TO THE SITE*/
// Discovery form from _POST
// deals with contact form sent through form _POST
function prefix_admin_discovery() {
	// Check if captcha has been checked
	if(isset($_POST['g-recaptcha-response'])){
		$captcha=$_POST['g-recaptcha-response'];
	}
	else {
		$captcha = false;
	}

	if(!$captcha){
		//Do something with error
		wp_redirect( home_url() . '/no-captcha' );
	} else {
		// Build POST request:
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		$recaptcha_secret = '6LdiC4YUAAAAAFQuaFjA7c6O5baXRE9FVVwbJXE2';
		$recaptcha_response = $_POST['g-recaptcha-response'];
	
		// Make and decode POST request:
		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		$recaptcha = json_decode($recaptcha);
	
		// Take action based on the score returned:
		if ($recaptcha->score >= 0.1) {
			// Verified - send email
			// The Captcha is valid you can continue with the rest of your code
			// wp_redirect( home_url() . '/thanks' );

			// send the email before inserting into the database
			//get form elements and email
			$name = $_POST['name'];
			$email = $_POST['email'];

			$to			= 'riley@rileybathurst.com'; // developer testing needs to be off
			$to2		= 'authenticalignmentwellness@gmail.com';
			$subject	= 'Authentic Alignment Wellness Discovery Session: '.$name;

			//write email
			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<title>Authentic Alignment Wellness</title>
					</head>

					<body bgcolor="#ebebeb">

						<table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ebebeb" align="center">
							<tbody>
								<tr>
									<table style="border-left: 2px solid #e6e6e6; border-right: 2px solid #e6e6e6;" cellspacing="0" cellpadding="25" width="605" align="center">

										<tr>
											<td width="596" align="center" style="background-color: #ffffff; border-top: 0px solid #000000; text-align: left; height: 50px;">
												<p style="margin-bottom: 10px; font-size: 22px; font-weight: bold; color: #494a48; font-family: arial; line-height: 110%; text-align: center;">Authentic Alignment Wellness</p>
											</td>
										</tr>

										<tr>
											<td style="background-color: #ffffff; border-top: 0px solid #000000; text-align: left;" align="center">

												<hr style="color:#d9d9d9;background-color:#d9d9d9;min-height:1px;border:none;"/>

												<p>
													Thanks for your contact, '.
														$_POST['name'] .
													' we will be in touch ASAP.
												</p>

												<hr style="color:#d9d9d9;background-color:#d9d9d9;min-height:1px;border:none;"/>

												<p>
													For your records the message was,<br>
													What are your 3 biggest obstacles to being in your peak health?
												</p>

												<p>'.
													$_POST['obs1'] . '<br/>'.
													$_POST['obs2'] . '<br/>'.
													$_POST['obs3'] . '<br/>
												</p>

												<p>What is one thing that you could be doing for yourself that you know would have a significant impact on your health and well-being?</p> ' .
													$_POST['significant'] .

												'<p>Who is your biggest idol and why?</p> ' .
													$_POST['idol'] .

												'<p> Whats your favorite band?</p> ' .
													$_POST['band'] .

												'<p>How did you find Authentic Alignment Wellness?</p> ' .
													$_POST['find'] .

												'<hr style="color:#d9d9d9;background-color:#d9d9d9;min-height:1px;border:none;"/>

												<p>
													We will contact you back on, ' .
														$_POST['email'] .
													' or '.
														$_POST['phone'] .
												'</p>

												<hr style="color:#d9d9d9;background-color:#d9d9d9;min-height:1px;border:none;"/>

											</td>
										</tr>

										<tr>
											<td style="background-color: #ffffff; border-top: 0px solid #000000; text-align: center;" align="center">
												<span style="font-size: 11px; color: #575757; line-height: 200%; font-family: arial; text-decoration: none;">
													Authentic Alignment Wellness<br>
													<a href="mailto:info@authenticalignmentwellness">info@authenticalignmentwellness</a>
													<br>
													<a href="https://www.facebook.com/authenticalignmentwellness/">facebook</a>
													<br>
													<a href="https://www.instagram.com/authentic.alignment.wellness/">instagram</a>
												</span>
											</td>
										</tr>

									</table>
								</tr>
							</tbody>
						</table>
					</body>
				</html>';

			/* add_filter( 'wp_mail_content_type', 'set_content_type' );
				function set_content_type( $content_type ) {
					return 'text/html';
			}

			// Change the email that root level mail is sent from
			add_filter( 'wp_mail_from', function( $email_from ) {
				return 'authenticalignmentwellness@gmail.com';
			});

			add_filter( 'wp_mail_from_name', function( $name_from ) {
				return 'Amanda from Authentic Alignment Wellness';
			}); */

			// $headers[] = array('Content-Type: text/html; charset=UTF-8');
			// $headers[] = 'From: Amanda from Authentic Alignment Wellness <authenticalignmentwellness@gmail.com>';

			wp_mail($to, $subject, $message);
			// wp_mail($to2, $subject, $message, $headers);
			wp_mail($email, $subject, $message);

			// Extremley Important to set
			global $wpdb;

			// Whats inserted
			$wpdb->insert( 'flaxen_inquiry' ,
				array(
					'type'			=> 'discovery' ,

					'name'			=> $_POST['name'] ,
					'email'			=> $_POST['email'] ,
					'phone'			=> $_POST['phone'] ,

					'obs1'			=> $_POST['obs1'] ,
					'obs2'			=> $_POST['obs2'] ,
					'obs3'			=> $_POST['obs3'] ,

					'significant'	=> $_POST['significant'] ,
					'idol'			=> $_POST['idol'] ,
					'band'			=> $_POST['band'] ,

					'find'			=> $_POST['find'] ,
				)
			);

			// give the unid in the next url
			$id = $wpdb->insert_id;

			// return safe if the inserted number is above zero and inserted to database
			// the email may be sent even if the database doesn't update but better to false negative than false positive
				
			// thanks to the correct person would also be a nice touch
			wp_redirect( home_url() . '/thanks?n=' . $id );

		} else { // if captcha score above 0.5
			// Not verified - show form error
			wp_redirect( home_url() . '/sorry' );
		}
	}
	exit();

} // close out the prefix_admin_contact

add_action( 'admin_post_discovery', 'prefix_admin_discovery' );
add_action( 'admin_post_nopriv_discovery', 'prefix_admin_discovery' );

// simply redirects to the search query _POST
function prefix_admin_viewresults() {
    
    wp_redirect( home_url() . '/view-results/?r=' . $_POST['name']  );  
    exit;

}

add_action( 'admin_post_viewresults', 'prefix_admin_viewresults' );
add_action( 'admin_post_nopriv_viewresults', 'prefix_admin_viewresults' );










