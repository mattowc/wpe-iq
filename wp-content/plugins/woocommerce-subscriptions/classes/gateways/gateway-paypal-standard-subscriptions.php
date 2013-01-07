<?php
/**
 * PayPal Standard Subscription Class. 
 * 
 * Filters necessary functions in the WC_Paypal class to allow for subscriptions.
 * 
 * @package		WooCommerce Subscriptions
 * @subpackage	WC_PayPal_Standard_Subscriptions
 * @category	Class
 * @author		Brent Shepherd
 * @since		1.0
 */

/**
 * Needs to be called after init so that $woocommerce global is setup
 **/
function create_paypal_standard_subscriptions( $methods ) {
	WC_PayPal_Standard_Subscriptions::init();
}
add_filter( 'init', 'create_paypal_standard_subscriptions' );

class WC_PayPal_Standard_Subscriptions {

	protected static $log;

	protected static $debug;

	public static $api_username;
	public static $api_password;
	public static $api_signature;

	public static $api_endpoint;

	private static $invoice_prefix;

	/**
	 * Bootstraps the class and hooks required actions & filters.
	 * 
	 * @since 1.0
	 */
	public static function init() {
		global $woocommerce;

		$paypal_settings = self::get_wc_paypal_settings();

		// Logs
		self::$debug = ( $paypal_settings['debug'] == 'yes' ) ? true : false;
		self::$log   = ( self::$debug ) ? $woocommerce->logger() : '';

		// Set creds
		self::$api_username  = ( isset( $paypal_settings['api_username'] ) ) ? $paypal_settings['api_username'] : '';
		self::$api_password  = ( isset( $paypal_settings['api_password'] ) ) ? $paypal_settings['api_password'] : '';
		self::$api_signature = ( isset( $paypal_settings['api_signature'] ) ) ? $paypal_settings['api_signature'] : '';

		// Invoice prefix added in WC 1.6.3
		self::$invoice_prefix = ( isset( $paypal_settings['invoice_prefix'] ) ) ? $paypal_settings['invoice_prefix'] : '';

		self::$api_endpoint = ( $paypal_settings['testmode'] == 'no' ) ? 'https://api-3t.paypal.com/nvp' :  'https://api-3t.sandbox.paypal.com/nvp';

		// When necessary, set the PayPal args to be for a subscription instead of shopping cart
		add_filter( 'woocommerce_paypal_args', __CLASS__ . '::paypal_standard_subscription_args' );

		// Check a valid PayPal IPN request to see if it's a subscription *before* WC_Paypal::successful_request()
		add_action( 'valid-paypal-standard-ipn-request', __CLASS__ . '::process_paypal_ipn_request', 9 );

		// Set the PayPal Standard gateway to support subscriptions after it is added to the woocommerce_payment_gateways array
		add_filter( 'woocommerce_payment_gateway_supports', __CLASS__ . '::add_paypal_standard_subscription_support', 10, 3 );

		// Add PayPal API fields to PayPal form fields
		add_action( 'init', __CLASS__ . '::add_subscription_form_fields', 100 );

		// When a subscriber or store manager changes a subscription's status in the store, change the status with PayPal
		add_action( 'cancelled_subscription_paypal', __CLASS__ . '::cancel_subscription_with_paypal', 10, 2 );
		add_action( 'subscription_put_on-hold_paypal', __CLASS__ . '::suspend_subscription_with_paypal', 10, 2 );
		add_action( 'reactivated_subscription_paypal', __CLASS__ . '::reactivate_subscription_with_paypal', 10, 2 );

		// Don't copy over PayPal details to new Parent Orders
		add_filter( 'woocommerce_subscriptions_renewal_order_meta_query', __CLASS__ . '::remove_renewal_order_meta', 10, 4 );

		// Maybe show notice to enter PayPal API credentials
		add_action( 'admin_notices', __CLASS__ . '::maybe_show_admin_notice' );
	}

	/**
	 * Checks if the PayPal API credentials are set.
	 * 
	 * @since 1.0
	 */
	public static function are_credentials_set() {

		$credentials_are_set = false;

		if ( ! empty( self::$api_username ) && ! empty( self::$api_password ) && ! empty( self::$api_signature ) )
			$credentials_are_set = true;

		return apply_filters( 'wooocommerce_paypal_credentials_are_set', $credentials_are_set );
	}

