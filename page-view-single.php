<?php get_header(); 

    //define variable for url bar .php?n=
    $unid = $_GET['n'];
?>

<!-- Start the main container -->
<div class="container" role="document">

    <?php if (have_posts()) { ?>
        <?php while (have_posts()) : the_post(); 

            /*
             * Pull in a different sub-template, depending on the Post Format.
             * 
             * Make sure that there is a default '<tt>format.php</tt>' file to fall back to
             * as a default. Name templates '<tt>format-link.php</tt>', '<tt>format-aside.php</tt>', etc.
             *
             * You should use this in the loop.
             */

            $format = get_post_format();
            get_template_part( 'format', $format );
            ?>
    
            <div class="medium-gray">
                <div class="grid-container">
                    <div class="grid-x grid-padding-x">
                        <div class="cell breathe-before breathe-after">
                            <div class="breadcrumb"><?php get_breadcrumb(); ?></div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="large-9 cell">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </div>
            </div>
                
            <div class="grid-container">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="grid-x grid-padding-x">
                        
                        <div class="small-12 medium-4 large-3 cell breathe-after">
                            <div class=" card title-card">
                                <h2 class="breathe-before text-center"><?php the_title(); ?></h2>
                                <hr>
                            </div>
                        </div>

                        <!-- post -->
                        <div class="small-12 large-9 cell breathe-before-2-5 breathe-after">
                            <?php the_content(); ?>

                            
                            <!-- multiple options due to not being logged in would see all guest orders -->
                            <?php 
                                $current_user = wp_get_current_user();
                                $current_id = $current_user->ID;    
                                $user_info = get_userdata( $current_id );

                                if (is_user_logged_in ()) {
                                    $user_role = implode(', ', $user_info->roles);
                                }

                                if ($user_role == 'administrator') { 

                                // first extract the current user email as the variable 
                                $current_user = wp_get_current_user();
                                $current_email = $current_user->user_email;    

                            // then search for orders -->
                            $orders = $wpdb->get_results( 
                                    "
                                        SELECT * 
                                        FROM pcrv_inquiry
                                        WHERE unid = '$unid';
                                    "
                                );
                                foreach ( $orders as $order ) 
                                { ?>
                            
                            <ul class="no-bullet second-rows grid-x grid-padding-x">

                    <!-- type -->
                            <li class="cell">TYPE |
                                    <strong>
                                        <?php echo $order->type; ?>
                                    </strong>
                                </li>            

                    <!-- unid -->
                            <li class="cell">ORDER NUMBER |
                                    <strong>
                                        <?php echo $order->unid; ?>
                                    </strong>
                                </li>

                    <!-- name -->

                                <li class="cell">NAME |
                                    <strong>
                                        <?php echo $order->name; ?>
                                    </strong>
                                </li>

                    <!-- add1 -->
                                <li class="cell">ADDRESS |
                                    <strong>
                                        <?php echo $order->add1; ?>
                                    </strong>
                                </li>

                    <!-- add2 -->
                                <li class="cell">SUBURB |
                                    <strong>
                                        <?php echo $order->add2; ?>
                                    </strong>
                                </li>

                    <!-- add3 add4 -->
                                <li class="small-8 cell">CITY | 
                                    <strong>
                                        <?php echo $order->add3; ?>
                                    </strong>
                                </li>

                                <!-- hack to fix the background colour with the two lines in one for postcode -->
                                <li></li>

                                <li class="small-4 cell">POSTCODE |
                                    <strong>
                                        <?php echo $order->add4; ?>
                                    </strong>
                                </li>

                    <!-- email -->
                                <li class="cell">EMAIL |
                                    <strong>
                                        <?php echo $order->email; ?>
                                    </strong>
                                </li>

                    <!-- phone -->
                                <li class="cell">PHONE |
                                    <strong>
                                        <?php echo $order->phone; ?>
                                    </strong>
                                </li>

                                <?php if ($order->type == consultation)  { ?>

                                    <!-- goal -->
                                    <li class="cell">GOAL |
                                        <strong>
                                            <?php echo $order->goal; ?>
                                        </strong>
                                    </li>

                                    <!-- pain -->
                                    <li class="cell">PAIN |
                                        <strong>
                                            <?php echo $order->pain; ?>
                                        </strong>
                                    </li>

                                    <!-- act1 -->
                                    <li class="cell">ACTIVITY 1 |
                                        <strong>
                                            <?php echo $order->act1; ?>
                                        </strong>
                                    </li>

                                    <!-- act2 -->
                                    <li class="cell">ACTIVITY 2 |
                                        <strong>
                                            <?php echo $order->act2; ?>
                                        </strong>
                                    </li>

                                    <!-- act3 -->
                                    <li class="cell">ACTIVITY 3 |
                                        <strong>
                                            <?php echo $order->act3; ?>
                                        </strong>
                                    </li>

                                    <!-- start -->
                                    <li class="cell">HOW THE ISSUE STARTED |
                                        <strong>
                                            <?php echo $order->start; ?>
                                        </strong>
                                    </li>

                                    <!-- manage -->
                                    <li class="cell">HOW ARE YOU MANAGING |
                                        <strong>
                                            <?php echo $order->manage; ?>
                                        </strong>
                                    </li>

                                    <!-- previous -->
                                    <li class="cell">PAST ISSUE |
                                        <strong>
                                            <?php echo $order->previous; ?>
                                        </strong>
                                    </li>

                                    <!-- physician -->
                                    <li class="cell">PHYSICIAN |
                                        <strong>
                                            <?php echo $order->physician; ?>
                                        </strong>
                                    </li>

                                     <!-- health -->
                                    <li class="cell">HEALTH ISSUES |
                                        <strong>
                                            <?php echo $order->health; ?>
                                        </strong>
                                    </li>   

                                <?php } ?>

                    <!-- add_notes -->
                                <li class="cell">ADDITIONAL NOTES |
                                    <strong>
                                        <?php echo $order->add_notes; ?>
                                    </strong>
                                </li>

                    <!-- questions -->
                                <li class="cell">QUESTIONS |
                                    <strong>
                                        <?php echo $order->questions; ?>
                                    </strong>
                                </li>

                    <!-- FileUpload -->
                                <li class="cell">File               
                                    <img src="<?php echo $order->attachment; ?>" alt="uploaded" >
                                </li>

                    <!-- terms -->
                            <li class="cell">Terms and Conditions confirm |
                                    <strong>                                
                                        <?php if ($order->terms == 1) { 
                                            echo 'Yes';
                                        } else { 
                                            echo 'No'; 
                                        } ?>      
                                    </strong>
                                </li>

                     <!-- timenow -->
                                <li class="cell">DATE SUBMITTED |
                                    <strong>
                                        <?php echo $order->timenow; ?>
                                    </strong>
                                </li>
                                
                            </ul>

                            <?php  } ?>

                            <!-- back and forward --> 

                                <hr class="no-print">

                                <?php 
                                    // pagination
                                    
                                    // number of rows
                                    $number = $wpdb->get_var( 
                                        "SELECT COUNT(*) FROM pcrv_inquiry;"
                                    );
                                    
                                    // next & previous
                                    $above = $unid + 1; 
                                    $below = $unid - 1;

                                // Next                                
                                    if ($number > $unid) { ?>
                                        <a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $above; ?>" aria-label="Next" class="button">Next Order</a>
                                    <?php } else { ?>
                                        <a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $above; ?>" aria-label="Next" class="button" disabled>Next Order</a>
                                    <?php }
                            
                                    if ($unid>1)  { ?>
                                        <a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $below; ?>" aria-label="Previous" class="button">Previous Order</a>
                                    <?php } else { ?>
                                        <a href="<?php esc_url( home_url( '/' ) ); ?>view-order/?n=<?php echo $below; ?>" aria-label="Previous" class="button" disabled>Previous Order</a>
                                    <?php } ;?>
                            
                                <div class="no-print">
                                    <div class="cell">
                                        <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>view" class="button">Back to orders</a></p>
                                    </div>
                                </div>

                            <?php } else {
                            echo '<li>Sorry your not an admin.</li>';
                            }
                            ?>
                            
                        </div>
                        
                        <hr>

                    </div> <!-- .grid-x grid-padding-x -->
                </div> <!-- #post -->
            </div> <!-- .grid-container -->
                
        <?php endwhile; // while have posts 
        } else { ?>
    
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <p>Hmmm, seems like what you were looking for isn't here.  You might want to give it another try - the server might have hiccuped - or maybe you even spelled something wrong (though it's more likely <strong>I</strong> did).</p>
                        <p>How about head back to the <a href="/" title="home">home page</a> and start again</p>
                     </div> <!-- #post -->
                </div>
            </div> <!-- .grid-container -->
	
    <?php } ?><!-- if have posts -->
</div>
			
<?php get_footer(); ?>