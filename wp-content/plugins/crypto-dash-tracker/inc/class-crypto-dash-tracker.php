<?php
/**
 * The core plugin class that defines admin hooks and public hooks
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @link        https://alexmustin.com
 * @since       1.0.0
 * @package     Crypto_Dash_Tracker
 * @subpackage  Crypto_Dash_Tracker/inc
 * @author      Alex Mustin <alex@alexmustin.com>
 */
class Crypto_Dash_Tracker {

    /**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'crypto-dash-tracker';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->define_admin_hooks();

	}

    /**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

    /**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

    /**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Crypto_Dash_Tracker_Admin. Defines all hooks for the admin area.
	 * - Crypto_Dash_Tracker_Public. Defines all hooks for the public side of the site.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

        /**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-crypto-dash-tracker-admin.php';

		$showdashwidget = get_option('Crypto_Dash_Tracker_showdashwidget');
		if ( $showdashwidget !== 'No' ) {
			/**
			 * The class responsible for defining all actions that occur in the admin Dashboard Tracker widget area.
			 */
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-crypto-dash-tracker-dashboard-tracker.php';
		}

    }

    /**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Crypto_Dash_Tracker_Admin( $this->get_plugin_name(), $this->get_version() );
        add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );
        add_filter( 'plugin_action_links_' . CRYPTODASHTRACKER_PLUGIN_FILE, array( $plugin_admin, 'add_settings_link' ) );
		add_action( 'admin_menu', array( $plugin_admin, 'add_options_page' ) );
        add_action( 'admin_init', array( $plugin_admin, 'register_settings_page' ) );

	}

}
