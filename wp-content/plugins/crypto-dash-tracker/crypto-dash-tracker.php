<?php
/**
 * @link              https://alexmustin.com
 * @package           Crypto_Dash_Tracker
 *
 * @wordpress-plugin
 * Plugin Name:     Crypto Dash Tracker
 * Description:     Display a table showing the current live prices and totals of all your favorite crypto, right on your WordPress dashboard! Reads from the CoinGecko API, and caches the results for 2 minutes to avoid unnecessary bandwidth usage.
 * Version:         1.0.0
 * Author:          Alex Mustin
 * Author URI: 	    https://alexmustin.com
 * Text Domain:	    Crypto_Dash_Tracker_domain
 * License:	        GPL-2.0+
 * License URI:	    http://www.gnu.org/licenses/gpl-2.0.txt
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define plugin directory
if ( ! defined( 'CRYPTODASHTRACKER_PLUGIN_DIR' ) ) {
	define( 'CRYPTODASHTRACKER_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
}

// Used for referring to the plugin file or basename
if ( ! defined( 'CRYPTODASHTRACKER_PLUGIN_FILE' ) ) {
	define( 'CRYPTODASHTRACKER_PLUGIN_FILE', plugin_basename( __FILE__ ) );
}

/**
 * The core plugin class that defines admin hooks and public hooks
 */
require_once plugin_dir_path( __FILE__ ) . 'inc/class-crypto-dash-tracker.php';

new Crypto_Dash_Tracker();
