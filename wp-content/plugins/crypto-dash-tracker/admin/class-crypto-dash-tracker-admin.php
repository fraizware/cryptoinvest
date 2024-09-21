<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link        https://alexmustin.com
 * @since       1.0.0
 * @package     Crypto_Dash_Tracker
 * @subpackage  Crypto_Dash_Tracker/admin
 * @author      Alex Mustin <alex@alexmustin.com>
 */

class Crypto_Dash_Tracker_Admin {

    /**
	 * The options name to be used in this plugin.
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'Crypto_Dash_Tracker';

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    /**
	 * The default Custom CSS of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $defaultCustomCSS;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    /**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/crypto-dash-tracker-admin.css', array(), $this->version, 'all' );

	}

    /**
	 * Adds a link to the plugin settings page.
	 *
	 * @since 		1.0.0
	 * @param 		array 		$links 		The current array of links
	 * @return 		array 					The modified array of links
	 */
	public function add_settings_link( $links ) {

		$links[] = sprintf( '<a href="%s">%s</a>', esc_url( admin_url( 'options-general.php?page=crypto-dash-tracker' ) ), esc_html__( 'Settings', 'crypto-dash-tracker' ) );
		return $links;

	}

    /**
	 * Add an options page for CDW under the Settings submenu.
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_screen_hook_suffix = add_options_page(
				__( 'Crypto Dash Tracker Settings', 'crypto-dash-tracker' ),
				__( 'Crypto Dash Tracker', 'crypto-dash-tracker' ),
				'manage_options',
				$this->plugin_name,
				array( $this, 'display_CRYPTODASHTRACKER_options_page' )
			);

	}

	/**
	 * Render the options page for plugin.
	 *
	 * @since  1.0.0
	 */
	public function display_CRYPTODASHTRACKER_options_page() {
		include_once 'partials/crypto-dash-tracker-admin-display.php';
	}

	/**
	 * Render the text for the Dashboard Tracker section.
	 *
	 * @since  1.0.4
	 */
	public function Crypto_Dash_Tracker_dashwidget_settings_section_cb() {
		echo '<p>' . __( 'Customize the appearance of the Dashboard Tracker widget.', 'crypto-dash-tracker' ) . '</p>';
	}


	/* ==================== FORM FIELDS ==================== */

	// Dashboard Tracker Settings.

	/**
	 * Render the select input field for 'showdashwidget' option.
	 *
	 * @param      array 		$args 			The arguments for the field
	 * @return     string 						The HTML field
	 * @since      1.0.4
	 */
	public function Crypto_Dash_Tracker_showdashwidget_cb( array $args ) {
		$showdashwidget = get_option( $this->option_name . '_showdashwidget' );
		?>
		<select name="<?php echo esc_attr( $args['id'] ); ?>" id="<?php echo esc_attr( $args['id'] ); ?>">
			<option value="Yes" <?php echo $showdashwidget == 'Yes' ? 'selected="selected"' : ''; ?> >Yes</option>
			<option value="No" <?php echo $showdashwidget == 'No' ? 'selected="selected"' : ''; ?> >No</option>
		</select>
		<p><span class="description"><?php esc_html_e( $args['description'], 'crypto-dash-tracker' ); ?></span></p>
		<?php
	}

	/**
	 * Render the textbox for 'dashwidgetcoininfo' option.
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 * @since  1.0.4
	 */
	public function Crypto_Dash_Tracker_dashwidgetcoininfo_cb( array $args ) {
		$dashwidgetcoininfo = get_option( $this->option_name . '_dashwidgetcoininfo' );
        if ( empty($dashwidgetcoininfo) ){
            $dashwidgetcoininfo = 'BTC-0.00054321';
        }
		?>
		<div class="customstyles">
		<label for="<?php echo esc_attr( $args['id'] ); ?>">
			<textarea
			class="<?php echo esc_attr( $args['id'] ); ?>"
			id="<?php echo esc_attr( $args['id'] ); ?>"
			name="<?php echo esc_attr( $args['id'] ); ?>"><?php echo $dashwidgetcoininfo; ?></textarea><br>
			<span class="description"><?php esc_html_e( $args['description'], 'crypto-dash-tracker' ); ?></span>
			<p><span class="description">To calculate coin prices, enter each line in the following format:<br>
				<span class="code">(coin symbol)-(amount of coins)<br>
					Example: BTC-0.00054321</span></span></p>
		</label>
		</div>
		<?php
	}


