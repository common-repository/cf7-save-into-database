<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0
 *
 * @package    cf7nxt
 * @subpackage cf7nxt/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    cf7nxt
 * @subpackage cf7nxt/public
 * @author     Your Name <email@example.com>
 */
class CF7NXT_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0
	 * @access   private
	 * @var      string    $cf7nxt    The ID of this plugin.
	 */
	private $cf7nxt;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
    

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0
	 * @param      string    $cf7nxt       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $cf7nxt, $version ) {

		$this->cf7nxt = $cf7nxt;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CF7NXT_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CF7NXT_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->cf7nxt, plugin_dir_url( __FILE__ ) . 'css/plugin-name-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CF7NXT_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CF7NXT_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->cf7nxt, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );

	}
    
    
    
    /**
     * Store CF7NXT 
     * Data Into Backend
     * 
     * @since 1.0
     **/
    
    public function cf7nxt_inter_data( $form_tag ) { 
    
            global $wpdb;
            $table_name  = $wpdb->prefix.'cf7nxt_save';
            
            $data_obj = WPCF7_Submission::get_instance();
            
            if ( $data_obj ) {
                
                
                $submitted_data  = $data_obj->get_posted_data();
                
                $form_id = $form_tag->id();
                
                $form_name = get_the_title($form_id);
                
                $get_name_tag = get_post_meta($form_id, "_cf7nxt_save_name_tag", true);
                
                $get_email_tag = get_post_meta($form_id, "_cf7nxt_save_email_tag", true);
                
                $get_subject_tag = get_post_meta($form_id, "_cf7nxt_save_subject_tag", true);
                
                $get_file_tag = get_post_meta($form_id, "_cf7nxt_save_file_tag", true);
                
                $get_other_tags = get_post_meta($form_id, "_cf7nxt_other_save_tags", true);
                
                $get_other_tags_labels = get_post_meta($form_id, "_cf7nxt_other_labels_save_tags", true);
                
                $keys_arr = explode(",",$get_other_tags_labels);
    
                $values_arr = explode(",",$get_other_tags);
                
                $message_arr  = array_combine($keys_arr, $values_arr);
                
                
                $form_value   = serialize( $submitted_data  );
                
                $form_values   = unserialize( $form_value  );                
                
                $form_date    = current_time('Y-m-d H:i:s');
                
                // Get Uploaded Filed
                
                $upload_dir    = wp_upload_dir();
                
                $cf7nxt_dirname = $upload_dir['basedir'].'/cf7nxt_uploads';
                
                $files          = $data_obj->uploaded_files();
                
                $uploaded_files = array();
                
                $time_now      = time();
                
                $submit_file = "";
                
                
                if($files){
                    
                    $file_status = "yes";
                    
                    foreach ($files as $file_key => $file) {
                    array_push($uploaded_files, $file_key);
                    copy($file, $cf7nxt_dirname.'/'.$time_now.'-'.basename($file));
                    
                    $att = $time_now.'-'.basename($file);
                   }
                
                }else {
                    
                    $file_status = "no";
                    
                    $att = "";
                    
                }
                
                
                foreach ($form_values as $key => $value) {

                    $submit_name = $form_values[$get_name_tag];
                    
                    $submit_email = $form_values[$get_email_tag];
                    
                    $submit_subject = $form_values[$get_subject_tag];
                   
                }
                
                
                if($get_file_tag != '0'){
                    
                    foreach ($form_values as $key => $value) {
                        
                    $submit_file = $form_values[$get_file_tag];
                    
                    }    
                    
                }
                
                $other_tags = array();
                
                    foreach($message_arr as $key => $value){

                        if(is_array($form_values[$value])){
                            
                            
                           foreach($form_values[$value] as $value){
                            
                             $other_tags[] .= $key." : ".$value."<br>";
                                 
                           }      
                        }else{
                        
                        $other_tags[] .= $key." : ".$form_values[$value]."<br>";
                        
                        }
                        
                    }
                
                // Create enquiry in backend
                
                $enquiry_atts = array(
                  'post_type' => 'cf7nxt_panel',
                  'post_title'    => $submit_subject,
                  'post_content'  => "Name : ".$submit_name."<br>"."Email : ".$submit_email."<br><br>".implode(' ', $other_tags),                  
                  'post_status'   => 'publish',
                  'post_author'   => 1
                  //'post_category' => array( 8,39 )
                );
                 
                // Insert the enquiry into the database
              $enq_id =  wp_insert_post( $enquiry_atts );
              
              update_post_meta($enq_id, 'enq_name', $submit_name);
              
              update_post_meta($enq_id, 'enq_email', $submit_email);
              
              update_post_meta($enq_id, 'enq_attach', $submit_file);
              
              update_post_meta($enq_id, 'enq_status', "unread");
              
              update_post_meta($enq_id, 'enq_formname', $form_name);
              
              update_post_meta($enq_id, 'enq_formid', $form_id);
              
              update_post_meta($enq_id, 'enq_star', "no");
              
              update_post_meta($enq_id, 'enq_label', "na");
              
              //update_post_meta($enq_id, 'enq_data', $form_values);
              
              
              $wpdb->insert( $table_name, array(
                'form_id' => $form_id,
                'enq_id'   => $enq_id,
                'upload_status'    => $file_status,
                'upload_url'    => $att
              ) );
              
              
            }    


   
  }
  
  
  public function demo(){
    
     $data =  get_post_meta(113, 'enq_data', true);
     
    // $form_value   = serialize( $data  );
                
    // $form_values   = unserialize( $form_value  ); 
     
     
     print_r($data);
     
if (is_array($data['first-name'])){
echo 'This is an array....';

foreach($data['age'] as $v){
    
    echo $v;
}
}
else
echo 'This is not an array....';
     

  
  
 }
 
}