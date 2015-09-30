<?php
/**
 * Loop Price
 *
 * @author 		ThimPress
 * @package 	Tp-hotel-booking/Templates
 * @version     0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $hb_settings;
$price_display = apply_filters( 'hotel_booking_loop_room_price_display_style', $hb_settings->get('price_display') );

$currency = hb_get_currency_symbol();
$prices = hb_get_price_plan_room(get_the_ID());
?>
<?php if( $prices ): ?>
	<div class="price">
		<span class="title-price"><?php _e( 'Price', 'tp-hotel-booking' ); ?></span>
		<?php if( $price_display === 'max' ): ?>

			<span class="price_max"><?php echo $currency ?><?php echo array_pop($prices) ?></span>

		<?php elseif( $price_display === 'min_to_max' ): ?>

			<span class="price_min_to_max"><?php echo $currency; ?><?php echo array_shift($prices) ?></span> - <span class="price_max"><?php echo array_pop($prices) ?></span>

		<?php elseif( $price_display === 'min' ): ?>

			<span class="price_min"><?php echo $currency; ?><?php echo array_shift($prices) ?></span>

		<?php endif; ?>
		<span class="unit"><?php _e( 'Night', 'tp-hotel-booking' ); ?></span>
	</div>
<?php endif; ?>