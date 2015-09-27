<?php
function fes_ddg_create_data(){
	ini_set( 'max_execution_time', 0 );
	@set_time_limit (0 );

	$vendor_id = 1;
	$download_id  = 1;
	while ( $vendor_id < 61 ){
		if ( $vendor_id < 21 ){
			// for the first 20 make them a pending vendor
			$vendor = fes_ddg_create_a_vendor( $vendor_id, 'pending' );
		} else if ( $vendor_id < 41 ){
			// for the next 20 make them a frontend vendor
			$vendor = fes_ddg_create_a_vendor( $vendor_id, 'approved' );
			
			switch ( $vendor_id ){ 
				case 21:
				case 22:
				case 23:
				case 24:
				case 25:
					// don't make them any products
					break;
				case 26:
					// one product with 20% commission
					create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '20' );
					$download_id++;
				case 27:
					// one product with 100% commission
					create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '100' );
					$download_id++;
				case 28:
					// one product with $5 flat rate
					create_simple_download( $download_id, $vendor, 'publish', '15.00', 'flat', '5' );
					$download_id++;
				case 29:
					// one product with $10 flat rate
					create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '10' );
					$download_id++;
				case 30:
					// one product no commission
					create_simple_download( $download_id, $vendor, 'publish', '15.00', false, '20' );
					$download_id++;
					break;
				case 31:
				case 32:
				case 33:
				case 34:
				case 35:
					// 5 products, one of each of case 25-30
						// one product with 20% commission
						create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '20' );
						$download_id++;

						// one product with 100% commission
						create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '100' );
						$download_id++;

						// one product with $5 flat rate
						create_simple_download( $download_id, $vendor, 'publish', '15.00', 'flat', '5' );
						$download_id++;

						// one product with $10 flat rate
						create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '10' );
						$download_id++;

						// one product no commission
						create_simple_download( $download_id, $vendor, 'publish', '15.00', false, '20' );
						$download_id++;
					break;
				case 36:
				case 37:
				case 38:
				case 39:
					// 4 vendors who have
					// 20 products, one of each of case 25-30, 10 simple/10 variable, 5 each published/pending
						// variable pending
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', false, '20' );
							$download_id++;
						// variable published
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', false, '20' );
							$download_id++;
						// simple pending
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'pending', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'pending', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'pending', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'pending', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'pending', '15.00', false, '20' );
							$download_id++;
						// simple published
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'publish', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'publish', '15.00', false, '20' );
							$download_id++;
					break;
				case 40:
					// 30 products, one of each of case 25-30, 10 simple/10 variable/10 trash, 5 each published/pending
						// variable pending
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'pending', '15.00', '5.00', false, '20' );
							$download_id++;
						// variable published
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'publish', '15.00', '5.00', false, '20' );
							$download_id++;
						// simple pending
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'pending', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'pending', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'pending', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'pending', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'pending', '15.00', false, '20' );
							$download_id++;
						// simple published
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'publish', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'publish', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'publish', '15.00', false, '20' );
							$download_id++;
						// variable trash
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', false, '20' );
							$download_id++;
						// simple trash
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', false, '20' );
							$download_id++;
					break;
			}
		} else if ( $vendor_id < 61 ){
			// for the next 20 make them a suspended vendor
			$vendor = fes_ddg_create_a_vendor( $vendor_id, 'suspended' );
			
			switch ( $vendor_id ){ 
				case 41:
				case 42:
				case 43:
				case 44:
				case 45:
					// don't make them any products
					break;
				case 46:
					// one product with 20% commission
					create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '20' );
					$download_id++;
				case 47:
					// one product with 100% commission
					create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '100' );
					$download_id++;
				case 48:
					// one product with $5 flat rate
					create_simple_download( $download_id, $vendor, 'trash', '15.00', 'flat', '5' );
					$download_id++;
				case 49:
					// one product with $10 flat rate
					create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '10' );
					$download_id++;
				case 50:
					// one product no commission
					create_simple_download( $download_id, $vendor, 'trash', '15.00', false, '20' );
					$download_id++;
					break;
				case 51:
				case 52:
				case 53:
				case 54:
				case 55:
					// 5 products, one of each of case 25-30
						// one product with 20% commission
						create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '20' );
						$download_id++;

						// one product with 100% commission
						create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '100' );
						$download_id++;

						// one product with $5 flat rate
						create_simple_download( $download_id, $vendor, 'trash', '15.00', 'flat', '5' );
						$download_id++;

						// one product with $10 flat rate
						create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '10' );
						$download_id++;

						// one product no commission
						create_simple_download( $download_id, $vendor, 'trash', '15.00', false, '20' );
						$download_id++;
					break;
				case 56:
				case 57:
				case 58:
				case 59:
					// 4 vendors who have
					// 20 products, one of each of case 25-30, 10 simple/10 variable, all trash
						// variable trash
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', false, '20' );
							$download_id++;
						// variable trash
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', false, '20' );
							$download_id++;
						// simple trash
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', false, '20' );
							$download_id++;
						// simple trash
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', false, '20' );
							$download_id++;
					break;
				case 60:
					// 30 products, one of each of case 25-30, 10 simple/10 variable, all trash
						// variable trash
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', false, '20' );
							$download_id++;
						// variable trash
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', false, '20' );
							$download_id++;
						// simple trash
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', false, '20' );
							$download_id++;
						// simple trash
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', false, '20' );
							$download_id++;
						// variable trash
							// one product with 20% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_variable_download( $download_id, $vendor, 'trash', '15.00', '5.00', false, '20' );
							$download_id++;
						// simple trash
							// one product with 20% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '20' );
							$download_id++;

							// one product with 100% commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '100' );
							$download_id++;

							// one product with $5 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'flat', '5' );
							$download_id++;

							// one product with $10 flat rate
							create_simple_download( $download_id, $vendor, 'trash', '15.00', 'percentage', '10' );
							$download_id++;
							
							// one product no commission
							create_simple_download( $download_id, $vendor, 'trash', '15.00', false, '20' );
							$download_id++;
					break;
			}
		}
		$vendor_id++;
	}

	// create a normal user
	$user_id = fes_ddg_create_a_user( $vendor_id );
	$vendor_id++;
	// with a normal download
	create_simple_download( $download_id, $user_id, 'publish', '15.00', 'percentage', '20' );
	$download_id++;

   // create orders
   fes_ddg_create_payments();
}


