<?php
/*** Theme setup ***/
//load_textdomain( 'templatic', TEMPLATEPATH.'/en_US.mo' );

define('TT_ADMIN_FOLDER_NAME','admin');
define('TT_ADMIN_FOLDER_PATH',TEMPLATEPATH.'/'.TT_ADMIN_FOLDER_NAME.'/'); //admin folder path

if(file_exists(TT_ADMIN_FOLDER_PATH . 'constants.php')){
include_once(TT_ADMIN_FOLDER_PATH.'constants.php');  //ALL CONSTANTS FILE INTEGRATOR
}

if(file_exists(TT_FUNCTIONS_FOLDER_PATH . 'custom_filters.php')){
include_once (TT_FUNCTIONS_FOLDER_PATH . 'custom_filters.php'); // manage theme filters in the file
}

if(file_exists(TT_FUNCTIONS_FOLDER_PATH . 'widgets.php')){
include_once (TT_FUNCTIONS_FOLDER_PATH . 'widgets.php'); // theme widgets in the file
}

// Theme admin functions
include_once (TT_FUNCTIONS_FOLDER_PATH . 'custom_functions.php');

include_once(TT_ADMIN_FOLDER_PATH.'admin_main.php');  //ALL ADMIN FILE INTEGRATOR

if(file_exists(TT_WIDGET_FOLDER_PATH . 'widgets_main.php')){
include_once (TT_WIDGET_FOLDER_PATH . 'widgets_main.php'); // Theme admin WIDGET functions
}

if(file_exists(TT_MODULES_FOLDER_PATH . 'modules_main.php')){
include_once (TT_MODULES_FOLDER_PATH . 'modules_main.php'); // Theme moduels include file
}

include_once(TT_ADMIN_FOLDER_PATH.'auto_update_framework.php');  //FRAMEWORK AUTO UPDATE LINK
if(file_exists(TT_INCLUDES_FOLDER_PATH . 'auto_install/auto_install.php')){
include_once (TT_INCLUDES_FOLDER_PATH . 'auto_install/auto_install.php'); // sample data insert file
}

/**
 * Adds height gracefully to the form, I will be enqueueing a light jQuery that will require a valid number
 *
 * By Jonathon McDonald :: 09/28/2012
 */

// Hook into add the field to billing
add_filter( 'woocommerce_checkout_fields' , 'jon_add_custom_checkout_fields' );
 
/**
 * Adds height field to the checkout, properly.
 */
