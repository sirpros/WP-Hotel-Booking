<?php

/**
 * Abstract WP Hotel Booking meata box class.
 *
 * @class       WPHB_Abstract_Meta_Box
 * @version     2.0
 * @package     WP_Hotel_Booking/Classes
 * @category    Abstract Class
 * @author      Thimpress, leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();


if ( ! class_exists( 'WPHB_Abstract_Meta_Box' ) ) {

	/**
	 * Class WPHB_Abstract_Meta_Box.
	 *
	 * @since 2.0
	 */
	abstract class WPHB_Abstract_Meta_Box {

		/**
		 * @var null
		 */
		protected $id = null;

		/**
		 * @var string|void
		 */
		public $title = '';

		/**
		 * @var string
		 */
		protected $context = 'advanced';

		/**
		 * @var string
		 */
		protected $screen = '';

		/**
		 * @var string
		 */
		public $priority = 'high';

		/**
		 * @var null
		 */
		protected $view = null;

		/**
		 * @var null
		 */
		public $callback_args = null;

		/**
		 * WPHB_Abstract_Meta_Box constructor.
		 *
		 * @since 2.0
		 */
		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'update' ) );
		}

		/**
		 * Add meta box.
		 *
		 * @since 2.0
		 */
		public function add_meta_box() {
			if ( ! $this->id || ! $this->screen || ! $this->view ) {
				return;
			}
			add_meta_box( $this->id, $this->title, array(
				$this,
				'meta_box_view'
			), $this->screen, $this->context, $this->priority, $this->callback_args );
		}

		/**
		 * Get meta box view.
		 *
		 * @since 2.0
		 */
		public function meta_box_view() {
			if ( is_array( $this->view ) ) {
				foreach ( $this->view as $view ) {
					require_once WPHB_PLUGIN_PATH . '/includes/admin/views/metaboxes/' . $view . '.php';
				}
			} else {
				require_once WPHB_PLUGIN_PATH . '/includes/admin/views/metaboxes/' . $this->view . '.php';
			}
		}

		/**
		 * Update meta box.
		 *
		 * @since 2.0
		 *
		 * @param $post_id
		 */
		public function update( $post_id ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
		}

	}

}