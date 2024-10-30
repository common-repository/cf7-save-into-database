<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0
 *
 * @package    cf7nxt
 * @subpackage cf7nxt/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0
 * @package    cf7nxt
 * @subpackage cf7nxt/includes
 * @author     Your Name <email@example.com>
 */
class CF7NXT_Activator {

	   /**
        * Create CF7NXT Table
        * On Plugin Activation
        * @since 1.0
        **/
        
	public static function cf7nxt_table() {

        global $wpdb;
        global $jal_db_version;
        $table_name = $wpdb->prefix . 'cf7nxt_save';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
                    id INT NOT NULL AUTO_INCREMENT,
                    form_id INT NOT NULL,
                    enq_id INT NOT NULL,
                    upload_status varchar(500) NOT NULL,
                    upload_url varchar(500) NOT NULL,
                    PRIMARY KEY (id) )";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        add_option( 'jal_db_version', $jal_db_version );
        


   }
   
   
   public static function cf7nxt_upload(){
    
    $upload_dir    = wp_upload_dir();
    $cf7nxt_dirname = $upload_dir['basedir'].'/cf7nxt_uploads';
    
    if ( ! file_exists( $cf7nxt_dirname ) ) {
        wp_mkdir_p( $cf7nxt_dirname );
    }
    
    add_option( 'cf7nxt_view_install_date', date('Y-m-d G:i:s'), '', 'yes');
    
   }
    

   

}

register_activation_hook( __FILE__, array( 'cf7-save-into-database', 'cf7nxt_table') ); // CF7NXT_Activation Hook
register_activation_hook( __FILE__, array( 'cf7-save-into-database', 'cf7nxt_upload') ); // CF7NXT_Activation Hook