<?php
/*
Plugin Name: Tabletop
Plugin URI: http://sabreuse.com/code/wptabletop
Description: WordPress implementation of the Tabletop.js library for working with Google Spreadsheets data
Version: 0.1
Author: Amy Hendrix
Author Email: sabreuse@gmail.com
License: GPL

  Copyright 2013 Amy Hendrix (sabreuse@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

class WP_Tabletop {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		// Load plugin text domain
		// add_action( 'init', array( $this, 'wp_tabletop' ) );

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		// register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		// register_uninstall_hook( __FILE__, array( $this, 'uninstall' ) );

	    /*
	     * TODO:
	     * Define the custom functionality for your plugin. The first parameter of the
	     * add_action/add_filter calls are the hooks into which your code should fire.
	     *
	     * The second parameter is the function name located within this class. See the stubs
	     * later in the file.
	     *
	     * For more information:
	     * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
	     */
	    // add_action( 'TODO', array( $this, 'action_method_name' ) );
	    // add_filter( 'TODO', array( $this, 'filter_method_name' ) );
		add_shortcode('tabletop', array( $this, 'tabletop_shortcode' ) );

	} // end constructor

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function activate( $network_wide ) {
		// TODO:	Define activation functionality here
	} // end activate

	// /**
	//  * Fired when the plugin is deactivated.
	//  *
	//  * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	//  */
	// public function deactivate( $network_wide ) {
	// 	// TODO:	Define deactivation functionality here
	// } // end deactivate

	// /**
	//  * Fired when the plugin is uninstalled.
	//  *
	//  * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	//  */
	// public function uninstall( $network_wide ) {
	// 	// TODO:	Define uninstall functionality here
	// } // end uninstall

	/**
	 * Loads the plugin text domain for translation
	 */
	// public function plugin_textdomain() {

	// 	// TODO: replace "wp-tabletop-locale" with a unique value for your plugin
	// 	$domain = 'wp_tabletop';
	// 	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
 //        load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
 //        load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	// } // end plugin_textdomain

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {

		wp_enqueue_style( 'wp-tabletop-admin-styles', plugins_url( 'wp-tabletop/css/admin.css' ) );

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {

		wp_enqueue_script( 'wp-tabletop-admin-script', plugins_url( 'wp-tabletop/js/admin.js' ) );

	} // end register_admin_scripts

	/**
	 * Registers and enqueues plugin-specific styles.
	 */
	public function register_plugin_styles() {

		wp_enqueue_style( 'wp-tabletop-plugin-styles', plugins_url( 'wp-tabletop/css/display.css' ) );

	} // end register_plugin_styles

	/**
	 * Registers and enqueues plugin-specific scripts.
	 */
	public function register_plugin_scripts() {

		wp_enqueue_script( 'wp-tabletop-plugin-script', plugins_url( 'wp-tabletop/js/display.js' ) );
		wp_enqueue_script( 'tabletop', plugins_url( 'wp-tabletop/js/tabletop.js' ) );


	} // end register_plugin_scripts

	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/

	/**
 	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *		  WordPress Actions: http://codex.wordpress.org/Plugin_API#Actions
	 *		  Action Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 */
	// function action_method_name() {
 //    	// TODO:	Define your action method here
	// } // end action_method_name

	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *		  WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *		  Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 */
	// function filter_method_name() {
	//     // TODO:	Define your filter method here
	// } // end filter_method_name

	/**
	 * Add a shortcode [tabletop]to allow adding a GDoc spreadsheet to page/post content.
	 */
	public function tabletop_shortcode($attr) {
	    return 'Display the spreadsheet identified by '.$attr['key'];
	}


} // end class

$wp_tabletop = new WP_Tabletop();