	/**
	 * Add subscription support to the PayPal Standard gateway.
	 * 
	 * @since 1.0
	 */
	public static function add_paypal_standard_subscription_support( $is_supported, $feature, $gateway ) {

		if ( $gateway->id == 'paypal' ) {
			if ( $feature == 'subscriptions' )
				$is_supported = true;
			elseif ( in_array( $feature, array( 'subscription_cancellation', 'subscription_suspension', 'subscription_reactivation' ) ) && self::are_credentials_set() )
				$is_supported = true;
		}

		return $is_supported;
	}

	/**
	 * When a PayPal IPN messaged is received for a subscription transaction, 
	 * check the transaction details and 
	 *
	 * @since 1.0
	 */
	public static function process_paypal_ipn_request( $transaction_details ) {

		if ( ! in_array( $transaction_details['txn_type'], array( 'subscr_signup', 'subscr_payment', 'subscr_cancel', 'subscr_eot', 'subscr_failed', 'subscr_modify' ) ) )
			return;

		if ( empty( $transaction_details['custom'] ) || empty( $transaction_details['invoice'] ) )
			return;

		// Get the $order_id & $order_key with backward compatibility
		extract( self::get_order_id_and_key( $transaction_details ) );

		$transaction_details['txn_type'] = strtolower( $transaction_details['txn_type'] );

		if ( self::$debug ) 
			self::$log->add( 'paypal', 'Subscription Transaction Type: ' . $transaction_details['txn_type'] );

		if ( self::$debug ) 
			self::$log->add( 'paypal', 'Subscription transaction details: ' . print_r( $transaction_details, true ) );

		$order = new WC_Order( $order_id );

		// We have an invalid $order_id, probably because invoice_prefix has changed since the subscription was first created, so get the 
		if ( ! isset( $order->id ) ) {
			$order_id = ( function_exists( 'woocommerce_get_order_id_by_order_key' ) ) ? woocommerce_get_order_id_by_order_key( $order_key ) : $wpdb->get_var( "SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = '_order_key' AND meta_value = '{$order_key}'" );
			$order = new WC_Order( $order_id );
		}

		if ( $order->order_key !== $order_key ) {
			if ( self::$debug ) 
				self::$log->add( 'paypal', 'Subscription IPN Error: Order Key does not match invoice.' );
			return;
		}

		switch( $transaction_details['txn_type'] ) {
			case 'subscr_signup':

				// Store PayPal Details
				update_post_meta( $order_id, 'Payer PayPal address', $transaction_details['payer_email']);
				update_post_meta( $order_id, 'Payer PayPal first name', $transaction_details['first_name']);
				update_post_meta( $order_id, 'Payer PayPal last name', $transaction_details['last_name']);
				update_post_meta( $order_id, 'PayPal Subscriber ID', $transaction_details['subscr_id']);

				// Payment completed
				$order->add_order_note( __( 'IPN subscription sign up completed.', WC_Subscriptions::$text_domain ) );

				if ( self::$debug )
					self::$log->add( 'paypal', 'IPN subscription sign up completed for order ' . $order_id );

				// When there is a free trial & no initial payment amount, we need to mark the order as paid and activate the subscription
				if ( 0 == WC_Subscriptions_Order::get_total_initial_payment( $order ) && WC_Subscriptions_Order::get_subscription_trial_length( $order ) > 0 ) {
					$order->payment_complete();
					WC_Subscriptions_Manager::activate_subscriptions_for_order( $order );
				}

				break;

			case 'subscr_payment':

				if ( 'completed' == strtolower( $transaction_details['payment_status'] ) ) {
					// Store PayPal Details
					update_post_meta( $order_id, 'PayPal Transaction ID', $transaction_details['txn_id'] );
					update_post_meta( $order_id, 'Payer PayPal first name', $transaction_details['first_name'] );
					update_post_meta( $order_id, 'Payer PayPal last name', $transaction_details['last_name'] );
					update_post_meta( $order_id, 'PayPal Payment type', $transaction_details['payment_type'] ); 

					// Subscription Payment completed
					$order->add_order_note( __( 'IPN subscription payment completed.', WC_Subscriptions::$text_domain ) );

					if ( self::$debug ) 
						self::$log->add( 'paypal', 'IPN subscription payment completed for order ' . $order_id );

					$subscriptions_in_order = WC_Subscriptions_Order::get_recurring_items( $order );
					$subscription_item      = array_pop( $subscriptions_in_order );
					$subscription_key       = WC_Subscriptions_Manager::get_subscription_key( $order->id, $subscription_item['id'] );
					$subscription           = WC_Subscriptions_Manager::get_subscription( $subscription_key, $order->customer_user );

					// First payment on order, process payment & activate subscription
					if ( empty( $subscription['completed_payments'] ) ) {

						$order->payment_complete();

						WC_Subscriptions_Manager::activate_subscriptions_for_order( $order );

					} else {

						WC_Subscriptions_Manager::process_subscription_payments_on_order( $order );

					}

				} elseif ( 'failed' == strtolower( $transaction_details['payment_status'] ) ) {

					// Subscription Payment completed
					$order->add_order_note( __( 'IPN subscription payment failed.', WC_Subscriptions::$text_domain ) );

					if ( self::$debug ) 
						self::$log->add( 'paypal', 'IPN subscription payment failed for order ' . $order_id );

					WC_Subscriptions_Manager::process_subscription_payment_failure_on_order( $order );

				} else {

					if ( self::$debug ) 
						self::$log->add( 'paypal', 'IPN subscription payment notification received for order ' . $order_id  . ' with status ' . $transaction_details['payment_status'] );

				}

				break;

			case 'subscr_cancel':

				if ( self::$debug ) 
					self::$log->add( 'paypal', 'IPN subscription cancelled for order ' . $order_id );

				// Subscription Payment completed
				$order->add_order_note( __( 'IPN subscription cancelled for order.', WC_Subscriptions::$text_domain ) );

				WC_Subscriptions_Manager::cancel_subscriptions_for_order( $order );

				break;

			case 'subscr_eot': // Subscription ended, either due to failed payments or expiration

				// PayPal fires the 'subscr_eot' notice immediately if a subscription is only for one billing period, so ignore the request when we only have one billing period
				if ( 1 != WC_Subscriptions_Order::get_subscription_length( $order ) ) {

					if ( self::$debug ) 
						self::$log->add( 'paypal', 'IPN subscription end-of-term for order ' . $order_id );

					// Record subscription ended
					$order->add_order_note( __( 'IPN subscription end-of-term for order.', WC_Subscriptions::$text_domain ) );

					// Ended due to failed payments so cancel the subscription
					if ( time() < strtotime( WC_Subscriptions_Manager::get_subscription_expiration_date( WC_Subscriptions_Manager::get_subscription_key( $order->id ), $order->customer_user ) ) )
						WC_Subscriptions_Manager::cancel_subscriptions_for_order( $order );
					else
						WC_Subscriptions_Manager::expire_subscriptions_for_order( $order );
				}
				break;

			case 'subscr_failed': // Subscription sign up failed

				if ( self::$debug ) 
					self::$log->add( 'paypal', 'IPN subscription sign up failure for order ' . $order_id );

				// Subscription Payment completed
				$order->add_order_note( __( 'IPN subscription sign up failure.', WC_Subscriptions::$text_domain ) );

				WC_Subscriptions_Manager::failed_subscription_sign_ups_for_order( $order );

				break;
		}

		// Prevent default IPN handling for subscription txn_types
		exit;
	}

