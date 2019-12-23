<?php
// redirects a search query from the results screen to the search query _POST
function prefix_admin_viewresults() {
	
	wp_redirect( home_url() . '/view-results/?r=' . $_POST['name']  );  
	exit;
}

add_action( 'admin_post_viewresults', 'prefix_admin_viewresults' );
add_action( 'admin_post_nopriv_viewresults', 'prefix_admin_viewresults' );