<?php
/**
 * Plugin Name: Easy Digital Downloads - Frontend Submissions Dummy Data Generator
 * Plugin URI:  https://easydigitaldownloads.com/extension/frontend-submissions/
 * Description: Generates dummy data for testing FES with
 * Version:     0.5
 * Author:      Chris Christoff
 * Author URI:  chriscct7.com
 */

//  Forked from the WordPress Reset Plugin

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class EDD_FES_DDG {
	function __construct() {
		if ( defined( 'WP_CLI' ) && WP_CLI ) { 
    		require_once dirname( __FILE__ ) . '/wp-cli.php';
    	} else {
			add_action( 'admin_menu', array( &$this, 'add_page' ) );
			add_action( 'plugins_loaded', array( &$this, 'admin_init' ) );
			add_action('admin_notices', array( &$this, 'success_notice') );
		}

		if ( ! defined( 'DDG_PLUGIN_DIR' ) ) {
			define('DDG_PLUGIN_DIR', plugin_dir_path(__FILE__));
		}
		require_once DDG_PLUGIN_DIR . 'misc-functions.php';
	}

	function admin_init() {
	   if ( ! empty( $_REQUEST ) && isset( $_REQUEST['fes_dummy_data_form_nonce'] ) ){
		   if ( (bool) wp_verify_nonce( $_REQUEST['fes_dummy_data_form_nonce'], 'fes_dummy_data_form_nonce' ) ){
			   fes_ddg_create_data( false );
			   wp_redirect(admin_url() . '?createddata=true');
			   exit();
		   }
		}
	}

	function success_notice() {
		if ( !empty( $_GET['createdata'] ) ){
			echo '<div id="message" class="updated fade"><p><strong>Dummy data was generated</p></div>';
		}
	}

	function admin_js() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'fes_spin', fes_plugin_url . 'assets/js/spin.min.js', array( 'jquery'), fes_plugin_version );
		wp_enqueue_script( 'fes_spinner', fes_plugin_url . 'assets/js/spinner.js', array( 'jquery'), fes_plugin_version );
		wp_enqueue_style(  'fes-sw-css', fes_plugin_url . 'assets/css/spin.css' );
	}

	function footer_js() {
		?>
		<script type="text/javascript">
			/* <![CDATA[ */
			jQuery('#fes_create_dummy_data').click(function(){
					var message = 'This action is not reversable.\n\nClicking "OK" will continue. Click "Cancel" to abort.'
					var createdata = confirm(message);
					jQuery('#fes_dummy_data_form').submit();
					var opts = {
						lines: 13, // The number of lines to draw
						length: 11, // The length of each line
						width: 5, // The line thickness
						radius: 17, // The radius of the inner circle
						corners: 1, // Corner roundness (0..1)
						rotate: 0, // The rotation offset
						color: '#FFF', // #rgb or #rrggbb
						speed: 1, // Rounds per second
						trail: 60, // Afterglow percentage
						shadow: false, // Whether to render a shadow
						hwaccel: false, // Whether to use hardware acceleration
						className: 'fes_spinner', // The CSS class to assign to the spinner
						zIndex: 2e9, // The z-index (defaults to 2000000000)
						top: 'auto', // Top position relative to parent in px
						left: 'auto' // Left position relative to parent in px
					};
					
					var target = document.createElement("div");
					document.body.appendChild(target);
					var spinner = new Spinner(opts).spin(target);
					var overlay = fesSpinner({
						text: 'Running',
						spinner: spinner
					});	
				});
			/* ]]> */
		</script>
	<?php
	}

	function add_page() {
		if (current_user_can( 'manage_options' ) && function_exists('add_management_page')){
			$hook = add_management_page('FES DDG', 'FES DDG', 'manage_options', 'fes-create-dummy-data', array(&$this, 'admin_page'));
		}
		add_action( "admin_print_scripts-{$hook}", array( &$this, 'admin_js' ) );
		add_action( "admin_footer-{$hook}", array( &$this, 'footer_js' ) );
	}

	function admin_page() { ?>
		<div class="wrap">
			<div id="icon-tools" class="icon32"><br /></div>
			<h2>FES Dummy Data Generator</h2>
			<p>After the generation, you will be taken to the dashboard.</p>
			<form id="fes_dummy_data_form" action="" method="POST">
				<?php echo wp_nonce_field( 'fes_dummy_data_form_nonce', 'fes_dummy_data_form_nonce', false, false ); ?>
				<p class="submit">
					<input id="fes_create_dummy_data" style="width: 80px;" type="submit" name="Submit" class="button-primary" value="Run" />
				</p>
			</form>
		</div>
	<?php
	}
}

// Instantiate the class
$EDD_FES_DDG = new EDD_FES_DDG();