	/**
	 * Override the default PayPal standard args in WooCommerce for subscription purchases.
	 *
	 * @since 1.0
	 */
	public static function paypal_standard_subscription_args( $paypal_args ) {

		extract( self::get_order_id_and_key( $paypal_args ) );

		if ( WC_Subscriptions_Order::order_contains_subscription( $order_id ) ) {

			$order = new WC_Order( $order_id );

			$order_items = $order->get_items();

			// Only one subscription allowed in the cart when PayPal Standard is active
			$product = $order->get_product_from_item( $order_items[0] );

			// It's a subscription
			$paypal_args['cmd'] = '_xclick-subscriptions';

			if ( count( $order->get_items() ) > 1 ) {

				foreach ( $order->get_items() as $item ) {
					if ( $item['qty'] > 1 )
						$item_names[] = $item['qty'] . ' x ' . $item['name'];
					else if ( $item['qty'] > 0 )
						$item_names[] = $item['name'];
				}

				$paypal_args['item_name'] = sprintf( __( 'Order %s', WC_Subscriptions::$text_domain ), $order->get_order_number() );

			} else {

				$paypal_args['item_name'] = $product->get_title();

			}

			$unconverted_periods = array(
				'billing_period' => WC_Subscriptions_Order::get_subscription_period( $order ),
				'trial_period'   => WC_Subscriptions_Order::get_subscription_trial_period( $order )
			);

			$converted_periods = array();

			// Convert period strings into PayPay's format
			foreach ( $unconverted_periods as $key => $period ) {
				switch( strtolower( $period ) ) {
					case 'day':
						$converted_periods[$key] = 'D';
						break;
					case 'week':
						$converted_periods[$key] = 'W';
						break;
					case 'year':
						$converted_periods[$key] = 'Y';
						break;
					case 'month':
					default:
						$converted_periods[$key] = 'M';
						break;
				}
			}

			$sign_up_fee = WC_Subscriptions_Order::get_sign_up_fee( $order );

			$initial_payment = WC_Subscriptions_Order::get_total_initial_payment( $order );

			$price_per_period = WC_Subscriptions_Order::get_recurring_total( $order );

			$subscription_interval = WC_Subscriptions_Order::get_subscription_interval( $order );

			$subscription_installments = WC_Subscriptions_Order::get_subscription_length( $order ) / $subscription_interval;

			$subscription_trial_length = WC_Subscriptions_Order::get_subscription_trial_length( $order );

			if ( $subscription_trial_length > 0 ) { // Specify a free trial period

				$paypal_args['a1'] = ( $sign_up_fee > 0 ) ? $sign_up_fee : 0; // Maybe add the sign up fee to the free trial period

				// Trial period length
				$paypal_args['p1'] = $subscription_trial_length;

				// Trial period
				$paypal_args['t1'] = $converted_periods['trial_period'];

			} elseif ( $sign_up_fee > 0 ) { // No trial period, so charge sign up fee and per period price for the first period

				if ( $subscription_installments == 1 )
					$param_number = 3;
				else
					$param_number = 1;

				$paypal_args['a'.$param_number] = $initial_payment;

				// Sign Up interval
				$paypal_args['p'.$param_number] = $subscription_interval;

				// Sign Up unit of duration
				$paypal_args['t'.$param_number] = $converted_periods['billing_period'];

			}

			// We have a recurring payment
			if ( ! isset( $param_number ) || $param_number == 1 ) {

				// Subscription price
				$paypal_args['a3'] = $price_per_period;

				// Subscription duration
				$paypal_args['p3'] = $subscription_interval;

				// Subscription period
				$paypal_args['t3'] = $converted_periods['billing_period'];

			}

			// Recurring payments
			if ( $subscription_installments == 1 || ( $sign_up_fee > 0 && $subscription_trial_length == 0 && $subscription_installments == 2 ) ) {

				// Non-recurring payments
				$paypal_args['src'] = 0;

			} else {

				$paypal_args['src'] = 1;

				if ( $subscription_installments > 0 ) {
					if ( $sign_up_fee > 0 && $subscription_trial_length == 0 ) // An initial period is being used to charge a sign-up fee
						$subscription_installments--;

					$paypal_args['srt'] = $subscription_installments;

				}
			}

			// Force return URL so that order description & instructions display
			$paypal_args['rm'] = 2;

		}

		return $paypal_args;
	}

