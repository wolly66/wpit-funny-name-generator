<?php
/**
 * @package wpit funny name generator
 * @author Paolo Valenti
 * @version 1.2 added unicorn generator
 */
/*
Plugin Name: WPIT Funny Name Generator
Plugin URI: https://paolovalenti.org
Description: This plugin generate Jedi, Mad Max, Ninja names and unicorn name
Author: Wolly
Version: 1.2
Author URI: https://paolovalenti.info
Text Domain: wpit-funny-name-generator
Domain Path: /languages
*/
/*
	Copyright 2013  Paolo Valenti aka Wolly  (email : wolly66@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

define ( 'WPIT_WPITFNG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define ( 'WPIT_WPITFNG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define ( 'WPIT_WPITFNG_PLUGIN_SLUG', basename( dirname( __FILE__ ) ) );
define ( 'WPIT_WPITFNG_PLUGIN_VERSION', '1.2' );
define ( 'WPIT_WPITFNG_PLUGIN_VERSION_NAME', 'wpit-wpitfng-version' );



// Create text domain for localization purpose, po files must be in languages directory
function wpit_funny_name_generator_text_domain(){

	load_plugin_textdomain('wpit-funny-name-generator', false, basename( dirname( __FILE__ ) ) . '/languages/' );

}


add_action('plugins_loaded', 'wpit_funny_name_generator_text_domain');

include_once 'inc/class-wpit-jedi.php';
include_once 'inc/class-wpit-mad-max.php';
include_once 'inc/class-wpit-ninja.php';
include_once 'inc/class-wpit-unicorn.php';

include_once 'inc/class-wpit-funny-opiton-panel.php';


class Wpit_Funny_Name_Generator {

	//A static member variable representing the class instance
	private static $_instance = null;



	/**
	 * Wpit_Funny_Name_Generator::__construct()
	 * Locked down the constructor, therefore the class cannot be externally instantiated
	 *
	 * @param array $args various params some overidden by default
	 *
	 * @return
	 */

	private function __construct() {

		//check for plugin update (put in construct)
		add_action( 'init', array( $this, 'update_check' ) );
		add_action(
				'wp_enqueue_scripts',
				array(
					$this,
					'enqueue_styles',
				)
			);




	}

	/**
	 * Wpit_Funny_Name_Generator::__clone()
	 * Prevent any object or instance of that class to be cloned
	 *
	 * @return
	 */
	public function __clone() {
		trigger_error( "Cannot clone instance of Singleton pattern ...", E_USER_ERROR );
	}

	/**
	 * Wpit_Funny_Name_Generator::__wakeup()
	 * Prevent any object or instance to be deserialized
	 *
	 * @return
	 */
	public function __wakeup() {
		trigger_error( 'Cannot deserialize instance of Singleton pattern ...', E_USER_ERROR );
	}

	/**
	 * Wpit_Funny_Name_Generator::getInstance()
	 * Have a single globally accessible static method
	 *
	 * @param mixed $args
	 *
	 * @return
	 */
	public static function getInstance( $args = array() ) {
		if ( ! is_object( self::$_instance ) )
			self::$_instance = new self( $args );

		return self::$_instance;


	}





	/**
	* update_UTILITY_check function.
	*
	* @access public
	* @return void
	*/
	public function update_check() {
	// Do checks only in backend
	   if ( is_admin() ) {


		   if ( version_compare( get_site_option( WPIT_WPITFNG_PLUGIN_VERSION_NAME ), WPIT_WPITFNG_PLUGIN_VERSION , "<" ) ) {

			$this->do_update();

	   		}

		} //end if only in the admin
	}

	/**
	* do_update function.
	*
	* @access private
	*
	*/
	public function do_update(){

	   //DO NOTHING, BY NOW, MAYBE IN THE FUTURE

	   //Update option

	   update_option( WPIT_WPITFNG_PLUGIN_VERSION_NAME , WPIT_WPITFNG_PLUGIN_VERSION );
	}
	
	public function enqueue_styles(){
		
		wp_register_style(
				'wol_funny_name_css',
				WPIT_WPITFNG_PLUGIN_URL . 'assets/css/funny_name.css',
				array(),
				'1.0.0'
			);
			wp_enqueue_style( 'wol_funny_name_css' );

	}


}// chiudo la classe

//istanzio la classe

$wpit_funny_name_generator = Wpit_Funny_Name_Generator::getInstance();