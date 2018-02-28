<?php
/**
 * The Template for displaying single room page.
 *
 * Override this template by copying it to yourtheme/wp-hotel-booking/single-room.php
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
?>

<?php get_header(); ?>

<?php
/**
 * hotel_booking_before_main_content hook
 */
do_action( 'hotel_booking_before_main_content' );
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php hb_get_template_part( 'content', 'single-room' ); ?>

<?php endwhile; // end of the loop. ?>

<?php
/**
 * hotel_booking_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'hotel_booking_after_main_content' );
?>

<?php
/**
 * hotel_booking_sidebar hook
 */
 do_action( 'hotel_booking_sidebar' );
?>

<?php get_footer(); ?>