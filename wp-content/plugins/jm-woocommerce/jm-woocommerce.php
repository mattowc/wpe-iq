<?php
/* 
Plugin name:  JAM WooCommerce
Plugin URI:  http://onewebcentric.com
Description:  Extends WooCommerce Subscriptions to work properly with our monthly payment schema.  
Author:  Jonathon McDonald
Author URI:  http://onwebcentric.com
*/

add_filter( 'woocommerce_calculated_total', 'jm_mine_func', 99, 1 );

function jm_mine_func( $total )
{
	global $woocommerce;

	if ( 'sign_up_fee' == WC_Subscriptions_Cart::get_recalculation_type() )
	{
			// We've requested totals be recalculated with sign up fee only, we need to remove anything shipping related from the sign-up fee totals
			$total = $total + $woocommerce->cart->shipping_tax_total + $woocommerce->cart->shipping_total;

			return $total;
	}
}