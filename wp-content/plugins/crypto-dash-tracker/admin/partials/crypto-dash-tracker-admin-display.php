<?php

/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link        https://alexmustin.com
 * @since       1.0.0
 * @package     Crypto_Dash_Tracker
 * @subpackage  Crypto_Dash_Tracker/admin/partials
 * @author      Alex Mustin <alex@alexmustin.com>
 */
?>

<div class="wrap">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<form action="options.php" method="post">
		<?php
			settings_fields( $this->plugin_name );
			do_settings_sections( $this->plugin_name );
			submit_button();
		?>
	</form>
</div>
