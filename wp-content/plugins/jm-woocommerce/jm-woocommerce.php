<?php
/* 
Plugin name:  JAM WooCommerce
Plugin URI:  http://onewebcentric.com
Description:  Extends WooCommerce Subscriptions to work properly with our monthly payment schema.  
Author:  Jonathon McDonald
Author URI:  http://onwebcentric.com
*/

$jm_order_shipping = 0;

function jm_process_order( $order_id, $posted )
{
	global $jm_order_shipping, $woocommerce;

	if( WC_Subscriptions_Order::order_contains_subscription( $order_id ) && !WC_Subscriptions_Renewal_Order::is_renewal( $order_id ) )
	{
		add_filter( 'woocommerce_order_amount_total', 'jm_fix_price' );
		$jm_order_shipping = $woocommerce->cart->shipping_total;
	}
}

add_action( 'woocommerce_checkout_update_order_meta', 'jm_process_order', 10, 2 );

function jm_fix_price( $string ) {
	global $jm_order_shipping;

	return ( $string + 35.00 );
}