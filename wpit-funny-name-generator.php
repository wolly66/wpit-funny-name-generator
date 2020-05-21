<?php
/**
 * @package wpit funny name generator
 * @author Paolo Valenti
 * @version 2.1 big restyle
 */
/*
Plugin Name: WPIT Funny Name Generator
Plugin URI: https://paolovalenti.org
Description: This plugin generate Jedi, Mad Max, Ninja names and unicorn name
Author: Wolly
Version: 2.1
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

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}	

// Create text domain for localization purpose, po files must be in languages directory
function wpit_funny_name_generator_text_domain(){

	load_plugin_textdomain('wpit-funny-name-generator', false, basename( dirname( __FILE__ ) ) . '/languages/' );

}


add_action('plugins_loaded', 'wpit_funny_name_generator_text_domain');

if ( ! class_exists( 'Wpit_Funny_Name_Generator' ) ){
	
	class Wpit_Funny_Name_Generator {
	
		//A static member variable representing the class instance
		private static $instance;
	
		/**
		 * The version number of Wol_Iab.
		 *
		 * @access private
		 * @since  1.0
		 * @var    $version
		 */
		private $version = '2.1';
		
		/**
		 * option
		 * 
		 * @var mixed
		 * @access public
		 */
		public $option;
		
		/**
		 * jedi
		 * 
		 * @var mixed
		 * @access public
		 */
		public $jedi;
		
		/**
		 * mad_max
		 * 
		 * @var mixed
		 * @access public
		 */
		public $mad_max;
		
		/**
		 * ninja
		 * 
		 * @var mixed
		 * @access public
		 */
		public $ninja;
		
		/**
		 * unicorn
		 * 
		 * @var mixed
		 * @access public
		 */
		public $unicorn;
		
		public $utility;
	
		
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Wpit_Funny_Name_Generator ) ) {
				self::$instance = new Wpit_Funny_Name_Generator();

				if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {

					add_action(
						'admin_notices',
						array(
							'Wol_Iab',
							'below_php_version_notice',
						)
					);

					return self::$instance;
				}

				self::$instance->setup_constants();

				self::$instance->includes();
				
				add_action(
					'plugins_loaded',
					array(
						self::$instance,
						'setup_objects',
					),
					- 1
				);

				add_action(
					'init',
					array(
						self::$instance,
						'init_settings',
					)
				);

			}

			return self::$instance;
		}	
		
		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @return void
		 * @since  1.0
		 * @access protected
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'Wol_Iab' ), '1.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @return void
		 * @since  1.0
		 * @access protected
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'Wol_Iab' ), '1.0' );
		}

		/**
		 * Show a warning to sites running PHP < 5.6
		 *
		 * @static
		 * @access private
		 * @return void
		 * @since  1.0
		 */
		public static function below_php_version_notice() {
			echo '<div class="error"><p>' . esc_html__( 'Your version of PHP is below the minimum version of PHP required by Wol_Iab. Please contact your host and request that your version be upgraded to 5.6 or later.', 'Wol_Iab' ) . '</p></div>';
		}

		/**
		 * Setup plugin constants
		 *
		 * @access private
		 * @return void
		 * @since  1.0
		 */
		private function setup_constants() {
			
			if ( ! defined( 'WPIT_WPITFNG_PLUGIN_VERSION' ) ) {
				define( 'WPIT_WPITFNG_PLUGIN_VERSION', $this->version );
			}
			
			if ( ! defined( 'WPIT_WPITFNG_PLUGIN_VERSION_NAME' ) ) {
				define ( 'WPIT_WPITFNG_PLUGIN_VERSION_NAME', 'wpit-wpitfng-version' );
			}

			
			// Plugin Folder Path
			if ( ! defined( 'WPIT_WPITFNG_PLUGIN_PATH' ) ) {
				define( 'WPIT_WPITFNG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'WPIT_WPITFNG_PLUGIN_URL' ) ) {
				define( 'WPIT_WPITFNG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			
			// Plugin Folder URL
			if ( ! defined( 'WPIT_WPITFNG_PLUGIN_SLUG' ) ) {
				define ( 'WPIT_WPITFNG_PLUGIN_SLUG', basename( dirname( __FILE__ ) ) );
			}

		}
		
		/**
		 * includes function.
		 * 
		 * @access private
		 * @return void
		 */
		private function includes() {
			
			if ( is_admin(  ) ){
				
				require_once WPIT_WPITFNG_PLUGIN_PATH . 'inc/class-funny-option-panel.php';
				
			} else {
				require_once WPIT_WPITFNG_PLUGIN_PATH . 'wol-wrapper-functions.php';
				require_once WPIT_WPITFNG_PLUGIN_PATH . 'inc/class-jedi.php';
				require_once WPIT_WPITFNG_PLUGIN_PATH . 'inc/class-jedi.php';
				require_once WPIT_WPITFNG_PLUGIN_PATH . 'inc/class-mad-max.php';
				require_once WPIT_WPITFNG_PLUGIN_PATH . 'inc/class-ninja.php';
				require_once WPIT_WPITFNG_PLUGIN_PATH . 'inc/class-unicorn.php';
				require_once WPIT_WPITFNG_PLUGIN_PATH . 'inc/class-utility.php';
				
			}
		}
		
		/**
		 * Setup all objects
		 *
		 * @access public
		 * @return void
		 * @since  1.6.2
		 */
		public function setup_objects() {
			
			// Instantiate in admin only
			if ( is_admin() ) {

				self::$instance->option 	= new Wol_Funny_Name_Options_Page();				

			} else {

				// Frontend only used class
				self::$instance->jedi		= new Wol_Jedy();
				self::$instance->mad_max 	= new Wol_Mad_Max();
				self::$instance->ninja    	= new Wol_Ninja();
				self::$instance->unicorn    = new WOl_Unicorn();
				self::$instance->utility	= new Wol_Fng_Utility();
				
				

			}
			
			self::$instance->update_check();
			
			add_action(
					'wp_enqueue_scripts',
					array(
						$this,
						'enqueue_styles',
					)
				);
		}
		
		public function init_settings() {
			wp_cache_add_non_persistent_groups( array( 'funny-name-session' ) );
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
	
				self::$instance->do_update();
	
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
			
			
			wp_register_script(
				'font-awesome-5',
				'https://kit.fontawesome.com/dc9cba53cf.js',
				array(),
				'1.0.0',
				true
			);
			wp_enqueue_script( 'font-awesome-5' );
			
			
	
		}
	
	
	}// chiudo la classe

} // ! class exists


/**
 * The main function responsible for returning the one true Wol_Iab
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $Wol_Iab = Wol_Iab(); ?>
 *
 * @return Wol_Iab The one true Wol_Iab Instance
 * @since 1.0
 */
function funnyname() {
	return Wpit_Funny_Name_Generator::instance();
}

funnyname();
