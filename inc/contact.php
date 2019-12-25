<?php
// Discovery form from _POST
// deals with contact form sent through form _POST
function prefix_admin_contact() {
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
			// The Captcha is valid you can continue with the rest of your code

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
													We will contact you back on, ' .
														$_POST['email'] .
													' or '.
														$_POST['phone'] .
												'</p>
												<p>Your enquiry was ' .
													$_POST['add_notes'] .

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

			wp_mail($to, $subject, $message); // developer testing account should be off by default
			wp_mail($to2, $subject, $message); // authenticalignmentwellness@gmail.com
			wp_mail($to3, $subject, $message); // info@authenticalignmentwellness.com
			wp_mail($email, $subject, $message); // customer email

			// thanks to the correct person would also be a nice touch
			wp_redirect( home_url() . '/thanks?n=' . $id );

		} else { // if captcha score above 0.5
			// Not verified - show form error
			wp_redirect( home_url() . '/sorry' );
		}
	}
	exit();

} // close out the prefix_admin_contact

add_action( 'admin_post_contact', 'prefix_admin_contact' );
add_action( 'admin_post_nopriv_contact', 'prefix_admin_contact' );