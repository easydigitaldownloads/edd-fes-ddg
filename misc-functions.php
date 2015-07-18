<?php
function fes_ddg_reset( ) {
    global $current_user;
    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

    $blogname = get_option( 'blogname' );
    $admin_email = get_option( 'admin_email' );
    $blog_public = get_option( 'blog_public' );

    if ( $current_user->user_login != 'admin' )
        $user = get_user_by( 'login', 'admin' );

    if ( empty( $user->user_level ) || $user->user_level < 10 )
        $user = $current_user;

    global $wpdb, $reactivate_wp_reset_additional;

    $prefix = str_replace( '_', '\_', $wpdb->prefix );
    $tables = $wpdb->get_col( "SHOW TABLES LIKE '{$prefix}%'" );
    foreach ( $tables as $table ) {
        $wpdb->query( "DROP TABLE $table" );
    }

    $result = wp_install( $blogname, $user->user_login, $user->user_email, $blog_public );
    extract( $result, EXTR_SKIP );

    $query = $wpdb->prepare( "UPDATE $wpdb->users SET user_pass = %s, user_activation_key = '' WHERE ID = %d", $user->user_pass, $user_id );
    $wpdb->query( $query );

    $get_user_meta = function_exists( 'get_user_meta' ) ? 'get_user_meta' : 'get_usermeta';
    $update_user_meta = function_exists( 'update_user_meta' ) ? 'update_user_meta' : 'update_usermeta';

    if ( $get_user_meta( $user_id, 'default_password_nag' ) )
        $update_user_meta( $user_id, 'default_password_nag', false );

    if ( $get_user_meta( $user_id, $wpdb->prefix . 'default_password_nag' ) )
        $update_user_meta( $user_id, $wpdb->prefix . 'default_password_nag', false );

    // todo: add hardcoded activate of DDG then EDD then FES
    if ( ! empty( $reactivate_wp_reset_additional ) ) {
        foreach ( $reactivate_wp_reset_additional as $plugin ) {
            $plugin = plugin_basename( $plugin );
            if ( ! is_wp_error( validate_plugin( $plugin ) ) )
                @activate_plugin( $plugin );
        }
    }

    wp_clear_auth_cookie();
    wp_set_auth_cookie( $user_id );
}


