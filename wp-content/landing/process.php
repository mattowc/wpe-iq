<?php
/**
 * Process the landing page form submission,
 * and then redirects the user to some thank you page.
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 */

$redirect_page = 'http://iq-express.com/thanks'; // Please enter an exact URL here
$send_to       = 'jon@onewebcentric.com';  // Any valid email will work fine
$send_to_name  = 'Jonathon McDonald';      // Just a personal touch eh?
$mc_api_key    = '076c55011dd492fe23e0d531337452c7-us6';  // Mail Chimp API key
$mc_list_id    = '6dd5a70f12';  // Mail Chimp unique list ID

// Get the MailChimp API's
require_once('assets/classes/MCAPI.class.php');

// Create an API
$api = new MCAPI($mc_api_key);

if( isset( $_POST ) ) 
{
	$name   = filter_var($_POST['their-name'], FILTER_SANITIZE_STRING);
	$email  = filter_var($_POST['their-email'], FILTER_SANITIZE_STRING);
	$phone  = filter_var($_POST['their-phone'], FILTER_SANITIZE_STRING);

	$email_body  = '<h1>IQ Express Landing Page Form Fill</h1>';
	$email_body .= 'Their Name:  ' . $name . ' <br />';
	$email_body .= 'Their Email:  ' . $email . '<br />';
	$email_body .= 'Their Phone:  ' . $phone . '<br />';

	// To send HTML mail, the Content-type header must be set
	$email_headers  = 'MIME-Version: 1.0' . "\r\n";
	$email_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$email_headers .= 'To: ' . $send_to_name . ' <' . $send_to . '>' . "\r\n";
	$email_headers .= 'From: IQ Express <support@iq-express.com>' . "\r\n";

    mail( $send_to, 'IQ Express Landing Page Fill', $email_body, $email_headers );

    // Now that it's emailed out, let's push this to mail chimp
    $mail_chimp_vars = array('NAME' => $name, 'PHONE' => $phone);
    $api->listSubscribe( $mc_list_id, $email, $mail_chimp_vars );


} 

header("Location: " . $redirect_page);