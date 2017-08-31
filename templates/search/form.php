<?php

/**
 * The template for displaying search room form.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/search/form.php.
 *
 * @version     2.0
 * @package     WP_Hotel_Booking/Templates
 * @category    Templates
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

$show_label     = ! isset( $atts['show_label'] ) || $atts['show_label'] === 'true';
$check_in_date  = hb_get_request( 'check_in_date' );
$check_out_date = hb_get_request( 'check_out_date' );
$adults         = hb_get_request( 'adults', 0 );
$max_child      = hb_get_request( 'max_child', 0 );
$location       = hb_get_request( 'room_location', 0 );
$uniqid         = uniqid();

?>

<div id="hotel-booking-search-<?php echo esc_attr( $uniqid ); ?>" class="hotel-booking-search">
    <form name="hb-search-form" action="<?php echo esc_attr( $search_page ); ?>"
          class="hb-search-form-<?php echo esc_attr( $uniqid ) ?>">
        <ul class="hb-form-table">

			<?php do_action( 'hotel_booking_before_check_in_field', $uniqid, $show_label ); ?>
            <li class="hb-form-field">
				<?php echo $show_label ? __( 'Arrival Date', 'wp-hotel-booking' ) : ''; ?>
                <div class="hb-form-field-input hb_datepicker_input_field">
                    <input type="text" name="check_in_date" id="check_in_date_<?php echo esc_attr( $uniqid ); ?>"
                           class="hb_input_date_check" value="<?php echo esc_attr( $check_in_date ); ?>"
                           placeholder="<?php _e( 'Arrival Date', 'wp-hotel-booking' ); ?>"/>
                </div>
            </li>
			<?php do_action( 'hotel_booking_after_check_in_field', $uniqid, $show_label ); ?>

			<?php do_action( 'hotel_booking_before_check_out_field', $uniqid, $show_label ); ?>
            <li class="hb-form-field">
				<?php echo $show_label ? __( 'Departure Date', 'wp-hotel-booking' ) : ''; ?>
                <div class="hb-form-field-input hb_datepicker_input_field">
                    <input type="text" name="check_out_date" id="check_out_date_<?php echo esc_attr( $uniqid ) ?>"
                           class="hb_input_date_check" value="<?php echo esc_attr( $check_out_date ); ?>"
                           placeholder="<?php _e( 'Departure Date', 'wp-hotel-booking' ); ?>"/>
                </div>
            </li>
			<?php do_action( 'hotel_booking_after_check_out_field', $uniqid, $show_label ); ?>

            <li class="hb-form-field">
				<?php echo $show_label ? __( 'Adults', 'wp-hotel-booking' ) : ''; ?>
                <div class="hb-form-field-input">
					<?php
					hb_dropdown_numbers(
						array(
							'name'              => 'adults_capacity',
							'min'               => 1,
							'max'               => hb_get_max_capacity_of_rooms(),
							'show_option_none'  => __( 'Adults', 'wp-hotel-booking' ),
							'selected'          => $adults,
							'option_none_value' => 0,
							'options'           => hb_get_capacity_of_rooms()
						)
					);
					?>
                </div>
            </li>

            <li class="hb-form-field">
				<?php echo $show_label ? __( 'Children', 'wp-hotel-booking' ) : ''; ?>
                <div class="hb-form-field-input">
					<?php
					hb_dropdown_numbers(
						array(
							'name'              => 'max_child',
							'min'               => 1,
							'max'               => hb_get_max_child_of_rooms(),
							'show_option_none'  => __( 'Children', 'wp-hotel-booking' ),
							'option_none_value' => 0,
							'selected'          => $max_child,
						)
					);
					?>
                </div>
            </li>

			<?php $settings = hb_settings(); ?>
			<?php if ( $settings->get( 'multiple_location' ) ) { ?>
                <li class="hb-form-field">
					<?php echo $show_label ? __( 'Location', 'wp-hotel-booking' ) : ''; ?>
					<?php hb_dropdown_locations( array(
						'name'             => 'room_location',
						'show_option_none' => __( 'Location', 'wp-hotel-booking' ),
						'selected'         => $location
					) ); ?>
                </li>
			<?php } ?>

        </ul>
		<?php wp_nonce_field( 'hb_search_nonce_action', 'nonce' ); ?>
        <input type="hidden" name="hotel-booking" value="results"/>
        <input type="hidden" name="action" value="wphb_parse_search_params"/>
        <p class="hb-submit">
            <button type="submit"><?php _e( 'Check Availability', 'wp-hotel-booking' ); ?></button>
        </p>
    </form>
</div>