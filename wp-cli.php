<?php
WP_CLI::add_command( 'fes-ddg', 'FES_DDG_CLI' );
class FES_DDG_CLI extends WP_CLI_Command {
	public function generate( ) {
		WP_CLI::line( "Starting Dummy Data Generation" );
		fes_ddg_create_data( true );
		WP_CLI::success( "Finished Generating Dummy Data" );
	}
}