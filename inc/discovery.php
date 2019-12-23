<?php
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
		$recaptcha_secret = '6LdiC4YUAAAAAFQuaFjA7c6O5baXRE9FVVwbJXE2'; // this needs to be hidden from github
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

			$to			= 'riley@rileybathurst.com'; // developer testing needs to be off by default
			$to2		= 'authenticalignmentwellness@gmail.com';
			$to3		= 'info@authenticalignmentwellness.com';
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

			add_filter( 'wp_mail_content_type', 'set_content_type' );
				function set_content_type( $content_type ) {
					return 'text/html';
			}

			/*
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
			wp_mail($to2, $subject, $message);
			wp_mail($to3, $subject, $message);
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