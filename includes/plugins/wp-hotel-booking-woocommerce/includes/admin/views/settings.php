<?php
/**
 * Admin View: Woocommerce payment gateway setting page.
 *
 * @version     2.0
 * @package     WP_Hotel_Booking_Woocommerce/Views
 * @category    View
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

$settings = hb_settings();
?>

<h3><?php _e( 'WooCommerce', 'wphb-woocommerce' ); ?></h3>
<p class="description"><?php _e( 'Settings for WooCommerce addon', 'wphb-woocommerce' ); ?></p>
<table class="form-table">
    <tr>
        <th><?php _e( 'Enable', 'wphb-woocommerce' ); ?></th>
        <td>
            <input type="hidden" name="<?php echo esc_attr( $settings->get_field_name( 'wc_enable' ) ); ?>" value="no"/>
            <label>
                <input type="checkbox"
                       name="<?php echo esc_attr( $settings->get_field_name( 'wc_enable' ) ); ?>" <?php checked( $settings->get( 'wc_enable' ) == 'yes' ); ?>
                       value="yes"/>
            </label>
            <p class="description"><?php _e( 'Check this option to enable make booking payments via WooCommerce', 'wphb-woocommerce' ); ?></p>
        </td>
    </tr>
</table>