function fes_ddg_create_data( $reset = false ){
    if ( $reset ){
        fes_ddg_reset();
    }

        /*
        // create 5 normal users
        // create 5 normal downloads, give 0 to user 1, 2 to user 2, 1 to users 3, 4 and 5, make the ones users 2 and 3 have variable

        // create $num  number of vendors
        for int i = 0; i< 60; i++ {
            if (i < 20 ) {
                //create a pending vendor

            }
            else (if i  < 40){
                // create a frontend vendor
                if i < 25
                // don't make them any productrs
                else if i < 30
                    // make them 1 download
                if i < 26
                on 1 of them make their only download non-commission
                      if i < 27
                      on 1 of them make their only download 20% commission
                      if i < 28
                      on 1 of them make their only download 100% commission
                      if i < 29
                      on 1 of them make their only download $5 flat rate
                      if i < 30
                      on 1 of them make their only download $10 flat rate
                else if i < 35
                    // make them 5 downlaods
                on 1 of them make their only download non-commission

                         on 1 of them make their only download 20% commission

                                     on 1 of them make their only download 100% commission

                                     on 1 of them make their only download $5 flat rate

                                     on 1 of them make their only download $10 flat rate
                else if i < 39
                    // make them 20 downloads
                on 4 of them make their only download non-commission
                            // where 2 of them is published, 1 is pending review, 1 is trash
                           // make half variable, half nonvariable

                         on 4 of them make their only download 20% commission
                            // where 2 of them is published, 1 is pending review, 1 is trash
                           // make half variable, half nonvariable

                                     on 4 of them make their only download 100% commission
                            // where 2 of them is published, 1 is pending review, 1 is trash
                           // make half variable, half nonvariable

                                     on 4 of them make their only download $5 flat rate
                            // where 2 of them is published, 1 is pending review, 1 is trash
                           // make half variable, half nonvariable

                                     on 4 of them make their only download $10 flat rate
                            // where 2 of them is published, 1 is pending review, 1 is trash
                           // make half variable, half nonvariable
                else if i < 40
                    // make them 100 downloads
                on 20 of them make their only download non-commission
                            // where 12 of them is published, 4 is pending review, 4 is trash
                           // make half variable, half nonvariable

                         on 20 of them make their only download 20% commission
                            // where 12 of them is published, 4 is pending review, 4 is trash
                           // make half variable, half nonvariable

                                     on 20 of them make their only download 100% commission
                            // where 12 of them is published, 4 is pending review, 4 is trash
                           // make half variable, half nonvariable

                                     on 20 of them make their only download $5 flat rate
                            // where 12 of them is published, 4 is pending review, 4 is trash
                           // make half variable, half nonvariable

                                     on 20 of them make their only download $10 flat rate
                            // where 12 of them is published, 4 is pending review, 4 is trash
                            // make half variable, half nonvariable

            } else {
                // create a suspended vendor
                if i < 45
                // don't make them any productrs
                else if i < 50
                    // make them 1 download
                if i < 46
                on 1 of them make their only download non-commission
                          if i < 47
                          on 1 of them make their only download 20% commission
                          if i < 48
                          on 1 of them make their only download 100% commission
                          if i < 49
                          on 1 of them make their only download $5 flat rate
                          if i < 50
                          on 1 of them make their only download $10 flat rate
                    else if i < 55
                    // make them 5 downlaods
                on 1 of them make their only download non-commission

                             on 1 of them make their only download 20% commission

                                         on 1 of them make their only download 100% commission

                                         on 1 of them make their only download $5 flat rate

                                         on 1 of them make their only download $10 flat rate
                    else if i < 59
                    // make them 20 downloads
                on 4 of them make their only download non-commission
                                // where 2 of them is published, 1 is pending review, 1 is trash
                               // make half variable, half nonvariable

                             on 4 of them make their only download 20% commission
                                // where 2 of them is published, 1 is pending review, 1 is trash
                                // make half variable, half nonvariable

                                         on 4 of them make their only download 100% commission
                                // where 2 of them is published, 1 is pending review, 1 is trash
                                                // make half variable, half nonvariable

                                         on 4 of them make their only download $5 flat rate
                                // where 2 of them is published, 1 is pending review, 1 is trash
                                               // make half variable, half nonvariable

                                         on 4 of them make their only download $10 flat rate
                                // where 2 of them is published, 1 is pending review, 1 is trash
                               // make half variable, half nonvariable
                    else if i < 60
                    // make them 100 downloads
                on 20 of them make their only download non-commission
                                // where 12 of them is published, 4 is pending review, 4 is trash
                               // make half variable, half nonvariable

                             on 20 of them make their only download 20% commission
                                // where 12 of them is published, 4 is pending review, 4 is trash
                               // make half variable, half nonvariable

                                         on 20 of them make their only download 100% commission
                                // where 12 of them is published, 4 is pending review, 4 is trash
                               // make half variable, half nonvariable

                                         on 20 of them make their only download $5 flat rate
                                // where 12 of them is published, 4 is pending review, 4 is trash
                               // make half variable, half nonvariable

                                         on 20 of them make their only download $10 flat rate
                                // where 12 of them is published, 4 is pending review, 4 is trash
                               // make half variable, half nonvariable
                }
       }

       // create orders

       use the payments function in EDD to create 1,000 random sales
       by calling https://github.com/easydigitaldownloads/Easy-Digital-Downloads/blob/master/includes/class-edd-cli.php#L476 to do what we need (pass in 1000)

    // notes: where variable products, make rand (1 to 7 inclusive options) priced rand( 0 to 5 inclusive)
    // on flat rate, do a random number that is between 0 and 5 (inclusive)
    */

}


function fes_ddg_create_a_vendor( $int, $status ){
    $email = $int . "@gmail.com";
    $username = $int;
    $display_name = "Vendor " . $int;
    $first    = "Vendor";
    $last     = $int;
    $password = $int;
    $status = //passed in

    $args  = array(
        'user_email'   => $email,
        'user_login'   => $username,
        'display_name' => $display_name,
        'first_name'   => $first,
        'last_name'    => $last,
        'user_pass'    => $password,
    );
    $user_id = wp_insert_user( $args ); // create the user

    $vendor = new FES_Vendor( $user_id, true ); // make vendor

    $vendor_data = array(
        'user_id'        => $user_id,
        'username'       => $username,
        'name'           => $name,
        'email'          => $email,
        'status'          => $status,
     );
    $vendor->create( $vendor_data );
}

function fes_ddg_create_a_user( $int ){
    $email = $int . "@gmail.com";
    $username = $int;
    $display_name = "Vendor " . $int;
    $first    = "Vendor";
    $last     = $int;
    $password = $int;
    $status = //passed in

    $args  = array(
        'user_email'   => $email,
        'user_login'   => $username,
        'display_name' => $display_name,
        'first_name'   => $first,
        'last_name'    => $last,
        'user_pass'    => $password,
    );
    $user_id = wp_insert_user( $args ); // create the user
}