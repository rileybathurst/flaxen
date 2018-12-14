<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<!-- canvas wrappers -->
    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

            <!-- this is the off canvas aka small menu -->
            <div class="off-canvas position-top hide-for-print" id="my-info" data-off-canvas data-position="right">

				<h2 class="text-center breathe-before"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo bloginfo( 'name' ); ?></a></h2>
				<hr />
                
                <?php if ( has_nav_menu( 'top' ) ) { ?>
                        <nav>
                            <?php
                                // Primary navigation menu.
                                wp_nav_menu( array(
									
									// needs to run a grid to evenly distribute from the center when above medium size
									
                                    'theme_location'    => 'top',
                                    'items_wrap'        => '<ul class="vertical medium-horizontal menu text-center">%3$s</ul>'
                                ) );
                            ?>
                        </nav><!-- .main-navigation -->
                        <hr />
                    
                <?php } else { ?>
                    <ul class="inline-list right main-navigation"><li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/nav-menus.php">Put the menu in.</a></li></ul>
                <?php } ?>
                
                <?php if ( has_nav_menu( 'social' ) ) { ?>
					<nav>
						<?php
							// Primary navigation menu.
							wp_nav_menu( array(
								// needs to run a grid to evenly distribute from the center when above medium size

								'theme_location'    => 'social',
								'items_wrap'        => '<ul class="vertical medium-horizontal menu text-center">%3$s</li></ul>'
							) );
						?>
					 </nav><!-- .main-navigation -->
                <?php } ?>
            </div>
            
            <!--  this is the in canvas -->
            <div class="off-canvas-content" data-off-canvas-content>
				<div id="page" class="site">

					<!-- use the foundation visibilty class -->
					<!-- <a class="skip-link screen-reader-text" href="#content">php _e( 'Skip to content', 'twentyseventeen' ); ?></a> -->

					<header id="masthead" class="site-header" role="banner">

						<div class="site-branding-text">
							<h1 class="h3"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
						</div>

						<!-- this is a nice place to have an auto build page for a promo and then it's easier to edit than build from scratch but that means a super easy way to turn off is important -->
						<!-- needs to be shown in the pages that this is the promo page -->
						<!-- if (get_option('header-promo')) { ?>
							<h3 class="header-promo cards">
								<a href="<?php echo get_option('header-promo-link'); ?>"><?php echo get_option('header-promo-title'); ?></a>
							</h3>
						<!-- } else { ?>
							<!-- if admin -->
							<!-- <p class="header-promo cards">Did you know you can put a promo page here. Show a cool page on that functionality in the backend <a href="#">Cool page</a></p> -->
						<!-- } -->

						<p class="header-promo cards text-center"><a href="<?php echo esc_url( home_url( '/' ) ); ?>my-programs/">Start With a Free Discovery Session</a></p>
						
						<?php if ( has_nav_menu( 'top' ) ) { ?>
							<div class="navigation-top text-right">
								<button class="button" type="button" data-open="my-info">Menu</button><!-- toggle off canvas -->
							</div><!-- .navigation-top -->
						<?php } else { ?>
							<div class="navigation-top text-right">
								<!-- Add the link to edit -->
								<p>Put the menu in</p>
							</div>
						<?php } ?>
		
<!-- Left Open
	#page
	#masthead
	.off-canvas-wrapper
	off-canvas-wrapper-inner
	off-canvas-content
-->