<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://ijalfauzi.com
 * @since      1.0.0
 *
 * @package    Callee_WP
 * @subpackage Callee_WP/includes
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
 * @since      1.0.0
 * @package    Callee_WP
 * @subpackage Callee_WP/includes
 * @author     Ijal Fauzi <hello@ijalfauzi.com>
 */
class Callee_WP {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Callee_WP_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $callee_wp    The string used to uniquely identify this plugin.
	 */
	protected $callee_wp;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'CALLEE_WPVERSION' ) ) {
			$this->version = CALLEE_WPVERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->callee_wp = 'callee-wp';

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
	 * - Callee_WP_Loader. Orchestrates the hooks of the plugin.
	 * - Callee_WP_i18n. Defines internationalization functionality.
	 * - Callee_WP_Admin. Defines all hooks for the admin area.
	 * - Callee_WP_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-callee-wp-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-callee-wp-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-callee-wp-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-callee-wp-public.php';

		$this->loader = new Callee_WP_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Callee_WP_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Callee_WP_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Callee_WP_Admin( $this->get_callee_wp(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        
        //email hook
        $this->loader->add_action( 'phpmailer_init',$plugin_admin,'callee_phpmailer' );

		//action hook for admin menu
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'callee_wp_menu' );

		$this->loader->add_filter('style_loader_tag', $plugin_admin,'my_style_loader_tag_filter',15,2);
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Callee_WP_Public( $this->get_callee_wp(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        //action save request demo
        $this->loader->add_action( 'wp_loaded',$plugin_public,'capture_post' );
        
        //action save download cp
        $this->loader->add_action( 'wp_loaded',$plugin_public,'capture_post_cp' );
        
        //action save kontak kami
        $this->loader->add_action( 'wp_loaded',$plugin_public,'capture_post_kontak' );

		//action save preview modul
		$this->loader->add_action( 'wp_loaded',$plugin_public,'capture_post_modul' );
        
        //action save kontak kami wa
		$this->loader->add_action( 'wp_loaded',$plugin_public,'capture_post_kontak_wa' );

        //action hook for public
        
        $this->loader->add_action( 'shortcode', $plugin_public, 'shortcode_function' );

        //add shortcode request demo
        add_shortcode( 'callee-form-appointment', array( $plugin_public, 'form_appointment') );

        //add shortcode download cp
        add_shortcode( 'callee-form-cp', array( $plugin_public, 'form_cp') );

         //add shortcode kontak
         add_shortcode( 'callee-form-kontak', array( $plugin_public, 'form_kontak') );

        //add shortcode preview modul
        add_shortcode( 'callee-form-modul', array( $plugin_public, 'form_modul') );

         //add shortcode kontak wa
         add_shortcode( 'callee-form-kontak-wa', array( $plugin_public, 'form_kontak_wa') );
        
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_callee_wp() {
		return $this->callee_wp;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Callee_WP_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