function create_simple_download( $int, $author, $status, $price, $commissions_type = 'percentage', $commission_amount = '80' ) {

	$post_id = @wp_insert_post( array(
		'post_title'    => 'Download Product #' .  $int,
		'post_name'     => 'download-product-' . $int,
		'post_type'     => 'download',
		'post_status'   => $status,
		'post_author'   => $author,
	) );

	$_download_files = array(
		array(
			'name'      => 'Simple File 1',
			'file'      => 'http://localhost/simple-file1.jpg',
			'condition' => 0
		),
	);

	$meta = array(
		'edd_price'                         => $price,
		'_variable_pricing'                 => 0,
		'edd_variable_prices'               => false,
		'edd_download_files'                => array_values( $_download_files ),
		'_edd_download_limit'               => 20,
		'_edd_hide_purchase_link'           => 1,
		'edd_product_notes'                 => 'Purchase Notes',
		'_edd_product_type'                 => 'default',
		'_edd_download_earnings'            => 0,
		'_edd_download_sales'               => 0,
		'_edd_download_limit_override_1'    => 1,
		'edd_sku'                           => 'sku_' . $int
	);
	foreach( $meta as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}

	if ( $commissions_type !== false ){
		update_post_meta( $post_id, '_edd_commisions_enabled', true );
		$meta            = array();
		$meta['user_id'] = $int;
		$meta['amount']  = $commission_amount;
		$meta['type']    = $commissions_type;
		update_post_meta( $post_id, '_edd_commisions_settings', $meta );
	}
}

function create_variable_download( $int, $author, $status, $price1, $price2, $commissions_type, $commission_amount ) {

	$post_id = @wp_insert_post( array(
		'post_title'    => 'Download Product #' .  $int,
		'post_name'     => 'download-product-' . $int,
		'post_type'     => 'download',
		'post_status'   => $status,
		'post_author'   => $author,
	) );

	$_variable_pricing = array(
		array(
			'name'   => 'Simple',
			'amount' => $price1
		),
		array(
			'name'   => 'Advanced',
			'amount' => $price2
		)
	);

	$_download_files = array(
		array(
			'name'      => 'File 1',
			'file'      => 'http://localhost/file1.jpg',
			'condition' => 0,
		),
		array(
			'name'      => 'File 2',
			'file'      => 'http://localhost/file2.jpg',
			'condition' => 'all',
		),
	);

	$meta = array(
		'edd_price'                         => '0.00',
		'_variable_pricing'                 => 1,
		'_edd_price_options_mode'           => 'on',
		'edd_variable_prices'               => array_values( $_variable_pricing ),
		'edd_download_files'                => array_values( $_download_files ),
		'_edd_download_limit'               => 20,
		'_edd_hide_purchase_link'           => 1,
		'edd_product_notes'                 => 'Purchase Notes',
		'_edd_product_type'                 => 'default',
		'_edd_download_earnings'            => 0,
		'_edd_download_sales'               => 0,
		'_edd_download_limit_override_1'    => 1,
		'edd_sku'                          => 'sku_' . $int,
	);
	foreach ( $meta as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}

	if ( $commissions_type !== false ){
		update_post_meta( $post_id, '_edd_commisions_enabled', true );
		$meta            = array();
		$meta['user_id'] = $int;
		$meta['amount']  = $commission_amount;
		$meta['type']    = $commissions_type;
		update_post_meta( $post_id, '_edd_commisions_settings', $meta );
	}
}

