<?php
/**
 * Admin new order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if (!defined('ABSPATH')) exit; ?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<p><?php echo __('You have received an order from', 'woocommerce') . ' ' . $order->billing_first_name . ' ' . $order->billing_last_name . __(". Their order is as follows:", 'woocommerce'); ?></p>

<?php do_action('woocommerce_email_before_order_table', $order, true); ?>

<h2><?php echo __('Order:', 'woocommerce') . ' ' . $order->get_order_number(); ?> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( __('jS F Y', 'woocommerce'), strtotime( $order->order_date ) ) ); ?>)</h2>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<thead>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Product', 'woocommerce'); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Quantity', 'woocommerce'); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e('Price', 'woocommerce'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( false, true ); ?>
	</tbody>
	<tfoot>
		<?php if(WC_Subscriptions_Order::order_contains_subscription( $order ) ): ?>
		<tr>
			<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee; border-top-width: 4px;">Shipping</th>
			<td style="text-align:left; border: 1px solid #eee; border-top-width: 4px;">$<?php echo $order->order_shipping; ?> :: <?php echo $order->shipping_method_title; ?></td>
		</tr>
		<tr>
			<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee;">Total</th>
			<td style="text-align:left; border: 1px solid #eee;">
				<?php 
				// Prepare the actual upfront total
				$total = "Paid <strong>$" . (349 + $order->order_shipping) . "</strong> now.  <br />"; 

				// Get the date monthly payments begin
				$next_month  = mktime(0, 0, 0, date("m")+1,   date("d"),   date("Y"));
				$next_month_formatted = date('m/d/y', $next_month);
				?>
				
				<?php echo $total; ?>
				Starting 
				<?php echo $next_month_formatted; ?> 
				$230 monthly for 6 months.
			</td>
		</tr>
		<?php elseif( WC_Subscriptions_Renewal_Order::is_renewal( $order ) ): ?>
			<tr>
				<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee; border-top-width: 4px;">Shipping</th>
				<td style="text-align:left; border: 1px solid #eee; border-top-width: 4px;">Already shipped.</td>
			</tr>
			<tr>
				<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee;">Total</th>
				<td style="text-align:left; border: 1px solid #eee;">
					$230.00 paid
				</td>
			</tr>
		<?php else: ?>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
						<td style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
					</tr><?php
				}
			}
		?>
		<?php endif; ?>
	</tfoot>
</table>

<?php do_action('woocommerce_email_after_order_table', $order, true); ?>

<h2><?php _e('Customer details', 'woocommerce'); ?></h2>

<?php if ($order->billing_email) : ?>
	<p><strong><?php _e('Email:', 'woocommerce'); ?></strong> <?php echo $order->billing_email; ?></p>
<?php endif; ?>
<?php if ($order->billing_phone) : ?>
	<p><strong><?php _e('Tel:', 'woocommerce'); ?></strong> <?php echo $order->billing_phone; ?></p>
<?php endif; ?>
<?php $height = get_post_meta( $order->id, '_billing_height', true ); ?>
<?php if($height) : ?>
	<p><strong><?php _e('Height:', 'woocommerce'); ?></strong> <?php echo $height; ?></p>
<?php endif; ?>

<?php woocommerce_get_template('emails/email-addresses.php', array( 'order' => $order )); ?>

<?php do_action('woocommerce_email_footer'); ?>