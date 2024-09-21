<?php

/**
 * Add the Crypto Wallet Calculator widget to the dashboard.
 */
add_action( 'wp_dashboard_setup', 'cryptodashtracker_add_dashwallet_widget' );
function cryptodashtracker_add_dashwallet_widget() {
	wp_add_dashboard_widget( 'cryptodashtracker_dashboard_widget', 'Crypto Dash Tracker', 'cryptodashtracker_dashboard_widget_function' );
}

/**
 * Output the contents of our Crypto Tracker widget.
 */
function cryptodashtracker_dashboard_widget_function() {

    //* Get setting for Dashboard Widget Coin Info
    $dashWidgetCoinInfo = get_option('Crypto_Dash_Tracker_dashwidgetcoininfo');

    if ( !empty($dashWidgetCoinInfo) ){

        $dashWidgetCoinInfo = explode("\n", str_replace("\r", "", $dashWidgetCoinInfo));

        // Set currency setting.
        $currencySetting = 'USD';

        // Setup arrays.
        $coinsToDisplay = array();
        $coinAmounts = array();
        $allCoinsTotalValue = array();

        $coinWidgetArr = array();
        array_walk( $dashWidgetCoinInfo, function($val,$key) use( &$coinWidgetArr ){
        	list($key, $value) = explode('-', $val);
        	$coinWidgetArr[$key] = $value;
        });

        // Set the currency symbol to use.
        $currencyChar = '$';

        // Get coin info from API.
        if ( !function_exists( "get_coins" ) ) {

            function get_coins() {

                // //* Get setting for Currency
                // $currencySetting = get_option('Crypto_Dash_Tracker_currency');
				//
                // //* Create string for feed URL
                // $feedurl = 'https://api.coinmarketcap.com/v1/ticker/'; // path to JSON API
                // $feedurlParams = '?';
                // $feedLimit = 'limit=0'; // Get all items
				//
                // if ( $currencySetting == 'USD' ) {
				// 	// use default link
                //     $feedurlParams .= $feedLimit;
                // } else if ( $currencySetting == 'Satoshi' ) {
				// 	// use default link
                //     $feedurlParams .= $feedLimit;
                // } else {
				// 	// convert to different currency
                //     $feedurlParams .= 'convert='.$currencySetting.'&' . $feedLimit;
                // }
				//
                // $feedurl = $feedurl . $feedurlParams;
				//
                // $data = file_get_contents($feedurl); // put the contents of the file into a variable
                // $coinlist = json_decode($data); // decode the JSON feed


				// -------------------- COINGECKO API -------------------- //.

				// Set API URL.
				$api_url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=50';

				// Set request var.
			    $request = wp_remote_get( $api_url, array( 'timeout' => 120 ) );

				// If the request returns an error, exit.
			    if ( is_wp_error( $request ) ) {
			        return false; // Bail early
			    }

				// Assign body var.
			    $data = wp_remote_retrieve_body( $request );

				// Assign coins variable.
			    $coins = json_decode( $data );

			    $response = array();
			    $coinlist = array();

			    if ( isset( $coins ) && $coins != "" && is_array( $coins ) ) {

			        foreach( $coins as $coin ) {

			            $response['coin_id']   = $coin->id;
			            $response['symbol']    = strtoupper( $coin->symbol );
			            $response['name']      = $coin->name;
			            $response['rank']      = $coin->market_cap_rank;
			            $response['price']     = $coin->current_price;
						$response['image']     = $coin->image;
			            $response['price_change_pct_24h'] = $coin->price_change_percentage_24h;
						// $response['price_change_24h'] = ccwca_set_default_if_empty($coin->price_change_24h,0);
			            // $response['market_cap'] =     ccwca_set_default_if_empty($coin->market_cap,0);
			            // $response['market_cap_change_24h'] =    ccwca_set_default_if_empty($coin->market_cap_change_24h,0);
			            // $response['market_cap_change_percentage_24h'] =     ccwca_set_default_if_empty($coin->market_cap_change_percentage_24h);
			            // $response['total_volume'] =         ccwca_set_default_if_empty($coin->total_volume);
			            // $response['high_24h'] =             ccwca_set_default_if_empty($coin->high_24h);
			            // $response['low_24h'] =             ccwca_set_default_if_empty($coin->low_24h);
			            // $response['circulating_supply'] =    ccwca_set_default_if_empty($coin->circulating_supply);
			            // $response['total_supply'] =          ccwca_set_default_if_empty($coin->total_supply);
			            // $response['update_at'] = $coin->last_updated;

			            $coinlist[] = $response;

			        }

			    }

				return $coinlist;

            }
        }

        // Get/Set Transient Cache.
        $coinlist_transient = get_transient( 'crypto-dash-tracker' );
        $expireTime = 60*2; // expire after 2 minutes
        if ( empty( $coinlist_transient ) ) {
            $coinlist_transient = get_coins();
            set_transient( 'crypto-dash-tracker', $coinlist_transient, $expireTime );
        }

        // Start widget content.
        echo '<div class="widget-header">';
    	echo "Current Crypto Value:";
        echo '</div>';
        echo '<div class="cryptodashtracker-dashboard-widget-data">';

        echo '<div class="data-header">';
        echo '<div class="title symbol">Coin</div>';
		echo '<div class="title mkt-value">Mkt Value</div>';
		echo '<div class="title pct-change">+/- (24h)</div>';
        echo '<div class="title amt">Amt</div>';
        echo '<div class="title total">Total</div>';
        echo '</div>';

        $coinRowID = 1;
        $i = 0;

        //* Start comparing API data to coin list and outputting content
        foreach ( $coinlist_transient as $coin ) {

			$coinIcon = $coin['image'];
            $coinSymbol = $coin['symbol'];
			$coinPrice = $coin['price'];
			$coinPriceChangePct = $coin['price_change_pct_24h'];
			$coinPriceChangePct = number_format( $coinPriceChangePct, 2, '.', ',' );
			$coinChangePosNeg = 'pos';
			if ( $coinPriceChangePct < 0 ) {
				$coinChangePosNeg = 'neg';
			}

            //* If this coin is in our coin list...
            if ( array_key_exists( $coinSymbol, $coinWidgetArr ) ) {

                // Vars
                $thisCoinAmt = 0;
                foreach( $coinWidgetArr as $key=>$value ) {
                    if ( $key == $coinSymbol ) {
                        $thisCoinAmt = $value;
                    }
                }

                $output = '';
                $priceNum = '';
                $thisCoinTotalVal = '';

                // Start Row DIV
                $output .= '<div class="coin-row">';

                // Row Numeric ID
                // $output .= '<div class="row-id">' . $coinRowID . '</div>';

                // Coin Symbol column.
                $output .= '<div class="coin-symbol">';

				// Icon.
                $output .= '<span class="coin-icon"><img src="' . $coinIcon . '" class="icon" /></span>';

				// Coin symbol.
				$output .= '<span class="coin-abbr">' . $coinSymbol . '</span>';

				$output .= '</div>';

				// Get coin mkt value.
                $output .= '<div class="coin-price">';

				$priceNum = $coinPrice;

				// Add decimals to Coin mkt value if needed.
				if ( $priceNum >= 1.0 ) {
					// Round to 2 decimal places after zero
					$priceNum = bcdiv($priceNum, 1, 2);
					$output .= $currencyChar . number_format($priceNum, 2, '.', ',');
				} else {
					// Round to 5 decimal places after zero
					$priceNum = bcdiv($priceNum, 1, 5);
					$output .= $currencyChar . $priceNum;
				}

				$output .= '</div>';

				// Percent change in 24 hrs.
                $output .= '<div class="coin-pct-change ' . $coinChangePosNeg . '">' . $coinPriceChangePct . '%</div>';

                // Amount of Coins to calculate.
                $output .= '<div class="coin-amt">' . $thisCoinAmt . '</div>';

				// Total Value.
				$output .= '<div class="coin-totalVal">';

                $thisCoinTotalVal = (float) ( $priceNum * $thisCoinAmt );

				// Round to 2 decimal places after zero.
				$thisCoinTotalVal = bcdiv($thisCoinTotalVal, 1, 2);
				$output .= $currencyChar . number_format($thisCoinTotalVal, 2, '.', ',');

                $allCoinsTotalValue[] = $thisCoinTotalVal;

				$output .= '</div>';

                // End Row DIV.
                $output .= '</div>';

				// Output everything.
                echo $output;

                $coinRowID++;
                $i++;

            }

        }

        echo '<div class="grandTotal">';
        echo '<div></div>';
        echo '<div></div>';
		echo '<div></div>';
        echo '<div class="title">Total:</div>';
        echo '<div class="number">';
		// Round to 2 decimal places after zero
		echo $currencyChar . number_format( array_sum($allCoinsTotalValue), 2, '.', ',');
		echo '</div>';
        echo '</div>';

        echo '</div>';

    } else {

        //* Coin list is empty, show Settings message

		$settingsPageURL = get_bloginfo( 'url' ).'/wp-admin/options-general.php?page=crypto-dash-tracker';
        $settingsLinkText = __('Settings Page');
        $current_user = wp_get_current_user();

        if ( user_can( $current_user, 'administrator' ) ) {
            $settingsLinkText = '<a href="'.$settingsPageURL.'">'.__('Settings Page').'</a>';
        }

        echo '<div class="msg-error"><b>' . __('ERROR: No Coin info found.') . '</b><br>' . __('Please enter your coins and amounts into the "Dashboard Widget Settings" section on the ') . $settingsLinkText . '.</div>';

    }

}