function fes_ddg_create_a_vendor( $int, $status ){
	$email = $int . "+example@example.com";
	$username = $int;
	$display_name = "Vendor " . $int;
	$first    = "Vendor";
	$last     = $int;
	$password = $int;

	$args  = array(
		'user_email'   => $email,
		'user_login'   => $username,
		'display_name' => $display_name,
		'first_name'   => $first,
		'last_name'    => $last,
		'user_pass'    => $password,
	);
	$user_id = wp_insert_user( $args ); // create the user


	$db_user = new FES_DB_Vendors();

	$user   = new WP_User( $user_id );
	$db_user->add( array(
		'user_id'        => $user->ID,
		'email'          => $user->user_email,
		'username'       => $user->user_login,
		'name'           => $user->display_name,
		'product_count'  => 0,
		'sales_count'	 => 0,
		'sales_value'	 => 0,
		'status'		 => $status,
		'notes'          => '',
		'date_created'   => $user->user_registered
	) );



	if ( $status === 'pending' ){
		$user->add_role( 'pending_vendor' );
	}

	if ( $status === 'approved' ){
		$user->add_role( 'frontend_vendor' );
	}
	return $user_id;
}

function fes_ddg_create_a_user( $int ){
	$email = $int . "+example@example.com";
	$username = $int;
	$display_name = "User " . $int;
	$first    = "User";
	$last     = $int;
	$password = $int;

	$args  = array(
		'user_email'   => $email,
		'user_login'   => $username,
		'display_name' => $display_name,
		'first_name'   => $first,
		'last_name'    => $last,
		'user_pass'    => $password,
	);
	$user_id = wp_insert_user( $args ); // create the user
	$user = new WP_User( $user_id );
	$user->add_role( 'author' );
	return $user_id;
}

function fes_ddg_create_payments() {
	$error = false;
	// Setup some defaults
	$number     = 100;
	$status     = 'complete';
	$id         = false;
	$price_id   = false;
	$tax        = 0;

	// Build the user info array
	$user_info = array(
		'id'            => 0,
		'email'         => 'guest@local.dev',
		'first_name'    => 'Pippin',
		'last_name'     => 'Williamson',
		'discount'      => 'none'
	);
	for( $i = 0; $i < $number; $i++ ) {
		$products = array();
		$total    = 0;
		$products = get_posts( array(
			'post_type'     => 'download',
			'orderby'       => 'rand',
			'order'         => 'ASC',
			'posts_per_page'=> 1
		) );
		$cart_details = array();
		// Create the purchases
		foreach( $products as $key => $download ) {
			if( ! is_a( $download, 'WP_Post' ) ) {
				continue;
			}
			$options = array();
			$final_downloads = array();
			// Deal with variable pricing
			if( edd_has_variable_prices( $download->ID ) ) {
				$prices = edd_get_variable_prices( $download->ID );
				if( false === $price_id || ! array_key_exists( $price_id, (array) $prices ) ) {
					$price_id = rand( 0, count( $prices ) - 1 );
				}
				$item_price = $prices[ $price_id ]['amount'];
				$options['price_id'] = $price_id;
			} else {
				$item_price = edd_get_download_price( $download->ID );
			}
			$item_number = array(
				'id'       => $download->ID,
				'quantity' => 1,
				'options'  => $options
			);
			$cart_details[$key] = array(
				'name'        => $download->post_title,
				'id'          => $download->ID,
				'item_number' => $item_number,
				'item_price'  => edd_sanitize_amount( $item_price ),
				'subtotal'    => edd_sanitize_amount( $item_price ),
				'price'	      => edd_sanitize_amount( $item_price ),
				'quantity'    => 1,
				'discount'    => 0,
				'tax'         => $tax
			);
			$final_downloads[$key] = $item_number;
			$total += $item_price;
		}
		$purchase_data = array(
			'price'	        => edd_sanitize_amount( $total ),
			'tax'           => 0,
			'purchase_key'  => strtolower( md5( uniqid() ) ),
			'user_email'    => 'guest@local.dev',
			'user_info'     => $user_info,
			'currency'      => edd_get_currency(),
			'downloads'     => $final_downloads,
			'cart_details'  => $cart_details,
			'status'        => 'pending'
		);
		$payment_id = edd_insert_payment( $purchase_data );
		remove_action( 'edd_complete_purchase', 'edd_trigger_purchase_receipt', 999 );
		if( $status != 'pending' ) {
			edd_update_payment_status( $payment_id, $status );
		}
	}
}