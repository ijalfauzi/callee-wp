<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ijalfauzi.com
 * @since      1.0.0
 *
 * @package    Callee_WP
 * @subpackage Callee_WP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Callee_WP
 * @subpackage Callee_WP/admin
 * @author     Ijal Fauzi <hello@ijalfauzi.com>
 */
class Callee_WP_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $callee_wp    The ID of this plugin.
	 */
	private $callee_wp;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $callee_wp       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $callee_wp, $version ) {

		$this->callee_wp = $callee_wp;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Callee_WP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Callee_WP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'calleewp', plugin_dir_url( __FILE__ ) . 'css/callee-wp-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->callee_wp.'1', plugin_dir_url( __FILE__ ) . 'css/cek.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Callee_WP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Callee_WP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->callee_wp, plugin_dir_url( __FILE__ ) . 'js/callee-wp-admin.js', array( 'jquery' ), $this->version, false );

	}

	//create menu method
	public function callee_wp_menu(){
        add_menu_page('Form Data', 'Form Data', 'edit_posts', 'callee-form-data', array($this,'appointment_dashboard'), 'dashicons-welcome-write-blog', 50 );
        add_submenu_page('callee-form-data', "Request Demo", "Request Demo","edit_posts","callee-form-data",array($this,'appointment_dashboard'), 'dashicons-welcome-write-blog', 50);
        add_submenu_page('callee-form-data', 'Download Compro', 'Download Compro', 'edit_posts', 'download-cp',array($this,'cp_dashboard'), 'dashicons-welcome-write-blog', 50 );
        add_submenu_page('callee-form-data', 'Kontak Kami', 'Kontak Kami', 'edit_posts', 'kontak-kami',array($this,'kontak_dashboard'), 'dashicons-welcome-write-blog', 50 );
        add_submenu_page('callee-form-data', 'Preview Modul', 'Preview Modul', 'edit_posts', 'preview-modul',array($this,'modul_dashboard'), 'dashicons-welcome-write-blog', 50 );
	}

	public function appointment_dashboard()
	{
		// require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
		global $wpdb;

  		$sql = "SELECT * FROM callee_wp";

  		$data = $wpdb->get_results($sql);

		include plugin_dir_path( __FILE__ ).'partials/plugin-callee-wp-display.php';
    }
    
    public function cp_dashboard()
	{
		// require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
		global $wpdb;

  		$sql = "SELECT * FROM callee_cp";

  		$data = $wpdb->get_results($sql);

		include plugin_dir_path( __FILE__ ).'partials/plugin-callee-cp-display.php';
    }
    
    public function kontak_dashboard()
	{
		// require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
		global $wpdb;

  		$sql = "SELECT * FROM callee_kontak";

  		$data = $wpdb->get_results($sql);

		include plugin_dir_path( __FILE__ ).'partials/plugin-callee-kontak-display.php';
	}

    public function modul_dashboard()
	{
		// require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
		global $wpdb;

  		$sql = "SELECT * FROM callee_modul";
		  

  		$data = $wpdb->get_results($sql);

		include plugin_dir_path( __FILE__ ).'partials/plugin-callee-modul-display.php';
	}

	public function my_style_loader_tag_filter($html, $handle) {

	  if($handle === 'calleewp' or $handle === 'callee-wp1') {

		return str_replace("rel='stylesheet'", "rel='preload' crossorigin='anonymous'", $html);

	  }
	  
	  return $html;

    }
    
    public function callee_phpmailer( $phpmailer ) {
        $phpmailer->isSMTP();     
        $phpmailer->Host = SMTP_HOST;
        // $phpmailer->SMTPDebug = 2;
        $phpmailer->SMTPAuth = SMTP_AUTH;
        $phpmailer->Port = SMTP_PORT;
        $phpmailer->Username = SMTP_USER;
        $phpmailer->Password = SMTP_PASS;
        $phpmailer->SMTPSecure = SMTP_SECURE;
        $phpmailer->From = SMTP_FROM;
        $phpmailer->FromName = SMTP_NAME;                     
    }



}