function jon_add_custom_checkout_fields( $fields ) {
     $fields['billing']['billing_height'] = array(
        'label'     => __('Height', 'woocommerce'),
    'placeholder'   => _x('Height', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => array('form-row-first'),
    'clear'     => true
     );
 
     return $fields;
}

add_action('wp_enqueue_scripts', 'jon_jquery_modal');

/**
 * Depcrecated
 */
function jon_jquery_modal()
{
	wp_enqueue_script(
		'simplemodal',
		get_template_directory_uri() . '/js/jquery.simplemodal-1.4.3.js',
		array('jquery')
	);

	wp_enqueue_script(
		'jonmodal',
		get_template_directory_uri() . '/js/jon-modal.js',
		array('jquery'));
}

/**
 * Changes the email for forgot password and other WordPress
 * inspired emails
 */
function jm_change_mail_from()
{
	return "support@iq-express.com";
}
add_filter('wp_mail_from', 'jm_change_mail_from');


/**
 * Changes the name of the sender in relation to the function
 * jm_change_mail_from
 */
function jm_change_mail_from_name()
{
	return "IQ-Express Support";
}
add_filter('wp_mail_from_name', 'jm_change_mail_from_name');

/**
 * This will only work with WooCommerce, this will 
 * generate a link dynamically that shows the actual
 * receipt.  This allows us to redirect the user to any page
 * and display any info on that page and link to the receipt 
 * after.
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 */
function jm_generate_thank_you_link($atts, $content = "")
{
	// Check if the order and key values exist
	if(!isset($_GET['order']) || !isset($_GET['key']))
		return;

	// Check for content for link
	if($content == "")
		$content = "View Receipt";

	// Extract url, or reset to default
	extract(shortcode_atts(array(
		'url' => 'https://iq-express.com/cart/thanks/'
		), $atts));

	// Prepare the link
	$return_string = '<a href="' . $url . '?order=' . $_GET['order'] . 
	'&key=' . $_GET['key'] . '" class="button alt">' . $content . '</a>';

	// Return the link
	return $return_string;
}
add_shortcode('jm_thanks', 'jm_generate_thank_you_link');

/**
 * Adds return information to the woocommerce email
 */
function jm_add_return_info()
{
	echo '<p>Return Info: </p>';
	echo '<p style="font-size: 10px;">100% of the program fee will be refund if the purchaser feels that the program is not appropriate for their student and all the program materials are received in resalable condition within 30 days of the date ordered.  Upon our receipt of the program materials the full purchase price will be refunded less $300.00 for restocking and preparing the materials for resale.</p>';
	echo 'If you have any questions, you can view our <a href="' . get_bloginfo('url') . '/faqs/"><strong>FAQ</strong></a>.  Or you can call us at <strong>(801) 200-3808</strong>';
}
add_action('woocommerce_email_after_order_table', 'jm_add_return_info');

/**
 * Sends a receipt after a subscription is activated
 */
function jm_send_receipt_sub( $order )
{
	do_action('woocommerce_order_status_completed_notification', $order->id);
}
add_action('subscriptions_activated_for_order', 'jm_send_receipt_sub', 10, 2);

/**
 * Attempts to adjust the subscription string so we do not need
 * to manually edit many files
 */
function jm_get_sub_price( $product_string, $product )
{
	$price    = WC_Subscriptions_Product::get_price( $product );
	$period   = WC_Subscriptions_Product::get_period( $product );
	$interval = WC_Subscriptions_Product::get_interval( $product );
	$length = WC_Subscriptions_Product::get_length( $product );
	$sign_up  = WC_Subscriptions_Product::get_sign_up_fee( $product );

	if(WC_Subscriptions_Product::is_subscription( $product ))
	{
	$product_string = "$" . $price
	 . " / " . $period
	 . " for " . $length
	 . " " . $period
	 . "s, with a $" . $sign_up
	 . " signup fee.";
	}

	return $product_string;
}
add_filter('woocommerce_subscription_price_string', 'jm_get_sub_price', 10, 2);

/**
 * Fixes order total price
 */
function jm_get_sub_total( $formatted_total, $order ) 
{
	if( WC_Subscriptions_Order::order_contains_subscription( $order ) )
	{
		?>
		<?php 
		// Prepare the actual upfront total
		$formatted_total = "<strong>$" . ( WC_Subscriptions_Order::get_total_initial_payment( $order ) ) . "</strong> paid initially.  <br />";

		// Get item
		$item = $order->get_items();
		$product = new WC_Subscriptions_Product(  );
		$price    = WC_Subscriptions_Product::get_price( $item[0]['id'] );
		$period   = WC_Subscriptions_Product::get_period( $item[0]['id'] );
		$interval = WC_Subscriptions_Product::get_interval( $item[0]['id'] );
		$length = WC_Subscriptions_Product::get_length( $item[0]['id'] );

		$formatted_total .= "$" . $price
		 . " / " . $period
		 . " for " . $length
		 . " " . $period
		 . "s.";
	}

	// Get item for easier details
	return $formatted_total;
}
add_filter('woocommerce_get_formatted_order_total', 'jm_get_sub_total', 10, 2);

/**
 * Fixex cart total
 */
function jm_get_cart_total( $formatted_total, $order )
{
	global $woocommerce;

	if( WC_Subscriptions_Cart::cart_contains_subscription() )
	{
		$sign_up = $woocommerce->cart->sign_up_fee_total;
		$item = $woocommerce->cart->cart_contents;
		$price    = WC_Subscriptions_Product::get_price( $item[0]['id'] );
		$period   = WC_Subscriptions_Product::get_period( $item[0]['id'] );
		$interval = WC_Subscriptions_Product::get_interval( $item[0]['id'] );
		$length = WC_Subscriptions_Product::get_length( $item[0]['id'] );

		// Get the date monthly payments begin
		$next_month  = mktime(0, 0, 0, date("m")+1,   date("d"),   date("Y"));
		$next_month_formatted = date('m/d/y', $next_month);

		$formatted_total = "You are paying <strong>$" . $sign_up
		. " now. <br />Starting " . $next_month_formatted
		. " you will pay $" . $price 
		. " " . $period . "ly for " . $length
		. " " . $period
		. "s.";
	}

	return $formatted_total;
}
add_filter('woocommerce_cart_total', 'jm_get_cart_total', 10, 2);

/**
 * Fixes order shipping total
 */
function jm_get_shipping_to_display( $shipping_to_display, $order )
{
	if( WC_Subscriptions_Order::order_contains_subscription( $order ) )
	{
		$shipping_to_display = "$" . $order->order_shipping
		 . " via " . $order->shipping_method_title;
	}

	return $shipping_to_display;
}
add_filter( 'woocommerce_order_shipping_to_display', 'jm_get_shipping_to_display', 10, 2 );
?>