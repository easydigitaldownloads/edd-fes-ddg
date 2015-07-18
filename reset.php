<?php
/**
 * Description: Reset for the EDD FES Dummy Data Generator
 * Version:     0.1
 * Author:      Shane W. Coll
 * Author URI:  shanecoll.com
 */

if ( is_admin() ) :

    class WordPressReset {
        // Action/Filter Hooks
        function __construct() {
            add_action( 'admin_menu', array( &$this, 'add_page' ) );
            add_action( 'plugins_loaded', array( &$this, 'admin_init' ) );
            add_filter( 'favorite_actions', array( &$this, 'favorites' ), 100 );
            add_action( 'wp_before_admin_bar_render', array( &$this, 'admin_bar_link' ) );
            add_filter( 'wp_mail', array( &$this, 'hijack_mail' ), 1 );
        }

        // favorite_actions filter hook operations
        // While this plugin is active put a link to the reset page in the favorites drop down.
        function favorites( $actions ) {
            $reset['tools.php?page=wordpress-reset'] = array( 'WordPress Reset', 'level_10' );
            return array_merge( $reset, $actions );
        }

        // wp_before_admin_bar_render action hook operations
        // While this plugin is active put a link to the reset page in the admin bar under the site title
        function admin_bar_link() {
            global $wp_admin_bar;
            $wp_admin_bar->add_menu(
                array(
                    'parent' => 'site-name',
                    'id'     => 'wordpress-reset',
                    'title'  => 'Reset Site',
                    'href'   => admin_url( 'tools.php?page=wordpress-reset' )
                )
            );
        }

        // admin_init action hook operations
        // Checks for wordpress_reset post value and if there deletes all wp tables
        // and performs an install, populating the users previous password also
        function admin_init() {
           if ( ! empty( $_REQUEST ) && isset( $_REQUEST['wordpress_reset_nonce'] ) ){
               if ( (bool) wp_verify_nonce( $_REQUEST['wordpress_reset_nonce'], 'wordpress_reset_nonce' ) ){
                   $wordpress_reset_confirm = (isset($_REQUEST['wordpress_reset_confirm'])) ? true : false;
                   fes_ddg_create_data( $wordpress_reset_confirm );

                   if (array_key_exists('reset', $_GET) && stristr($_SERVER['HTTP_REFERER'], 'wordpress-reset')) {
                       add_action('admin_notices', array(&$this, 'reset_notice'));
                   }
                   wp_redirect(admin_url() . '?reset');
                   exit();
               }
            }
        }

        // admin_notices action hook operations
        // Inform the user that WordPress has been successfully reset
        function reset_notice() {
            $user = get_user_by( 'id', 1 );
            echo '<div id="message" class="updated fade"><p><strong>WordPress has been reset back to defaults. The user "' . $user->user_login . '" was recreated with its previous password.</strong></p></div>';
            do_action( 'wordpress_reset_post', $user );
        }

        // Overwrite the password, because we actually reset it after this email goes out
        function hijack_mail( $args ) {
            if ( preg_match( '/Your new WordPress (blog|site) has been successfully set up at/i', $args['message'] ) ) {
                $args['message'] = str_replace( 'Your new WordPress site has been successfully set up at:', 'Your WordPress site has been successfully reset, and can be accessed at:', $args['message'] );
                $args['message'] = preg_replace( '/Password:.+/', 'Password: previously specified password', $args['message'] );
            }
            return $args;
        }

        // admin_print_scripts action hook operations
        // Enqueue jQuery to the head
        function admin_js() {
            wp_enqueue_script( 'jquery' );
        }

        // admin_footer action hook operations
        // Do some jQuery stuff to warn the user before submission
        function footer_js() {
            ?>
            <script type="text/javascript">
                /* <![CDATA[ */
                jQuery('#wordpress_reset_submit').click(function(){
                        var message = 'This action is not reversable.\n\nClicking "OK" will reset your database back to it\'s defaults. Click "Cancel" to abort.'
                        var reset = confirm(message);
                        jQuery('#wordpress_reset_form').submit();
                });
                /* ]]> */
            </script>
        <?php
        }

        // admin_menu action hook operations
        // Add the settings page
        function add_page()
        {
            if (current_user_can('level_10') && function_exists('add_management_page')){
                $hook = add_management_page('FES DDG', 'FES DDG', 'manage_options', 'wordpress-reset', array(&$this, 'admin_page'));
            }
            add_action( "admin_print_scripts-{$hook}", array( &$this, 'admin_js' ) );
            add_action( "admin_footer-{$hook}", array( &$this, 'footer_js' ) );
        }

        // add_option_page callback operations
        // The settings page
        function admin_page() {
            global $current_user, $reactivate_wp_reset_additional;
           $missing = array();
            if ( ! empty( $reactivate_wp_reset_additional ) ) {
                foreach ( $reactivate_wp_reset_additional as $key => $plugin ) {
                    if ( is_wp_error( validate_plugin( $plugin ) ) ) {
                        unset( $reactivate_wp_reset_additional[$key] );
                        $missing[] = $plugin;
                    }
                }
            }

            $will_reactivate = ( defined( 'REACTIVATE_WP_RESET') && REACTIVATE_WP_RESET === true ) ? true : false;
            ?>
            <div class="wrap">
                <div id="icon-tools" class="icon32"><br /></div>
                <h2>FES Dummy Data Generator</h2>
                <h3>How does this work?</h3>
                <p><strong>After the generation, you will be taken to the dashboard.</strong></p>
                <?php $admin = get_user_by( 'login', 'admin' ); ?>
                <?php if ( ! isset( $admin->user_login ) || $admin->user_level < 10 ) : $user = $current_user; ?>
                    <p>The 'admin' user does not exist. The user '<strong><?php echo esc_html( $user->user_login ); ?></strong>' will be recreated with its <strong>current password</strong> with user level 10.</p>
                <?php else : ?>
                    <p>The '<strong>admin</strong>' user exists and will be recreated with its <strong>current password</strong>.</p>
                <?php endif; ?>
                <p>This plugin <strong>will<?php echo $will_reactivate ? '' : ' not';?> be automatically reactivated</strong> after the reset. <?php echo ! $will_reactivate ? "To have this plugin auto-reactivate add <span class='code'>define( 'REACTIVATE_WP_RESET', true );</span> to <span class='code'>wp-config.php</span>." : ''; ?></p>
                <?php if ( ! empty( $reactivate_wp_reset_additional ) ) : ?>
		<p>The following <strong>additional plugins will be reactivated</strong>:
			<ul style="list-style-type: disc;">
			<?php foreach ( $reactivate_wp_reset_additional as $plugin ) : $plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin ); ?>
                    <li style="margin: 5px 0 0 30px;"><strong><?php echo esc_html( $plugin_data['Name'] ); ?></strong></li>
                <?php endforeach; unset( $reactivate_wp_reset_additional, $plugin, $plugin_data ); ?>
			</ul>
		</p>
		<?php endif; ?>
                <?php if ( ! empty( $missing ) ) : ?>
		<p>The following <strong>additional plugins are missing</strong> and cannot be reactivated:
			<ul style="list-style-type: disc;">
			<?php foreach ( $missing as $plugin ) : ?>
                    <li style="margin: 5px 0 0 30px;"><strong><?php echo esc_html( $plugin ); ?></strong></li>
                <?php endforeach; unset( $missing, $plugin ); ?>
			</ul>
		</p>
		<?php endif; ?>
                <h3>Reset</h3>
                <p>Check the box below to confirm the reset and then click the reset button:</p>
                <form id="wordpress_reset_form" action="" method="POST">
                    <?php echo wp_nonce_field( 'wordpress_reset_nonce', 'wordpress_reset_nonce', false, false ); ?>
                    <input id="wordpress_reset_confirm" type="checkbox" name="wordpress_reset_confirm" />
                    <p class="submit">
                        <input id="wordpress_reset_submit" style="width: 80px;" type="submit" name="Submit" class="button-primary" value="Reset" />
                    </p>
                </form>
            </div>
        <?php
        }
    }

// Instantiate the class
    $WordPressReset = new WordPressReset();

// End if for is_admin
endif;