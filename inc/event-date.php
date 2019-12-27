<?php
/* Create one or more meta boxes to be displayed on the post editor screen. */
function event_date_add_post_meta_boxes() {

	add_meta_box(
		'event-date', // Unique ID
		'Event Date', // Title
		'event_date_render_metabox', // Callback function
		'flaxen_event', // post
		'normal', // Context
		'default' // Priority
	);
}
add_action( 'add_meta_boxes', 'event_date_add_post_meta_boxes' );

function event_date_defaults() {
	return array(
		'start_date_m'	=> 'default',
		'start_date_d'	=> 'default',
		'start_date_o'	=> 'default',
		'end_date_m'	=> 'default',
		'end_date_d'	=> 'default',
		'end_date_o'	=> 'default',
	);
}

function event_date_render_metabox() {
	// Variables
	global $post; // Get the current post data
	$saved = get_post_meta( $post->ID, 'event_date', true ); // Get the saved values
	$defaults = event_date_defaults(); // Get the default values
	$event_date = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
	?>

	<fieldset>
		<div class="wrap">
			<!-- echo date("m"); month -->
			<?php $em = date("m"); ?>
			<!-- echo $em; -->
			<!-- echo date("d"); day -->
			<!-- echo date("o"); year -->

			<p>When does this event start.</p>

			<select id="event_date[start_date_m]" name="event_date[start_date_m]">
				<!-- check if there has been a month set and its this month else if month has not been set but its currently this month then its also selected -->
				<option value="01" <?php if ( $event_date['start_date_m'] == '01' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 1) { echo "selected"; } ?>>01-Jan</option> 
				<option value="02" <?php if ( $event_date['start_date_m'] == '02' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 2) { echo "selected"; } ?>>02-Feb</option>
				<option value="03" <?php if ( $event_date['start_date_m'] == '03' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 3) { echo "selected"; } ?>>03-Mar</option>
				<option value="04" <?php if ( $event_date['start_date_m'] == '04' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 4) { echo "selected"; } ?>>04-Apr</option>
				<option value="05" <?php if ( $event_date['start_date_m'] == '05' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 5) { echo "selected"; } ?>>05-May</option>
				<option value="06" <?php if ( $event_date['start_date_m'] == '06' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 6) { echo "selected"; } ?>>06-Jun</option>
				<option value="07" <?php if ( $event_date['start_date_m'] == '07' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 7) { echo "selected"; } ?>>07-Jul</option>
				<option value="08" <?php if ( $event_date['start_date_m'] == '08' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 8) { echo "selected"; } ?>>08-Aug</option>
				<option value="09" <?php if ( $event_date['start_date_m'] == '09' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 9) { echo "selected"; } ?>>09-Sep</option>
				<option value="10" <?php if ( $event_date['start_date_m'] == '10' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 10) { echo "selected"; } ?>>10-Oct</option>
				<option value="11" <?php if ( $event_date['start_date_m'] == '11' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 11) { echo "selected"; } ?>>11-Nov</option>
				<option value="12" <?php if ( $event_date['start_date_m'] == '12' ) { echo "selected"; } elseif ( $event_date['start_date_m'] == 'default ' && $em == 12) { echo "selected"; } ?>>12-Dec</option>
			</select>

			<input id="event_date[start_date_d]" name="event_date[start_date_d]" class="jj" type="text" size="2" maxlength="2" autocomplete="off" value="<?php if ($event_date['start_date_d'] != 'default') { echo $event_date['start_date_d']; } else { echo date("d"); } ?>">
			,
			<input id="event_date[start_date_o]" name="event_date[start_date_o]" class="jj" type="text" size="4" maxlength="4" autocomplete="off" value="<?php echo $event_date['start_date_o'];?>">
		</div>

		<div class="wrap">
			<?php $ed = date("d") + 1; ?>

			<p>When does this event finish.</p>
			<select id="end-month" class="mm">
				<option value="01" <?php if ($em == 1) { echo "selected"; } ?>>01-Jan</option>
				<option value="02" <?php if ($em == 2) { echo "selected"; } ?>>02-Feb</option>
				<option value="03" <?php if ($em == 3) { echo "selected"; } ?>>03-Mar</option>
				<option value="04" <?php if ($em == 4) { echo "selected"; } ?>>04-Apr</option>
				<option value="05" <?php if ($em == 5) { echo "selected"; } ?>>05-May</option>
				<option value="06" <?php if ($em == 6) { echo "selected"; } ?>>06-Jun</option>
				<option value="07" <?php if ($em == 7) { echo "selected"; } ?>>07-Jul</option>
				<option value="08" <?php if ($em == 8) { echo "selected"; } ?>>08-Aug</option>
				<option value="09" <?php if ($em == 9) { echo "selected"; } ?>>09-Sep</option>
				<option value="10" <?php if ($em == 10) { echo "selected"; } ?>>10-Oct</option>
				<option value="11" <?php if ($em == 11) { echo "selected"; } ?>>11-Nov</option>
				<option value="12" <?php if ($em == 12) { echo "selected"; } ?>>12-Dec</option>
			</select>

			<input id="end-day" name="event-day" class="jj" type="text" size="2" maxlength="2" autocomplete="off" value="<?php echo $ed;?>">
			,
			<input id="end-year" name="event-day" class="jj" type="text" size="4" maxlength="4" autocomplete="off" value="<?php echo date("o");?>">
		</div>
	</fieldset>

	<?php
	// This validates that submission came from the actual dashboard and not the front end or a remote server.
	wp_nonce_field( 'event_date_metabox_nonce', 'event_date_metabox_process' );
}

function event_date_save_metabox( $post_id, $post ) {
	// Verify that our security field exists. If not, bail.
	if ( !isset( $_POST['event_date_metabox_process'] ) ) return;
	// Verify data came from edit/dashboard screen
	if ( !wp_verify_nonce( $_POST['event_date_metabox_process'], 'event_date_metabox_nonce' ) ) {
		return $post->ID;
	}

	if ( !isset( $_POST['event_date'] ) ) {
		return $post->ID;
	}

	// Verify user has permission to edit post
	if ( !current_user_can( 'edit_post', $post->ID )) {
		return $post->ID;
	}

	$sanitized = array();
	// Loop through each of our fields
	foreach ( $_POST['event_date'] as $key => $date ) {
		// Sanitize the data and push it to our new array
		// `wp_filter_post_kses` strips our dangerous server values
		// and allows through anything you can include a post.
		$sanitized[$key] = wp_filter_post_kses( $date );
	}
	// Save our submissions to the database
	update_post_meta( $post->ID, 'event_date', $sanitized );
}
add_action( 'save_post', 'event_date_save_metabox', 1, 2 );