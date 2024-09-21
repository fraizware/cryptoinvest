=== Crypto Dash Tracker ===
Contributors: alexmustin
Author: alexmustin
Author URI: https://alexmustin.com/
Donate link: https://venmo.com/Alex-Mustin
Tags: bitcoin, coingecko, crypto, currency, price, portfolio, wallet
Requires at least: 5.0
Tested up to: 5.6.1
Stable tag: 1.0.0
Version: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display a table showing the current live prices and totals of all your favorite crypto, right on your WordPress dashboard!

== Description ==

Display a table showing the current live prices and totals of all your favorite crypto, right on your WordPress dashboard!

The Crypto Dash Tracker adds a new "Crypto Wallet Calculator" Dashboard Widget. Enter a list with the amount of crypto in the Settings page, and the plugin will automatically calculate the combined value of all coins listed. Quickly review the value of your cryptocurrency portfolio at a glance with this convenient WP Dashboard Widget!

= CoinGecko API =
This plugin uses the [CoinGecko API](https://www.coingecko.com/en/api) to get the latest cryptocurrency prices.
The API endpoint used is: `https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=50`
Once a successful call is made, the API results will be cached on your site for 2 minutes, to avoid unnecessary bandwidth usage.

CoinGecko Privacy Policy: [https://www.coingecko.com/en/privacy](https://www.coingecko.com/en/privacy)

= Plugin Options =
- "Crypto Wallet Calculator" Dashboard Widget: Show or Hide
- "Crypto Wallet Calculator" Dashboard Widget: Enter coins and amounts to be calculated
- more coming soon!

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/crypto-dash-tracker` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Go to Settings > Crypto Dash Tracker.
4. To display the Dashboard Widget, ensure the Setting for "Show 'Crypto Dash Tracker' on WP Dashboard" is set to "Yes".
5. Enter some Coin Index Symbols and amounts in the data format shown in the Example, and save your settings.
6. Visit your Dashboard and you will see the Crypto Dash Tracker Widget. Drag the widget to reorder as desired.

== Frequently Asked Questions ==

= How do I get the Dashboard Tracker widget to show up? =
Open the Screen Options tab at the top-right of the Dashboard screen and ensure the option for `Crypto Dash Tracker` is enabled.

= Why don't I see a list of coins and prices? =
1. Go to Settings > Crypto Dash Tracker
2. Enter some Coin Index Symbols into the Dashboard Widget Coins field, followed by a dash - then the amount to calculate. Enter each coin and value on a new line. Ex: BTC-0.0012345
3. Save the settings.
4. Visit your Dashboard to see the widget working.

= How do I request a feature or report a bug? =
Have you found something wrong with the plugin? Thought of a helpful feature to add? Please see the Issues section on GitHub:
[https://github.com/alexmustin/crypto-dash-tracker/issues/](https://github.com/alexmustin/crypto-dash-tracker/issues/)

== Something Else? ==
If you are having any issues, please post in the Support Forum.

== I love this plugin! How can I donate? Do you accept BTC? ==
Thanks! Your donations help support the continued development and improvement of this plugin.

Donate Bitcoin:
bc1q0cdjn9wyrxvj3akj3h3dpdg3kr54gtx0yd2yyp

== Screenshots ==

1. Plugin Settings
2. "Crypto Dash Tracker" Dashboard Widget

== Changelog ==

= 1.0.0 - (Feb 18, 2021) =
* First release. Hello, World!
