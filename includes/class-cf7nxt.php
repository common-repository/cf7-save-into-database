<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0
 *
 * @package    cf7nxt
 * @subpackage cf7nxt/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0
 * @package    cf7nxt
 * @subpackage cf7nxt/includes
 * @author     Your Name <email@example.com>
 */
class cf7nxt {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      CF7NXT_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      string    $cf7nxt    The string used to uniquely identify this plugin.
	 */
	protected $cf7nxt;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0
	 */
	public function __construct() {
		if ( defined( 'CF7NXT_VERSION' ) ) {
			$this->version = CF7NXT_VERSION;
		} else {
			$this->version = '1.0';
		}
		$this->cf7nxt = 'plugin-name';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - CF7NXT_Loader. Orchestrates the hooks of the plugin.
	 * - CF7NXT_i18n. Defines internationalization functionality.
	 * - CF7NXT_Admin. Defines all hooks for the admin area.
	 * - CF7NXT_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cf7nxt-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cf7nxt-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cf7nxt-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cf7nxt-public.php';

		$this->loader = new CF7NXT_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the CF7NXT_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new CF7NXT_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new CF7NXT_Admin( $this->get_cf7nxt(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        
        $this->loader->add_action( 'init', $plugin_admin, 'cf7nxt_register_panel' );
        $this->loader->add_action( 'init', $plugin_admin, 'cf7nxt_labels_taxo' );
        $this->loader->add_filter( 'manage_cf7nxt_panel_posts_columns', $plugin_admin, 'cf7nxt_change_subject_col_txt' );
        $this->loader->add_filter( 'post_row_actions', $plugin_admin, 'cf7nxt_disable_quick_edit', 10, 2 );
        $this->loader->add_filter( 'page_row_actions', $plugin_admin, 'cf7nxt_disable_quick_edit', 10, 2 );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'cf7nxt_remove_submenus' );
        $this->loader->add_action( 'admin_head', $plugin_admin, 'cf7nxt_hide_that_stuff' );
        $this->loader->add_filter( 'manage_cf7nxt_panel_posts_columns', $plugin_admin, 'set_custom_edit_cf7nxt_panel_columns' );
        $this->loader->add_action( 'manage_cf7nxt_panel_posts_custom_column', $plugin_admin, 'custom_cf7nxt_panel_column', 10, 2 );
        $this->loader->add_filter( 'manage_edit-cf7nxt_panel_sortable_columns', $plugin_admin, 'cf7nxt_sortable_columns');
        $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'cf7nxt_enq_attachments' );
        $this->loader->add_action( 'restrict_manage_posts', $plugin_admin, 'cf7nxt_export_enq' );
        $this->loader->add_action( 'init', $plugin_admin, 'cf7nxt_export_enq_mech' );
        $this->loader->add_action( 'admin_print_scripts-post.php', $plugin_admin, 'cf7nxt_mark_enq_status');
        
        $this->loader->add_action( 'wp_ajax_starred_enquiry', $plugin_admin, 'sttarted_enquiry');
        $this->loader->add_action( 'restrict_manage_posts', $plugin_admin, 'cf7nxt_labels_filter', 10, 2);
        $this->loader->add_action( 'cf7nxt_forms_edit_form_fields', $plugin_admin, 'cf7nxt_form_taxo_custom_fields', 10, 2);
        $this->loader->add_action( 'edited_cf7nxt_forms', $plugin_admin, 'cf7nxt_save_form_taxo_custom_fields', 10, 2);
        $this->loader->add_filter( 'wpcf7_editor_panels', $plugin_admin, 'cf7pp_editor_panels');
        $this->loader->add_filter( 'wpcf7_after_save', $plugin_admin, 'cf7pp_save_contact_form');
        

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new CF7NXT_Public( $this->get_cf7nxt(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        
        $this->loader->add_action( 'wpcf7_before_send_mail', $plugin_public, 'cf7nxt_inter_data');
        
        $this->loader->add_shortcode( 'hey', $plugin_public, 'demo');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0
	 * @return    string    The name of the plugin.
	 */
	public function get_cf7nxt() {
		return $this->cf7nxt;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0
	 * @return    CF7NXT_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
