<?php
/**
 * Process the landing page form submission,
 * and then redirects the user to some thank you page.
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 */

$redirect_page = 'http://iq-express.com/'; // Please enter an exact URL here
$send_to       = 'jon@onewebcentric.com';  // Any valid email will work fine
$send_to_name  = 'Jonathon McDonald';      // Just a personal touch eh?

if( isset( $_POST['go-submit'] ) ) 
{
	$age    = filter_var($_POST['adult-or-child'], FILTER_SANITIZE_EMAIL);
	$ld     = filter_var($_POST['their-drop'], FILTER_SANITIZE_EMAIL);
	$name   = filter_var($_POST['their-name'], FILTER_SANITIZE_EMAIL);
	$email  = filter_var($_POST['their-email'], FILTER_SANITIZE_EMAIL);
	$phone  = filter_var($_POST['their-phone'], FILTER_SANITIZE_EMAIL);

	$email_body  = '<h1>IQ Express Landing Page Form Fill</h1>';
	$email_body .= 'Age:  ' . $age; ' <br />';
	$email_body .= 'Learning Disability:  ' . $ld . ' <br />';
	$email_body .= 'Their Name:  ' . $name . ' <br />';
	$email_body .= 'Their Email:  ' . $email . '<br />';
	$email_body .= 'Their Phone:  ' . $phone . '<br />';

	$email_headers = 'From: ' . $send_to . '' . "\r\n" .
    'Reply-To: ' . $send_to . '' . "\r\n";

    if( mail( $send_to, 'IQ Express Landing Page Fill', $email_body, $email_headers ) )
    	echo 'Successfuly sent!';
    else
    	echo 'Error!';
} else {
	echo 'No form submitted!';
	print_r( $_POST );
}