<?php
/*
Plugin Name: Tabletop
Plugin URI: http://sabreuse.com/code/wptabletop
Description: WordPress implementation of the Tabletop.js library for working with Google Spreadsheets data
Version: 0.1
Author: Amy Hendrix
Author Email: sabreuse@gmail.com
License: GPL 2 or later

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
		add_action( 'init', array( $this, 'plugin_textdomain' ) );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );

		// Register tabletop shortcode
		add_shortcode('tabletop', array( $this, 'tabletop_shortcode' ) );

	} // end constructor

	/**
	 * Loads the plugin text domain for translation
	 */
	public function plugin_textdomain() {

		$domain = 'wp_tabletop';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
        load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
        load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	} // end plugin_textdomain

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

		wp_enqueue_script( 'tabletop', plugins_url( 'wp-tabletop/js/tabletop.js' ) );
		wp_enqueue_script( 'tabletopSync', plugins_url( 'wp-tabletop/js/backbone.tabletopSync.js' ), array('backbone') );
		wp_register_script( 'wp-tabletop-plugin-script', plugins_url( 'wp-tabletop/js/display.js'), array('jquery', 'tabletop', 'backbone', 'underscore') );


	} // end register_plugin_scripts

	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/

	/**
	 * Add a shortcode [tabletop]to allow adding a GDoc spreadsheet to page/post content.
	 */
	public function tabletop_shortcode($atts) {
		wp_enqueue_script('wp-tabletop-plugin-script');
    	wp_localize_script( 'wp-tabletop-plugin-script', 'WPTT', $atts );

		$wptabletop_content = '    <h1>A Backbone.js tabletop example</h1>
	    <div id="wptt-content"></div>    ';

	    return $wptabletop_content;
	}


} // end class

$wp_tabletop = new WP_Tabletop();
