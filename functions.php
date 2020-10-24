<?php
function flaxen_setup() {
	load_theme_textdomain( 'flaxen' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' ); // is this needed?

	add_theme_support( 'post-thumbnails' );

	// add_image_size( 'flaxen-featured-image', 2000, 1200, true ); // how am I using these?
	// add_image_size( 'flaxen-thumbnail-avatar', 100, 100, true ); // am I sure I cant just use the defaults?

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'		=> __( 'Top Menu', 'flaxen' ),
		'social'	=> __( 'Social Links Menu', 'flaxen' ),
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
}
add_action( 'after_setup_theme', 'flaxen_setup' );

/**
 * Enqueue scripts and styles.
 */
function flaxen_scripts() {
	// Sass style.
	wp_enqueue_style( 'flaxen', get_template_directory_uri() . '/css/app.css' );

	// Google Font style.
	wp_enqueue_style( 'font', 'https://fonts.googleapis.com/css?family=Playfair+Display&display=swap' ); // I think this can be done better?

	// Base JS
	wp_enqueue_script( 'flaxen-js', get_template_directory_uri() . '/js/flaxen.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'flaxen_scripts' );

/**
 * Register custom fonts. why have I dont this in a really different way? I have playfair display above?
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

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i'; // I dont need to load all of these

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

// REQUIRED FILES
require get_template_directory() . '/inc/general.php'; // Handle SVG icons. this needs a bunch of work but I need to get better at sorting before I can fix that up
require get_parent_theme_file_path( '/inc/back.php' );
require get_parent_theme_file_path( '/inc/discovery.php' );
require get_parent_theme_file_path( '/inc/contact.php' );
require get_parent_theme_file_path( '/inc/results.php' );
require get_parent_theme_file_path( '/inc/event-date.php' );
require get_parent_theme_file_path( '/inc/program-costs.php' );

// Events
function wporg_custom_post_type()
{
	register_post_type('flaxen_event',
		array(
			'labels'		=> array(
				'name'			=> __('Events'),
				'singular_name'	=> __('Events'),
			),
			'public'			=> true,
			'has_archive'	=> true,
			'rewrite'		=> array( 'slug' => 'events' ),
		)
	);
}
add_action('init', 'wporg_custom_post_type');

// Programs
function wporg_custom_programs()
{
	register_post_type('flaxen_program',
		array(
			'labels'			=> array(
				'name'			=> __('Programs'),
				'singular_name'	=> __('Programs'),
			),
			'public'		=> true,
			'has_archive'	=> true,
			'rewrite'		=> array( 'slug' => 'programs' ),
			'supports'		=> array( 
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				// 'comments' 
				)
		)
	);
}
add_action('init', 'wporg_custom_programs');




// these cant be used from a gmail
// Change the email that root level mail is sent from
/*
add_filter( 'wp_mail_from', function( $email ) {
	return 'authenticalignmentwellness@gmail.com'; // these should be variables - site email
});
*/

// this one might still be possible but needs checking
add_filter( 'wp_mail_from_name', function( $name ) {
	return 'Amanda from Authentic Alignment Wellness'; // these should be variables - site name
});
