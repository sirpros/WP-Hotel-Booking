<?php
/**
 * @Author: ducnvtt
 * @Date:   2016-04-25 13:37:05
 * @Last Modified by:   ducnvtt
 * @Last Modified time: 2016-04-25 14:14:27
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>
<p class="description"><?php _e( 'This will import all of your rooms, bookings, coupons, users, pricing plan, block special date, additonal packages if exists in export file.', 'tp-hotel-booking-importer' ); ?></p>
<?php wp_import_upload_form( 'admin.php?import=tp-hotel-tools&amp;tab=import' ) ?>