	/* ==================== SANITIZE FIELDS ==================== */

	/**
	 * Sanitize the text 'showdashwidget' value before being saved to database.
	 *
	 * @param  string $showdashwidget $_POST value
	 * @since  1.0.4
	 * @return string           Sanitized value
	 */
	public function Crypto_Dash_Tracker_sanitize_showdashwidget_field( $showdashwidget ) {
		if ( in_array( $showdashwidget, array( 'Yes', 'No' ), true ) ) {
			return $showdashwidget;
		}
	}

	/**
	 * Sanitize the text 'dashwidgetcoininfo' value before being saved to database.
	 *
	 * @param  string $dashwidgetcoininfo $_POST value
	 * @since  1.0.4
	 * @return string           Sanitized value
	 */
	public function Crypto_Dash_Tracker_sanitize_dashwidgetcoininfo_field( $dashwidgetcoininfo ) {
        $dashwidgetcoininfo = esc_textarea( $dashwidgetcoininfo );
    	return $dashwidgetcoininfo;
	}


	/* ==================== REGISTER FIELDS ==================== */

	/**
	* Register settings area, fields, and individual settings.
	*
	* @since 1.0.0
	*/
	public function register_settings_page() {

		// Add the 'Dashboard Widget Settings' section.
		add_settings_section(
			$this->option_name . '_dashwidget',
			__( 'Dashboard Widget Settings', 'crypto-dash-tracker' ),
			array( $this, $this->option_name . '_dashwidget_settings_section_cb' ),
			$this->plugin_name
		);

		// Add fields to the 'Dashboard Widget Settings' section.
		add_settings_field(
			$this->option_name . '_showdashwidget',
			__( 'Show "Crypto Dash Tracker" on WP Dashboard', 'crypto-dash-tracker' ),
			array( $this, $this->option_name . '_showdashwidget_cb' ),
			$this->plugin_name,
			$this->option_name . '_dashwidget',
			array(
				'description' 	=> 'Display the Crypto Dash Tracker on the WP Dashboard.',
				'id' 			=> $this->option_name . '_showdashwidget',
				'value' 		=> 'Yes',
			)
		);

		$dashWidgetStr = 'To calculate coin prices, enter each line in the following format: (coin symbol)-(amount of coins). One coin per line. ';
		$dashWidgetStr .= "\r\n";
		$dashWidgetStr .= 'Example: BTC-0.00054321';

		add_settings_field(
			$this->option_name . '_dashwidgetcoininfo',
			__( 'Coins to Track', 'crypto-dash-tracker' ),
			array( $this, $this->option_name . '_dashwidgetcoininfo_cb' ),
			$this->plugin_name,
			$this->option_name . '_dashwidget',
			array(
				'description' 	=> '',
				'id' 			=> $this->option_name . '_dashwidgetcoininfo',
				'value' 		=> 'BTC-0.00054321'
			)
		);


		// Register and Sanitize the fields.

		// Dashboard Widget Settings.
		register_setting( $this->plugin_name, $this->option_name . '_showdashwidget', array( $this, $this->option_name . '_sanitize_showdashwidget_field' ) );
		register_setting( $this->plugin_name, $this->option_name . '_dashwidgetcoininfo', array( $this, $this->option_name . '_sanitize_dashwidgetcoininfo_field' ) );
	}

}
