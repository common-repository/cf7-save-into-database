<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0
 *
 * @package    cf7nxt
 * @subpackage cf7nxt/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    cf7nxt
 * @subpackage cf7nxt/admin
 * @author     Your Name <email@example.com>
 */
class CF7NXT_Admin {

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
	 * @param      string    $cf7nxt       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $cf7nxt, $version ) {

		$this->cf7nxt = $cf7nxt;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->cf7nxt, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'att-clip', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->cf7nxt, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );

	}
    
    
  /**
    * Register CF7NXT Panel
    * 
    * @since 1.0
    */
    
  public function cf7nxt_register_panel() {
   register_post_type( 'cf7nxt_panel',
    array(
      'labels' => array(
        'name' => __( 'CF7NXT Panel' ),
        'singular_name' => __( 'CF7NXT Panel' ),
        'edit_item' => __('Edit Enquiry'),
      ),
      'public' => true,
      'has_archive' => false,
      'publicaly_queryable' => false,
      'exclude_from_search' => false,
      'query_var' => false,
      'menu_icon' => 'dashicons-exerpt-view',
      'menu_position' => 50
        )
      );
  }
  
  
  
  /**
   * Create Labels For 
   * Enquiries
   * 
   * @since 1.0.1
   **/
   public function cf7nxt_labels_taxo() {
    
        $labels = array(
		'name'              => __( 'Labels', 'cf7nxt' ),
		'singular_name'     => __( 'Label', 'cf7nxt' ),
		'search_items'      => __( 'Search Labels', 'cf7nxt' ),
		'all_items'         => __( 'All Labels', 'cf7nxt' ),
		'parent_item'       => __( 'Parent Label', 'cf7nxt' ),
		'parent_item_colon' => __( 'Parent Labels:', 'cf7nxt' ),
		'edit_item'         => __( 'Edit Label', 'cf7nxt' ),
		'update_item'       => __( 'Update Labels', 'cf7nxt' ),
		'add_new_item'      => __( 'Add New Label', 'cf7nxt' ),
		'new_item_name'     => __( 'New Label Name', 'cf7nxt' ),
		'menu_name'         => __( 'Labels', 'cf7nxt' ),
	);
    
    register_taxonomy(  
        'cf7nxt_labels',  
        'cf7nxt_panel',        
        array(  
            'hierarchical' => true,  
            'labels' => $labels,  
            'rewrite' => false,
            'public' => true
        )  
    );  
  }
  
  
  
  /**
   * Add Form Fields
   * Into Forms Taxo
   * 
   * @since 1.0.1
   **/
    public function cf7nxt_form_taxo_custom_fields($tag) {  
        
       // Check for existing taxonomy meta for the term you're editing  
        $t_id = $tag->term_id; // Get the ID of the term you're editing  
        $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
    ?>  
      
    <tr class="form-field">  
        <th scope="row" valign="top">  
            <label for="cf7nxt_form_id"><?php _e('Form ID'); ?></label>  
        </th>  
        <td>  
            <input type="text" name="term_meta[cf7nxt_form_id]" id="term_meta[cf7nxt_form_id]" size="25" style="width:60%;" value="<?php echo $term_meta['cf7nxt_form_id'] ? $term_meta['cf7nxt_form_id'] : ''; ?>"><br />  
            <span class="description"><?php _e('Enter Contact Form 7 Form ID'); ?></span>  
        </td>  
    </tr> 
    
    
    
    <tr class="form-field">  
        <th scope="row" valign="top">  
            <label for="cf7nxt_form_subject"><?php _e('Form Subject Tag'); ?></label>  
        </th>  
        <td>  
            <input type="text" name="term_meta[cf7nxt_form_subject]" id="term_meta[cf7nxt_form_subject]" size="25" style="width:60%;" value="<?php echo $term_meta['cf7nxt_form_subject'] ? $term_meta['cf7nxt_form_subject'] : ''; ?>"><br />  
            <span class="description"><?php _e('Enter Contact Form 7 Form Subject Tag Like your-subject'); ?></span>  
        </td>  
    </tr> 
    
    
    <tr class="form-field">  
        <th scope="row" valign="top">  
            <label for="cf7nxt_save_field_names"><?php _e('Form Other Tags List'); ?></label>  
        </th>  
        <td>  
            <input type="text" name="term_meta[cf7nxt_save_field_names]" id="term_meta[cf7nxt_save_field_names]" size="25" style="width:60%;" value="<?php echo $term_meta['cf7nxt_save_field_names'] ? $term_meta['cf7nxt_save_field_names'] : ''; ?>"><br />  
            <span class="description"><?php _e('Enter Comma Seperated Names Like your-name, your-email... etc. Upload File Tag Not Required !!'); ?></span>  
        </td>  
    </tr> 
      
    <?php  
    } 



    /**
       * Save Form Fields
       * Into Forms Taxo
       * 
       * @since 1.0.1
       **/ 
    public function cf7nxt_save_form_taxo_custom_fields( $term_id ) {  
        if ( isset( $_POST['term_meta'] ) ) {  
            $t_id = $term_id;  
            $term_meta = get_option( "taxonomy_term_$t_id" );  
            $cat_keys = array_keys( $_POST['term_meta'] );  
                foreach ( $cat_keys as $key ){  
                if ( isset( $_POST['term_meta'][$key] ) ){  
                    $term_meta[$key] = $_POST['term_meta'][$key];  
                }  
            }  
            //save the option array  
            update_option( "taxonomy_term_$t_id", $term_meta );  
        }  
    }
  
  
  /**
   * Create Texo
   * Filter DD
   * 
   * @since 1.0.1
   **/
   
  public function cf7nxt_labels_filter( $post_type, $which ) {

	// Apply this only on a specific post type
	if ( 'cf7nxt_panel' !== $post_type )
		return;

	// A list of taxonomy slugs to filter by
	$taxonomies = array( 'cf7nxt_labels' ); 

	foreach ( $taxonomies as $taxonomy_slug ) {

		// Retrieve taxonomy data
		$taxonomy_obj = get_taxonomy( $taxonomy_slug );
		$taxonomy_name = $taxonomy_obj->labels->name;

		// Retrieve taxonomy terms
		$terms = get_terms( $taxonomy_slug );

		// Display filter HTML
		echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
		echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
		foreach ( $terms as $term ) {
			printf(
				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
				$term->slug,
				( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name,
				$term->count
			);
		}
		echo '</select>';
	}

  }
 
 
  
  
        
  /**
   * CF7NXT Panel
   * Callback Function
   * 
   * @since 1.0
   **/
                    
  public function cf7nxt_panel(){
    
    require_once plugin_dir_path(__FILE__).'partials/cf7nxt-panel.php';
    
    
    $EnquiryTable = new Cf7nxt_Enq_Table();
    
    $EnquiryTable->prepare_items();
    
    
            ?>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <h2><?php _e( 'CF7NXT Panel - Saved Enquiries', 'contact-form-cfdb7' ); ?></h2>
                <?php $EnquiryTable->display(); ?>
            </div>
        <?php
    
  }
  
  
  
  /**
   * Change Panel
   * Col Subject
   * Text
   * 
   * @since 1.0
   * 
   **/
  public function cf7nxt_change_subject_col_txt( $posts_columns ) {
  
    //print_r($posts_columns);
    $posts_columns[ 'title' ] = 'Subject';
    return $posts_columns;
  
  }
  
  
  
  
   
  /**
   * Remove View
   * and Quick Edit
   * 
   * @since 1.0
   **/
  
  public function cf7nxt_disable_quick_edit( $actions = array(), $post = null ) {
    
   if ( $post->post_type == "cf7nxt_panel" ) {
    
   // Remove the Quick Edit link
    if ( isset( $actions['inline hide-if-no-js'] ) ) {
        unset( $actions['inline hide-if-no-js'] );
    }

   // Remove the View link
    if ( isset( $actions['view'] ) ) {
        unset( $actions['view'] );
    }

   }
   
   
    // Return the set of links without Quick Edit
    return $actions;

 
  }
  
  
  
  /**
   * Remove Add New
   * From CPT
   * 
   * @since 1.0
   **/
   
  public function cf7nxt_remove_submenus() {
    
    global $submenu;
    unset($submenu['edit.php?post_type=cf7nxt_panel'][10]); // Removes 'Add New'.
    
 }
 
 
 
 /**
  * Hide Unusual 
  * Buttons
  * 
  * @since 1.0
  **/
  
 public function cf7nxt_hide_that_stuff() {
    if('cf7nxt_panel' == get_post_type())
    echo '<style type="text/css">
    .page-title-action, li.publish {display:none;}
    #edit-slug-box {display:none;}
    #wp-content-editor-tools, #minor-publishing {display: none;}
    #mceu_26-body, #post-status-info, #message p a {display:none;}
    </style>';
 
 }
 
 
 /**
  * Create Custom 
  * Columns
  * 
  * @since 1.0
  **/ 
 
 public function set_custom_edit_cf7nxt_panel_columns($columns) {
    
    ?>
    <style>
    .fa-star {color:#0085ba;}
    </style>
    
    <?php
    
    unset( $columns['author'] );
    unset($columns['date']);
    
    $columns['enq_name'] = __( 'Name', 'cf7-save-into-database' );
    $columns['enq_email'] = __( 'Email', 'cf7-save-into-database' );
    $columns['enq_label'] = __( 'Label', 'cf7-save-into-database' );
    $columns['enq_formname'] = __( 'CF7 Form', 'cf7-save-into-database' );
    $columns['enq_star'] = __( '<i class="fa fa-star" aria-hidden="true"></i>', 'cf7-save-into-database' );
    $columns['date'] = 'Date';

    return $columns;
    
 }
 
 
public function cf7nxt_sortable_columns( $columns )
{
    $columns['enq_name'] = 'enq_name';
    $columns['enq_email'] = 'enq_email';
    return $columns;
}
 
 /**
  * Create Custom 
  * Columns Data
  * 
  * @since 1.0
  **/
  
  public function custom_cf7nxt_panel_column( $column, $post_id ) {
   
    ?>
   <style>
   th#enq_star{
    width:30px;
   }
   </style>
   
   <script>
   function demo(post_id){
    
     var enq_star_status = '<?php echo get_post_meta($post_id, 'enq_star', true); ?>';
    
    
    
    jQuery.ajax({
        url : '<?php echo admin_url('admin-ajax.php'); ?>',
        type : 'post',
        data : {
            action : 'starred_enquiry',
            post_id : post_id,
            enq_star_status : enq_star_status
        },
        beforeSend: function () {
          is_sending = true;
          
         // $("#order-place-submit").css("display", "none"); 
         // $("#new-order-process").css("display", "block");
          
        },

        
        success : function( response ) {
            
           // alert(response);
            
            if(response == "no"){
                
                jQuery("#no-star").hide();
                jQuery("#yes-star").show();
            
            }else if(response == "yes"){
                
                jQuery("#no-star").show();
                jQuery("#yes-star").hide();
            }
                
            
        }
    });
  
  
  
 // event.preventDefault();
}
   </script>
   
   <?php
   
   
   global $post;
   global $wpdb;
   
   $table_name = $wpdb->prefix.'cf7nxt_save';
   
   $upload_status = $wpdb->get_var("SELECT upload_status FROM $table_name WHERE enq_id = $post->ID");
   
    switch ( $column ) {

        case 'enq_name' :
            $name = get_post_meta( $post->ID ,'enq_name', true);
            $enq_status = get_post_meta( $post->ID ,'enq_status', true);
            
            if ( is_string( $name ) )
             
                if($enq_status == "unread"){
                    
                echo $name."<br>"."<i><span style='font-size:11px; font-weight:600; background:#0085ba; padding:0px 4px 3px 5px; color:#fff; border:none; border-radius:2px; font-weight:500; font-style:initial;'>new</span></i>";
                
                } else if($enq_status == "read"){
                    
                echo $name;
                    
                }
            else
                _e( 'Not Available', 'cf7-save-into-database' );
            break;

        case 'enq_email' :
            $email = get_post_meta( $post->ID ,'enq_email', true);
            if ( is_string( $email ) )
             
              if($upload_status == "yes"){
                
                echo $email.' <i class="fa fa-paperclip" aria-hidden="true"></i>';
                
                }else{
                    
                echo $email;
                    
                }
            else
                _e( 'Not Available', 'cf7-save-into-database' );
            break;
            
            
        case 'enq_label' :
        
            $label = get_post_meta( $post->ID ,'enq_label', true);
            
            $get_label = get_the_terms($post->ID, 'cf7nxt_labels');
            
            //print_r($get_label);
            
            if ( $get_label ){
                
               $labels = array(); 
                   
               foreach($get_label as $label){
                
                  $labels[] = $label->name;
                
               }
               
               echo implode(", ",$labels);
                
            } else{
                _e( 'N/A', 'cf7-save-into-database' );
              }  
            break;    
            
            
            
        case 'enq_formname' :
            
            $form_name = get_post_meta($post->ID, 'enq_formname', true);
            $form_id = get_post_meta($post->ID, 'enq_formid', true);
            
            if ( is_string( $form_name ) )
             
              echo '<a href="'.home_url('/').'wp-admin/admin.php?page=wpcf7&post='.$form_id.'&action=edit" >'.$form_name.'</a>';
              
            else
                _e( 'Not Available', 'cf7-save-into-database' );
            break;
            
                
            
            
        case 'enq_star' :
        
        $enq_star = get_post_meta( $post->ID ,'enq_star', true);
        
        if($enq_star == "yes"){

                echo '<a href="javascript:void(0);" onclick="demo('.$post->ID.')" id="no-star" style="display:none;"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
                
                echo '<a href="javascript:void(0);" onclick="demo('.$post->ID.')" id="yes-star" ><i class="fa fa-star" aria-hidden="true"></i></a>';
        
        } else if($enq_star == "no"){
            
            echo '<a href="javascript:void(0);" onclick="demo('.$post->ID.')" id="no-star"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
                
            echo '<a href="javascript:void(0);" onclick="demo('.$post->ID.')" id="yes-star" style="display:none;"><i class="fa fa-star" aria-hidden="true"></i></a>';
        }        

            break;    

    }
  }
  
  
  
  public function sttarted_enquiry(){
    
    if($_POST['post_id']){
        
        $enq_id = $_POST['post_id'];
        
        $enq_star_status = $_POST['enq_star_status'];
       
       if($enq_star_status == "yes"){
        
       $star_results = update_post_meta($enq_id, 'enq_star', "no");
       
       }else if($enq_star_status == "no"){
        
       $star_results = update_post_meta($enq_id, 'enq_star', "yes");
        
       }
       
       echo $enq_star_status;
    }
    
    exit();
  }


  
 /**
   * Attachments Meta Box
   * For CF7NXT Panel
   * 
   * @since 1.0.1
   **/
  public function cf7nxt_enq_attachments() {
    
    add_meta_box( 'cf7nxt-enq-att', __( 'Attachment', 'cf7-save-into-database' ), array($this, 'cf7nxt_enq_att_callback'), 'cf7nxt_panel', 'side' );
  }
  
  
  
  
  /**
   * CF7 Settings
   * Callback
   * 
   * @since 1.0.1
   **/
  public function cf7nxt_enq_att_callback(){
    
    global $post;
    global $wpdb;
    
    $table_name = $wpdb->prefix.'cf7nxt_save';
    
    $media_url = wp_upload_dir();
    
    $get_attachment = $wpdb->get_var("SELECT upload_url FROM $table_name WHERE enq_id = $post->ID");
    
    
    if($get_attachment){
        
    echo '<a href="'.$media_url['baseurl']."/cf7nxt_uploads/".$get_attachment.'" class="button button-primary" download> Download Attachment </a>';
    
    } else {
        
        echo "<h4>No Attachment Available!</h4>";
    }
    
  } 
  
  
  
  /**
   * Download Enquiry
   * In CSV Button
   * 
   * @since 1.0.1
   **/
 
    public function cf7nxt_export_enq() {
        $screen = get_current_screen();
     
        if (isset($screen->parent_file) && ('edit.php?post_type=cf7nxt_panel' == $screen->parent_file)) {
            ?>
            <input type="submit" name="export_all_posts" id="export_all_posts" class="button button-primary" value="Export All Enquiries">
            <script type="text/javascript">
                jQuery(function($) {
                    $('#export_all_posts').insertAfter('#post-query-submit');
                });
            </script>
            <?php
        }
    }


   
   
   /**
    * Export Enquiry
    * Button Mech.
    * 
    * @since 1.0.1
    **/

  public function cf7nxt_export_enq_mech() {
    if(isset($_GET['export_all_posts'])) {
        $arg = array(
                'post_type' => 'cf7nxt_panel',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            );
 
        global $post;
        $arr_post = get_posts($arg);

        
        if ($arr_post) {
 
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="enquiries.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
 
            $file = fopen('php://output', 'w');
 
            fputcsv($file, array('Enquiry Subject', 'Name', 'Email', 'CF7 Form Name', 'Other Details'));
 
            foreach ($arr_post as $post) {
                setup_postdata($post);
                fputcsv($file, array(get_the_title(), get_post_meta(get_the_ID(), 'enq_name', true), get_post_meta(get_the_ID(), 'enq_email', true), get_post_meta(get_the_ID(), 'enq_formname', true), get_the_content()));
            }
 
            exit();
        }
    }
  }
  
  
  /**
   * Update Enquiry
   * Status to read
   * 
   * @since 1.0.1
   **/
  
  public function cf7nxt_mark_enq_status(){
    
    global $post_type;
    
    global $post;
    
    if( 'cf7nxt_panel' == $post_type ) {
    
    update_post_meta($post->ID, 'enq_status', 'read');
   
    }

  }
  
  
  
  function cf7pp_editor_panels ( $panels ) {

	$new_page = array(
		'PayPal' => array(
			'title' => __( 'CF7NXT Settings', 'cf7-save-into-database' ),
			'callback' => array($this, 'cf7pp_admin_after_additional_settings')
		)
	);

	$panels = array_merge($panels, $new_page);

	return $panels;

  }
  
  
  
  function cf7pp_admin_after_additional_settings( $cf7 ) {

	$post_id = sanitize_text_field($_GET['post']);
	
    $name = 				get_post_meta($post_id, "_cf7nxt_save_name_tag", true);
    $email = 				get_post_meta($post_id, "_cf7nxt_save_email_tag", true);
    $subject = 				get_post_meta($post_id, "_cf7nxt_save_subject_tag", true);
    $file = 				get_post_meta($post_id, "_cf7nxt_save_file_tag", true);
	$other_tags = 			get_post_meta($post_id, "_cf7nxt_other_save_tags", true);
    $other_tags_labels = 	get_post_meta($post_id, "_cf7nxt_other_labels_save_tags", true);

	
	$admin_table_output = "";
	$admin_table_output .= "<h2>Enter Following Details To Save Data</h2>";

	$admin_table_output .= "<div class='mail-field'></div>";
	
	$admin_table_output .= "<table><tr>";
	
	$admin_table_output .= "<tr><td>Enter Name Form Tag: </td>";
	$admin_table_output .= "<td><input type='text' name='cf7nxt_save_name_tag' value='$name' placeholder='your-name'> </td></td></tr><tr><td>";
    
    $admin_table_output .= "<tr><td>Enter Email Form Tag: </td>";
	$admin_table_output .= "<td><input type='text' name='cf7nxt_save_email_tag' value='$email' placeholder='your-email'> </td></td></tr><tr><td>";
    
    $admin_table_output .= "<tr><td>Enter Subject Form Tag: </td>";
	$admin_table_output .= "<td><input type='text' name='cf7nxt_save_subject_tag' value='$subject' placeholder='your-subject'> </td></td></tr><tr><td>";
    
    $admin_table_output .= "<tr><td>Enter File Form Tag: </td>";
	$admin_table_output .= "<td><input type='text' name='cf7nxt_save_file_tag' value='$file' placeholder='file-420'> </td></td></tr><tr><td>";

	$admin_table_output .= "<tr><td>Enter Other Form Tags: </td>";
	$admin_table_output .= "<td><input type='text' name='cf7nxt_other_save_tags' value='$other_tags'> </td><td> (Pass Comma Seperated Tags Like your-bio, your-message..etc)</td></tr><tr><td colspan='3'><br />";

    $admin_table_output .= "<tr><td>Enter Other Form Labels: </td>";
	$admin_table_output .= "<td><input type='text' name='cf7nxt_other_labels_save_tags' value='$other_tags_labels'> </td><td> (Pass Comma Seperated Labels Like Bio,Message..etc)</td></tr><tr><td colspan='3'><br />";

	$admin_table_output .= "<input type='hidden' name='cf7nxt_post' value='$post_id'>";

	$admin_table_output .= "</td></tr></table>";

	echo $admin_table_output;

}




function cf7pp_save_contact_form( $cf7 ) {
		
		$post_id = sanitize_text_field($_POST['cf7nxt_post']);
		
		
		if (!empty($_POST['cf7nxt_save_name_tag'])) {
			$name_tag = sanitize_text_field($_POST['cf7nxt_save_name_tag']);
			update_post_meta($post_id, "_cf7nxt_save_name_tag", $name_tag);
		} else {
			update_post_meta($post_id, "_cf7nxt_save_name_tag", 0);
		}
        
      
        if (!empty($_POST['cf7nxt_save_email_tag'])) {
			$email_tag = sanitize_text_field($_POST['cf7nxt_save_email_tag']);
			update_post_meta($post_id, "_cf7nxt_save_email_tag", $email_tag);
		} else {
			update_post_meta($post_id, "_cf7nxt_save_email_tag", 0);
		}
        
        
        if (!empty($_POST['cf7nxt_save_subject_tag'])) {
			$subject_tag = sanitize_text_field($_POST['cf7nxt_save_subject_tag']);
			update_post_meta($post_id, "_cf7nxt_save_subject_tag", $subject_tag);
		} else {
			update_post_meta($post_id, "_cf7nxt_save_subject_tag", 0);
		}
        
        
        if (!empty($_POST['cf7nxt_save_file_tag'])) {
			$file_tag = sanitize_text_field($_POST['cf7nxt_save_file_tag']);
			update_post_meta($post_id, "_cf7nxt_save_file_tag", $file_tag);
		} else {
			update_post_meta($post_id, "_cf7nxt_save_file_tag", 0);
		}
		
        
       	if (!empty($_POST['cf7nxt_other_save_tags'])) {
			$other_tags = sanitize_text_field($_POST['cf7nxt_other_save_tags']);
			update_post_meta($post_id, "_cf7nxt_other_save_tags", $other_tags);
		} else {
			update_post_meta($post_id, "_cf7nxt_other_save_tags", 0);
		}
        
        
        if (!empty($_POST['cf7nxt_other_labels_save_tags'])) {
			$other_tags_labels = sanitize_text_field($_POST['cf7nxt_other_labels_save_tags']);
			update_post_meta($post_id, "_cf7nxt_other_labels_save_tags", $other_tags_labels);
		} else {
			update_post_meta($post_id, "_cf7nxt_other_labels_save_tags", 0);
		}

  
   }



}
