<?php
/* 
Plugin name:  JAM WooCommerce
Plugin URI:  http://onewebcentric.com
Description:  Extends WooCommerce Subscriptions to work properly with our monthly payment schema.  
Author:  Jonathon McDonald
Author URI:  http://onwebcentric.com
*/

/**
 * Please note that this solution is a very targeted solution,
 * and specifically fixes problems that arise for IQ to offer
 * a subscription style payment with an upfront price + shipping,
 * and recurring payments without subscription.  This would probably
 * break on other pricing. 
 */
add_action('plugins_loaded', 'jm_fix_sub_meta');
add_action('init', 'jm_update_sub_filter');

/**
 * This will add a filter to the order total including shipping
 * if the user has a product with subscription status in their
 * cart
 */
function jm_update_sub_filter()
{
	if( WC_Subscriptions_Cart::cart_contains_subscription() )
	{
		add_filter('woocommerce_order_amount_total', 'jm_update_sub_order_total', 11, 1);
	}

	add_filter('woocommerce_order_amount_total', 'jm_update_sub_order_total_two', 12, 1);
}



/**
 * This simply hooks in and changes the total to include the shipping
 * price if this is subscription
 */
function jm_update_sub_order_total( $price )
{
	global $woocommerce;

	return 200 + $price;
} 

function jm_update_sub_order_total_two( $price )
{
	global $woocommerce;

	return 200 + $price;
} 

function jm_fix_sub_meta()
{
	add_action('woocommerce_checkout_update_order_meta', 'jm_fix_sub_recurring', 11, 2);
}

function jm_fix_sub_recurring( $order_id, $posted )
{
	global $woocommerce; 
	if( WC_Subscriptions_Order::order_contains_subscription( $order_id ) )
	{
		update_post_meta( $order_id, '_order_recurring_total', WC_Subscriptions_Cart::get_recurring_total() - $woocommerce->cart->shipping_total );
	}
}