	/**
	 * Adds extra PayPal credential fields required to manage subscriptions.
	 * 
	 * @since 1.0
	 */
	public static function add_subscription_form_fields(){
		global $woocommerce;

		foreach ( $woocommerce->payment_gateways->payment_gateways as $key => $gateway ) {

			if ( $woocommerce->payment_gateways->payment_gateways[$key]->id !== 'paypal' ) 
				continue;

			$woocommerce->payment_gateways->payment_gateways[$key]->form_fields += array(

				'api_credentials' => array(
					'title'       => __( 'API Credentials', WC_Subscriptions::$text_domain ), 
					'type'        => 'title', 
					'description' => sprintf( __( 'Enter your PayPal API credentials to unlock subscription suspension and cancellation features. %sLearn More &raquo;%s', WC_Subscriptions::$text_domain ), '<a href="http://wcdocs.woothemes.com/user-guide/extensions/subscriptions/store-manager-guide/#section-6" target="_blank" tabindex="-1">', '</a>' ), 
				),

				'api_username' => array(
					'title'       => __( 'API Username', WC_Subscriptions::$text_domain ), 
					'type'        => 'text', 
					'description' => '',
					'default'     => ''
				),

				'api_password' => array(
					'title'       => __( 'API Password', WC_Subscriptions::$text_domain ), 
					'type'        => 'text', 
					'description' => '',
					'default'     => ''
				),

				'api_signature' => array(
					'title'       => __( 'API Signature', WC_Subscriptions::$text_domain ), 
					'type'        => 'text', 
					'description' => '',
					'default'     => ''
				)
			);
		}

	}

