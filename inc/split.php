<?php
/*
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

/* I wonder if these are the issue locked down by godaddy or something?
// Change the email that root level mail is sent from
add_filter( 'wp_mail_from', function( $email ) {
	return 'authenticalignmentwellness@gmail.com'; // these should be variables - site email
});

add_filter( 'wp_mail_from_name', function( $name ) {
	return 'Amanda from Authentic Alignment Wellness'; // these should be variables - site name
});
*/