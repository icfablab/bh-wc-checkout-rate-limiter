<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://BrianHenryIE.com
 * @since             1.0.0
 * @package           BH_WC_Checkout_Rate_Limiter
 *
 * @wordpress-plugin
 * Plugin Name:       Checkout Rate Limiter
 * Plugin URI:        http://github.com/brianhenryie/bh-wc-checkout-rate-limiter/
 * Description:       Rate limit the WooCommerce checkout to prevent card attacks.
 * Version:           1.0.1
 * Author:            BrianHenryIE
 * Author URI:        https://BrianHenry.IE
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bh-wc-checkout-rate-limiter
 * Domain Path:       /languages
 */

namespace BrianHenryIE\Checkout_Rate_Limiter;

use BrianHenryIE\Checkout_Rate_Limiter\API\Settings;
use BrianHenryIE\Checkout_Rate_Limiter\BrianHenryIE\WP_Logger\Logger;
use BrianHenryIE\Checkout_Rate_Limiter\Includes\Activator;
use BrianHenryIE\Checkout_Rate_Limiter\Includes\Deactivator;
use BrianHenryIE\Checkout_Rate_Limiter\Includes\BH_WC_Checkout_Rate_Limiter;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BH_WC_CHECKOUT_RATE_LIMITER_VERSION', '1.0.1' );

register_activation_hook( __FILE__, array( Activator::class, 'activate' ) );
register_deactivation_hook( __FILE__, array( Deactivator::class, 'deactivate' ) );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function instantiate_bh_wc_checkout_rate_limiter(): void {

	$settings = new Settings();
	$logger   = Logger::instance( $settings );

	new BH_WC_Checkout_Rate_Limiter( $settings, $logger );
}

instantiate_bh_wc_checkout_rate_limiter();