	/**
	 * When a store manager or user cancels a subscription in the store, also cancel the subscription with PayPal. 
	 *
	 * @since 1.1
	 */
	public static function cancel_subscription_with_paypal( $order, $product_id ) {

		$profile_id = self::get_subscriptions_paypal_id( $order, $product_id );

		// Make sure a subscriptions status is active with PayPal
		$response = self::change_subscription_status( $profile_id, 'Cancel' );

		if ( isset( $response['ACK'] ) && $response['ACK'] == 'Success' )
			$order->add_order_note( sprintf( __( 'Subscription "%s" cancelled with PayPal', WC_Subscriptions::$text_domain ), $product_id ) );
	}

	/**
	 * When a store manager or user suspends a subscription in the store, also suspend the subscription with PayPal. 
	 *
	 * @since 1.1
	 */
	public static function suspend_subscription_with_paypal( $order, $product_id ) {

		$profile_id = self::get_subscriptions_paypal_id( $order, $product_id );

		// Make sure a subscriptions status is active with PayPal
		$response = self::change_subscription_status( $profile_id, 'Suspend' );

		if ( isset( $response['ACK'] ) && $response['ACK'] == 'Success' ) {

			$item = WC_Subscriptions_Order::get_item( $order, $product_id );

			$order->add_order_note( sprintf( __( 'Subscription "%s" suspended with PayPal', WC_Subscriptions::$text_domain ), $item['name'] ) );
		}
	}

	/**
	 * When a store manager or user reactivates a subscription in the store, also reactivate the subscription with PayPal. 
	 *
	 * How PayPal Handles suspension is discussed here: https://www.x.com/developers/paypal/forums/nvp/reactivate-recurring-profile
	 *
	 * @since 1.1
	 */
	public static function reactivate_subscription_with_paypal( $order, $product_id ) {

		$profile_id = self::get_subscriptions_paypal_id( $order, $product_id );

		// Make sure a subscriptions status is active with PayPal
		$response = self::change_subscription_status( $profile_id, 'Reactivate' );

		if ( isset( $response['ACK'] ) && $response['ACK'] == 'Success' )
			$order->add_order_note( sprintf( __( 'Subscription "%s" reactivated with PayPal', WC_Subscriptions::$text_domain ), $product_id ) );
	}

	/**
	 * Returns a PayPal Subscription ID/Recurring Payment Profile ID based on a user ID and subscription key
	 *
	 * @since 1.1
	 */
	public static function get_subscriptions_paypal_id( $order, $product_id ) {

		$profile_id = get_post_meta( $order->id, 'PayPal Subscriber ID', true );

		return $profile_id;
	}

	/**
	 * Performs an Express Checkout NVP API operation as passed in $api_method.
	 * 
	 * Although the PayPal Standard API provides no facility for cancelling a subscription, the PayPal
	 * Express Checkout  NVP API can be used.
	 *
	 * @since 1.1
	 */
	public static function change_subscription_status( $profile_id, $new_status ) {

		$api_request = 'USER=' . urlencode( self::$api_username )
					.  '&PWD=' . urlencode( self::$api_password )
					.  '&SIGNATURE=' . urlencode( self::$api_signature )
					.  '&VERSION=76.0'
					.  '&METHOD=ManageRecurringPaymentsProfileStatus'
					.  '&PROFILEID=' . urlencode( $profile_id )
					.  '&ACTION=' . urlencode( $new_status )
					.  '&NOTE=' . urlencode( sprintf( __( 'Profile cancelled at %s', WC_Subscriptions::$text_domain ), get_bloginfo( 'name' ) ) );

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, self::$api_endpoint );
		curl_setopt( $ch, CURLOPT_VERBOSE, 1 );

