<?php
/**
 * Plugin Name: Easy Digital Downloads Dummy Data Generator
 * Description: Generates dummy data for stores powered by the Easy Digital Downloads plugin
 * Version:     0.1
 * Author:      Shane W. Coll
 * Author URI:  shanecoll.com
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'DDG_PLUGIN_DIR' ) ) {
    define('DDG_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

require_once DDG_PLUGIN_DIR . 'reset.php';
require_once DDG_PLUGIN_DIR . 'misc-functions.php';

//WP_CLI::add_command( 'ddg', 'DDG_CLI' );

/**
 * Work with EDD through WP-CLI
 *
 * DDG_CLI
 * Class
 *
 * Adds CLI support to EDD through WP-CLI
 *
 * @since		2.0
 */
/*class DDG_CLI extends WP_CLI_Command {

    private $api;


    public function __construct() {
        $this->api = new EDD_API;
    }

    /**
     * Get the customers currently on your EDD site. Can also be used to create customers records
     *
     * ## OPTIONS
     *
     * --id=<customer_id>: A specific customer ID to retrieve
     *
     * ## EXAMPLES
     *
     * wp ddg generate --id=103
     */
   /* public function generate( $args, $assoc_args ) {

        $reset = isset( $assoc_args ) && array_key_exists( 'reset', $assoc_args )      ? absint( $assoc_args['reset'] ) : false;
        // call function
        WP_CLI::line( WP_CLI::colorize( '%G' . sprintf( __( '%d customers created in %d seconds', 'edd' ), $create, time() - $start ) . '%N' ) );
    }

}*/

