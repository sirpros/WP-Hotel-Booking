<?php

class HB_Extra_Field
{

	protected $_extras_type = null;

	function __construct()
	{
		add_filter( 'tp-hb-extra-l10n', array( $this, 'language_js' ) );
		add_filter( 'tp_hb_metabox_room_settings', array( $this, 'meta_fields' ) );
		add_action( 'tp_hotel_booking_loop_after_item', array( $this, 'render_extra' ), 10, 1 );

		/**
		 * add package details booking
		 */
		add_action( 'hotel_booking_room_details_quantity', array( $this, 'admin_booking_room_details' ), 10, 3 );
	}

	/**
	 * script language
	 * @param  [type] $l10n [description]
	 * @return [type]       [description]
	 */
	public function language_js( $l10n )
	{
		$l10n[ 'remove_confirm' ] = __( 'Remove package. Are you sure?', 'tp-hb-extra' );
		return $l10n;
	}

	/**
	 * meta field box render
	 * @param  [type] $fields [description]
	 * @return [type]         [description]
	 */
	function meta_fields( $fields )
	{
		$fields[] = array(
				'name'		=> 'room_extra',
				'label'		=> __( 'Addition Package', 'tp-hb-extra' ),
				'type'		=> 'select',
				'options'	=> $this->extra_fields(),
				'multiple'	=> true,
				'filter'		=> array( $this, 'meta_value' )
			);

		return $fields;
	}

	protected function extra_fields()
	{
		global $hb_extra_settings;
		$options = array();
		$extras = $hb_extra_settings->get_extra();
		foreach ( $extras as $key => $ex ) {
			$opt = new stdClass();
			$opt->text = $ex->post_title;
			$opt->value = $ex->ID;
			$options[] = $opt;
		}
		return $options;
	}

	/**
	 * return value meta box content
	 * @param  @string || @array
	 * @return  @string || @array
	 */
	function meta_value( $val )
	{
		return $val;
	}

	function admin_booking_room_details( $booking_params, $search_key, $room_id )
	{
		if( ! isset( $booking_params[ $search_key ] ) ||
			! isset( $booking_params[ $search_key ][ $room_id ] ) ||
			! isset($booking_params[ $search_key ][ $room_id ]['extra_packages_details'])
		)
		{
			return;
		}

		$packages = $booking_params[ $search_key ][ $room_id ]['extra_packages_details'];
		?>
			<ul>
				<?php foreach ( $packages as $id => $package ): ?>
					<li>
						<span><?php printf( '%s (x%s)', $package['package_title'], $package['package_quantity'] ) ?></span>
					</li>
				<?php endforeach ?>
			</ul>
		<?php
	}

	/**
	 * render html extra field search room
	 * @param  $post_id
	 * @return template
	 */
	function render_extra( $post_id )
	{
		tp_hb_extra_get_template( 'loop/extra-search-room.php', array( 'post_id' => $post_id ) );
	}

}

new HB_Extra_Field();