		// Turn off server and peer verification
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_POST, 1 );

		// Set the API parameters for this transaction
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );

		// Request response from PayPal
		$response = curl_exec( $ch );

		// If no response was received from PayPal there is no point parsing the response
		if( ! $response && self::$debug )
			self::$log->add( 'paypal', 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')' );

		curl_close( $ch );

		// An associative array is more usable than a parameter string
		parse_str( $response, $parsed_response );

		if( ( 0 == sizeof( $parsed_response ) || ! array_key_exists( 'ACK', $parsed_response ) ) && self::$debug )
			self::$log->add( 'paypal', "Invalid HTTP Response for change_subscription_status POST request($api_request) to " . self::$api_endpoint );

		if( $parsed_response['ACK'] == 'Failure' && self::$debug )
			self::$log->add( 'paypal', "Calling PayPal to change_subscription_status has Failed: " . $parsed_response['L_LONGMESSAGE0'] );

		return $parsed_response;
	}

	/**
	 * Checks a set of args and derives an Order ID with backward compatibility for WC < 1.7 where 'custom' was the Order ID.
	 *
	 * @since 1.2
	 */
	private static function get_order_id_and_key( $args ) {

		// WC < 1.7
		if ( is_numeric( $args['custom'] ) ) {
			$order_id  = $args['custom'];
			$order_key = $args['invoice'];
		} else {
			$order_id  = (int) str_replace( self::$invoice_prefix, '', $args['invoice'] );
			$order_key = $args['custom'];
		}
		return array( 'order_id' => $order_id, 'order_key' => $order_key );
	}

	/**
	 * Return the default WC PayPal gateway's settings.
	 *
	 * @since 1.2
	 */
	private static function get_wc_paypal_settings() {
		global $woocommerce;

		foreach ( $woocommerce->payment_gateways->payment_gateways as $key => $gateway ) {

			if ( $woocommerce->payment_gateways->payment_gateways[$key]->id !== 'paypal' ) 
				continue;

			$paypal_settings = $gateway->settings;

			$paypal_settings['invoice_prefix'] = $gateway->invoice_prefix;
			break;
		}

		return $paypal_settings;
	}

	/**
	 * Don't transfer PayPal customer/token meta when creating a parent renewal order.
	 * 
	 * @access public
	 * @param array $order_meta_query MySQL query for pulling the metadata
	 * @param int $original_order_id Post ID of the order being used to purchased the subscription being renewed
	 * @param int $renewal_order_id Post ID of the order created for renewing the subscription
	 * @param string $new_order_role The role the renewal order is taking, one of 'parent' or 'child'
	 * @return void
	 */
	public static function remove_renewal_order_meta( $order_meta_query, $original_order_id, $renewal_order_id, $new_order_role ) {

		if ( 'parent' == $new_order_role )
			$order_meta_query .= " AND `meta_key` NOT IN ("
							  .		"'Transaction ID', "
							  .		"'Payer first name', "
							  .		"'Payer last name', "
							  .		"'Payment type', "
							  .		"'Payer PayPal address', "
							  .		"'Payer PayPal first name', "
							  .		"'Payer PayPal last name', " 
							  .		"'PayPal Subscriber ID' )";

		return $order_meta_query;
	}

	/**
	 * Prompt the store manager to enter their PayPal API credentials if they are using 
	 * PayPal and have yet not entered their API credentials.
	 * 
	 * @access public
	 * @return void
	 */
	public static function maybe_show_admin_notice() {

		$paypal_settings = self::get_wc_paypal_settings();

		if ( ! self::are_credentials_set() && 'yes' == $paypal_settings['enabled'] && ! has_action( 'admin_notices', 'WC_Subscriptions_Admin::admin_installed_notice' ) ) { ?>
<div id="message" class="updated warning">
	<p>
		<?php 
		printf( __( 'Just a few more steps to configure PayPal to sell subscriptions. Please %sset up the PayPal IPN%s and %senter your API credentials%s.', WC_Subscriptions::$text_domain ),
				'<a href="http://wcdocs.woothemes.com/user-guide/extensions/subscriptions/store-manager-guide/#section-8" target="_blank">',
				'</a>',
				'<a href="' . admin_url( 'admin.php?page=woocommerce_settings&tab=payment_gateways&subtab=gateway-paypal' ) . '">',
				'</a>'
		); 
		?>
	</p>
</div>
<?php
		}
	}
}
